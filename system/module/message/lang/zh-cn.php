<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The message module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->message->common            = '留言';
$lang->message->id                = '编号';
$lang->message->type              = '类型';
$lang->message->from              = '称呼';
$lang->message->content           = '内容';
$lang->message->phone             = '电话';
$lang->message->qq                = 'QQ';
$lang->message->email             = '邮箱';
$lang->message->date              = '时间';
$lang->message->secret            = '仅管理员可见';
$lang->message->readed            = '已读';
$lang->message->captcha           = '验证码';
$lang->message->list              = '留言列表';
$lang->message->post              = '发表留言';
$lang->message->viewArticle       = '正文';
$lang->message->viewComment       = '留言';
$lang->message->noSelectedMessage = '您没有选择任何留言。';
$lang->message->needCheck         = '留言通过审核后显示。';
$lang->message->showDetail        = '显示全部';
$lang->message->hideDetail        = '收起';

$lang->message->admin          = '后台首页';
$lang->message->pass           = '通过';
$lang->message->reply          = '回复';
$lang->message->view           = '查看';
$lang->message->manage         = '留言管理';
$lang->message->delete         = '删除';
$lang->message->deleteSelected = '删除选中项';
$lang->message->passPre        = '通过之前';
$lang->message->deletePre      = '删除之前';
$lang->message->commentAt      = '发表于 ';
$lang->message->deletedObject  = '已删除项目';
$lang->message->contactHidden  = "以下电话、邮箱、qq联系方式只有网站管理员可见，不会暴露。";

$lang->message->confirmDeleteSingle = '您确定要删除该留言吗？';
$lang->message->confirmDeletePre    = '您确定要删除之前的留言吗？';
$lang->message->confirmPassSingle   = '您确定要通过该留言吗？';
$lang->message->confirmPassPre      = '您确定要通过之前的留言吗？';

$lang->message->statusList[0] = '未审核';
$lang->message->statusList[1] = '已审核';

$lang->message->readedStatus[0] = '未读';
$lang->message->readedStatus[1] = '已读';

$lang->comment = new stdclass();
$lang->comment->common       = '评论';
$lang->comment->id           = '编号';
$lang->comment->type         = '类型';
$lang->comment->from         = '称呼';
$lang->comment->content      = '内容';
$lang->comment->phone        = '电话';
$lang->comment->qq           = 'QQ';
$lang->comment->email        = '邮箱';
$lang->comment->captcha      = '验证码';
$lang->comment->list         = '评论列表';
$lang->comment->post         = '发表评论';
$lang->comment->viewArticle  = '正文';
$lang->comment->viewComment  = '评论';
$lang->comment->needCheck    = '评论通过审核后显示。';
$lang->comment->receiveEmail = '接收邮件提醒';

$lang->comment->pass          = '通过';
$lang->comment->reply         = '回复';
$lang->comment->replyAt       = '回复于';
$lang->comment->manage        = '评论管理';
$lang->comment->delete        = '删除';
$lang->comment->passPre       = '通过之前';
$lang->comment->deletePre     = '删除之前';
$lang->comment->commentTo     = '发表于';
$lang->comment->commentAt     = '发表于';
$lang->comment->deletedObject = '已删除项目';

$lang->comment->confirmDeleteSingle = '您确定要删除该评论吗？';
$lang->comment->confirmDeletePre    = '您确定要删除之前的评论吗？';
$lang->comment->confirmPassSingle   = '您确定要通过该评论吗？';
$lang->comment->confirmPassPre      = '您确定要通过之前的评论吗？';

$lang->comment->statusList[0] = '未审核';
$lang->comment->statusList[1] = '已审核';

$lang->message->replyItem   = "<dd><strong>%s</strong> 于 <em>%s</em> 回复：%s</dd>";
$lang->comment->replyItem   = "<dd><strong>%s</strong> 于 <em>%s</em> 回复：%s</dd>";
$lang->message->messageItem = "<dd><strong>%s</strong> 于 <em>%s</em> 发表：%s</dd>";

$lang->message->replySubject = '%s管理员的回复';
