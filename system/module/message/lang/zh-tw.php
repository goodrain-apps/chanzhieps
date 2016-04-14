<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The message module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->message->common            = '留言';
$lang->message->id                = '編號';
$lang->message->type              = '類型';
$lang->message->from              = '稱呼';
$lang->message->content           = '內容';
$lang->message->phone             = '電話';
$lang->message->qq                = 'QQ';
$lang->message->email             = '郵箱';
$lang->message->date              = '時間';
$lang->message->secret            = '僅管理員可見';
$lang->message->readed            = '已讀';
$lang->message->captcha           = '驗證碼';
$lang->message->list              = '留言列表';
$lang->message->post              = '發表留言';
$lang->message->viewArticle       = '正文';
$lang->message->viewComment       = '留言';
$lang->message->noSelectedMessage = '您沒有選擇任何留言。';
$lang->message->needCheck         = '留言通過審核後顯示。';
$lang->message->showDetail        = '顯示全部';
$lang->message->hideDetail        = '收起';

$lang->message->admin          = '後台首頁';
$lang->message->pass           = '通過';
$lang->message->reply          = '回覆';
$lang->message->view           = '查看';
$lang->message->manage         = '留言管理';
$lang->message->delete         = '刪除';
$lang->message->deleteSelected = '刪除選中項';
$lang->message->passPre        = '通過之前';
$lang->message->deletePre      = '刪除之前';
$lang->message->commentAt      = '發表於 ';
$lang->message->deletedObject  = '已刪除項目';
$lang->message->contactHidden  = "以下電話、郵箱、qq聯繫方式只有網站管理員可見，不會暴露。";

$lang->message->confirmDeleteSingle = '您確定要刪除該留言嗎？';
$lang->message->confirmDeletePre    = '您確定要刪除之前的留言嗎？';
$lang->message->confirmPassSingle   = '您確定要通過該留言嗎？';
$lang->message->confirmPassPre      = '您確定要通過之前的留言嗎？';

$lang->message->statusList[0] = '未審核';
$lang->message->statusList[1] = '已審核';

$lang->message->readedStatus[0] = '未讀';
$lang->message->readedStatus[1] = '已讀';

$lang->comment = new stdclass();
$lang->comment->common       = '評論';
$lang->comment->id           = '編號';
$lang->comment->type         = '類型';
$lang->comment->from         = '稱呼';
$lang->comment->content      = '內容';
$lang->comment->phone        = '電話';
$lang->comment->qq           = 'QQ';
$lang->comment->email        = '郵箱';
$lang->comment->captcha      = '驗證碼';
$lang->comment->list         = '評論列表';
$lang->comment->post         = '發表評論';
$lang->comment->viewArticle  = '正文';
$lang->comment->viewComment  = '評論';
$lang->comment->needCheck    = '評論通過審核後顯示。';
$lang->comment->receiveEmail = '接收郵件提醒';

$lang->comment->pass          = '通過';
$lang->comment->reply         = '回覆';
$lang->comment->replyAt       = '回覆于';
$lang->comment->manage        = '評論管理';
$lang->comment->delete        = '刪除';
$lang->comment->passPre       = '通過之前';
$lang->comment->deletePre     = '刪除之前';
$lang->comment->commentTo     = '發表於';
$lang->comment->commentAt     = '發表於';
$lang->comment->deletedObject = '已刪除項目';

$lang->comment->confirmDeleteSingle = '您確定要刪除該評論嗎？';
$lang->comment->confirmDeletePre    = '您確定要刪除之前的評論嗎？';
$lang->comment->confirmPassSingle   = '您確定要通過該評論嗎？';
$lang->comment->confirmPassPre      = '您確定要通過之前的評論嗎？';

$lang->comment->statusList[0] = '未審核';
$lang->comment->statusList[1] = '已審核';

$lang->message->replyItem   = "<dd><strong>%s</strong> 于 <em>%s</em> 回覆：%s</dd>";
$lang->comment->replyItem   = "<dd><strong>%s</strong> 于 <em>%s</em> 回覆：%s</dd>";
$lang->message->messageItem = "<dd><strong>%s</strong> 于 <em>%s</em> 發表：%s</dd>";

$lang->message->replySubject = '%s管理員的回覆';
