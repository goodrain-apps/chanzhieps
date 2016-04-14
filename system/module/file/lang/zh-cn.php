<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The file module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     file
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->file->common        = '附件';
$lang->file->upload        = '上传附件';
$lang->file->browse        = '附件列表';
$lang->file->imageList     = '图片列表';
$lang->file->download      = '下载附件';
$lang->file->edit          = '编辑';
$lang->file->primary       = '封面';
$lang->file->name          = '名称';
$lang->file->setPrimary    = '设为封面';
$lang->file->cancelPrimary = '取消封面';
$lang->file->deny          = '禁止';
$lang->file->allow         = '允许';
$lang->file->toggle        = '切换';
$lang->file->label         = '标题：';
$lang->file->lblInfo       = '<i>(类型：%s, 大小：%s, 添加于：%s，下载%s次)</i>';
$lang->file->limit         = "(<span class='text-danger'>%sM以内</span>)";
$lang->file->source        = '素材';
$lang->file->sourceList    = '素材列表';
$lang->file->uploadSource  = '上传素材';
$lang->file->sourceURI     = '地址';
$lang->file->sourceDelete  = '删除素材';
$lang->file->sourceEdit    = '编辑素材';
$lang->file->selectImage   = '选择素材';

$lang->file->id        = '编号';
$lang->file->title     = '名称';
$lang->file->pathname  = '存储路径';
$lang->file->extension = '类型';
$lang->file->size      = '大小';
$lang->file->addedBy   = '上传者';
$lang->file->addedDate = '上传日期';
$lang->file->public    = '匿名下载';
$lang->file->downloads = '下载次数';
$lang->file->score     = '所需积分';
$lang->file->setScore  = '设置积分';
$lang->file->lblInfo   = '您现在共有积分：<strong class="red">%s</strong>';
$lang->file->confirm   = '下载此插件需要您 %s 积分';

$lang->file->publics[0] = '需要登录';
$lang->file->publics[1] = '允许';

$lang->file->sort        = '排序';
$lang->file->edit        = '编辑';
$lang->file->editFile    = '更改附件';
$lang->file->fileManager = '文件管理';

$lang->file->viewType[0] = '图片';
$lang->file->viewType[1] = '列表';

$lang->file->errorUnwritable  = '上传目录不可写，无法上传附件。';
$lang->file->noAccess         = '不允许访问。';
$lang->file->invalidParameter = '参数无效。';
$lang->file->unWritable       = '目录不可写或不存在。';
$lang->file->uploadForbidden  = '附件上传功能已禁用。';
$lang->file->sizeLimit        = "<p class='text-danger'>附件大小不能大于%sM</p>";
$lang->file->sameName         = "已存在同名文件，如果继续将覆盖原文件。";
$lang->file->nameEmpty        = "文件名不能为空";
$lang->file->copySuccess      = "已复制到剪贴板";
$lang->file->evilChar         = "包含非法字符";
