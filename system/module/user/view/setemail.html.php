<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<form method='post' action='<?php echo inlink('setEmail');?>' id='emailForm' class='form' data-checkfingerprint='1'>
  <table class='table table-form borderless'>
    <tr>
      <th class='w-100px'><?php echo $lang->user->password;?></th>
      <td colspan='2'>
        <?php echo html::password('oldPwd', '', "class='form-control' placeholder='{$lang->user->placeholder->password}'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->user->newEmail;?></th>
      <td colspan='2'>
        <?php echo html::input('email', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->user->captcha;?></th>
      <td><?php echo html::input('captcha', '', "class='form-control' placeholder='{$lang->user->placeholder->verifyCode}'");?></td>
      <td><?php echo html::a($this->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn btn-sm btn-primary'");?></td>
    <tr>
      <th></th><td colspan='2'><?php echo html::submitButton() . html::hidden('token', $token);?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
