<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of index method of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id: index.html.php 867 2010-06-17 09:32:58Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog'>
    <div class="modal-header text-right"><div class='btn dropdown'><?php include '../../common/view/selectlang.html.php';?></div></div>
    <div class='modal-body'>
      <h3><?php echo $lang->install->welcome;?></h3>
      <div><?php echo $lang->install->desc;?></div>
    </div>
    <div class='modal-footer'>
      <div class='input-group'>
      <?php echo html::a($this->createLink('install', 'step0'), $lang->install->start, "class='btn btn-primary btn-install'");?>
      </div>
    </div>
  </div>
</div>
<?php include './footer.html.php';?>
