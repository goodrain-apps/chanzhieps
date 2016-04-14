<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The page list front view file of block module of chanzhiEPS.
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
/* Decode the content and get pages. */
$content = json_decode($block->content);
$pages   = $this->loadModel('article')->getPageList($content->limit);
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
    foreach($pages as $page):
    $url = helper::createLink('page', 'view', "id=$page->id", "name=$page->alias");
    ?>
    <div class='item'>
      <div class='item-heading'><strong><?php echo html::a($url, $page->title);?></strong></div>
      <div class='item-content'>
        
        <div class='text small text-muted'>
          <div class='media pull-left'>
          <?php 
          if(!empty($page->image))
          {
              $title = $page->image->primary->title ? $page->image->primary->title : $page->title;
              echo html::a($url, html::image($page->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
          }
          ?>
          </div>
          <strong class='text-important'>
            <?php if(isset($content->time)) echo "<i class='icon-time'></i> " . formatTime($page->addedDate, DT_DATE4);?>
          </strong> 
          &nbsp;<?php echo $page->summary;?>
        </div>
      </div>
    </div>
    <?php endforeach;?>
    </div>
  </div>
  <?php else:?>
  <div class='panel-body'>
    <ul class='ul-list'>
      <?php foreach($pages as $page):?>
      <?php $url = helper::createLink('page', 'view', "id={$page->id}", "name={$page->alias}");?>
      <?php if(isset($content->time)):?>
      <li>
        <?php echo html::a($url, $page->title, "title='{$page->title}'");?>
        <span class='pull-right'><?php echo substr($page->addedDate, 0, 10);?></span>
      </li>
      <?php else:?>
      <li><?php echo html::a($url, $page->title, "title='{$page->title}'");?></li>
      <?php endif;?>
      
      <?php endforeach;?>
    </ul>
  </div>
  <?php endif;?>
</div>
