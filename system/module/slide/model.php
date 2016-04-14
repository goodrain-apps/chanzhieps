<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class slideModel extends model
{
    /**
     * Get one slide by id.
     *
     * @param int $id
     * @access public
     * @return array
     */
    public function getByID($id)
    {
        $slide = $this->dao->select('*')->from(TABLE_SLIDE)->where('id')->eq($id)->fetch();
        if(!$slide) return false;
        $this->process($slide);
        return $slide;
    }

    /**
     * Get slides list sorted by key.
     *
     * @access public
     * @return array
     */
    public function getList($groupID = '')
    {
        if(!$groupID)
        {
            $group = $this->loadModel('tree')->getFirst('slide');
            if(!$group) return array();
            $groupID = $group->id;
        }

        $slides = $this->dao->select('*')->from(TABLE_SLIDE)->where('`group`')->eq($groupID)->orderBy('`order`')->fetchAll('id');
        if(empty($slides)) return array();

        foreach($slides as $slide) $this->process($slide);
        return $slides;
    }

    /**
     * Create a slide.
     *
     * @access public
     * @return bool
     */
    public function create($groupID, $image)
    {
        $slide = fixer::input('post')
            ->stripTags('summary', $this->config->allowedTags->front)
            ->add('group', $groupID)
            ->add('image', $image)
            ->add('createdDate', helper::now())
            ->remove('files')
            ->get();

        $maxOrder = $this->dao->select('max(`order`) as maxOrder')->from(TABLE_SLIDE)->fetch('maxOrder');
        $order = $maxOrder ? $maxOrder + 1 : 1;

        $slide->label        = helper::jsonEncode(array_values($slide->label));
        $slide->buttonClass  = helper::jsonEncode(array_values($slide->buttonClass));
        $slide->buttonUrl    = helper::jsonEncode(array_values($slide->buttonUrl));
        $slide->buttonTarget = helper::jsonEncode(array_values($slide->buttonTarget));
        $slide->order        = $order;

        $this->dao->insert(TABLE_SLIDE)
            ->data($slide, $skip = 'uid')
            ->batchCheckIF($this->post->backgroundType == 'color', $this->config->slide->require->create, 'notempty')
            ->checkIF($this->post->backgroundType == 'color', 'height', 'ge', 100)
            ->exec();

        if($image and empty($_POST['image'])) 
        {
            $slideID = $this->dao->lastInsertId();
            $pathname = str_replace('/data/', '', $image);
            $this->dao->update(TABLE_FILE)->set('objectID')->eq($slideID)->where('pathname')->eq($pathname)->exec();
        }

        return !dao::isError();
    }

    /**
     * Update a slide.
     *
     * @param int $id
     * @access public
     * @return bool
     */
    public function update($id)
    {
        $slide = $this->getByID($id);
        $image = $this->uploadImage($slide->group);

        $data = fixer::input('post')
            ->stripTags('summary', $this->config->allowedTags->front)
            ->setIf(!empty($image), 'image', $image)
            ->setDefault('target', 0)
            ->remove('files')
            ->get();

        $data->label        = helper::jsonEncode(array_values($data->label));
        $data->buttonClass  = helper::jsonEncode(array_values($data->buttonClass));
        $data->buttonUrl    = helper::jsonEncode(array_values($data->buttonUrl));
        $data->buttonTarget = helper::jsonEncode(array_values($data->buttonTarget));

        $this->dao->update(TABLE_SLIDE)
            ->data($data, $skip = 'uid')
            ->batchCheckIF($this->post->backgroundType == 'color', $this->config->slide->require->create, 'notempty')
            ->checkIF($this->post->backgroundType == 'color', 'height', 'ge', 100)
            ->where('id')->eq($id)
            ->exec();

        if($image) 
        {
            $pathname = str_replace('/data/', '', $image);
            $this->dao->update(TABLE_FILE)->set('objectID')->eq($id)->where('pathname')->eq($pathname)->exec();
        }

        return !dao::isError();
    }

    /**
     * Sort slides
     *
     * @access public
     * @return bool
     */
    public function sort()
    {
        /* Count maxKey to avoid  duplicate entry system-common-slides-key. */
        $maxOrder = $this->dao->select('max(`order`) as maxOrder')->from(TABLE_SLIDE)->fetch('maxOrder');

        /* Reset key to zero to make sure key wouldnot overflow. */
        if($maxOrder > 1000) $maxOrder = 0;

        $orders = isset($_POST['order']) ? $_POST['order'] : array();
        foreach($orders as $id => $order)
        {
            /* Add maxKey to key ensure unique.*/
            $order = $maxOrder + $order;
            $this->dao->update(TABLE_SLIDE)->set('order')->eq($order)->where('id')->eq($id)->exec();
        }

        return !dao::isError();
    }

    /**
     * upload image for slide. 
     *
     * @access public
     * @return string webPath
     */
    public function uploadImage($groupID)
    {
        $fileTitles = array();
        $imageSize  = array('width' => 0, 'height' => 0);

        $files = $this->getUpload();
        foreach($files as $id => $file)
        {   
            if(!in_array(strtolower($file['extension']), $this->config->file->imageExtensions, true)) return false;

            $file['objectType'] = 'slide';
            $file['addedBy']    = $this->app->user->account;
            $file['addedDate']  = helper::now();
            $file['lang']       = 'all';
            $this->dao->insert(TABLE_FILE)->data($file, $skip = 'tmpname')->exec();
            $fileID = $this->dao->lastInsertId();
            $file['title']    = $groupID . '_' .$fileID;
            $file['pathname'] = 'slides/' . $file['title'] . '.' . $file['extension'];

            $imagePath = $this->app->getDataRoot() . $file['pathname'];
            if(!move_uploaded_file($file['tmpname'], $imagePath))
            {
                $this->dao->delete()->from(TABLE_FILE)->where('id')->eq($fileID)->exec();
                return false;
            }

            $imageSize = $this->file->getImageSize($imagePath);

            $file['width']  = $imageSize['width'];
            $file['height'] = $imageSize['height'];

            $this->dao->update(TABLE_FILE)->data($file, $skip = 'tmpname')->where('id')->eq($fileID)->exec();

            $fileTitles[$fileID] = $file['title'];
        }

        $this->loadModel('setting')->setItems('system.common.site', array('lastUpload' => time()));

        if(!$fileTitles) return false; 

        $imageIdList = array_keys($fileTitles);
        $image = $this->dao->select('*')->from(TABLE_FILE)->where('id')->eq($imageIdList[0])->fetch(); 
        $image->webPath = '/data/' . $image->pathname;

        return $image->webPath;
    }

    /**
     * Get upload files. 
     * 
     * @access public
     * @return array
     */
    public function getUpload()
    {
        $files = array();
        if(!isset($_FILES['files'])) return $files;
        if(!$this->loadModel('file')->canUpload()) return $files;
        
        extract($_FILES['files']);
        foreach($name as $id => $filename)
        {
            if(empty($filename)) continue;
            if(!validater::checkFileName($filename)) continue;
            $file['extension'] = $this->file->getExtension($filename);
            $file['size']      = $size[$id];
            $file['tmpname']   = $tmp_name[$id];
            $files[] = $file;
        }
        return $files;
    }

    /**
     * Delete a slide.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id, $table = null)
    {
        $slide = $this->getByID($id);
        $this->dao->delete()->from(TABLE_SLIDE)->where('id')->eq($id)->exec();

        return !dao::isError();
    }

     /**
      * Get slide catagory.
      *
      * @access public 
      * @return string
      */
     public function getCatagory()
     {   
          return $this->dao->select('*')->from(TABLE_CATEGORY)->where('type')->eq('slide')->orderBy('id')->fetchall();
     }
     
     /**
      * Get first slide.
      *
      * @param  $groupID
      * @access public
      * @return array
      */
    public function getFirstSlide($groupID) 
    {
        $slide = $this->dao->select('*')->from(TABLE_SLIDE)->where('`group`')->eq($groupID)->orderBy('id')->limit(1)->fetch(); 
        if(!$slide) return false;
        $this->process($slide);
        return $slide;
    }

    /**
     * Process slide.
     * 
     * @param  object    $slide 
     * @access public
     * @return void
     */
    public function process($slide)
    {
        $slide->label        = json_decode($slide->label);
        $slide->buttonClass  = json_decode($slide->buttonClass);
        $slide->buttonUrl    = json_decode($slide->buttonUrl);
        $slide->buttonTarget = json_decode($slide->buttonTarget);
        if($slide->backgroundType == 'image') $slide->image = rtrim($this->app->getWebRoot(), '/') . $slide->image;
    }
}
