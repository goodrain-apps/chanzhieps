<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::set('confirmUnbind', $lang->user->confirmUnbind);?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-user'></i> <?php echo $lang->user->profile;?></strong></div>
        <div class='panel-body'>
          <dl class='dl-horizontal'>
            <dt><?php echo $lang->user->realname;?></dt>
            <dd>
              <?php echo $user->realname;?>
              <?php if(isset($user->provider) and isset($user->openID) and strpos($user->account, "{$user->provider}_") === false):?>
              <span class='label label-info'><?php echo $lang->user->oauth->typeList[$user->provider];?></span>
              <?php endif;?>
            </dd>
            <dt><?php echo $lang->user->email;?></dt>
            <dd><?php echo $user->email;?></dd>
            <dt><?php echo $lang->user->company;?></dt>
            <dd><?php echo $user->company;?></dd>
            <dt><?php echo $lang->user->address;?></dt>
            <dd><?php echo $user->address;?></dd>
            <dt><?php echo $lang->user->zipcode;?></dt>
            <dd><?php echo $user->zipcode;?></dd>
            <dt><?php echo $lang->user->mobile;?></dt>
            <dd><?php echo $user->mobile;?></dd>
            <dt><?php echo $lang->user->phone;?></dt>
            <dd><?php echo $user->phone;?></dd>
            <dt><?php echo $lang->user->qq;?></dt>
            <dd><?php echo $user->qq;?></dd>
            <dt><?php echo $lang->user->gtalk;?></dt>
            <dd><?php echo $user->gtalk;?></dd>
            <dt></dt>
            <dd>
              <div class='btn-group'>
                <?php echo html::a(inlink('edit'), $lang->user->editProfile, "class='btn'");?>
                <?php echo html::a(inlink('setemail'), $lang->user->setEmail, "class='btn'");?>
                <?php if(isset($user->provider) and isset($user->openID)):?>
                <?php if(strpos($user->account, "{$user->provider}_") === false):?>
                <?php echo html::a(inlink('oauthUnbind', "account=$user->account&provider=$user->provider&openID=$user->openID"), $lang->user->oauth->lblUnbind, "class='btn unbind'");?>
                <?php else:?>
                <?php echo html::a(inlink('oauthRegister'), $lang->user->oauth->lblProfile, "class='btn'");?>
                <?php echo html::a(inlink('oauthBind'), $lang->user->oauth->lblBind, "class='btn'");?>
                <?php endif;?>
                <?php endif;?>
              </div>
            </dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
