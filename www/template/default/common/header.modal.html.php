<?php if(!defined("RUN_MODE")) die();?>
<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot   = $config->webRoot;
$jsRoot    = $webRoot . "js/";
$themeRoot = $webRoot . "theme/default/";
if(isset($pageCSS)) css::internal($pageCSS);
?>
<div class="modal-dialog" style="width:<?php echo empty($modalWidth) ? 600 : $modalWidth;?>px;">
  <div class="modal-content">
    <div class="modal-header">
      <?php echo html::closeButton();?>
      <h4 class="modal-title"><?php if(!empty($title)) echo $title; ?></h4>
    </div>
    <div class="modal-body">
<?php else:?>
<?php include TPL_ROOT . 'common'  . DS . 'header.html.php';?>
<?php endif;?>
