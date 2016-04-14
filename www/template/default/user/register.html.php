<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<div class='panel panel-body' id='reg'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/oauthlogin.html.php';?>
      <div class='panel panel-pure'>
        <div class='panel-heading'><strong><?php echo $lang->user->register->welcome;?></strong></h4></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' class='form-horizontal' role='form' data-checkfingerprint='1'>
            <div class='form-group'>
              <label class='col-sm-3 control-label'><?php echo $lang->user->account;?></label>
              <div class='col-sm-9'><?php echo html::input('account', '', "class='form-control form-control' autocomplete='off' placeholder='" . $lang->user->register->lblAccount . "'");?></div>
            </div>
            <div class='form-group'>
              <label class="col-sm-3 control-label"><?php echo $lang->user->realname;?></label>
              <div class='col-sm-9'><?php echo html::input('realname', '', "class='form-control'");?></div>
            </div>
            <div class='form-group'>
              <label class="col-sm-3 control-label"><?php echo $lang->user->email;?></label>
              <div class='col-sm-9'><?php echo html::input('email', '', "class='form-control' autocomplete='off'") . '';?></div>
            </div>
            <div class='form-group'>
              <label class="col-sm-3 control-label"><?php echo $lang->user->password;?></label>
              <div class='col-sm-9'><?php echo html::password('password1', '', "class='form-control' autocomplate='off' placeholder='" . $lang->user->register->lblPassword . "'");?></div>
            </div>
            <div class='form-group'>
              <label class="col-sm-3 control-label"><?php echo $lang->user->password2;?></label>
              <div class='col-sm-9'><?php echo html::password('password2', '', "class='form-control'");?></div>
            </div>
            <div class='form-group'>
              <label class="col-sm-3 control-label"><?php echo $lang->user->company;?></label>
              <div class='col-sm-9'><?php echo html::input('company', '', "class='form-control'");?></div>
            </div>
            <div class='form-group'>
              <label class="col-sm-3 control-label"><?php echo $lang->user->phone;?></label>
              <div class='col-sm-9'><?php echo html::input('phone', '', "class='form-control'");?></div>
            </div>
            <div class='form-group'>
              <div class="col-sm-3"></div>
              <div class='col-sm-9'><?php echo html::submitButton($lang->register,'btn btn-primary btn-block') . html::hidden('referer', $referer);?></div>
            </div>
          </form>
        </div>
      </div>    
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
