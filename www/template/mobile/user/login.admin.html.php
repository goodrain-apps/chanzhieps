<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin login view file of user for mobile template of chanzhiEPS.
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
include TPL_ROOT . 'common/header.lite.html.php';
?>
<style>
.table-row {display: table; width: 100%}
.table-cell {padding: 20px; display: table-cell;}
.alert-login {max-width: 500px; margin: 8% auto; padding: 0; background-color: #FFF; border: 1px solid #ccc; box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.2); border-radius: 0; padding: 0 0 10px 0;}
.btn-link {border-color: none!important}
.alert-login .actions {margin-top: 10px;}
.alert-login h2 {margin: 0; padding: 20px; font-size: 16px;}
body {background-color: #f1f1f1}
</style>
<div class='container'>
  <div class='alert alert-login'>
    <h2 class='bg-gray-pale'><?php echo $this->config->site->name;?></h2>
    <div class='table-row'>
      <div class='img text-center table-cell'><?php echo html::image($this->config->webRoot . 'theme/default/default/images/main/logo.login.admin.png'); ?></div>
      <div class='content table-cell'>
        <form method='post' id='loginForm' role='form' data-checkfingerprint='1'>
          <div class='form-group hide form-message alert text-danger bg-danger-pale'>
            <i class='icon icon-info-sign icon-s1'></i>
            <div class='content'></div>
          </div>
          <div class='form-group'><?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='form-control'");?></div>
          <div class='form-group'><?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='form-control'");?></div>
          <div class='form-group'><?php echo html::submitButton($lang->user->login->common, 'btn primary block');?></div>
          <div class='form-group'>
            <?php if($config->mail->turnon) echo html::a(inlink('resetpassword'), $lang->user->recoverPassword, "class='btn btn-link'") . ' ';?>
            <?php echo html::hidden('referer', $referer);?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
</body>
</html>
