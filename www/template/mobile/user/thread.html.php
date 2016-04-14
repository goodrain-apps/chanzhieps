<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The thread view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'user/side.html.php';?>

<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-share'></i> <?php echo $lang->user->thread?></div>
  </div>
  <div class='cards condensed cards-list'>
    <?php foreach($threads as $thread):?>
    <a href='<?php echo $this->createLink('thread', 'view', "id=$thread->id");?>' class='card'>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-heading'>
            <h5><?php echo $thread->title?></h5>
          </div>
          <div class='card-content text-muted'>
            <?php echo $lang->thread->postedDate;?> <?php echo substr($thread->addedDate, 2, -3);?>
            &nbsp;&nbsp;
            <i class='icon-eye-open'></i> <?php echo $thread->views;?>
          </div>
          <?php if($thread->replies):?>
          <div class='card-footer text-muted'>
            <?php echo $lang->thread->lastReply;?> <?php echo substr($thread->repliedDate, 2, -3) . ' ' . $thread->repliedByRealname;?>
          </div>
          <?php endif; ?>
        </div>
        <div class='table-cell middle thumbnail-cell text-right'>
          <div class='counter text-right'><div class='title <?php echo $thread->replies > 0 ? '' : 'text-muted'; ?>'><?php echo $thread->replies;?></div><div class='caption text-muted small'><?php echo $lang->thread->replies;?></div></div>
        </div>
      </div>
    </a>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
