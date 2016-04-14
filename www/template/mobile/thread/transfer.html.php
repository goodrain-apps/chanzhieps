<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The transfer view file of thread for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon icon-location-arrow'></i> <?php echo $lang->thread->transfer;?></h5>
    </div>
    <div class='modal-body'>
      <form id='threadTransferForm' method='post' action='<?php echo inlink('transfer', "threadID={$thread->id}")?>'>
        <div class='form-group'>
          <label for='targetBoard' class='control-label'><?php echo $lang->thread->board;?></label>
          <?php echo html::select('targetBoard', $boards, '', "class='form-control chosen'");?>
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
    var $threadTransferForm = $('#threadTransferForm');
    $threadTransferForm.ajaxform({onSuccess: function(response)
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
            $threadTransferForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    }});
});
</script>
