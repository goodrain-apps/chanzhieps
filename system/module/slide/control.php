<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class slide extends control
{
    /**
     * Browse slides in admin.
     * 
     * @access public
     * @return void
     */
    public function admin()
    {
        $groups = $this->slide->getCatagory();
        foreach ($groups as $group)
        {
            $group->slides = $this->slide->getList($group->id);
            $group->slide = $this->slide->getFirstSlide($group->id);
        }
        $this->view->title  = $this->lang->slide->common;
        $this->view->groups = $groups;
        $this->display();
    }

    /**
     * Browse slides.
     *
     * @param $groupID
     * @access public
     * @return void
     */
    public function browse($groupID= '')
    {
        $this->view->title  = $this->lang->slide->browse;
        $this->view->group  = $groupID;
        $this->view->slides = $this->slide->getList($groupID);

        $groupName = $this->dao->select('name')->from(TABLE_CATEGORY)->where('id')->eq($groupID)->fetch();
        $this->view->groupName = isset($groupName->name) ? $groupName->name : '';
        
        $this->display();
    }
    /**
     * Create a slide.
     *
     * @access public 
     * @return void
     */
    public function create($groupID)
    {
        if($_POST)
        {
            if($this->post->backgroundType == 'image')
            {   
                if(empty($_FILES) and empty($_POST['image'])) $this->send(array('result' => 'fail', 'message' => $this->lang->slide->noImageSelected));

                $image = empty($_POST['image']) ? $this->slide->uploadImage($groupID) : $this->post->image;
                if(!$image) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            }
            else
            {
                $image = null;
            }

            if($this->slide->create($groupID, $image))
            {
                $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->inlink('browse', "group={$groupID}")));
            }

            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title = $this->lang->slide->create;
        $this->display(); 
    }

    /**
     * Edit a slide.
     *
     * @param int $id
     * @access public
     * @return void
     */
    public function edit($id)
    {
        $slide = $this->slide->getByID($id);

        if($_POST)
        {
            if($this->slide->update($id))
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>$this->inLink('browse', "groupID={$slide->group}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title = $this->lang->slide->edit;
        $this->view->id    = $id;
        $this->view->slide = $slide;
        $this->display();
    }

    /**
     * Delete a slide.
     *
     * @param int $id
     * @retturn void
     */
    public function delete($id)
    {
        if($this->slide->delete($id)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Sort slides.
     *
     * @access public
     * @return void
     */
    public function sort()
    {
        if($this->slide->sort()) $this->send(array('result' => 'success', 'message' => $this->lang->slide->successSort));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Create a group.
     *
     * @access public
     * @return void
     */
    public function createGroup()
    {
        if($_POST)
        {
            if(!$this->post->name) $this->send(array('result' => 'fail', 'message' => $this->lang->slide->groupNotEmpty));

            $result = $this->loadModel('tree')->createSlideGroup();
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->createSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title = $this->lang->slide->createGroup;
        $this->display();     
    }

    /**
     * Edit group name.
     * 
     * @param  int    $groupID 
     * @access public
     * @return void
     */
    public function editGroup($groupID)
    {
        $group = $this->loadModel('tree')->getByID($groupID);

        if($_POST) 
        {
            if(!$this->post->groupName) $this->send(array('result' => 'fail', 'message' => $this->lang->slide->groupNotEmpty));
            if($this->post->groupName == $group->name) $this->send(array('result' => 'fail', 'message' => $this->lang->slide->noChange));

            $result = $this->loadModel('tree')->editSlideGroup($groupID);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }
    }

    /**
     * Remove a group. 
     * 
     * @access public
     * @return void
     */
    public function removeGroup($groupID)
    {
        $this->dao->delete()->from(TABLE_SLIDE)->where('`group`')->eq($groupID)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        
        $result  = $this->loadModel('tree')->delete($groupID);
        if($result) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }
}
