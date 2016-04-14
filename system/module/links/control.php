<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of links module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     links
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class links extends control
{
    /**
     * links profile.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $this->view->links     = $this->config->links;
        $this->view->mobileURL = helper::createLink('links', 'index', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('links', 'index', '', '', 'html');
        $this->display();
    }

    /**
     * set links links.
     * 
     * @access public
     * @return void
     */
    public function admin()
    {
        if(!empty($_POST))
        {
            $result = $this->loadModel('setting')->setItems('system.common.links', (object)$_POST);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }
        $this->view->title = $this->lang->links->common;
        $this->display();
    }
}
