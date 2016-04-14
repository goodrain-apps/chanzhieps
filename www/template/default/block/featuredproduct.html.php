<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The featured product front view file of block module of chanzhiEPS.
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
$product  = $this->loadModel('product')->getByID($content->product);
?>
<?php if(!empty($product)):?>
<?php
$category = array_shift($product->categories);
$alias    = !empty($category) ? $category->alias : '';
$url      = helper::createLink('product', 'view', "id={$product->id}", "category={$alias}&name={$product->alias}");
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-body'>
    <div class='card'>
      <div class='media' style='background-image: url(<?php echo $product->image->primary->middleURL; ?>);'><?php echo html::image($product->image->primary->middleURL, "title='{$product->name}' alt='{$product->name}'"); ?></div>
      <div class='card-heading'>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($category->abbr ? $category->abbr : $category->name) . '] ';?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), $categoryName);?>
        <?php else:?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), '[' . $category->name . '] ');?>
        <?php endif;?>
        <?php endif;?>
        <strong><?php echo html::a($url, $product->name);?></strong>
        <span class='text-latin'>
        <?php
        if(!$product->unsaleable)
        {
            if($product->promotion != 0)
            {
                echo "&nbsp;&nbsp;<strong class='text-danger'>" . $this->config->product->currencySymbol . $product->promotion . '</strong>';
                if($product->price != 0)
                {
                    echo "&nbsp;&nbsp;<del class='text-muted'>" . $this->config->product->currencySymbol . $product->price .'</del>';
                }
            }
            else
            {
                if($product->price != 0)
                {
                    echo "<span class='text-muted'> " . $this->config->product->currencySymbol . "</span> ";
                    echo "<strong class='text-important'>" . $product->price . '</strong>&nbsp;&nbsp;';
                }
            }
        }
        ?>
        </span>
      </div>
      <div class='card-content text-muted'><?php echo helper::substr(strip_tags($product->desc), 80);?></div>
    </div>
  </div>
</div>
<?php endif;?>
