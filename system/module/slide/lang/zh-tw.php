<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The slide category zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->slide->common     = '幻燈片';
$lang->slide->group      = '幻燈片分組';
$lang->slide->title      = '標題';
$lang->slide->groupName  = '分組名稱';
$lang->slide->titleColor = '標題顏色';
$lang->slide->image      = '圖片';
$lang->slide->mainLink   = '連結';
$lang->slide->summary    = '摘要';
$lang->slide->label      = '按鈕文字';
$lang->slide->button     = '按鈕';
$lang->slide->newWindow  = '新開窗口';
$lang->slide->upload     = '上傳';

$lang->slide->background = new stdclass();

$lang->slide->background->type  = '背景';
$lang->slide->background->image = '背景圖片';
$lang->slide->background->color = '背景顏色';

$lang->slide->background->typeList = new stdclass();

$lang->slide->background->typeList->image = '圖片';
$lang->slide->background->typeList->color = '顏色';

$lang->slide->height      = '高度';
$lang->slide->url         = '連結';
$lang->slide->buttonUrl   = '按鈕連結';
$lang->slide->buttonColor = '顏色';
$lang->slide->sourceImage = '素材庫圖片';

$lang->slide->sort        = '排序';
$lang->slide->admin       = '幻燈片設置';
$lang->slide->browse      = '瀏覽幻燈片';
$lang->slide->create      = '添加幻燈片';
$lang->slide->edit        = '編輯幻燈片';
$lang->slide->createGroup = '添加分組';
$lang->slide->editGroup   = '編輯分組';
$lang->slide->removeGroup = '刪除分組';
$lang->slide->return      = '返回分組';
$lang->slide->rename      = '重命名';
$lang->slide->removeGroup = '刪除分組';

$lang->slide->successSort     = '排序成功保存';
$lang->slide->noImageSelected = '沒有選擇圖片';
$lang->slide->suitableSize    = '背景圖片大小保持一致。';
$lang->slide->noChange        = '未做更改';
$lang->slide->groupNotEmpty   = '名稱不能為空';

$lang->slide->defaultGroup = '預設分組';

/* Targets setting. */
$lang->slide->target = new stdclass();
$lang->slide->target->_blank = '新開窗口';
