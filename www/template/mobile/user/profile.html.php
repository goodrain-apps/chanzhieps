<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The profile view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::import($this->config->webRoot . 'js/fingerprint/fingerprint.js');?>
<?php include TPL_ROOT . 'user/side.html.php';?>
<table class="table table-layout">
  <tbody>
    <tr>
      <td colspan='2'><strong><i class='icon icon-user'></i> <?php echo $lang->user->profile?></strong></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->realname;?></th>
      <td>
        <?php echo $user->realname;?>
        <?php if(isset($user->provider) and isset($user->openID) and strpos($user->account, "{$user->provider}_") === false):?>
        <span class='bg-info-pale text-info'><?php echo $lang->user->oauth->typeList[$user->provider];?></span>
        <?php endif;?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->user->email;?></th>
      <td><?php if(!empty($user->email)) echo $user->email;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->company;?></th>
      <td><?php echo $user->company;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->address;?></th>
      <td><?php echo $user->address;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->zipcode;?></th>
      <td><?php echo $user->zipcode;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->mobile;?></th>
      <td><?php echo $user->mobile;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->phone;?></th>
      <td><?php echo $user->phone;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->qq;?></th>
      <td><?php echo $user->qq;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->gtalk;?></th>
      <td><?php echo $user->gtalk;?></td>
    </tr>
    <tr>
      <td colspan='2'>
        <?php echo html::a(inlink('edit'), "<i class='icon-pencil'></i> " . $lang->user->editProfile, "class='btn block primary' data-toggle='modal'");?>
        <?php echo html::a(inlink('setemail'), "<i class='icon-pencil'></i> " . $lang->user->setEmail, "class='btn block primary' data-toggle='modal'");?>
        <?php if(isset($user->provider) and isset($user->openID)):?>
        <?php if(strpos($user->account, "{$user->provider}_") === false):?>
        <?php echo html::a(inlink('oauthUnbind', "account=$user->account&provider=$user->provider&openID=$user->openID"), "<i class='icon-unlink'></i> " . $lang->user->oauth->lblUnbind, "class='btn block primary ajaxaction jsoner'");?>
        <?php else:?>
        <br>
        <?php echo html::a(inlink('oauthRegister'), "<i class='icon-link'></i> " . $lang->user->oauth->lblProfile, "class='btn block primary'");?>
        <?php echo html::a(inlink('oauthBind'), "<i class='icon-link'></i> " . $lang->user->oauth->lblBind, "class='btn block primary'");?>
        <?php endif;?>
        <?php endif;?>
      </td>
    </tr>
  </tbody>
</table>

<?php include TPL_ROOT . 'common/form.html.php';?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
