<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<?php if($pass):?>
<form method='post' action='<?php echo inlink('setpassword');?>' id='passwordForm' class='form' data-checkfingerprint='1'>
  <table class='table table-form borderless'>
    <tr>
      <th class="w-100px"><?php echo $lang->user->account;?></th>
      <td><?php echo $this->app->user->account;?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password;?></th>
      <td><?php echo html::password('password', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->newPassword;?></th>
      <td><?php echo html::password('password1', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password2;?></th>
      <td><?php echo html::password('password2', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr><td></td><td><?php echo html::submitButton() . html::hidden('token', $token);?></td></tr>
  </table>
</form>
<?php else:?>
<?php
$url = helper::safe64Encode($this->createLink('user', 'setpassword'));
include '../../guarder/view/validate.html.php';
?>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
