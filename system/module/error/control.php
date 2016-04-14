<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of error of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     error
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class error extends control
{
    /**
     * Show 404 error page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        @header("http/1.1 404 not found");
        @header("status: 404 not found");

        /* Record post number. */
        $this->loadModel('guarder')->logOperation('ip', 'error404');

        $this->display();
    }
}
