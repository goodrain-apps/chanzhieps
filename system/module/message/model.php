<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class messageModel extends model
{
    /**
     * Get message by ID.
     *
     * @param  int    $messageID
     * @access public
     * @return object
     */
    public function getByID($messageID)
    {
        return $this->dao->select('*')->from(TABLE_MESSAGE)->findByID($messageID)->fetch();
    }

    /**
     * Get message list By Account
     *
     * @param  string    $account
     * @param  object    $pager
     * @access public
     * @return array
     */
    public function getByAccount($account, $pager = null)
    {
        return $this->dao->select('*')->from(TABLE_MESSAGE)
            ->where('`to`')->eq($account)
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll('id');
    }

    /**
     * Get messages of one object.
     *
     * @param  string $type          the message type
     * @param  string $objectType    the object type
     * @param  int    $objectID      the object id
     * @access public
     * @return array
     */
    public function getByObject($type, $objectType, $objectID, $pager = null)
    {
        $userMessages = $this->cookie->cmts;
        $userMessages = trim($userMessages, ',');
        $idList       = explode(',', $userMessages);
        if(empty($userMessages)) $userMessages = '0';

        foreach($idList as $id) 
        {
            if(!is_numeric($id)) $userMessages = '0';
        }

        return  $this->dao->select('*')->from(TABLE_MESSAGE)
            ->where('type')->eq($type)
            ->beginIf(RUN_MODE == 'front' and $type == 'message')->andWhere('public')->eq(1)->fi()
            ->andWhere('objectType')->eq($objectType)
            ->andWhere('objectID')->eq($objectID)
            ->andWhere("(id in ({$userMessages}) or (status = '1'))")
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll();
    }

    /**
     * Get all replies of a message for admin.
     *
     * @param  object  $message
     * @access public
     * @return array
     */
    public function getAdminReplies($message)
    {
        $replies = $this->getReplies($message);

        if(!empty($replies))
        {
            echo "<dl class='alert alert-info'>";
            foreach($replies as $reply)
            {
                printf($this->lang->message->replyItem, $reply->from, $reply->date, $reply->content);
                commonModel::printLink('message', 'delete', "messageID=$reply->id&type=single&status=$reply->status", $this->lang->delete, "class='deleter'");
                $this->getAdminReplies($reply);
            }
            echo "</dl>";
        }
    }

    /**
     * Get all replies of a message for front.
     *
     * @param  object  $message
     * @access public
     * @return array
     */
    public function getFrontReplies($message, $type = '')
    {
        $replies = $this->getReplies($message);

        if(!empty($replies))
        {
            if($type !== 'simple')
            {
                foreach($replies as $reply)
                {
                    echo "<div class='panel-heading reply-heading'>";
                    echo "<i class='icon icon-user'> {$reply->from}</i> ";
                    echo "<i class='text-muted'>" . $reply->date . "</i>";
                    echo html::a(helper::createLink('message', 'reply', "id={$reply->id}"), "<i class='icon icon-reply'> </i>", " data-toggle='modal' data-type='iframe' class='text-info pull-right' id='reply{$reply->id}'");
                    echo '</div>';
                    echo "<div class='panel-body'>";
                    echo nl2br($reply->content);
                    echo '</div>';
                    $this->getFrontReplies($reply);
                }
            }
            else
            {
                echo "<div class='replies'>";
                foreach($replies as $reply)
                {
                    echo "<div class='reply card'>";

                    echo "<div class='card-heading'>";
                    echo "<span class='text-primary'><i class='icon-reply'></i> {$reply->from}</span> &nbsp; <small class='text-muted'>" . formatTime($reply->date, 'Y/m/d H:m') . "</small>";
                    echo "<div class='actions'>" . html::a(helper::createLink('message', 'reply', "id={$reply->id}"), $this->lang->message->reply, " data-toggle='modal' data-type='ajax' id='reply{$reply->id}'") . "</div>";
                    echo '</div>';

                    echo "<div class='card-content'>" . nl2br($reply->content) . "</div>";

                    $this->getFrontReplies($reply, $type);

                    echo '</div>';
                }
                echo '</div>';
            }
        }
    }

    /**
     * Get replies of a message.
     *
     * @param  object  $message
     * @access public
     * @return array
     */
    public function getReplies($message)
    {
        $userMessages = $this->cookie->cmts;
        $userMessages = trim($userMessages, ',');
        $idList       = explode(',', $userMessages);
        if(empty($userMessages)) $userMessages = '0';

        foreach($idList as $id) 
        {
            if(!is_numeric($id)) $userMessages = '0';
        }

        if(!$message) return false;
        return $this->dao->select('*')->from(TABLE_MESSAGE)
            ->where('type')->eq('reply')
            ->andWhere('objectID')->eq($message->id)
            ->beginIF(defined('RUN_MODE') and RUN_MODE == 'front')->andWhere("(id in ({$userMessages}) or (status = '1'))")->fi()
            ->orderby('id_asc')
            ->fetchAll();
    }

    /**
     * Get original message.
     *
     * @param  int    $messageID
     * @access public
     * @return bool | object
     */
    public function getOriginal($messageID)
    {
        $message = $this->dao->select('*')->from(TABLE_MESSAGE)->where('id')->eq($messageID)->fetch();
        if(strpos('message,reply,comment', $message->objectType) === false or $message->objectID == 0) return false;
        return $this->dao->select('*')->from(TABLE_MESSAGE)->where('id')->eq($message->objectID)->fetch();
    }

    /**
     * Get reply of message. 
     * 
     * @param  int    $messageID 
     * @access public
     * @return bool | object 
     */
    public function getReply($messageID)
    {
        return $this->dao->select('*')->from(TABLE_MESSAGE)->where('objectID')->eq($messageID)
            ->andWhere('objectType')->in('message,reply,comment')
            ->fetch();
    }

    /**
     * Get object of a message.
     *
     * @param  object  $message
     * @access public
     * @return array
     */
    public function getObject($message)
    {
        $object = $this->dao->select('*')->from(TABLE_MESSAGE)->where('id')->eq($message->objectID)->fetch();
        if(!$object) return false; 
        echo "<dl class='alert'>";
        printf($this->lang->message->messageItem, $object->from, $object->date, $object->content);
        echo "</dl>";
    }

    /**
     * Get message list.
     *
     * @param string $type      the message type
     * @param int    $status    the message status
     * @param object $pager
     * @access public
     * @return void
     */
    public function getList($type, $status, $pager = null)
    {
        $messages = $this->dao->select('*')->from(TABLE_MESSAGE)
            ->where('type')->eq($type)
            ->andWhere('status')->eq($status)
            ->beginIf(RUN_MODE == 'front')->andWhere('public')->eq(1)->fi()
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll('id');

        /* Get object titles and id. */
        $articles   = array();
        $products   = array();
        $books      = array();
        $messageIDs = array();
        $comments   = array();

        foreach($messages as $message)
        {
            if('article' == $message->objectType) $articles[]   = $message->objectID;
            if('product' == $message->objectType) $products[]   = $message->objectID;
            if('book'    == $message->objectType) $books[]      = $message->objectID;
            if('message' == $message->objectType) $messageIDs[] = $message->objectID;
            if('comment' == $message->objectType) $comments[]   = $message->objectID;
        }

        $articleTitles = $this->dao->select('id, title')->from(TABLE_ARTICLE)->where('id')->in($articles)->fetchPairs('id', 'title');
        $productTitles = $this->dao->select('id, name')->from(TABLE_PRODUCT)->where('id')->in($products)->fetchPairs('id', 'name');
        $bookTitles    = $this->dao->select('id, title')->from(TABLE_BOOK)->where('id')->in($books)->fetchPairs('id', 'title');
        $messageTitles = $this->dao->select('id, `from`')->from(TABLE_MESSAGE)->where('id')->in($messageIDs)->fetchPairs('id', 'from');
        $commentTitles = $this->dao->select('id, `from`')->from(TABLE_MESSAGE)->where('id')->in($comments)->fetchPairs('id', 'from');

        foreach($messages as $message)
        {
            if($message->objectType == 'article') $message->objectTitle = isset($articleTitles[$message->objectID]) ? $articleTitles[$message->objectID] : '';
            if($message->objectType == 'product') $message->objectTitle = isset($productTitles[$message->objectID]) ? $productTitles[$message->objectID] : '';
            if($message->objectType == 'book')    $message->objectTitle = isset($bookTitles[$message->objectID]) ? $bookTitles[$message->objectID] : '';
            if($message->objectType == 'message') $message->objectTitle = isset($messageTitles[$message->objectID]) ? $messageTitles[$message->objectID] : '';
            if($message->objectType == 'comment') $message->objectTitle = isset($commentTitles[$message->objectID]) ? $commentTitles[$message->objectID] : '';
        }

        foreach($messages as $message)
        {
            if($message->type != 'message') $message->objectViewURL = $this->getObjectLink($message);
        }

        return $messages;
    }

    /**
     * Post a message.
     *
     * @access public
     * @return void
     */
    public function post($type)
    {
        $account = $this->app->user->account;
        $admin   = $this->app->user->admin;
        $message = fixer::input('post')
            ->add('date', helper::now())
            ->add('type', $type)
            ->add('status', '0')
            ->setDefault('public', '1')
            ->setIF(isset($_POST['secret']) and $_POST['secret'] == 1, 'public', '0')
            ->setIF($type == 'message', 'to', 'admin')
            ->setIF($account != 'guest', 'account', $account)
            ->setIF($admin == 'super', 'status', '1')
            ->add('ip', $this->server->REMOTE_ADDR)
            ->get();

        if(strlen($message->content) > 29)
        {
            $repeat = $this->loadModel('guarder')->checkRepeat($message->content); 
            if($repeat) return array('result' => 'fail', 'message' => $this->lang->error->noRepeat);
        }


        if($this->loadModel('guarder')->matchList($message))  return array('result' => 'fail', 'reason' => 'error', 'message' => $this->lang->error->sensitive);

        if(isset($this->config->site->filterSensitive) and $this->config->site->filterSensitive == 'open')
        {
            $dicts = !empty($this->config->site->sensitive) ? $this->config->site->sensitive : $this->config->sensitive;
            $dicts = explode(',', $dicts);
            if(!validater::checkSensitive($message, $dicts)) return array('result' => 'fail', 'reason' => 'error', 'message' => $this->lang->error->sensitive);
        }

        $this->dao->insert(TABLE_MESSAGE)
            ->data($message, $skip = $this->session->captchaInput . ', secret')
            ->autoCheck()
            ->check($this->session->captchaInput, 'captcha')
            ->check('type', 'in', $this->config->message->types)
            ->checkIF(!empty($message->email), 'email', 'email')
            ->checkIF(!empty($message->phone), 'phone', 'phone')
            ->batchCheck($this->config->message->require->post, 'notempty')
            ->exec();

        $this->setCookie($this->dao->lastInsertId());

        /* Record post number. */
        $guarder = $this->loadModel('guarder');
        $guarder->logOperation('account', 'postComment');
        $guarder->logOperation('ip', 'postComment');
        if(dao::isError()) 
        {
            $errors = dao::getError();   
            if(isset($errors[$this->session->captchaInput]))
            {
                $guarder->logOperation('ip', 'captchaFail');
                $guarder->logOperation('account', 'captchaFail');
            }
            return array('result' => 'fail', 'message' => $errors);
        }
        return array('result' => 'success', 'message' => $this->lang->message->needCheck);
    }

    /**
     * Reply a message.
     *
     * @param  int    $messageID
     * @access public
     * @return void
     */
    public function reply($messageID)
    {
        $account = $this->app->user->account;
        $admin   = $this->app->user->admin;
        $message = $this->getByID($messageID);

        $reply = fixer::input('post')
            ->add('objectType', $message->type == 'reply' ? $message->objectType : $message->type)
            ->add('objectID', $message->id)
            ->add('to', $message->account)
            ->add('type', 'reply')
            ->add('date', helper::now())
            ->add('status', '0')
            ->add('public', 1)
            ->setIF($account != 'guest', 'account', $account)
            ->setIF($admin == 'super', 'status', '1')
            ->add('ip', $this->server->REMOTE_ADDR)
            ->get();

        $this->dao->insert(TABLE_MESSAGE)
            ->data($reply, $skip = $this->session->captchaInput)
            ->autoCheck()
            ->check($this->session->captchaInput, 'captcha')
            ->check('type', 'in', $this->config->message->types)
            ->batchCheck($this->config->message->require->reply, 'notempty')
            ->exec();

        $replyID = $this->dao->lastInsertId();

        if(!dao::isError())
        {
            if($admin == 'super')
            {
                $this->dao->update(TABLE_MESSAGE)->set('status')->eq(1)->where('status')->eq(0)->andWhere('id')->eq($messageID)->exec();
                if(dao::isError()) return false;
            }

            /* if message type is comment , check is user want to receive email reminder  */
            if(validater::checkEmail($message->email) && ($message->type != 'comment' || $message->receiveEmail))
            {
                $mail = new stdclass();
                $mail->to      = $message->email;
                $mail->subject = sprintf($this->lang->message->replySubject, $this->config->site->name);
                $mail->body    = $reply->content;

                $this->loadModel('mail')->send($mail->to, $mail->subject, $mail->body);
            }

            return $replyID;
        }

        return false;
    }

    /**
     * Delete a message.
     *
     * @param string $messageID
     * @param string $mode
     * @access public
     * @return void
     */
    public function delete($messageID, $mode)
    {
        $message = $this->dao->select('id,type')->from(TABLE_MESSAGE)->where('id')->eq($messageID)->fetch();
        $this->dao->delete()
            ->from(TABLE_MESSAGE)
            ->where('type')->eq($message->type)
            ->beginIF($mode == 'single')->andWhere('id')->eq($messageID)->fi()
            ->beginIF($mode == 'pre')->andWhere('id')->ge($messageID)->andWhere('status')->ne('1')->fi()
            ->exec();

        return !dao::isError();
    }

    /**
     * Pass messages.
     *
     * @param string $messageID
     * @param string $type          single|pr
     * @access public
     * @return void
     */
    public function pass($messageID, $type)
    {
        $message = $this->dao->select('id,type')->from(TABLE_MESSAGE)->where('id')->eq($messageID)->fetch();
        $this->dao->update(TABLE_MESSAGE)
            ->set('status')->eq(1)
            ->where('status')->eq(0)
            ->andWhere('type')->eq($message->type)
            ->beginIF($type == 'single')->andWhere('id')->eq($messageID)->fi()
            ->beginIF($type == 'pre')->andWhere('id')->ge($messageID)->fi()
            ->exec();
        return !dao::isError();
    }

    /**
     * Mark a message readed.
     *
     * @param  int    $messageID
     * @access public
     * @return bool
     */
    public function markReaded($messageID)
    {
        $this->dao->update(TABLE_MESSAGE)->set('readed')->eq('1')->where('id')->eq($messageID)->exec();
        return !dao::isError();
    }

    /**
     * Set the message id the user posted to the cookie. Thus before approvaled, the user can view these messages.
     *
     * @param string $messageID
     * @access public
     * @return void
     */
    public function setCookie($messageID)
    {
        $messages = $this->cookie->cmts;
        if(!$messages)
        {
            $messages = $messageID;
        }
        else
        {
            if(strpos($messages, $messageID) === false)
            {
                $messages .= ',' . $messageID;
            }
        }
        setcookie('cmts', $messages);
    }

    /**
     * Get the link of the object of one message.
     *
     * @param string $message
     * @access public
     * @return sting
     */
    public function getObjectLink($message)
    {
        if(empty($message)) return '';
        $link = '';
        if($message->objectType == 'article')
        {
            $link = $this->loadModel('article')->createPreviewLink($message->objectID);
        }
        elseif($message->objectType == 'product')
        {
            $link = commonModel::createFrontLink('product', 'view', "prodcutID=$message->objectID");
        }
        elseif($message->objectType == 'book')
        {
            $node = $this->loadModel('book')->getNodeByID($message->objectID);
            $link = commonModel::createFrontLink('book', 'read', "articleID=$message->objectID", "book={$node->book->alias}&node={$node->alias}");
        }
        elseif($message->objectType == 'message')
        {
            $link = commonModel::createFrontLink('message', 'index') . "#comment{$message->objectID}";
        }
        elseif($message->objectType == 'comment')
        {
            $object = $this->getByID($message->objectID);
            $link   = $this->getObjectLink($object);
        }

        return $link;
    }

    /**
     * Delete messages of a user..
     *
     * @param  int     $message
     * @access public
     * @return void
     */
    public function deleteByAccount($message)
    {
        $this->dao->delete()->from(TABLE_MESSAGE)->where('`to`')->eq($this->app->user->account)->andWhere('id')->eq($message)->exec();
        return !dao::isError();
    }
    /**
     * Send a message.
     * 
     * @param  string    $from 
     * @param  string    $to 
     * @param  string    $content 
     * @access public
     * @return bool 
     */
    public function send($from, $to, $content)
    {
        $message = new stdclass();
        $message->from    = $from;
        $message->to      = $to;
        $message->content = $content;
        $message->status  = 1;
        $message->date    = helper::now();
        $this->dao->insert(TABLE_MESSAGE)->data($message)->batchCheck('from,to,content', 'notempty')->autocheck()->exec();
        return !dao::isError();
    }

    /**
     * Get messages not checked. 
     * 
     * @param  int    $type 
     * @access public
     * @return void
     */
    public function getMessages($type)
    {
        $messages = $this->dao->select('id')->from(TABLE_MESSAGE)
            ->where('type')->eq($type)
            ->andWhere('status')->eq(0)
            ->fetchAll();
        if(dao::isError()) return false;

        return count($messages);
    }
}
