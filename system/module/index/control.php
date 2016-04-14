<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of index module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     index
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class index extends control
{
    /**
     * Construct, must create this contruct function since there's index() also
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The index page of whole site.
     * 
     * @access public
     * @return void
     */
    public function index($categoryID = 0, $pageID = 1)
    {
        if(isset($this->config->site->type) and $this->config->site->type == 'blog')
        {
            $param = ($categoryID == 0 and $pageID == 1) ? '' : "categoryID={$categoryID}&pageID={$pageID}";
            $this->locate($this->createLink('blog', 'index', $param));
        }

        $this->view->title = $this->config->site->indexKeywords;
        $this->view->mobileURL  = helper::createLink('index', 'index', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('index', 'index', '', '', 'html');
        $this->display();
    }
}
