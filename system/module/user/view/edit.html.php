<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.html.php';?>
<div class="page-user-control">
  <div class="row">
    <?php include './side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->user->editProfile;?></strong></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' class='form form-horizontal'>
            <div class='form-group'>
              <label for='realname' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->realname;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('realname', $user->realname, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='email' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->email;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('email', $user->email, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='password' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->password;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::password('password1', '', "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='password2' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->password2;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::password('password2', '', "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='company' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->company;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('company', $user->company, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='address' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->address;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('address', $user->address, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='zipcode' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->zipcode;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('zipcode', $user->zipcode, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='mobile' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->mobile;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('mobile', $user->mobile, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='phone' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->phone;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('phone', $user->phone, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='qq' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->qq;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('qq', $user->qq, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='gtalk' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->gtalk;?></label>
              <div class='col-md-4 col-sm-6'>
                <?php echo html::input('gtalk', $user->gtalk, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <div class='col-md-4 col-sm-6 col-md-offset-2 col-sm-offset-3'><?php echo html::submitButton();?></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
