<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<hr class='space'>
<div class='panel-section' id='checkEmail'>
  <div class='panel-heading'><strong><?php echo $lang->user->checkEmail;?></strong></div>
  <div class='panel-body'>
    <form method='post' class='ajaxform' action='<?php echo inlink('checkEmail');?>'>
      <div class='form-group hide form-message alert text-danger bg-danger-pale'>
        <i class='icon icon-info-sign icon-s1'></i>
        <div class='content'></div>
      </div>
      <div class='form-group'>
        <label class='control-label' for='email'><?php echo $lang->user->email;?></label>
        <?php echo html::input('email', $user->email, "class='form-control'");?>
      </div>
      <div class='form-group'>
        <?php echo html::a($this->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn default ajaxaction'");?></td>
      </div>
      <div class='form-group'>
        <label class='control-label' for='captcha'><?php echo $lang->user->captcha;?></label>
        <?php echo html::input('captcha', '', "class='form-control'");?>
      </div>
      <div class='form-group'><?php echo html::submitButton('', 'btn primary block');?><?php echo html::hidden('referer', $referer);?></div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php';?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
