<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>
<?php 
$from  = $this->session->user->account == 'guest' ? '' : $this->session->user->realname;
$email = $this->session->user->account == 'guest' ? '' : $this->session->user->email; 
?>
<form id='replyForm' method='post' action="<?php echo inlink('reply', "messageID={$message->id}");?>">
  <table class='table table-form'>
    <tr>
      <th class='w-60px'><?php echo $lang->message->from;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('from', $from, "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->message->email;?></th>
      <td><?php echo html::input('email', $email, "class='form-control'"); ?></td>
    </tr>
    <tr>
      <th><?php echo $lang->message->content;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::textarea('content', '', "class='form-control' rows='5'");?>
      </td>
    </tr>
    <?php if(zget($this->config->site, 'captcha', 'auto') == 'open'):?>
    <tr id='captchaBox'><?php echo $this->loadModel('guarder')->create4MessageReply();?></tr>
    <?php else:?>
    <tr id='captchaBox' class='hiding'></tr>
   <?php endif;?>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php if($config->debug) js::import($jsRoot . 'jquery/form/min.js');?>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<?php include TPL_ROOT . 'common/log.html.php';?>
</body>
</html>
