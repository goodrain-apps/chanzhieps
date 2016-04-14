<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <div class='col-md-6'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <strong><?php echo $lang->user->oauth->lblProfile;?></strong>
      </div>
      <div class='panel-body'>
        <form method='post' id='registerForm' class='form-horizontal' action='<?php echo $this->createLink('user', 'oauthRegister');?>' role='form'>
          <div class='form-group'>
            <label class='col-sm-2 control-label' for='username'><?php echo $lang->user->account;?></label>
            <div class='col-sm-9 required'><?php echo html::input('account', '', "class='form-control' placeholder='{$lang->user->register->lblAccount}'");?></div>
          </div>
          <div class='form-group'>
            <label class='col-sm-2 control-label' for='realname'><?php echo $lang->user->realname;?></label>
            <div class='col-sm-9 required'><?php echo html::input('realname', $realname, "class='form-control'");?></div>
          </div>
          <div class='form-group'>
            <label class='col-sm-2 control-label' for='email'><?php echo $lang->user->email;?></label>
            <div class='col-sm-9 required'><?php echo html::input('email', '', "class='form-control'");?></div>
          </div>
          <div class='form-group'>
            <label class='col-sm-2 control-label' for='password'><?php echo $lang->user->password;?></label>
            <div class='col-sm-9 required'><?php echo html::password('password1', '', "class='form-control'");?></div>
          </div>
          <div class='form-group'>
            <label class='col-sm-2 control-label' for='password'><?php echo $lang->user->password2;?></label>
            <div class='col-sm-9 required'><?php echo html::password('password2', '', "class='form-control'");?></div>
          </div>
          <div class='form-group'>
            <label class='col-sm-2 control-label'></label>
            <div class='col-sm-9'>
              <?php echo html::submitButton('', 'btn btn-success') . html::a(inlink('ignoreBind'), $lang->user->oauth->ignore, "class='btn btn-primary'"). html::hidden('referer', $referer);?>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class='col-md-6'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <strong><?php echo $lang->user->oauth->lblBind;?></strong>
      </div>
      <div class='panel-body'>
        <form method='post' id='bindForm' class='form-horizontal' action='<?php echo $this->createLink('user', 'oauthBind');?>' role='form'>
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
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
