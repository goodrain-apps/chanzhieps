<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The deny view file of user for mobile template of chanzhiEPS.
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
.alert > .icon, .alert > .icon + .content {padding: 10px 15px;}
.alert > .icon {display: block; text-align: center; font-size: 48px; float: none; line-height: 1; padding-bottom: 0; opacity: .7}
.alert-deny {max-width: 500px; margin: 8% auto; padding: 0; background-color: #FFF; border: 1px solid #ccc; box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.2); border-radius: 0; padding: 10px 0;}
.btn-link {border-color: none!important}
.alert-deny .actions {margin-top: 10px;}
.alert-deny h2 {margin: 0 0 20px}
body {background-color: #f1f1f1}
</style>
<div class='container'>
  <div class='alert alert-deny'>
    <i class='icon-frown icon'></i>
    <div class='content'>
      <h2 class='text-center'><?php echo $app->user->account, ' ', $lang->user->deny;?></h2>
      <p><?php printf($lang->user->errorDeny, $moduleName, $methodName);?></p>
      <hr>
      <div class='actions'>
        <?php
        if($refererBeforeDeny) echo html::a(helper::safe64Decode($refererBeforeDeny), $lang->user->goback, "class='btn primary'");
         echo html::a($this->createLink($config->default->module), $lang->index->common, "class='btn default'");
         echo html::a($this->createLink('user', 'logout', "referer=" . helper::safe64Encode($denyPage)), $lang->user->relogin, "class='btn btn-link'");
        ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
