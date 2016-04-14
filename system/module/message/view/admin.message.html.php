<?php if(!defined("RUN_MODE")) die();?>
<table class='table table-borderless w-p100'>
  <tr class='original'>
    <td>
      <?php echo "<i class='icon-user'></i> <strong>{$message->from}</strong> &nbsp;";?>
      <?php echo "<span class='gray'>$message->date</span>";?>
      <?php if(!empty($message->link))  echo html::a($message->link, $message->link, "target='_blank'");?>
      <br/>
      <?php if(!empty($message->phone)) echo "<i class='icon-phone text-info icon'></i> {$message->phone} &nbsp; ";?>
      <?php if(!empty($message->email)) echo "<i class='icon-envelope text-warning icon'></i> {$message->email} &nbsp; ";?>
      <?php if(!empty($message->qq))    echo "<strong class='text-danger'>QQ</strong> {$message->qq} &nbsp; ";?>
    </td>
  </tr>
  <tr class='original'>
    <td class='content-box'>
      <textarea name="" id="" rows="2" class="form-control borderless" spellcheck="false"><?php echo $message->content;?></textarea>
    </td>
  </tr>
  <?php $reply = $this->message->getReply($messageID);?>
  <?php if($reply):?>
  <tr class='separator'>
    <?php if($reply->type != 'message'):?>
    <td>
      <?php
      $config->requestType = $config->frontRequestType;

      $config->requestType = 'GET';
      echo <<<EOT
      <i class='icon-user'></i> <strong>$reply->from</strong> &nbsp; <i class='icon-envelope green icon'></i> $message->email &nbsp; 
      <span class='gray'>$reply->date</span>
EOT;
      ?>
    </td>
    <?php else:?>
    <td>
      <?php echo "<i class='icon-user'></i> <strong>{$reply->from}</strong> &nbsp;";?>
      <?php echo "<span class='gray'>$reply->date</span>";?>
      <?php if(!empty($reply->link))  echo html::a($reply->link, $reply->link, "target='_blank'");?>
      <br/>
      <?php if(!empty($reply->phone)) echo "<i class='icon-phone text-info icon'></i> {$reply->phone} &nbsp; ";?>
      <?php if(!empty($reply->email)) echo "<i class='icon-envelope text-warning icon'></i> {$reply->email} &nbsp; ";?>
      <?php if(!empty($reply->qq))    echo "<strong class='text-danger'>QQ</strong> {$reply->qq} &nbsp; ";?>
    </td>
    <?php endif;?>
  </tr>
  <tr>
    <td class='content-box'>
      <textarea name="" id="" rows="2" class="form-control borderless" spellcheck="false"><?php echo $reply->content;?></textarea>
    </td>
  </tr>
  <?php endif;?>
</table>
