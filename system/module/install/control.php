<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class install extends control
{
    /**
     * The construction function , check is install or not.
     * 
     * @access public
     * @return array
     */
    public function __construct()
    {
        if(!defined('RUN_MODE') or RUN_MODE != 'install') die('error');
        parent::__construct();
        $this->loadModel('site')->setSite();
    }

    /**
     * The index page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        if(!isset($this->config->installed) or !$this->config->installed) $this->session->set('installing', true);

        $this->view->title = $this->lang->install->welcome;
        $this->display();
    }

    /**
     * step0 check agree license. 
     * 
     * @access public
     * @return void
     */
    public function step0()
    {
        $this->view->license = file_get_contents($this->app->getBasePath() . '/doc/LICENSE');
        $this->view->title   = $this->lang->install->welcome;
        $this->display();
    }

    /**
     * Checking the system.
     * 
     * @access public
     * @return void
     */
    public function step1()
    {
        $this->view->title          = $this->lang->install->checking;
        $this->view->phpVersion     = $this->install->getPhpVersion();
        $this->view->phpResult      = $this->install->checkPHP();
        $this->view->pdoResult      = $this->install->checkPDO();
        $this->view->pdoMySQLResult = $this->install->checkPDOMySQL();
        $this->view->tmpRootInfo    = $this->install->getTmpRoot();
        $this->view->tmpRootResult  = $this->install->checkTmpRoot();
        $this->view->dataRootInfo   = $this->install->getDataRoot();
        $this->view->dataRootResult = $this->install->checkDataRoot();
        $this->view->iniInfo        = $this->install->getIniInfo();
        $this->display();
    }

    /**
     * Set the database.
     * 
     * @access public
     * @return void
     */
    public function step2()
    {
        $this->view->title = $this->lang->install->setConfig;
        $this->display();
    }

    /**
     * Create the config file.
     * 
     * @access public
     * @return void
     */
    public function step3()
    {
        if(!empty($_POST))
        {
            $return = $this->install->checkConfig();
            if($return->result == 'ok')
            {
                $result = $this->install->saveMyPHP();
                if($result->saved) $this->locate(inlink('step4'));

                $this->view->title  = $this->lang->install->saveConfig;
                $this->view->result = $result;
                $this->display();
            }
            else
            {
                $this->view->title = $this->lang->install->saveConfig;
                $this->view->error = $return->error;
                $this->display();
            }
        }
        else
        {
            $this->locate($this->createLink('install'));
        }
    }

    /**
     * Step4: create admin password and set the version.
     * 
     * @access public
     * @return array
     */
    public function step4()
    {
        if(!empty($_POST))
        {
            $this->install->createAdmin();
            if(dao::isError()) die(js::error(dao::getError()));

            if($this->post->importDemoData) $this->install->importDemoData();
            if(dao::isError()) echo js::alert($this->lang->install->errorImportDemoData);

            $this->loadModel('setting')->updateVersion($this->config->version);
            die(js::locate(inlink('step5')));
        }

        if(!isset($this->config->installed) or !$this->config->installed)
        {   
            $this->view->title = $this->lang->install->errorNotSaveConfig;
            $this->view->error = $this->lang->install->errorNotSaveConfig;
            $this->display();
        }
        else
        {
            $this->view->title = $this->lang->install->setAdmin;
            $this->display();
        }
    }

    /**
     * Step5: save the admin user to the config.
     * 
     * @access public
     * @return void
     */
    public function step5()
    {
        $this->loadModel('setting')->setItems('system.common.site', array('lang' => $_COOKIE['lang']), 'all');
        session_destroy();
        $this->view->title = $this->lang->install->success;
        $this->display();
    }
}
