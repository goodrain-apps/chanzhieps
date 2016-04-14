<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of misc of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     misc
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class misc extends control
{
    public function ping()
    {
        die();
    }

    /**
     * Create qrcode for mobile visit.
     *
     * @access public
     * @return void
     */
    public function qrcode()
    {
        $this->app->loadClass('qrcode');
        QRcode::png($this->server->http_referer, false, 4, 6);
        exit;
    }

    /**
     * Show about info of chanzhi.
     *
     * @access public
     * @return void
     */
    public function about()
    {
        $this->view->title = $this->lang->about;
        $this->display();
    }

    /**
     * The thanks page.
     *
     * @access public
     * @return void
     */
    public function thanks()
    {
        $this->view->modalWidth = 700;
        $this->display();
    }
}
