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
$lang->forum->common      = '论坛';
$lang->forum->board       = '版块';
$lang->forum->owners      = '版主';
$lang->forum->threadList  = '主题列表';
$lang->forum->threadCount = '主题数';
$lang->forum->postCount   = '帖子数';
$lang->forum->lastPost    = '最后发表';
$lang->forum->readonly    = '只读版块。';
$lang->forum->notExist    = '版块不存在。';
$lang->forum->lblOwner    = " [ 版主：%s ]";

$lang->forum->post    = '发帖';
$lang->forum->admin   = '论坛维护';
$lang->forum->update  = '更新数据';
$lang->forum->setting = '论坛设置';
$lang->forum->postReview = '发帖审核';

$lang->forum->updateDesc    = '该更新操作会重新计算每个版块的发帖数据。';
$lang->forum->successUpdate = '更新数据成功';

/* Adjust the pager. */
$lang->pager->noRecord      = '';
$lang->pager->digest        = str_replace('记录', '主题', $lang->pager->digest);
$lang->pager->settedInForum = true;    // Set this switch thus in thread module can avoid overiding them.

$lang->forum->postReviewOptions        = new stdclass(); 
$lang->forum->postReviewOptions->open  = '开启';
$lang->forum->postReviewOptions->close = '关闭';
