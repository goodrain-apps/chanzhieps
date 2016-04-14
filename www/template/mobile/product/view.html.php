<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The view file of product for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'common/header.html.php';
include TPL_ROOT . 'common/files.html.php';

/* set categoryPath for topNav highlight. */
js::set('path',  $product->path);
js::set('categoryID', $category->id);
js::set('categoryPath', explode(',', trim($category->path, ',')));
js::set('addToCartSuccess', $lang->product->addToCartSuccess);
js::set('gotoCart', $lang->product->gotoCart);
js::set('goback', $lang->product->goback);
css::internal($product->css);
js::execute($product->js);
?>
<div class='block-region region-top blocks' data-region='product_view-top'><?php $this->loadModel('block')->printRegion($layouts, 'product_view', 'top');?></div>
<div id='product' data-id='<?php echo $product->id; ?>'>
<div class='appheader'>
<?php if(!empty($product->image->list)):?>
  <?php if(count($product->image->list) > 1): ?>
  <div id='productSlide' class='carousel slide' data-ride='carousel'>
    <div class='carousel-inner'>
    <?php
    $imgIndex = 0;
    $indicators = '';
    ?>
    <?php foreach($product->image->list as $image):?>
      <div class='item<?php if($imgIndex === 0) echo ' active';?>'><?php echo html::image($image->middleURL, "title='{$title}' alt='{$product->name}'");?></div>
      <?php $indicators .= "<li data-target='#productSlide' data-slide-to='{$imgIndex}' class='" . ($imgIndex === 0 ? 'active':'') . "'></li>"; ?>
    <?php $imgIndex++; ?>
    <?php endforeach;?>
    </div>
    <?php echo "<ol class='carousel-indicators fix-top-right'>{$indicators}</ol>";?>
    <a class='left carousel-control' href='#productSlide' data-slide='prev'>
      <i class='icon icon-chevron-left'></i>
    </a>
    <a class='right carousel-control' href='#productSlide' data-slide='next'>
      <i class='icon icon-chevron-right'></i>
    </a>
  </div>
  <?php else:?>
  <?php echo html::image($product->image->primary->largeURL, "title='{$title}' alt='{$product->name}'");?>
  <?php endif;?>
<?php endif;?>
  <div class='heading'>
    <h2><?php echo $product->name;?></h2>
    <?php
    if(!$product->unsaleable)
    {
        echo "<div class='caption'>";
        if($product->promotion != 0)
        {
            echo "<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->promotion . '</strong>';
            if($product->price != 0)
            {
                echo "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $this->config->product->currencySymbol . $product->price . '</small>';
            }
        }
        else if($product->price != 0)
        {
            echo "<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->price . '</strong>';
        }
        echo '</div>';
    }
    ?>
  </div>
</div>

<?php
$attributeHtml = '';
if($product->amount)
{
    $attributeHtml .= "<tr><th>" . $lang->product->amount . "</th>";
    $attributeHtml .= "<td>" . $product->amount . " <small>" . $product->unit . "</small></td></tr>";
}
if($product->brand)
{
    $attributeHtml .= "<tr><th>" . $lang->product->brand . "</th>";
    $attributeHtml .= "<td>" . $product->brand . " <small>" . $product->model . "</small></td></tr>";
}
if(!$product->brand and $product->model)
{
    $attributeHtml .= "<tr><th>" . $lang->product->model . "</th>";
    $attributeHtml .= "<td>" . $product->model . "</td></tr>";
}
if($product->color)
{
  $attributeHtml .= "<tr><th>" . $lang->product->color . "</th>";
  $attributeHtml .= "<td>" . $product->color . "</td></tr>";
}
if($product->origin)
{
  $attributeHtml .= "<tr><th>" . $lang->product->origin . "</th>";
  $attributeHtml .= "<td>" . $product->origin . "</td></tr>";
}
foreach($product->attributes as $attribute)
{
    if(empty($attribute->label) and empty($attribute->value)) continue;
    $attributeHtml .= "<tr><th>" . $attribute->label . "</th>";

    $http  = strpos($attribute->value, 'https') !== false ? 'https://' : 'http://';
    $attribute->value = str_replace($http, '', $attribute->value);
    $value = strpos($attribute->value, ':') !== false ? substr($attribute->value, 0, strpos($attribute->value, ':')) : $attribute->value;
    if(preg_match('/^([a-z0-9\-]+\.)+[a-z0-9\-]+$/', $value))
    {
        $attributeHtml .= "<td>" . html::a($http . $attribute->value, $attribute->value, "target='_blank'") . "</td></tr>";
    }
    else
    {
        $attributeHtml .= "<td>" . $attribute->value . "</td></tr>";
    }
}
?>
<table class='table table-layout small'>
  <tbody>
    <?php
    if(empty($attributeHtml))
    {
        echo "<tr><td colspan='2' class='small'>{$product->desc}</td></tr>";
    }
    else
    {
        echo $attributeHtml;
    }
    ?>
    <?php if(!$product->unsaleable and commonModel::isAvailable('shop')):?>
    <tr>
      <th><?php echo $lang->product->count; ?></th>
      <td>
        <div class='input-group input-group-sm input-number'>
          <span class='input-group-btn'>
            <button class='btn default btn-minus' type='button'><i class='icon icon-minus'></i></button>
          </span>
          <input type='number' class='form-control text-center' value='1' id='count' name='count'>
          <span class='input-group-btn'>
            <button class='btn default btn-plus' type='button'><i class='icon icon-plus'></i></button>
          </span>
        </div>
      </td>
    </tr>
    <tr>
      <td colspan='2'>
        <div class='row'>
          <div class='col-6'><button type='button' class='btn block primary btn-buy' data-url='<?php echo $this->createLink('order', 'confirm', "product={$product->id}&count=count");?>'><?php echo $lang->product->buyNow;?></button></div>
          <div class='col-6'><button type='button' class='btn block warning btn-cart' data-url='<?php echo $this->createLink('cart', 'add', "product={$product->id}&count=count");?>'><?php echo $lang->product->addToCart;?></button></div>
        </div>
      </td>
    </tr>
    <?php endif;?>
    <?php if(!commonModel::isAvailable('shop') and !$product->unsaleable and $product->mall):?>
    <tr>
      <td colspan='2'>
      <?php echo html::a(inlink('redirect', "id={$product->id}"), $lang->product->buyNow . ' <i class="icon icon-external-link"></i>', "class='btn block primary' target='_blank'");?>
      </td>
    </tr>
    <?php endif;?>
  </tbody>
</table>
<hr class='space'>
<div class='panel panel-section'>
  <div class='panel-heading head-dividing hidden'><i class='icon-file-text-alt text-muted'></i>&nbsp;<strong><?php echo $lang->product->content;?></strong></div>
  <div class='panel-body'>
    <div class='article-content'>
      <?php echo $product->content;?>
    </div>
  </div>
  <?php if(!empty($product->files)):?>
  <section class='article-files'>
    <?php $this->loadModel('file')->printFiles($product->files);?>
  </section>
  <?php endif;?>
</div>
</div>
<?php if(commonModel::isAvailable('message')):?>
<div id='commentBox'></div>
<?php endif;?>

<div class='block-region region-bottom blocks' data-region='product_view-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'product_view', 'bottom');?></div>
<?php js::import($templateCommonRoot . 'js/mzui.form.min.js'); ?>
<script>
$(function()
{
    $('#commentBox').load('<?php echo helper::createLink('message', 'comment', "objectType=product&objectID=$product->id", 'mhtml');?>');
});
</script>

<?php include TPL_ROOT . 'common/footer.html.php';?>
