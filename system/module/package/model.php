<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class packageModel extends model
{
    /**
     * The api agent(use snoopy).
     * 
     * @var object   
     * @access public
     */
    public $agent;

    /**
     * The api root.
     * 
     * @var string
     * @access public
     */
    public $apiRoot;

    /**
     * The construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->setAgent();
        $this->setApiRoot();
        $this->classFile = $this->app->loadClass('zfile');
    }

    /**
     * Set the api agent.
     * 
     * @access public
     * @return void
     */
    public function setAgent()
    {
        $this->agent = $this->app->loadClass('snoopy');
    }

    /**
     * Set the apiRoot.
     * 
     * @access public
     * @return void
     */
    public function setApiRoot()
    {
        $this->apiRoot = $this->config->package->apiRoot;
    }

    /**
     * Fetch data from an api.
     * 
     * @param  string    $url 
     * @access public
     * @return mixed
     */
    public function fetchAPI($url)
    {
        $url .= '?lang=' . str_replace('-', '_', $this->app->getClientLang()) . '&chanzhiVersion=' . $this->config->version;
        $this->agent->fetch($url);
        $result = json_decode($this->agent->results);

        if(!isset($result->status)) return false;
        if($result->status != 'success') return false;
        if(isset($result->data) and md5($result->data) != $result->md5) return false;
        if(isset($result->data)) return json_decode($result->data);
    }

    /**
     * Get package modules from the api.
     * 
     * @access public
     * @return string|bool
     */
    public function getModulesByAPI()
    {
        $requestType = helper::safe64Encode($this->config->requestType);
        $webRoot     = helper::safe64Encode($this->config->webRoot);
        $apiURL      = $this->apiRoot . 'apiGetmodules-' . $requestType . '-' . $webRoot . '.json';

        $data = $this->fetchAPI($apiURL);
        if(isset($data->modules)) return $data->modules;
        return false;
    }

    /**
     * Get packages by some condition.
     * 
     * @param  string    $type 
     * @param  mixed     $param 
     * @access public
     * @return array|bool
     */
    public function getPackagesByAPI($type, $param, $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $apiURL = $this->apiRoot . "apiGetExtensions-$type-$param-$recTotal-$recPerPage-$pageID.json";
        $data   = $this->fetchAPI($apiURL);

        if(isset($data->extensions))
        {
            foreach($data->extensions as $package)
            {
                $package->currentRelease = isset($package->compatibleRelease) ? $package->compatibleRelease : $package->latestRelease;
                $package->currentRelease->compatible = isset($package->currentRelease);
            }
            return $data;
        }
        return false;
    }

    /**
     * Get versions for some packages.
     * 
     * @param  string    $packages 
     * @access public
     * @return array|bool
     */
    public function getVersionsByAPI($packages)
    {
        $packages = helper::safe64Encode($packages);
        $apiURL = $this->apiRoot . 'apiGetVersions-' . $packages . '.json';
        $data = $this->fetchAPI($apiURL);
        if(isset($data->versions)) return (array)$data->versions;
        return false;
    }

    /**
     * Check incompatible package
     * 
     * @param  array    $versions 
     * @access public
     * @return array
     */
    public function checkIncompatible($versions)
    {
        $apiURL = $this->apiRoot . 'apiCheckIncompatible-' . helper::safe64Encode(json_encode($versions)) . '.json';
        $data = $this->fetchAPI($apiURL);
        if(isset($data->incompatibleExts)) return (array)$data->incompatibleExts;
        return array();

    }

    /**
     * Download an package.
     * 
     * @param  string    $package 
     * @param  string    $downLink 
     * @access public
     * @return void
     */
    public function downloadPackage($package, $downLink)
    {
        $packageFile = $this->getPackageFile($package);
        $this->agent->fetch($downLink);
        file_put_contents($packageFile, $this->agent->results);
    }

    /**
     * Get packages by status.
     * 
     * @param  string    $status 
     * @access public
     * @return array
     */
    public function getLocalPackages($status, $type = 'ext')
    {
        $packages = $this->dao->setAutoLang(false)
            ->select('*')->from(TABLE_PACKAGE)
            ->where('status')->eq($status)
            ->beginIf($type == 'theme')->andWhere('type')->eq('theme')->fi()
            ->beginIf($type != 'theme')->andWhere('type')->ne('theme')->fi()
            ->fetchAll('code');
        foreach($packages as $package)
        {
            if($package->site and stripos(strtolower($package->site), 'http') === false) $package->site = 'http://' . $package->site;
        }
        return $packages;
    }

    /**
     * Get package info from database.
     * 
     * @param  string    $package 
     * @access public
     * @return object
     */
    public function getInfoFromDB($package)
    {
        return $this->dao->setAutoLang(false)->select('*')->from(TABLE_PACKAGE)->where('code')->eq($package)->fetch();
    }

    /**
     * Get info of an package from the package file.
     * 
     * @param  string    $package 
     * @param  string $type 
     * @access public
     * @return object
     */
    public function getInfoFromPackage($package, $type = 'ext')
    {
        /* Init the data. */
        $data = new stdclass();
        $data->name                = $package;
        $data->code                = $package;
        $data->version             = 'unknown';
        $data->author              = 'unknown';
        $data->desc                = $package;
        $data->site                = 'unknown';
        $data->license             = 'unknown';
        $data->chanzhiCompatible   = '';
        $data->type                = '';
        $data->depends             = '';
        $data->templateCompatible  = '';

        $info = $this->parsePackageCFG($package, $type);
        foreach($info as $key => $value) if(isset($data->$key)) $data->$key = $value;

        if(isset($info->chanzhiversion))        $data->chanzhiCompatible = $info->chanzhiversion;
        if(isset($info->chanzhi['compatible'])) $data->chanzhiCompatible = $info->chanzhi['compatible'];
        if(isset($info->depends))               $data->depends           = json_encode($info->depends);

        return $data;
    }

    /**
     * Parse package's config file.
     * 
     * @param  string    $package 
     * @param  string    $type 
     * @access public
     * @return object
     */
    public function parsePackageCFG($package, $type = 'ext')
    {
        $info = new stdclass();

        /* First, try ini file. before 2.5 version. */
        $infoFile = "{$type}/$package/doc/copyright.txt";
        if(file_exists($infoFile)) return (object)parse_ini_file($infoFile);

        /* Try the yaml of current lang, then try en. */
        $lang = $this->app->getClientLang();
        $infoFile = "{$type}/$package/doc/$lang.yaml";

        if(!file_exists($infoFile)) $infoFile = "ext/$package/doc/en.yaml";
        if(!file_exists($infoFile)) return $info;

        /* Load the yaml file and parse it into object. */
        $this->app->loadClass('spyc', true);
        $info = (object)spyc_load(file_get_contents($infoFile));

        if(isset($info->releases))
        {
            krsort($info->releases);
            $info->version = key($info->releases);
            foreach($info->releases[$info->version] as $key => $value) $info->$key = $value;
        }
        return $info;
    }

    /**
     * Get the full path of the zip file of a package. 
     * 
     * @param  string    $package 
     * @access public
     * @return string
     */
    public function getPackageFile($package)
    {
        return $this->app->getTmpRoot() . 'package/' . $package . '.zip';
    }

    /**
     * Get pathes from an package package.
     * 
     * @param  string    $package 
     * @access public
     * @return array
     */
    public function getPathesFromPackage($package)
    {
        $pathes = array();
        $packageFile = $this->getPackageFile($package);

        /* Get files from the package file. */
        $this->app->loadClass('pclzip', true);
        $zip   = new pclzip($packageFile);
        $files = $zip->listContent();
        if($files)
        {
            foreach($files as $file)
            {
                $file = (object)$file;
                if($file->folder) continue;
                $file->filename = substr($file->filename, strpos($file->filename, '/') + 1);
                $pathes[] = dirname($file->filename);
            }
        }

        /* Append the pathes to stored the extracted files. */
        $pathes[] = "system/module/package/ext/";
        $pathes[] = "system/module/ui/theme/";
        $pathes[] = "www/template/";

        return array_unique($pathes);
    }

    /**
     * Get all files from a package.
     * 
     * @param  string    $package 
     * @access public
     * @return array
     */
    public function getFilesFromPackage($package)
    {
        $packageDir = "ext/$package/";
        $files = $this->classFile->readDir($packageDir, array('db', 'doc'));
        return $files;
    }

    /**
     * Get the package's condition. 
     * 
     * @param  string    $package 
     * @param  string    $type ext|theme
     * @access public
     * @return object
     */
    public function getCondition($package, $type = 'ext')
    {
        $info      = $this->parsePackageCFG($package, $type);
        $condition = new stdclass();

        $condition->chanzhi   = array('compatible' => '', 'incompatible' => '');
        $condition->depends   = '';
        $condition->conflicts = '';

        if(isset($info->chanzhi))       $condition->chanzhi   = $info->chanzhi;
        if(isset($info->depends))       $condition->depends   = $info->depends;
        if(isset($info->conflicts))     $condition->conflicts = $info->conflicts;

        if(isset($info->chanzhiVersion)) $condition->chanzhi['compatible'] = $info->chanzhiVersion;
        if(isset($info->chanzhiversion)) $condition->chanzhi['compatible'] =  $info->chanzhiversion;

        return $condition;
    }

    /**
     * Process license. If is opensource return the full text of it.
     * 
     * @param  string    $license 
     * @access public
     * @return string
     */
    public function processLicense($license)
    {
        if(strlen($license) > 10) return $license;    // more then 10 letters, not zpl, gpl, lgpl, apache, bsd or mit.

        $licenseFile = dirname(__FILE__) . '/license/' . strtolower($license) . '.txt';
        if(file_exists($licenseFile)) return file_get_contents($licenseFile);

        return $license;
    }

    /**
     * Get hook file for install or uninstall.
     * 
     * @param  string    $package 
     * @param  string    $hook      preinstall|postinstall|preuninstall|postuninstall 
     * @access public
     * @return string|bool
     */
    public function getHookFile($package, $hook)
    {
        $hookFile = "ext/$package/hook/$hook.php";
        if(file_exists($hookFile)) return $hookFile;
        return false;
    }

    /**
     * Get the install db file.
     * 
     * @param  string    $package 
     * @param  string    $method 
     * @access public
     * @return string
     */
    public function getDBFile($package, $method = 'install', $type = 'ext')
    {
        return "$type/$package/db/$method.sql";
    }

    /**
     * Check the download path.
     * 
     * @access public
     * @return object   the check result.
     */
    public function checkDownloadPath()
    {
        /* Init the return. */
        $return = new stdclass();
        $return->result = 'ok';
        $return->error  = '';

        $tmpRoot = $this->app->getTmpRoot();
        $downloadPath = $tmpRoot . 'package';

        if(!is_dir($downloadPath))
        {
            if(is_writable($tmpRoot))
            {
                mkdir($downloadPath);
            }
            else
            {
                $return->result = 'fail';
                $return->error  = sprintf($this->lang->package->errorDownloadPathNotFound, $downloadPath, $downloadPath);
            }
        }
        elseif(!is_writable($downloadPath))
        {
            $return->result = 'fail';
            $return->error  = sprintf($this->lang->package->errorDownloadPathNotWritable, $downloadPath, $downloadPath);
        }
        return $return;
    }

    /**
     * Check Conflicts.
     * 
     * @param  object    $condition 
     * @param  array     $installedExts 
     * @access public
     * @return viod
     */
    public function checkConflicts($condition, $installedExts)
    {
        /* Check conflicts. */
        $conflicts = $condition->conflicts;
        if($conflicts)
        {
            $conflictsExt = '';
            foreach($conflicts as $code => $limit)
            {
                if(isset($installedExts[$code]))
                {
                    if($this->package->compare4Limit($installedExts[$code]->version, $limit)) $conflictsExt .= $installedExts[$code]->name . " ";
                }
            }

            if($conflictsExt)
            {
                return array('result' => 'fail', 'error' => sprintf($this->lang->package->errorConflicts, $conflictsExt));
            }
        }
        return array('result' => 'success');
    }

    /**
     * check ExtRequired
     * 
     * @param  array    $depends 
     * @param  array    $installedExts 
     * @access public
     * @return array
     */
    public function checkExtRequired($depends, $installedExts)
    {
        if($depends)
        {
            $dependsExt = '';
            foreach($depends as $code => $limit)
            {
                $noDepends = false;
                if(isset($installedExts[$code]))
                {
                    if($this->package->compare4Limit($installedExts[$code]->version, $limit, 'noBetween'))$noDepends = true;
                }
                else
                {
                    $noDepends = true;
                }

                $extVersion = '';
                if($limit != 'all')
                {
                    $extVersion .= '(';
                    if(!empty($limit['min'])) $extVersion .= '>=v' . $limit['min'];
                    if(!empty($limit['max'])) $extVersion .= ' <=v' . $limit['max'];
                    $extVersion .=')';
                }
                if($noDepends)$dependsExt .= $code . $extVersion . ' ' . html::a(inlink('obtain', 'type=bycode&param=' . helper::safe64Encode($code)), $this->lang->package->installExt, '_blank') . '<br />';
            }

            if($noDepends)
            {
                return array('result' => 'fail', 'error' => sprintf($this->lang->package->errorDepends, $dependsExt));
            }
            return array('result' => 'success');
        }
        return array('result' => 'success');
    }

    /**
     * Check package files.
     * 
     * @param  string    $package 
     * @access public
     * @return object    the check result.
     */
    public function checkPackagePathes($package, $type = '')
    {
        $return = new stdclass();
        $return->result        = 'ok';
        $return->errors        = '';
        $return->mkdirCommands = '';
        $return->chmodCommands = '';
        $return->dirs2Created  = array();

        $appRoot = $this->app->getAppRoot();
        $pathes  = $this->getPathesFromPackage($package);

        $groupedPaths = array();
        foreach($pathes as $path)
        {
            if(substr($path, 0, 6) == 'system') $groupedPaths['system'][]   = $path;
            if(substr($path, 0, 3) == 'www')    $groupedPaths['www'][]      = $path;
            if($type == 'template' and (substr($path, 0, 3) != 'www') and (substr($path, 0, 6) != 'system')) $groupedPaths['template'][] = $path;
        }

        foreach($groupedPaths as $baseDir => $pathes)
        {
            foreach($pathes as $path)
            {
                if($path == 'db' or $path == 'doc' or $path == 'hook') continue;
                if($baseDir == 'system') $path = dirname($appRoot) . DS . $path;
                if($baseDir == 'www')    $path = $this->app->getWwwRoot() . substr($path, 4);
                if($baseDir == 'template' and $type == 'template')  $path = $this->app->getWwwRoot() . 'template' . DS . $package . DS . $path;

                if(is_dir($path))
                {
                    if(!is_writable($path))
                    {
                        $return->errors .= sprintf($this->lang->package->errorTargetPathNotWritable, $path) . '<br />';
                        $return->chmodCommands .= "sudo chmod -R 777 $path<br />";
                    }
                }
                else
                {
                    if(!@mkdir($path, 0755, true))
                    {
                        $return->errors .= sprintf($this->lang->package->errorTargetPathNotExists, $path) . '<br />';
                        $return->mkdirCommands .= "mkdir -p $path<br />";
                        $return->chmodCommands .= "sudo chmod -R 777 $path<br />";
                    }
                    $return->dirs2Created[] = $path;
                }
            }
        }

        if($return->errors) $return->result = 'fail';
        $return->mkdirCommands = str_replace('/', DIRECTORY_SEPARATOR, $return->mkdirCommands);
        $return->errors .= $this->lang->package->executeCommands . $return->mkdirCommands;
        if(PHP_OS == 'Linux') $return->errors .= $return->chmodCommands;
        return $return;
    }

    /**
     * Check the package's version is compatibility for chanzhi version
     * 
     * @param  string    $version 
     * @access public
     * @return bool
     */
    public function checkVersion($version)
    {
        if($version == 'all') return true;
        $version = explode(',', $version);
        if(in_array($this->config->version, $version)) return true;
        return false;
    }

    /**
     * Check files in the package conflicts with exists files or not.
     * 
     * @param  string    $package 
     * @param  string    $type
     * @param  bool      $isCheck
     * @access public
     * @return object
     */
    public function checkFile($package)
    {
        $return = new stdclass();
        $return->result = 'ok';
        $return->error  = '';

        $packageFiles = $this->getFilesFromPackage($package);
        $appRoot = $this->app->getAppRoot();
        foreach($packageFiles as $packageFile)
        {
            $compareFile = $appRoot . str_replace(realpath("ext/$package") . '/', '', $packageFile);
            if(!file_exists($compareFile)) continue;
            if(md5_file($packageFile) != md5_file($compareFile)) $return->error .= $compareFile . '<br />';
        }

        if($return->error != '') $return->result = 'fail';
        return $return;
    }

    /**
     * Extract an package.
     * 
     * @param  string    $package 
     * @access public
     * @return object
     */
    public function extractPackage($package, $type = 'ext') 
    {
        $return = new stdclass();
        $return->result = 'ok';
        $return->error  = '';

        /* try remove old extracted files. */
        $packagePath = "{$type}/$package";
        if(is_dir($packagePath)) $this->classFile->removeDir($packagePath);

        /* Extract files. */
        $packageFile = $this->getPackageFile($package);
        $this->app->loadClass('pclzip', true);
        $zip = new pclzip($packageFile);
        $files = $zip->listContent();
        $removePath = $files[0]['filename'];
        if($zip->extract(PCLZIP_OPT_PATH, $packagePath, PCLZIP_OPT_REMOVE_PATH, $removePath) == 0)
        {
            $return->result = 'fail';
            $return->error  = $zip->errorInfo(true);
        }
        return $return;
    }

    /**
     * Copy package files. 
     * 
     * @param  type    $package 
     * @access public
     * @return array
     */
    public function copyPackageFiles($package, $type = 'ext')
    {
        $appRoot    = $this->app->getAppRoot();
        if($type != 'theme') $type = 'ext';
        $packageDir = $type . DS . $package . DS;
        if($type == 'template') $packageDir = 'ext' . DS . $package . DS;

        $systemPathes   = array();
        $wwwPathes      = array();
        $templatePathes = array();

        if(is_dir($packageDir . 'system' . DS)) $systemPathes   = scandir($packageDir . 'system' . DS);
        if(is_dir($packageDir . 'www' . DS))    $wwwPathes      = scandir($packageDir . 'www' . DS);
        if($type == 'template')                 $templatePathes = scandir($packageDir);

        $copiedFiles         = array();
        $copiedSystemFiles   = array();
        $copiedWwwFiles      = array();
        $copiedTemplateFiles = array();

        foreach($systemPathes as $path)
        {
            if($path == 'db' or $path == 'doc' or $path == 'hook' or $path == '..' or $path == '.') continue;
            $copiedSystemFiles = $copiedSystemFiles + $this->classFile->copyDir($packageDir . DS . 'system' . DS . $path, $appRoot . $path);
        }

        foreach($wwwPathes as $path)
        {
            if($path == '..' or $path == '.') continue;
            $copiedWwwFiles = $copiedWwwFiles + $this->classFile->copyDir($packageDir . 'www' . DS . $path, $this->app->getWwwRoot() . $path);
        }

        foreach($templatePathes as $path)
        {
            if($path == '..' or $path == '.') continue;
            $copiedTemplateFiles = $copiedTemplateFiles + $this->classFile->copyDir($packageDir . $path, $this->app->getWwwRoot() . 'template' . DS . $package . DS . $path);
        }

        $copiedFiles = $copiedSystemFiles + $copiedWwwFiles + $copiedTemplateFiles;

        foreach($copiedFiles as $key => $copiedFile)
        {
            $copiedFiles[$copiedFile] = md5_file($copiedFile);
            unset($copiedFiles[$key]);
        }

        return $copiedFiles;
    }

    /**
     * Remove an package.
     * 
     * @param  string    $package 
     * @access public
     * @return array     the remove commands need executed manually.
     */
    public function removePackage($package)
    {
        $package = $this->getInfoFromDB($package);
        if($package->type == 'patch') return true;
        $dirs  = json_decode($package->dirs);
        $files = json_decode($package->files);
        $appRoot = $this->app->getAppRoot();
        $wwwRoot = $this->app->getWwwRoot();
        $removeCommands = array();

        /* Remove files first. */
        if($files)
        {
            foreach($files as $file => $savedMD5)
            {
                $appFile = $appRoot . $file;
                $wwwFile = $wwwRoot . $file;
                if(file_exists($appFile)) $file = $appFile;
                if(file_exists($wwwFile)) $file = $wwwFile;

                if(!file_exists($file)) continue;

                if(md5_file($file) != $savedMD5)
                {
                    $removeCommands[] = PHP_OS == 'Linux' ? "rm -fr $file #changed" : str_replace('/', '\\', "del $file &rem changed");
                }
                elseif(!@unlink($file))
                {
                    $removeCommands[] = PHP_OS == 'Linux' ? "rm -fr $file" : str_replace('/', '\\', "del $file");
                }
            }
        }

        /* Then remove dirs. */
        if($dirs)
        {
            rsort($dirs);    // remove from the lower level directory.
            foreach($dirs as $dir)
            {
                if(!@rmdir($dir)) $removeCommands[] = "rmdir $dir";
            }
        }

        /* Clean model cache files. */
        $this->cleanModelCache();

        return $removeCommands;
    }

    /**
     * Clean model cache files.
     * 
     * @access public
     * @return void
     */
    public function cleanModelCache()
    {
        $modelCacheFiles = glob($this->app->getTmpRoot() . 'model' . DS . $this->app->siteCode{0} . DS . $this->app->siteCode . DS . '*');
        foreach($modelCacheFiles as $cacheFile) @unlink($cacheFile);
    }

    /**
     * Erase an package's package file.
     * 
     * @param  string    $package 
     * @access public
     * @return array     the remove commands need executed manually.
     */
    public function erasePackage($package)
    {
        $removeCommands = array();

        $this->dao->setAutoLang(false)->delete()->from(TABLE_PACKAGE)->where('code')->eq($package)->exec();

        /* Remove the zip file. */
        $packageFile = $this->getPackageFile($package);
        if(!file_exists($packageFile)) return false;
        if(file_exists($packageFile) and !@unlink($packageFile))
        {
            $removeCommands[] = PHP_OS == 'Linux' ? "rm -fr $packageFile" : "del $packageFile";
        }

        /* Remove the extracted files. */
        $extractedDir = realpath("ext/$package");
        if($extractedDir != '/' and !$this->classFile->removeDir($extractedDir))
        {
            $removeCommands[] = PHP_OS == 'Linux' ? "rm -fr $extractedDir" : "rmdir $extractedDir /s";
        }

        return $removeCommands;
    }

    /**
     * Judge need execute db install or not.
     * 
     * @param  string    $package 
     * @param  string    $method 
     * @access public
     * @return bool
     */
    public function needExecuteDB($package, $method = 'install')
    {
        return file_exists($this->getDBFile($package, $method));
    }

    /**
     * Install the db.
     * 
     * @param  int    $package 
     * @access public
     * @return object
     */
    public function executeDB($package, $method = 'install', $type = 'ext')
    {
        $return = new stdclass();
        $return->result = 'ok';
        $return->error  = '';

        $dbFile = $this->getDBFile($package, $method, $type);
        if(!file_exists($dbFile)) return $return;

        $sqls = file_get_contents($this->getDBFile($package, $method, $type));
        $sqls = explode(';\n', $sqls);

        foreach($sqls as $sql)
        {
            $sql = trim($sql);

            if(empty($sql)) continue;
            $sql = str_replace('eps_', $this->config->db->prefix, $sql);
            try
            {
                $this->dbh->query($sql);
            }
            catch (PDOException $e) 
            {
                $return->error .= '<p>' . $e->getMessage() . "<br />THE SQL IS: $sql</p>";
            }
        }
        if($return->error) $return->result = 'fail';
        return $return;
    }

    /**
     * Backup db when uninstall package. 
     * 
     * @param  string    $package 
     * @access public
     * @return bool|string
     */
    public function backupDB($package)
    {
        $zdb = $this->app->loadClass('zdb');

        $sqls = file_get_contents($this->getDBFile($package, 'uninstall'));
        $sqls = explode(';', $sqls);

        /* Get tables for backup. */
        $backupTables = array();
        foreach($sqls as $sql)
        {
            $sql = str_replace('eps_', $this->config->db->prefix, $sql);
            $sql = preg_replace('/IF EXISTS /i', '', trim($sql));
            if(preg_match('/TABLE +`?([^` ]*)`?/i', $sql, $out))
            {
                if(!empty($out[1])) $backupTables[$out[1]] = $out[1];
            }
        }

        /* Back up database. */
        if($backupTables)
        {
            $backupFile = $this->app->getTmpRoot() . $package . '.' . date('Ymd') . '.sql';
            $result     = $zdb->dump($backupFile, $backupTables);
            if($result->result) return $backupFile;
            return false; 
        }
        return false; 
    }

    /**
     * Save the package to database.
     * 
     * @param  string    $package     the package code
     * @param  string    $type          the package type
     * @access public
     * @return void
     */
    public function savePackage($package, $type)
    {
        $code    = $package;
        $package = $this->getInfoFromPackage($package, $type);
        $package->status = 'available';
        $package->code   = $code;
        $package->lang   = 'all';
        $package->type   = empty($type) ? $package->type : $type;

        $this->dao->replace(TABLE_PACKAGE)->data($package)->exec();
    }

    /**
     * Update an package.
     * 
     * @param  string    $package 
     * @param  string    $status 
     * @param  array     $files 
     * @access public
     * @return void
     */
    public function updatePackage($package, $data)
    {
        $data = (object)$data;
        $appRoot = $this->app->getAppRoot();
        $wwwRoot = $this->app->getWwwRoot();

        if(isset($data->dirs))
        {
            if($data->dirs)
            {
                foreach($data->dirs as $key => $dir)
                {
                    $data->dirs[$key] = str_replace($appRoot, '', $dir);
                }
            }
            $data->dirs = json_encode($data->dirs);
        }

        if(isset($data->files))
        {
            foreach($data->files as $fullFilePath => $md5)
            {
                if(strpos($fullFilePath, $appRoot) !== false) $relativeFilePath = str_replace($appRoot, '', $fullFilePath);
                if(strpos($fullFilePath, $wwwRoot) !== false) $relativeFilePath = str_replace($wwwRoot, '', $fullFilePath);

                $data->files[$relativeFilePath] = $md5;
                unset($data->files[$fullFilePath]);
            }
            $data->files = json_encode($data->files);
        }
        return $this->dao->setAutoLang(false)->update(TABLE_PACKAGE)->data($data)->where('code')->eq($package)->exec();
    }

    /**
     * Check depends package.
     * 
     * @param  string    $package 
     * @access public
     * @return array
     */
    public function checkDepends($package)
    {
        $result      = array();
        $packageInfo = $this->dao->setAutoLang(false)->select('*')->from(TABLE_PACKAGE)->where('code')->eq($package)->fetch();
        $dependsExts = $this->dao->setAutoLang(false)->select('*')->from(TABLE_PACKAGE)->where('depends')->like("%$package%")->andWhere('status')->ne('available')->fetchAll();
        if($dependsExts)
        {
            foreach($dependsExts as $dependsExt)
            {
                $depends = json_decode($dependsExt->depends, true);
                if($this->compare4Limit($packageInfo->version, $depends[$package])) $result[] = $dependsExt->name;
            }
        }
        return $result;
    }

    /**
     * Compare for limit data.
     * 
     * @param  string $version 
     * @param  array  $limit 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function compare4Limit($version, $limit, $type = 'between')
    {
        $result = false;
        if(empty($limit)) return true;

        if($limit == 'all')
        {
            $result = true;
        }
        else
        {
            if(!empty($limit['min']) and $version >= $limit['min']) $result = true;
            if(!empty($limit['max']) and $version <= $limit['max']) $result = true;
            if(!empty($limit['max']) and $version > $limit['max'] and $result) $result = false;
        }

        if($type != 'between') return !$result;
        return $result;
    }

    /**
     * Fix theme code.
     * 
     * @param  string    $package 
     * @param  array     $themes 
     * @access public
     * @return void
     */
    public function fixThemeCode($package, $themes)
    {
        $themeInfo = $this->parsePackageCFG($package, 'theme');
        $themeInfo->templateCompatible = $themeInfo->template;

        $code       = $themeInfo->code;
        $renameCode = isset($themes[$themeInfo->code]);
        if($renameCode)
        {
            $i = 1;
            while(isset($themes[$themeInfo->code . '_' . $i])) $i ++ ;
            $newCode = $themeInfo->code . '_' . $i;
        }
        else
        {
            $newCode = $themeInfo->code;
        }

        $themeInfo->code = $newCode;
        $newPackage = $newCode;

        /* Replace codofix in db file with new newCode. */
        $dbFile  = $this->getDBFile($package, 'install', 'theme');
        $content = file_get_contents($dbFile); 
        $content = str_replace('THEME_CODEFIX', $newCode, $content);
        file_put_contents($dbFile, $content);

        $hookFiles = glob("./theme/{$package}/www/theme/{$themeInfo->template}/{$code}/*.php");
        if(!$renameCode and !empty($hookFiles))
        {
            foreach($hookFiles as $hookFile)
            {
                $hookCode = file_get_contents($hookFile);
                $hookCode = str_replace('_THEME_CODEFIX_', $code, $hookCode);
                file_put_contents($hookFile, $hookCode);
            }
        }

        if($renameCode)
        {
            /* Write new newCode to yaml file. */
            $yaml     = $this->app->loadClass('spyc')->dump($themeInfo);      
            $lang     = $this->app->getClientLang();
            $infoFile = "theme/$package/doc/$lang.yaml";
            file_put_contents($infoFile, $yaml);

            /* Change code in config file. */
            $configCode = file_get_contents("./theme/{$package}/system/module/ui/ext/config/{$code}.php");
            $configCode = str_replace('$this->config->ui->themes["' . $code . '"] = ', '$this->config->ui->themes["' . $newCode . '"] = ', $configCode);
            file_put_contents("./theme/{$package}/system/module/ui/ext/config/{$code}.php", $configCode);

            /* Change code in hook file. */
            if(file_exists($hookFile))
            {
                $hookCode = file_get_contents($hookFile);
                $hookCode = str_replace('_THEME_CODEFIX_', $newCode, $hookCode);
                file_put_contents("./theme/{$package}/system/module/ui/ext/model/{$themeInfo->template}.{$newCode}.theme.php", $hookCode);
            }

            /* Rename files named by old newCode. */
            $files2Move = array();
            $files2Move["./theme/{$package}/www/data/css/{$themeInfo->template}_{$code}.css"] = "./theme/{$package}/www/data/css/{$themeInfo->template}_{$newCode}.css";
            $files2Move["./theme/{$package}/www/data/source/{$themeInfo->template}/{$code}"]  = "./theme/{$package}/www/data/source/{$themeInfo->template}/{$newCode}";
            $files2Move["./theme/{$package}/system/module/ui/ext/config/{$code}.php"]         = "./theme/{$package}/system/module/ui/ext/config/{$newCode}.php";
            $files2Move["./theme/{$package}/www/theme/{$themeInfo->template}/{$code}"]        = "./theme/{$package}/www/theme/{$themeInfo->template}/{$newCode}";
            foreach($files2Move as $oldFile => $newFile)
            {
                if(is_dir($oldFile))
                {
                    rename($oldFile, $newFile);
                }
            }
        }

        if($renameCode) 
        {
            $this->classFile->copyDir("theme/{$package}", "theme/{$newPackage}");
            $this->classFile->removeDir("theme/{$package}");
        }
        return $newPackage;
    }

    /**
     * Merge blocks.
     * 
     * @access public
     * @return void
     */
    public function mergeBlocks($packageInfo)
    {
        $importedBlocks = $this->dao->setAutoLang(false)->select('*')->from(TABLE_BLOCK)->where('lang')->eq('lang')->fetchAll('originID');

        /* Fix category and theme code. */
        foreach($importedBlocks as $block)
        {
            $content = json_decode($block->content);
            if(is_object($content))
            {
                if(isset($content->category)) $content->category = 0;
                if(isset($content->custom->{$packageInfo->theme}))
                { 
                    $custom = $content->custom->{$packageInfo->theme};
                    $content->custom = new stdclass();
                    $content->custom->{$packageInfo->code} = $custom;
                }

                $block->content = json_encode($content);
            }

            $this->dao->setAutoLang(false)->replace(TABLE_BLOCK)->data($block)->exec();
        }
 
        $blocks2Merge  = $this->post->blocks2Merge;
        $blocks2Create = $this->post->blocks2Create;
        $oldBlocks = $this->dao->select('*')->from(TABLE_BLOCK)->where('id')->in(array_values($blocks2Merge))->fetchAll('id');

        $blocks2Delete  = array();
        $blockRelations = array();

        /* Merge imported css and js to old block. */
        foreach($blocks2Merge as $originID => $blockID)
        {
            $imported = zget($importedBlocks, $originID, '');
            if(empty($imported)) continue;
            
            /* Use self id as default target to replace. */
            $blockRelations[$originID] = $imported->id;

            if($blockID == 0) continue;
            if(!isset($oldBlocks[$blockID])) continue;

            $old = zget($oldBlocks, $blockID, '');
            
            $blockRelations[$originID] = $blockID;
            $blocks2Delete[] = $imported->id;

            if(!is_object($old->content)) $old->content = json_decode($old->content); 
            if(!is_object($imported->content)) $imported->content = json_decode($imported->content); 

            if(isset($imported->content->custom))
            {
                if(isset($imported->content->custom->{$packageInfo->code}))
                {
                    if(!is_object($old->content)) $old->content = new stdclass();
                    if(!isset($old->content->custom) or !is_object($old->content->custom)) $old->content->custom = new stdclass();
                    $old->content->custom->{$packageInfo->code} = zget($imported->content->custom, $packageInfo->theme);
                    $old->content = json_encode($old->content);
                    $this->dao->setAutoLang(false)->replace(TABLE_BLOCK)->data($imported)->exec();
                }
            }
        }

        /* Replace old blockID in layout data with selected old blockID. */
        $layouts = $this->dao->setAutoLang(false)->select('*')->from(TABLE_LAYOUT)->where('template')->eq($packageInfo->template)->andWhere('plan')->eq('plan')->fetchAll();
        foreach($layouts as $layout)
        {
            $blocks = json_decode($layout->blocks);

            if(!empty($blocks))
            {
                foreach($blocks as $block) 
                {
                    if(!empty($block->children))
                    {
                        foreach($block->children as $child) $child->id =  zget($blockRelations, $child->id);
                    }
                    else
                    {
                        $block->id = zget($blockRelations, $block->id);
                    }
                }
            }

            $layout->blocks = json_encode($blocks);
            $this->dao->setAutoLang(false)->replace(TABLE_LAYOUT)->data($layout)->exec();
        }
        if(!empty($blocks2Delete)) $this->dao->setAutoLang(false)->delete()->from(TABLE_BLOCK)->where('id')->in($blocks2Delete)->exec();

        /* Fix blockID selector in css and js. */
        krsort($blockRelations);
        foreach($blockRelations as $originID => $blockID)
        {
            $this->dao->setAutoLang(false)->update(TABLE_BLOCK)
                ->set("content = replace(content, '#block{$originID}', '#block{$blockID}')")
                ->where('originID')->ne('0')
                ->exec();

            $this->dao->setAutoLang(false)->update(TABLE_CONFIG)
                ->set("value = replace(value, '#block{$originID}', '#block{$blockID}')")
                ->where('lang')->eq('lang')->exec();
        }

        $this->dao->setAutoLang(false)->update(TABLE_BLOCK)->set('originID')->eq('0')->exec();

        return true;
    }

    /**
     * Fix lang field of data imported.
     * 
     * @access public
     * @return void
     */
    public function fixLang()
    {
        $this->dao->setAutoLang(false)->delete()->from(TABLE_CONFIG)->where('`key`')->eq('custom')->andWhere('lang')->eq('lang')->exec();
        
        /* Copy config data to all languages.*/
        $configs = $this->dao->setAutoLang(false)->select('*')->from(TABLE_CONFIG)->where('lang')->eq('lang')->fetchAll();
        foreach($this->config->langs as $lang)
        {
            foreach($configs as $config)
            {
                unset($config->id);
                $config->lang = $lang;
                $this->dao->replace(TABLE_CONFIG)->data($config)->exec();
            }
        }
        $this->dao->setAutoLang(false)->delete()->from(TABLE_CONFIG)->where('lang')->eq('lang')->exec();

        $tables = array(TABLE_BLOCK, TABLE_LAYOUT, TABLE_FILE);
        foreach($tables as $table) $this->dao->setAutoLang(false)->update($table)->set('lang')->eq($this->app->getClientLang())->where('lang')->eq('lang')->exec();
    }

    /**
     * Fix layout data.
     * 
     * @param  object    $package 
     * @access public
     * @return void
     */
    public function fixLayout($package)
    {
        $plan = new stdclass();
        $plan->name  = $package->name;
        $plan->type  = 'layout_' . $package->template;
        $plan->grade = 0;

        $this->dao->insert(TABLE_CATEGORY)->data($plan)->exec();
        $planID = $this->dao->lastInsertID();

        $this->dao->setAutoLang(false)->update(TABLE_LAYOUT)
            ->set('plan')->eq($planID)
            ->set('lang')->eq($this->app->getClientLang())
            ->where('plan')->eq('plan')
            ->exec();

        $this->loadModel('block')->setPlan($planID, $package->template, $package->code);
        return true;
    }

    /**
     * Fix slides data.
     * 
     * @param  int    $package 
     * @access public
     * @return void
     */
    public function fixSlides($package)
    {
        $importedSlides = glob('theme' . DS . $package . DS . 'www' . DS . 'data' . DS . 'slidestmp' . DS . '*');
        $importedGroups = $this->dao->select('`alias`,id')->from(TABLE_CATEGORY)->where('type')->eq('tmpSlide')->fetchPairs();
        foreach($importedSlides as $slide)
        {
            $slideInfo = pathinfo($slide);
            $basename  = $slideInfo['basename'];
            list($group, $fileID) = explode('_', $slideInfo['filename']);

            $newGroup = zget($importedGroups, $group);
            $newFile  = $this->app->getWwwRoot() . 'data' . DS . 'slides' . DS . $newGroup . '_' . $fileID . '.' . $slideInfo['extension'];
            rename($slide, $newFile);
            $this->dao->setAutoLang(false)->update(TABLE_SLIDE)->set('group')->eq($newGroup)->where('`group`')->eq($group)->andWhere('lang')->eq('imported')->exec();
            $this->dao->setAutoLang(false)->update(TABLE_SLIDE)->set("image")->eq("/data/slides/{$newGroup}_{$fileID}.{$slideInfo['extension']}")->where('image')->like("%{$slideInfo['basename']}")->andWhere('lang')->eq('imported')->exec();
            $this->dao->update(TABLE_BLOCK)->set('content')->eq(json_encode(array("group" => $newGroup)))->where('originID')->ne('0')->andWhere('type')->eq('slide')->andWhere('content')->like("%\"{$group}\"%")->exec();

            $this->dao->setAutoLang(false)->update(TABLE_FILE)->set("pathname")->eq("slides/{$newGroup}_{$fileID}.{$slideInfo['extension']}")->where('pathname')->like("%{$slideInfo['basename']}")->andWhere('addedBy')->eq('')->exec();
            $this->dao->setAutoLang(false)->update(TABLE_FILE)->set("addedBy")->eq($this->app->user->account)->where('addedBy')->eq('IMPORTED')->exec();
        }

        $this->dao->setAutoLang(false)->update(TABLE_SLIDE)->set('lang')->eq($this->app->getClientLang())->where('lang')->eq('lang')->exec();
        $this->dao->update(TABLE_CATEGORY)->set('type')->eq('slide')->set('lang')->eq($this->app->getClientLang())->where('type')->eq('tmpSlide')->exec();
    }

    /**
     * Merge custom.
     * 
     * @param  object    $info 
     * @access public
     * @return void
     */
    public function mergeCustom($info)
    {
        $template = $info->template;
        $theme    = $info->theme;
        $code     = $info->code;
        /* Merge theme custom param to current lang. */
        $params = $this->dao->setAutoLang(false)->select('value')
            ->from(TABLE_CONFIG)
            ->where('lang')->eq('lang')
            ->andWhere('`key`')->eq('custom')
            ->fetch('value');

        $params = json_decode($params, true);
        if(!empty($params[$template][$theme]))
        {
            $userCustom =  $this->dao->setAutoLang(false)->select('*')
                ->from(TABLE_CONFIG)
                ->where('lang')->ne('lang')
                ->andWhere('section')->eq('template')
                ->andWhere('`key`')->eq('custom')
                ->fetchAll('lang');
            
            foreach($userCustom as $lang => $custom)
            {
                $setting = json_decode($custom->value, true);
                if(!isset($setting[$template])) $setting[$template] = array();
                $setting[$template][$code] = zget($params[$template], $theme, array());
                $custom->value = helper::jsonEncode($setting);
                $this->dao->replace(TABLE_CONFIG)->data($custom)->exec();
            }
        }
        
        return true;
    }

    /**
     * Get themes by api.
     * 
     * @param  string    $type 
     * @param  string    $param 
     * @param  int       $recTotal 
     * @param  int       $recPerPage 
     * @param  int       $pageID 
     * @access public
     * @return void
     */
    public function getThemesByApi($type, $param, $recTotal, $recPerPage, $pageID)
    {
        $apiURL = $this->apiRoot . "apiGetThemes-$type-$param-$recTotal-$recPerPage-$pageID.json";
        $data   = $this->fetchAPI($apiURL);
        if(isset($data->themes))
        {
            foreach($data->themes as $package)
            {
                $package->currentRelease = isset($package->compatibleRelease) ? $package->compatibleRelease : $package->latestRelease;
                $package->currentRelease->compatible = isset($package->currentRelease);
            }
            return $data;
        }
        return false;
    }

    /**
     * Get package modules from the api.
     * 
     * @access public
     * @return string|bool
     */
    public function getIndustriesByAPI()
    {
        $requestType = helper::safe64Encode($this->config->requestType);
        $webRoot     = helper::safe64Encode($this->config->webRoot);
        $apiURL      = $this->apiRoot . 'apiGetindustries-' . $requestType . '-' . $webRoot . '.json';

        $data = $this->fetchAPI($apiURL);
        if(isset($data->industries)) return $data->industries;
        return false;
    }
}
