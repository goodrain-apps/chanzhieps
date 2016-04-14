<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-envelope'></i> <?php echo $lang->mail->common;?> <i class='icon-arrow-right'></i> <?php echo $lang->mail->detect; ?></strong></div>
  <div class='panel-body'>
    <form method='post' id='dataform'>
      <div class='form-group'><label for='fromAddress' class='col-sm-12'><?php echo $lang->mail->inputFromEmail; ?></label></div>
      <div class='form-group'>
        <div class='col-xs-10 col-sm-6 col-md-3'><?php echo html::input('fromAddress', $fromAddress, "class='form-control'"); ?></div>
        <div class='col-xs-2 col-sm-6 col-md-3'><?php echo html::submitButton($lang->mail->nextStep); ?></div>
      </div>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
