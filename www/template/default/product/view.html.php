<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The view file of product module of chanzhiEPS.
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
include TPL_ROOT . 'common/treeview.html.php';

/* set categoryPath for topNav highlight. */
js::set('path',  $product->path);
js::set('objectType', 'product');
js::set('productID', $product->id);
js::set('objectID', $product->id);
js::set('categoryID', $category->id);
js::set('categoryPath', explode(',', trim($category->path, ',')));
js::set('addToCartSuccess', $lang->product->addToCartSuccess);
js::set('gotoCart', $lang->product->gotoCart);
js::set('goback', $lang->product->goback);
js::set('stockOpened', $stockOpened);
js::set('stock', $product->amount);
css::internal($product->css);
js::execute($product->js);
?>
<?php $common->printPositionBar($category, $product);?>
<div class='row blocks' data-region='product_view-topBanner'><?php $this->block->printRegion($layouts, 'product_view', 'topBanner', true);?></div>
<div class='row'>
  <?php if(isset($layouts['product_view']['side'])):?>
  <div class='col-md-9 col-main'>
  <?php else:?>
  <div class='col-md-12'>
  <?php endif;?>
    <div class='row blocks' data-region='product_view-top'><?php $this->block->printRegion($layouts, 'product_view', 'top', true);?></div>
    <div class='panel panel-body panel-product' id='product' data-id='<?php echo $product->id;?>'>
      <div class='row'>
        <?php if(!empty($product->image->list)):?>
        <div class='col-sm-5' id='productImageWrapper'>
          <div class='product-image media-wrapper' id='productImage'>
            <?php $title = $product->image->primary->title ? $product->image->primary->title : $product->name;?>
            <?php echo html::image($product->image->primary->fullURL, "title='{$title}' alt='{$product->name}'");?>
            <div class='image-zoom-region'></div>
          </div>
          <?php if(count($product->image->list) > 1):?>
          <div class='product-image-menu-wrapper' id='imageMenuWrapper'>
            <button type='button' class='btn btn-link btn-img-scroller btn-prev-img'><i class="icon icon-chevron-left"></i></button>
            <button type='button' class='btn btn-link btn-img-scroller btn-next-img'><i class="icon icon-chevron-right"></i></button>
            <div class='product-image-menu clearfix' id='imageMenu'>
              <?php foreach($product->image->list as $image):?>
              <?php $title = $image->title ? $image->title : $product->name;?>
              <div class="product-image-wrapper">
                <div class='product-image little-image'>
                  <?php echo html::image($image->smallURL, "title='{$title}' alt='{$product->name}'");?>
                </div>
              </div>
              <?php endforeach;?>
            </div>
          </div>
          <?php endif;?>
        </div>
        <div class='col-sm-7'>
        <?php else:?>
        <div class='col-md-12'>
        <?php endif;?>
          <div class='product-property<?php echo empty($product->image->list) ? ' product-lack-img' : '';?>'>
            <h1 class='header-dividing'><?php echo $product->name;?></h1>
            <ul class='list-unstyled meta-list'>
              <?php
              $attributeHtml = '';
              if(!$product->unsaleable)
              {
                  if($product->promotion != 0)
                  {
                      if($product->price != 0)
                      {
                          $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->price . "</span>";
                          $attributeHtml .= "<span class='meta-value'><span class='text-muted text-latin'>" . $this->config->product->currencySymbol . "</span> <del><strong class='text-latin'>" . $product->price . "</del></strong></span></li>";
                      }
                      $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->promotion . "</span>";
                      $attributeHtml .= "<span class='meta-value'><span class='text-muted text-latin'>" . $this->config->product->currencySymbol . "</span> <strong class='text-danger text-latin text-lg'>" . $product->promotion . "</strong></span></li>";
                  }
                  else if($product->price != 0)
                  {
                      $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->price . "</span>";
                      $attributeHtml .= "<span class='meta-value'><span class='text-muted text-latin'>" . zget($lang->product->currencySymbols, $this->config->product->currency, '￥') . "</span> <strong class='text-important text-latin text-lg'>" . $product->price . "</strong></span></li>";
                  }
              }
              if($product->amount)
              {
                  $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->stock . "</span>";
                  $attributeHtml .= "<span class='meta-value'>" . $product->amount . " <small>" . $product->unit . "</small></span></li>";
              }
              if($product->brand)
              {
                  $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->brand . "</span>";
                  $attributeHtml .= "<span class='meta-value'>" . $product->brand . " <small>" . $product->model . "</small></span></li>";
              }
              if(!$product->brand and $product->model)
              {
                  $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->model . "</span>";
                  $attributeHtml .= "<span class='meta-value'>" . $product->model . "</span></li>";
              }
              if($product->color)
              {
                $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->color . "</span>";
                $attributeHtml .= "<span class='meta-value'>" . $product->color . "</span></li>";
              }
              if($product->origin)
              {
                $attributeHtml .= "<li><span class='meta-name'>" . $lang->product->origin . "</span>";
                $attributeHtml .= "<span class='meta-value'>" . $product->origin . "</span></li>";
              }
              foreach($product->attributes as $attribute)
              {
                  if(empty($attribute->label) and empty($attribute->value)) continue;
                  $attributeHtml .= "<li><span class='meta-name'>" . $attribute->label . "</span>";

                  if(strpos($attribute->value, 'http://') === 0 or strpos($attribute->value, 'https://') === 0)
                  {
                      $attributeHtml .= "<span class='meta-value'>" . html::a($attribute->value, $attribute->value, "target='_blank'") . "</span></li>";
                  }
                  else
                  {
                      $attributeHtml .= "<span class='meta-value'>" . $attribute->value . "</span></li>";
                  }
              }
              echo $attributeHtml;
              ?>
            </ul>
            <?php if(empty($attributeHtml)) echo '<div class="product-summary">' . $product->desc . '</div>'; ?>
            <?php if(!$product->unsaleable and commonModel::isAvailable('shop')):?>
            <?php if(!$stockOpened or $product->amount > 0):?>
            <ul class='list-unstyled meta-list'>
              <li id='countBox'>
                <span class='meta-name'><?php echo $lang->product->count; ?></span>
                <span class='meta-value'>
                  <div class='input-group'>
                    <span class='input-group-addon'><i class='icon icon-minus'></i></span>
                    <?php echo html::input('count', 1, "class='form-control'"); ?>
                    <span class='input-group-addon'><i class='icon icon-plus'></i></span>
                  </div>
                </span>
              </li>
            </ul>
            <?php endif;?>
            <span id='buyBtnBox'>
              <?php if($stockOpened and $product->amount < 1):?>
              <label class='btn-soldout'><?php echo $lang->product->soldout;?></label>
              <?php else:?>
              <label class='btn-buy'><?php echo $lang->product->buyNow;?></label>
              <label class='btn-cart'><?php echo $lang->product->addToCart;?></label>
              <?php endif;?>
            </span>
            <?php endif;?>
            <?php if(!commonModel::isAvailable('shop') and !$product->unsaleable and $product->mall):?>
            <hr>
            <div class='btn-gobuy'>
              <?php echo html::a(inlink('redirect', "id={$product->id}"), $lang->product->buyNow, "class='btn btn-lg btn-primary' target='_blank'");?>
            </div>
            <?php endif;?>
          </div>
        </div>
      </div>
      <h5 class='header-dividing'><i class='icon-file-text-alt text-muted'></i> <?php echo $lang->product->content;?></h5>
      <div class='article-content'>
        <?php echo $product->content;?>
      </div>
      <div class="article-files">
        <?php $this->loadModel('file')->printFiles($product->files);?>
      </div>
    </div>
    <div class='row blocks' data-region='product_view-bottom'><?php $this->block->printRegion($layouts, 'product_view', 'bottom', true);?></div>
    <?php if(commonModel::isAvailable('message')):?>
    <div id='comments'>
      <div id='commentBox'></div>
      <?php echo html::a('', '', "name='comment'");?>
    </div>
    <?php endif;?>
  </div>
  <?php if(isset($layouts['product_view']['side'])):?>
  <div class='col-md-3 col-side'>
    <side class='page-side blocks' data-region='product_view-side'><?php $this->block->printRegion($layouts, 'product_view', 'side');?></side>
  </div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='product_view-bottomBanner'><?php $this->block->printRegion($layouts, 'product_view', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'common/jplayer.html.php'; ?>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
