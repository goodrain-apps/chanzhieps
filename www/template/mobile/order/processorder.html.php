<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The processorder view file of order for mobile template of chanzhiEPS.
 * The file should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>
<style>
.alert > .icon, .alert > .icon + .content {padding: 10px 15px;}
.alert > .icon {display: block; text-align: center; font-size: 48px; float: none; line-height: 1; padding-bottom: 0; opacity: .7}
.alert-deny {max-width: 500px; margin: 8% auto; padding: 0; background-color: #FFF; border: 1px solid #ccc; box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.2); border-radius: 0; padding: 10px 0;}
.btn-link {border-color: none!important}
.alert-deny .actions {margin-top: 10px;}
.alert-deny h2 {margin: 0 0 20px}
body {background-color: #f1f1f1}
</style>
<div class='container w-200px'>
  <div class='alert alert-deny'>
    <i class='icon-ok-sign icon text-success'></i>
    <div class='content'>
      <h2 class='text-center'><?php echo $lang->order->paidSuccess;?></h2>
      <div class='actions text-center'>
        <?php echo html::a(inlink('browse'), $lang->order->bought, "class='btn primary block'");?>
      </div>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
</body>
</html>
