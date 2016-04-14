<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The cart view of cart module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     cart 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::set('currencySymbol', $currencySymbol);?>
<?php if(!empty($products)):?>
<?php $total = 0;?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo $lang->cart->browse;?></strong>
  </div>
  <form action='<?php echo helper::createLink('order', 'confirm'); ?>' method='post'>
    <div class='panel-body'>
      <table class='table table-list'>
        <thead>
          <tr class='text-center'>
            <td colspan='2' class='text-left'><?php echo $lang->order->productInfo;?></td>
            <td class='text-left'><?php echo $lang->order->price;?></td>
            <td><?php echo $lang->order->count;?></td>
            <td><?php echo $lang->order->amount;?></td>
            <td><?php echo $lang->actions;?></td>
          </tr>
        </thead>
        <?php foreach($products as $productID => $product): ?>
        <?php $productLink = helper::createLink('product', 'view', "id=$productID", "category={$product->categories[$product->category]->alias}&name=$product->alias");?>
        <tr>
          <td class='w-100px'>
            <?php 
            if(!empty($product->image)) 
            {
                $title = $product->image->primary->title ? $product->image->primary->title : $product->name;
                echo html::a($productLink, html::image($product->image->primary->smallURL, "title='{$title}' alt='{$product->name}'"), "class='media-wrapper'");
            }
            ?>
          </td>
          <td class='text-left text-middle'>
            <?php echo html::a($productLink, '<div class="" data-id="' . $product->id . '">' . $product->name . '</div>', "class='media-wrapper'");?>
          </td>
          <td class='w-100px text-middle'> 
            <?php if($product->promotion != 0):?>
            <?php $price = $product->promotion;?>
            <div class='text-muted'><del><?php echo $currencySymbol . $product->price;?></del></div>
            <div class='text-price'><?php echo $currencySymbol . $product->promotion;?></div>
            <?php else:?>
            <?php $price  = $product->price;?>
            <div class='text-price'><?php echo $currencySymbol . $product->price;?></div>
            <?php endif;?>
            <?php echo html::hidden("price[$product->id]", $price);?>
            <?php $amount = $product->count * $price;?>
            <?php $total += $amount;?>
          </td>
          <td class='w-140px text-middle'>
            <div class='input-group'>
              <span class='input-group-addon'><i class='icon icon-minus'></i></span>
              <?php echo html::input("count[$product->id]", $product->count, "class='form-control'"); ?>
              <span class='input-group-addon'><i class='icon icon-plus'></i></span>
            </div>
          </td>
          <td class='w-200px text-center text-middle'>
            <strong class='text-danger'><?php echo $currencySymbol;?></strong>
            <strong class='text-danger amountContainer'><?php echo $amount?></strong>
          </td>
          <td class='text-middle text-center'>
            <?php echo html::a(inlink('delete', "product={$product->id}"), $lang->delete, "class='deleter'");?>
            <?php echo html::hidden("product[]", $product->id);?>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
    <div class='panel-footer text-right'>
      <?php printf($lang->order->selectProducts, count($products));?>
      <?php printf($lang->order->totalToPay, $currencySymbol . $total);?>
      <?php echo html::submitButton($lang->cart->goAccount, 'btn-order-submit'); ?>
    </div>
  </form>
</div>
<?php else:?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo $lang->cart->browse;?></strong>
  </div>
  <div class='panel-body'>
    <?php echo $lang->cart->noProducts;?>
    <?php echo html::a(helper::createLink('product', 'browse', 'category=0'), $lang->cart->pickProducts, "class='btn btn-xs btn-primary'");?>
    <?php echo html::a(helper::createLink('index', 'index'), $lang->cart->goHome, "class='btn btn-xs btn-default'");?>
  </div>
</div>
<?php endif;?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
