<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('setpassword');?>' id='passwordForm' class='form'>
  <table class='table table-form borderless'>
    <tr>
      <th class="col-xs-4"><?php echo $lang->user->account;?></th>
      <td class="col-xs-6"><?php echo $this->app->user->account;?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->newPassword;?></th>
      <td><?php echo html::password('password1', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password2;?></th>
      <td><?php echo html::password('password2', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include TPL_ROOT . 'common/footer.modal.html.php';?>
