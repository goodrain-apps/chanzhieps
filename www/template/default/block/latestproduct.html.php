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
<div id="block<?php echo $block->id;?>" class="panel-cards panel panel-block <?php echo $blockClass;?>">
  <div class='panel-heading'>
    <strong><?php echo $icon;?> <?php echo $block->title;?></strong>
    <?php if(isset($content->moreText) and isset($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php if(isset($content->image)):?>
  <div class='panel-body'>
    <div class='cards cards-borderless'>
      <?php foreach($products as $product):?>
      <?php 
      $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
      ?>
      <?php if(!empty($product->image)): ?>
      <div class='col-md-12' data-recperrow="<?php echo isset($content->recPerRow) ? $content->recPerRow : '3';?>">
        <a class='card' href="<?php echo $url;?>">
          <?php $title = $product->image->primary->title ? $product->image->primary->title : $product->name;?>
          <div class='media' style='background-image: url(<?php echo $product->image->primary->middleURL; ?>);'><?php echo html::image($product->image->primary->middleURL, "title='{$title}' alt='{$product->name}'"); ?></div>
          <div class='card-heading'>
            <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
            <?php if($content->categoryName == 'abbr'):?>
            <?php $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';?>
            <?php echo  $categoryName;?>
            <?php else:?>
            <?php echo ' [' . $product->category->name . '] ';?>
            <?php endif;?>
            <?php endif;?>
            <?php echo $product->name;?>
            <span class='text-latin'>
            <?php
            $currencySymbol = $this->config->product->currencySymbol;
            if(!$product->unsaleable)
            {
                if($product->promotion != 0)
                {
                    echo "&nbsp;&nbsp;";
                    echo "<strong class='text-danger'>" . $currencySymbol . $product->promotion . '</strong>';
                }
                else
                {
                    if($product->price != 0)
                    {
                        echo "<strong class='text-danger'>" . $currencySymbol . $product->price . '</strong>';
                    }
                }
            }
            ?>
            </span>
          </div>
        </a>
      </div>
      <?php endif;?>
      <?php endforeach;?>
    </div>
  </div>
  <?php else:?>
  <div class='panel-body'>
    <ul class='ul-list'>
      <?php 
      foreach($products as $product):
      $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
      ?>
      <li>
        <span class='text-latin pull-right'>
        <?php
        if(!$product->unsaleable)
        {
            if($product->promotion != 0)
            {
                if($product->price != 0)
                {
                    echo "<small class='text-muted'>" . $this->config->product->currencySymbol . "</small> ";
                    echo "<del><small class='text-muted'>" . $product->price . "</small></del>";
                }
                echo "&nbsp; <small class='text-muted'>" . $this->config->product->currencySymbol . "</small> ";
                echo "<strong class='text-danger'>" . $product->promotion . "</strong>";
            }
            else if($product->price != 0)
            {
                echo "&nbsp; <small class='text-muted'>" . $this->config->product->currencySymbol . "</small> ";
                echo "<strong class='text-important'>" . $product->price . "</strong>";
            }
        }
        ?>
        </span>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
          <?php if($content->categoryName == 'abbr'):?>
          <?php $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';?>
          <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), $categoryName);?>
          <?php else:?>
          <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), '[' . $product->category->name . '] ');?>
          <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $product->name);?>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
  <?php endif;?>
</div>
