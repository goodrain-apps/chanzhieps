<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The latest blog front view file of block module of chanzhiEPS.
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
/* Set $themRoot. */
$themeRoot = $this->config->webRoot . 'theme/';

/* Decode the content and get articles. */
$content  = json_decode($block->content);
$method   = 'get' . ucfirst(str_replace('blog', '', strtolower($block->type)));
$articles = $this->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, $content->limit, 'blog');
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
    <?php if(!empty($content->moreText) and !empty($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php if(isset($content->image)):?>
  <div class='panel-body'>
    <div class='items'>
    <?php
    foreach($articles as $article):
    $url = helper::createLink('blog', 'view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");
    ?>
      <div class='item'>
        <div class='item-heading'>
          <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
          <?php if($content->categoryName == 'abbr'):?>
          <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] ';?>
          <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName);?>
          <?php else:?>
          <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ');?>
          <?php endif;?>
          <?php endif;?>
          <strong><?php echo html::a($url, $article->title);?></strong>
        </div>
        <div class='item-content'>
          
          <div class='text small text-muted'>
            <div class='media pull-left'>
            <?php 
            if(!empty($article->image))
            {
                $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
                echo html::a($url, html::image($article->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
            }
            ?>
            </div>
            <strong class='text-important'>
              <?php if(isset($content->time)) echo "<i class='icon-time'></i> " . formatTime($article->addedDate, DT_DATE4);?>
            </strong> 
            &nbsp;<?php echo $article->summary;?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <?php else:?>
  <div class='panel-body'>
    <ul class='ul-list'>
      <?php foreach($articles as $article): ?>
      <?php 
      $alias = "category={$article->category->alias}&name={$article->alias}";
      $url   = helper::createLink('blog', 'view', "id={$article->id}", $alias);
      ?>
      <?php if(isset($content->time)):?>
      <li>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] ';?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName);?>
        <?php else:?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ');?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $article->title, "title='{$article->title}'");?>
        <span class='pull-right'><?php echo substr($article->addedDate, 0, 10);?></span>
      </li>
      <?php else:?>
      <li>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] ';?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName);?>
        <?php else:?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ');?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $article->title, "title='{$article->title}'");?>
      </li>
      <?php endif;?>
      
      <?php endforeach;?>
    </ul>
  </div>
  <?php endif;?>
</div>
