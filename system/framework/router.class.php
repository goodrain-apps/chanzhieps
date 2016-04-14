<?php
/**
 * The router, config and lang class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

/**
 * The router class.
 *
 * @package framework
 */
class router
{ 
    /**
     * The device type of client.
     * 
     * @var string   
     * @access public
     */
    public $device;

    /**
     * The base path of the ZenTaoPMS framework.
     *
     * @var string
     * @access private
     */
    private $basePath;

    /**
     * The root directory of the framwork($this->basePath/framework)
     * 
     * @var string
     * @access private
     */
    private $frameRoot;

    /**
     * The root directory of the core library($this->basePath/lib)
     * 
     * @var string
     * @access private
     */
    private $coreLibRoot;

    /**
     * The root directory of the app.
     * 
     * @var string
     * @access private
     */
    private $appRoot;

    /**
     * The root directory of temp.
     * 
     * @var string
     * @access private
     */
    private $tmpRoot;

    /**
     * The root directory of log.
     * 
     * @var string
     * @access private
     */
    private $logRoot;

    /**
     * The root directory of config.
     * 
     * @var string
     * @access private
     */
    private $configRoot;

    /**
     * The root directory of module.
     * 
     * @var string
     * @access private
     */
    private $moduleRoot;

    /**
     * The root directory of data.
     * 
     * @var string
     * @access private
     */
    private $dataRoot;

    /**
     * The root directory of template.
     * 
     * @var string
     * @access private
     */
    private $tplRoot;

    /**
     * The lang of the client user.
     * 
     * @var string
     * @access private
     */
    private $clientLang;

    /**
     * The control object of current module.
     * 
     * @var object
     * @access public
     */
    public $control;

    /**
     * The module name
     * 
     * @var string
     * @access private
     */
    private $moduleName;

    /**
     * The control file of the module current visiting.
     * 
     * @var string
     * @access private
     */
    private $controlFile;

    /**
     * The name of the method current visiting.
     * 
     * @var string
     * @access private
     */
    private $methodName;

    /**
     * The action extension file of current method.
     * 
     * @var string
     * @access private
     */
    private $extActionFile;

    /**
     * The URI.
     * 
     * @var string
     * @access private
     */
    private $URI;

    /**
     * The params passed in through url.
     * 
     * @var array
     * @access private
     */
    private $params;

    /**
     * The view type.
     * 
     * @var string
     * @access private
     */
    public $viewType;

    /**
     * The global $config object.
     * 
     * @var object
     * @access public
     */
    public $config;

    /**
     * The global $lang object.
     * 
     * @var object
     * @access public
     */
    public $lang;

    /**
     * The global $dbh object, the database connection handler.
     * 
     * @var object
     * @access private
     */
    public $dbh;

    /**
     * The slave database handler.
     * 
     * @var object
     * @access private
     */
    public $slaveDBH;

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
     * The code of current site.
     * 
     * @var string
     * @access public
     */
    public $siteCode;

    /**
     * The construct function.
     * 
     * Prepare all the paths, classes, super objects and so on.
     * Notice: 
     * 1. You should use the createApp() method to get an instance of the router.
     * 2. If the $appRoot is empty, the framework will comput the appRoot according the $appName
     *
     * @param string $appName   the name of the app 
     * @param string $appRoot   the root path of the app
     * @access protected
     * @return void
     */
    protected function __construct($appName = 'demo', $appRoot = '')
    {
        $this->setPathFix();
        $this->setBasePath();
        $this->setFrameRoot();
        $this->setCoreLibRoot();
        $this->setAppRoot($appName, $appRoot);
        $this->setTmpRoot();
        $this->setLogRoot();
        $this->setConfigRoot();
        $this->setModuleRoot();
        $this->setWwwRoot();
        $this->setDataRoot();
        $this->setTplRoot();

        $this->filterSuperVars();
        $this->setSuperVars();

        $this->loadConfig('common');
        $this->setTimezone();
        $this->setDebug();
        $this->setErrorHandler();

        $this->fixRequestURI();
        $this->setSuperVars();

        $this->sendHeader();
        $this->connectDB();

        $this->setClientLang();
        $this->fixLangConfig();
        $this->loadLang('common');

        $this->loadClass('front',  $static = true);
        $this->loadClass('filter', $static = true);
        $this->loadClass('dao',    $static = true);

        if(RUN_MODE == 'admin' and helper::isAjaxRequest()) $this->config->debug = 1;
    }

    /**
     * Create an application.
     * 
     * <code>
     * <?php
     * $demo = router::createApp('demo');
     * ?>
     * or specify the root path of the app. Thus the app and framework can be seperated.
     * <?php
     * $demo = router::createApp('demo', '/home/app/demo');
     * ?>
     * </code>
     * @param string $appName   the name of the app 
     * @param string $appRoot   the root path of the app
     * @param string $className the name of the router class. When extends a child, you should pass in the child router class name.
     * @static
     * @access public
     * @return object   the app object
     */
    public static function createApp($appName = 'demo', $appRoot = '', $className = 'router')
    {
        if(empty($className)) $className = __CLASS__;
        return new $className($appName, $appRoot);
    }

    //-------------------- path related methods --------------------//

    /**
     * Set the header info.
     * 
     * @access public
     * @return void
     */
    public function sendHeader()
    {
        $type = 'html';
        if((strpos($_SERVER['REQUEST_URI'], '.xml') !== false) or (isset($_GET['t']) and $_GET['t'] == 'xml')) $type = 'xml'; 

        header("Content-Type: text/{$type}; charset={$this->config->encoding}");
        header("Cache-control: private");
    }

    /**
     * Set the path directory.
     * 
     * @access protected
     * @return void
     */
    protected function setPathFix()
    {
        define('DS', DIRECTORY_SEPARATOR);
    }
 
    /**
     * Set current device of visit website.
     * 
     * @access public
     * @return void
     */
    public function setCurrentDevice()
    {
        $this->device = helper::getDevice();
    }
   
    /**
     * Set the base path.
     *
     * @access protected
     * @return void
     */
    protected function setBasePath()
    {
        $this->basePath = realpath(dirname(dirname(__FILE__))) . DS;
    }
    
    /**
     * Set the frame root.
     * 
     * @access protected
     * @return void
     */
    protected function setFrameRoot()
    {
        $this->frameRoot = $this->basePath . 'framework' . DS;
    }

    /**
     * Set the core library root.
     * 
     * @access protected
     * @return void
     */
    protected function setCoreLibRoot()
    {
        $this->coreLibRoot = $this->basePath . 'lib' . DS;
    }

    /**
     * Set the app root.
     *
     * @param string $appName 
     * @param string $appRoot 
     * @access protected
     * @return void
     */
    protected function setAppRoot($appName = 'demo', $appRoot = '')
    {
        if(empty($appRoot))
        {
            $this->appRoot = $this->basePath . 'app' . DS . $appName . DS;
        }
        else
        {
            $this->appRoot = realpath($appRoot) . DS;
        }
        if(!is_dir($this->appRoot)) $this->triggerError("The app you call not found in {$this->appRoot}", __FILE__, __LINE__, $exit = true);
    }

    /**
     * Set the tmp root.
     * 
     * @access protected
     * @return void
     */
    protected function setTmpRoot()
    {
        $this->tmpRoot = $this->appRoot . 'tmp' . DS;
    }

    /**
     * Set the log root.
     * 
     * @access protected
     * @return void
     */
    protected function setLogRoot()
    {
        $this->logRoot = $this->tmpRoot . 'log' . DS;
    }

    /**
     * Set the config root.
     * 
     * @access protected
     * @return void
     */
    protected function setConfigRoot()
    {
        $this->configRoot = $this->appRoot . 'config' . DS;
    }

    /**
     * Set the module root.
     * 
     * @access protected
     * @return void
     */
    protected function setModuleRoot()
    {
        $this->moduleRoot = $this->appRoot . 'module' . DS;
    }

    /**
     * Set the www root.
     * 
     * @access protected
     * @return void
     */
    protected function setWwwRoot()
    {
        $this->wwwRoot = rtrim(dirname($_SERVER['SCRIPT_FILENAME']), DS) . DS;
    }

    /**
     * Set the data root.
     * 
     * @access protected
     * @return void
     */
    protected function setDataRoot()
    {
        $this->dataRoot = $this->wwwRoot . 'data' . DS;
    }

    /**
     * Set the data root.
     * 
     * @access protected
     * @return void
     */
    protected function setTplRoot()
    {
        $this->tplRoot = $this->wwwRoot . 'template' . DS;
    }

    /**
     * Filter superVars.
     * 
     * @access public
     * @return void
     */
    public function filterSuperVars()
    {
        $_POST   = processArrayEvils($_POST);
        $_GET    = processArrayEvils($_GET);
        $_COOKIE = processArrayEvils($_COOKIE);
        unset($_GLOBALS);
        unset($_REQUEST);
    }

    /**
     * Set the super vars.
     * 
     * @access protected
     * @return void
     */
    public function setSuperVars()
    {
        $this->post    = new super('post');
        $this->get     = new super('get');
        $this->server  = new super('server');
        $this->cookie  = new super('cookie');
        $this->session = new super('session');
        $this->global  = new super('global');
    }

    /**
     * Set the code of current site. 
     * 
     * www.xirang.com => xirang
     * xirang.com     => xirang
     * xirang.com.cn  => xirang
     * xirang.cn      => xirang
     * xirang         => xirang
     * 192.168.1.1    => 192.168.1.1
     *
     * @access protected
     * @return void
     */
    public function setSiteCode()
    {
        return $this->siteCode = helper::getSiteCode($this->server->http_host);
    }

    /**
     * set Debug 
     * 
     * @access public
     * @return void
     */
    public function setDebug()
    {
        if(!empty($this->config->debug)) error_reporting(E_ALL & ~ E_STRICT);
    }

    /**
     * Set the error handler.
     * 
     * @access public
     * @return void
     */
    public function setErrorHandler()
    {
        set_error_handler(array($this, 'saveError'));
        register_shutdown_function(array($this, 'shutdown'));
    }

    /**
     * Set the time zone according to the config.
     * 
     * @access public
     * @return void
     */
    public function setTimezone()
    {
        if(isset($this->config->timezone)) date_default_timezone_set($this->config->timezone);
    }

    /**
     * Get the $basePath var
     * 
     * @access public
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
    
    /**
     * Get the $frameRoot var
     * 
     * @access public
     * @return string
     */
    public function getFrameRoot()
    {
        return $this->frameRoot;
    }

    /**
     * Get the $coreLibRoot var
     * 
     * @access public
     * @return string
     */
    public function getCoreLibRoot()
    {
        return $this->coreLibRoot;
    }

    /**
     * Get the $appRoot var
     * 
     * @access public
     * @return string
     */
    public function getAppRoot()
    {
        return $this->appRoot;
    }
    
    /**
     * Get the $wwwRoot var
     * 
     * @access public
     * @return string
     */
    public function getWwwRoot()
    {
        return $this->wwwRoot;
    }

    /**
     * Get the $tmpRoot var
     * 
     * @access public
     * @return string
     */
    public function getTmpRoot()
    {
        return $this->tmpRoot;
    } 

    /**
     * Get the $logRoot var
     * 
     * @access public
     * @return string
     */
    public function getLogRoot()
    {
        return $this->logRoot;
    } 

    /**
     * Get the $configRoot var
     * 
     * @access public
     * @return string
     */
    public function getConfigRoot()
    {
        return $this->configRoot;
    }

    /**
     * Get the $moduleRoot var
     * 
     * @access public
     * @return string
     */
    public function getModuleRoot()
    {
        return $this->moduleRoot;
    }

    /**
     * Get the $dataroot var
     * 
     * @access public
     * @return string
     */
    public function getDataRoot()
    {
        return $this->dataRoot;
    }

    /**
     * Get the $dataroot var
     * 
     * @access public
     * @return string
     */
    public function getTplRoot()
    {
        return $this->tplRoot;
    }

    //-------------------- Client environment related functions --------------------//

    /**
     * Set the language used by the client user.
     * 
     * @param   string $lang  zh-cn|zh-tw|en
     * @access  public
     * @return  void
     */
    public function setClientLang($lang = '')
    {
        if(RUN_MODE != 'install' and RUN_MODE != 'upgrade' and RUN_MODE != 'shell'  and $this->config->installed)
        {
            $result = $this->dbh->query("select value from " . TABLE_CONFIG . " where owner = 'system' and module = 'common' and section = 'site' and `key` = 'defaultLang'")->fetch();
            $defaultLang = !empty($result->value) ? $result->value : $this->config->default->lang;

            $result = $this->dbh->query("select value from " . TABLE_CONFIG . " where owner = 'system' and module = 'common' and section = 'site' and `key` = 'lang'")->fetch();
            $enabledLangs = isset($result->value) ? $result->value : '';

            $result = $this->dbh->query("select value from " . TABLE_CONFIG . " where owner = 'system' and module = 'common' and section = 'site' and `key` = 'cn2tw'")->fetch();
            $this->config->cn2tw = isset($result->value) ? $result->value : '';

            if(empty($enabledLangs))
            {
                $enabledLangs = array_keys($this->config->langs);
            }
            else
            {
                $enabledLangs = explode(',', $enabledLangs);
            }
            if(!in_array($defaultLang, $enabledLangs)) $defaultLang = current($enabledLangs);

            /* Set default lang. */
            $this->config->default->lang = $defaultLang;
        }
        else
        {
            $defaultLang  = $this->config->default->lang;
            $enabledLangs = array_keys($this->config->langs);
        }
            
        $langCookieVar = RUN_MODE . 'Lang';

        if(!empty($lang))
        {
            $this->clientLang = $lang;
        }
        elseif(RUN_MODE == 'front')
        {
            if(strpos($this->server->http_referer, 'm=visual') !== false and !empty($_COOKIE['adminLang'])) 
            {
                $this->clientLang = $_COOKIE['adminLang'];
            }
            else
            {
                $flipedLangs = array_flip($this->config->langsShortcuts);
                if($this->config->requestType == 'GET' and isset($_GET[$this->config->langVar])) $this->clientLang = $flipedLangs[$_GET[$this->config->langVar]];
                if($this->config->requestType != 'GET')
                {
                    $pathInfo = $this->getPathInfo();
                    foreach($this->config->langsShortcuts as $language => $code)
                    {
                        if(strpos(trim($pathInfo, '/'), $code) === 0) $this->clientLang = $language;
                    }
                }
            }
        }
        elseif(isset($_COOKIE[$langCookieVar]))
        {
            $this->clientLang = $_COOKIE[$langCookieVar];
        }
        elseif(RUN_MODE == 'admin' and isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $this->clientLang = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',') === false ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ','));
        }

        if(!empty($this->clientLang) and in_array($this->clientLang, $enabledLangs)) 
        {
            $this->clientLang = strtolower($this->clientLang);
        }
        else
        {
            $this->clientLang = $defaultLang;
        }
        setcookie('lang', $this->clientLang, $this->config->cookieLife, $this->config->cookiePath);

        if(in_array($this->clientLang, $enabledLangs)) return $this->clientLang;
    }

    /**
     * Set lang code.
     * 
     * @access public
     * @return void
     */
    public function fixLangConfig()
    {
        $langCode = $this->clientLang == $this->config->default->lang ? '' : $this->config->langsShortcuts[$this->clientLang];
        $this->config->langCode = $langCode;
        $this->config->homeRoot = getHomeRoot();
    }

    /**
     * Get the $clientLang var.
     * 
     * @access public
     * @return string
     */
    public function getClientLang()
    {
        return $this->clientLang;
    }

    /**
     * Get the $webRoot var.
     * 
     * @access public
     * @return string
     */
    public function getWebRoot()
    {
        return $this->config->webRoot;
    }

    /**
     * Fix REQUEST_URI of iis.
     * 
     * @access public
     * @return void
     */
    public function fixRequestURI()
    {
        if($this->config->requestType == 'GET') return true;

        if(isset($_SERVER['HTTP_X_REWRITE_URL']))
        {
            $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
        }
        elseif(isset($_SERVER['HTTP_REQUEST_URI']))
        {
            $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_REQUEST_URI'];
        }
    }

    //-------------------- Request related methods. --------------------//

    /**
     * The entrance of parseing request. According to the requestType, call related methods.
     * 
     * @access public
     * @return void
     */
    public function parseRequest()
    {
        if(isGetUrl())
        {
            if($this->config->requestType == 'PATH_INFO2') define('FIX_PATH_INFO2', true);
            $this->config->requestType = 'GET';
        }

        if($this->config->requestType == 'PATH_INFO' or $this->config->requestType == 'PATH_INFO2')
        {
            $this->parsePathInfo();

            $langCode = $this->config->langsShortcuts[$this->clientLang];
            if(strpos($this->URI, $langCode) === 0) $this->URI = substr($this->URI, strlen($langCode) + 1);

            $this->URI = seo::parseURI($this->URI);

            $this->setRouteByPathInfo();
        }
        elseif($this->config->requestType == 'GET')
        {
            $this->parseGET();
            $this->setRouteByGET();
        }
        else
        {
            $this->triggerError("The request type {$this->config->requestType} not supported", __FILE__, __LINE__, $exit = true);
        }
    }

    /**
     * Parse PATH_INFO, get the $URI and $viewType.
     * 
     * @access public
     * @return void
     */
    public function parsePathInfo()
    {
        $pathInfo = $this->getPathInfo();
        if(trim($pathInfo, '/') == trim($this->config->webRoot, '/')) $pathInfo = '';
        if(!empty($pathInfo))
        {
            $dotPos = strrpos($pathInfo, '.');
            if($dotPos)
            {
                $this->URI      = substr($pathInfo, 0, $dotPos);
                $this->viewType = substr($pathInfo, $dotPos + 1);
                if(strpos($this->config->views, ',' . $this->viewType . ',') === false)
                {
                    $this->viewType = $this->config->default->view;
                }
            }
            else
            {
                $this->URI      = $pathInfo;
                $this->viewType = $this->config->default->view;
            }
        }
        else
        {
            $this->viewType = $this->config->default->view;
        }
    }

    /**
     * Get $PATH_INFO from $_SERVER or $_ENV.
     *
     * @access  private
     * @return  string the PATH_INFO
     */
    public function getPathInfo()
    {
        if(isset($_SERVER['PATH_INFO']))
        {
            $value = $_SERVER['PATH_INFO'];
        }
        elseif(isset($_SERVER['ORIG_PATH_INFO']))
        {
            $value = $_SERVER['ORIG_PATH_INFO'];
        }
        elseif(isset($_SERVER['REQUEST_URI']))
        {
            $value = $_SERVER['REQUEST_URI'];
        }
        else
        {
            $value = @getenv('PATH_INFO');
            if(empty($value)) $value = @getenv('ORIG_PATH_INFO');
            if(empty($value)) $value = @getenv('REQUEST_URI');
            if(strpos($value, $_SERVER['SCRIPT_NAME']) !== false) $value = str_replace($_SERVER['SCRIPT_NAME'], '', $value);
        }

        if(strpos($value, '?') === false) return trim($value, '/');
        $value = parse_url($value);
        return trim($value['path'], '/');
    }

    /**
     * Parse GET, get $URI and $viewType.
     * 
     * @access private
     * @return void
     */
    private function parseGET()
    {
        if(isset($_GET[$this->config->viewVar]))
        {
            $this->viewType = $_GET[$this->config->viewVar]; 
            if(strpos($this->config->views, ',' . $this->viewType . ',') === false)
            {
                $this->viewType = $this->config->default->view;
            }
        }
        else
        {
            $this->viewType = $this->config->default->view;
        }
        $this->URI = $_SERVER['REQUEST_URI'];
    }
    
    /**
     * Get the $URL
     * 
     * @param  bool $full  true, the URI contains the webRoot, else only hte URI.
     * @access public
     * @return string
     */
    public function getURI($full = false)
    {
        if($full and $this->config->requestType == 'PATH_INFO')
        {
            if($this->URI) return $this->config->webRoot . $this->URI . '.' . $this->viewType;
            return $this->config->webRoot;
        }
        return $this->URI;
    }

    /**
     * Get the $viewType var.
     * 
     * @access public
     * @return string
     */
    public function getViewType()
    {
        return $this->viewType;
    }

    //-------------------- Routing related methods.--------------------//

    /**
     * Load the common module
     *
     *  The common module is a special module, which can be used to do some common things. For examle:
     *  start session, check priviledge and so on.
     *  This method should called manually in the router file(www/index.php) after the $lang, $config, $dbh loadde.
     *
     * @access public
     * @return object|bool  the common control object or false if not exits.
     */
    public function loadCommon()
    {
        $this->setModuleName('common');
        $commonModelFile = helper::setModelFile('common');
        if(file_exists($commonModelFile))
        {
            helper::import($commonModelFile);
            if(class_exists('extcommonModel'))
            {
                return new extcommonModel();
            }
            elseif(class_exists('commonModel'))
            {
                return new commonModel();
            }
            else
            {
                return false;
            }
        }
    }

    /**
     * Set the name of the module to be called.
     * 
     * @param   string $moduleName  the module name
     * @access  public
     * @return  void
     */
    public function setModuleName($moduleName = '')
    {
        if(!preg_match('/^[a-zA-Z0-9]+$/', $moduleName)) $this->triggerError("The modulename '$moduleName' illegal. ", __FILE__, __LINE__, $exit = true);
        $this->moduleName = strip_tags(urldecode(strtolower($moduleName)));
    }

    /**
     * Set the control file of the module to be called.
     * 
     * @param   bool    $exitIfNone     If control file not foundde, how to do. True, die the whole app. false, log error.
     * @access  public
     * @return  bool
     */
    public function setControlFile($exitIfNone = true)
    {
        $modulePath = $this->getModulePath();
        $this->controlFile = $modulePath . DS . 'ext' . DS . '_' . $this->siteCode . DS . 'control' . DS . $this->methodName . '.php';
        if(is_file($this->controlFile)) return true;

        $this->controlFile = $modulePath . DS . 'ext' . DS . 'control' . DS . $this->methodName . '.php';
        if(is_file($this->controlFile)) return true;

        $this->controlFile = $modulePath . DS . 'control.php';

        if(!is_file($this->controlFile) && $this->getModuleName() != 'error') 
        {
            if($this->server->request_uri == '/favicon.ico') die();
            $this->setModuleName('error');
            $this->setMethodName('index');
            return $this->setControlFile();
        }
        return true;
    }

    /**
     * Set the name of the method calling.
     * 
     * @param string $methodName 
     * @access public
     * @return void
     */
    public function setMethodName($methodName = '')
    {
        if(!preg_match('/^[a-zA-Z0-9]+$/', $methodName)) $this->triggerError("The methodname '$methodName' illegal. ", __FILE__, __LINE__, $exit = true);
        $this->methodName = strip_tags(urldecode(strtolower($methodName)));
    }

    /**
     * Get the path of one module.
     * 
     * @param  string $moduleName    the module name
     * @access public
     * @return string the module path
     */
    public function getModulePath($moduleName = '')
    {
        if($moduleName == '') $moduleName = $this->moduleName;
        if(!preg_match('/^[a-zA-Z0-9]+$/', $moduleName)) $this->triggerError("The modulename '$moduleName' illegal. ", __FILE__, __LINE__, $exit = true);
        $modulePath = $this->getModuleRoot() . strtolower(trim($moduleName)) . DS;
        if(!file_exists($modulePath)) $modulePath = $this->getModuleRoot() . 'ext' . DS . '_' . $this->siteCode . DS . $moduleName . DS;
        return $modulePath;
    }

    /**
     * Get extension path of one module.
     * 
     * @param   string $moduleName     the module name
     * @param   string $ext            the extension type, can be control|model|view|lang|config
     * @access  public
     * @return  string the extension path.
     */
    public function getModuleExtPath($moduleName, $ext)
    {
        if(!preg_match('/^[a-zA-Z0-9]+$/', $moduleName) or !preg_match('/^[a-zA-Z0-9]+$/', $ext)) $this->triggerError("The modulename '$moduleName' or ext '$ext' illegal. ", __FILE__, __LINE__, $exit = true);
        $paths = array();
        $paths['common'] = $this->getModulePath($moduleName) . 'ext' . DS . $ext . DS;
        $paths['site'] = $this->getModulePath($moduleName) . 'ext' . DS . '_' . $this->siteCode . DS . $ext . DS;
        return $paths;
    }

    /**
     * Set the action extension file.
     * 
     * @access  public
     * @return  bool
     */
    public function setActionExtFile()
    {
        $moduleExtPaths = $this->getModuleExtPath($this->moduleName, 'control');

        $this->extActionFile = $moduleExtPaths['site'] . $this->methodName . '.php';
        if(!file_exists($this->extActionFile)) $this->extActionFile = $moduleExtPaths['common'] . $this->methodName . '.php';

        return file_exists($this->extActionFile);
    }

    /**
     * Set the route according to PATH_INFO.
     * 
     * 1. set the module name.
     * 2. set the method name.
     * 3. set the control file.
     *
     * @access public
     * @return void
     */
    public function setRouteByPathInfo()
    {
        if(!empty($this->URI))
        { 
            /* There's the request seperator, split the URI by it. */
            if(strpos($this->URI, '-') !== false)
            {
                $items = explode('-', $this->URI);
                $this->setModuleName($items[0]);
                $this->setMethodName($items[1]);
            }    
            /* No reqeust seperator, use the default method name. */
            else
            {
                $this->setModuleName($this->URI);
                $this->setMethodName($this->config->default->method);
            }
        }
        else
        {    
            $this->setModuleName($this->config->default->module);   // use the default module.
            $this->setMethodName($this->config->default->method);   // use the default method.
        }
        $this->setControlFile();
    }

    /**
     * Set the route according to GET.
     * 
     * 1. set the module name.
     * 2. set the method name.
     * 3. set the control file.
     *
     * @access public
     * @return void
     */
    public function setRouteByGET()
    {
        $moduleName = isset($_GET[$this->config->moduleVar]) ? strtolower($_GET[$this->config->moduleVar]) : $this->config->default->module;
        $methodName = isset($_GET[$this->config->methodVar]) ? strtolower($_GET[$this->config->methodVar]) : $this->config->default->method;
        $this->setModuleName($moduleName);
        $this->setMethodName($methodName);

        if(strpos($this->URI, '/index.php/user-oauthCallback-qq.html') !== false)
        {    
            $this->setModuleName('user');
            $this->setMethodName('oauthCallback');
            array_unshift($_GET, 'qq');
        }    

        $this->setControlFile();
    }

    /**
     * Load a module.
     *
     * 1. include the control file or the extension action file.
     * 2. create the control object.
     * 3. set the params passed in through url.
     * 4. call the method by call_user_function_array
     * 
     * @access public
     * @return bool|object  if the module object of die.
     */
    public function loadModule()
    {
        $moduleName = $this->moduleName;
        $methodName = $this->methodName;

        /* Include the contror file of the module. */
        $file2Included = $this->setActionExtFile() ? $this->extActionFile : $this->controlFile;
        chdir(dirname($file2Included));
        include $file2Included;

        /* Set the class name of the control. */
        $className = class_exists("my$moduleName") ? "my$moduleName" : $moduleName;
        if(!class_exists($className)) $this->triggerError("the control $className not found", __FILE__, __LINE__, $exit = true);

        /* Create a instance of the control. */
        $module = new $className();
        if(!method_exists($module, $methodName)) $this->triggerError("the module $moduleName has no $methodName method", __FILE__, __LINE__, $exit = true);
        $this->control = $module;

        /* include default value for module*/
        $defaultValueFiles = glob($this->getTmpRoot() . "defaultvalue/*.php");
        if($defaultValueFiles) foreach($defaultValueFiles as $file) include $file;

        /* Get the default setings of the method to be called useing the reflecting. */
        $defaultParams = array();
        $methodReflect = new reflectionMethod($className, $methodName);

        if($this->config->requestType == 'GET') unset($_GET[$this->config->langVar]);
        foreach($methodReflect->getParameters() as $param)
        {
            $name = $param->getName();
            
            $default = '_NOT_SET';
            if(isset($paramDefaultValue[$className][$methodName][$name]))
            {
                $default = $paramDefaultValue[$className][$methodName][$name];
            }
            elseif($param->isDefaultValueAvailable())
            {
                $default = $param->getDefaultValue();
            }

            $defaultParams[$name] = $default;
        }

        /* Set params according PATH_INFO or GET. */
        if($this->config->requestType != 'GET')
        {   
            $this->setParamsByPathInfo($defaultParams);
        }
        else
        {
            $this->setParamsByGET($defaultParams);
        }

        /* Call the method. */
        call_user_func_array(array(&$module, $methodName), $this->params);
        return $module;
    }

    /**
     * Set the params by PATH_INFO
     * 
     * @param   array $defaultParams the default settings of the params.
     * @access  public
     * @return  void
     */
    public function setParamsByPathInfo($defaultParams = array())
    {
        /* Spit the URI. */
        $items     = explode('-', $this->URI);
        $itemCount = count($items);

        /* The first two item is moduleName and methodName. So the params should begin at 2.*/
        $params = array();
        for($i = 2; $i < $itemCount; $i ++)
        {
            $key = key($defaultParams);     // Get key from the $defaultParams.
            $params[$key] = str_replace('.', '-', $items[$i]);
            next($defaultParams);
        }
        $this->params = $this->mergeParams($defaultParams, $params);
    }

    /**
     * Set the params by GET.
     * 
     * @param   array $defaultParams the default settings of the params.
     * @access  public
     * @return  void
     */
    public function setParamsByGET($defaultParams)
    {
        /* Unset the moduleVar, methodVar, viewVar and session var, all the left are the params. */
        unset($_GET[$this->config->moduleVar]);
        unset($_GET[$this->config->methodVar]);
        unset($_GET[$this->config->viewVar]);
        unset($_GET[$this->config->sessionVar]);
        $this->params = $this->mergeParams($defaultParams, $_GET);
    }

    /**
     * Merge the params passed in and the default params. Thus the params which have default values needn't pass value, just like a function.
     *
     * @param   array $defaultParams     the default params defined by the method.
     * @param   array $passedParams      the params passed in through url.
     * @access  private
     * @return  array the merged params.
     */
    private function mergeParams($defaultParams, $passedParams)
    {
        //foreach($passedParams as $k => $v)
        //{ 
        //    if(in_array(strtolower($k), array('words', 'referer', 'url', 'page'), true)) continue;
        //    if(!empty($v) and !preg_match('/^[a-zA-Z0-9\/.]+$/', $v)) die('Wrong');
        //}

        $passedParams = array_values($passedParams);

        $i = 0;
        foreach($defaultParams as $key => $defaultValue)
        {
            if(isset($passedParams[$i]))
            {
                $defaultParams[$key] = strip_tags(urldecode($passedParams[$i]));
            }
            else
            {
                if($defaultValue === '_NOT_SET') $this->triggerError("The param '$key' should pass value. ", __FILE__, __LINE__, $exit = true);
            }
            $i ++;
        }
        return $defaultParams;
    }
 
    /**
     * Get the $moduleName var.
     * 
     * @access public
     * @return string
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Get the $controlFile var.
     * 
     * @access public
     * @return string
     */
    public function getControlFile()
    {
        return $this->controlFile;
    }

    /**
     * Get the $methodName var.
     * 
     * @access public
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Get the $param var.
     * 
     * @access public
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    //-------------------- Tool methods.------------------//

    /**
     * Load a class file.
     * 
     * @param   string $className  the class name
     * @param   bool   $static     statis class or not
     * @access  public
     * @return  object|bool the instance of the class or just true.
     */
    public function loadClass($className, $static = false)
    {
        $className = strtolower($className);

        /* Search in $coreLibRoot. */
        $classFile = $this->coreLibRoot . $className;
        if(is_dir($classFile)) $classFile .= DS . $className;
        $classFile .= '.class.php';
        if(!helper::import($classFile)) $this->triggerError("class file $classFile not found", __FILE__, __LINE__, $exit = true);

        /* If staitc, return. */
        if($static) return true;

        /* Instance it. */
        global $$className;
        if(!class_exists($className)) $this->triggerError("the class $className not found in $classFile", __FILE__, __LINE__, $exit = true);
        if(!is_object($$className)) $$className = new $className();
        return $$className;
    }

    /**
     * Load config and return it as the global config object.
     * 
     * If the module is common, search in $configRoot, else in $modulePath.
     *
     * @param   string $moduleName     module name
     * @param   bool  $exitIfNone     exit or not
     * @access  public
     * @return  object|bool the config object or false.
     */
    public function loadConfig($moduleName, $exitIfNone = true)
    {
        global $config;
        if($config and (!isset($config->$moduleName) or !is_object($config->$moduleName))) $config->$moduleName = new stdclass();
        $extConfigFiles = array();

        /* Set the main config file and extension config file. */
        if($moduleName == 'common')
        {
            $mainConfigFile = $this->configRoot . 'config.php';

            $extConfigFiles = array();
        }
        else
        {
            $mainConfigFile = $this->getModulePath($moduleName) . 'config.php';
            
            /* Get config extension. */
            $extConfigPath        = $this->getModuleExtPath($moduleName, 'config');
            $commonExtConfigFiles = helper::ls($extConfigPath['common'], '.php');
            $siteExtConfigFiles   = helper::ls($extConfigPath['site'], '.php');
            $extConfigFiles       = array_merge($commonExtConfigFiles, $siteExtConfigFiles);
        }

        /* Set the files to include. */
        $configFiles = array_merge(array($mainConfigFile), $extConfigFiles);

        if(empty($configFiles))
        {
            if($exitIfNone)  self::triggerError("config file $mainConfigFile not found", __FILE__, __LINE__, true);
        }
        
        if(!is_object($config)) $config = new config();
        static $loadedConfigs = array();
        foreach($configFiles as $configFile)
        {
            if(in_array($configFile, $loadedConfigs)) continue;
            if(is_file($configFile)) include $configFile;
            $loadedConfigs[] = $configFile;
        }

        if($moduleName == 'common')
        {
            $this->config = $config;
            $this->setSiteCode();
            if(!isset($config->site)) $config->site = new stdclass();
            $config->site->code = $this->siteCode;

            if($config->multi)
            {
                $multiConfigFile = $this->configRoot . "multi.php";
                if(is_file($multiConfigFile)) include $multiConfigFile;
            }

            $siteConfigFile = $this->configRoot . "sites/{$this->siteCode}.php";
            if(is_file($siteConfigFile)) include $siteConfigFile;
        }

        /* Merge from the db configs. */
        if($moduleName != 'common' and isset($config->system->$moduleName))
        {
            if(!isset($config->$moduleName)) $config->$moduleName = new stdclass();    // Init the $config->$moduleName if not set.

            foreach($config->system->$moduleName as $item)
            {
                if($item->section)
                {
                    if(!isset($config->{$moduleName}->{$item->section})) $config->{$moduleName}->{$item->section} = new stdclass();
                    if(is_object($config->{$moduleName}->{$item->section}))
                    {
                        $config->{$moduleName}->{$item->section}->{$item->key} = $item->value;
                    }
                }
                else
                {
                    $config->{$moduleName}->{$item->key} = $item->value;
                }
            }
        }

        /* Assign config to router and set site code if the module is common. */
        $this->config = $config;
        return $config;
    }

    /**
     * Export the config params to the client, thus the client can adjust it's logic according the config.
     * 
     * @access public
     * @return void
     */
    public function exportConfig()
    {
        $view = new stdClass();
        $view->version     = $this->config->version;
        $view->requestType = $this->config->requestType;
        $view->requestFix  = $this->config->requestFix;
        $view->moduleVar   = $this->config->moduleVar;
        $view->methodVar   = $this->config->methodVar;
        $view->viewVar     = $this->config->viewVar;
        $view->sessionVar  = $this->config->sessionVar;
        echo json_encode($view);
    }
    
    /**
     * Load lang and return it as the global lang object.
     * 
     * @param   string $moduleName     the module name
     * @access  public
     * @return  bool|ojbect the lang object or false.
     */
    public function loadLang($moduleName)
    {
        global $app;
        $langFiles = array();

        $modulePath   = $this->getModulePath($moduleName);
        $mainLangFile = $modulePath . 'lang' . DS . $this->clientLang . '.php';

        if(file_exists($mainLangFile)) $langFiles[] = $mainLangFile;

        if(is_object($app))
        {
            $device = helper::getDevice();
            $langPath = $this->getTplRoot() . $this->config->template->{$device}->name . DS . '_lang' . DS . $moduleName . DS; 
            $templateLangFile = $langPath . $this->clientLang . '.php';

            if(file_exists($templateLangFile)) $langFiles[] = $templateLangFile;
        }

        /* get ext lang files. */
        $extLangPath        = $this->getModuleExtPath($moduleName, 'lang');
        $commonExtLangFiles = helper::ls($extLangPath['common'] . $this->clientLang, '.php');
        $siteExtLangFiles   = helper::ls($extLangPath['site'] . $this->clientLang, '.php');
        $extLangFiles       = array_merge($commonExtLangFiles, $siteExtLangFiles);

        $langFiles = array_merge($langFiles, $extLangFiles);

        /* Set the files to includ. */
        if(empty($langFiles)) return false;

        global $lang;
        if(!is_object($lang)) $lang = new language();
        if(!isset($lang->$moduleName)) $lang->$moduleName = new stdclass();

        static $loadedLangs = array();
        foreach($langFiles as $langFile)
        {
            if(in_array($langFile, $loadedLangs)) continue;
            include $langFile;
            $loadedLangs[] = $langFile;
        }

        $this->lang = $lang;
        return $lang;
    }
    
    /**
     * Connect to database.
     * 
     * @access public
     * @return void
     */
    public function connectDB()
    {
        global $config, $dbh, $slaveDBH;

        if(isset($config->db->host))      $this->dbh      = $dbh      = $this->connectByPDO($config->db);
        if(isset($config->slaveDB->host)) $this->slaveDBH = $slaveDBH = $this->connectByPDO($config->slaveDB);
        return $dbh;
    }

    /**
     * Connect database by PDO.
     * 
     * @param  object    $params    the database params.
     * @access private
     * @return object|bool
     */
    private function connectByPDO($params)
    {
        if(!isset($params->driver)) self::triggerError('no pdo driver defined, it should be mysql or sqlite', __FILE__, __LINE__, $exit = true);
        if(!isset($params->user)) return false;
        if($params->driver == 'mysql')
        {
            $dsn = "mysql:host={$params->host}; port={$params->port}; dbname={$params->name}";
        }    
        try 
        {
            $dbh = new PDO($dsn, $params->user, $params->password, array(PDO::ATTR_PERSISTENT => $params->persistant));
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("SET NAMES {$params->encoding}");
            if(isset($params->strictMode) and $params->strictMode == false) $dbh->exec("SET @@sql_mode= ''");
            if(isset($params->checkCentOS) and $params->checkCentOS and helper::isCentOS())
            {
                $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
                $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            }
            return $dbh;
        }
        catch (PDOException $exception)
        {
            self::triggerError($exception->getMessage(), __FILE__, __LINE__, $exit = true);
        }
    }

    //-------------------- Error methods.------------------//
    
    /**
     * The shutdown handler.
     * 
     * @access public
     * @return void
     */
    public function shutdown()
    {
        /* If debug on, save sql lines. */
        if(!empty($this->config->debug)) $this->saveSQL();

        /* If any error occers, save it. */
        if(!function_exists('error_get_last')) return;
        $error = error_get_last();
        if($error) $this->saveError($error['type'], $error['message'], $error['file'], $error['line']);
    }

    /**
     * Trriger an error.
     * 
     * @param string    $message    error message
     * @param string    $file       the file error occers
     * @param int       $line       the line error occers
     * @param bool      $exit       exit the program or not
     * @access public
     * @return void
     */
    public function triggerError($message, $file, $line, $exit = false)
    {
        /* Set the error info. */
        $log = "ERROR: $message in $file on line $line";
        if(isset($_SERVER['SCRIPT_URI'])) $log .= ", request: $_SERVER[SCRIPT_URI]";; 
        $trace = debug_backtrace();
        extract($trace[0]);
        extract($trace[1]);
        $log .= ", last called by $file on line $line through function $function.\n";

        /* Trigger it. */
        trigger_error($log, $exit ? E_USER_ERROR : E_USER_WARNING);
    }

    /**
     * Save error info.
     * 
     * @param  int    $level 
     * @param  string $message 
     * @param  string $file 
     * @param  int    $line 
     * @access public
     * @return void
     */
    public function saveError($level, $message, $file, $line)
    {
        /* Skip the error: Redefining already defined constructor. */
        if(strpos($message, 'Redefining') !== false) return true;

        /* Set the error info. */
        $errorLog  = "\n" . date('H:i:s') . " $message in <strong>$file</strong> on line <strong>$line</strong> ";
        $errorLog .= "when visiting <strong>" . $this->getURI() . "</strong>\n";

        /* If the ip is pulic, hidden the full path of scripts. */
        if(RUN_MODE != 'shell' and !($this->server->server_addr == '127.0.0.1' or filter_var($this->server->server_addr, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) === false))
        {
            $errorLog  = str_replace($this->getBasePath(), '', $errorLog);
            $errorLog  = str_replace($this->wwwRoot, '', $errorLog);
        }

        /* Save to log file. */
        $errorFile = $this->getLogRoot() . 'php.' . date('Ymd') . '.php';

        if(!file_exists($errorFile)) file_put_contents($errorFile, "<?php die();?> \n");

        if($this->config->debug)
        {
            $fh = @fopen($errorFile, 'a');
            if($fh) fwrite($fh, strip_tags($errorLog)) && fclose($fh);
        }

        /* If the debug > 1, show warning, notice error. */
        if($level == E_NOTICE or $level == E_WARNING or $level == E_STRICT or $level == 8192) // 8192: E_DEPRECATED
        {
            if(!empty($this->config->debug) and $this->config->debug > 1)
            {
                $cmd  = "vim +$line $file";
                $size = strlen($cmd);
                echo "<pre class='alert alert-danger'>$message: ";
                echo "<input type='text' value='$cmd' size='$size' style='border:none; background:none;' onmouseover='this.select();' /></pre>";
            }
        }

        /* If error level is serious, die.  */
        if($level == E_ERROR or $level == E_PARSE or $level == E_CORE_ERROR or $level == E_COMPILE_ERROR or $level == E_USER_ERROR)
        {
            if(empty($this->config->debug)) die();
            if(PHP_SAPI == 'cli') die($errorLog);

            $htmlError  = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /></head>";
            $htmlError .= "<body>" . nl2br($errorLog) . "</body></html>";
            die($htmlError);
        }
    }

    /**
     * Header to error page.
     * 
     * return void
     */
     public function headError()
     {
        $this->setModuleName('error');
        $this->setMethodName('index');
        $this->setControlFile();
        $this->loadModule();
     }

    /**
     * Save the sql.
     * 
     * @access protected
     * @return void
     */
    public function saveSQL()
    {
        if(!$this->config->debug) return true;
        if(!class_exists('dao')) return;

        $sqlLog = $this->getLogRoot() . 'sql.' . date('Ymd') . '.php';

        if(!file_exists($sqlLog)) file_put_contents($sqlLog, "<?php die();?> \n");

        $fh = @fopen($sqlLog, 'a');
        if(!$fh) return false;
        fwrite($fh, date('Ymd H:i:s') . ": " . $this->getURI() . "\n");
        foreach(dao::$querys as $query) fwrite($fh, "  $query\n");
        fwrite($fh, "\n");
        fclose($fh);
    }
}

/**
 * The config class.
 * 
 * @package framework
 */
class config
{ 
    /**
     * Set the value of a member. the member can be the foramt like db.user.
     * 
     * <code>
     * <?php
     * $config->set('db.user', 'wwccss'); 
     * ?>
     * </code>
     * @param   string  $key    the key of the member
     * @param   mixed   $value  the value
     * @access  public
     * @return  void
     */
    public function set($key, $value)
    {
        helper::setMember('config', $key, $value);
    }
}

/**
 * The lang class.
 * 
 * @package chanzhiEPS
 */
class language 
{
    /**
     * Set the value of a member. the member can be the foramt like db.user.
     * 
     * <code>
     * <?php
     * $lang->set('version', '1.0); 
     * ?>
     * </code>
     * @param   string  $key    the key of the member, can be father.child
     * @param   mixed   $value  the value
     * @access  public
     * @return  void
     */
    public function set($key, $value)
    {
        helper::setMember('lang', $key, $value);
    }

    /**
     * Show a member 
     * 
     * @param   object $obj    the object
     * @param   string $key    the key
     * @access  public
     * @return  void
     */
    public function show($obj, $key)
    {
        $obj = (array)$obj;
        if(isset($obj[$key])) echo $obj[$key]; else echo '';
    }
}

/**
 * The super object class.
 * 
 * @package chanzhiEPS
 */
class super
{
    /**
     * Construct, set the var scope.
     * 
     * @param   string $scope  the score, can be server, post, get, cookie, session, global
     * @access  public
     * @return  void
     */
    public function __construct($scope)
    {
        $this->scope = $scope;
    }

    /**
     * Set one member value. 
     * 
     * @param   string    the key
     * @param   mixed $value  the value
     * @access  public
     * @return  void
     */
    public function set($key, $value)
    {
        if($this->scope == 'post')
        {
            $_POST[$key] = $value;
        }
        elseif($this->scope == 'get')
        {
            $_GET[$key] = $value;
        }
        elseif($this->scope == 'server')
        {
            $_SERVER[$key] = $value;
        }
        elseif($this->scope == 'cookie')
        {
            $_COOKIE[$key] = $value;
        }
        elseif($this->scope == 'session')
        {
            $_SESSION[$key] = $value;
        }
        elseif($this->scope == 'env')
        {
            $_ENV[$key] = $value;
        }
        elseif($this->scope == 'global')
        {
            $GLOBAL[$key] = $value;
        }
    }

    /**
     * The magic get method.
     * 
     * @param  string $key    the key
     * @access public
     * @return mixed|bool return the value of the key or false.
     */
    public function __get($key)
    {
        if($this->scope == 'post')
        {
            if(isset($_POST[$key])) return $_POST[$key];
            return false;
        }
        elseif($this->scope == 'get')
        {
            if(isset($_GET[$key])) return $_GET[$key];
            return false;
        }
        elseif($this->scope == 'server')
        {
            if(isset($_SERVER[$key])) return $_SERVER[$key];
            $key = strtoupper($key);
            if(isset($_SERVER[$key])) return $_SERVER[$key];
            return false;
        }
        elseif($this->scope == 'cookie')
        {
            if(isset($_COOKIE[$key])) return $_COOKIE[$key];
            return false;
        }
        elseif($this->scope == 'session')
        {
            if(isset($_SESSION[$key])) return $_SESSION[$key];
            return false;
        }
        elseif($this->scope == 'env')
        {
            if(isset($_ENV[$key])) return $_ENV[$key];
            return false;
        }
        elseif($this->scope == 'global')
        {
            if(isset($GLOBALS[$key])) return $GLOBALS[$key];
            return false;
        }
        else
        {
            return false;
        }
    }

    /**
     * Print the structure.
     * 
     * @access public
     * @return void
     */
    public function a()
    {
        if($this->scope == 'post')    a($_POST);
        if($this->scope == 'get')     a($_GET);
        if($this->scope == 'server')  a($_SERVER);
        if($this->scope == 'cookie')  a($_COOKIE);
        if($this->scope == 'session') a($_SESSION);
        if($this->scope == 'env')     a($_ENV);
        if($this->scope == 'global')  a($GLOBAL);
    }
}
