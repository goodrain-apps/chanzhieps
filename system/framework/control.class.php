<?php
/**
 * The control class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

/**
 * The base class of control.
 *
 * @package framework
 */
class control
{
    /**
     * The global $app object.
     * 
     * @var object
     * @access protected
     */
    protected $app;

    /**
     * The global $config object.
     * 
     * @var object
     * @access protected
     */
    protected $config;

    /**
     * The global $lang object.
     * 
     * @var object
     * @access protected
     */
    protected $lang;

    /**
     * The global $dbh object, the database connection handler.
     * 
     * @var object
     * @access protected
     */
    protected $dbh;

    /**
     * The $dao object, used to access or update database.
     * 
     * @var object
     * @access protected
     */
    public $dao;

    /**
     * The $post object, used to access the $_POST var.
     * 
     * @var ojbect
     * @access public
     */
    public $post;

    /**
     * The $get object, used to access the $_GET var.
     * 
     * @var ojbect
     * @access public
     */
    public $get;

    /**
     * The $session object, used to access the $_SESSION var.
     * 
     * @var ojbect
     * @access public
     */
    public $session;

    /**
     * The $server object, used to access the $_SERVER var.
     * 
     * @var ojbect
     * @access public
     */
    public $server;

    /**
     * The $cookie object, used to access the $_COOKIE var.
     * 
     * @var ojbect
     * @access public
     */
    public $cookie;

    /**
     * The $global object, used to access the $_GLOBAL var.
     * 
     * @var ojbect
     * @access public
     */
    public $global;

    /**
     * The name of current module.
     * 
     * @var string
     * @access protected
     */
    protected $moduleName;

    /**
     * The vars assigned to the view page.
     * 
     * @var object
     * @access public
     */
    public $view; 

    /**
     * The type of the view, such html, json.
     * 
     * @var string
     * @access private
     */
    private $viewType;

    /**
     * The content to display.
     * 
     * @var string
     * @access private
     */
    private $output;

    /**
     * The prefix of view file for mobile or PC. 
     * 
     * @var string   
     * @access public
     */
    public $viewPrefix;

    /**
     * The device of visiting client.
     * 
     * @var string   
     * @access public
     */
    public $device;

    /**
     * The construct function.
     *
     * 1. global the global vars, refer them by the class member such as $this->app.
     * 2. set the pathes of current module, and load it's mode class.
     * 3. auto assign the $lang and $config to the view.
     * 
     * @access public
     * @return void
     */
    public function __construct($moduleName = '', $methodName = '')
    {
        /* Global the globals, and refer them to the class member. */
        global $app, $config, $lang, $dbh, $common;
        $this->app      = $app;
        $this->config   = $config;
        $this->lang     = $lang;
        $this->dbh      = $dbh;
        $this->viewType = $this->app->getViewType();

        $this->setCurrentDevice();
        $this->setModuleName($moduleName);
        $this->setMethodName($methodName);
        $this->setTplRoot();

        /* Load the model file auto. */
        $this->loadModel();
        $this->setViewPrefix();

        /* Assign them to the view. */
        $this->view          = new stdclass();
        $this->view->app     = $app;
        $this->view->lang    = $lang;
        $this->view->config  = $config;
        $this->view->common  = $common;
        $this->view->session = $app->session;
        if(RUN_MODE == 'front') $this->view->layouts = $this->loadModel('block')->getPageBlocks($this->moduleName, $this->methodName);

        $this->setSuperVars();
    }

    //-------------------- Model related methods --------------------//

    /* Set the module name. 
     * 
     * @param   string  $moduleName     The module name, if empty, get it from $app.
     * @access  private
     * @return  void
     */
    private function setModuleName($moduleName = '')
    {
        $this->moduleName = $moduleName ? strtolower($moduleName) : $this->app->getModuleName();
    }

    /* Set the method name. 
     * 
     * @param   string  $methodName    The method name, if empty, get it from $app.
     * @access  private
     * @return  void
     */
    private function setMethodName($methodName = '')
    {
        $this->methodName = $methodName ? strtolower($methodName) : $this->app->getMethodName();
    }

    /**
     * Set TPL_ROOT used in template files.
     * 
     * @access public
     * @return void
     */
    public function setTplRoot()
    {
        if(!defined('TPL_ROOT')) define('TPL_ROOT', $this->app->getTplRoot() . $this->config->template->{$this->device}->name . DS);
    }

    /**
     * Load the model file of one module.
     * 
     * @param   string      $methodName    The method name, if empty, use current module's name.
     * @access  public
     * @return  object|bool If no model file, return false. Else return the model object.
     */
    public function loadModel($moduleName = '')
    {
        if(empty($moduleName)) $moduleName = $this->moduleName;
        $modelFile = helper::setModelFile($moduleName);

        /* If no model file, try load config. */
        if(!is_file($modelFile)  or !helper::import($modelFile)) 
        {
            $this->app->loadConfig($moduleName, false);
            $this->app->loadLang($moduleName);
            $this->dao = new dao();
            return false;
        }

        $modelClass = class_exists('ext' . $moduleName. 'model') ? 'ext' . $moduleName . 'model' : $moduleName . 'model';
        if(!class_exists($modelClass)) $this->app->triggerError(" The model $modelClass not found", __FILE__, __LINE__, $exit = true);

        $this->$moduleName = new $modelClass();
        $this->dao = $this->$moduleName->dao;
        return $this->$moduleName;
    }

    /**
     * Set the super vars.
     * 
     * @access protected
     * @return void
     */
    protected function setSuperVars()
    {
        $this->post    = $this->app->post;
        $this->get     = $this->app->get;
        $this->server  = $this->app->server;
        $this->session = $this->app->session;
        $this->cookie  = $this->app->cookie;
        $this->global  = $this->app->global;
    }

    /**
     * Set the prefix of view file for mobile or PC.
     * 
     * @access public
     * @return void
     */
    public function setViewPrefix()
    {
        global $app, $config;
        $this->viewPrefix = '';
        if(RUN_MODE == 'front')
        {
            /* Detect mobile. */
            $mobile = $app->loadClass('mobile');
            if($mobile->isMobile() and !isset($config->template->mobile)) $this->viewPrefix = 'm.';
        }
    }

    /**
     * Set current device of visit website.
     * 
     * @access public
     * @return void
     */
    public function setCurrentDevice()
    {
        $this->app->setCurrentDevice();
        $this->device = $this->app->device;
    }

    //-------------------- View related methods --------------------//
   
    /**
     * Set the view file, thus can use fetch other module's page.
     * 
     * @param  string   $moduleName    module name
     * @param  string   $methodName    method name
     * @access private
     * @return string  the view file
     */
    public function setViewFile($moduleName, $methodName)
    {
        $moduleName = strtolower(trim($moduleName));
        $methodName = strtolower(trim($methodName));

        $modulePath  = $this->app->getModulePath($moduleName);
        $viewExtPath = $this->app->getModuleExtPath($moduleName, 'view');

        $viewType = $this->viewType == 'mhtml' ? 'html' : $this->viewType;
        if((RUN_MODE != 'front') or (strpos($modulePath, 'module' . DS . 'ext' . DS) !== false))
        {
            /* If not in front mode or is ext module, view file is in modeule path. */
            $mainViewFile = $modulePath . 'view' . DS . $this->viewPrefix . $methodName . '.' . $viewType . '.php';
        }
        else
        {
            /* If in front mode, view file is in www/template path. */
            $mainViewFile = TPL_ROOT . $moduleName . DS . $this->viewPrefix . "{$methodName}.{$viewType}.php";
            if($this->viewPrefix == 'm.' and !is_file($mainViewFile))
            {
                $this->viewPrefix = '';
                $mainViewFile = TPL_ROOT . $moduleName . DS . $this->viewPrefix . "{$methodName}.{$viewType}.php";
            }
        }

        /* Extension view file. */
        $commonExtViewFile = $viewExtPath['common'] . $this->viewPrefix . $methodName . ".{$viewType}.php";
        $siteExtViewFile   = $viewExtPath['site'] . $this->viewPrefix . $methodName . ".{$viewType}.php";
        $viewFile = file_exists($commonExtViewFile) ? $commonExtViewFile : $mainViewFile;
        $viewFile = file_exists($siteExtViewFile) ? $siteExtViewFile : $viewFile;
        if(!is_file($viewFile)) $this->app->triggerError("the view file $viewFile not found", __FILE__, __LINE__, $exit = true);

        /* Extension hook file. */
        $commonExtHookFiles = glob($viewExtPath['common'] . $this->viewPrefix . $methodName . ".*.{$viewType}.hook.php");
        $siteExtHookFiles   = glob($viewExtPath['site'] . $this->viewPrefix . $methodName . ".*.{$viewType}.hook.php");
        $extHookFiles       = array_merge((array) $commonExtHookFiles, (array) $siteExtHookFiles);
        if(!empty($extHookFiles)) return array('viewFile' => $viewFile, 'hookFiles' => $extHookFiles);

        return $viewFile;
    }

    /**
     * Get the extension file of an view.
     * 
     * @param  string $viewFile 
     * @access public
     * @return string|bool  If extension view file exists, return the path. Else return fasle.
     */
    public function getExtViewFile($viewFile)
    {
        $extPath     = dirname(realpath($viewFile)) . "/ext/_{$this->config->site->code}/";
        $extViewFile = $extPath . basename($viewFile);

        if(file_exists($extViewFile))
        {
            helper::cd($extPath);
            return $extViewFile;
        }

        $extPath = RUN_MODE == 'front' ? dirname(realpath($viewFile)) . '/ext/' : dirname(dirname(realpath($viewFile))) . '/ext/view/';
        $extViewFile = $extPath . basename($viewFile);

        if(file_exists($extViewFile))
        {
            helper::cd($extPath);
            return $extViewFile;
        }

        return false;
    }

    /**
     * Get css code for a method. 
     * 
     * @param  string    $moduleName 
     * @param  string    $methodName 
     * @access private
     * @return string
     */
    private function getCSS($moduleName, $methodName)
    {
        $moduleName = strtolower(trim($moduleName));
        $methodName = strtolower(trim($methodName));

        $modulePath = $this->app->getModulePath($moduleName);
        $cssExtPath = $this->app->getModuleExtPath($moduleName, 'css') ;

        $css = '';
        if((RUN_MODE != 'front') or (strpos($modulePath, 'module' . DS . 'ext') !== false))
        {
            $mainCssFile   = $modulePath . 'css' . DS . $this->viewPrefix . 'common.css';
            $methodCssFile = $modulePath . 'css' . DS . $this->viewPrefix . $methodName . '.css';

            if(file_exists($mainCssFile))   $css .= file_get_contents($mainCssFile);
            if(file_exists($methodCssFile)) $css .= file_get_contents($methodCssFile);
        }
        else
        {
            $defaultMainCssFile   = TPL_ROOT . $moduleName . DS . 'css' . DS . $this->viewPrefix . "common.css";
            $defaultMethodCssFile = TPL_ROOT . $moduleName . DS . 'css' . DS . $this->viewPrefix . "{$methodName}.css";
            $themeMainCssFile     = TPL_ROOT . $moduleName . DS . 'css' . DS . $this->viewPrefix . "common.{$this->config->site->theme}.css";
            $themeMethodCssFile   = TPL_ROOT . $moduleName . DS . 'css' . DS . $this->viewPrefix . "{$methodName}.{$this->config->site->theme}.css";

            if(file_exists($defaultMainCssFile))   $css .= file_get_contents($defaultMainCssFile);
            if(file_exists($defaultMethodCssFile)) $css .= file_get_contents($defaultMethodCssFile);
            if(file_exists($themeMainCssFile))     $css .= file_get_contents($themeMainCssFile);
            if(file_exists($themeMethodCssFile))   $css .= file_get_contents($themeMethodCssFile);
        }

        $commonExtCssFiles = glob($cssExtPath['common'] . $methodName . DS . $this->viewPrefix . '*.css');
        if(!empty($commonExtCssFiles)) foreach($commonExtCssFiles as $cssFile) $css .= file_get_contents($cssFile);

        $methodExtCssFiles = glob($cssExtPath['site'] . $methodName . DS . $this->viewPrefix . '*.css');
        if(!empty($methodExtCssFiles)) foreach($methodExtCssFiles as $cssFile) $css .= file_get_contents($cssFile);

        return $css;
    }

    /**
     * Get js code for a method. 
     * 
     * @param  string    $moduleName 
     * @param  string    $methodName 
     * @access private
     * @return string
     */
    private function getJS($moduleName, $methodName)
    {
        $moduleName = strtolower(trim($moduleName));
        $methodName = strtolower(trim($methodName));
        
        $modulePath = $this->app->getModulePath($moduleName);
        $jsExtPath  = $this->app->getModuleExtPath($moduleName, 'js');

        $js = '';
        if((RUN_MODE !== 'front') or (strpos($modulePath, 'module' . DS . 'ext') !== false))
        {
            $mainJsFile   = $modulePath . 'js' . DS . $this->viewPrefix . 'common.js';
            $methodJsFile = $modulePath . 'js' . DS . $this->viewPrefix . $methodName . '.js';

            if(file_exists($mainJsFile))   $js .= file_get_contents($mainJsFile);
            if(file_exists($methodJsFile)) $js .= file_get_contents($methodJsFile);
        }
        else
        {
            $defaultMainJsFile   = TPL_ROOT . $moduleName . DS . 'js' . DS . $this->viewPrefix . "common.js";
            $defaultMethodJsFile = TPL_ROOT . $moduleName . DS . 'js' . DS . $this->viewPrefix . "{$methodName}.js";
            $themeMainJsFile     = TPL_ROOT . $moduleName . DS . 'js' . DS . $this->viewPrefix . "common.{$this->config->site->theme}.js";
            $themeMethodJsFile   = TPL_ROOT . $moduleName . DS . 'js' . DS . $this->viewPrefix . "{$methodName}.{$this->config->site->theme}.js";

            if(file_exists($defaultMainJsFile))   $js .= file_get_contents($defaultMainJsFile);
            if(file_exists($defaultMethodJsFile)) $js .= file_get_contents($defaultMethodJsFile);
            if(file_exists($themeMainJsFile))     $js .= file_get_contents($themeMainJsFile);
            if(file_exists($themeMethodJsFile))   $js .= file_get_contents($themeMethodJsFile);
        }

        $commonExtJsFiles = glob($jsExtPath['common'] . $methodName . DS . $this->viewPrefix . '*.js');
        if(!empty($commonExtJsFiles))
        {
            foreach($commonExtJsFiles as $jsFile) $js .= file_get_contents($jsFile);
        }

        $methodExtJsFiles = glob($jsExtPath['site'] . $methodName . DS  . $this->viewPrefix . '*.js');
        if(!empty($methodExtJsFiles))
        {
            foreach($methodExtJsFiles as $jsFile) $js .= file_get_contents($jsFile);
        }

        return $js;
    }

    /**
     * Assign one var to the view vars.
     * 
     * @param   string  $name       the name.
     * @param   mixed   $value      the value.
     * @access  public
     * @return  void
     */
    public function assign($name, $value)
    {
        $this->view->$name = $value;
    }

    /**
     * Clear the output.
     * 
     * @access public
     * @return void
     */
    public function clear()
    {
        $this->output = '';
    }

    /**
     * Parse view file. 
     *
     * @param  string $moduleName    module name, if empty, use current module.
     * @param  string $methodName    method name, if empty, use current method.
     * @access public
     * @return string the parsed result.
     */
    public function parse($moduleName = '', $methodName = '')
    {
        if(empty($moduleName)) $moduleName = $this->moduleName;
        if(empty($methodName)) $methodName = $this->methodName;

        if($this->viewType == 'json') return $this->parseJSON($moduleName, $methodName);

        /* If the parser is default or run mode is admin, install, upgrade, call default parser.  */
        if(RUN_MODE != 'front' or $this->config->template->parser == 'default')
        {
            $this->parseDefault($moduleName, $methodName);
            return $this->output;
        }

        /* Call the extened parser. */
        $parserClassName = $this->config->template->parser . 'Parser';
        $parserClassFile = 'parser.' . $this->config->template->parser . '.class.php';
        $parserClassFile = dirname(__FILE__) . DS . $parserClassFile;
        if(!is_file($parserClassFile)) $this->app->triggerError(" The parser file  $parserClassFile not found", __FILE__, __LINE__, $exit = true);

        helper::import($parserClassFile);
        if(!class_exists($parserClassName)) $this->app->triggerError(" Can not find class : $parserClassName not found in $parserClassFile <br/>", __FILE__, __LINE__, $exit = true);

        $parser = new $parserClassName($this);
        return $parser->parse($moduleName, $methodName);
    }

    /**
     * Parse json format.
     *
     * @param string $moduleName    module name
     * @param string $methodName    method name
     * @access private
     * @return void
     */
    private function parseJSON($moduleName, $methodName)
    {
        die('View type error.');
        unset($this->view->app);
        unset($this->view->config);
        unset($this->view->lang);
        unset($this->view->pager);
        unset($this->view->header);
        unset($this->view->position);
        unset($this->view->moduleTree);
        unset($this->view->common);

        $output['status'] = is_object($this->view) ? 'success' : 'fail';
        $output['data']   = json_encode($this->view);
        $output['md5']    = md5(json_encode($this->view));
        $this->output     = json_encode($output);
    }

    /**
     * Parse default html format.
     *
     * @param string $moduleName    module name
     * @param string $methodName    method name
     * @access private
     * @return void
     */
    private function parseDefault($moduleName, $methodName)
    {
        /* Set the view file. */
        $results  = $this->setViewFile($moduleName, $methodName);
        $viewFile = $results;
        if(is_array($results)) extract($results);

        /* Get css and js. */
        $css = $this->getCSS($moduleName, $methodName);
        $js  = $this->getJS($moduleName, $methodName);

        if(RUN_MODE == 'front')
        {
            $template    = $this->config->template->{$this->device}->name;
            $theme       = $this->config->template->{$this->device}->theme;
            $customParam = $this->loadModel('ui')->getCustomParams($template, $theme);
            $themeHooks  = $this->loadThemeHooks();
            $importedCSS = array();
            $importedJS  = array();

            if(!empty($themeHooks))
            {
                $jsFun  = "get{$theme}JS";
                $cssFun = "get{$theme}CSS";
                if(function_exists($jsFun))  $importedJS = $jsFun();
                if(function_exists($cssFun)) $importedCSS = $cssFun();

                $jsFun  = "get_THEME_CODEFIX_CSS";
                $cssFun = "get_THEME_CODEFIX_JS";
                if(function_exists($jsFun))  $importedJS = $jsFun();
                if(function_exists($cssFun)) $importedCSS = $cssFun();
                if(!empty($importedJS)) $importedJS = $this->processImportedCodes($template, $theme, $importedJS);
                if(!empty($importedCSS)) $importedCSS = $this->processImportedCodes($template, $theme, $importedCSS);
                
            }

            $js .= zget($importedJS, "{$template}_{$theme}_all", '');
            $js .= zget($this->config->js, "{$template}_{$theme}_all", '');
            $js .= zget($importedJS, "{$template}_{$theme}_{$moduleName}_{$methodName}", '');
            $js .= zget($this->config->js,"{$template}_{$theme}_{$moduleName}_{$methodName}", '');

            $allPageCSS  = zget($importedCSS, "{$template}_{$theme}_all", '');
            $allPageCSS .= zget($this->config->css, "{$template}_{$theme}_all", '');

            $currentPageCSS  = zget($importedCSS, "{$template}_{$theme}_{$moduleName}_{$methodName}", '');
            $currentPageCSS .= zget($this->config->css, "{$template}_{$theme}_{$moduleName}_{$methodName}", '');
            $css .= $this->ui->compileCSS($customParam, $allPageCSS . $currentPageCSS);
        }

        if($css) $this->view->pageCSS = $css;
        if($js)  $this->view->pageJS  = $js;
        
        /* Change the dir to the view file to keep the relative pathes work. */
        $currentPWD = getcwd();
        chdir(dirname($viewFile));

        extract((array)$this->view);

        ob_start();
        include $viewFile;
        if(isset($hookFiles)) foreach($hookFiles as $hookFile) if(file_exists($hookFile)) include $hookFile;
        $this->output .= ob_get_contents();
        ob_end_clean();

        /* At the end, chang the dir to the previous. */
        chdir($currentPWD);
    }

    /**
     * Get the output of one module's one method as a string, thus in one module's method, can fetch other module's content.
     * 
     * If the module name is empty, then use the current module and method. If set, use the user defined module and method.
     *
     * @param   string  $moduleName    module name.
     * @param   string  $methodName    method name.
     * @param   array   $params        params.
     * @access  public
     * @return  string  the parsed html.
     */
    public function fetch($moduleName = '', $methodName = '', $params = array())
    {
        if($moduleName == '') $moduleName = $this->moduleName;
        if($methodName == '') $methodName = $this->methodName;
        if($moduleName == $this->moduleName and $methodName == $this->methodName) 
        {
            $this->parse($moduleName, $methodName);
            return $this->output;
        }

        /* Set the pathes and files to included. */
        $modulePath        = $this->app->getModulePath($moduleName);
        $moduleControlFile = $modulePath . 'control.php';
        $actionExtPath     = $this->app->getModuleExtPath($moduleName, 'control');

        $commonActionExtFile = $actionExtPath['common'] . strtolower($methodName) . '.php';
        $siteActionExtFile   = $actionExtPath['site'] . strtolower($methodName) . '.php';
        $file2Included = file_exists($commonActionExtFile) ? $commonActionExtFile : $moduleControlFile;
        $file2Included = file_exists($siteActionExtFile) ? $siteActionExtFile : $file2Included;

        /* Load the control file. */
        if(!is_file($file2Included)) $this->app->triggerError("The control file $file2Included not found", __FILE__, __LINE__, $exit = true);
        $currentPWD = getcwd();
        chdir(dirname($file2Included));
        if($moduleName != $this->moduleName) helper::import($file2Included);
        
        /* Set the name of the class to be called. */
        $className = class_exists("my$moduleName") ? "my$moduleName" : $moduleName;
        if(!class_exists($className)) $this->app->triggerError(" The class $className not found", __FILE__, __LINE__, $exit = true);

        /* Parse the params, create the $module control object. */
        if(!is_array($params)) parse_str($params, $params);
        $module = new $className($moduleName, $methodName);

        /* Call the method and use ob function to get the output. */
        ob_start();
        call_user_func_array(array($module, $methodName), $params);
        $output = ob_get_contents();
        ob_end_clean();

        /* Return the content. */
        unset($module);
        chdir($currentPWD);
        return $output;
    }

    /**
     * Print the content of the view. 
     * 
     * @param   string  $moduleName    module name
     * @param   string  $methodName    method name
     * @access  public
     * @return  void
     */
    public function display($moduleName = '', $methodName = '')
    {
        if(empty($this->output)) $this->parse($moduleName, $methodName);
        if(isset($this->config->cn2tw) and $this->config->cn2tw and $this->app->getClientLang() == 'zh-tw')
        {
            $this->app->loadClass('cn2tw', true);
            $this->output = cn2tw::translate($this->output);
        }

        if(RUN_MODE == 'front') 
        {
            $this->mergeCSS();
            $this->mergeJS();
        }

        //if(isset($this->config->site->cdn))
        //{
        //    $cdn = rtrim($this->config->site->cdn, '/');
        //    $this->output = str_replace('src="/data/upload', 'src="' . $cdn . '/data/upload', $this->output);
        //    $this->output = str_replace("src='/data/upload", "src='" . $cdn . "/data/upload", $this->output);
        //    $this->output = str_replace("url(/data/upload", "url(" . $cdn . "/data/upload", $this->output);
        //}
        
        echo $this->output;
    }

    /**
     * Send data directly, for ajax requests.
     * 
     * @param  misc    $data 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function send($data, $type = 'json')
    {
        $data = (array) $data;
        if($type == 'json')
        {
            if(!helper::isAjaxRequest())
            {
                if(isset($data['result']) and $data['result'] == 'success')
                {
                    if(!empty($data['message'])) echo js::alert($data['message']);
                    $locate = isset($data['locate']) ? $data['locate'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
                    if(!empty($locate)) die(js::locate($locate));
                    die(isset($data['message']) ? $data['message'] : 'success');
                }

                if(isset($data['result']) and $data['result'] == 'fail')
                {
                    if(!empty($data['message']))
                    {
                        $message = json_decode(json_encode((array)$data['message']));
                        foreach((array)$message as $item => $errors)
                        {
                            $message->$item = implode(',', $errors);
                        }
                        echo js::alert(strip_tags(implode(" ", (array) $message)));
                        die(js::locate('back'));
                    }
                }
            }

            header("Content-type: text/html; charset=utf-8");
            header("Content-type: application/json");
            echo json_encode($data);
        }
        die(helper::removeUTF8Bom(ob_get_clean()));
    }

    /**
     * Create a link to one method of one module.
     * 
     * @param   string         $moduleName    module name
     * @param   string         $methodName    method name
     * @param   string|array   $vars          the params passed, can be array(key=>value) or key1=value1&key2=value2
     * @param   string         $viewType      the view type
     * @access  public
     * @return  string the link string.
     */
    public function createLink($moduleName, $methodName = 'index', $vars = array(), $alias = array(), $viewType = '')
    {
        if(empty($moduleName)) $moduleName = $this->moduleName;
        return helper::createLink($moduleName, $methodName, $vars, $alias, $viewType);
    }

    /**
     * Create a link to the inner method of current module.
     * 
     * @param   string         $methodName    method name
     * @param   string|array   $vars          the params passed, can be array(key=>value) or key1=value1&key2=value2
     * @param   string         $viewType      the view type
     * @access  public
     * @return  string  the link string.
     */
    public function inlink($methodName = 'index', $vars = array(), $alias = array(), $viewType = '')
    {
        return helper::createLink($this->moduleName, $methodName, $vars, $alias, $viewType);
    }

    /**
     * Location to another page.
     * 
     * @param   string   $url   the target url.
     * @access  public
     * @return  void
     */
    public function locate($url)
    {
        header("location: $url");
        exit;
    }

    /**
     * Load theme hooks.
     * 
     * @access public
     * @return array
     */
    public function loadThemeHooks()
    {
        $theme     = $this->config->template->{$this->device}->theme;
        $hookPath  = $this->app->getWwwRoot() . 'theme/' . $this->config->template->{$this->device}->name. DS . $theme . DS;
        $hookFiles = glob("{$hookPath}*.php");

        foreach($hookFiles as $file) include $file;
        return $hookFiles;
    }

    /**
     * Merge all css codes of one page. 
     * 
     * @access public
     * @return void
     */
    public function mergeCSS()
    {
        $pageCSS = '';
        preg_match_all('/<style>([\s\S]*?)<\/style>/', $this->output, $styles);
        if(!empty($styles[1])) $pageCSS = join('', $styles[1]);
        if(!empty($pageCSS))
        {
            $this->output = str_replace("</style>\n", '</style>', $this->output);
            $this->output = preg_replace('/<style>([\s\S]*?)<\/style>/', '', $this->output);
            if(strpos($this->output, '</head>') != false) $this->output = str_replace('</head>', "<style>{$pageCSS}</style></head>", $this->output);
            if(strpos($this->output, '</head>') == false) $this->output = "<style>{$pageCSS}</style>" . $this->output;
        }
    }

    /**
     * Merge all js codes of one page, 
     * 
     * @access public
     * @return void
     */
    public function mergeJS()
    {
        $pageJS = '';
        preg_match_all('/<script>([\s\S]*?)<\/script>/', $this->output, $scripts);
        if(empty($scripts[1][1])) return true;
        $configCode = $scripts[1][0] . $scripts[1][1];
        unset($scripts[1][1]);
        unset($scripts[1][0]);
        
        if(!empty($scripts[1])) $pageJS = join(';', $scripts[1]);
        if(!empty($pageJS))
        {
            $this->output = str_replace("</script>\n", '</script>', $this->output);
            $this->output = preg_replace('/<script>([\s\S]*?)<\/script>/', '', $this->output);
            if(strpos($this->output, '</body>') != false) $this->output = str_replace('</body>', "<script>{$pageJS}</script></body>", $this->output);
            if(strpos($this->output, '</body>') == false) $this->output .= "<script>$pageJS</script>";
        }
        $pos = strpos($this->output, '<script src=');
        $this->output = substr_replace($this->output, '<script>' . $configCode . '</script>', $pos) . substr($this->output, $pos);
        return true;
    }

    /**
     * Process imported codes encrypted.
     * 
     * @param  string    $template 
     * @param  string    $theme 
     * @param  array     $codes 
     * @access public
     * @return void
     */
    public function processImportedCodes($template, $theme, $codes)
    {
        $sources[] = "{$template}_default_";
        $sources[] = "{$template}_clean_";
        $sources[] = "{$template}_wide_";
        $sources[] = "{$template}_tartan_";
        $sources[] = "{$template}_colorful_";
        $sources[] = "{$template}_blank_";

        foreach($sources as $source) $replace[] = "{$template}_{$theme}_";

        foreach($codes as $page => $code)
        {
            $page = str_replace($sources, $replace, $page);
            $codes->$page = $code;
        }
        return  $codes;
    }
}
