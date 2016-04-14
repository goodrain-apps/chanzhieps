<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='panel-section'>
  <div class='panel-heading'><strong><?php echo $lang->user->oauth->lblProfile;?></strong></div>
  <div class='panel-body'>
    <form method='post' class='ajaxform'>
      <div class='form-group'>
        <label class='control-label' for='username'><?php echo $lang->user->account;?></label>
        <?php echo html::input('account', '', "class='form-control' placeholder='{$lang->user->register->lblAccount}'");?>
      </div>
      <div class='form-group'>
        <label class='control-label' for='realname'><?php echo $lang->user->realname;?></label>
        <?php echo html::input('realname', '', "class='form-control'");?>
      </div>
      <div class='form-group'>
        <label class='control-label' for='email'><?php echo $lang->user->email;?></label>
        <?php echo html::input('email', '', "class='form-control'");?>
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'><?php echo $lang->user->password;?></label>
        <?php echo html::password('password1', '', "class='form-control'");?>
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'><?php echo $lang->user->password2;?></label>
        <?php echo html::password('password2', '', "class='form-control'");?>
      </div>
      <div class='form-group'>
        <?php echo html::submitButton('', 'btn block success') . html::hidden('referer', $referer);?>
      </div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
