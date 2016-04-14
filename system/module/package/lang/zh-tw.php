<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The package module zh-tw file of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->package->common        = '插件';
$lang->package->browse        = '瀏覽插件';
$lang->package->install       = '安裝';
$lang->package->installAuto   = '自動安裝';
$lang->package->installForce  = '強制安裝';
$lang->package->uninstall     = '卸載';
$lang->package->activate      = '激活';
$lang->package->deactivate    = '禁用';
$lang->package->obtain        = '獲得插件';
$lang->package->view          = '詳情';
$lang->package->download      = '下載插件';
$lang->package->downloadAB    = '下載';
$lang->package->upload        = '本地安裝';
$lang->package->erase         = '清除';
$lang->package->upgrade       = '升級';
$lang->package->agreeLicense  = '我同意該授權';
$lang->package->settemplate   = '設置模板';

$lang->package->structure   = '目錄結構';
$lang->package->installed   = '已安裝';
$lang->package->deactivated = '被禁用';
$lang->package->available   = '已下載';

$lang->package->id          = '編號';
$lang->package->name        = '名稱';
$lang->package->code        = '插件代號';
$lang->package->version     = '版本';
$lang->package->compatible  = '適用版本';
$lang->package->latest      = '<small>最新版本<strong><a href="%s" target="_blank" class="package">%s</a></strong>，兼容蟬知<a href="http://api.chanzhi.org/goto.php?item=latest" target="_blank" class="alert-link"><strong>%s</strong></a></small>';
$lang->package->author      = '作者';
$lang->package->license     = '授權';
$lang->package->intro       = '詳情';
$lang->package->abstract    = '簡介';
$lang->package->site        = '官網';
$lang->package->addedTime   = '添加時間';
$lang->package->updatedTime = '更新時間';
$lang->package->downloads   = '下載量';
$lang->package->public      = '下載方式';
$lang->package->compatible  = '兼容性';
$lang->package->grade       = '評分';
$lang->package->depends     = '依賴';

$lang->package->publicList[0] = '手工下載';
$lang->package->publicList[1] = '直接下載';

$lang->package->compatibleList[0] = '未知';
$lang->package->compatibleList[1] = '兼容';

$lang->package->byDownloads   = '最多下載';
$lang->package->byAddedTime   = '最新添加';
$lang->package->byUpdatedTime = '最近更新';
$lang->package->bySearch      = '搜索';
$lang->package->byCategory    = '分類瀏覽';
$lang->package->byIndustry    = '行業分組';
$lang->package->byColor       = '主題色調';

$lang->package->installFailed            = '%s失敗，錯誤原因如下:';
$lang->package->uninstallFailed          = '卸載失敗，錯誤原因如下:';
$lang->package->confirmUninstall         = '卸載插件會刪除或修改相關的資料庫，是否繼續卸載？';
$lang->package->noticeBackupDB           = '卸載前，建議備份資料庫。';
$lang->package->installFinished          = '恭喜您，插件順利的%s成功！';
$lang->package->refreshPage              = '刷新頁面';
$lang->package->uninstallFinished        = '插件已經成功卸載';
$lang->package->deactivateFinished       = '插件已經成功禁用';
$lang->package->activateFinished         = '插件已經成功激活';
$lang->package->eraseFinished            = '插件已經成功清除';
$lang->package->unremovedFiles           = '有一些檔案或目錄未能刪除，需要手工刪除';
$lang->package->executeCommands          = '<h3>執行下面的命令來修正這些問題：</h3>';
$lang->package->successDownloadedPackage = '成功下載插件';
$lang->package->successUploadedPackage   = '成功上傳插件';
$lang->package->successCopiedFiles       = '成功拷貝檔案';
$lang->package->successInstallDB         = '成功安裝資料庫';
$lang->package->viewInstalled            = '查看已安裝插件';
$lang->package->viewAvailable            = '查看可安裝插件';
$lang->package->viewDeactivated          = '查看已禁用插件';
$lang->package->backDBFile               = '插件相關數據已經備份到 %s 檔案中！';

$lang->package->upgradeExt     = '升級';
$lang->package->installExt     = '安裝';
$lang->package->upgradeVersion = '（從%s升級到%s）';

$lang->package->types = new stdclass();
$lang->package->types->theme     = '主題';
$lang->package->types->extension = '插件';
$lang->package->types->ext       = '插件';

$lang->package->waring = '警告';

$lang->package->errorOccurs                  = '錯誤：';
$lang->package->errorGetModules              = '從www.chanzhi.org獲得插件分類失敗。可能是因為網絡方面的原因，請檢查後重新刷新頁面。';
$lang->package->errorGetPackages             = '從www.chanzhi.org獲得插件失敗。可能是因為網絡方面的原因，您可以到 <a href="http://www.chanzhi.org/extemsion" target="_blank" class="alert-link">www.chanzhi.org</a> 手工下載插件，然後上傳安裝。';
$lang->package->errorDownloadPathNotFound    = '插件下載存儲路徑<strong>%s</strong>不存在。<br />linux下面請執行命令：<strong>mkdir -p %s</strong>來修正。';
$lang->package->errorDownloadPathNotWritable = '插件下載存儲路徑<strong>%s</strong>不可寫。<br />linux下面請執行命令：<strong>sudo chmod 777 %s</strong>來修正。';
$lang->package->errorPackageFileExists       = '下載路徑已經有一個名為的<strong>%s</strong>附件。<a href="%s" class="btn btn-primary loadInModal">重新%s</a>';
$lang->package->errorDownloadFailed          = '下載失敗，請重新下載。如果多次重試還不行，請嘗試手工下載，然後通過上傳功能上傳。';
$lang->package->errorMd5Checking             = '下載檔案不完整，請重新下載。如果多次重試還不行，請嘗試手工下載，然後通過上傳功能上傳。';
$lang->package->errorExtracted               = '包檔案<strong> %s </strong>解壓縮失敗，可能不是一個有效的zip檔案。錯誤信息如下：<br />%s';
$lang->package->errorCheckIncompatible       = '該插件與蟬知版本不兼容，%s後可能無法使用。。<h3>您可以選擇 <a href="%s" class="loadInModal">強制%s</a> 或者 <a href="#" onclick=parent.location.href="%s">取消</a></h3>';
$lang->package->errorFileConflicted          = '有以下檔案衝突：<br />%s <h3>您可以選擇 <a href="%s">覆蓋</a> 或者 <a href="#" onclick=parent.location.href="%s">取消</a></h3>';
$lang->package->errorPackageNotFound         = '包檔案 <strong>%s </strong>沒有找到，可能是因為自動下載失敗。您可以嘗試再次下載。';
$lang->package->errorTargetPathNotWritable   = '目標路徑 <strong>%s </strong>不可寫。';
$lang->package->errorTargetPathNotExists     = '目標路徑 <strong>%s </strong>不存在。';
$lang->package->errorInstallDB               = '執行資料庫語句失敗。錯誤信息如下：%s';
$lang->package->errorConflicts               = '與插件“%s”衝突！';
$lang->package->errorDepends                 = '以下依賴插件沒有安裝或版本不正確：<br /><br /> %s';
$lang->package->errorIncompatible            = '該插件與您的蟬知版本不兼容';
$lang->package->errorUninstallDepends        = '插件“%s”依賴該插件，不能卸載';

/* Add theme items.*/
$lang->theme = new stdclass();
$lang->theme->common = '主題市場';
