<?php if(!defined("RUN_MODE")) die();?>
<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot   = $config->webRoot;
$jsRoot    = $webRoot . "js/";
$themeRoot = $webRoot . "theme/";
if(isset($pageCSS)) css::internal($pageCSS);
?>
<div class="modal-dialog" style="width:<?php echo empty($modalWidth) ? 1000 : $modalWidth;?>px;">
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
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>
<div class='page-container'>
  <div class='blocks' data-region='all-top'><?php $this->block->printRegion($layouts, 'all', 'top');?></div>
  <div class='page-wrapper'>
    <div class='page-content'>
      <div class='blocks' data-region='all-banner'><?php $this->block->printRegion($layouts, 'all', 'banner');?></div>
<?php endif;?>
