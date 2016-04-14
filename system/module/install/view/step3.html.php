<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of step3 method of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author	  Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	 chanzhiEPS
 * @version	 $Id: step3.html.php 824 2010-05-02 15:32:06Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog'>
    <?php if(isset($error)):?>
    <div class='modal-header'><strong><?php echo $lang->install->error;?></strong></div>
    <div class='modal-body'><div class='alert alert-danger'><?php echo $error;?></div></div>
    <div class='modal-footer'><?php echo html::backButton($lang->install->pre, 'btn btn-primary');?></div>
    <?php else: ?>
    <div class='modal-header'><strong><?php echo $lang->install->saveConfig;?></strong></div>
    <div class='modal-body'>
      <div class='form-group'><?php echo html::textArea('config', $result->content, "rows='10' class='form-control small'");?></div>
      <div class='alert alert-default'><?php printf($lang->install->save2File, $result->myPHP);?></div>
    </div>
    <div class='modal-footer'><?php echo html::a(inlink('step4'), $lang->install->next, "class='btn btn-primary'");?></div>
    <?php endif;?>
  </div>
</div>
<?php include './footer.html.php';?>
