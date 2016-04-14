<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The register view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'common/header.html.php';
?>
<hr class='space'>
<div class='panel-section'>
  <?php include TPL_ROOT . 'user/oauthlogin.html.php';?>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $lang->user->register->welcome;?></strong></div>
  </div>
  <div class='panel-body'>
  <form class="ajaxform" method='post' id='regForm' role='form' data-checkfingerprint='1'>
    <div class='form-group hide form-message alert text-danger bg-danger-pale'>
      <i class='icon icon-info-sign icon-s1'></i>
      <div class='content'></div>
    </div>
    <div class='form-group'>
      <label class='control-label' for='account'><?php echo $lang->user->account;?></label>
      <?php echo html::input('account', '', "class='form-control form-control' autocomplete='off' placeholder='" . $lang->user->register->lblAccount . "'");?>
    </div>
    <div class='form-group'>
      <label class='control-label' for='realname'><?php echo $lang->user->realname;?></label>
      <?php echo html::input('realname', '', "class='form-control'");?>
    </div>
    <div class='form-group'>
      <label class='control-label' for='email'><?php echo $lang->user->email;?></label>
      <?php echo html::input('email', '', "class='form-control' autocomplete='off'") . '';?>
    </div>
    <div class='form-group'>
      <label class='control-label' for='password1'><?php echo $lang->user->password;?></label>
      <?php echo html::password('password1', '', "class='form-control' autocomplate='off' placeholder='" . $lang->user->register->lblPassword . "'");?>
    </div>
    <div class='form-group'>
      <label class='control-label' for='password2'><?php echo $lang->user->password2;?></label>
      <?php echo html::password('password2', '', "class='form-control'");?>
    </div>
    <div class='form-group'>
      <label class='control-label' for='company'><?php echo $lang->user->company;?></label>
      <?php echo html::input('company', '', "class='form-control'");?>
    </div>
    <div class='form-group'>
      <label class='control-label' for='phone'><?php echo $lang->user->phone;?></label>
      <?php echo html::input('phone', '', "class='form-control'");?>
    </div>
    <div class='form-group'><?php echo html::submitButton($lang->register, 'btn primary block');?><?php echo html::hidden('referer', $referer);?></div>
  </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
