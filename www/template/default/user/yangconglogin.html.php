<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT  . 'common/header.html.php';?>
<div class="page-container">
  <div class='row'>
    <div class='col-md-6'>
      <div class='panel panel-default'>
        <div class='panel-heading'><h3><?php echo $lang->user->oauth->lblProfile;?></h3></div>
        <div class='panel-body'>
          <form method='post' id='registerForm' action='<?php echo $this->createLink('user', 'oauthregister');?>' role='form'>
            <div class='form-group'>
              <label for='username'><?php echo $lang->user->account;?></label>
              <?php echo html::input('account', '', "placeholder='{$lang->user->register->lblAccount}' class='form-control w-200px'");?>
            </div>
            <div class='form-group'>
              <label for='email'><?php echo $lang->user->email;?></label>
              <?php echo html::input('email', '', "class='form-control w-200px'");?>
            </div>
            <?php 
            echo html::submitButton('', 'btn btn-success btn-wider');
            echo html::hidden('referer', $referer);
            ?>
          </form>
        </div>
      </div>
    </div>
    <div class='col-md-6'>
      <div class='panel panel-default'>
        <div class='panel-heading'><h3><?php echo $lang->user->oauth->lblBind;?></h3></div>
        <div class='panel-body'>
          <form method='post' id='bindForm' action='<?php echo $this->createLink('user', 'oauthbind');?>' role='form'>
            <div class='form-group'>
              <label for='useraccount'><?php echo $lang->user->account;?></label>
              <?php echo html::input('account', '', "class='form-control w-200px'")?>
            </div>
            <div class='form-group'>
              <label for='password'><?php echo $lang->user->password;?></label>
              <?php echo html::password('password', '', "class='form-control w-200px'");?>
            </div>
            <?php 
            echo html::submitButton($lang->login, 'btn btn-success btn-wider');
            echo html::hidden('referer', $referer);
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT  . 'common/footer.html.php';?>
