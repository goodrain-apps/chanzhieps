<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='panel panel-body'>
  <div class='panel panel-pure' id='reset'>
    <div class='panel-heading'><strong><?php echo $lang->user->changePassword;?></strong></div>
    <div class='panel-body'>
      <form method='post' id='ajaxForm'>
        <div class='form-group row'>
          <label class='col-sm-3 control-label'><?php echo $lang->user->password;?></label>
          <div class='col-sm-9'><?php echo html::password('password1', '', "class='form-control'")?></div>
        </div>
        <div class='form-group row'>
          <label class='col-sm-3 control-label'><?php echo $lang->user->password2;?></label>
          <div class='col-sm-9'><?php echo html::password('password2', '', "class='form-control'")?></div>
        </div>
        <?php echo html::submitButton($lang->user->submit,'btn btn-primary btn-block') . html::hidden('reset', $reset);?></td>
      </form>
    </div>
  </div>
</div>  
<?php include TPL_ROOT . 'common/footer.html.php';?>
