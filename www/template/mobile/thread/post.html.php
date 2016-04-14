<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The post view file of thread for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php $isRequestModal = helper::isAjaxRequest();?>
<?php if($isRequestModal):?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-pencil'></i> <?php echo $lang->thread->postTo . ' [ ' . $board->name . ' ]'; ?></h5>
    </div>
    <div class='modal-body'>
<?php else: ?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<hr class='space'>
<div class='panel-section'>
  <div class='panel-heading'>
    <strong><i class='icon-pencil'></i> <?php echo $lang->thread->postTo . ' [ ' . $board->name . ' ]'; ?></strong>
  </div>
  <div class='panel-body'>
<?php endif;?>
<form id='postThreadForm' method='post' action='<?php echo $this->createLink('thread', 'post', "boardID=$board->id");?>'>
  <div class='form-group'>
    <?php echo html::input($titleInput, '', "class='form-control' placeholder='{$lang->thread->title}'");?>
  </div>
  <div class='form-group'>
    <?php echo html::textarea($contentInput, '', "class='form-control' rows='15' placeholder='{$lang->thread->content}'");?>
  </div>
  <?php if($this->loadModel('file')->canUpload()):?>
  <?php // TODO: support upload files ?>
  <?php endif;?>
  <?php if($canManage):?>
  <div class='form-group'>
    <div class="checkbox">
      <label>
        <?php echo "<input type='checkbox' name='readonly' value='1'/><span>{$lang->thread->readonly}</span>" ?>
      </label>
    </div>
  </div>
  <?php endif;?>
  <table style='width: 100%'>
    <tr class='hide captcha-box'></tr>
  </table>
  <div class='form-group'>
    <?php echo html::submitButton('', 'btn primary block');?>
  </div>
</form>
<?php if($isRequestModal):?>
</div><?php // end of modal-body ?>
  </div><?php // end of modal-content ?>
</div><?php // end of modal-dialog ?>
<?php else: ?>
  </div><?php // end of panel-body ?>
</div><?php // end of panel-section ?>
<?php include TPL_ROOT . 'common/form.html.php';?>
<?php endif;?>
<script>
$(function()
{
    var $postThreadForm = $('#postThreadForm');
    $postThreadForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
        }
        if(response.reason == 'needChecking')
        {
            $postThreadForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    }});
});
</script>
