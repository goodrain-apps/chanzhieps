<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit mail view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-edit'></i> <?php echo $lang->user->setEmail;?></h5>
    </div>
    <div class='modal-body'>
      <form id='editMailForm' method='post' action="<?php echo inlink('setemail');?>">
        <div class='form-group'>
          <label for='oldPwd' class='control-label'><?php echo $lang->user->password;?></label>
          <?php echo html::password('oldPwd', '', "class='form-control' placeholder='{$lang->user->placeholder->password}'");?>
        </div>
        <?php if($user->email != ''):?>
        <div class='form-group'>
          <label for='captcha' class='control-label'><?php echo $lang->user->captcha;?></label>
          <?php echo html::input('captcha', '', "class='form-control' placeholder='{$lang->user->placeholder->verifyCode}'");?>
          <?php echo html::a($this->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn default'");?>
        </div>
        <?php endif;?>
        <div class='form-group'>
          <label for='email' class='control-label'><?php echo $lang->user->newEmail;?></label>
          <?php echo html::input('email', '', "class='form-control'");?>
        </div>
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
    var $editMailForm = $('#editMailForm');
    $editMailForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
        }
    }});
});
</script>
