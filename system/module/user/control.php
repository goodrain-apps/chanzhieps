<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of user module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class user extends control
{
    /**
     * The referer
     * 
     * @var string
     * @access private
     */
    private $referer;

    /**
     * Register a user. 
     * 
     * @access public
     * @return void
     */
    public function register()
    {
        if($this->app->user->account != 'guest')
        {
            $this->locate(inlink('control'));   
        }
        if(!empty($_POST))
        {
            $this->loadModel('guarder')->logOperation('ip', 'register', $this->server->remote_addr);
            $this->user->create();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            if(!$this->session->random) $this->session->set('random', md5(time() . mt_rand()));
            if($this->user->login($this->post->account, md5($this->user->createPassword($this->post->password1, $this->post->account) . $this->session->random)))
            {
                $url = $this->post->referer ? urldecode($this->post->referer) : inlink('user', 'control');
                $this->send( array('result' => 'success', 'locate'=>$url) );
            }
        }

        /* Set the referer. */
        if(!isset($_SERVER['HTTP_REFERER']) or strpos($_SERVER['HTTP_REFERER'], 'login.php') != false)
        {
            $referer = urlencode($this->config->webRoot);
        }
        else
        {
            $referer = urlencode($_SERVER['HTTP_REFERER']);
        }

        $this->view->title      = $this->lang->user->register->common;
        $this->view->referer    = $referer;
        $this->view->mobileURL  = helper::createLink('user', 'register', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'register', '', '', 'html');
        $this->display();
    }

    /**
     * Create an account.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $okFile = $this->loadModel('common')->verifyAdmin();
        $pass   = $this->loadModel('guarder')->verify();
        $this->view->okFile = $okFile;
        $this->view->pass   = $pass;

        if($_POST)
        {
            $this->user->create();
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "user={$this->post->account}")));
        }
        $this->view->title  = $this->lang->user->create;
        $this->view->groups = $this->loadModel('group')->getPairs();
        $this->display();
    }

    /**
     * Login.
     * 
     * @param string $referer 
     * @access public
     * @return void
     */
    public function login($referer = '')
    {
        $this->setReferer($referer);

        /* Load mail config for reset password. */
        $this->app->loadConfig('mail');

        $loginLink = $this->createLink('user', 'login');
        $denyLink  = $this->createLink('user', 'deny');
        $regLink   = $this->createLink('user', 'register');

        /* If the user logon already, goto the pre page. */
        if($this->user->isLogon())
        {
            if(helper::isAjaxRequest())
            {
                if($this->referer and strpos($loginLink . $denyLink . $regLink, $this->referer) === false and strpos($this->referer, $loginLink) === false) $this->send(array('result' => 'success', 'locate' => $this->referer));
                $this->send(array('result' => 'success', 'locate' => $this->createLink($this->config->default->module)));
            }

            if($this->referer and strpos($loginLink . $denyLink . $regLink, $this->referer) === false and strpos($this->referer, $loginLink) === false) $this->locate($this->referer);
            $this->locate($this->createLink($this->config->default->module));
            exit;
        }

        /* If the user sumbit post, check the user and then authorize him. */
        if(!empty($_POST))
        {
            $user = $this->user->getByAccount($this->post->account);

            /* check client ip and location if login is admin. */
            if(RUN_MODE == 'admin')
            {
                if(zget($this->config->site, 'forceYangcong') == 'open' and strtolower($this->app->getMethodName()) != 'yangconglogin')
                {
                    $error = $this->lang->user->forceYangcong;
                    $pass  = $this->loadModel('guarder')->verify();
                    $captchaUrl = $this->createLink('guarder', 'validate', "url=&target=modal&account={$this->post->account}&type=");
                    if(!$pass) $this->send(array('result' => 'fail', 'reason' => 'captcha', 'message' => $error, 'url' => $captchaUrl));
                }

                $checkIP              = $this->user->checkIP();
                $checkAllowedLocation = $this->user->checkAllowedLocation();
                $checkLoginLocation   = $this->user->checkLoginLocation($this->post->account);
                if($user and (!$checkIP or !$checkAllowedLocation or !$checkLoginLocation))
                {
                    $error  = $checkIP ? '' : $this->lang->user->ipDenied;
                    $error .= $checkAllowedLocation ? '' : $this->lang->user->locationDenied;
                    $error .= $checkLoginLocation ? '' : $this->lang->user->loginLocationChanged;
                    $pass   = $this->loadModel('guarder')->verify();
                    $captchaUrl = $this->createLink('guarder', 'validate', "url=&target=modal&account={$this->post->account}");
                    if(!$pass) $this->send(array('result' => 'fail', 'reason' => 'captcha', 'message' => $error, 'url' => $captchaUrl));
                }
            }

            if(!$this->user->login($this->post->account, $this->post->password))
            {
                $this->loadModel('guarder')->logOperation('ip', 'logonFailure');
                $this->loadModel('guarder')->logOperation('account', 'logonFailure', $this->post->account);
                $this->send(array('result'=>'fail', 'message' => $this->lang->user->loginFailed));
            }

            if(RUN_MODE == 'front')
            {
                if(isset($this->config->site->checkEmail) and $this->config->site->checkEmail == 'open' and $this->config->mail->turnon and !$user->emailCertified)
                {
                    $referer = helper::safe64Encode($this->post->referer);
                    if(!helper::isAjaxRequest()) helper::header301("http://". $_SERVER['HTTP_HOST'] . inlink('checkEmail', "referer={$referer}"));
                    $this->send(array('result'=>'success', 'locate'=> inlink('checkEmail', "referer={$referer}")));
                }
            }

            /* Goto the referer or to the default module */
            if($this->post->referer != false and strpos($loginLink . $denyLink . $regLink, $this->post->referer) === false)
            {
                if(!helper::isAjaxRequest()) helper::header301(urldecode($this->post->referer));
                $this->send(array('result'=>'success', 'locate'=> urldecode($this->post->referer)));
            }
            else
            {
                $default = $this->config->user->default;
                if(!helper::isAjaxRequest()) helper::header301("http://". $_SERVER['HTTP_HOST'] . $this->createLink($default->module, $default->method));
                $this->send(array('result'=>'success', 'locate' => $this->createLink($default->module, $default->method)));
            }
        }

        if(!$this->session->random) $this->session->set('random', md5(time() . mt_rand()));

        $this->view->title   = $this->lang->user->login->common;
        $this->view->referer = $this->referer;
        if(RUN_MODE == 'front')
        {
            $this->view->mobileURL  = helper::createLink('user', 'login', "referer=$referer", '', 'mhtml');
            $this->view->desktopURL = helper::createLink('user', 'login', "referer=$referer", '', 'html');
        }

        $this->display();
    }

    /**
     * logout 
     * 
     * @param int $referer 
     * @access public
     * @return void
     */
    public function logout($referer = 0)
    {
        session_destroy();
        $vars = !empty($referer) ? "referer=$referer" : '';
        $this->locate($this->createLink('user', 'login', $vars));
    }

    /**
     * The deny page.
     * 
     * @param mixed $module             the denied module
     * @param mixed $method             the deinied method
     * @param string $refererBeforeDeny the referer of the denied page.
     * @access public
     * @return void
     */
    public function deny($module, $method, $refererBeforeDeny = '')
    {
        $this->app->loadLang($module);
        $this->app->loadLang('index');

        $this->setReferer();

        $this->view->title             = $this->lang->user->deny;
        $this->view->module            = $module;
        $this->view->method            = $method;
        $this->view->denyPage          = $this->referer;
        $this->view->refererBeforeDeny = $refererBeforeDeny;
        $this->view->mobileURL         = helper::createLink('user', 'deny', "module=$module&method=$method&referer=$refererBeforeDeny", '', 'mhtml');
        $this->view->desktopURL        = helper::createLink('user', 'deny', "module=$module&method=$method&referer=$refererBeforeDeny", '', 'html');

        die($this->display());
    }

    /**
     * The user control panel of the front
     * 
     * @access public
     * @return void
     */
    public function control()
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        $this->view->mobileURL  = helper::createLink('user', 'control', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'control', '', '', 'html');
        $this->view->realname   = $this->user->getRealnameByID($this->app->user->id);

        $this->view->title = $this->lang->user->control->common;
        $this->display();
    }

    /**
     * View current user's profile.
     * 
     * @access public
     * @return void
     */
    public function profile()
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        $this->view->title      = $this->lang->user->profile;
        $this->view->user       = $this->user->getByAccount($this->app->user->account);
        $this->view->mobileURL  = helper::createLink('user', 'profile', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'profile', '', '', 'html');
        $this->display();
    }

    /**
     * List threads of one user.
     * 
     * @access public
     * @return void
     */
    public function thread($pageID = 1)
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));

        /* Load the pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = new pager(0, $this->config->user->recPerPage->thread, $pageID);

        /* Load the forum lang to change the pager lang items. */
        $this->app->loadLang('forum');

        $this->view->title      = $this->lang->user->thread;
        $this->view->threads    = $this->loadModel('thread')->getByUser($this->app->user->account, $pager);
        $this->view->pager      = $pager;
        $this->view->mobileURL  = helper::createLink('user', 'thread', "pageID=$pageID", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'thread', "pageID=$pageID", '', 'html');

        $this->display();
    }

    /**
     * List replies of one user.
     * 
     * @access public
     * @return void
     */
    public function reply($pageID = 1)
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));

        /* Load pager. */
        $this->app->loadClass('pager', $static = true);
        $pager = new pager(0, $this->config->user->recPerPage->reply, $pageID);

        /* Load the thread lang thus to rewrite the page lang items. */
        $this->app->loadLang('thread');    

        $this->view->title      = $this->lang->user->reply;
        $this->view->replies    = $this->loadModel('reply')->getByUser($this->app->user->account, $pager);
        $this->view->pager      = $pager;
        $this->view->mobileURL  = helper::createLink('user', 'reply', "pageID=$pageID", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'reply', "pageID=$pageID", '', 'html');

        $this->display();
    }

    /**
     * List message of a user.
     * 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function message($recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->view->title      = $this->lang->user->messages;
        $this->view->messages   = $this->loadModel('message')->getByAccount($this->app->user->account, $pager);
        $this->view->pager      = $pager;
        $this->view->mobileURL  = helper::createLink('user', 'message', "recTotal=$recTotal&recPerPage=$recPerPage&pageID=$pageID", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'message', "recTotal=$recTotal&recPerPage=$recPerPage&pageID=$pageID", '', 'html');

        $this->display();
    }

    /**
     * Edit a user. 
     * 
     * @param  string    $account 
     * @access public
     * @return void
     */
    public function edit($account = '')
    {
        if(!$account or RUN_MODE == 'front') $account = $this->app->user->account;
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        if(RUN_MODE == 'admin') $this->config->user->require->edit = 'realname, email';
        $user = $this->user->getByAccount($account);

        /* use email captcha. */
        if(RUN_MODE == 'admin' and ($user->admin == 'super' or $user->admin == 'common' or $this->post->admin == 'super' or $this->post->admin == 'common')) 
        { 
            $okFile = $this->loadModel('common')->verifyAdmin();
            $pass   = $this->loadModel('guarder')->verify();
            $this->view->pass   = $pass;
            $this->view->okFile = $okFile;
            if(!empty($_POST) && !$pass) $this->send(array('result' => 'fail', 'reason' => 'captcha'));
        }

        if(!empty($_POST))
        {
            if(!$this->user->checkToken($this->post->token, $this->post->fingerprint))  $this->send(array( 'result' => 'fail', 'message' => $this->lang->error->fingerprint));
            $this->user->update($account);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->session->set('verify', '');

            $locate = RUN_MODE == 'front' ? inlink('profile') : inlink('admin');
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess , 'locate' => $locate));
        }

        $this->view->title = $this->lang->user->edit;
        $this->view->user  = $user;
        $this->view->token = $this->user->getToken();
        if(RUN_MODE == 'admin') 
        { 
            $this->loadModel('mail');
            $user->groups = array_keys($this->loadModel('group')->getByAccount($user->account));
            $this->view->groups   = $this->loadModel('group')->getPairs();
            $this->view->siteLang = explode(',', $this->config->site->lang);
            $this->display('user', 'edit.admin');
        }
        else
        {
            $this->view->mobileURL  = helper::createLink('user', 'edit', "account=$account", '', 'mhtml');
            $this->view->desktopURL = helper::createLink('user', 'edit', "account=$account", '', 'html');
            $this->display();
        }
    }

    /**
     * Set email. 
     * 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function setEmail()
    {
        $account = $this->app->user->account;
        $user    = $this->user->getByAccount($account);

        if(!empty($_POST))
        {
            if(!$this->user->checkToken($this->post->token, $this->post->fingerprint))  $this->send(array( 'result' => 'fail', 'message' => $this->lang->error->fingerprint));
            if($user->email != '')
            {
                if(!trim($this->post->captcha) or trim($this->post->captcha) != $this->session->verifyCode) $this->send(array('result' => 'fail', 'message' => $this->lang->user->verifyFail));
            }

            $this->user->updateEmail($account);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $locate = inlink('control');
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess , 'locate' => $locate));
        }

        $this->view->title      = $this->lang->user->setEmail;
        $this->view->token      = $this->user->getToken();
        $this->view->user       = $user;
        $this->view->mobileURL  = helper::createLink('user', 'setEmail', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'setEmail', '', '', 'html');
        $this->display();
    }

    /**
     * Delete a user.
     * 
     * @param  int    $account 
     * @access public
     * @return void
     */
    public function delete($account)
    {
        $this->app->loadLang('guarder');
        /* Change menu when browse all admin user. */
        if($this->get->admin == 1)
        {
            $this->lang->user->menu = $this->lang->security->menu;
            $this->lang->menuGroups->user = 'security';
        }

        if($_POST)
        {
            $user = $this->loadModel('user')->identify($this->app->user->account, $this->post->password);
            if(!$user) $this->send(array( 'result' => 'fail', 'message' => $this->lang->user->identifyFailed ) );

            /* Delete user history. */
            $this->user->deleteHistory();

            if($this->user->delete($account)) $this->send(array('result' => 'success', 'message' =>$this->lang->deleteSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $userHistory = $this->user->getUserHistory($account); 

        $this->view->title       = $this->lang->user->userHistory;
        $this->view->account     = $account;
        $this->view->userHistory = $userHistory;
        $this->display();
    }

    /**
     * Batch delete users.
     * 
     * @access public
     * @return void
     */
    public function batchDelete()
    {
        $this->app->loadLang('guarder');
        /* Change menu when browse all admin user. */
        if($this->get->admin == 1)
        {
            $this->lang->user->menu = $this->lang->security->menu;
            $this->lang->menuGroups->user = 'security';
        }

        if($_POST)
        {
            if(isset($_POST['password']))
            {
                $user = $this->loadModel('user')->identify($this->app->user->account, $this->post->password);
                if(!$user) $this->send(array( 'result' => 'fail', 'message' => $this->lang->user->identifyFailed ) );

                /* Delete history. */
                $this->user->batchDeleteHistory($this->post->users);

                if($this->user->batchDelete($this->post->users)) $this->send(array('result' => 'success', 'message' =>$this->lang->deleteSuccess, 'locate' => inlink('admin')));
                $this->send(array('result' => 'fail', 'message' => dao::getError()));
            }
            else
            {
                $accounts = $this->post->account;
            }
        }

        $this->view->title       = $this->lang->user->userHistory;
        $this->view->userHistory = $this->user->getHistoryOfUsers($accounts);
        $this->view->users       = $this->user->getRealNamePairs($accounts);
        $this->display();
    }

    /**
     *  Admin users list.
     *
     * @access public
     * @return void
     */
    public function admin()
    {
        /* Change menu when browse all admin user. */
        if($this->get->admin == 1)
        {
            $this->lang->user->menu = $this->lang->security->menu;
            $this->lang->menuGroups->user = 'security';
        }

        $get = fixer::input('get')
            ->setDefault('recTotal', 0)
            ->setDefault('recPerPage', 10)
            ->setDefault('pageID', 1)
            ->setDefault('user', '')
            ->setDefault('provider', '')
            ->setDefault('admin', '')
            ->get();

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($get->recTotal, $get->recPerPage, $get->pageID);

        $users = $this->user->getList($pager, $get->user, $get->provider, $get->admin);
        
        $this->view->users = $users;
        $this->view->pager = $pager;
        $this->view->title = $this->lang->user->common;
        $this->display();
    }

    /**
     * Pull wechat fans. 
     * 
     * @access public
     * @return void
     */
    public function pullWechatFans()
    {
        $this->loadModel('wechat')->pullFans();

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0, $recPerPage =99999, $pageID = 1);
        $users = $this->user->getList($pager);

        $this->wechat->batchPullFanInfo($users);
        $this->send(array('result' => 'success', 'message' => $this->lang->user->pullSuccess));
    }

    /**
     * forbid a user.
     *
     * @param string $date
     * @param int    $userID
     * @return viod
     */
    public function forbid($userID, $date)
    {
        if(!$userID or !isset($this->lang->user->forbidDate[$date])) $this->send(array('result'=>'fail', 'message' => $this->lang->user->forbidFail));       

        $result = $this->user->forbid($userID, $date);
        if($result)
        {
            $this->send(array('result'=>'success', 'message' => $this->lang->user->forbidSuccess));
        }
        else
        {
            $this->send(array('message' => dao::getError()));
        }
    }

    /**
     * Activate a user.
     *
     * @param  int  $userID
     * @access public
     * @return viod
     */
    public function activate($userID)
    {
        if(!$userID) $this->send(array('result'=>'fail', 'message' => $this->lang->user->activateFail));       

        $this->user->activate($userID);
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result'=>'success', 'message' => $this->lang->user->activateSuccess));
    }

    /**
     * set the referer 
     * 
     * @param  string $referer 
     * @access private
     * @return void
     */
    private function setReferer($referer = '')
    {
        if(!empty($referer))
        {
            $this->referer = helper::safe64Decode($referer);
        }
        else
        {
            $this->referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        }
    }

    /**
     * Change password.
     *
     * @access public
     * @return void
     */
    public function setPassword()
    {
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));

        /* use email captcha. */
        $okFile = $this->loadModel('common')->verifyAdmin();
        $pass   = $this->loadModel('guarder')->verify();
        $this->view->okFile = $okFile;
        $this->view->pass   = $pass;

        if(!empty($_POST))
        {
            if(!$this->user->checkToken($this->post->token, $this->post->fingerprint))  $this->send(array( 'result' => 'fail', 'message' => $this->lang->error->fingerprint));
            if(!$pass) $this->send(array( 'result' => 'fail', 'message' => $this->lang->guarder->needVerify));

            $user = $this->user->identify($this->app->user->account, $this->post->password);
            if(!$user) $this->send(array( 'result' => 'fail', 'message' => $this->lang->user->identifyFailed ) );

            $this->user->updatePassword($this->app->user->account);
            if(dao::isError()) $this->send(array( 'result' => 'fail', 'message' => dao::getError() ) );
            $this->session->set('verify', '');
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }

        $this->view->title      = "<i class='icon-key'></i> " . $this->lang->user->changePassword;
        $this->view->modalWidth = 500; 
        $this->view->user       = $this->user->getByAccount($this->app->user->account);
        $this->view->token      = $this->user->getToken();
        $this->display();
    }

    /**
     * Reset password.
     *
     * @access public
     * @return void
     */
    public function resetPassword()
    {
        if($this->config->site->resetPassword != 'open') $this->locate(helper::createLink('error'));
        if(!empty($_POST))
        {
            $user = $this->user->getByAccount(trim($this->post->account));
            if($user)
            {
                if($user->admin != 'no') $this->send(array('result' => 'fail', 'message' => $this->lang->user->resetPassword->failed));
                $account  = $user->account;
                $reset    = md5(str_shuffle(md5($account . mt_rand(0, 99999999) . microtime())) . microtime()) . time();
                $resetURL = "http://". $_SERVER['HTTP_HOST'] . $this->inlink('checkreset', "key=$reset");
                $this->user->reset($account, $reset);
                include('view/resetpassmail.html.php');
                $this->loadModel('mail')->send($account, $this->lang->user->resetMail->subject, $mailContent); 
                if($this->mail->isError()) 
                {
                    $this->loadModel('guarder')->logOperation('ip', 'resetPWDFailure');
                    $this->send(array('result' => 'fail', 'message' => $this->mail->getError()));
                }
                else
                {
                    $this->loadModel('guarder')->logOperation('account', 'resetPassword');
                    $this->loadModel('guarder')->logOperation('ip', 'resetPassword');
                    $this->send(array('result' => 'success', 'message' => $this->lang->user->resetPassword->success));
                }
            }
            else
            {
                $this->loadModel('guarder')->logOperation('ip', 'resetPWDFailure');
                $this->send(array('result' => 'fail', 'message' => $this->lang->user->resetPassword->failed));
            }
        }

        $this->view->title      = $this->lang->user->resetPassword->common;
        $this->view->mobileURL  = helper::createLink('user', 'resetPassword', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'resetPassword', '', '', 'html');
        $this->display();
    }

    /**
     * check the reset and reset password. 
     *
     * @access public
     * @return void
     */
    public function checkReset($reset)
    {
        if(!empty($_POST))
        {
            $this->user->checkPassword();
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $this->user->resetPassword($this->post->reset, $this->post->password1); 
            $this->send(array('result' => 'success', 'message' => $this->lang->user->resetSuccess, 'locate' => inlink('login')));
        }

        if(!$this->user->checkReset($reset))
        {
            header('location:index.html'); 
        }
        else
        {
            $this->view->title = $this->lang->user->resetPassword->common;
            $this->view->reset = $reset;
            $this->view->mobileURL  = helper::createLink('user', 'checkReset', "reset=$reset", '', 'mhtml');
            $this->view->desktopURL = helper::createLink('user', 'checkReset', "reset=$reset", '', 'html');
            $this->display();
        }
    }

    /**
     * OAuth login.
     * 
     * @param  string    $provider sina|qq
     * @param  int       $fingerprint
     * @param  string    $referer  the referer before login
     * @access public
     * @return void
     */
    public function oauthLogin($provider, $fingerprint = 0, $referer = '')
    {
        /* Save the provider to session.*/
        $this->session->set('oauthProvider', $provider);
        $this->session->set('fingerprint', $fingerprint);
        $this->session->set('referer', $referer);

        /* Init OAuth client. */
        $this->app->loadClass('oauth', $static = true);
        $this->config->oauth->$provider = json_decode($this->config->oauth->$provider);
        $client = oauth::factory($provider, $this->config->oauth->$provider, $this->user->createOAuthCallbackURL($provider));

        /* Create the authorize url and locate to it. */
        $authorizeURL = $client->createAuthorizeAPI();
        $this->locate($authorizeURL);
    }

    /**
     * OAuth callback.
     * 
     * @param  string    $provider
     * @param  string    $referer
     * @access public
     * @return void
     */
    public function oauthCallback($provider)
    {
        /* First check the state and provider fields. */
        if($this->get->state != $this->session->oauthState)  die('state wrong!');
        if($provider != $this->session->oauthProvider)       die('provider wrong.');
        $referer = $this->session->referer;

        /* Init the OAuth client. */
        $this->app->loadClass('oauth', $static = true);
        $this->config->oauth->$provider = json_decode($this->config->oauth->$provider);
        $client = oauth::factory($provider, $this->config->oauth->$provider, $this->user->createOAuthCallbackURL($provider));

        /* Begin OAuth authing. */
        $token  = $client->getToken($this->get->code);    // Step1: get token by the code.
        $openID = $client->getOpenID($token);             // Step2: get open id by the token.

        $openUser = $client->getUserInfo($token, $openID);                    // Get open user info.
        $this->session->set('openUser', $openUser);
        $this->session->set('openID', $openID);                     // Save the openID to session.

        /* Step3: Try to get user by the open id, if got, login him. */
        $user = $this->user->getUserByOpenID($provider, $openID);
        $this->session->set('random', md5(time() . mt_rand()));
        if($user)
        {
            if($this->user->login($user->account, md5($user->password . $this->session->random)))
            {
                if($referer) $this->locate(helper::safe64Decode($referer));

                /* No referer, go to the user control panel. */
                $default = $this->config->user->default;
                $this->locate($this->createLink($default->module, $default->method));
            }
            exit;
        }

        /* Step4.1: if bind, display the register or bind page. */
        if($this->get->referer != false) $this->setReferer($referer);    // Set the referer.
        $this->config->oauth->$provider = json_encode($this->config->oauth->$provider);

        $this->view->title      = $this->lang->user->login->common;
        $this->view->referer    = $referer;
        $this->view->mobileURL  = helper::createLink('user', 'oauthCallback', "provider=$provider", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'oauthCallback', "provider=$provider", '', 'html');
        if($provider == 'qq')   $this->view->realname = !empty($openUser->nickname) ? htmlspecialchars($openUser->nickname) : '';
        if($provider == 'sina') $this->view->realname = !empty($openUser->name) ? htmlspecialchars($openUser->name) : '';
        die($this->display());
    }

    /**
     * Register a user when using oauth login.
     * 
     * @access public
     * @return void
     */
    public function oauthRegister()
    {
        /* If session timeout, locate to login page. */
        if($this->session->oauthProvider == false or $this->session->openID == false) $this->send(array('result' => 'success', 'locate'=> inlink('login')));

        if($_POST)
        {
            $this->user->registerOauthAccount($this->session->oauthProvider, $this->session->openID);

            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $user = $this->user->getUserByOpenID($this->session->oauthProvider, $this->session->openID);
            $this->session->set('random', md5(time() . mt_rand()));
            if($user and $this->user->login($user->account, md5($user->password . $this->session->random)))
            {
                $default = $this->config->user->default;    // Redefine the default module and method in dashbaord scene.

                if($this->post->referer != false) $this->send(array('result'=>'success', 'locate'=> helper::safe64Decode($this->post->referer)));
                if($this->post->referer == false) $this->send(array('result'=>'success', 'locate'=> $this->createLink($default->module, $default->method)));
                exit;
            }

            $this->send(array('result' => 'fail', 'message' => 'I have registered but can\'t login, some error occers.'));
        }

        $this->view->title      = $this->lang->user->oauth->lblProfile;
        $this->view->referer    = $this->post->referer;
        $this->view->mobileURL  = helper::createLink('user', 'oauthRegister', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'oauthRegister', '', '', 'html');
        $this->display();
    }

    /**
     * Bind an open id to an account of chanzhi system.
     * 
     * @access public
     * @return void
     */
    public function oauthBind()
    {
        if($_POST)
        {
            if(!$this->session->random) $this->session->set('random', md5(time() . mt_rand()));
            if($this->user->login($this->post->account, md5($this->user->createPassword($this->post->password, $this->post->account) . $this->session->random)))
            {
                if($this->user->bindOAuthAccount($this->post->account, $this->session->oauthProvider, $this->session->openID))
                {
                    $default = $this->config->user->default;
                    if($this->post->referer != false) $this->send(array('result'=>'success', 'locate'=> helper::safe64Decode($this->post->referer)));
                    if($this->post->referer == false) $this->send(array('result'=>'success', 'locate'=> $this->createLink($default->module, $default->method)));
                }
                else
                {
                    $this->send(array('result' => 'fail', 'message' => $this->lang->user->oauth->lblBindFailed));
                }
            }
            $this->send(array('result' => 'fail', 'message' => $this->lang->user->loginFailed));
        }

        $this->view->title      = $this->lang->user->oauth->lblBind;
        $this->view->referer    = $this->post->referer;
        $this->view->mobileURL  = helper::createLink('user', 'oauthBind', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'oauthBind', '', '', 'html');
        $this->display();
    }

    /**
     * Unbind an openID and an account of chanzhi system.
     * 
     * @param  string    $account 
     * @param  string    $provider 
     * @param  int       $openID 
     * @access public
     * @return void
     */
    public function oauthUnbind($account, $provider, $openID)
    {
        $result = $this->user->unbindOAuthAccount($account, $provider, $openID);
        if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->user->oauth->lblUnbindFailed));

        $account = uniqid("{$provider}_");
        $this->post->set('account', $account);                           // Create a uniq account.
        if($provider == 'qq')   $this->post->set('realname', ($this->session->openUser->nickname ? htmlspecialchars($this->session->openUser->nickname) : $account));  // Set the realname.
        if($provider == 'sina') $this->post->set('realname', ($this->session->openUser->name ? htmlspecialchars($this->session->openUser->name) : $account));  // Set the realname.
        $result = $this->user->registerOauthAccount($provider, $openID);
        if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->user->oauth->lblUnbindFailed));
        $this->send(array('result' => 'success', 'message' => $this->lang->user->oauth->lblUnbindSuccess, 'locate' => helper::createLink('user', 'profile')));
    }

    /**
     * Ignore bind an openID and an account.
     * 
     * @access public
     * @return void
     */
    public function ignoreBind()
    {
        $provider = $this->session->oauthProvider;
        $openID   = $this->session->openID;

        $this->post->set('account', uniqid("{$provider}_"));        // Create a uniq account.
        if($provider == 'qq')   $this->post->set('realname', htmlspecialchars($this->session->openUser->nickname));  // Set the realname.
        if($provider == 'sina') $this->post->set('realname', htmlspecialchars($this->session->openUser->name));  // Set the realname.
        $this->user->registerOauthAccount($provider, $openID);

        $user = $this->user->getUserByOpenID($provider, $openID);
        $this->session->set('random', md5(time() . mt_rand()));
        if($user and $this->user->login($user->account, md5($user->password . $this->session->random)))
        {
            if($referer) $this->locate(helper::safe64Decode($referer));

            /* No referer, go to the user control panel. */
            $default = $this->config->user->default;
            $this->locate($this->createLink($default->module, $default->method));
        }
        else
        {
            die('some error occers.');
        }
    }

    /**
     * Admin user login log. 
     * 
     * @access public
     * @return void
     */
    public function adminLog()
    {
        $this->lang->user->menu = $this->lang->security->menu;
        $this->lang->menuGroups->user = 'security';

        $get = fixer::input('get')
            ->setDefault('recTotal', 0)
            ->setDefault('recPerPage', 10)
            ->setDefault('pageID', 1)
            ->setDefault('account', '')
            ->setDefault('ip', '')
            ->setDefault('location', '')
            ->setDefault('date', '')
            ->get();

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($get->recTotal, $get->recPerPage, $get->pageID);

        $logs = $this->user->getLogList($pager, $get->account, $get->ip, $get->location, $get->date);
        
        $this->view->logs  = $logs;
        $this->view->pager = $pager;
        $this->view->users = $this->user->getPairs();
        $this->view->title = $this->lang->user->log->list;
        $this->display();
    }

    /**
     * Check email.
     * 
     * @param  string    $account 
     * @access public
     * @return void
     */
    public function checkEmail($referer = '')
    {
        $this->setReferer($referer);
        $user = $this->user->getByAccount($this->app->user->account);
        if($user->emailCertified) $this->locate(inlink('control'));

        if($_POST)
        {
            if(!trim($this->post->captcha) or trim($this->post->captcha) != $this->session->verifyCode) $this->send(array('result' => 'fail', 'message' => $this->lang->user->verifyFail));
            $this->user->checkEmail($this->post->email);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->app->user->emailCertified = 1;
            $this->send(array('result' => 'success', 'message' => $this->lang->user->checkEmailSuccess, 'locate' => $this->post->referer));
        }

        $this->view->title      = $this->lang->user->checkEmail;
        $this->view->user       = $user;
        $this->view->referer    = $this->referer;
        $this->view->mobileURL  = helper::createLink('user', 'checkEmail', "referer=$referer", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('user', 'checkEmail', "referer=$referer", '', 'html');
        $this->display();
    }

    /**
     * Score list for a user.
     * 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function score($recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        if(!commonModel::isAvailable('score')) die();
        if($this->app->user->account == 'guest') $this->locate(inlink('login'));
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->view->title  = $this->lang->user->score;
        $this->view->scores = $this->loadModel('score')->getByUser($this->app->user->account, $pager);
        $this->view->user   = $this->user->getByAccount($this->app->user->account);
        $this->view->pager  = $pager;
        $this->display();
    }

    /**
     * Add score for a user.
     * 
     * @param  string    $account 
     * @access public
     * @return void
     */
    public function addScore($account)
    {
        $this->loadModel('score');
        if($_POST)
        {
            $result = $this->score->award($account, 'award', $this->post->count, '', '', $this->post->note);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->user->addScore;
        $this->view->account = $account;
        $this->display();
    }

    /**
     * Reduce score for a user.
     * 
     * @param  string    $account 
     * @access public
     * @return void
     */
    public function reduceScore($account)
    {
        $this->loadModel('score');
        if($_POST)
        {
            $result = $this->score->punish($account, 'punish', $this->post->count, '', '', $this->post->note);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->user->reduceScore;
        $this->view->account = $account;
        $this->display();
    }

    /**
     * Yangcong login.
     * 
     * @param  string $referer 
     * @access public
     * @return void
     */
    public function yangcongLogin($referer = '')
    {
        $uid  = $this->session->openID;
        $user = $this->user->getUserByOpenID('yangcong', $uid);

        /* If user exists login derectly.*/
        if($user)
        {
            if($this->user->login($user->account, md5($user->password . $this->session->random)))
            {
                if($referer) $this->locate(helper::safe64Decode($referer));

                /* No referer, go to the user control panel. */
                $default = $this->config->user->default;
                $this->locate($this->createLink($default->module, $default->method));
            }
            exit;
        }

        if($this->get->referer != false)
        {
            if(!empty($referer))
            {
                $this->referer = helper::safe64Decode($referer);
            }
            else
            {
                $this->referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
            }
        }

        $this->view->title   = $this->lang->user->login->common;
        $this->view->referer = $referer;
        die($this->display());
    }

    /**
     * Set security question.
     *
     * @access public
     * @return void
     */
    public function setSecurity()
    {
        if($_POST)
        {
            $result = $this->user->setSecurity($this->app->user->account); 
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }
        $this->view->title = $this->lang->setSecurity;
        $this->display();
    }
}
