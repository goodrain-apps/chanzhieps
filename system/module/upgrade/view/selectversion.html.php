<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of select version method of upgrade module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id$
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<form method='post' action='<?php echo inlink('confirm');?>'>
<div class='container'>
  <div class='modal-dialog'>
    <div class='modal-header'>
      <h3><?php echo $lang->upgrade->selectVersion;?></h3>
    </div>
    <div class='modal-body'>
      <div class='form-group'>
        <?php 
          echo html::select('fromVersion', $lang->upgrade->fromVersions, $version, "class='form-control single-input'");
          echo "&nbsp;&nbsp;<span class='text-danger help-inline'>{$lang->upgrade->versionNote}</span>";
        ?>
      </div>
    </div>
    <div class='modal-footer'>
      <?php echo html::submitButton($lang->upgrade->common);?>
    </div>
  </div>
</div>
</form>
<?php include '../../install/view/footer.html.php';?>
