<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The activate view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if(isset($error) and $error):?>
<div class='alert alert-danger'>
  <i class='icon-info-sign'></i>
  <div class='content'><?php $error;?></div>
</div>
<?php else:?>
<div class='alert alert-success'>
  <i class='icon-ok-sign'></i>
  <div class='content'>
    <h3><?php echo $title;?></h3>
    <p class='text-center'><?php echo html::a(inlink('browse', 'type=installed'), $lang->package->viewInstalled, "class='btn'");?></p>
    <?php echo js::execute("parent.$('.clearfix').load(window.parent.location.href + ' .clearfix')");?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
