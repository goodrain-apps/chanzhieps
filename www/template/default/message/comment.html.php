<?php if(!defined("RUN_MODE")) die();?>
<?php
js::set('objectType', $objectType);
js::set('objectID',   $objectID);
js::set('showDetail',$showDetail);
js::set('hideDetail', $hideDetail);
if(isset($pageCSS)) css::internal($pageCSS);
?>
<?php if(isset($comments) and $comments):?>
<div class='panel mgb-0'>
  <div class='panel-heading'>
    <div class='panel-actions'><a href='#commentForm' class='btn btn-primary'><i class='icon-comment-alt'></i> <?php echo $lang->message->post; ?></a></div>
    <strong><?php echo $lang->message->list;?></strong>
  </div>
  <div class='comment-container'>
    <?php $i = 0;?>
    <?php foreach($comments as $number => $comment):?>
    <div class='w-p100 panel comment-item' id="comment<?php echo $comment->id?>">
      <div class='panel-heading content-heading'>
        <i class='icon icon-user'> <?php echo $comment->from;?></i>
        <i class='text-muted'> <?php echo $comment->date;?></i>
        <?php echo html::a($this->createLink('message', 'reply', "commentID=$comment->id"), "<i class='icon icon-reply text-info'> </i>", "class='pull-right' data-toggle='modal' data-type='iframe' data-icon='reply' data-title='{$lang->comment->reply}'");?>
      </div>
      <div class='panel-body'><?php echo nl2br($comment->content);?></div>
      <?php $this->message->getFrontReplies($comment);?>
    </div>
    <?php endforeach;?>
    <div class='text-right'>
      <div class='pager clearfix' id='pager'><?php $pager->show('right', 'shortest');?></div>
    </div>
    <?php endif;?>
  </div>
</div>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-comment-alt'></i> <?php echo $lang->message->post;?></strong></div>
  <div class='panel-body'>
    <form method='post' class='form-horizontal' id='commentForm' action="<?php echo $this->createLink('message', 'post', 'type=comment');?>">
      <?php if($this->session->user->account == 'guest'): ?>
      <div class='form-group'>
        <label for='from' class='col-sm-1 control-label'><?php echo $lang->message->from; ?></label>
        <div class='col-sm-5 required'>
          <?php echo html::input('from', '', "class='form-control'"); ?>
        </div>
      </div>
      <div class='form-group'>
        <label for='email' class='col-sm-1 control-label'><?php echo $lang->message->email; ?></label>
        <div class='col-sm-5'>
          <?php echo html::input('email', '', "class='form-control'"); ?>
        </div>
        <div class='col-sm-5'>
          <div class='checkbox'>
            <label><input type='checkbox' name='receiveEmail' value='1' checked /> <?php echo $lang->comment->receiveEmail; ?></label>
          </div>
        </div>
      </div>
      <?php else: ?>
      <div class='form-group'>
        <label for='from' class='col-sm-1 control-label'><?php echo $lang->message->from; ?></label>
        <div class='col-sm-11'>
          <span class='signed-user-info'>
            <i class='icon-user text-muted'></i> <strong><?php echo $this->session->user->realname ;?></strong>
            <?php echo html::hidden('from', $this->session->user->realname);?>
            <?php if($this->session->user->email != ''): ?>
            <span class='text-muted'>&nbsp;(<?php echo $this->session->user->email;?>)</span>
            <?php echo html::hidden('email', $this->session->user->email); ?>
            <?php endif; ?>
          </span>
          <label class='checkbox-inline'><input type='checkbox' name='receiveEmail' value='1' checked /> <?php echo $lang->comment->receiveEmail; ?></label>
        </div>
      </div>
      <?php endif; ?>
      <div class='form-group'>
        <label for='content' class='col-sm-1 control-label'><?php echo $lang->message->content; ?></label>
        <div class='col-sm-11 required'>
          <?php
          echo html::textarea('content', '', "class='form-control'");
          echo html::hidden('objectType', $objectType);
          echo html::hidden('objectID', $objectID);
          ?>
        </div>
      </div>
      <?php if(zget($this->config->site, 'captcha', 'auto') == 'open'):?>
      <div class='form-group' id='captchaBox'>
        <?php echo $this->loadModel('guarder')->create4Comment();?>
      </div>
      <?php else:?>
      <div class='form-group hiding' id='captchaBox'></div>
      <?php endif;?>
       <div class='form-group'>
        <div class='col-sm-11 col-sm-offset-1'>
          <span><?php echo html::submitButton('', 'btn btn-primary', 'data-popover-container="false"');?></span>
          <span><small class="text-important"><?php echo $lang->comment->needCheck;?></small></span>
        </div>
      </div>
    </form>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
