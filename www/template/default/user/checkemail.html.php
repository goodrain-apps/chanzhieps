<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='panel panel-body'>
  <div class='panel panel-pure' id='checkEmail'>
    <div class='panel-heading'><strong><?php echo $lang->user->checkEmail;?></strong></div>
    <div class='panel-body'>
      <form method='post' action='<?php echo inlink('checkEmail');?>' id='ajaxForm'>
        <table class='table table-form'>
          <tr>
            <th><?php echo $lang->user->email;?></th>
            <td><?php echo html::input('email', $user->email, "class='form-control'");?></td>
            <td><?php echo html::a($this->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn btn-xs'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->user->captcha;?></th>
            <td><?php echo html::input('captcha', '', "class='form-control'");?></td>
          </tr>
          <tr>
            <th></th>
            <td><?php echo html::submitButton() . html::hidden('referer', $referer);?></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
