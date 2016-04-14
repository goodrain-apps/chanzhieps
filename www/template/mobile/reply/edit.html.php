<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit view file of reply for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     reply
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-pencil'></i> <?php echo $lang->reply->edit;?></h5>
    </div>
    <div class='modal-body'>
      <form id='eidtReplyForm' method='post' action='<?php echo $this->createLink('reply', 'edit', "replyID=$reply->id");?>'>
        <div class='form-group'>
          <?php echo html::textarea('content', $reply->content, "class='form-control' rows='15' placeholder='{$lang->reply->content}'");?>
        </div>
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
<script>
$(function()
{
    var $eidtReplyForm = $('#eidtReplyForm');
    $eidtReplyForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
            if($.isFunction($.refreshRepliesList))
            {
                $.refreshRepliesList();
                response.locate = false;
            }
        }
        if(response.reason == 'needChecking')
        {
            $eidtReplyForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    }});
});
</script>
