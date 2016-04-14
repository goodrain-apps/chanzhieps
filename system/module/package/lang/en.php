<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The package module en file of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->package->common        = 'Package';
$lang->package->browse        = 'Browse';
$lang->package->install       = 'Install';
$lang->package->installAuto   = 'AutoInstall';
$lang->package->installForce  = 'ForceInstall';
$lang->package->uninstall     = 'Uninstall';
$lang->package->activate      = 'Activate';
$lang->package->deactivate    = 'Deactivate';
$lang->package->obtain        = 'Obtain';
$lang->package->view          = 'Info';
$lang->package->download      = 'Download';
$lang->package->downloadAB    = 'Down';
$lang->package->upload        = 'Upload and Install';
$lang->package->erase         = 'Erase';
$lang->package->upgrade       = 'Upgrade Package';
$lang->package->agreeLicense  = 'I agree the license';
$lang->package->settemplate   = 'Set template';
$lang->package->buy           = 'Buy';

$lang->package->structure   = 'Structure';
$lang->package->installed   = 'Installed';
$lang->package->deactivated = 'Deactivated';
$lang->package->available   = 'Downloaded';

$lang->package->id          = 'ID';
$lang->package->name        = 'Name';
$lang->package->code        = 'Code';
$lang->package->version     = 'Version';
$lang->package->compatible  = 'Compatible';
$lang->package->latest      = '<small>Latest:<strong><a href="%s" target="_blank" class="package">%s</a></strong>，need zentao <a href="http://api.chanzhi.org/goto.php?item=latest" target="_blank"><strong>%s</strong></small>';
$lang->package->author      = 'Author';
$lang->package->license     = 'License';
$lang->package->intro       = 'Description';
$lang->package->abstract    = 'Abstract';
$lang->package->site        = 'Site';
$lang->package->addedTime   = 'Added Time';
$lang->package->updatedTime = 'Updated Time';
$lang->package->downloads   = 'Downloads';
$lang->package->public      = 'Public';
$lang->package->compatible  = 'Compatible';
$lang->package->grade       = 'Grade';
$lang->package->depends     = 'Depends';

$lang->package->publicList[0] = 'Manually';
$lang->package->publicList[1] = 'Auto';

$lang->package->compatibleList[0] = 'Unknow';
$lang->package->compatibleList[1] = 'Compatible';

$lang->package->byDownloads   = 'Downloads';
$lang->package->byAddedTime   = 'New added';
$lang->package->byUpdatedTime = 'Last updated';
$lang->package->bySearch      = 'Search';
$lang->package->byCategory    = 'By Category';
$lang->package->byIndustry    = 'By Industry';
$lang->package->byColor       = 'By color';

$lang->package->installFailed            = '%s failed, the reason is:';
$lang->package->uninstallFailed          = 'Uninstall failed, the reason is:';
$lang->package->confirmUninstall         = 'Uninstall will delete or modify database, whether to uninstall?';
$lang->package->noticeBackupDB           = 'Before uninstalling, we recommend backing up the database.';
$lang->package->installFinished          = 'Good, the package has been %s successfully.';
$lang->package->refreshPage              = 'Refresh';
$lang->package->uninstallFinished        = 'Package has been successfully uninstalled.';
$lang->package->deactivateFinished       = 'Package has been successfully deactivated.';
$lang->package->activateFinished         = 'Package has been successfully activated.';
$lang->package->eraseFinished            = 'Package has been successfully erased.';
$lang->package->unremovedFiles           = 'There are some unremoved files, you need remove them manually';
$lang->package->executeCommands          = '<h3>Execute the following commands to fix them:</h3>';
$lang->package->successDownloadedPackage = 'Successfully downloaded the package file.';
$lang->package->successUploadedPackage   = 'Successfully uploaded the package file.';
$lang->package->successCopiedFiles       = 'Successfully copied files. ';
$lang->package->successInstallDB         = 'Successfully installed database.';
$lang->package->viewInstalled            = 'View installed packages.';
$lang->package->viewAvailable            = 'View available packages';
$lang->package->viewDeactivated          = 'View deactivated packages';
$lang->package->backDBFile               = 'Plug-related data has been backed up to %s file!';

$lang->package->upgradeExt     = 'Upgrade';
$lang->package->installExt     = 'Install';
$lang->package->upgradeVersion = '(Upgrade from %s to %s)';

$lang->package->types = new stdclass();
$lang->package->types->theme     = 'Theme';
$lang->package->types->extension = 'Extension';
$lang->package->types->ext       = 'Extension';

$lang->package->waring = 'Waring';

$lang->package->errorOccurs                  = 'Error:';
$lang->package->errorGetModules              = "Get packages' categories data from the www.chanzhi.org failed. ";
$lang->package->errorGetPackages             = 'Get packages from www.chanzhi.org failed. You can visit <a href="http://www.chanzhi.org/extension/" target="_blank">www.chanzhi.org</a> to find your packages, download it manually and then upload to zentaopms to install it.';
$lang->package->errorDownloadPathNotFound    = 'The save path of package file <strong>%s</strong>does not exists.<br />For linux users, can execute <strong>mkdir -p %s</strong> to fix it.';
$lang->package->errorDownloadPathNotWritable = 'The save path of package file <strong>%s</strong>is not writable.<br />For linux users, can execute <strong>sudo chmod 777 %s</strong> to fix it.';
$lang->package->errorPackageFileExists       = 'There is already a file with the same name <strong>%s</strong>.<h3> If you want to %s again, <a href="%s">please click this link</a>.</h3>';
$lang->package->errorDownloadFailed          = 'Download failed, please try again. Or you can download it manually and upload it to install.';
$lang->package->errorMd5Checking             = 'The downloawd files checking failed, Please download it manually and upload it to install';
$lang->package->errorExtracted               = 'The package file <strong> %s </strong> extracted failed. The error is:<br />%s';
$lang->package->errorCheckIncompatible       = 'This extenion is not compatible with current zentao version. <h3>You can <a href="%s">Force %s</a> or <a href="#" onclick=parent.location.href="%s">Cancel</a></h3>.';
$lang->package->errorFileConflicted          = 'There are some files conflicted: <br />%s <h3>You can <a href="%s">Overide them</a> or <a href="#" onclick=parent.location.href="%s">Cancel</a></h3>.';
$lang->package->errorPackageNotFound         = 'The package file <strong>%s </strong> not found, perhaps download failed, try again.';
$lang->package->errorTargetPathNotWritable   = 'Target path <strong>%s </strong>not writable.';
$lang->package->errorTargetPathNotExists     = 'Target path <strong>%s </strong>not exists';
$lang->package->errorInstallDB               = 'Execute database sql failed, the error is: %s';
$lang->package->errorConflicts               = 'With plug-in "%s" Conflict!';
$lang->package->errorDepends                 = 'The following dependency plugin is not installed or the version is incorrect:<br /><br /> %s';
$lang->package->errorIncompatible            = 'The plug-in with your ZenTao incompatible version';
$lang->package->errorUninstallDepends        = 'Plugin "%s" relying on the plug-in, can not uninstall';

/* Add theme items.*/
$lang->theme->common = 'Theme Store';
