<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<form method='post' action='<?php echo inlink('setsecurity');?>' id='questionForm' class='form' data-checkfingerprint='1'>
  <table class='table table-form borderless'>
    <tr>
      <th class='w-100px'><?php echo $lang->user->password;?></th>
      <td>
        <?php echo html::password('oldPwd', '', "class='form-control' placeholder='{$lang->user->placeholder->password}'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->user->question;?></th>
      <td><?php echo html::input('question','', "class='form-control'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->answer;?></th>
      <td><?php echo html::input('answer', '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th></th><td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
