<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><?php echo $lang->user->oauth->lblBind;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-horizontal center-block w-p50' role='form'>
      <div class='form-group'>
        <label class='col-sm-2 control-label' for='useraccount'><?php echo $lang->user->account;?></label>
        <div class='col-sm-9'><?php echo html::input('account', '', "class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label' for='password'><?php echo $lang->user->password;?></label>
        <div class='col-sm-9'><?php echo html::password('password', '', "class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label'></label>
        <div class='col-sm-9'><?php echo html::submitButton($lang->login, 'btn btn-success') . html::hidden('referer', $referer);?></div>
      </div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
