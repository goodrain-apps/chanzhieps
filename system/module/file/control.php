<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of file module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     file
 * @version     $Id: control.php 1042 2010-08-19 09:02:39Z yuren_@126.com $
 * @link        http://www.chanzhi.org
 */
class file extends control
{
    /**
     * Build the upload form.
     * 
     * @param int $fileCount 
     * @param float $percent 
     * @access public
     * @return void
     */
    public function buildForm($fileCount = 2, $percent = 0.9)
    {
        if(!$this->file->canUpload()) return;
        $this->view->writeable = $this->file->checkSavePath();
        $this->view->fileCount = $fileCount;
        $this->view->percent   = $percent;
        $this->display();
    }

    /**
     * Build the list part of files.
     * 
     * @param array $files
     * @access public
     * @return string
     */
    public function buildList($files)
    {
        $this->view->files = $files;
        $this->display();
    }

    /**
     * AJAX: the api to recive the file posted through ajax.
     * 
     * @param  string $uid 
     * @access public
     * @return array
     */
    public function ajaxUpload($uid)
    {
        if(RUN_MODE == 'front' and !commonModel::isAvailable('forum') and !commonModel::isAvailable('submittion')) exit;
        if(!$this->loadModel('file')->canUpload())  $this->send(array('error' => 1, 'message' => $this->lang->file->uploadForbidden));
        $file = $this->file->getUpload('imgFile');
        $file = $file[0];
        if($file)
        {
            if(!$this->file->checkSavePath()) $this->send(array('error' => 1, 'message' => $this->lang->file->errorUnwritable));
            if(!in_array(strtolower($file['extension']), $this->config->file->editorExtensions)) $this->send(array('error' => 1, 'message' => $this->lang->fail));
            move_uploaded_file($file['tmpname'], $this->file->savePath . $file['pathname']);

            if(in_array(strtolower($file['extension']), $this->config->file->imageExtensions) !== false)
            {
                $this->file->compressImage($this->file->savePath . $file['pathname']);
                $imageSize = $this->file->getImageSize($this->file->savePath . $file['pathname']);
                $file['width']  = $imageSize['width'];
                $file['height'] = $imageSize['height'];
            }
            $url =  $this->file->webPath . $file['pathname'];

            $file['addedBy']   = $this->app->user->account;
            $file['addedDate'] = helper::now();
            $file['editor']    = 1;
            $file['lang']      = 'all';
            unset($file['tmpname']);
            $this->dao->insert(TABLE_FILE)->data($file)->exec();

            $_SESSION['album'][$uid][] = $this->dao->lastInsertID();
            $this->loadModel('setting')->setItems('system.common.site', array('lastUpload' => time()));
            die(json_encode(array('error' => 0, 'url' => $url)));
        }
    }

    /**
     * The list page of an object
     * 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @param  bool   $isImage 
     * @access public
     * @return void
     */
    public function browse($objectType, $objectID, $isImage = null)
    {
        $this->view->title      = "<i class='icon-paper-clip'></i> " . ($isImage ? $this->lang->file->imageList : $this->lang->file->browse);
        $this->view->modalWidth = 800;
        $this->view->writeable  = $this->file->checkSavePath();
        $this->view->objectType = $objectType;
        $this->view->objectID   = $objectID;
        $this->view->files      = $this->file->getByObject($objectType, $objectID, $isImage);
        $this->view->users      = $this->loadModel('user')->getPairs();
        $this->display();
    }
  
    /**
     * Edit for the file
     * 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @access public
     * @return void
     */
    public function edit($fileID)
    {
        $file = $this->file->getById($fileID);

        if(!empty($_POST))
        {
            if(!$this->file->checkSavePath()) $this->send(array('result' => 'fail', 'message' => $this->lang->file->errorUnwritable));
            $this->file->edit($fileID);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }
        $this->view->title      = $this->lang->file->edit;
        $this->view->modalWidth = 800;
        $this->view->file       = $file;
        $this->display();
    }

    /**
     * The list page of an object
     * 
     * @param  string $type 
     * @param  string $orderBy 
     * @param  int    $pageID       current page id
     * @access public
     * @return void
     */
    public function browseSource($type = '', $orderBy = 'id_desc', $pageID = 1)
    {
        $this->file->setSavePath('source');
        $this->lang->file->menu = $this->lang->theme->menu;
        $this->lang->menuGroups->file = 'ui';

        $this->app->loadClass('pager', $static = true);
        $pager = new pager(0, 10, $pageID);

        $this->view->title     = $this->lang->file->source;
        $this->view->writeable = $this->file->checkSavePath();
        $this->view->type      = $type;
        $this->view->files     = $this->file->getSourceList($type, $orderBy, $pager);
        $this->view->users     = $this->loadModel('user')->getPairs();
        $this->view->pager     = $pager;
        $this->view->uiHeader  = true;
        $this->display();
    }

    /**
     * Edit for the source file. 
     * 
     * @param  int $fileID 
     * @access public
     * @return void
     */
    public function sourceEdit($fileID)
    {
        $this->file->setSavePath('source');
        $file = $this->file->getById($fileID);
        if(!empty($_POST))
        {
            if(!$this->file->checkSavePath()) $this->send(array('result' => 'fail', 'message' => $this->lang->file->errorUnwritable));
            if($this->post->filename == false or $this->post->filename == '') $this->send(array('result' => 'fail', 'message' => $this->lang->file->nameEmpty));

            $filename = $this->post->filename;
            if(!validater::checkFileName($filename)) $this->send(array('result' => 'fail', 'message' => $this->lang->file->evilChar));

            if(!$this->post->continue)
            {
                $extension    = $this->file->getExtension($_FILES['upFile']['name']);
                $sameUpFile   = $this->file->checkSameFile(str_replace('.' . $extension, '', $_FILES['upFile']['name']), $fileID);
                $sameFilename = $this->file->checkSameFile($this->post->filename, $fileID);
                if(!empty($sameUpFile) or !empty($sameFilename))$this->send(array('result' => 'fail', 'error' => $this->lang->file->sameName));
            }

            $result = $this->file->sourceEdit($file, $filename);
            if($result) $this->send(array('result' => 'success','message' => $this->lang->saveSuccess, 'locate' => $this->createLink('file', 'browseSource')));
            $this->send(array('result' => 'fail', 'message' => dao::getError() ));
        }
        $this->view->title      = $this->lang->file->edit;
        $this->view->modalWidth = 500;
        $this->view->file       = $file;
        $this->display();
    }

    /**
     * Upload files for an object.
     * 
     * @param  string $objectType 
     * @param  string $objectID 
     * @access public
     * @return void
     */
    public function upload($objectType, $objectID)
    {
        $this->file->setSavePath($objectType);
        if(!$this->file->checkSavePath()) $this->send(array('result' => 'fail', 'message' => $this->lang->file->errorUnwritable));

        if($objectType == 'source' and !$this->post->continue)
        {
            foreach($_FILES['files']['name'] as $id => $name)
            {
                $extension    = $this->file->getExtension($name);
                $filename     = !empty($_POST['labels'][$id]) ? htmlspecialchars($_POST['labels'][$id]) : str_replace('.' . $extension, '', $name);
                $sameFilename = $this->file->checkSameFile($filename);
                if(!empty($sameFilename)) $this->send(array('result' => 'fail', 'error' => $this->lang->file->sameName));
            }
        }

        $files = $this->file->getUpload('files', $objectType);
        if($files) $this->file->saveUpload($objectType, $objectID);
        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }

    /**
     * Down a file.
     * 
     * @param  int    $fileID 
     * @param  string $mouse 
     * @access public
     * @return void
     */
    public function download($fileID, $mouse = '')
    {
        $file = $this->file->getById($fileID);

        /* Change savePath if objectType is source or slide. */
        if(strpos(',slide,source,', ",{$file->objectType},") !== false)
        {
            $this->file->setSavePath('source');
            $file = $this->file->getById($fileID);
        }
        /* Judge the mode, down or open. */
        $mode  = 'down';
        $fileTypes = 'txt|jpg|jpeg|gif|png|bmp|xml|html';
        if(stripos($fileTypes, $file->extension) !== false and $mouse == 'left') $mode = 'open';

        if(!$file->public && $this->app->user->account == 'guest') $this->locate($this->createLink('user', 'login'));

        /* If the mode is open, locate directly. */
        if($mode == 'open')
        {
            if(file_exists($file->realPath))$this->locate($file->webPath);
            $this->app->triggerError("The file you visit $fileID not found.", __FILE__, __LINE__, true);
        }
        else
        {
            /* Down the file. */
            if(file_exists($file->realPath))
            {
                $fileName = $file->title . '.' . $file->extension;
                $fileData = file_get_contents($file->realPath);

                /* Recording download times, downloads of this file plus one. */
                $this->file->log($fileID);

                $this->file->sendDownHeader($fileName, $file->extension, $fileData, filesize($file->realPath));

            }
            else
            {
                $this->app->triggerError("The file you visit $fileID not found.", __FILE__, __LINE__, true);
            }
        }
    }

    /**
     * Allow a file to public.
     * 
     * @param  int  $fileID 
     * @access public
     * @return void
     */
    public function allow($fileID)
    {
        $this->dao->update(TABLE_FILE)->set('public')->eq(1)->where('id')->eq($fileID)->exec();
        $this->send(array( 'result' => 'success', 'message' => $this->lang->setSuccess));
    }

    /**
     * Deny a file from public.
     * 
     * @param  int  $fileID 
     * @access public
     * @return void
     */
    public function deny($fileID)
    {
        $this->dao->update(TABLE_FILE)->set('public')->eq(0)->where('id')->eq($fileID)->exec();
        $this->send(array( 'result' => 'success', 'message' => $this->lang->setSuccess));
    }

    /**
     * set a image as primary image.
     * 
     * @param  int  $fileID 
     * @access public
     * @return void
     */
    public function setPrimary($fileID)
    {
        $file = $this->file->getByID($fileID);
        if(!$file or !$file->isImage) $this->send(array( 'result' => 'fail', 'message' => $this->lang->fail));

        if(!$file->primary)
        {
            $this->dao->update(TABLE_FILE)
                ->set('primary')->eq(0)
                ->where('id')->ne($fileID)
                ->andWhere('objectType')->eq($file->objectType)
                ->andWhere('objectID')->eq($file->objectID)
                ->exec();

            $this->dao->update(TABLE_FILE)->set('primary')->eq(1)->where('id')->eq($fileID)->exec();
        }
        else
        {
            $this->dao->update(TABLE_FILE)->set('primary')->eq(0)->where('id')->eq($fileID)->exec();
        }

        if(dao::isError()) $this->send(array( 'result' => 'fail', 'message' => dao::getError()));
        $this->send(array( 'result' => 'success', 'message' => $this->lang->setSuccess));
    }

    /**
     * Export as csv format.
     * 
     * @access public
     * @return void
     */
    public function export2CSV()
    {
        $this->view->fields = $this->post->fields;
        $this->view->rows   = $this->post->rows;
        $output = $this->parse('file', 'export2csv');

        /* If the language is zh-cn, convert to gbk. */
        $clientLang = $this->app->getClientLang();
        if($clientLang == 'zh-cn')
        {
            if(function_exists('mb_convert_encoding'))
            {
                $output = @mb_convert_encoding($output, 'gbk', 'utf-8');
            }
            elseif(function_exists('iconv'))
            {
                $output = @iconv('utf-8', 'gbk', $output);
            }
        }

        $this->file->sendDownHeader($this->post->fileName, 'csv', $output);
    }

    /**
     * Delet a file.
     *
     * @param  int  $fileID
     * @return void
     */
    public function delete($fileID)
    {
        $this->dao->delete()->from(TABLE_FILE)->where('id')->eq($fileID)->exec();
        if(!dao::isError()) $this->send(array('result' => 'success')); 
        $this->send(array('result' => 'fail', 'message' => dao::getError())); 
    }

    /**
     * Delet a file.
     *
     * @param  int  $fileID
     * @return void
     */
    public function sourceDelete($fileID)
    {
        $this->file->setSavePath('source');
        $file = $this->file->getByID($fileID);
        if(file_exists($file->realPath)) @unlink($file->realPath);
        $this->dao->delete()->from(TABLE_FILE)->where('id')->eq($fileID)->exec();
        if(!dao::isError()) $this->send(array('result' => 'success')); 
        $this->send(array('result' => 'fail', 'message' => dao::getError())); 
    }

    /**
     * Paste image in kindeditor at firefox and chrome. 
     * 
     * @param  string uid
     * @access public
     * @return void
     */
    public function ajaxPasteImage($uid)
    {
        if($_POST)
        {
            echo $this->file->pasteImage($this->post->editor, $uid);
        }
    }

    /**
     * Get file from file directory in kindeditor. 
     * 
     * @access public
     * @return void
     */
    public function fileManager()
    {
        $fileTypes = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
        $order = $this->get->order ? strtolower($this->get->order) : 'name';

        if(empty($_GET['path']))
        {
            $currentPath    = $this->file->savePath;
            $currentUrl     = $this->file->webPath;
            $currentDirPath = '';
            $moveupDirPath  = '';
        }
        else
        {
            $currentPath    = $this->file->savePath . '/' . $this->get->path;
            $currentUrl     = $this->file->webPath . $this->get->path;
            $currentDirPath = $this->get->path;
            $moveupDirPath  = preg_replace('/(.*?)[^\/]+\/$/', '$1', $currentDirPath);
        }

        if(preg_match('/\.\./', $currentPath)) die($this->lang->file->noAccess);
        if(!preg_match('/\/$/', $currentPath)) die($this->lang->file->invalidParameter);
        if(!file_exists($currentPath) || !is_dir($currentPath)) die($this->lang->file->unWritable);

        $fileList = array();
        if($fileDir = opendir($currentPath))
        {
            $i = 0;
            while(($filename = readdir($fileDir)) !== false)
            {
                if($filename{0} == '.') continue;
                $file = $currentPath . $filename;
                $fileList[$i]['filename'] = $filename;
                if(is_dir($file))
                {
                    $fileList[$i]['is_dir']   = true;
                    $fileList[$i]['has_file'] = (count(scandir($file)) > 2);
                    $fileList[$i]['filesize'] = 0;
                    $fileList[$i]['is_photo'] = false;
                    $fileList[$i]['filetype'] = '';
                }
                else
                {
                    $fileExtension = $this->file->getExtension($file);
                    if(!in_array($fileExtension, $this->config->file->editorExtensions, true))
                    {
                        unset($fileList[$i]);
                        continue;
                    }

                    $fileList[$i]['is_dir']    = false;
                    $fileList[$i]['has_file']  = false;
                    $fileList[$i]['filesize']  = filesize($file);
                    $fileList[$i]['dir_path']  = '';
                    $fileList[$i]['is_photo']  = in_array($fileExtension, $fileTypes);
                    $fileList[$i]['filetype']  = $fileExtension;
                    $fileList[$i]['filename']  = $filename . "?fromSpace=y";
                }

                $fileList[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file));
                $fileList[$i]['order']    = $order;
                $i++;
            }
            closedir($fileDir);
        }

        usort($fileList, "file::sort");

        $result = array();
        $result['moveup_dir_path']  = $moveupDirPath;
        $result['current_dir_path'] = $currentDirPath;
        $result['current_url']      = $currentUrl;
        $result['total_count']      = count($fileList);
        $result['file_list']        = $fileList;

        die(json_encode($result));
    }

    /**
     * Sort the file. 
     * 
     * @access public
     * @return void
     */
    static public function sort($a, $b)
    {
        if(isset($a['is_dir']) && !isset($b['is_dir']))
        {
            return -1;
        }
        elseif(!isset($a['is_dir']) && isset($b['is_dir']))
        {
            return 1;
        }
        else
        {
            if($a['order'] == 'size')
            {
                if($a['filesize'] > $b['filesize']) return 1;
                if($a['filesize'] < $b['filesize']) return -1;
                if($a['filesize'] = $b['filesize']) return 0;
            }
            if($a['order'] == 'type') return strcmp($a['filetype'], $b['filetype']);
            if($a['order'] == 'name') return strcmp($a['filename'], $b['filename']);
        }
    }

    /**
     * Select file. 
     * 
     * @param  string $path 
     * @param  string $type 
     * @param  string $callback 
     * @access public
     * @return void
     */
    public function selectImage($callback = '', $id = '')
    {
        $callback = $callback == '' ? "''" : "$callback()";
        $result   = array();
        $files    = $this->file->getSourceList();
        foreach($files as $key => $file) if($file->isImage) $result[$key] = $file; 

        $this->view->title    = $this->lang->file->source;
        $this->view->files    = $result;
        $this->view->callback = $callback;
        $this->view->id       = $id;
        $this->display();
    }

    /**
     * Set score for file. 
     * 
     * @access public
     * @return void
     */
    public function score()
    {
        foreach($this->post->scores as $fileID => $score)
        {
            if($score) $this->dao->update(TABLE_FILE)->set('score')->eq($score)->set('public')->eq(0)->where('id')->eq($fileID)->exec();
        }
        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
    }
}
