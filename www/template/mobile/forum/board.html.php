<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The board view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='block-region region-top blocks' data-region='forum_board-top'><?php $this->loadModel('block')->printRegion($layouts, 'forum_board', 'top');?></div>
<div class='panel-section'>
  <?php if(count($threads) > 5 && $this->forum->canPost($board)):?>
  <div class='panel-heading'>
    <?php echo html::a($this->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn primary block' data-toggle='modal'"); ?>
  </div>
  <?php endif;?>

  <div class='panel-heading page-header'>
    <div class='title'><i class='icon icon-comments-alt'></i> <strong><?php echo $board->name; ?></strong>
    <?php if($board->moderators) printf(" <small class='text-muted'>" . $lang->forum->lblOwner . '</small>', trim($board->moderators, ',')); ?></div>
  </div>

  <div class='cards cards-list condensed bordered'>
    <?php foreach($sticks as $thread):?>
    <?php $style = $thread->color ? " style='color:{$thread->color}'" : '';?>
    <a class='card' href='<?php echo $this->createLink('thread', 'view', "id=$thread->id");?>' data-ve='thread' id='thread<?php echo $thread->id;?>'>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-heading text-danger'><h5<?php echo $style;?>><i class='icon-comment-alt'></i> <?php echo $thread->title;?> [<?php echo $lang->thread->stick?>]</h5></div>
          <div class='card-content text-muted small'><i class='icon icon-eye-open'></i> <?php echo $thread->views;?> &nbsp; <i class='icon-user'></i> <?php echo $thread->authorRealname;?> <?php echo substr($thread->addedDate, 5, -3);?></div>
        </div>
        <div class='table-cell middle thumbnail-cell text-right'>
          <div class='counter text-right'><div class='title'><?php echo $thread->replies;?></div><div class='caption text-muted small'><?php echo $lang->thread->replies?></div></div>
        </div>
      </div>
    </a>
    <?php unset($threads[$thread->id]);?>
    <?php endforeach;?>

    <?php foreach($threads as $thread):?>
    <?php $style = $thread->color ? " style='color:{$thread->color}'" : '';?>
    <a class='card' href='<?php echo $this->createLink('thread', 'view', "id=$thread->id");?>' data-ve='thread' id='thread<?php echo $thread->id;?>'>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-heading<?php if($thread->isNew) echo ' text-success';?>'><h5<?php echo $style;?>><i class='icon-comment-alt'></i> <?php echo $thread->title;?></h5></div>
          <div class='card-content text-muted small'><i class='icon icon-eye-open'></i> <?php echo $thread->views;?> &nbsp; <i class='icon-user'></i> <?php echo $thread->authorRealname;?> <?php echo substr($thread->addedDate, 5, -3);?></div>
        </div>
        <div class='table-cell middle thumbnail-cell text-right'>
          <div class='counter text-right'><div class='title<?php if($thread->isNew) echo ' text-success';?>'><?php echo $thread->replies;?></div><div class='caption text-muted small'><?php echo $lang->thread->replies?></div></div>
        </div>
      </div>
    </a>
    <?php endforeach;?>
  </div>

  <div class='panel-footer'>
    <?php $pager->show('justify');?>
    <hr class='space'>
    <?php if($this->forum->canPost($board)) echo html::a($this->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn primary block' data-toggle='modal'");?>
  </div>
</div>
<div class='block-region region-bottom blocks' data-region='forum_board-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'forum_board', 'bottom');?></div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
