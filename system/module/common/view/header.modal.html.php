<?php if(!defined("RUN_MODE")) die();?>
<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot   = $config->webRoot;
$jsRoot    = $webRoot . "js/";
$themeRoot = $webRoot . "theme/";
if(isset($pageCSS)) css::internal($pageCSS);
?>
<div class="modal-dialog" style="width:<?php echo empty($modalWidth) ? 600 : $modalWidth;?>px;">
  <div class="modal-content">
    <div class="modal-header">
      <?php echo html::closeButton();?>
      <strong class="modal-title"><?php if(!empty($title)) echo $title; ?></strong>
      <?php if(!empty($subtitle)):?>
      <small><?php echo $subtitle;?></small>
      <?php endif;?>
    </div>
    <div class="modal-body">
<?php else:?>
<?php if(RUN_MODE == 'front') include 'header.html.php';?>
<?php if(RUN_MODE == 'admin') include 'header.admin.html.php';?>
<?php endif;?>
