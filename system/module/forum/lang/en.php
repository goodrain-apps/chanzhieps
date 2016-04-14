<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The forum module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->forum->common      = 'Forum';
$lang->forum->board       = 'Board';
$lang->forum->owners      = 'Moderator';
$lang->forum->threadList  = 'Threads';
$lang->forum->threadCount = 'Threads';
$lang->forum->postCount   = 'Posts';
$lang->forum->lastPost    = 'Last post';
$lang->forum->readonly    = 'Readonly';
$lang->forum->notExist    = 'The board does not exist.';
$lang->forum->lblOwner    = " [ Moderator: %s ]";

$lang->forum->post       = 'Post';
$lang->forum->admin      = 'Admin';
$lang->forum->update     = 'Update';
$lang->forum->setting    = 'Setting';
$lang->forum->postReview = 'Post Review';

$lang->forum->updateDesc    = 'This action will re-compute the stats(threads, replies) of every board again.';
$lang->forum->successUpdate = 'Update sucessfully';

/* Adjust the pager. */
$lang->pager->noRecord      = '';
$lang->pager->digest        = str_replace('records', 'threads', $lang->pager->digest);
$lang->pager->settedInForum = true;    // Set this switch thus in thread module can avoid overiding them.

$lang->forum->postReviewOptions        = new stdclass(); 
$lang->forum->postReviewOptions->open  = 'Open';
$lang->forum->postReviewOptions->close = 'Close';
