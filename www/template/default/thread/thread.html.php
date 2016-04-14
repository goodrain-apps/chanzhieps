<?php if(!defined("RUN_MODE")) die();?>
<div class='panel thread'>
  <div class='panel-heading'>
    <i class='icon-comment-alt pull-left'></i>
    <div class='panel-actions'>
      <?php if($thread->readonly) echo "<span class='label'><i class='icon-lock'></i> " . $lang->thread->readonly . "</span> &nbsp;"; ?>
    </div>
    <strong><?php echo $thread->title; ?></strong>
    <div class='text-muted'><?php echo $thread->addedDate;?></div>
  </div>
  <table class='table'>
    <tr>
      <td class='speaker'>
       <?php
       if(isset($speakers[$thread->author]))
       {
           $this->thread->printSpeaker($speakers[$thread->author]);
       }
       else
       {
           echo $thread->author;
       }
       ?>
      </td>
      <td id='<?php echo $thread->id;?>' class='thread-wrapper'>
        <div class='thread-content article-content'><?php echo $thread->content;?></div>
        <?php if(!empty($thread->files)):?>
        <div class='article-files'><?php $this->thread->printFiles($thread, $this->thread->canManage($board->id, $thread->author));?></div>
        <?php endif;?>
      </td>
    </tr>
  </table>
  <div class='thread-foot'>
    <?php if(commonModel::isAvailable('score') and !empty($thread->scoreSum)):?>
    <span ><?php echo sprintf($lang->thread->scoreSum, $thread->scoreSum);?></span>
    <?php endif;?>
    <?php if($thread->editor): ?>
    <small class='text-muted'><?php printf($lang->thread->lblEdited, $thread->editorRealname, $thread->editedDate); ?></small>
    <?php endif; ?>
    <div class='pull-right thread-actions'>
      <?php if($this->app->user->account != 'guest'): ?>
        <?php if($this->thread->canManage($board->id)): ?>
        <span class='thread-more-actions'>
          <span class='dropdown dropup'>
            <a data-toggle='dropdown' href='###'><i class='icon-flag-alt'></i> <?php echo $lang->thread->sticks[$thread->stick]; ?> <span class='caret'></span></a>
            <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
            <?php
            foreach($lang->thread->sticks as $stick => $label)
            {
                if($thread->stick != $stick)
                {
                    echo '<li>' . html::a(inlink('stick', "thread=$thread->id&stick=$stick"), $label, "class='stickJsoner'") . '</li>';
                }
                else
                {
                    echo '<li class="active"><a href="###">' . $label . '</a></li>';
                }
            }
            ?>
            </ul>
          </span>
          <?php if(commonModel::isAvailable('score')):?>
          <?php $account = helper::safe64Encode($thread->author);?>
          <?php echo html::a(inlink('addScore', "account={$account}&objectType=thread&objectID={$thread->id}"), $lang->thread->score, "data-toggle=modal");?>
          <?php endif;?>
          <?php
          if($thread->hidden)
          {
              echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-open"></i> ' . $lang->thread->show, "class='switcher'");
          }
          else
          {
              echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-close"></i> ' . $lang->thread->hide, "class='switcher'");
          }
          echo html::a(inlink('delete', "threadID=$thread->id"), '<i class="icon-trash"></i> ' . $lang->delete, "class='deleter'");
          echo html::a(inlink('transfer',   "threadID=$thread->id"), '<i class="icon-location-arrow"></i> ' . $lang->thread->transfer, "data-toggle='modal'");
          ?>
        </span>
        <?php endif;?>
      <?php if($this->thread->canManage($board->id, $thread->author)) echo html::a(inlink('edit', "threadID=$thread->id"), '<i class="icon-pencil"></i> ' . $lang->edit); ?>
      <a href='#reply' class='thread-reply-btn'><i class='icon-reply'></i> <?php echo $lang->reply->common;?></a>
      <?php else: ?>
      <a href="<?php echo $this->createLink('user', 'login', 'referer=' . helper::safe64Encode($this->app->getURI(true))); ?>#reply" class="thread-reply-btn"><i class="icon-reply"></i> <?php echo $lang->reply->common;?></a>
      <?php endif; ?>
    </div>
  </div>
</div>
