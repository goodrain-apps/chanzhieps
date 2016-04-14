<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of upgrade module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class upgrade extends control
{
    /**
     * The index page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        if(version_compare($this->config->installedVersion, '4.0', '<')) $this->locate(inlink('upgradeLicense'));
        $this->locate(inlink('backup'));
    }

    /**
     * Upgrade license when upgrade to 4.0.
     * 
     * @access public
     * @return void
     */
    public function upgradeLicense()
    {
        if($this->get->agree) $this->locate(inlink('backup'));

        $this->view->license = file_get_contents($this->app->getBasePath() . '/doc/LICENSE');
        $this->display();
    }

    /**
     * The backup page.
     * 
     * @access public
     * @return void
     */
    public function backup()
    {
        $this->view->title = $this->lang->upgrade->backup;
        $this->view->db    = $this->config->db;
        $this->view->slidePath = $this->app->getDataRoot() . 'slides';
        if(!is_dir($this->view->slidePath)) mkdir($this->view->slidePath, 0777, true);

        $this->view->createSlidePath = !is_writeable($this->view->slidePath);

        $this->view->themePath      = $this->app->getWwwRoot() . 'theme';
        $this->view->chmodThemePath = !is_writeable($this->view->themePath);

        $this->display();
    }

    /**
     * Select the version of old zentao.
     * 
     * @access public
     * @return void
     */
    public function selectVersion()
    {
        $version = str_replace(array(' ', '.'), array('', '_'), $this->config->installedVersion);
        $version = strtolower($version);

        $this->view->title   = $this->lang->upgrade->common . $this->lang->colon . $this->lang->upgrade->selectVersion;
        $this->view->version = $version;
        $this->display();
    }

    /**
     * Confirm the version.
     * 
     * @access public
     * @return void
     */
    public function confirm()
    {
        $this->view->title       = $this->lang->upgrade->confirm;
        $this->view->confirm     = $this->upgrade->getConfirm($this->post->fromVersion);
        $this->view->fromVersion = $this->post->fromVersion;

        $this->display();
    }

    /**
     * Execute the upgrading.
     * 
     * @access public
     * @return void
     */
    public function processSQL()
    {
        $this->upgrade->execute($this->post->fromVersion);

        $this->view->title = $this->lang->upgrade->result;

        if(!$this->upgrade->isError())
        {
            $this->loadModel('setting')->setItems('system.common.global', array('ignoreUpgrade' => 0));
            $this->view->result = 'success';
        }
        else
        {
            $this->view->result = 'fail';
            $this->view->errors = $this->upgrade->getError();
        }
        $this->display();
    }
}
