<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of forum module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class forum extends control
{
    /**
     * The index page of forum.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $this->forum->updateStats();
        $boards = $this->forum->getBoards();
        $this->view->title      = $this->lang->forumHome;
        $this->view->boards     = $boards;
        $this->view->mobileURL  = helper::createLink('forum', 'index', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('forum', 'index', '', '', 'html');

        $this->display();
    }

    /**
     * The board page.
     * 
     * @param int    $boardID       the board id
     * @param int    $pageID        the current page id
     * @access public
     * @return void
     */
    public function board($boardID = 0, $pageID = 1)
    {
        $board = $this->loadModel('tree')->getByID($boardID, 'forum');
        if(!$board) die(js::locate('back'));

        if($board->link) helper::header301($board->link); 
 
        /* Get common threads. */
        $recPerPage = !empty($this->config->site->forumRec) ? $this->config->site->forumRec : $this->config->forum->recPerPage;
        $this->app->loadClass('pager', $static = true);
        $pager   = new pager(0, $recPerPage, $pageID);
        $threads = $this->loadModel('thread')->getList($board->id, $orderBy = 'repliedDate_desc', $pager);

        $this->view->title      = $board->name;
        $this->view->keywords   = $board->keywords . '' . $this->config->site->keywords;
        $this->view->desc       = strip_tags($board->desc);
        $this->view->board      = $board;
        $this->view->sticks     = $this->thread->getSticks($board->id);
        $this->view->threads    = $threads;
        $this->view->pager      = $pager;
        $this->view->mobileURL  = helper::createLink('forum', 'board', "borderID=$boardID&pageID=$pageID", "category=$board->alias", 'mhtml');
        $this->view->desktopURL = helper::createLink('forum', 'board', "borderID=$boardID&pageID=$pageID", "category=$board->alias", 'html');

        $this->display();
    }

    /**
     * The admin page of board.
     * 
     * @param int       $boardID 
     * @param string    $orderBy 
     * @param int       $recTotal 
     * @param int       $recPerPage 
     * @param int       $pageID 
     * @access public
     * @return void
     */
    public function admin($boardID = 0, $orderBy = 'repliedDate_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        $this->loadModel('thread');
        if($this->session->currentGroup == 'home') $this->lang->menuGroups->forum = 'thread';

        $boards  = $this->loadModel('tree')->getFamily($boardID, 'forum');
        $threads = $boards ? $this->thread->getList($boards, $orderBy, $pager) : array();

        $this->view->boardID  = $boardID;
        $this->view->orderBy  = $orderBy;
        $this->view->board    = $this->tree->getByID($boardID, 'forum');
        $this->view->title    = $this->lang->thread->common;
        $this->view->threads  = $threads;
        $this->view->pager    = $pager;

        $this->display();
    }

    /**
     * Update stats of boards and threads.
     * 
     * @access public
     * @return void
     */
    public function update()
    {
        if($_POST)
        {
            $this->forum->updateStats(); 
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->forum->successUpdate));
        }

        $this->view->title = $this->lang->forum->update;
        $this->display();
    }

    /**
     * Forum settings.
     * 
     * @access public
     * @return void
     */
    public function setting()
    {
        if(!empty($_POST)) 
        {
            $result = $this->forum->saveSetting();
            if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }
        
        $this->view->title = $this->lang->forum->setting;
        $this->display();
    }
}
