<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of page module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     page
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class page extends control
{
    /**
     * The index page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $pages = $this->loadModel('article')->getList('page', 0, $orderBy = null);
        $title = $this->lang->page->list;
        
        $this->view->title = $title;
        $this->view->pages = $pages;
        $this->view->mobileURL  = helper::createLink('page', 'index', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('page', 'index', '', '', 'html');

        $this->display();
    }

    /**
     * View an page.
     * 
     * @param  int      $pageID 
     * @access public
     * @return void
     */
    public function view($pageID)
    {
        $page = $this->loadModel('article')->getPageByID($pageID);

        if($page->link)
        {
            $this->dao->update(TABLE_ARTICLE)->set('views = views + 1')->where('id')->eq($pageID)->exec();
            helper::header301($page->link);
        }

        $title    = $page->title;
        $keywords = $page->keywords . ' ' . $this->config->site->keywords;
        $desc     = $page->summary;
        
        $this->view->title      = $title;
        $this->view->keywords   = $keywords;
        $this->view->desc       = $desc;
        $this->view->page       = $page;
        $this->view->mobileURL  = helper::createLink('page', 'view', "pageID=$pageID", "name=$page->alias", 'mhtml');
        $this->view->desktopURL = helper::createLink('page', 'view', "pageID=$pageID", "name=$page->alias", 'html');

        $this->dao->update(TABLE_ARTICLE)->set('views = views + 1')->where('id')->eq($page->id)->exec();

        $this->display();
    }
}
