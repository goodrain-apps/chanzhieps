<?php if(!defined("RUN_MODE")) die();?>
<?php
include TPL_ROOT . 'common/header.html.php';
js::import($jsRoot . 'md5.js');
js::import($jsRoot . 'fingerprint/fingerprint.js');
js::set('random', $this->session->random);
?>
<div class='panel panel-body' id='login'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/oauthlogin.html.php';?>
      <div class='panel panel-pure'>
        <div class='panel-heading'><strong><?php echo $lang->user->login->welcome;?></strong></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' role='form' data-checkfingerprint='1'>
            <div class='form-group hiding'><div id='formError' class='alert alert-danger'></div></div>
            <div class='form-group'><?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='form-control input-lg'");?></div>
            <div class='form-group'><?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='form-control input-lg'");?></div>
            <?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn-wider btn-lg');?> &nbsp; &nbsp; 
            <?php echo html::a(inlink('register'), $lang->user->register->common);?> &nbsp; &nbsp; 
            <?php if($config->mail->turnon and $this->config->site->resetPassword == 'open') echo html::a(inlink('resetpassword'), $lang->user->recoverPassword);?>
            <?php echo html::hidden('referer', $referer);?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
