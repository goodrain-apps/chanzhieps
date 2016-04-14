<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<div class="page-user-control">
  <div class="row">
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->user->setEmail;?></strong></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' class='form form-horizontal' data-checkfingerprint='1'>
            <div class='form-group'>
              <label for='oldPwd' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->password;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::password('oldPwd', '', "class='form-control' placeholder='{$lang->user->placeholder->password}'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='email' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->newEmail;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('email', '', "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='captcha' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->captcha;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('captcha', '', "class='form-control' placeholder='{$lang->user->placeholder->verifyCode}'");?>
              </div>
                <?php echo html::a($this->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn btn-sm btn-primary'");?>
            </div>
            <div class='form-group'>
              <div class='col-md-6 col-sm-6 col-md-offset-2 col-sm-offset-3'><?php echo html::submitButton() . html::hidden('token', $token);?></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
