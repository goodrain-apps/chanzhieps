<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The message module English file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->message->common            = 'Message';
$lang->message->id                = 'ID';
$lang->message->type              = 'Type';
$lang->message->from              = 'Name';
$lang->message->content           = 'Content';
$lang->message->phone             = 'Phone';
$lang->message->qq                = 'QQ';
$lang->message->email             = 'Email';
$lang->message->date              = 'Date';
$lang->message->secret            = 'Visible to administrator only.';
$lang->message->readed            = 'Read';
$lang->message->captcha           = 'Captcha';
$lang->message->list              = 'List';
$lang->message->post              = 'Post a comment';
$lang->message->viewArticle       = 'View article';
$lang->message->viewComment       = 'View comment';
$lang->message->noSelectedMessage = 'No message selected.';
$lang->message->needCheck         = 'It will be published after approved.';
$lang->message->showDetail        = 'Show Detail';
$lang->message->hideDetail        = 'Hide abstract';

$lang->message->admin          = 'Index';
$lang->message->pass           = 'Pass';
$lang->message->reply          = 'Reply';
$lang->message->view           = 'View';
$lang->message->manage         = 'Manage';
$lang->message->delete         = 'Delete';
$lang->message->deleteSelected = 'Delete selected';
$lang->message->passPre        = 'Pass previous';
$lang->message->deletePre      = 'Delete previous';
$lang->message->commentAt      = 'Comment at ';
$lang->message->deletedObject  = 'Deleted';
$lang->message->contactHidden  = "Your contant information will be sent to administrator and  is invisible to others.";

$lang->message->confirmDeleteSingle = 'Are you sure to delete this comment?';
$lang->message->confirmDeletePre    = 'Are you sure to delete comments previous?';
$lang->message->confirmPassSingle   = 'Are you sure to pass this comment?';
$lang->message->confirmPassPre      = 'Are you sure to pass comment previous?';

$lang->message->statusList[0] = 'Unreviewed';
$lang->message->statusList[1] = 'Reviewed';

$lang->message->readedStatus[0] = 'New';
$lang->message->readedStatus[1] = 'Readed';

$lang->comment = new stdclass();
$lang->comment->common       = 'Comment';
$lang->comment->id           = 'ID';
$lang->comment->type         = 'Type';
$lang->comment->from         = 'Name';
$lang->comment->content      = 'Content';
$lang->comment->phone        = 'Phone';
$lang->comment->qq           = 'QQ';
$lang->comment->email        = 'Email';
$lang->comment->captcha      = 'Captcha';
$lang->comment->list         = 'List';
$lang->comment->post         = 'Post a comment';
$lang->comment->viewArticle  = 'View article';
$lang->comment->viewComment  = 'View comment';
$lang->comment->needCheck    = 'It will be published after approved.';
$lang->comment->receiveEmail = 'Accept email reminder.';

$lang->comment->pass          = 'Pass';
$lang->comment->reply         = 'Reply';
$lang->comment->replyAt       = 'Reply at';
$lang->comment->manage        = 'Manage';
$lang->comment->delete        = 'Delete';
$lang->comment->passPre       = 'Pass previous';
$lang->comment->deletePre     = 'Delete previous';
$lang->comment->commentTo     = 'Comment on';
$lang->comment->commentAt     = 'Commented at';
$lang->comment->deletedObject = 'Deleted';

$lang->comment->confirmDeleteSingle = 'Are you sure to delete this comment?';
$lang->comment->confirmDeletePre    = 'Are you sure to delete comments previous?';
$lang->comment->confirmPassSingle   = 'Are you sure to pass this comment?';
$lang->comment->confirmPassPre      = 'Are you sure to pass comment previous?';

$lang->comment->statusList[0] = 'Unreviewed';
$lang->comment->statusList[1] = 'Reviewed';

$lang->message->replyItem   = "<dd><strong>%s</strong> reply at <em>%s</em>：%s</dd>";
$lang->comment->replyItem   = "<dd><strong>%s</strong> reply at <em>%s</em>：%s</dd>";
$lang->message->messageItem = "<dd><strong>%s</strong> comment at <em>%s</em>：%s</dd>";

$lang->message->replySubject = 'Reply from administrator of %s';
