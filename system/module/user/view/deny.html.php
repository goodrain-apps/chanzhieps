<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of deny method of user module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id: deny.html.php 824 2010-05-02 15:32:06Z wwccss $
 */
$moduleName = isset($lang->$module->common)  ? $lang->$module->common:  $module;
$methodName = isset($lang->$module->$method) ? $lang->$module->$method: $method;
include '../../common/view/header.lite.html.php';
?>
<script>
$(function()
{
    var $icon = $('.alert-deny > .icon');
    $('.alert-deny').on('mouseenter', '.actions .btn', function()
    {
        $icon.removeClass('icon-frown').addClass('icon-smile');
    }).on('mouseleave', '.actions .btn', function()
    {
       $icon.removeClass('icon-smile').addClass('icon-frown');
    });
});
</script>
<style>
.alert.with-icon > .icon, .alert.with-icon > .icon + .content {padding: 10px 20px 20px;}
.alert.with-icon > .icon {padding-left: 35px;}
.alert-deny {max-width: 500px; margin: 8% auto; padding: 0; background-color: #FFF; border: 1px solid #DDD; box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.2); border-radius: 6px;}
.btn-link {border-color: none!important}
</style>
<div class='container w-200px'>
  <div class='alert with-icon alert-deny'>
    <i class='icon-frown icon'></i>
    <div class='content'>
      <h2><?php echo $app->user->account, ' ', $lang->user->deny;?></h2>
      <p><?php printf($lang->user->errorDeny, $moduleName, $methodName);?></p>
      <div class='actions'>
        <?php
        if($refererBeforeDeny) echo html::a(helper::safe64Decode($refererBeforeDeny), $lang->user->goback, "class='btn btn-primary'");
         echo html::a($this->createLink($config->default->module), $lang->index->common, "class='btn'");
         echo html::a($this->createLink('user', 'logout', "referer=" . helper::safe64Encode($denyPage)), $lang->user->relogin, "class='btn btn-link'");
        ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
