<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of step4 method of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author	  Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	  chanzhiEPS
 * @version	  $Id: step4.html.php 867 2010-06-17 09:32:58Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog w-450px'>
    <div class='modal-body'><div class='alert alert-success text-center'><h4><?php echo $lang->install->success;?></h4></div></div>
    <div class='modal-footer'><?php echo html::linkButton($lang->install->visitAdmin, 'admin.php', 'btn btn-success');?></div>
  </div>
</div>
<?php include './footer.html.php';?>
