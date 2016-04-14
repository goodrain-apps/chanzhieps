<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The uninstall view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if(isset($confirm) and $confirm == 'no'):?>
<div class='alert alert-warning'>
  <i class='icon-info-sign'></i>
  <div class='content'>
  <?php
    echo "<p class='waring'>{$lang->package->confirmUninstall}";
    echo html::a(inlink('uninstall', "package=$code&confirm=yes"), $lang->package->uninstall, "class='btn loadInModal'");
    echo "</p>";
    echo "<p>{$lang->package->noticeBackupDB}</p>"
  ?>
  </div>
</div>
<?php elseif(!empty($error)):?>
<div class='alert alert-danger'>
  <i class='icon-info-sign'></i>
  <div class='content'>
  <?php
    echo "<h3 class='error'>" . $lang->package->uninstallFailed . "</h3>"; 
    echo "<p>$error</p>";
  ?>
  </div>
</div>
<?php else:?>
<div class='alert alert-success'>
  <i class='icon-ok-sign'></i>
  <div class='content'>
    <?php
    echo "<h3>{$title}</h3>";
    if(!empty($backupFile)) echo '<p>' . sprintf($lang->package->backDBFile, $backupFile) . '</p>';
    if($removeCommands)
    {
        echo "<p class='strong'>{$lang->package->unremovedFiles}</p>";
        echo join($removeCommands, '<br />');
    }
    echo "<p class='text-center'>" . html::a(inlink('browse', 'type=available'), $lang->package->viewAvailable, "class='btn'") . '</p>';
    ?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
