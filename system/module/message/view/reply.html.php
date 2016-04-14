<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='replyForm' method='post' action="<?php echo inlink('reply', "messageID={$message->id}");?>">
  <div class='alert alert-info reply-alert'><?php echo $message->content;?></div>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->message->from;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('from', $app->user->realname, "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->message->content;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::textarea('content', '', "class='form-control' rows='5'");?>
      </td>
    </tr>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
