<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The file module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     file
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->file->common        = '附件';
$lang->file->upload        = '上傳附件';
$lang->file->browse        = '附件列表';
$lang->file->imageList     = '圖片列表';
$lang->file->download      = '下載附件';
$lang->file->edit          = '編輯';
$lang->file->primary       = '封面';
$lang->file->name          = '名稱';
$lang->file->setPrimary    = '設為封面';
$lang->file->cancelPrimary = '取消封面';
$lang->file->deny          = '禁止';
$lang->file->allow         = '允許';
$lang->file->toggle        = '切換';
$lang->file->label         = '標題：';
$lang->file->lblInfo       = '<i>(類型：%s, 大小：%s, 添加于：%s，下載%s次)</i>';
$lang->file->limit         = "(<span class='text-danger'>%sM以內</span>)";
$lang->file->source        = '素材';
$lang->file->sourceList    = '素材列表';
$lang->file->uploadSource  = '上傳素材';
$lang->file->sourceURI     = '地址';
$lang->file->sourceDelete  = '刪除素材';
$lang->file->sourceEdit    = '編輯素材';
$lang->file->selectImage   = '選擇素材';

$lang->file->id        = '編號';
$lang->file->title     = '名稱';
$lang->file->pathname  = '存儲路徑';
$lang->file->extension = '類型';
$lang->file->size      = '大小';
$lang->file->addedBy   = '上傳者';
$lang->file->addedDate = '上傳日期';
$lang->file->public    = '匿名下載';
$lang->file->downloads = '下載次數';
$lang->file->score     = '所需積分';
$lang->file->setScore  = '設置積分';
$lang->file->lblInfo   = '您現在共有積分：<strong class="red">%s</strong>';
$lang->file->confirm   = '下載此插件需要您 %s 積分';

$lang->file->publics[0] = '需要登錄';
$lang->file->publics[1] = '允許';

$lang->file->sort        = '排序';
$lang->file->edit        = '編輯';
$lang->file->editFile    = '更改附件';
$lang->file->fileManager = '檔案管理';

$lang->file->viewType[0] = '圖片';
$lang->file->viewType[1] = '列表';

$lang->file->errorUnwritable  = '上傳目錄不可寫，無法上傳附件。';
$lang->file->noAccess         = '不允許訪問。';
$lang->file->invalidParameter = '參數無效。';
$lang->file->unWritable       = '目錄不可寫或不存在。';
$lang->file->uploadForbidden  = '附件上傳功能已禁用。';
$lang->file->sizeLimit        = "<p class='text-danger'>附件大小不能大於%sM</p>";
$lang->file->sameName         = "已存在同名檔案，如果繼續將覆蓋原檔案。";
$lang->file->nameEmpty        = "檔案名不能為空";
$lang->file->copySuccess      = "已複製到剪貼板";
$lang->file->evilChar         = "包含非法字元";
