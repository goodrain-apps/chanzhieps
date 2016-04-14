<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of step4 method of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author	    Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	    chanzhiEPS
 * @version	    $Id: step4.html.php 867 2010-06-17 09:32:58Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog w-450px'>
    <form method='post' class='form-horizontal'>
      <?php if(isset($error)):?>
      <div class='modal-header'><strong><?php echo $lang->install->error;?></strong></div>
      <div class='modal-body'>
        <div class='alert alert-danger'><?php echo $error;?></div>
      </div>
      <div class='modal-footer'><?php echo html::backButton($lang->install->pre, 'btn btn-primary');?></div>
      <?php else: ?>
      <div class='modal-header'><strong><i class='icon-key'></i> <?php echo $lang->install->setAdmin;?></strong></div>
      <div class='modal-body'>
        <div class='form-group'>
          <label for='account' class='col-xs-2 control-label'><?php echo $lang->install->account;?></label>
          <div class='col-xs-8'><?php echo html::input('account', '', "class='form-control'");?></div>
        </div>
        <div class='form-group'>
          <label for='password' class='col-xs-2 control-label'><?php echo $lang->install->password;?></label>
          <div class='col-xs-8'><?php echo html::input('password', '', "class='form-control'");?></div>
        </div>
        <div class='form-group'>
          <label class='col-xs-2'></label>
          <div class='col-xs-8'><?php echo html::checkBox('importDemoData', $lang->install->importDemoData);?></div>
        </div>
      </div>
      <div class='modal-footer'><?php echo html::submitButton();?></div>
      <?php endif; ?>
    </form>
  </div>
</div>
<?php include './footer.html.php';?>
