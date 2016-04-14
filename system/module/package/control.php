<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class package extends control
{
    /**
     * Browse packages.
     *
     * @param  string   $status
     * @access public
     * @return void
     */
    public function browse($status = 'installed')
    {
        $packages = $this->package->getLocalPackages($status);
        $versions = array();
        if($packages and $status == 'installed')
        {
            /* Get latest release from remote. */
            $extCodes = helper::safe64Encode(join(',', array_keys($packages)));
            $results = $this->package->getPackagesByAPI('bycode', $extCodes, $recTotal = 0, $recPerPage = 1000, $pageID = 1);
            if(isset($results->extensions))
            {
                $remoteReleases = $results->extensions;
                foreach($remoteReleases as $release)
                {
                    if(!isset($packages[$release->code])) continue;

                    $package = $packages[$release->code];
                    $package->viewLink = $release->viewLink;
                    if(isset($release->latestRelease) and $package->version != $release->latestRelease->releaseVersion and $this->package->checkVersion($release->latestRelease->chanzhiCompatible))
                    {
                        $upgradeLink = inlink('upgrade', "package=$release->code&downLink=" . helper::safe64Encode($release->latestRelease->downLink) . "&md5={$release->latestRelease->md5}&type=$release->type");
                        $upgradeLink = ($release->latestRelease->charge or !$release->latestRelease->public) ? $release->latestRelease->downLink : $upgradeLink;
                        $package->upgradeLink = $upgradeLink;
                    }
                }
            }
        }

        $this->view->title    = $this->lang->package->common;
        $this->view->tab      = $status;
        $this->view->packages = $packages;
        $this->view->versions = $versions;
        $this->view->status   = $status;
        $this->display();
    }

    /**
     * Obtain packages from the community.
     * 
     * @param  string $type 
     * @param  string $param 
     * @access public
     * @return void
     */
    public function obtain($type = 'byUpdatedTime', $param = '', $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        /* Init vars. */
        $type     = strtolower($type);
        $moduleID = $type == 'bymodule' ? (int)$param : 0;
        $packages = array();
        $pager    = null;

        /* Set the key. */
        if($type == 'bysearch') $param = helper::safe64Encode($this->post->key);

        /* Get results from the api. */
        $results = $this->package->getPackagesByAPI($type, $param, $recTotal, $recPerPage, $pageID);
        if($results)
        {
            $this->app->loadClass('pager', $static = true);
            $pager    = new pager($results->dbPager->recTotal, $results->dbPager->recPerPage, $results->dbPager->pageID);
            $packages = $results->extensions;
        }

        $this->view->title      = $this->lang->package->obtain;
        $this->view->position[] = $this->lang->package->obtain;
        $this->view->moduleTree = str_replace('/index.php', $this->server->script_name, $this->package->getModulesByAPI());
        $this->view->packages   = $packages;
        $this->view->installeds = $this->package->getLocalPackages('installed');
        $this->view->pager      = $pager;
        $this->view->tab        = 'obtain';
        $this->view->type       = $type;
        $this->view->moduleID   = $moduleID;
        $this->display();
    }
    
    /**
     * Install a package
     * 
     * @param  string $package 
     * @param  string $type 
     * @param  string $overridePackage 
     * @param  string $ignoreCompatible 
     * @param  string $overrideFile 
     * @param  string $agreeLicense 
     * @param  string $upgrade 
     * @access public
     * @return void
     */
    public function install($package, $downLink = '', $md5 = '', $type = '', $overridePackage = 'no', $ignoreCompatible = 'no', $overrideFile = 'no', $agreeLicense = 'no', $upgrade = 'no')
    {
        $this->loadModel('guarder');
        $this->view->canManage = array('result' => 'success');
        if($downLink and !$this->guarder->verify()) $this->view->canManage = $this->loadModel('common')->verifyAdmin();
        set_time_limit(0);
        unset($this->lang->package->menu);
        
        $installedPackage = $this->package->getInfoFromDB($package);

        $installTitle = $upgrade == 'no' ? $this->lang->package->install : $this->lang->package->upgrade;
        $installType  = $upgrade == 'no' ? $this->lang->package->installExt : $this->lang->package->upgradeExt; 

        $this->view->error       = '';
        $this->view->installType = $installType;
        $this->view->upgrade     = $upgrade;
        $this->view->title       = $installTitle . $this->lang->package->types->$type . $this->lang->colon . $package;
        $this->view->subtitle    = $this->lang->package->install;

        /* Get the package file name. */
        $packageFile = $this->package->getPackageFile($package);

        if($downLink)
        {
            /* Checking download path. */
            $return = $this->package->checkDownloadPath();
            if($return->result != 'ok')
            {
                $this->view->error = $return->error;
                die($this->display());
            }

            /* Check file exists or not. */
            if(file_exists($packageFile) and $overridePackage == 'no' and md5_file($packageFile) != $md5)
            {
                $overrideLink = inlink('install', "package=$package&downLink=$downLink&md5=$md5&type=$type&overridePackage=yes&ignoreCompatible=$ignoreCompatible&overrideFile=$overrideFile&agreeLicense=$agreeLicense&upgrade=$upgrade");
                $this->view->error = sprintf($this->lang->package->errorPackageFileExists, $packageFile, $overrideLink, $installType);
                die($this->display());
            }

            /* Download the package file. */
            if(!file_exists($packageFile) or ($md5 != '' and md5_file($packageFile) != $md5))  $this->package->downloadPackage($package, helper::safe64Decode($downLink));
            if(!file_exists($packageFile))
            {
                $this->view->error = sprintf($this->lang->package->errorDownloadFailed, $packageFile);
                die($this->display());
            }
            elseif($md5 != '' and md5_file($packageFile) != $md5)
            {
                if(md5_file($packageFile) . '1' != $md5)
                {
                    unlink($packageFile);
                    $this->view->error = sprintf($this->lang->package->errorMd5Checking, $packageFile);
                    die($this->display());
                }
            }
        }

        /* Check the package file exists or not. */
        if(!file_exists($packageFile)) 
        {
            $this->view->error = sprintf($this->lang->package->errorPackageNotFound, $packageFile);
            die($this->display());
        }

        $packageInfo = $this->package->parsePackageCFG($package);

        $type = isset($packageInfo->type) ? $packageInfo->type : 'extension';

        if($type == 'theme')
        {
            $link = helper::createLink('ui','installtheme', "package=$package&downLink=&md5=");    
            $this->locate($link);
        }

        /* Checking the package pathes. */
        $return = $this->package->checkPackagePathes($package, $type);
        if($this->session->dirs2Created == false) $this->session->set('dirs2Created', $return->dirs2Created);    // Save the dirs to be created.
        if($return->result != 'ok')
        {
            $this->view->error = $return->errors;
            die($this->display());
        }

        /* Extract the package. */
        $return = $this->package->extractPackage($package);
        if($return->result != 'ok')
        {
            $this->view->error = sprintf($this->lang->package->errorExtracted, $packageFile, $return->error);
            die($this->display());
        }

        /* Get condition. e.g. chanzhi|depends|conflicts. */
        $condition = $this->package->getCondition($package);
        $installedExts = $this->package->getLocalPackages('installed');

        /* Check version incompatible */
        $incompatible = $condition->chanzhi['incompatible'];
        if($this->package->checkVersion($incompatible))
        {
            $this->view->error = sprintf($this->lang->package->errorIncompatible);
            die($this->display());
        }

        /* Check conflicts. */
        $conflictsResult = $this->package->checkConflicts($condition, $installedExts);
        if($conflictsResult['result'] == 'fail') 
        {
            $this->view->error = $conflictsResult['error'];
            die($this->display());
        }

        /* Check Depends. */
        $depentsResult = $this->package->checkExtRequired($condition->depends, $installedExts);
        if($depentsResult['result'] == 'fail') 
        {
            $this->view->error = $rdepentsResult['error'];
            die($this->display());
        }

        /* Check version compatible. */
        $chanzhiCompatible = $condition->chanzhi['compatible'];
        if(!$this->package->checkVersion($chanzhiCompatible) and $ignoreCompatible == 'no')
        {
            $ignoreLink = inlink('install', "package=$package&downLink=$downLink&md5=$md5&type=$type&overridePackage=$overridePackage&ignoreCompatible=yes&overrideFile=$overrideFile&agreeLicense=$agreeLicense&upgrade=$upgrade");
            $returnLink = inlink('obtain');
            $this->view->error = sprintf($this->lang->package->errorCheckIncompatible, $installType, $ignoreLink, $installType, $returnLink);
            die($this->display());
        }

        /* Check files in the package conflicts with exists files or not. */
        if($overrideFile == 'no')
        {
            $return = $this->package->checkFile($package);
            if($return->result != 'ok')
            {
                $overrideLink = inlink('install', "package=$package&downLink=$downLink&md5=$md5&type=$type&overridePackage=$overridePackage&ignoreCompatible=$ignoreCompatible&overrideFile=yes&agreeLicense=$agreeLicense&upgrade=$upgrade");
                $returnLink   = inlink('obtain');
                $this->view->error = sprintf($this->lang->package->errorFileConflicted, $return->error, $overrideLink, $returnLink);
                die($this->display());
            }
        }

        /* Print the license form. */
        if($agreeLicense == 'no')
        {
            $packageInfo = $this->package->getInfoFromPackage($package);
            $license     = $this->package->processLicense($packageInfo->license);
            $agreeLink   = inlink('install', "package=$package&downLink=$downLink&md5=$md5&type=$type&overridePackage=$overridePackage&ignoreCompatible=$ignoreCompatible&overrideFile=$overrideFile&agreeLicense=yes&upgrade=$upgrade");

            /* Format license if used zpl. */
            if(strtolower($packageInfo->license) == 'zpl')
            {
                $license = sprintf($license, $packageInfo->name, $packageInfo->author, $packageInfo->site);
            }

            $this->view->license   = $license;
            $this->view->author    = $packageInfo->author;
            $this->view->agreeLink = $agreeLink;
            if(isset($license) and $upgrade == 'yes') 
            {
                $this->view->subtitle = sprintf($this->lang->package->upgradeVersion, $installedPackage->version, $packageInfo->version);
            }

            die($this->display());
        }

        /* The preInstall hook file. */
        $hook = $upgrade == 'yes' ? 'preupgrade' : 'preinstall';
        if($preHookFile = $this->package->getHookFile($package, $hook)) include $preHookFile;

        /* Save to database. */
        $this->package->savePackage($package, $type);

        /* Copy files to target directory. */
        $this->view->files = $this->package->copyPackageFiles($package, $type);

        /* Judge need execute db install or not. */
        $data = new stdclass();
        $data->status = 'installed';
        $data->dirs   = $this->session->dirs2Created;
        $data->files  = $this->view->files;
        $data->installedTime = helper::now();
        $this->session->set('dirs2Created', array());   // clean the session.

        /* Execute the install.sql. */
        if($upgrade == 'no' and $this->package->needExecuteDB($package, 'install'))
        {
            $return = $this->package->executeDB($package, 'install');
            if($return->result != 'ok')
            {
                $this->view->error = sprintf($this->lang->package->errorInstallDB, $return->error);
                die($this->display());
            }
        }

        /* Update status, dirs, files and installed time. */
        $this->package->updatePackage($package, $data);
        $this->view->downloadedPackage = !empty($downLink);

        /* The postInstall hook file. */
        $hook = $upgrade == 'yes' ? 'postupgrade' : 'postinstall';
        if($postHookFile = $this->package->getHookFile($package, $hook)) include $postHookFile;

        $this->view->type = $type;
        $this->display();
    }

    /**
     * Uninstall an package.
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function uninstall($package, $confirm = 'no')
    {
        /* Determine whether need to back up. */
        $dbFile = $this->package->getDBFile($package, 'uninstall');
        if($confirm == 'no' and file_exists($dbFile))
        {
            $this->view->title   = $this->lang->package->waring;
            $this->view->confirm = 'no';
            $this->view->code    = $package;
            die($this->display());
        }

        $dependsExts = $this->package->checkDepends($package);
        if($dependsExts)
        {
            $this->view->error = sprintf($this->lang->package->errorUninstallDepends, join(' ', $dependsExts));
            die($this->display());
        }

        if($preUninstallHook = $this->package->getHookFile($package, 'preuninstall')) include $preUninstallHook;

        if(file_exists($dbFile)) $this->view->backupFile = $this->package->backupDB($package);

        $this->package->executeDB($package, 'uninstall');
        $this->package->updatePackage($package, array('status' => 'available'));
        $this->view->removeCommands = $this->package->removePackage($package);
        $this->view->title = $this->lang->package->uninstallFinished;

        if($postUninstallHook = $this->package->getHookFile($package, 'postuninstall')) include $postUninstallHook;
        $this->display();
    }

    /**
     * Activate an package;
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function activate($package, $type = 'extension', $ignore = 'no')
    {
        if($ignore == 'no')
        {
            $return = $this->package->checkFile($package);
            if($return->result != 'ok')
            {
                $ignoreLink = inlink('activate', "package=$package&type=$type&ignore=yes");
                $resetLink  = inlink('browse', 'type=deactivated');
                $this->view->error = sprintf($this->lang->package->errorFileConflicted, $return->error, $ignoreLink, $resetLink);
                die($this->display());
            }
        }

        $this->package->copyPackageFiles($package, $type);
        $this->package->updatePackage($package, array('status' => 'installed'));
        $this->view->title      = $this->lang->package->activateFinished;
        $this->view->position[] = $this->lang->package->activateFinished;
        $this->display();
    }

    /**
     * Deactivate an package
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function deactivate($package)
    {
        $this->package->updatePackage($package, array('status' => 'deactivated'));

        $this->view->title          = $this->lang->package->deactivateFinished;
        $this->view->position[]     = $this->lang->package->deactivateFinished;
        $this->view->removeCommands = $this->package->removePackage($package);
        $this->display();
    }

    /**
     * Upload an package
     * 
     * @param  string $type extension|template
     * @access public
     * @return void
     */
    public function upload($type = 'extension')
    {
        $this->view->canManage = array('result' => 'success');
        if(!$this->loadModel('guarder')->verify()) $this->view->canManage = $this->loadModel('common')->verifyAdmin();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->view->canManage['result'] != 'success') $this->send(array('result' => 'fail', 'message' => sprintf($lang->guarder->okFileVerify, $this->view->canManage['name'], $this->view->canManage['content'])));
            
            if(empty($_FILES))  $this->send(array('result' => 'fail', 'message' => '' ));

            $tmpName  = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $package  = basename($fileName, '.zip');
            move_uploaded_file($tmpName, $this->app->getTmpRoot() . "/package/$fileName");

            $info = $this->package->getInfoFromDB($package);
            $option = (!empty($info) and $info->status == 'installed') ? 'upgrade' : 'install';
            $link = $option == 'install' ? inlink('install', "package=$package&downLink=&md5=&type={$type}") : inlink('upgrade', "package=$package&downLink=&md5=&type={$type}");
            $this->send(array('result' => 'success', 'message' => $this->lang->package->successUploadedPackage, 'locate' => $link));
        }

        $this->view->title = $this->lang->package->upload;
        $this->display();
    }

    /**
     * Erase an package.
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function erase($package)
    {
        $this->view->title          = $this->lang->package->eraseFinished;
        $this->view->position[]     = $this->lang->package->eraseFinished;
        $this->view->removeCommands = $this->package->erasePackage($package);
        $this->display();
    }

    /**
     * Update package.
     * 
     * @param  string $package 
     * @param  string $downLink 
     * @param  string $md5 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function upgrade($package, $downLink = '', $md5 = '', $type = '')
    {
        $this->package->removePackage($package);
        $this->locate(inlink('install', "package=$package&downLink=$downLink&md5=$md5&type=$type&overridePackage=no&ignoreCompatible=yes&overrideFile=no&agreeLicense=no&upgrade=yes"));
    }

    /**
     * Browse the structure of package.
     * 
     * @param  int    $package 
     * @access public
     * @return void
     */
    public function structure($package)
    {
        $package = $this->package->getInfoFromDB($package);
        $this->view->title   = $package->name . '[' . $package->code . '] ' . $this->lang->package->structure;
        $this->view->package = $package;
        $this->display();
    }
}
