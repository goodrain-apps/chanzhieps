<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of file module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     file
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class fileModel extends model
{
    public $savePath = '';
    public $webPath  = '';
    public $now      = 0;

    /**
     * The construct function, set the save path and web path.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->now = time();
        $this->setSavePath();
        $this->setWebPath();
    }

    /**
     * Print files.
     * 
     * @param  object $files 
     * @access public
     * @return void
     * @todo fix style.
     */
    public function printFiles($files)
    {
        if(empty($files)) return false;

        $imagesHtml = '';
        $filesHtml  = '';
        foreach($files as $file)
        {
            if($file->editor) continue;
            if($file->isVideo) continue;
            $file->title = $file->title . ".$file->extension";
            $fileMD5 = md5_file(rtrim($this->app->getWwwRoot(), '/') . $file->fullURL);
            if($file->isImage)
            {
                if($file->objectType == 'product') continue;
                $imagesHtml .= "<li class='file-image file-{$file->extension}'>" . html::a(helper::createLink('file', 'download', "fileID=$file->id&mouse=left"), html::image($file->smallURL), "target='_blank' data-toggle='lightbox' data-img-width='{$file->width}' data-img-height='{$file->height}' title='{$file->title}'") . '</li>';
            }
            else
            {
                $filesHtml .= "<li class='file file-{$file->extension}'>";
                $filesHtml .= html::a(helper::createLink('file', 'download', "fileID=$file->id&mouse=left"), $file->title, "target='_blank' title='{$file->title}'");
                $filesHtml .= "<span class='file-download'><i class='icon-download'></i> " .  $file->downloads . "</span>";
                $filesHtml .= "<span class='file-md5'>" ;
                $filesHtml .= html::a('javascript:void(0)', 'MD5', "class='label' data-toggle='popover' data-placement='bottom' data-content='$fileMD5'");
                $filesHtml .= '</span></li>';
            }
        }
        echo "<ul class='files-list clearfix'>" . $imagesHtml . $filesHtml . '</ul>';
    }

    /**
     * Get files of an object list.
     * 
     * @param   string  $objectType 
     * @param   mixed   $objectID 
     * @param   bool    $isImage 
     * @access public
     * @return array
     */
    public function getByObject($objectType, $objectID, $isImage = null)
    {
        /* Get files group by objectID. */
        $files = $this->dao->setAutoLang(false)->select('*')
            ->from(TABLE_FILE)
            ->where('objectType')->eq($objectType)
            ->andWhere('objectID')->in($objectID)
            ->beginIf(isset($isImage) and $isImage)->andWhere('extension')->in($this->config->file->imageExtensions)->fi() 
            ->beginIf(isset($isImage) and !$isImage)->andWhere('extension')->notin($this->config->file->imageExtensions)->fi()
            ->orderBy('`primary`, editor_desc') 
            ->fetchGroup('objectID');

        /* Process these files. */
        foreach($files as $objectFiles) $this->batchProcessFile($objectFiles);

        /* If object is only an objectID, return it's files, else return all. */
        if(is_numeric($objectID) and !empty($files[$objectID])) return $files[$objectID];
        return $files;
    }

    /**
     * Get source list. 
     * 
     * @param  string $type 
     * @param  string $orderBy 
     * @param  object $pager 
     * @access public
     * @return array
     */
    public function getSourceList($type = '', $orderBy = 'id_desc', $pager = null)
    {
        $device   = helper::getDevice();
        $template = $this->config->template->{$device}->name;
        $theme    = $this->config->template->{$device}->theme;

        $this->syncSources($template, $theme);

        $files = $this->dao->setAutoLang(false)->select('*')
            ->from(TABLE_FILE)
            ->where('objectType')->eq('slide')
            ->beginIf($type != '')->andWhere('extension')->in($type)->fi() 
            ->orWhere('objectType')->eq('source')
            ->andWhere('objectID')->eq("{$template}_{$theme}")
            ->beginIf($type != '')->andWhere('extension')->in($type)->fi() 
            ->orderBy($orderBy) 
            ->beginIf($pager != null)->page($pager)->fi()
            ->fetchAll('id');

        /* Process these files. */
        $filePathnames = array();
        foreach($files as $id => $objectFiles)
        {
            $this->processFile($objectFiles);
            $filePathnames[$id] = $objectFiles->pathname;
        }
        $filePathnames = array_unique($filePathnames);
        return $files;
    }

    /**
     * Sync sources and save to file table.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @access public
     * @return void
     */
    public function syncSources($template, $theme)
    {
        $fileList = glob($this->app->getDataRoot() . "source/$template/$theme/*");
        $newFiles = array();

        foreach($fileList as $file)
        {
            $info = pathinfo($file);
            if(!in_array($info['extension'], $this->config->file->imageExtensions)) continue;
            $file = str_replace($this->app->getDataRoot(), '', $file);
            $filesCount = $this->dao->select('count(*) as count')->from(TABLE_FILE)->where('pathname')->eq($file)->fetch('count');
            if($filesCount) continue;
            $newFiles[] = $file;
        }

        foreach($newFiles as $path)
        {
            $info = pathinfo($path);
            $file = new stdclass();
            $file->pathname   = $path;
            $file->title      = $info['filename'];
            $file->lang       = 'all';
            $file->objectType = 'source';
            $file->objectID   = "{$template}_{$theme}";
            $file->addedDate  = helper::now();
            $file->extension  = $info['extension'];
            $this->dao->insert(TABLE_FILE)->data($file)->exec();
        }

        return true;
    }

    /**
     * processFile just is image and add smallURL and middleURL if necessary.
     *
     * @param  object $file
     * @return object
     */    
    public function processFile($file)
    {
        $file->fullURL   = $this->getWebPath($file->objectType) . $file->pathname;
        $file->middleURL = '';
        $file->smallURL  = '';
        $file->isImage   = false;
        $file->isVideo   = false;

        if(in_array(strtolower($file->extension), $this->config->file->imageExtensions, true) !== false)
        {
            $file->middleURL = $this->getWebPath($file->objectType) . str_replace('f_', 'm_', $file->pathname);
            $file->smallURL  = $this->getWebPath($file->objectType) . str_replace('f_', 's_', $file->pathname);
            $file->largeURL  = $this->getWebPath($file->objectType) . str_replace('f_', 'l_', $file->pathname);

            if(!file_exists(str_replace($this->getWebPath($file->objectType), $this->savePath, $file->middleURL))) $file->middleURL = $file->fullURL;
            if(!file_exists(str_replace($this->getWebPath($file->objectType), $this->savePath, $file->smallURL)))  $file->smallURL  = $file->fullURL;
            if(!file_exists(str_replace($this->getWebPath($file->objectType), $this->savePath, $file->largeURL)))  $file->largeURL  = $file->fullURL;

            $file->isImage = true;
        }

        if(in_array(strtolower($file->extension), $this->config->file->videoExtensions, true) !== false) $file->isVideo = true;

        return $file;
    }
    
    /**
     * batch run processFile function.
     * 
     * @param array $files
     * @return array
     */
    public function batchProcessFile($files)
    {
        foreach($files as &$file) $file = $this->processFile($file);
        return $files;
    }

    /**
     * Get info of a file.
     * 
     * @param string $fileID 
     * @access public
     * @return void
     */
    public function getByID($fileID)
    {
        $file = $this->dao->setAutoLang(false)->findById($fileID)->from(TABLE_FILE)->fetch();
        if(empty($file)) return false;
        $file->realPath = $this->savePath . $file->pathname;
        $file->webPath  = $this->getWebPath($file->objectType) . $file->pathname;
        return $this->processFile($file);
    }

    /**
     * Save the files uploaded.
     * 
     * @param string $objectType 
     * @param string $objectID 
     * @param string $extra 
     * @access public
     * @return void
     */
    public function saveUpload($objectType = '', $objectID = '', $extra = '', $htmlTagName = 'files')
    {
        $fileTitles = array();
        $now        = helper::now();
        $files      = $this->getUpload($htmlTagName, $objectType);

        $imageSize = array('width' => 0, 'height' => 0);

        foreach($files as $id => $file)
        {   
            if($objectType == 'source') $this->config->file->allowed .= ',css,js,';
            if(strpos($this->config->file->allowed, ',' . $file['extension'] . ',') === false)
            {
                if(!move_uploaded_file($file['tmpname'], $this->savePath . $file['pathname'] . '.txt')) return false;
                $file['pathname'] .= '.txt';
                $file = $this->saveZip($file);
            }
            else
            {
                if(!move_uploaded_file($file['tmpname'], $this->savePath . $file['pathname'])) return false;
            }          

            if(in_array(strtolower($file['extension']), $this->config->file->imageExtensions, true))
            {
                if($objectType != 'source' and $objectType != 'slide') $this->compressImage($this->savePath . $file['pathname']);
                $imageSize = $this->getImageSize($this->savePath . $file['pathname']);
            }

            $file['objectType'] = $objectType;
            $file['objectID']   = $objectID;
            $file['addedBy']    = $this->app->user->account;
            $file['addedDate']  = $now;
            $file['extra']      = $extra;
            $file['width']      = $imageSize['width'];
            $file['height']     = $imageSize['height'];
            $file['lang']       = 'all';
            if($objectType == 'logo') $file['lang'] = $this->app->getClientLang();
            unset($file['tmpname']);
            unset($file['id']);
            $this->dao->insert(TABLE_FILE)->data($file)->exec();
            $fileTitles[$this->dao->lastInsertId()] = $file['title'];
        }
        $this->loadModel('setting')->setItems('system.common.site', array('lastUpload' => time()));
        return $fileTitles;
    }

    /**
     * Save dangerous files to zip. 
     * 
     * @param  array    $file 
     * @access public
     * @return array
     */
    public function saveZip($file)
    {
        $this->app->loadClass('pclzip', true);
        $pathInfo = pathinfo($file['pathname']);

        $uploadedFile = $this->savePath . $file['pathname'];
        $gbkName      = function_exists('iconv') ? iconv('utf-8', 'gbk', $file['title']) : $file['title'];
        $tmpFile      = dirname($file['tmpname']) . DS . md5(uniqid()) . DS . $gbkName . '.' . $file['extension'];

        mkdir(dirname($tmpFile));
        copy($uploadedFile, $tmpFile);
        $archive = new PclZip($this->savePath . substr($file['pathname'], 0, -4) . '.zip');
        $list    = $archive->create($tmpFile, PCLZIP_OPT_REMOVE_ALL_PATH);
        if($list != 0)
        {
            unlink($uploadedFile);
            unlink($tmpFile);
            rmdir(dirname($tmpFile));
            $file['pathname']  = substr($file['pathname'], 0, -4) . '.zip';
            $file['extension'] = 'zip';
        }

        return $file;
    }

    /**
     * Get the count of uploaded files.
     * 
     * @access public
     * @return void
     */
    public function getCount()
    {
        return count($this->getUpload());
    }

    /**
     * Check can upload front. 
     * 
     * @access public
     * @return void
     */
    public function canUpload()
    {
       if(RUN_MODE == 'admin') return true;
       if(isset($this->config->site->allowUpload) and $this->config->site->allowUpload == 1) return true;
       if(isset($this->app->user->admin) and $this->app->user->admin == 'super') return true;
       return false;
    }

    /**
     * get uploaded files.
     * 
     * @param string $htmlTagName 
     * @access public
     * @return void
     */
    public function getUpload($htmlTagName = 'files', $objectType = 'upload')
    {
        $files = array();
        if(!isset($_FILES[$htmlTagName])) return $files;
        if(!$this->canUpload()) return $files;
        
        $this->app->loadClass('filter', true);

        $this->app->loadClass('purifier', true);
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        /* The tag if an array. */
        if(is_array($_FILES[$htmlTagName]['name']))
        {
            extract($_FILES[$htmlTagName]);
            foreach($name as $id => $fileName)
            {
                if(empty($fileName)) continue;
                if(!validater::checkFileName($fileName)) continue;
                $file['id']        = $id;
                $file['extension'] = $this->getExtension($fileName);
                $file['title']     = !empty($_POST['labels'][$id]) ? htmlspecialchars($_POST['labels'][$id]) : str_replace('.' . $file['extension'], '', $fileName);
                $file['title']     = $purifier->purify($file['title']);
                $file['size']      = $size[$id];
                $file['tmpname']   = $tmp_name[$id];
                $file['pathname']  = $this->setPathName($file, $objectType);
                $files[] = $file;
            }
        }
        else
        {
            if(empty($_FILES[$htmlTagName]['name'])) return array();
            extract($_FILES[$htmlTagName]);
            if(!validater::checkFileName($name)) return array();;
            $file['id']        = 0;
            $file['extension'] = $this->getExtension($name);
            $file['title']     = !empty($_POST['labels'][0]) ? htmlspecialchars($_POST['labels'][0]) : substr($name, 0, strpos($name, $file['extension']) - 1);
            $file['title']     = $purifier->purify($file['title']);
            $file['size']      = $size;
            $file['pathname']  = $this->setPathName($file, $objectType);
            $file['tmpname']   = $tmp_name;
            return array($file);
        }
        return $files;
    }

    /**
     * Get extension name of a file.
     * 
     * @param string $fileName 
     * @access public
     * @return void
     */
    public function getExtension($fileName)
    {
        $extension = strtolower(trim(pathinfo($fileName, PATHINFO_EXTENSION)));
        if(empty($extension) or !preg_match('/^[a-z0-9]+$/', $extension) or strlen($extension) > 5) return 'txt';
        return $extension;
    }

    /**
     * Get image width and height.
     * 
     * @param  string    $imagePath 
     * @access public
     * @return array
     */
    public function getImageSize($imagePath)
    {
        if(!file_exists($imagePath)) return array('width' => 0, 'height' => 0);

        list($width, $height) = getimagesize($imagePath);
        return array('width' => (int)$width, 'height' => (int)$height);
    }

    /**
     * Set the path name.
     * 
     * @param string $fileID 
     * @param string $extension 
     * @access public
     * @return void
     */
    public function setPathName($file, $objectType = 'upload')
    {
        if(strpos('slide,source', $objectType) === false)
        {
            $sessionID  = session_id();
            $randString = substr($sessionID, mt_rand(0, strlen($sessionID) - 5), 3);
            $pathName   = date('Ym/dHis', $this->now) . $file['id'] . mt_rand(0, 10000) . $randString;
        }
        elseif($objectType == 'source') 
        {
            /* Process file path if objectType is source. */
            $device   = helper::getDevice();
            $template = $this->config->template->{$device}->name;
            $theme    = $this->config->template->{$device}->theme;
            return "source/{$template}/{$theme}/{$file['title']}.{$file['extension']}";
        }
        
        /* rand file name more */
        list($path, $fileName) = explode('/', $pathName);
        $fileName = md5(mt_rand(0, 10000) . str_shuffle(md5($fileName)) . mt_rand(0, 10000));
        return $path . '/f_' . $fileName . '.' . $file['extension'];
    }

    /**
     * Set the save path.
     * 
     * @param  string $objectType 
     * @access public
     * @return void
     */
    public function setSavePath($objectType = '')
    {
        $savePath = $this->app->getDataRoot() . "upload/" . date('Ym/', $this->now);
        $this->savePath = dirname($savePath) . '/';

        if($objectType == 'source')
        {
            $device   = helper::getDevice();
            $template = $this->config->template->{$device}->name;
            $theme    = $this->config->template->{$device}->theme;
            $savePath = $this->app->getDataRoot() . "source/{$template}/{$theme}/";
            $this->savePath = $this->app->getDataRoot();
        }

        if(!file_exists($savePath)) 
        {
            @mkdir($savePath, 0777, true);
            if(is_writable($savePath) && !file_exists($savePath . DS . 'index.html'))
            {
                $fd = @fopen($savePath . DS . 'index.html', "a+");
                fclose($fd);
                chmod($savePath . DS . 'index.html' , 0755);
            }
        }
    }
    
    /**
     * Set the web path.
     * 
     * @access public
     * @return void
     */
    public function setWebPath()
    {
        $this->webPath = $this->app->getWebRoot() . "data/upload/";
    }

    /**
     * Get the web path.
     * 
     * @param  string $objectType 
     * @access public
     * @return void
     */
    public function getWebPath($objectType = '')
    {
        if(strpos(',slide,source,', ",$objectType,") !== false) return $this->app->getWebRoot() . "data/";
        return $this->app->getWebRoot() . "data/upload/";
    }

    /**
     * Edit file.
     * 
     * @param  int    $fileID 
     * @access public
     * @return void
     */
    public function edit($fileID)
    {
        $this->replaceFile($fileID);
        $fileInfo = fixer::input('post')->remove('upFile')->get();
        if(!validater::checkFileName($fileInfo->title)) return false;
        $fileInfo->lang = 'all';
        $this->dao->update(TABLE_FILE)->data($fileInfo)->autoCheck()->batchCheck($this->config->file->require->edit, 'notempty')->where('id')->eq($fileID)->exec();
        $this->dao->setAutoLang(false)->update(TABLE_FILE)->data($fileInfo)->autoCheck()->batchCheck($this->config->file->require->edit, 'notempty')->where('id')->eq($fileID)->exec();

    }

    /**
     * Replace a file.
     * 
     * @access public
     * @return bool 
     */
    public function replaceFile($fileID, $postName = 'upFile')
    {
        $fileInfo  = $this->dao->setAutoLang(false)->select('pathname, extension, objectType')->from(TABLE_FILE)->where('id')->eq($fileID)->fetch();
        if(empty($fileInfo)) return false;
        $this->setSavePath($fileInfo->objectType);
        $files = $this->getUpload($postName, $fileInfo->objectType);
        if(!empty($files))
        {
            $file      = $files[0];
            $extension = strtolower($file['extension']);

            /* Remove old file. */
            if(file_exists($this->savePath . $fileInfo->pathname)) unlink($this->savePath . $fileInfo->pathname);
            foreach($this->config->file->thumbs as $size => $configure)
            {
                $thumbPath = $this->savePath . str_replace('f_', $size . '_', $fileInfo->pathname);
                if(file_exists($thumbPath)) unlink($thumbPath);
            }

            if($extension != $fileInfo->extension)
            {
                $fileInfo->pathname  = str_replace(".{$fileInfo->extension}", ".$extension", $fileInfo->pathname);
                $fileInfo->extension = $extension;
            }

            $realPathName = $this->savePath . $fileInfo->pathname;
            $imageSize    = array('width' => 0, 'height' => 0);
            if(strpos($this->config->file->allowed, ',' . $extension . ',') === false)
            {
                if(!move_uploaded_file($file['tmpname'], $this->savePath . $fileInfo->pathname . '.txt')) return false;
                $fileInfo->pathname .= '.txt';
                $this->saveZip($file); 
            }
            else
            {
                if(!move_uploaded_file($file['tmpname'], $this->savePath . $fileInfo->pathname)) return false;
            }

            if(in_array(strtolower($file['extension']), $this->config->file->imageExtensions) and $fileInfo->objectType != 'slide' and $fileInfo->objectType != 'source' )
            {
                $this->compressImage($realPathName);
                $imageSize = $this->getImageSize($realPathName);
            }

            $fileInfo->addedBy   = $this->app->user->account;
            $fileInfo->addedDate = helper::now();
            $fileInfo->size      = $file['size'];
            $fileInfo->width     = $imageSize['width'];
            $fileInfo->height    = $imageSize['height'];
            $fileInfo->lang      = 'all';
            $this->dao->setAutoLang(false)->update(TABLE_FILE)->data($fileInfo)->where('id')->eq($fileID)->exec();
            $this->loadModel('setting')->setItems('system.common.site', array('lastUpload' => time()));
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Check title conflict or not.
     * 
     * @param  int     $fileID 
     * @param  string  $filename 
     * @access public
     * @return void
     */
    public function checkSameFile($filename, $fileID = 0)
    {
        $device   = helper::getDevice();
        $template = $this->config->template->{$device}->name;
        $theme    = $this->config->template->{$device}->theme;

        return $this->dao->select('*')->from(TABLE_FILE)
            ->where('title')->eq($filename)
            ->andWhere('objectType')->eq('source')
            ->andWhere('objectID')->eq("{$template}_{$theme}")
            ->beginIF($fileID)->andWhere('id')->ne($fileID)->fi()
            ->fetch();
    }

    /**
     * Source edit.  
     * 
     * @param  int    $fileID 
     * @param  string $fileName 
     * @access public
     * @return array
     */
    public function sourceEdit($file, $fileName)
    {
        $files = $this->getUpload('upFile', $file->objectType);
        $uploadPath = $this->app->getDataRoot();
        if(!empty($files))
        {
            /* Use post fileName as file title. */
            $_FILES['upFile']['name'] = $fileName . '.' . $file->extension;

            $replaceResult = $this->replaceFile($file->id, 'upFile');
            if(!$replaceResult) return false;
        }

        if($fileName != $file->title) 
        {
            $file = $this->getByID($file->id);
            if(!file_exists($file->realPath)) return false;
            $newPath = dirname($file->realPath) . DS . $fileName . '.' . $file->extension;
            $result = copy($file->realPath, $newPath);
            if(!$result) return false;
            @unlink($file->realPath);
            
            $newPathname = str_replace($uploadPath, '', $newPath);
            $this->dao->update(TABLE_FILE)->set('title')->eq($fileName)->set('pathName')->eq($newPathname)->where('id')->eq($file->id)->exec();
        }

        return !dao::isError();
    }
 
    /**
     * Save file download log.
     *
     * @param int $file
     * @access public
     * @return bool
     */
    public function log($file)
    {
        $log = new stdClass();
        $log->file    = $file;
        $log->account = $this->app->user->account;
        $log->ip      = $this->server->remote_addr;
        $log->referer = $this->server->http_referer;
        $log->time    = helper::now();

        $this->dao->insert(TABLE_DOWN)->data($log)->exec();
        $this->dao->update(TABLE_FILE)->set('downloads = downloads + 1')->where('id')->eq($file)->exec();

        return !dao::isError();
    }

    /**
     * Delete the record and the file
     * 
     * @param  int    $fileID 
     * @access public
     * @return void
     */
    public function delete($fileID, $null = null)
    {
        $file = $this->getByID($fileID);
        if(file_exists($file->realPath)) unlink($file->realPath);
        if(in_array($file->extension, $this->config->file->imageExtensions))
        {
            foreach($this->config->file->thumbs as $size => $configure)
            {
                $thumbPath = $this->savePath . str_replace('f_', $size . '_', $file->pathname);
                if(file_exists($thumbPath)) unlink($thumbPath);
            }
        }
        $this->dao->delete()->from(TABLE_FILE)->where('id')->eq($file->id)->exec();
        return !dao::isError();
    }

    /**
     * Paste image in kindeditor at firefox and chrome. 
     * 
     * @param  string    $data 
     * @param  string    $uid 
     * @access public
     * @return string
     */
    public function pasteImage($data, $uid)
    {
        $data = str_replace('\"', '"', $data);

        if(!$this->checkSavePath()) return false;

        ini_set('pcre.backtrack_limit', strlen($data));
        preg_match_all('/<img src="(data:image\/(\S+);base64,(\S+))" .+ \/>/U', $data, $out);
        foreach($out[3] as $key => $base64Image)
        {
            $imageData = base64_decode($base64Image);
            $imageSize = array('width' => 0, 'height' => 0);

            $file['id']        = $key;
            $file['extension'] = $out[2][$key];
            $file['size']      = strlen($imageData);
            $file['addedBy']   = $this->app->user->account;
            $file['addedDate'] = helper::today();
            $file['title']     = basename($file['pathname']);
            $file['pathname']  = $this->setPathName($file);
            $file['editor']    = 1;

            file_put_contents($this->savePath . $file['pathname'], $imageData);
            $this->compressImage($this->savePath . $file['pathname']);

            $imageSize      = $this->getImageSize($this->savePath . $file['pathname']);
            $file['width']  = $imageSize['width'];
            $file['height'] = $imageSize['height'];
            $file['lang']   = 'all';

            $this->dao->insert(TABLE_FILE)->data($file)->exec();
            $_SESSION['album'][$uid][] = $this->dao->lastInsertID();

            $data = str_replace($out[1][$key], $this->webPath . $file['pathname'], $data);
        }

        return $data;
    }

    /**
     * Compress image to config configured size.
     * 
     * @param  string    $imagePath 
     * @access public
     * @return void
     */
    public function compressImage($imagePath)
    {
        $this->app->loadClass('phpthumb', true);
        $imageInfo = pathinfo($imagePath);
        if(!is_writable($imageInfo['dirname'])) return false;

        foreach($this->config->file->thumbs as $size => $configure)
        {
            $thumbPath = str_replace('f_', $size . '_', $imagePath);
            if(extension_loaded('gd'))
            {
                $thumb = phpThumbFactory::create($imagePath);
                $thumb->resize($configure['width'], $configure['height']);
                $thumb->save($thumbPath);
            }
            else
            {
                copy($imagePath, $thumbPath);   
            }
        }
    }

    /**
     * Check save path is writeable.
     * 
     * @access public
     * @return void
     */
    public function checkSavePath()
    {
        return is_writable($this->savePath);
    }

    /**
     * Update objectType and objectID for file.
     * 
     * @param  string $uid 
     * @param  int    $objectID 
     * @param  string $bojectType 
     * @access public
     * @return void
     */
    public function updateObjectID($uid, $objectID, $objectType)
    {
        $data = new stdclass();
        $data->objectID   = $objectID;
        $data->objectType = $objectType;
        $data->lang       = 'all';
        if(isset($_SESSION['album'][$uid]) and $_SESSION['album'][$uid])
        {
            $this->dao->setAutoLang(false)->update(TABLE_FILE)->data($data)->where('id')->in($_SESSION['album'][$uid])->exec();
            if(dao::isError()) return false;
            return !dao::isError(); 
        }
    }

    /**
     * Copy file in content from file space.
     * 
     * @param  string $content 
     * @param  int    $objectID 
     * @param  string $bojectType 
     * @access public
     * @return bool
     */
    public function copyFromContent($content, $objectID, $objectType)
    {
        preg_match_all('/<img src="(\/data\/upload\/(\S+)\?fromSpace=y)" .+ \/>/U', $content, $images);

        if(empty($images)) return false;
        foreach($images[2] as $key => $pathname)
        {
            $pathname = str_replace($this->webPath, '', $pathname);
            $pathname = str_replace('\?fromSpace=y', '', $pathname);

            $data = $this->dao->setAutoLang(false)->select('*')->from(TABLE_FILE)->where('pathname')->eq($pathname)->fetch();
            if(!$data) $data = new stdclass();

            $data->pathname   = $pathname;
            $data->extension  = $this->getExtension($pathname);
            $data->objectID   = $objectID;
            $data->objectType = $objectType;
            $data->addedBy    = $this->app->user->account;
            $data->addedDate  = helper::now();
            $data->editor     = 1;
            $data->lang       = 'all';

            $fileExists = $this->dao->setAutoLang(false)->select('count(*) as count')->from(TABLE_FILE)
                ->where('objectType')->eq($objectType)
                ->andWhere('objectID')->eq($objectID)
                ->andWhere('pathname')->eq($pathname)
                ->fetch('count');

            if($fileExists == 0) $this->dao->insert(TABLE_FILE)->data($data, $skip = 'id')->exec();
        }

        return !dao::isError(); 
    }

    /**
     * Send the download header to the client.
     * 
     * @param  string    $fileName 
     * @param  string    $extension 
     * @access public
     * @return void
     */
    public function sendDownHeader($fileName, $fileType, $content, $fileSize = 0)
    {
        /* Set the downloading cookie, thus the export form page can use it to judge whether to close the window or not. */
        setcookie('downloading', 1);

        /* Append the extension name auto. */
        $extension = '.' . $fileType;
        if(strpos($fileName, $extension) === false) $fileName .= $extension;

        /* urlencode the fileName for ie. */
        $isIE11 = (strpos($this->server->http_user_agent, 'Trident') !== false and strpos($this->server->http_user_agent, 'rv:11.0') !== false); 
        if(strpos($this->server->http_user_agent, 'MSIE') !== false or $isIE11) $fileName = urlencode($fileName);

        /* Judge the content type. */
        $mimes = $this->config->file->mimes;
        $contentType = isset($mimes[$fileType]) ? $mimes[$fileType] : $mimes['default'];

        header("Content-type: $contentType");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-length: {$fileSize}");
        header("Pragma: no-cache");
        header("Expires: 0");
        die($content);
    }
}
