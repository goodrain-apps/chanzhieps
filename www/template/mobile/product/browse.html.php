<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of product for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='block-region region-top blocks' data-region='product_browse-top'><?php $this->loadModel('block')->printRegion($layouts, 'product_browse', 'top');?></div>
<div class='panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><strong><?php echo $category->name;?></strong></div>
  </div>
  <div class='panel-body'>
    <?php
    $count = count($products);
    if($count == 0) $count = 1;
    $recPerRow = min($count, 2);
    ?>
    <div class='cards cards-products' data-cols='<?php echo $recPerRow?>' id='products'>
      <style><?php echo ".col-custom-{$recPerRow} {width: " . (100/$recPerRow) . "%}"; ?></style>
      <?php
      $index = 0;
      foreach($products as $product):
      ?>
      <?php $rowIndex = $index % $recPerRow; ?>
      <?php if($rowIndex === 0): ?>
      <div class='row'>
      <?php endif; ?>

      <div class='col col-custom-<?php echo $recPerRow?>'>
      <?php $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"); ?>
        <div class='card' id='product<?php echo $product->id?>' data-ve='product'>
          <a class='card-img' href='<?php echo $url?>'>
            <?php
            if(empty($product->image))
            {
                $imgColor = $product->id * 57 % 360;
                echo "<div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>{$product->name}</div>";
            }
            else
            {
                echo "<img class='lazy' alt='{$product->name}' title='{$product->name}' data-src='{$product->image->primary->middleURL}'> ";
            }
            ?>
          </a>
          <div class='card-content'>
            <?php
            echo "<a href='{$url}'>{$product->name}</a>";
            if(!$product->unsaleable)
            {
                if($product->promotion != 0)
                {
                    echo "<div><strong class='text-danger'>" . $this->config->product->currencySymbol . $product->promotion . '</strong>';
                    if($product->price != 0)
                    {
                        echo "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $this->config->product->currencySymbol . $product->price . '</small></div>';
                    }
                }
                else if($product->price != 0)
                {
                    echo "<div><strong class='text-danger'>" . $this->config->product->currencySymbol . $product->price . '</strong></div>';
                }
            }
            ?>
          </div>
        </div>
      </div>

      <?php if($recPerRow === 1 || $rowIndex === ($recPerRow - 1)): ?>
      </div>
      <?php endif; ?>
      <?php $index++; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <div class='panel-footer'><?php $pager->show('justify');?></div>
</div>

<div class='block-region region-bottom blocks' data-region='product_browse-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'product_browse', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
