<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-envelope'></i> <?php echo $lang->mail->common;?> <i class='icon-arrow-right'></i> <?php echo $lang->mail->test; ?></strong></div>
  <div class='panel-body'>
    <form method='post' id='mailForm'>
      <div class='form-group'><label for='to' class='col-sm-12'><?php echo $lang->mail->inputFromEmail; ?></label></div>
      <div class='form-group'>
        <div class='col-xs-10 col-sm-6 col-md-3'><?php echo html::input('to', $app->user->email, 'class="form-control"'); ?></div>
        <div class='col-xs-2 col-sm-6 col-md-3'><?php echo html::submitButton($lang->mail->test) . html::linkButton($lang->mail->edit, inLink('edit')); ?></div>
      </div>
    </form>
  </div>
  <div class='hidden panel-notice'><div id='result'></div></div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
