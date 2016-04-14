<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The processorder view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>
<div class='container' id='payResult'>
  <div class='modal-dialog w-450px'>
  <div class='modal-body'><div class='alert alert-success text-center'><h4><i class="text-success icon-ok-sign"></i> <?php echo $lang->order->paidSuccess;?></h4></div></div>
  <div class='modal-footer'><?php echo html::a(inlink('browse'), $lang->order->bought, "class='btn btn-success'");?></div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<?php include TPL_ROOT . 'common/log.html.php';?>
</body>
</html>
