<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The reply view file of message for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-reply'></i> <?php echo $lang->message->reply;?></h5>
    </div>
    <div class='modal-body'>
      <form id='replyForm' method='post' action="<?php echo inlink('reply', "messageID={$message->id}");?>">
        <div class='form-group'>
          <?php echo html::textarea('content', '', "class='form-control' rows='5' placeholder='{$lang->message->content}'");?>
        </div>
        <?php if($this->session->user->account == 'guest'): ?>
        <div class="form-group">
          <?php echo html::input('from', '', "class='form-control' placeholder='{$lang->message->from}'");?>
        </div>
        <div class="form-group">
          <?php echo html::input('email', '', "class='form-control' placeholder='{$lang->message->email}'"); ?>
        </div>
        <?php else: ?>
        <div class='form-group'>
          <span class='signed-user-info'>
            <i class='icon-user text-muted'></i> <strong><?php echo $this->session->user->realname ;?></strong>
            <?php echo html::hidden('from', $this->session->user->realname);?>
            <?php if($this->session->user->email != ''): ?>
            <span class='text-muted'>&nbsp;(<?php echo $this->session->user->email;?>)</span>
            <?php echo html::hidden('email', $this->session->user->email); ?>
            <?php endif; ?>
          </span>
        </div>
        <?php endif; ?>
        <table style='width: 100%'>
          <tr class='hide captcha-box'></tr>
        </table>
        <div class='form-group'>
          <?php echo html::submitButton('', 'btn primary block');?>
        </div>
      </form>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<script>
$(function()
{
    var $replyForm = $('#replyForm'),
        $commentBox = $('#commentBox');
    $replyForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
            if($.isFunction($.refreshCommentList))
            {
                setTimeout($.refreshCommentList, 200);
            }
        }
        if(response.reason == 'needChecking')
        {
            $replyForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    }});

    $commentBox.find('.pager').on('click', 'a', function()
    {
        $commentBox.load($(this).attr('href'));
        return false;
    });
});
</script>
