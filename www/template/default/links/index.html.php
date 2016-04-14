<?php if(!defined("RUN_MODE")) die();?>
<?php 
include TPL_ROOT . 'common/header.html.php';
?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='panel' id='links'>
  <div class='panel-heading'><strong><i class='icon-link'></i> <?php echo $lang->links->common;?></strong></div>
  <div class='panel-body'><?php echo $links->all;?></div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
