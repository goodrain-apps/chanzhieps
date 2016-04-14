<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class ui extends control
{
    /**
     * Set template.
     *
     * @param  string   $template
     * @param  string   $theme
     * @param  bool     $custom
     * @access public
     * @return void
     */
    public function setTemplate($template = '', $theme = '', $custom = false)
    {
        $templates = $this->ui->getTemplates();

        if($template and isset($templates[$template]))
        {
            $setting = array();
            $setting[$this->device]['name']  = $template;
            $setting[$this->device]['theme'] = $theme;

            $setting[$this->device] = helper::jsonEncode($setting[$this->device]);
            $setting['parser']      = isset($templates[$template]['parser']) ? $templates[$template]['parser'] : 'default';
            $setting['customTheme'] =  $custom ? $theme : '';

            $cssFile = sprintf($this->config->site->ui->customCssFile, $template, $theme);
            if(!file_exists($cssFile)) $this->ui->createCustomerCss($template, $theme);

            $result = $this->loadModel('setting')->setItems('system.common.template', $setting);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title           = $this->lang->ui->template->theme;
        $this->view->template        = current($templates);
        $this->view->installedThemes = $this->ui->getInstalledThemes();
        $this->view->currentTheme    = $this->config->template->{$this->device}->theme;
        $this->view->uiHeader        = true;
        $this->display();
    }

    /**
     * Custom theme.
     *
     * @param  string $theme
     * @param  string $template
     * @access public
     * @return void
     */
    public function customTheme($theme = '', $template = '')
    {
        if(empty($theme))    $theme    = $this->config->template->{$this->device}->theme;
        if(empty($template)) $template = $this->config->template->{$this->device}->name;

        $templates = $this->ui->getTemplates();
        if(!isset($templates[$template]['themes'][$theme])) die();

        $cssFile  = sprintf($this->config->site->ui->customCssFile, $template, $theme);
        $savePath = dirname($cssFile);
        if(!file_exists($savePath)) mkdir($savePath, 0777, true);

        if($_POST)
        {
            $params = $_POST;

            $lessResult = $this->ui->createCustomerCss($template, $theme, $params);
            if($lessResult['result'] != 'success') $this->send(array('result' => 'fail', 'message' => $errors));
            $setting       = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true): array();
            $postedSetting = fixer::input('post')->remove('template,theme')->get();

            $setting[$template][$theme] = $postedSetting;

            $result = $this->loadModel('setting')->setItems('system.common.template', array('custom' => helper::jsonEncode($setting)));
            $this->loadModel('setting')->setItems('system.common.template', array('customVersion' => time()));
            $this->send(array('result' => 'success', 'message' => $this->lang->ui->themeSaved));
        }

        $setting = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true) : array();

        $this->view->setting = !empty($setting[$template][$theme]) ? $setting[$template][$theme] : array();

        $this->view->title      = $this->lang->ui->appearance;
        $this->view->theme      = $theme;
        $this->view->template   = $template;
        $this->view->uiHeader   = true;
        $this->view->hasPriv    = true;

        if(!is_writable($savePath))
        {
            $this->view->hasPriv = false;
            $this->view->errors  = sprintf($this->lang->ui->unWritable, str_replace(dirname($this->app->getWwwRoot()), '', $savePath));
        }

        $this->display();
     }

    /**
     * set logo.
     *
     * @access public
     * @return void
     */
    public function setLogo()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $setNameResult = false;
            if(!empty($_POST['name'])) $setNameResult = $this->loadModel('setting')->setItem('system.common.site.name', $this->post->name);
            
            if(isset($_FILES['logo']))    $logoReturn    = $this->ui->setOptionWithFile($section = 'logo', $htmlTagName = 'logo');
            if(isset($_FILES['favicon'])) $faviconReturn = $this->ui->setOptionWithFile($section = 'favicon', $htmlTagName = 'favicon', $allowedFileType = 'ico');

            if($setNameResult || $logoReturn['result'] || $faviconReturn['result']) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setLogo')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->lang->menuGroups->ui = 'logo';
        $template = $this->config->template->{$this->device}->name;
        $theme    = $this->config->template->{$this->device}->theme;
        $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();;

        $logo = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);
        unset($this->lang->ui->menu);
        $this->view->title          = $this->lang->ui->setLogo;
        $this->view->logo           = $logo;
        $this->view->favicon        = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;
        $this->view->defaultFavicon = file_exists($this->app->getWwwRoot() . 'favicon.ico');

        $this->display();
    }

    /**
     * Delete favicon
     *
     * @access public
     * @return void
     */
    public function deleteFavicon()
    {
        $defaultFavicon = $this->app->getWwwRoot() . 'favicon.ico';
        if(file_exists($defaultFavicon)) unlink($defaultFavicon);

        $favicon = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;
        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=favicon");
        if($favicon) $this->loadModel('file')->delete($favicon->fileID);

        $this->locate(inlink('setLogo'));
    }

    /**
     * Delete logo.
     *
     * @access public
     * @return void
     */
    public function deleteLogo()
    {
        $theme = $this->config->template->{$this->device}->theme;
        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=logo&key=$theme");
        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=logo");

        $logo = isset($this->config->logo->$theme) ? json_decode($this->config->logo->$theme) : false;
        if($logo) $this->loadModel('file')->delete($logo->fileID);

        $this->locate(inlink('setLogo'));
    }

    /**
     * Set others for ui.
     *
     * @access public
     * @return void
     */
    public function others()
    {
        /* Get configs of list number. */
        $this->app->loadConfig('file');
        if(strpos($this->config->site->modules, 'article') !== false) $this->app->loadConfig('article');
        if(strpos($this->config->site->modules, 'product') !== false) $this->app->loadConfig('product');
        if(strpos($this->config->site->modules, 'blog') !== false)    $this->app->loadConfig('blog');
        if(strpos($this->config->site->modules, 'message') !== false) $this->app->loadConfig('message');
        if(strpos($this->config->site->modules, 'forum') !== false)
        {
            $this->app->loadConfig('forum');
            $this->app->loadConfig('reply');
        }

        if(!empty($_POST))
        {
            $thumbs = helper::jsonEncode($this->post->thumbs);
            $result = $this->loadModel('setting')->setItem('system.common.file.thumbs', $thumbs);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $setting = fixer::input('post')->get('productView,QRCode');
            $result  = $this->loadModel('setting')->setItems('system.common.ui', $setting);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $setting = fixer::input('post')->remove('productView,QRCode,thumbs')->get();
            $result  = $this->loadModel('setting')->setItems('system.common.site', $setting, 'all');
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->lang->menuGroups->ui = 'others';
        $this->view->title = $this->lang->ui->others;
        $this->display();
    }

    /**
     * Export theme function.
     *
     * @access public
     * @return void
     */
    public function exportTheme()
    {
        if($_POST)
        {
            $initResult = $this->ui->initExportPath($this->post->template, $this->post->theme, $this->post->code);
            if(!$initResult) $this->send(array('result' => 'fail', 'message' => 'failed to init export paths'));

            if(!$this->ui->checkExportParams()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $exportedFile = $this->ui->exportTheme($this->post->template, $this->post->theme, $this->post->code);
            $exportedFile = urlencode($exportedFile);
            $this->send(array('result' => 'success', 'message' => $this->lang->ui->exportedSuccess, 'locate' => inlink('downloadtheme', "theme={$exportedFile}")));
        }

        $templateList = $this->ui->getTemplates();

        foreach($templateList as $code => $template)
        {
            $templates[$code] = $template['name'];
            $themes[$code]    = $template['themes'];
        }

        $this->view->title           = $this->lang->ui->exportTheme;
        $this->view->templateOptions = $templates;
        $this->view->themes          = $themes;
        $this->display();
    }

    /**
     * Download theme.
     *
     * @param  string    $exportedFile
     * @access public
     * @return void
     */
    public function downloadtheme($exportedFile)
    {
        $fileData = file_get_contents($exportedFile);
        $pathInfo = pathinfo($exportedFile);
        $this->loadModel('file')->sendDownHeader($pathInfo['basename'], 'zip', $fileData, filesize($exportedFile));
    }

    /**
     * Upload a theme package.
     *
     * @access public
     * @return void
     */
    public function uploadTheme()
    {
        $canManage = array('result' => 'success');
        if(!$this->loadModel('guarder')->verify()) $canManage = $this->loadModel('common')->verifyAdmin();

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($canManage['result'] != 'success') $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->guarder->okFileVerify, $canManage['name'], $canManage['content'])));

            if(empty($_FILES))  $this->send(array('result' => 'fail', 'message' => $this->lang->ui->filesRequired));

            $tmpName  = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $package  = basename($fileName, '.zip');

            $packagePath = $this->app->getTmpRoot() . "package";
            if(!is_dir($packagePath)) mkdir($packagePath, 0777, true);
            if(!is_writeable($packagePath)) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->ui->packagePathUnwriteable, $packagePath)));
            $result = move_uploaded_file($tmpName, $this->app->getTmpRoot() . "package/$fileName");

            $link = inlink('installtheme', "package=$package&downLink=&md5=");
            $this->app->loadLang('package');
            $this->send(array('result' => 'success', 'message' => $this->lang->package->successUploadedPackage, 'locate' => $link));
        }

        $this->view->canManage = $canManage;
        $this->view->title     = $this->lang->ui->uploadTheme;
        $this->display();
    }

    /**
     * Install a theme.
     *
     * @param  string   $package
     * @param  string   $downLink
     * @param  string   $md5
     * @access public
     * @return void
     */
    public function installTheme($package, $downLink = '', $md5 = '')
    {
        set_time_limit(0);

        $this->view->error = '';
        $this->view->title = $this->lang->ui->installTheme;

        /* Ignore merge blocks before blocks imported. */
        $this->view->blocksMerged = true;

        /* Get the package file name. */
        $packageFile = $this->loadModel('package')->getPackageFile($package);

        /* Check the package file exists or not. */
        if(!file_exists($packageFile))
        {
            $this->view->error = sprintf($this->lang->package->errorPackageNotFound, $packageFile);
            die($this->display());
        }

        $packageInfo = $this->loadModel('package')->parsePackageCFG($package, 'theme');
        $type = 'theme';

        /* Checking the package pathes. */
        $return = $this->package->checkPackagePathes($package, $type);
        if($this->session->dirs2Created == false) $this->session->set('dirs2Created', $return->dirs2Created);    // Save the dirs to be created.
        if($return->result != 'ok')
        {
            $this->view->error = $return->errors;
            die($this->display());
        }

        /* Extract the package. */
        $return = $this->package->extractPackage($package, 'theme');
        if($return->result != 'ok')
        {
            $this->view->error = sprintf($this->lang->package->errorExtracted, $packageFile, $return->error);
            die($this->display());
        }

        $packageInfo = $this->package->parsePackageCFG($package, 'theme');

        /* Process theme code. */
        $installedThemes = $this->ui->getThemesByTemplate($packageInfo->template);
        $package = $this->package->fixThemeCode($package, $installedThemes);

        $packageInfo = $this->package->parsePackageCFG($package, 'theme');

        /* Save to database. */
        if(!$_POST) $this->package->savePackage($package, $type);

        /* Copy files to target directory. */
        $this->view->files = $this->package->copyPackageFiles($package, $type);

        /* Execute the install.sql. */
        $this->ui->clearTmpData();
        $return = $this->package->executeDB($package, 'install', 'theme');
        if($return->result != 'ok')
        {
            $this->view->error = sprintf($this->lang->package->errorInstallDB, $return->error);
            die($this->display());
        }

        $this->package->fixSlides($package);

        /* Fetch blocks data and show merge */
        $importedBlocks  = $this->dao->setAutoLang(false)->select('*')->from(TABLE_BLOCK)->where('originID')->gt(0)->andWhere('lang')->eq('lang')->fetchAll('originID');
        $oldBlocks       = $this->dao->select('*')->from(TABLE_BLOCK)->where('template')->eq($packageInfo->template)->fetchAll('id');
        $matchedBlocks   = array();
        $unMatchedBlocks = array();

        foreach($importedBlocks as $newBlock)
        {
            foreach($oldBlocks as $block)
            {
                if($block->content == $newBlock->content and $block->type == $newBlock->type)
                {
                    $matchedBlocks[$newBlock->originID] = $block->id;
                    continue;
                }

                if(strpos(',html,htmlcode,php,', ",{$block->type},") === false)
                {
                    if($block->type == $newBlock->type)
                    {
                        $matchedBlocks[$newBlock->originID] = $block->id;
                        continue;
                    }
                }
            }
            if(!isset($matchedBlocks[$newBlock->originID])) $unMatchedBlocks[$newBlock->originID] = $newBlock;
        }

        $this->app->loadLang('block');
        $this->view->matchedBlocks   = $matchedBlocks;
        $this->view->unMatchedBlocks = $unMatchedBlocks;
        $this->view->importedBlocks  = $importedBlocks;
        $this->view->oldBlocks       = $oldBlocks;
        $this->view->blocksMerged    = true;
        $this->view->package         = $package;
        $this->display();
    }

    /**
     * Fix theme datas.
     *
     * @access public
     * @return void
     */
    public function fixTheme()
    {
        $packageInfo = $this->loadModel('package')->parsePackageCFG($this->post->package, 'theme');

        $this->package->mergeBlocks($packageInfo);
        $this->package->mergeCustom($packageInfo);
        $this->package->fixLayout($packageInfo);
        $this->package->fixLang();

        $setting = array();
        $setting[$this->device]['name']  = $packageInfo->template;
        $setting[$this->device]['theme'] = $packageInfo->code;
        $setting[$this->device]  = helper::jsonEncode($setting[$this->device]);
        $setting['parser'] = isset($packageInfo->parser) ? $packageInfo->parser : 'default';

        $result = $this->loadModel('setting')->setItems('system.common.template', $setting);

        unset($this->session->originTheme);
        $this->send(array('result' => 'success', 'message' => $this->lang->ui->importThemeSuccess, "locate" => inlink('customtheme')));
    }

    /**
     * Delete a theme.
     *
     * @param  string    $template
     * @param  string    $theme
     * @access public
     * @return void
     */
    public function deleteTheme($template, $theme)
    {
        $result = $this->ui->deleteTheme($template, $theme);
        if($result) $this->send(array('result' => 'success', 'message' => $this->lang->ui->deleteThemeSuccess, "locate" => inlink('setTemplate')));
        $this->send(array('result' => 'fail', 'message' => $this->lang->ui->deleteThemeFail));
    }

    /**
     * Set device admin.
     *
     * @param  string    $device
     * @access public
     * @return void
     */
    public function setDevice($device)
    {
        $this->session->set('device', $device);

        $template = $this->config->template->{$device};
        if(isset($this->config->template->{$device}) and !is_object($this->config->template->{$device})) $template = json_decode($this->config->template->{$device});
        $setting['name']  = $template->name;
        $setting['theme'] = $template->theme;
        $setting = helper::jsonEncode($setting);
        $result = $this->loadModel('setting')->setItems('system.common.template', array($device => $setting));
        $this->locate($this->server->http_referer);
    }

    /**
     * Delete a template.
     *
     * @param  string    $template
     * @access public
     * @return void
     */
    public function uninstallTemplate($template)
    {
        $result = $this->ui->removeTemplateData($template);
        if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $result = $this->ui->removeTemplateFiles($template);
        if($result !== true) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->ui->removeDirFaild, join('<br/>', $result))) );
        $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
    }

    /**
     * Theme store page.
     * 
     * @param  string $industry 
     * @param  string $color 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function themeStore($type = 'byindustry', $param = 'all', $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->loadModel('package');
        $pager = null;
    
        $installedThemes = $this->ui->getInstalledThemes();
        
        $codes = array();
        if($type == 'installed')
        {
            foreach($installedThemes as $template => $themes)
            {
                $codes = $codes + array_keys($themes);
            }

            $param = join(',', $codes);
        }

        /* Get results from the api. */
        $results = $this->loadModel('package')->getThemesByApi($type, $param, $recTotal, $recPerPage, $pageID);
        if($results)
        {
            $this->app->loadClass('pager', $static = true);
            $pager  = new pager($results->dbPager->recTotal, $results->dbPager->recPerPage, $results->dbPager->pageID);
        }

        if($this->session->currentGroup != 'design') $this->lang->menuGroups->ui = 'themestore';
        if($this->session->currentGroup == 'design') $this->view->uiHeader = true;

        $this->view->themes       = zget($results, 'themes');
        $this->view->title        = $this->lang->ui->themeStore;
        $this->view->position[]   = $this->lang->package->obtain;

        $this->view->industryTree = str_replace('/index.php', $this->server->script_name, $this->package->getIndustriesByAPI());
        $this->view->pager        = $pager;
        $this->view->tab          = 'obtain';
        $this->view->type         = $type;
        $this->view->param        = $param;
        $this->display();
    }

    /**
     * Get encrypt css and js.
     * 
     * @param  int    $type 
     * @param  int    $template 
     * @param  int    $theme 
     * @access public
     * @return void
     */
    public function getEncrypt($type, $template, $theme)
    {
        $this->loadThemeHooks();

        if($type == 'css')
        {
            //header('Content-type: text/css');
            $cssFun = "get{$theme}CSS";
            if(!function_exists($cssFun)) die('/*no css*/');
            $params = $this->ui->getCustomParams($template, $theme);
            $encryptCss = $cssFun();
            $customCss = zget($params, 'css', '');
            $params['css'] = $encryptCss . $customCss;
            $lessResult = $this->ui->createCustomerCss($template, $theme, $params);
            if($lessResult['result'] != 'success') die();
            exit($lessResult['css']);
        }

        if($type == 'js')
        {
            header('Content-type: text/javascript');  
            $jsFun = "get{$theme}js";
            if(!function_exists($jsFun)) die('');
            $js = $jsFun();
            exit($js);
        }
        exit;
    }

    /**
     * Set js and css code for pages.
     * 
     * @param  string $page 
     * @access public
     * @return void
     */
    public function setCode($page = 'all')
    {
        $theme    = $this->config->template->{$this->device}->theme;
        $template = $this->config->template->{$this->device}->name;
        if($_POST)
        {
            $post = fixer::input('post')->stripTags('css,js', $this->config->allowedTags->admin)->get();
            $cssSetting["{$template}_{$theme}_{$page}"] = $post->css;
            $jsSetting["{$template}_{$theme}_{$page}"]  = $post->js;
            $this->loadModel('setting')->setItems('system.common.css', $cssSetting);
            $this->loadModel('setting')->setItems('system.common.js', $jsSetting);
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }

        $this->app->loadLang('block');
        $this->view->title    = $this->lang->ui->setCode;
        $this->view->page     = $page;
        $this->view->template = $template;
        $this->view->theme    = $theme;
        $this->view->uiHeader = true;
        $this->view->pageList = $this->lang->block->$template->pages;
        $this->display();
    }
}
