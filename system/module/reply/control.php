<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of reply module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     reply
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class reply extends control
{
    /**
     * Reply a thread.
     * 
     * @param  int      $threadID 
     * @access public
     * @return void
     */
    public function post($threadID)
    {
        if($this->app->user->account == 'guest') die(js::locate($this->createLink('user', 'login')));

        if($_POST)
        {
            $captchaConfig = isset($this->config->site->captcha) ? $this->config->site->captcha : 'auto';
            $needCaptcha   = false;
            if($captchaConfig == 'open' or ($captchaConfig == 'auto' and $this->loadModel('guarder')->isEvil($this->post->content))) $needCaptcha = true;

            /* If no captcha but is garbage, return the error info. */
            $captchaInput = $this->session->captchaInput;
            if($this->post->$captchaInput === false and $needCaptcha)
            {
                $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => base64_encode($this->loadModel('guarder')->create4Reply())));
            }

            $result = $this->reply->post($threadID);
            $this->send($result);
        }
    }

    /**
     * Manage replies.
     * 
     * @access public
     * @return void
     */
    public function admin($orderBy = 'addedDate_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager   = new pager($recTotal, $recPerPage, $pageID);
        $replies = $this->reply->getList($orderBy, $pager);

        $this->lang->reply->menu = $this->lang->forum->menu;
        if($this->session->currentGroup == 'home') $this->lang->menuGroups->reply = 'forumreply';
        if($this->session->currentGroup != 'home') $this->lang->menuGroups->reply = 'forum';

        $this->view->title   = $this->lang->reply->common;
        $this->view->replies = $replies;
        $this->view->pager   = $pager;
        $this->display(); 
    }

    /**
     * Edit a reply.
     * 
     * @param string $replyID 
     * @access public
     * @return void
     */
    public function edit($replyID)
    {
        if($this->app->user->account == 'guest') die(js::locate($this->createLink('user', 'login')));

        /* Judge current user has priviledge to edit the reply or not. */
        $reply = $this->reply->getByID($replyID);
        if(!$reply) die(js::locate('back'));

        $thread = $this->loadModel('thread')->getByID($reply->thread);
        if(!$this->thread->canManage($thread->board, $reply->author)) die(js::locate('back'));
        if($this->thread->canManage($thread->board)) $this->config->reply->editor->edit['tools'] = 'full';
        
        if($_POST)
        {
            /* If no captcha but is garbage, return the error info. */
            $captchaInput = $this->session->captchaInput;
            if($this->post->$captchaInput === false and $this->loadModel('guarder')->isEvil($_POST['content']))
            {
                $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => base64_encode($this->guarder->create4Thread())));
            }

            $return = $this->reply->update($replyID);
            if(is_array($return)) $this->send($return);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->createLink('thread', 'view', "threaID=$thread->id")));
        }

        $this->view->title      = $this->lang->reply->edit . $this->lang->colon . $thread->title;
        $this->view->reply      = $reply;
        $this->view->thread     = $thread;
        $this->view->board      = $this->loadModel('tree')->getById($thread->board);
        $this->view->mobileURL  = helper::createLink('reply', 'edit', "replyID=$replyID", '', 'mhtml');
        $this->view->desktopURL = helper::createLink('reply', 'edit', "replyID=$replyID", '', 'html');

        $this->display();
    }

    /**
     * Delete a reply.
     * 
     * @param  int      $replyID 
     * @access public
     * @return void
     */
    public function delete($replyID)
    {
        $reply = $this->reply->getByID($replyID);
        if(!$reply) $this->send(array('result' => 'fail', 'message' => 'Not found'));

        $thread = $this->loadModel('thread')->getByID($reply->thread);
        if(!$this->thread->canManage($thread->board)) $this->send(array('result' => 'fail'));

        if(RUN_MODE == 'admin')
        {
            $locate = helper::createLink('reply', 'admin');
        }
        else
        {
            $locate = helper::createLink('thread', 'view', "threadID=$reply->thread");
        }
        if($this->reply->delete($replyID)) $this->send(array('result' => 'success', 'locate' => $locate));

        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Delete a file.
     * 
     * @param  int    $replyID 
     * @param  int    $fileID 
     * @access public
     * @return void
     */
    public function deleteFile($replyID, $fileID)
    {
        if($this->app->user->account == 'guest') $this->send(array('result'=>'fail', 'message'=> 'guest'));

        $reply = $this->reply->getByID($replyID);
        if(!$reply) $this->send(array('result'=>'fail', 'message'=> 'data error'));

        $thread = $this->loadModel('thread')->getByID($reply->thread);
        if(!$thread) $this->send(array('result'=>'fail', 'message'=> 'data error'));

        /* Judge current user has priviledge to edit the reply or not. */
        if($this->thread->canManage($thread->board, $reply->author))
        {
            if($this->loadModel('file')->delete($fileID)) $this->send(array('result'=>'success'));
        }
        $this->send(array('result'=>'fail', 'message'=> 'error'));
    }
}
