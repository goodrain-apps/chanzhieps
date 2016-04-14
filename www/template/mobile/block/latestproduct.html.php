<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The hot product front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php
$content  = json_decode($block->content);
$type     = str_replace('product', '', strtolower($block->type));
$method   = 'get' . $type;
if(empty($content->category)) $content->category = 0;
$image = isset($content->image) ? true : false;
$products = $this->loadModel('product')->$method($content->category, $content->limit, $image);
?>
<div id="block<?php echo $block->id;?>" class="panel-cards with-cards panel panel-block <?php echo $blockClass;?>">
  <div class='panel-heading'>
    <strong><?php echo $icon;?> <?php echo $block->title;?></strong>
    <?php if(isset($content->moreText) and isset($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php if(isset($content->image)):?>
  <div class='panel-body no-padding'>
    <?php
    $count = count($products);
    if($count == 0) $count = 1;
    $recPerRow = min($count, max(1, zget($content, 'recPerRow', 1)));
    ;?>
    <div class='cards cards-products' data-cols='<?php echo $recPerRow?>'>
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
        <div class='card'>
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
            if(isset($content->showCategory) and $content->showCategory == 1)
            {
                if($content->categoryName == 'abbr')
                {
                    $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';
                    echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), $categoryName, "class='text-special'");
                }
                else
                {
                    echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), '[' . $product->category->name . '] ', "class='text-special'");
                }
            }
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
  <?php else:?>
  <div class='panel-body no-padding'>
    <div class='list-group simple'>
      <?php
      foreach($products as $product):
      $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
      ?>
      <div class='list-group-item'>
        <span class='text-latin pull-right'>
        <?php
        if(!$product->unsaleable)
        {
            if($product->promotion != 0)
            {
                if($product->price != 0)
                {
                    echo "<small class='text-muted text-line-through'>" . $this->config->product->currencySymbol . $product->price . '</small>&nbsp;&nbsp;';
                }
                echo "<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->promotion . '</strong>';
            }
            else if($product->price != 0)
            {
                echo "<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->price . '</strong>';
            }
        }
        ?>
        </span>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), $categoryName, "class='text-special'");?>
        <?php else:?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), '[' . $product->category->name . '] ', "class='text-special'");?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $product->name);?>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <?php endif;?>
</div>
