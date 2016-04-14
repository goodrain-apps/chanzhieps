<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The latest article front view file of block module of chanzhiEPS.
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
$content = json_decode($block->content);
$method  = 'get' . ucfirst(str_replace('thread', '', strtolower($block->type)));
$threads = $this->loadModel('thread')->$method(empty($content->category) ? 0 : $content->category, $content->limit);
$boards  = $this->dao->select('*')->from(TABLE_CATEGORY)->where('type')->eq('forum')->andWhere('grade')->eq(2)->fetchAll('id');
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
    <?php if(!empty($content->moreText) and !empty($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <div class='panel-body no-padding'>
    <div class='list-group simple'>
      <?php foreach($threads as $thread): ?>
      <div class='list-group-item'>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $boardName = '[' . ($boards[$thread->board]->abbr ? $boards[$thread->board]->abbr : $boards[$thread->board]->name) . '] ';?>
        <?php echo html::a(helper::createLink('forum', 'board', "boardID={$thread->board}", "category={$boards[$thread->board]->alias}"), $boardName, "class='text-special'");?>
        <?php else:?>
        <?php echo html::a(helper::createLink('forum', 'board', "boardID={$thread->board}", "category={$boards[$thread->board]->alias}"), '[' . $boards[$thread->board]->name . '] ', "class='text-special'");?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a(helper::createLink('thread', 'view', "id=$thread->id"), $thread->title);?>
        <span class='pull-right text-muted'><?php echo substr($thread->addedDate, 0, 10);?></span>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
