<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of common module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     common
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class commonModel extends model
{
    /**
     * Do some init functions.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->startSession();
        $this->setUser();
        $this->loadConfigFromDB();
        $this->loadAlias();
        $this->loadModel('site')->setSite();
    }

    /**
     * Load configs from database and save it to config->system and config->personal.
     *
     * @access public
     * @return void
     */
    public function loadConfigFromDB()
    {
        /* Get configs of system and current user. */
        $account = isset($this->app->user->account) ? $this->app->user->account : '';
        if($this->config->db->name) $config  = $this->loadModel('setting')->getSysAndPersonalConfig($account);
        $this->config->system   = isset($config['system']) ? $config['system'] : array();
        $this->config->personal = isset($config[$account]) ? $config[$account] : array();

        /* Overide the items defined in config/config.php and config/my.php. */
        foreach($this->config->system as $module => $records)
        {
            if($module == 'common')
            {
                foreach($this->config->system->common as $record)
                {
                    if($record->section)
                    {
                        if(!isset($this->config->{$record->section})) $this->config->{$record->section} = new stdclass();
                        if($record->key)
                        {
                            if($record->section == 'guarder') $record->value = json_decode($record->value);
                            $this->config->{$record->section}->{$record->key} = $record->value;
                        }
                    }
                    else
                    {
                        if(!$record->section) $this->config->{$record->key} = $record->value;
                    }
                }
            }
            else
            {
                foreach($this->config->system->$module as $record)
                {
                    if($record->module)
                    {
                        if(!isset($this->config->{$record->module})) $this->config->{$record->module} = new stdclass();
                        if($record->section)
                        {
                            if(!isset($this->config->{$record->module}->{$record->section})) $this->config->{$record->module}->{$record->section} = new stdclass();
                            if($record->key) $this->config->{$record->module}->{$record->section}->{$record->key} = $record->value;
                        }
                        else
                        {
                            if(!$record->section) $this->config->{$record->module}->{$record->key} = $record->value;
                        }
                    }
                }
            }
        }

        $device = helper::getDevice();
        if(isset($this->config->template->desktop) and !is_object($this->config->template->desktop)) $this->config->template->desktop = json_decode($this->config->template->desktop);
        if(isset($this->config->template->mobile) and !is_object($this->config->template->mobile)) $this->config->template->mobile = json_decode($this->config->template->mobile);
        if(!isset($this->config->site->status)) $this->config->site->status = 'normal';
    }

    /**
     * Start the session.
     *
     * @access public
     * @return void
     */
    public function startSession()
    {
        if(!defined('SESSION_STARTED'))
        {
            $sessionName = $this->config->sessionVar;
            session_name($sessionName);
            session_start();
            define('SESSION_STARTED', true);
        }
    }

    /**
     * Check the priviledge.
     *
     * @access public
     * @return void
     */
    public function checkPriv()
    {
        if($this->config->site->filterFunction == 'open')
        {
            if($this->server->request_method == 'post') $inBlackList = $this->loadModel('guarder')->logOperation('ip', 'post');
            $inList = $this->loadModel('guarder')->inList();
            if($inList) die('Request Forbidden');
        }
        $module = $this->app->getModuleName();
        $method = $this->app->getMethodName();

        if($this->isOpenMethod($module, $method)) return true;

        /* If no $app->user yet, go to the login pae. */
        if(RUN_MODE == 'admin' and $this->app->user->account == 'guest')
        {
            $referer = helper::safe64Encode($this->app->getURI(true));
            die(js::locate(helper::createLink('user', 'login', "referer=$referer")));
        }

        /* if remote ip not equal loginIP, go to login page. */
        if(RUN_MODE == 'admin')
        {
            if(zget($this->config->site, 'checkSessionIP', '0') and (helper::getRemoteIP() != $this->app->user->loginIP))
            {
                session_destroy();
                $referer = helper::safe64Encode($this->app->getURI(true));
                die(js::locate(helper::createLink('user', 'login', "referer=$referer")));
            }
        }

        /* go to login page, if the setting of front page is need login. */
        if(RUN_MODE == 'front')
        {
            $frontConfig = isset($this->config->site->front) ? $this->config->site->front : 'guest';
            if($frontConfig == 'login' and $this->app->user->account == 'guest')
            {
                $referer = helper::safe64Encode($this->app->getURI(true));
                die(js::locate(helper::createLink('user', 'login', "referer=$referer")));
            }
        }

        /* Check the priviledge. */
        if(!commonModel::hasPriv($module, $method)) $this->deny($module, $method);
        if(!isset($this->config->rights->guest[strtolower($module)][strtolower($method)]) and !helper::isAjaxRequest() and RUN_MODE == 'front' and $this->app->user->account != 'guest' and strtolower($method) != 'checkemail')
        {
            if(isset($this->config->site->checkEmail) and $this->config->site->checkEmail == 'open' and !$this->app->user->emailCertified)
            {
                exit(js::locate(helper::createLink('user', 'checkEmail')));
            }
        }
    }

    /**
     * Check current user has priviledge to the module's method or not.
     *
     * @param mixed $module     the module
     * @param mixed $method     the method
     * @static
     * @access public
     * @return bool
     */
    public static function hasPriv($module, $method)
    {
        $module = strtolower($module);
        $method = strtolower($method);
        global $app, $config;

        $rights  = $app->user->rights;
        if(RUN_MODE == 'admin')
        {
            if($app->user->admin == 'no') return false;
            if($app->user->admin == 'super') return true;
            if($app->user->admin != 'no' and $module == 'admin' and $method == 'index') return true;
            if(isset($rights[$module][$method])) return true;
            return false;
        }

        if(!commonModel::isAvailable($module)) return false;

        if(isset($rights[$module][$method])) return true;

        /* Check rights one more time to enable new created rights.*/
        if($app->user->account == 'guest')
        {
            if(isset($config->rights->guest[$module][$method])) return true;
        }
        else
        {
            if(isset($config->rights->guest[$module][$method]) or isset($config->rights->member[$module][$method])) return true;
        }

        return false;
    }

    /**
     * Check whether module is available.
     *
     * @param  string $module
     * @static
     * @access public
     * @return void
     */
    public static function isAvailable($module)
    {
        global $app, $config;

        if($module == 'order' and (!isset($config->site->modules) or strpos($config->site->modules, 'score') === false  and strpos($config->site->modules, 'shop') === false))  return false;
        /* Check whether dependence modules is available. */
        if(!empty($config->dependence->$module))
        {
            foreach($config->dependence->$module as $dependModule)
            {
                if(!isset($config->site->modules) or strpos($config->site->modules, $dependModule) === false) return false;
            }
        }

        return true;
    }

    /**
     * Show the deny info.
     *
     * @param mixed $module     the module
     * @param mixed $method     the method
     * @access public
     * @return void
     */
    public function deny($module, $method)
    {
        if(helper::isAjaxRequest()) exit;
        $vars = "module=$module&method=$method";
        if(isset($_SERVER['HTTP_REFERER']))
        {
            $referer  = helper::safe64Encode($_SERVER['HTTP_REFERER']);
            $vars .= "&referer=$referer";
        }

        if(RUN_MODE == 'admin')
        {
            if(strpos($_SERVER['HTTP_REFERER'], "m=user&f=login") !== false) die(js::locate(helper::createLink('admin', 'index')));
        }

        $denyLink = helper::createLink('user', 'deny', $vars);
        die(js::locate($denyLink));
    }

    /**
     * Judge a method of one module is open or not?
     *
     * @param  string $module
     * @param  string $method
     * @access public
     * @return bool
     */
    public function isOpenMethod($module, $method)
    {
        $module = strtolower($module);
        $method = strtolower($method);
        if($module == 'user' and strpos(',login|logout|deny|resetpassword|checkresetkey|yangconglogin|oauthbind|', $method)) return true;
        if($module == 'cart' and $method == 'printtopbar') return true;
        if($module == 'mail' and $method == 'sendmailcode') return true;
        if($module == 'guarder' and $method == 'validate') return true;
        if($module == 'misc' and $method == 'ajaxgetfingerprint') return true;
        if($module == 'wechat' and $method == 'response') return true;
        if($module == 'yangcong') return true;
        if(RUN_MODE == 'admin' and $this->app->user->admin != 'no' and isset($this->config->rights->admin[$module][$method])) return true;

        if($this->loadModel('user')->isLogon() and stripos($method, 'ajax') !== false) return true;

        return false;
    }

    /**
     * Check domain and header 301.
     *
     * @access public
     * @return void
     */
    public function checkDomain()
    {
        if(RUN_MODE == 'install' or RUN_MODE == 'upgrade' or RUN_MODE == 'shell' or RUN_MODE == 'admin' or !$this->config->installed) return true;

        $http       = (isset($_SERVER['HTTPS']) and strtolower($_SERVER['HTTPS']) != 'off') ? 'https://' : 'http://';
        $httpHost   = $this->server->http_host;
        if(strpos($this->server->http_host, ':') !== false) $httpHost = substr($httpHost, 0, strpos($httpHost, ':'));
        $currentURI = $http . $httpHost . $this->server->request_uri;
        $scheme     = isset($this->config->site->scheme) ? $this->config->site->scheme : 'http';
        $mainDomain = isset($this->config->site->domain) ? $this->config->site->domain : '';
        $mainDomain = str_replace(array('http://', 'https://'), '', $mainDomain);

        /* Check main domain and scheme. */
        $redirectURI = $currentURI;
        if(strpos($redirectURI, $scheme . '://') !== 0) $redirectURI = $scheme . substr($redirectURI, strpos($redirectURI, '://'));
        if(!empty($mainDomain) and $httpHost != $mainDomain) $redirectURI = str_replace($httpHost, $mainDomain, $redirectURI);
        if($redirectURI != $currentURI) header301($redirectURI);

        /* Check domain is allowed. */
        $allowedDomains = isset($this->config->site->allowedDomain) ? $this->config->site->allowedDomain : '';
        $allowedDomains = str_replace(array('http://', 'https://'), '', $allowedDomains);
        if(!empty($allowedDomains))
        {
            if(strpos($allowedDomains, $httpHost) !== false) return true;
            if(!empty($mainDomain) and helper::getSiteCode($httpHost) == helper::getSiteCode($mainDomain)) return true;
            die('domain denied.');
        }
    }

    /**
     * Check API.
     * 
     * @access public
     * @return void
     */
    public function checkAPI()
    {
        $key = '';
        if($this->post->key) $key = $this->post->key;
        if($this->get->key) $key = $this->get->key;

        if(!empty($this->config->site->api->key) or $this->config->site->api->key != $key) die('KEY ERROR!');
        if(!empty($this->config->site->api->ip) && strpos($this->config->site->api->ip, $this->server->remote_addr) === false) die('IP DENIED');
    }

    /**
     * Create the main menu.
     *
     * @param  string $currentModule
     * @static
     * @access public
     * @return string
     */
    public static function createMainMenu($currentModule)
    {
        global $config, $app, $lang;

        self::fixGroups();

        $currentModule = zget($lang->menuGroups, $currentModule);

        $group = 'home';
        /* Set current module. */
        $currentGroup = $app->cookie->currentGroup;
        if(!in_array($app->getModuleName() . '_' . $app->getMethodName(), $config->multiEntrances)) $currentGroup = false;
        if($currentGroup and isset($config->menus->{$currentGroup})) 
        {
            $group = $currentGroup;
        }
        else
        {
            if(isset($config->menuGroups->$currentModule)) $group = $config->menuGroups->$currentModule;
        }

        $app->session->set('currentGroup', $group);

        $menus  = explode(',', $config->menus->{$group});
        $string = "<ul class='nav navbar-nav'>\n";

        foreach($menus as $menu)
        {
            $extra = zget($config->menuExtra, $menu, '');
            if(isset($config->menuDependence->$menu))
            {
                if(!commonModel::isAvailable($config->menuDependence->$menu)) continue;
            }
            if(!isset($lang->menu->{$menu})) continue;
            $moduleMenu = $lang->menu->{$menu};

            $class = $menu == $currentModule ? " class='active'" : '';
            list($label, $module, $method, $vars) = explode('|', $moduleMenu);

            if($module != 'user' and $module != 'article' and !commonModel::isAvailable($module)) continue;

            /* Just whether article/blog/page menu should shown. */
            if(!commonModel::isAvailable('article') && $vars == 'type=article') continue;
            if(!commonModel::isAvailable('blog') && $vars == 'type=blog') continue;
            if(!commonModel::isAvailable('page') && $vars == 'type=page') continue;
            if(!commonModel::isAvailable('submittion') && $vars == 'type=submittion') continue;

            if(commonModel::hasPriv($module, $method))
            {
                $link  = helper::createLink($module, $method, $vars);
                $string .= "<li$class><a href='$link' $extra>$label</a></li>\n";
            }
        }
        
        $string .= "</ul>\n";
        return $string;
    }
    
    /**
     * Create the module menu.
     *
     * @param  string $currentModule
     * @static
     * @access public
     * @return void
     */
    public static function createModuleMenu($currentModule, $navClass = 'nav-left nav-primary nav-stacked', $chevron = true)
    {
        global $lang, $app, $config;

        if(!isset($lang->$currentModule->menu)) return false;

        $string = "<ul class='nav " . $navClass . "'>\n";

        /* Get menus of current module and current method. */
        $moduleMenus   = $lang->$currentModule->menu;
        $currentMethod = $app->getMethodName();

        /* Cycling to print every menus of current module. */
        foreach($moduleMenus as $methodName => $methodMenu)
        {
            $extra = zget($config->moduleMenu, "{$currentModule}_{$methodName}", '');
            if(is_array($methodMenu))
            {
                $methodAlias = $methodMenu['alias'];
                $methodLink  = $methodMenu['link'];
            }
            else
            {
                $methodAlias = '';
                $methodLink  = $methodMenu;
            }

            /* Split the methodLink to label, module, method, vars. */
            list($label, $module, $method, $vars) = explode('|', $methodLink);
            if($chevron) $label .= '<i class="icon-chevron-right"></i>';

            if($module != 'user' and $module != 'article' and !commonModel::isAvailable($module)) continue;
            if(commonModel::hasPriv($module, $method))
            {
                $class = '';
                if($module == $currentModule && $method == $currentMethod) $class = " class='active'";
                if($module == $currentModule && strpos(",$methodAlias,", ",$currentMethod,") !== false) $class = " class='active'";
                $string .= "<li{$class}>" . html::a(helper::createLink($module, $method, $vars), $label, $extra) . "</li>\n";
            }
        }

        $string .= "</ul>\n";
        return $string;
    }

    /**
     * Create menu for managers.
     *
     * @access public
     * @return string
     */
    public static function createManagerMenu($class = 'nav navbar-nav navbar-right')
    {
        global $app, $lang , $config;

        $string  = '<ul class="' . $class . '">';
        $string .= sprintf('<li data-toggle="tooltip" title="%s" data-id="profile" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-user"></i><span class="text-username"> %s <b class="caret"></b></span></a>', $app->user->realname, $app->user->realname);
        $string .= '<ul class="dropdown-menu">';
        $string .= '<li class="heading"><i class="icon icon-user icon-large"></i><strong> ' . $app->user->realname . '</strong></li>';
        $string .= '<li class="divider"></li>';
        $string .= '<li>' . html::a(helper::createLink('user', 'setPassword'), $lang->changePassword, "data-toggle='modal'") . '</li>';
        $string .= '<li>' . html::a(helper::createLink('user', 'setEmail'), $lang->setEmail, "data-toggle='modal'") . '</li>';
        $string .= '<li>' . html::a(helper::createLink('user', 'setSecurity'), $lang->setSecurity, "data-toggle='modal'") . '</li>';
        $string .= '<li>' . html::a(helper::createLink('misc', 'about'), $lang->about, "data-toggle='modal'") . '</li>';
        $string .= '<li>' . html::a(helper::createLink('misc','thanks'), $lang->thanks, "data-toggle='modal'") . '</li>';
        $string .= '<li>' . html::a(helper::createLink('user','logout'), $lang->logout) . '</li>';
        $string .= '</ul></li></ul>';

        return $string;
    }

    /**
     * Print the top bar.
     *
     * @param  boolean $asListItem
     * @access public
     * @return void
     */
    public static function printTopBar($asListItem = false)
    {
        if(!commonModel::isAvailable('user')) return '';

        global $app, $config;
        if($app->session->user->account != 'guest')
        {
            if($asListItem)
            {
                echo "<li class='menu-user-center text-center'>" . html::a(helper::createLink('user', 'control'), "<div class='user-avatar'><i class='icon icon-user avatar icon-s2 bg-primary circle'></i><strong class='user-name'>{$app->session->user->realname}</strong></div>") . '</li>';
                echo "<li>" . html::a(helper::createLink('user', 'control'), $app->lang->dashboard) . '</li>';
                echo '<li>' . html::a(helper::createLink('user', 'logout'),  $app->lang->logout) . '</li>';
            }
            else
            {
                printf('<span class="login-msg"></span>');
                echo html::a(helper::createLink('user', 'control'), "<i class='icon-user icon-small'> </i>" . $app->session->user->realname);
                echo "<span id='msgBox' class='hiding'></span>";
                $referer = helper::safe64encode(trim($_SERVER['REQUEST_URI'], '/'));
                $visualEditLink = $config->webRoot . getAdminEntry() . "?m=visual&f=index&referer={$referer}" ;
                if($app->session->user->admin == 'super') echo html::a($visualEditLink, $app->lang->editMode, "class='text-important' id='visualEditBtn'");
                echo html::a(helper::createLink('user', 'logout'),  $app->lang->logout);
            }
        }
        else
        {
            if($asListItem)
            {
                echo '<li>' . html::a(helper::createLink('user', 'login'), $app->lang->login) . '</li>';
                echo '<li>' . html::a(helper::createLink('user', 'register'), $app->lang->register) . '</li>';
            }
            else
            {
                echo html::a(helper::createLink('user', 'login'), $app->lang->login);
                echo html::a(helper::createLink('user', 'register'), $app->lang->register);
            }
        }
    }

    /**
     * Print language bar.
     *
     * @static
     * @param  boolean $asListItem
     * @access public
     * @return string
     */
    public static function printLanguageBar($asListItem = false)
    {
        global $config, $app;
        $langs = explode(',', $config->site->lang);
        if(count($langs) == 1) return false;
        if($asListItem)
        {
            $clientLang = $app->getClientLang();
            echo "<li class='dropdown-header'>{$app->lang->language}</li>";
            foreach($langs as $lang)
            {
                $a = html::a(getHomeRoot($config->langsShortcuts[$lang]), $config->langs[$lang]);
                $liClass = $clientLang === $lang ? " class='active'" : '';
                $a = "<li{$liClass}>{$a}</li>";
                echo $a;
            }
        }
        else
        {
            foreach($langs as $lang) echo html::a(getHomeRoot($config->langsShortcuts[$lang]), $config->langAbbrLabels[$lang]);
        }
    }

    /**
     * Print the nav bar.
     *
     * @static
     * @access public
     * @return void
     */
    public static function printNavBar()
    {
        global $app;
        echo "<ul class='nav'>";
        echo '<li>' . html::a($app->config->homeRoot, $app->lang->homePage) . '</li>';
        foreach($app->site->menuLinks as $menu) echo "<li>$menu</li>";
        echo '</ul>';
    }

    /**
     * Print position bar
     *
     * @param   object $module
     * @param   object $object
     * @param   mixed  $misc    other params.
     * @access  public
     * @return  void
     */
    public function printPositionBar($module = '', $object = '', $misc = '', $root = '')
    {
        echo '<ul class="breadcrumb">';
        if($root == '')
        {
            echo '<li>' . "<span class='breadcrumb-title'>" . $this->lang->currentPos . $this->lang->colon . '</span>' . html::a($this->config->homeRoot, $this->lang->home) . '</li>';
        }
        else
        {
            echo $root;
        }

        $moduleName = $this->app->getModuleName();
        $moduleName = $moduleName == 'reply' ? 'thread' : $moduleName;
        $funcName = "print$moduleName";
        if(method_exists('commonModel', $funcName) or method_exists('extcommonModel', $funcName)) echo $this->$funcName($module, $object, $misc);
        echo '</ul>';
    }

    /**
     * Print the link contains orderBy field.
     *
     * This method will auto set the orderby param according the params. For example, if the order by is desc,
     * will be changed to asc.
     *
     * @param  string $fieldName    the field name to sort by
     * @param  string $orderBy      the order by string
     * @param  string $vars         the vars to be passed
     * @param  string $label        the label of the link
     * @param  string $module       the module name
     * @param  string $method       the method name
     * @static
     * @access public
     * @return void
     */
    public static function printOrderLink($fieldName, $orderBy, $vars, $label, $module = '', $method = '')
    {
        global $lang, $app;
        if(empty($module)) $module = $app->getModuleName();
        if(empty($method)) $method = $app->getMethodName();
        $className = 'header';

        if(strpos($orderBy, $fieldName . '_') !== false)
        {
            if(stripos($orderBy, $fieldName . '_desc') !== false)
            {
                $orderBy   = str_ireplace('desc', 'asc', $orderBy);
                $className = 'headerSortUp';
            }
            elseif(stripos($orderBy, $fieldName . '_asc')  !== false)
            {
                $orderBy = str_ireplace('asc', 'desc', $orderBy);
                $className = 'headerSortDown';
            }
        }
        else
        {
            $orderBy   = $fieldName . '_' . 'asc';
            $className = 'header';
        }

        $link = helper::createLink($module, $method, sprintf($vars, $orderBy));
        echo "<div class='$className'>" . html::a($link, $label) . '</div>';
    }

    /**
     * print link;
     *
     * @param  string $module
     * @param  string $method
     * @param  string $vars
     * @param  string $label
     * @param  string $misc
     * @static
     * @access public
     * @return bool
     */
    public static function printLink($module, $method, $vars = '', $label, $misc = '')
    {
        if(!commonModel::hasPriv($module, $method)) return false;
        echo html::a(helper::createLink($module, $method, $vars), $label, $misc);
        return true;
    }

    /**
     * Set the user info.
     *
     * @access public
     * @return void
     */
    public function setUser()
    {
        if($this->session->user) return $this->app->user = $this->session->user;

        /* Create a guest account. */
        $user           = new stdclass();
        $user->id       = 0;
        $user->account  = 'guest';
        $user->realname = 'guest';
        $user->admin    = RUN_MODE == 'cli' ? 'super' : 'no';
        if(RUN_MODE == 'front') $user->rights = $this->config->rights->guest;

        $this->session->set('user', $user);
        $this->app->user = $this->session->user;
    }

    /**
     * Get the run info.
     *
     * @param mixed $startTime  the start time of this execution
     * @access public
     * @return array    the run info array.
     */
    public function getRunInfo($startTime)
    {
        $info['timeUsed'] = round(getTime() - $startTime, 4) * 1000;
        $info['memory']   = round(memory_get_peak_usage() / 1024, 1);
        $info['querys']   = count(dao::$querys);
        return $info;
    }

    /**
     * Get the full url of the system.
     *
     * @static
     * @access public
     * @return string
     */
    public static function getSysURL()
    {
        global $config;
        $httpType = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on' ? 'https' : 'http';
        $httpHost = $_SERVER['HTTP_HOST'];
        return "$httpType://$httpHost";
    }

    /**
     * Get client IP.
     *
     * @access public
     * @return void
     */
    public function getIP()
    {
        if(getenv("HTTP_CLIENT_IP"))
        {
            $ip = getenv("HTTP_CLIENT_IP");
        }
        elseif(getenv("HTTP_X_FORWARDED_FOR"))
        {
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        }
        elseif(getenv("REMOTE_ADDR"))
        {
            $ip = getenv("REMOTE_ADDR");
        }
        else
        {
            $ip = "Unknow";
        }

        return $ip;
    }

    /**
     * Print the positon bar of product module.
     *
     * @param  object $module
     * @param  object $product
     * @access public
     * @return void
     */
    public function printProduct($module, $product)
    {
        if(empty($module->pathNames))
        {
            echo '<li>' . $module->name . '</li>';
            return '';
        }
        foreach($module->pathNames as $moduleID => $moduleName)
        {
            echo '<li>' . html::a(inlink('browse', "moduleID=$moduleID", "category=" . $this->loadModel('tree')->getAliasByID($moduleID)), $moduleName) . '</li>';
        }
        if($product) echo '<li>' . $product->name . '</li>';
    }

    /**
     * Print the positon bar of score module.
     * 
     * @access public
     * @return void
     */
    public function printScore()
    {
        echo '<li>' . $this->lang->score->common . '</li>';
    }

    /**
     * Print the positon bar of company module.
     *
     * @param  object $module
     * @access public
     * @return void
     */
    public function printcompany($module)
    {
        echo '<li>' . $this->lang->aboutUs . '</li>';
    }

    /**
     * Print the positon bar of links module.
     *
     * @param  object $module
     * @access public
     * @return void
     */
    public function printlinks($module)
    {
        echo '<li>' . $this->lang->link . '</li>';
    }

    /**
     * Print the positon bar of article module.
     *
     * @param  object $module
     * @param  object $article
     * @access public
     * @return void
     */
    public function printArticle($module, $article)
    {
        if(empty($module->pathNames)) return '';

        $divider = $this->lang->divider;
        foreach($module->pathNames as $moduleID => $moduleName)
        {
            echo '<li>' . html::a(inlink('browse', "moduleID=$moduleID", "category=" . $this->loadModel('tree')->getAliasByID($moduleID)), $moduleName) . '</li>';
        }
        if($article) echo '<li>' . $article->title . '</li>';
    }

    /**
     * Print the positon bar of blog module.
     *
     * @param  object $module
     * @param  object $article
     * @access public
     * @return void
     */
    public function printBlog($module, $article)
    {
        if(empty($module->pathNames)) return '';

        $divider = $this->lang->divider;
        foreach($module->pathNames as $moduleID => $moduleName)
        {
            $categoryAlias = isset($this->config->seo->alias->blog[$moduleID]) ? $this->config->seo->alias->blog[$moduleID] : '';
            echo '<li>' . html::a(inlink('index', "moduleID=$moduleID", "category=" . $categoryAlias), $moduleName) . '</li>';
        }
        if($article) echo '<li>' . $article->title . '</li>';
    }

    /**
     * Print the position bar of book module.
     *
     * @param   array   $families
     * @access  public
     * @return  void
     */
    public function printBook($origins)
    {
        $link = '<li>' . html::a(helper::createLink('book', 'index'), $this->lang->bookHome) . '</li>';
        $book = current($origins);
        foreach($origins as $node)
        {
            if($node->type == 'book') $link .= '<li>' . html::a(helper::createLink('book', 'browse', "bookID=$node->id", "book=$book->alias"), $node->title) . '</li>';
            if($node->type != 'book') $link .= '<li>' . html::a(helper::createLink('book', 'browse', "nodeID=$node->id", "book=$book->alias&node=$node->alias"), $node->title) . '</li>';
        }
        echo $link;
    }

    /**
     * Print the position bar of forum module.
     *
     * @param   object $board
     * @access  public
     * @return  void
     */
    public function printForum($board = '')
    {
        if($board == 'forum') echo '<li>' . html::a(helper::createLink('forum', 'index'), $this->lang->forumHome) . '</li>';

        if(empty($board->pathNames)) return '';

        $divider = $this->lang->divider;
        echo '<li>' . html::a(helper::createLink('forum', 'index'), $this->lang->forumHome) . '</li>';
        if(!$board) return false;

        unset($board->pathNames[key($board->pathNames)]);
        foreach($board->pathNames as $boardID => $boardName)
        {
            $categoryAlias = isset($this->config->seo->alias->forum[$boardID]) ? $this->config->seo->alias->forum[$boardID] : '';
            echo '<li>' . html::a(helper::createLink('forum', 'board', "boardID={$boardID}", "category=" . $categoryAlias), $boardName) . '</li>';
        }
    }

    /**
     * Print the position bar of thread module.
     *
     * @param   object $board
     * @param   object $thread
     * @access  public
     * @return  void
     */
    public function printThread($board, $thread = '')
    {
        $this->printForum($board);
        if($thread) echo '<li>' . $thread->title . '</li>';
    }

    /**
     * Print the positon bar of page module.
     *
     * @param  object $page
     * @access public
     * @return void
     */
    public function printPage($page)
    {
        $divider = $this->lang->divider;
        if(!$page) echo '<li>' . $this->lang->page->list . '</li>';
        if($page) echo '<li>' . $page->title . '</li>';
    }

    /**
     * Print the position bar of message module.
     *
     * @access public
     * @return void
     */
    public function printMessage()
    {
        echo '<li>' . $this->lang->message->common . '</li>';
    }

    /**
     * Print the position bar of Search.
     *
     * @param  int    $module
     * @param  int    $object
     * @param  int    $keywords
     * @access public
     * @return void
     */
    public function printSearch($module, $object, $keywords)
    {
        echo "<li> {$this->lang->search->common} </li>" . "<li>{$keywords}</li>";
    }

    /**
     * Create front link for admin MODEL.
     *
     * @param string       $module
     * @param string       $method
     * @param string|array $vars
     * @param string|array $alias
     * return string
     */
    public static function createFrontLink($module, $method, $vars = '', $alias = '', $viewType = '')
    {
        if(RUN_MODE == 'front') return helper::createLink($module, $method, $vars, $alias, $viewType);

        global $config;

        $requestType = $config->requestType;
        $config->requestType = $config->frontRequestType;
        $link = helper::createLink($module, $method, $vars, $alias, $viewType);
        $link = str_replace($_SERVER['SCRIPT_NAME'], $config->webRoot . 'index.php', $link);
        $config->requestType = $requestType;

        return $link;
    }

    /**
     * Verify administrator through ok file.
     *
     * @access public
     * @return array
     */
    public function verifyAdmin()
    {
        if($this->session->okFileName == false or $this->session->okFileName == '')
        {
            $this->session->set('okFileName', helper::createRandomStr(4, $skip = '0-9A-Z') . '.txt');
            $this->session->set('okFileContent', helper::createRandomStr(4, $skip = '0-9A-Z'));
        }
        $okFile = $this->app->getTmpRoot() . $this->session->okFileName;

        if(file_exists($okFile) and (trim(file_get_contents($okFile)) != $this->session->okFileContent) or !$this->session->okFileContent)
        {
            @unlink($okFile);
            $this->session->set('okFileName', helper::createRandomStr(4, $skip = '0-9A-Z') . '.txt');
            $this->session->set('okFileContent', helper::createRandomStr(4, $skip = '0-9A-Z'));
            $okFile = $this->app->getTmpRoot() . $this->session->okFileName;
        }

        if(!file_exists($okFile) or trim(file_get_contents($okFile)) != $this->session->okFileContent)
        {
            return array('result' => 'fail', 'name' => $okFile, 'content' => $this->session->okFileContent);
        }

        $this->session->set('verify', 'pass');
        $this->session->set('okFileName', '');

        return array('result' => 'success');
    }

    /**
     * Load category and page alias.
     *
     * @access public
     * @return void
     */
    public function loadAlias()
    {
        if(version_compare($this->loadModel('setting')->getVersion(), 1.4) <= 0) return true;
        $categories = $this->dao->select('*, id as category')->from(TABLE_CATEGORY)->where('type')->in('article,product,blog,forum,page')->fetchGroup('type', 'id');
        $this->config->categories = $categories;
        $this->config->seo->alias->category = array();
        $this->config->seo->alias->blog     = array();
        
        if(!empty($categories['article'] ))
        {
            foreach($categories['article'] as $category) 
            {
                if(empty($category->alias)) continue;
                $categories['article'][$category->alias] = $category;
                $category->module = 'article';
                $this->config->seo->alias->category[$category->alias] = $category;
            }
        }

        if(!empty($categories['product'] ))
        {
            foreach($categories['product'] as $category) 
            {
                if(empty($category->alias)) continue;
                $categories['product'][$category->alias] = $category;
                $category->module = 'product';
                $this->config->seo->alias->category[$category->alias] = $category;
            }
        }

        if(!empty($categories['page'] ))
        {
            foreach($categories['page'] as $category) 
            {
                if(empty($category->alias)) continue;
                $categories['page'][$category->alias] = $category;
                $category->module = 'page';
                $this->config->seo->alias->page[$category->alias] = $category;
            }
        }

        if(!empty($categories['blog'] ))
        {
            foreach($categories['blog'] as $category) 
            {
                if(empty($category->alias)) continue;
                $categories['blog'][$category->alias] = $category;
                $category->module = 'blog';
                $this->config->seo->alias->blog[$category->id] = $category->alias;
            }
        }

        if(!empty($categories['forum'] ))
        {
            foreach($categories['forum'] as $category) 
            {
                if(empty($category->alias)) continue;
                $categories['forum'][$category->alias] = $category;
                $category->module = 'forum';
                $this->config->seo->alias->forum[$category->id] = $category->alias;
            }
        }
    
        $this->config->categoryAlias = array();
        foreach($this->config->seo->alias->category as $alias => $category) $this->config->categoryAlias[$category->category] = $alias;
    }

    /**
     * Fix link of menu groups.
     * 
     * @static
     * @access public
     * @return void
     */
    public static function fixGroups()
    {
        global $app, $config, $lang;
        $modules = $config->site->modules;
        if(strpos($modules, 'article') === false)
        {
            if(strpos($modules, 'book') !== false) $lang->groups->content['link'] = 'book|admin|';
            if(strpos($modules, 'blog') !== false) $lang->groups->content['link'] = 'article|admin|type=blog';
            if(strpos($modules, 'page') !== false) $lang->groups->content['link'] = 'article|admin|type=page';
        }

        if((strpos($modules, 'shop') === false and strpos($modules, 'score') === false) or strpos($modules, 'user') === false)
        {
            if(strpos($modules, 'product') !== false) $lang->groups->shop['link'] = 'product|admin|';
        }
  
        if(strpos($modules, 'stat') === false) $lang->groups->promote['link'] = 'tag|admin|';
              
        return true;
    }
}
