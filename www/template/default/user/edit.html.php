<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<div class="page-user-control">
  <div class="row">
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->user->editProfile;?></strong></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' class='form form-horizontal' data-checkfingerprint='1'>
            <div class='form-group'>
              <label for='realname' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->realname;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php if($user->admin == 'super'):?>
                <?php if(count(explode(',', $this->config->site->lang)) > 1):?>
                <div class='input-group'>
                  <?php if(strpos($this->config->site->lang, 'zh-cn') !== false):?>
                  <label class='input-group-addon'><?php echo $config->langs['zh-cn']?></label>
                  <?php echo html::input("realnames[cn]", isset($user->realnames->cn) ? $user->realnames->cn : '', "class='form-control'");?>
                  <?php endif;?>
                  <?php if(strpos($this->config->site->lang, 'zh-tw') !== false):?>
                  <label class='input-group-addon'><?php echo $config->langs['zh-tw'];?></label>
                  <?php echo html::input("realnames[tw]", isset($user->realnames->tw) ? $user->realnames->tw : '', "class='form-control'");?>
                  <?php endif;?>
                  <?php if(strpos($this->config->site->lang, 'en') !== false):?>
                  <label class='input-group-addon'><?php echo $config->langs['en']?></label>
                  <?php echo html::input("realnames[en]", isset($user->realnames->en) ? $user->realnames->en : '', "class='form-control'");?>
                  <?php endif;?>
                </div>
                <?php else:?>
                <?php $clientLang = $this->config->site->defaultLang;?>
                <?php $clientLang = strpos($clientLang, 'zh-') !== false ? str_replace('zh-', '', $clientLang) : $clientLang;?>
                <?php echo html::input("realnames[{$clientLang}]", $user->realname, "class='form-control'")?>
                <?php endif;?>
                <?php else:?>
                <?php echo html::input('realname', $user->realname, "class='form-control'")?>
                <?php endif;?>
              </div>
            </div>
            <div class='form-group'>
              <label for='oldPwd' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->oldPwd;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::password('oldPwd', '', "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='password' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->password;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::password('password1', '', "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='password2' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->password2;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::password('password2', '', "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='company' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->company;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('company', $user->company, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='address' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->address;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('address', $user->address, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='zipcode' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->zipcode;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('zipcode', $user->zipcode, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='mobile' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->mobile;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('mobile', $user->mobile, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='phone' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->phone;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('phone', $user->phone, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='qq' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->qq;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('qq', $user->qq, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <label for='gtalk' class='col-md-2 col-sm-3 control-label'><?php echo $lang->user->gtalk;?></label>
              <div class='col-md-6 col-sm-6'>
                <?php echo html::input('gtalk', $user->gtalk, "class='form-control'");?>
              </div>
            </div>
            <div class='form-group'>
              <div class='col-md-6 col-sm-6 col-md-offset-2 col-sm-offset-3'><?php echo html::submitButton() . html::hidden('token', $token);?></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
