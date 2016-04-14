<?php if(!defined("RUN_MODE")) die();?>
<div class='panel panel-section panel-body cards cards-list'>
  <div class='card thread'>
    <div class='card-heading with-icon'>
      <i class='icon-comment-alt icon'></i>
      <div class='pull-right'>
        <?php if($thread->stick):?>
        <small class='bg-danger-pale text-danger'><i class='icon-flag'></i> <?php echo $lang->thread->sticks[$thread->stick]; ?></small>
        <?php endif;?>
        <?php if($thread->readonly): ?>
        &nbsp; <small class='bg-info-pale text-info'><i class='icon icon-lock'></i> <?php echo $lang->thread->readonly; ?></small>
        <?php endif;?>
      </div>
      <h4><?php echo $thread->title; ?></h4>
      <div class='caption text-muted'>
        <span class='text-danger'><i class='icon-user'></i> <?php echo isset($speakers[$thread->author]) ? $speakers[$thread->author]->realname : $thread->author ?></span> &nbsp; <small><i class='icon-time'></i> <?php echo $thread->addedDate;?></small>
      </div>
    </div>
    <section class='card-content article-content'><?php echo $thread->content;?></section>
    <?php if(!empty($thread->files)):?>
    <div class='card-content'><?php $this->thread->printFiles($thread, $this->thread->canManage($board->id, $thread->author));?></div>
    <?php endif;?>
    <div class="card-footer">
      <?php if($thread->editor): ?>
      <small class='hide last-edit'><i class="icon-pencil"></i> <?php printf($lang->thread->lblEdited, $thread->editorRealname, $thread->editedDate); ?></small>
      <?php endif; ?>
      <?php if($this->app->user->account != 'guest'): ?>
      <div class="actions text-right">
        <?php if($this->thread->canManage($board->id)): ?>
        <span class='dropdown dropup'>
          <a data-toggle='dropdown' href='###' class='text-muted'><i class='icon-flag-alt'></i> <?php echo $lang->thread->sticks[$thread->stick]; ?> <i class='icon-caret-up'></i></a>
          <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
          <?php
          foreach($lang->thread->sticks as $stick => $label)
          {
              if($thread->stick != $stick)
              {
                  echo '<li>' . html::a(inlink('stick', "thread=$thread->id&stick=$stick"), $label, "class='ajaxaction'") . '</li>';
              }
              else
              {
                  echo '<li class="active"><a href="###">' . $label . '</a></li>';
              }
          }
          ?>
          </ul>
        </span> &nbsp;
        <?php
        if($thread->hidden)
        {
            echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-open"></i> ' . $lang->thread->show, "class='switcher ajaxaction text-muted'") . ' &nbsp; ';
        }
        else
        {
            echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-close"></i> ' . $lang->thread->hide, "class='switcher ajaxaction text-muted'") . ' &nbsp; ';
        }
        echo html::a(inlink('delete', "threadID=$thread->id"), '<i class="icon-trash"></i> ' . $lang->delete, "class='deleter text-muted'") . ' &nbsp; ';
        echo html::a(inlink('transfer',   "threadID=$thread->id"), '<i class="icon-location-arrow"></i> ' . $lang->thread->transfer, "data-toggle='modal' class='text-muted'") . ' &nbsp; ';
        ?>
        <?php endif;?>
        <?php if($this->thread->canManage($board->id, $thread->author)) echo html::a(inlink('edit', "threadID=$thread->id"), '<i class="icon-pencil"></i> ' . $lang->edit, 'data-toggle="modal" class="text-muted"'); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if($thread->readonly):?>
  <div class='alert bg-primary-pale text-primary'><?php echo $lang->thread->readonlyMessage;?></div>
  <?php else: ?>
    <?php if($this->app->user->account == 'guest'): ?>
    <a href="<?php echo $this->createLink('user', 'login', 'referer=' . helper::safe64Encode($this->app->getURI(true))); ?>#reply" class="thread-reply-btn btn primary block"><i class="icon-reply"></i> <?php echo $lang->reply->common;?></a>
    <?php else:?>
    <a href='#replyDialog' data-toggle='modal' class='thread-reply-btn btn primary block'><i class='icon-reply'></i> <?php echo $lang->reply->common;?></a>
    <?php endif;?>
  <?php endif;?>
</div>
