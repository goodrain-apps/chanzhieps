<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The package module zh-cn file of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->package->common        = '插件';
$lang->package->browse        = '浏览插件';
$lang->package->install       = '安装';
$lang->package->installAuto   = '自动安装';
$lang->package->installForce  = '强制安装';
$lang->package->uninstall     = '卸载';
$lang->package->activate      = '激活';
$lang->package->deactivate    = '禁用';
$lang->package->obtain        = '获得插件';
$lang->package->view          = '详情';
$lang->package->download      = '下载插件';
$lang->package->downloadAB    = '下载';
$lang->package->upload        = '本地安装';
$lang->package->erase         = '清除';
$lang->package->upgrade       = '升级';
$lang->package->agreeLicense  = '我同意该授权';
$lang->package->settemplate   = '设置模板';
$lang->package->buy           = '购买';

$lang->package->structure   = '目录结构';
$lang->package->installed   = '已安装';
$lang->package->deactivated = '被禁用';
$lang->package->available   = '已下载';

$lang->package->id          = '编号';
$lang->package->name        = '名称';
$lang->package->code        = '插件代号';
$lang->package->version     = '版本';
$lang->package->compatible  = '适用版本';
$lang->package->latest      = '<small>最新版本<strong><a href="%s" target="_blank" class="package">%s</a></strong>，兼容蝉知<a href="http://api.chanzhi.org/goto.php?item=latest" target="_blank" class="alert-link"><strong>%s</strong></a></small>';
$lang->package->author      = '作者';
$lang->package->license     = '授权';
$lang->package->intro       = '详情';
$lang->package->abstract    = '简介';
$lang->package->site        = '官网';
$lang->package->addedTime   = '添加时间';
$lang->package->updatedTime = '更新时间';
$lang->package->downloads   = '下载量';
$lang->package->public      = '下载方式';
$lang->package->compatible  = '兼容性';
$lang->package->grade       = '评分';
$lang->package->depends     = '依赖';

$lang->package->publicList[0] = '手工下载';
$lang->package->publicList[1] = '直接下载';

$lang->package->compatibleList[0] = '未知';
$lang->package->compatibleList[1] = '兼容';

$lang->package->byDownloads   = '最多下载';
$lang->package->byAddedTime   = '最新添加';
$lang->package->byUpdatedTime = '最近更新';
$lang->package->bySearch      = '搜索';
$lang->package->byCategory    = '分类浏览';
$lang->package->byIndustry    = '行业分组';
$lang->package->byColor       = '主题色调';

$lang->package->installFailed            = '%s失败，错误原因如下:';
$lang->package->uninstallFailed          = '卸载失败，错误原因如下:';
$lang->package->confirmUninstall         = '卸载插件会删除或修改相关的数据库，是否继续卸载？';
$lang->package->noticeBackupDB           = '卸载前，建议备份数据库。';
$lang->package->installFinished          = '恭喜您，插件顺利的%s成功！';
$lang->package->refreshPage              = '刷新页面';
$lang->package->uninstallFinished        = '插件已经成功卸载';
$lang->package->deactivateFinished       = '插件已经成功禁用';
$lang->package->activateFinished         = '插件已经成功激活';
$lang->package->eraseFinished            = '插件已经成功清除';
$lang->package->unremovedFiles           = '有一些文件或目录未能删除，需要手工删除';
$lang->package->executeCommands          = '<h3>执行下面的命令来修正这些问题：</h3>';
$lang->package->successDownloadedPackage = '成功下载插件';
$lang->package->successUploadedPackage   = '成功上传插件';
$lang->package->successCopiedFiles       = '成功拷贝文件';
$lang->package->successInstallDB         = '成功安装数据库';
$lang->package->viewInstalled            = '查看已安装插件';
$lang->package->viewAvailable            = '查看可安装插件';
$lang->package->viewDeactivated          = '查看已禁用插件';
$lang->package->backDBFile               = '插件相关数据已经备份到 %s 文件中！';

$lang->package->upgradeExt     = '升级';
$lang->package->installExt     = '安装';
$lang->package->upgradeVersion = '（从%s升级到%s）';

$lang->package->types = new stdclass();
$lang->package->types->theme     = '主题';
$lang->package->types->extension = '插件';
$lang->package->types->ext       = '插件';

$lang->package->waring = '警告';

$lang->package->errorOccurs                  = '错误：';
$lang->package->errorGetModules              = '从www.chanzhi.org获得插件分类失败。可能是因为网络方面的原因，请检查后重新刷新页面。';
$lang->package->errorGetPackages             = '从www.chanzhi.org获得插件失败。可能是因为网络方面的原因，您可以到 <a href="http://www.chanzhi.org/extemsion" target="_blank" class="alert-link">www.chanzhi.org</a> 手工下载插件，然后上传安装。';
$lang->package->errorDownloadPathNotFound    = '插件下载存储路径<strong>%s</strong>不存在。<br />linux下面请执行命令：<strong>mkdir -p %s</strong>来修正。';
$lang->package->errorDownloadPathNotWritable = '插件下载存储路径<strong>%s</strong>不可写。<br />linux下面请执行命令：<strong>sudo chmod 777 %s</strong>来修正。';
$lang->package->errorPackageFileExists       = '下载路径已经有一个名为的<strong>%s</strong>附件。<a href="%s" class="btn btn-primary loadInModal">重新%s</a>';
$lang->package->errorDownloadFailed          = '下载失败，请重新下载。如果多次重试还不行，请尝试手工下载，然后通过上传功能上传。';
$lang->package->errorMd5Checking             = '下载文件不完整，请重新下载。如果多次重试还不行，请尝试手工下载，然后通过上传功能上传。';
$lang->package->errorExtracted               = '包文件<strong> %s </strong>解压缩失败，可能不是一个有效的zip文件。错误信息如下：<br />%s';
$lang->package->errorCheckIncompatible       = '该插件与蝉知版本不兼容，%s后可能无法使用。。<h3>您可以选择 <a href="%s" class="loadInModal">强制%s</a> 或者 <a href="#" onclick=parent.location.href="%s">取消</a></h3>';
$lang->package->errorFileConflicted          = '有以下文件冲突：<br />%s <h3>您可以选择 <a href="%s">覆盖</a> 或者 <a href="#" onclick=parent.location.href="%s">取消</a></h3>';
$lang->package->errorPackageNotFound         = '包文件 <strong>%s </strong>没有找到，可能是因为自动下载失败。您可以尝试再次下载。';
$lang->package->errorTargetPathNotWritable   = '目标路径 <strong>%s </strong>不可写。';
$lang->package->errorTargetPathNotExists     = '目标路径 <strong>%s </strong>不存在。';
$lang->package->errorInstallDB               = '执行数据库语句失败。错误信息如下：%s';
$lang->package->errorConflicts               = '与插件“%s”冲突！';
$lang->package->errorDepends                 = '以下依赖插件没有安装或版本不正确：<br /><br /> %s';
$lang->package->errorIncompatible            = '该插件与您的蝉知版本不兼容';
$lang->package->errorUninstallDepends        = '插件“%s”依赖该插件，不能卸载';

/* Add theme items.*/
$lang->theme->common = '主题市场';
