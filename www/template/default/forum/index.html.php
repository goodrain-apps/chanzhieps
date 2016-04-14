<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php'; ?>
<div class='row blocks' data-grid='4' data-region='forum_index-top'><?php $this->block->printRegion($layouts, 'forum_index', 'top', true);?></div>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div id='boards'>
<?php foreach($boards as $parentBoard):?>
  <div class='panel'>
    <div class='panel-heading'>
      <strong><i class='icon-comments icon-large'></i> <?php echo $parentBoard->name;?></strong>
    </div>
    <table class='table table-hover table-striped'>
      <thead>
        <tr class='text-center hidden-xxxs'>
          <th colspan='2'>&nbsp;<?php echo $lang->forum->board;?></th>
          <th class='hidden-xs'><?php echo $lang->forum->owners;?></th>
          <th><?php echo $lang->forum->threadCount;?></th>
          <th class='hidden-xxs'><?php echo $lang->forum->postCount;?></th>
          <th class='hidden-xs'><?php echo $lang->forum->lastPost;?></th>
        </tr>  
      </thead>
      <tbody>
        <?php foreach($parentBoard->children as $childBoard):?>
        <tr class='text-center text-middle'>
          <td class='w-20px'><?php echo $this->forum->isNew($childBoard) ? "<span class='text-success'><i class='icon-comment icon-large'></i></span>" : "<span class='text-muted'><i class='icon-comment icon-large'></i></span>"; ?></td>
          <td class='text-left'>
            <strong><?php echo html::a(inlink('board', "id=$childBoard->id", "category={$childBoard->alias}"), $childBoard->name);?></strong><br />
            <small class='text-muted'><?php echo $childBoard->desc;?></small>
          </td>
          <td class='w-120px hidden-xs'><strong><nobr><?php foreach($childBoard->moderators as $moderators) echo $moderators . ' ';?></nobr></strong></td>
          <td class='w-70px hidden-xxxs'><?php echo $childBoard->threads;?></td>
          <td class='w-70px hidden-xxs'><?php echo $childBoard->posts;?></td>
          <td class='w-150px hidden-xs'>
            <?php
            if($childBoard->postedBy)
            {
                echo substr($childBoard->postedDate, 5, -3) . '<br/>'; 
                echo html::a($this->createLink('thread', 'locate', "threadID={$childBoard->postID}&replyID={$childBoard->replyID}"), $childBoard->postedByRealname);
            }
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
<?php endforeach;?>
</div>
<div class='blocks' data-region='forum_index-bottom'><?php $this->block->printRegion($layouts, 'forum_index', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
