<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The thread module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->thread->common    = '主題';

$lang->thread->id          = '編號';
$lang->thread->title       = '標題';
$lang->thread->board       = '板塊';
$lang->thread->author      = '作者';
$lang->thread->content     = '內容';
$lang->thread->file        = '附件: ';
$lang->thread->postedDate  = '發表於';
$lang->thread->replies     = '回帖';
$lang->thread->views       = '閲讀';
$lang->thread->lastReply   = '最後回帖';
$lang->thread->isLink      = '跳轉';
$lang->thread->link        = '連結';

$lang->thread->post           = '發帖';
$lang->thread->postTo         = '發佈帖子到';
$lang->thread->browse         = '主題列表';
$lang->thread->stick          = '置頂';
$lang->thread->edit           = '編輯主題';
$lang->thread->status         = '狀態';
$lang->thread->approve        = '通過';
$lang->thread->display        = '顯示';
$lang->thread->hide           = '隱藏';
$lang->thread->show           = '顯示';
$lang->thread->transfer       = '轉移';
$lang->thread->switchStatus   = '隱藏/顯示';
$lang->thread->deleteFile     = '刪除附件';

$lang->thread->sticks[0] = '不置頂';
$lang->thread->sticks[1] = '版塊置頂';
$lang->thread->sticks[2] = '全局置頂';

$lang->thread->displayList['hidden'] = '已隱藏';
$lang->thread->displayList['normal'] = '正常';

$lang->thread->statusList['wait']     = '未審核';
$lang->thread->statusList['approved'] = '通過';

$lang->thread->confirmDeleteThread = "您確定刪除該主題嗎？";
$lang->thread->confirmHideReply    = "您確定隱藏回帖嗎？";
$lang->thread->confirmHideThread   = "您確定隱藏該主題嗎？";
$lang->thread->confirmDeleteReply  = "您確定刪除該回帖嗎？";
$lang->thread->confirmDeleteFile   = "您確定刪除該附件嗎？";

$lang->thread->lblEdited       = '%s 最後編輯, %s';
$lang->thread->message         = '%s在論壇#%s回覆了主題：%s，內容為：%s';
$lang->thread->readonly        = '只讀';
$lang->thread->successStick    = '成功置頂';
$lang->thread->successUnstick  = '成功取消置頂';
$lang->thread->successHide     = '帖子已經成功隱藏';
$lang->thread->successShow     = '顯示成功';
$lang->thread->readonlyMessage = '該帖已被設置為 <strong>只讀</strong>，您暫時無法發表新的回覆。';
$lang->thread->successTransfer = '轉移成功';
$lang->thread->thanks          = '帖子將在審核通過後顯示';

$lang->thread->score    = '獎勵積分';
$lang->thread->scoreSum = "<i class='text-warning icon icon-plus'><b>%s</b></i> ";
$lang->thread->scores[5]  = '+ 5';
$lang->thread->scores[10] = '+ 10';
$lang->thread->scores[50] = '+ 50';
$lang->thread->scores[100]= '+ 100';

$lang->thread->placeholder = new stdclass();
$lang->thread->placeholder->link = '輸入連結，可以是站外連接';

/* Adjust the pager. */
if(!isset($lang->pager->settedInForum))
{
    $lang->pager->noRecord = '';
    $lang->pager->digest   = str_replace('記錄', '回帖', $lang->pager->digest);
}
