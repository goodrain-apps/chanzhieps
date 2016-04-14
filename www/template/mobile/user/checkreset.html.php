<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<hr class='space'>
<div class='panel-section'>
  <div class='panel-heading'><strong><?php echo $lang->user->changePassword;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='ajaxform'>
      <div class='form-group'>
        <label class='control-label'><?php echo $lang->user->password;?></label>
        <?php echo html::password('password1', '', "class='form-control'")?>
      </div>
      <div class='form-group'>
        <label class='control-label'><?php echo $lang->user->password2;?></label>
        <?php echo html::password('password2', '', "class='form-control'")?>
      </div>
      <?php echo html::submitButton($lang->user->submit,'btn primary block') . html::hidden('reset', $reset);?></td>
    </form>
  </div>
</div>  
<?php include TPL_ROOT . 'common/footer.html.php';?>
