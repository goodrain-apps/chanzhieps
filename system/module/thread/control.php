<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of thread module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class thread extends control
{
    /**
     * Post a thread.
     *
     * @param  int      $boardID
     * @access public
     * @return void
     */
    public function post($boardID = 0)
    {
        $this->loadModel('forum');
        if($this->app->user->account == 'guest') die(js::locate($this->createLink('user', 'login', "referer=" . helper::safe64Encode($this->app->getURI()))));

        /* Get the board. */
        $board = $this->loadModel('tree')->getById($boardID);

        /* Checking the board exist or not. */
        if(!$board)
        {
            die(js::error($this->lang->forum->notExist) . js::locate('back'));
        }

        /* Checking current user can post to the board or not. */
        if(!$this->forum->canPost($board))
        {
            die(js::error($this->lang->forum->readonly) . js::locate('back'));
        }

        /* Set editor for current user. */
        $this->thread->setEditor($board->id, 'post');

        /* User posted a thread, try to save it to database. */
        if($_POST)
        {
            $captchaConfig = isset($this->config->site->captcha) ? $this->config->site->captcha : 'auto';
            $needCaptcha   = false;
            if($captchaConfig == 'auto' and $this->loadModel('guarder')->isEvil($this->post->{$this->session->contentInput})) $needCaptcha = true;
            if($captchaConfig == 'open')  $needCaptcha = true;
            if($captchaConfig == 'close') $needCaptcha = false;
           
            /* If no captcha but is garbage, return the error info. */
            $captchaInput = $this->session->captchaInput;
            if($this->post->$captchaInput === false and $needCaptcha)
            {
                $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => base64_encode($this->loadModel('guarder')->create4Thread())));
            }

            $result = $this->thread->post($boardID);
            $this->send($result);
        }

        $titleInput   = helper::createRandomStr(6, $skip='A-Z'); 
        $contentInput = helper::createRandomStr(7, $skip='A-Z'); 
        $this->session->set('titleInput', $titleInput);
        $this->session->set('contentInput', $contentInput);
        $this->config->thread->require->post = "{$this->session->titleInput}, {$this->session->contentInput}";
        $this->config->thread->editor->post = array('id' => $this->session->contentInput, 'tools' => 'simple');

        $this->view->title        = $board->name . $this->lang->minus . $this->lang->thread->post;
        $this->view->board        = $board;
        $this->view->canManage    = $this->thread->canManage($boardID);
        $this->view->titleInput   = $titleInput;
        $this->view->contentInput = $contentInput;
        $this->view->board        = $board;
        $this->view->mobileURL    = helper::createLink('thread', 'post', "boardID=$boardID", '', 'mhtml');
        $this->view->desktopURL   = helper::createLink('thread', 'post', "boardID=$boardID", '', 'html');

        $this->display();
    }

    /**
     * Edit a thread.
     *
     * @param string $threadID
     * @access public
     * @return void
     */
    public function edit($threadID)
    {
        if($this->app->user->account == 'guest') die(js::locate($this->createLink('user', 'login')));

        $thread = $this->thread->getByID($threadID);
        if(!$thread) die(js::locate('back'));

        /* Judge current user has priviledge to edit the thread or not. */
        if(!$this->thread->canManage($thread->board, $thread->author)) die(js::locate('back'));

        /* Set editor for current user. */
        $this->thread->setEditor($thread->board, 'edit');

        if($_POST)
        {
            /* If no captcha but is garbage, return the error info. */
            if($this->loadModel('guarder')->isEvil($this->post->content))
            {
                $captchaInput = $this->session->captchaInput;
                if(!$captchaInput or $this->post->$captchaInput === false) $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => base64_encode($this->guarder->create4Thread())));
            }

            $return = $this->thread->update($threadID);
            if(is_array($return)) $this->send($return);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('view', "threadID=$threadID")));
        }

        $board = $this->loadModel('tree')->getById($thread->board);
       
        $this->view->title      = $this->lang->thread->edit . $this->lang->minus . $thread->title;
        $this->view->thread     = $thread;
        $this->view->board      = $board;
        $this->view->canManage  = $this->thread->canManage($board->id);
        $this->view->mobileURL  = helper::createLink('thread', 'edit', "threadID=$threadID", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('thread', 'edit', "threadID=$threadID", '', 'html');

        $this->display();
    }

    /**
     * View a thread.
     *
     * @param  int    $threadID
     * @param  int    $pageID
     * @access public
     * @return void
     */
    public function view($threadID, $pageID = 1)
    {
        $this->loadModel('guarder');
        $thread = $this->thread->getByID($threadID);
        if(!$thread or $thread->hidden) die(js::locate('back'));

        if($thread->link)
        {
             $this->thread->plusCounter($threadID);
             helper::header301($thread->link);
        }

        /* Set editor for current user. */
        $this->thread->setEditor($thread->board, 'view');

        /* Get thread board. */
        $board = $this->loadModel('tree')->getById($thread->board);

        /* Get replies. */
        $this->app->loadConfig('reply');
        $recPerPage = !empty($this->config->site->replyRec) ? $this->config->site->replyRec : $this->config->reply->recPerPage;
        $this->app->loadClass('pager', $static = true);
        $pager   = new pager(0, $recPerPage, $pageID);
        $replies = $this->loadModel('reply')->getByThread($threadID, $pager);

        /* Get all speakers. */
        $speakers = $this->thread->getSpeakers($thread, $replies);
        $speakers = $this->loadModel('user')->getBasicInfo($speakers);
        foreach($speakers as $account => $speaker)
        {
            $speaker->isModerator = strpos(",{$board->moderators},", ",{$account},") !== false;      
        }

        /* Set the views counter + 1; */
        $this->thread->plusCounter($threadID);

        $this->view->title      = $thread->title . $this->lang->minus . $board->name;
        $this->view->board      = $board;
        $this->view->thread     = $thread;
        $this->view->replies    = $replies;
        $this->view->pager      = $pager;
        $this->view->speakers   = $speakers;
        $this->view->mobileURL  = helper::createLink('thread', 'view', "threadID=$threadID&pageID=$pageID", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('thread', 'view', "threadID=$threadID&pageID=$pageID", '', 'html');

        $this->display();
    }

    /**
     * transfer a thread.
     *
     * @param  int    $threadID
     * @access public
     * @return void
     */
    public function transfer($threadID)
    {
        $thread = $this->thread->getByID($threadID);
        if(!$thread) exit;
        if($_POST)
        {
            if($this->thread->transfer($threadID, $thread->board, $this->post->targetBoard))
            {
                $this->send(array('result' =>'success', 'message' => $this->lang->thread->successTransfer, 'locate' => $this->server->http_referer));
            }
            else
            {
                $this->send(array('result' => 'fail', 'message' => dao::getError()));
            }
        }

        $parents = $this->dao->select('*')->from(TABLE_CATEGORY)->where('parent')->eq(0)->andWhere('type')->eq('forum')->fetchAll('id');

        $this->view->title   = "<i class='icon-edit'></i> " . $this->lang->thread->transfer;
        $this->view->parents = array_keys($parents);
        $this->view->thread  = $thread;
        $this->view->boards  = $this->loadModel('tree')->getOptionMenu('forum', 0, $removeRoot = true);
        $this->display();
    }

    /**
     * Locate to the thread and reply.
     *
     * @param  int    $threadID
     * @param  int    $replyID
     * @access public
     * @return void
     */
    public function locate($threadID, $replyID = 0)
    {
        $position = $replyID ? $this->loadModel('reply')->getPosition($replyID) : '';
        $location = $this->createLink('thread', 'view', "threadID=$threadID", $position);
        header("location:$location");
    }

    /**
     * Delete a thread.
     *
     * @param  int      $threadID
     * @access public
     * @return void
     */
    public function delete($threadID)
    {
        $thread = $this->thread->getByID($threadID);
        if(!$thread) $this->send(array('result' => 'fail', 'message' => 'Not found'));

        if(!$this->thread->canManage($thread->board)) $this->send(array('result' => 'fail'));

        if(RUN_MODE == 'admin') $locate = helper::createLink('forum', 'admin');
        if(RUN_MODE == 'front') $locate = helper::createLink('forum', 'board', "board=$thread->board");

        if($this->thread->delete($threadID)) $this->send(array('result' => 'success', 'locate' => $locate));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }
  
    /**
     * Approve a thread.
     *
     * @param  int    $threadID
     * @param  int    $boardID
     * @access public
     * @return void
     */
    public function approve($threadID, $boardID)
    {
        $result = $this->thread->approve($threadID, $boardID);
        if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $locate = helper::createLink('forum', 'admin');
        $this->send(array('result' => 'success', 'message' => '',  'locate' => $locate));
    }

    /**
     * Switch a thread's status.
     *
     * @param  int    $threadID
     * @access public
     * @return void
     */
    public function switchStatus($threadID)
    {
        $thread = $this->thread->getByID($threadID);
        if(!$thread) $this->send(array('result' => 'fail', 'message' => 'Not found'));

        if(!$this->thread->canManage($thread->board)) $this->send(array('result' => 'fail'));

        if($this->thread->switchStatus($threadID))
        {
            if(RUN_MODE == 'admin')
            {
                $locate = helper::createLink('forum', 'admin');
            }
            else
            {
                $locate = helper::createLink('forum', 'board', "board=$thread->board");
            }
            $message = $thread->hidden ? $this->lang->thread->successShow : $this->lang->thread->successHide;
            $this->send(array('result' => 'success', 'message' => $this->lang->thread->successHide,  'locate' => $locate));
        }

        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Set the stick level of a thread.
     *
     * @param  int    $threadID
     * @param  int    $stick
     * @access public
     * @return void
     */
    public function stick($threadID, $stick)
    {
        $thread = $this->thread->getByID($threadID);
        if(!$this->thread->canManage($thread->board)) exit;

        $this->dao->update(TABLE_THREAD)->set('stick')->eq($stick)->where('id')->eq($threadID)->exec();
        if(dao::isError()) $this->send(array('result' =>'fail', 'message' => dao::getError()));

        $message = $stick == 0 ? $this->lang->thread->successUnstick : $this->lang->thread->successStick;
        $this->send(array('message' => $message, 'locate' => inlink('view', "threaID=$threadID")));
    }

    /**
     * Delete a file.
     *
     * @param  int    $threadID
     * @param  int    $fileID
     * @access public
     * @return void
     */
    public function deleteFile($threadID, $fileID)
    {
        if($this->app->user->account == 'guest') $this->send(array('result'=>'fail', 'message'=> 'guest'));

        $thread = $this->thread->getByID($threadID);
        if(!$thread) $this->send(array('result'=>'fail', 'message'=> 'data error'));

        /* Judge current user has priviledge to edit the thread or not. */
        if($this->thread->canManage($thread->board, $thread->author))
        {
            if($this->loadModel('file')->delete($fileID)) $this->send(array('result'=>'success'));
        }
        $this->send(array('result'=>'fail', 'message'=> 'error'));
    }

    /**
     * Add score.
     *
     * @param  int    $account
     * @param  int    $objectType
     * @param  int    $objectID
     * @param  int    $score
     * @access public
     * @return void
     */
    public function addScore($account, $objectType, $objectID)
    {
        $this->loadModel('score');
        if($objectType == 'thread') $board = $this->dao->select('board')->from(TABLE_THREAD)->where('id')->eq($objectID)->fetch('board');
        if($objectType == 'reply')  $board = $this->dao->select('t1.board')->from(TABLE_THREAD)->alias('t1')
            ->leftJoin(TABLE_REPLY)->alias('t2')->on('t1.id=t2.thread')
            ->where('t2.id')->eq($objectID)
            ->fetch('board');
        if(!isset($board) or !$this->thread->canManage($board)) die();

        if($_POST)
        {
            $account = helper::safe64Decode($account);
            if($objectType == 'thread') $result = $this->score->award($account, 'valueThread', $this->post->count, $objectType, $objectID, $this->post->note);
            if($objectType == 'reply')  $result = $this->score->award($account, 'valueReply',  $this->post->count, $objectType, $objectID, $this->post->note);
            if($result) $this->send(array('result' => 'success', 'locate' => $this->server->http_referer));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title      = $this->lang->thread->score;
        $this->view->account    = $account;
        $this->view->objectType = $objectType;
        $this->view->objectID   = $objectID;
        $this->display();
    }
}
