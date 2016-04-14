<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of product of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'common/header.html.php';
$path = isset($category->pathNames) ? array_keys($category->pathNames) : array(0);
js::set('path', $path);
js::set('categoryID', $category->id);
include TPL_ROOT . 'common/treeview.html.php';
?>
<?php echo $common->printPositionBar($category, isset($product) ? $product : '');?>
<div class='row blocks' data-region='product_browse-topBanner'><?php $this->block->printRegion($layouts, 'product_browse', 'topBanner', true);?></div>
<div class='row'>
  <?php if(isset($layouts['product_browse']['side'])):?>
  <div class='col-md-9 col-main'>
  <?php else:?>
  <div class='col-md-12'>
  <?php endif;?>
    <div class='list list-condensed' id='products'>
      <div class='row blocks' data-region='product_browse-top'><?php $this->block->printRegion($layouts, 'product_browse', 'top', true);?></div>
      <header>
        <strong><i class='icon-th'></i> <?php echo $category->name;?></strong>
        <div class='pull-right btn-group' id="modeControl">
          <?php foreach($lang->product->listMode as $mode => $text):?>
          <?php echo html::a("javascript:;", $text, "data-mode='{$mode}' class='btn'");?>
          <?php endforeach;?>
        </div>
      </header>
      <?php include 'browse.card.html.php';?>
      <?php include 'browse.list.html.php';?>
      <footer class='clearfix'>
        <?php $pager->show('right', 'short');?>
      </footer>
    </div>
    <div class='row blocks' data-region='product_browse-bottom'><?php $this->block->printRegion($layouts, 'product_browse', 'bottom', true);?></div>
  </div>
  <?php if(isset($layouts['product_browse']['side'])):?>
  <div class='col-md-3 col-side'>
    <side class='page-side blocks' data-region='product_browse-side'><?php $this->block->printRegion($layouts, 'product_browse', 'side');?></side>
  </div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='product_browse-bottomBanner'><?php $this->block->printRegion($layouts, 'product_browse', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
