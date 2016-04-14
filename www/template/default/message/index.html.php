<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The index view file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::set('showDetail', $this->lang->message->showDetail);?>
<?php js::set('hideDetail', $this->lang->message->hideDetail);?>
<?php $common->printPositionBar();?>
<div class='row blocks' data-region='message_index-topBanner'><?php $this->block->printRegion($layouts, 'message_index', 'topBanner', true);?></div>
<div class='row'>
  <div class='col-md-9 col-main'>
    <div class='row blocks' data-region='message_index-top'><?php $this->block->printRegion($layouts, 'message_index', 'top', true);?></div>
    <?php if(!empty($messages)):?>
    <?php $class = 'success';?>
    <?php foreach($messages as $number => $message):?>
    <?php $class = $class == 'success' ? '' : 'success';?>
    <div class='w-p100 panel comment-item' id="comment<?php echo $message->id?>">
      <div class='panel-heading content-heading'>
        <i class='icon icon-user'> <?php echo $message->from;?></i>
        <i class='text-muted'> <?php echo $message->date;?></i>
        <?php echo html::a($this->createLink('message', 'reply', "messageID=$message->id"), "<i class='icon icon-reply text-info'> </i>", "class='pull-right' data-toggle='modal' data-type='iframe' data-icon='reply' data-title='{$lang->message->reply}'");?>
      </div>
      <div class='panel-body'><?php echo nl2br($message->content);?></div>
      <?php $this->message->getFrontReplies($message);?>
    </div>
    <?php endforeach; ?>
    <?php endif;?>
    <div class='text-right'><div class='pager clearfix'><?php $pager->show('right', 'short');?></div></div>
    <div class='panel panel-form'>
      <div class='panel-heading'><strong><i class='icon-comment-alt'></i> <?php echo $lang->message->post;?></strong></div>
      <div class='panel-body'>
        <form method='post' class='form-horizontal' id='commentForm' action="<?php echo $this->createLink('message', 'post', 'type=message');?>">
          <?php
          $from  = $this->session->user->account == 'guest' ? '' : $this->session->user->realname;
          $phone = $this->session->user->account == 'guest' ? '' : $this->session->user->phone;
          $qq    = $this->session->user->account == 'guest' ? '' : $this->session->user->qq;
          $email = $this->session->user->account == 'guest' ? '' : $this->session->user->email;
          ?>
          <div class='form-group'>
            <label for='from' class='col-sm-1 control-label'><?php echo $lang->message->from; ?></label>
            <div class='col-sm-5 required'>
              <?php echo html::input('from', $from, "class='form-control'"); ?>
            </div>
          </div>
          <div class='form-group'>
            <label for='phone' class='col-sm-1 control-label'><?php echo $lang->message->phone; ?></label>
            <div class='col-sm-5'>
              <?php echo html::input('phone', $phone, "class='form-control'"); ?>
            </div>
            <div class='col-sm-6'><div class='help-block'><small class='text-important'><?php echo $lang->message->contactHidden;?></small></div></div>
          </div>
          <div class='form-group'>
            <label for='qq' class='col-sm-1 control-label'><?php echo $lang->message->qq;?></label>
             <div class='col-sm-5'>
              <?php echo html::input('qq', $qq, "class='form-control'"); ?>
            </div>
          </div>
          <div class='form-group'>
            <label for='email' class='col-sm-1 control-label'><?php echo $lang->message->email;?></label>
            <div class='col-sm-5'>
              <?php echo html::input('email', '', "class='form-control'");?>
            </div>
            <div class='col-sm-5'>
              <label class='checkbox'><input type='checkbox' name='receiveEmail' value='1' checked /> <?php echo $lang->comment->receiveEmail; ?></label>
            </div>
          </div>
          <div class='form-group'>
            <label for='content' class='col-sm-1 control-label'><?php echo $lang->message->content;?></label>
            <div class='col-sm-11 required'>
              <?php
                echo html::textarea('content', '', "class='form-control' rows='3'");
                echo html::hidden('objectType', 'message');
                echo html::hidden('objectID', 0);
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
            <div class='col-sm-1'></div>
            <div class='col-sm-11'><label class='checkbox'><input type='checkbox' name='secret' value='1' /><?php echo $lang->message->secret;?></label></div>
          </div>
          <div class='form-group'>
            <div class='col-sm-1'></div>
            <div class='col-sm-11 col-sm-offset-1'>
              <span><?php echo html::submitButton();?></span>
              <span><small class="text-important"><?php echo $lang->message->needCheck;?></small></span>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class='row blocks' data-region='message_index-bottom'><?php $this->block->printRegion($layouts, 'message_index', 'bottom', true);?></div>
  </div>
  <div class='col-md-3 col-side'>
    <div class='nav'>
    <a href='#commentForm' class='btn btn-primary btn-lg w-p100'><i class='icon-comment-alt'></i> <?php echo $lang->message->post; ?></a>
    </div>
    <side class='blocks' data-region='message_index-side'><?php $this->block->printRegion($layouts, 'message_index', 'side');?></side>
  </div>
</div>
<div class='row blocks' data-region='message_index-bottomBanner'><?php $this->block->printRegion($layouts, 'message_index', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
