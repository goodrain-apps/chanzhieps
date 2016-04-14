<?php if(!defined("RUN_MODE")) die();?>
<?php
include TPL_ROOT . 'common/header.html.php';
?>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $lang->user->oauth->lblBind;?></strong></div>
  </div>
  <div class='panel-body'>
    <form method='post' class='ajaxform' role='form'>
      <div class='form-group'>
        <label class='control-label' for='useraccount'><?php echo $lang->user->account;?></label>
        <?php echo html::input('account', '', "class='form-control'");?>
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'><?php echo $lang->user->password;?></label>
        <?php echo html::password('password', '', "class='form-control'");?>
      </div>
      <div class='form-group'>
        <?php echo html::submitButton($lang->login, 'btn primary block') . html::hidden('referer', $referer);?>
      </div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
