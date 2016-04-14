<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php'; ?>
<?php include TPL_ROOT . 'common/treeview.html.php'; ?>
<div class='row blocks' data-grid='4' data-region='forum_board-top'><?php $this->block->printRegion($layouts, 'forum_board', 'top', true);?></div>
<?php $common->printPositionBar($board);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-comments-alt icon-large'></i>&nbsp;
    <?php echo $board->name; ?>
    </strong>
    <?php if($board->moderators) printf(" &nbsp;<span class='moderators hidden-xxs'>" . $lang->forum->lblOwner . '</span>', trim($board->moderators, ',')); ?>
    <div class='panel-actions'>
      <?php if($this->forum->canPost($board)) echo html::a($this->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil icon-large"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn btn-primary'");?>
    </div>
  </div>
  <table class='table table-hover table-striped'>
    <thead>
      <tr class='text-center hidden-xxxs'>
        <th colspan='2'><?php echo $lang->thread->title;?></th>
        <th class='w-150px hidden-xxs'><?php echo $lang->thread->author;?></th>
        <th class='w-100px hidden-xs'><?php echo $lang->thread->postedDate;?></th>
        <th class='w-50px hidden-xs'><?php echo $lang->thread->views;?></th>
        <th class='w-50px'><?php echo $lang->thread->replies;?></th>
        <th class='w-200px hidden-sm hidden-xs'><?php echo $lang->thread->lastReply;?></th>
      </tr>  
    </thead>
    <tbody>
      <?php foreach($sticks as $thread):?>
      <?php $style = $thread->color ? "style='color:{$thread->color}'" : '';?>
      <tr class='text-center'>
        <td class='w-10px'><span class='sticky-thread text-danger'><i class="icon-comment-alt icon-large"></i></span></td>
        <td class='text-left'>
          <div data-ve='thread' id='thread<?php echo $thread->id;?>'><?php echo html::a($this->createLink('thread', 'view', "id=$thread->id"), $thread->title, $style);?><?php echo "<span class='label label-danger'>{$lang->thread->stick}</span> "?></div>
        </td>
        <td class='hidden-xxs'><strong><?php echo $thread->authorRealname;?></strong></td>
        <td class='hidden-xs'><?php echo substr($thread->addedDate, 5, -3);?></td>
        <td class='hidden-xs'><?php echo $thread->views;?></td>
        <td class='hidden-xxxs'><?php echo $thread->replies;?></td>
        <td class='hidden-sm hidden-xs'>
          <?php 
          if($thread->replies)
          {
              echo substr($thread->repliedDate, 5, -3) . ' ';
              echo html::a($this->createLink('thread', 'locate', "threadID={$thread->id}&replyID={$thread->replyID}"), $thread->repliedByRealname);
          }
          ?>
        </td>  
      </tr>
      <?php unset($threads[$thread->id]);?>
      <?php endforeach;?>

      <?php foreach($threads as $thread):?>
      <?php $style = $thread->color ? "style='color:{$thread->color}'" : '';?>
      <tr class='text-center'>
        <td class='w-10px'><?php echo $thread->isNew ? "<span class='text-success'><i class='icon-comment-alt icon-large'></i></span>" : "<span class='text-muted'><i class='icon-comment-alt icon-large'></i></span>";?></td>
        <td class='text-left'>
          <div data-ve='thread' id='thread<?php echo $thread->id;?>'><?php echo html::a($this->createLink('thread', 'view', "id=$thread->id"), $thread->title, $style);?></td></div>
        <td class='hidden-xxs'><strong><?php echo $thread->authorRealname;?></strong></td>
        <td class='hidden-xs'><?php echo substr($thread->addedDate, 5, -3);?></td>
        <td class='hidden-xs'><?php echo $thread->views;?></td>
        <td class='hidden-xxxs'><?php echo $thread->replies;?></td>
        <td class='hidden-sm hidden-xs'>
          <?php 
          if($thread->replies)
          {
              echo substr($thread->repliedDate, 5, -3) . ' ';
              echo html::a($this->createLink('thread', 'locate', "threadID={$thread->id}&replyID={$thread->replyID}"), $thread->repliedByRealname);
          }
          ?>
        </td>  
      </tr>  
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='7'><?php $pager->show('right', 'short');?></td></tr></tfoot>
  </table>
</div>
<div class='blocks' data-region='forum_board-bottom'><?php $this->block->printRegion($layouts, 'forum_board', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
