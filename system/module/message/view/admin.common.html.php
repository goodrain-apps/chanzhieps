<?php if(!defined("RUN_MODE")) die();?>
<table class='table table-borderless w-p100'>
  <?php $original = $this->message->getOriginal($messageID);?>
  <?php if($original):?>
  <tr class='original'>
    <?php if($original->type != 'message'):?>
    <td>
      <?php
      $config->requestType = $config->frontRequestType;

      if(!empty($original->objectTitle))
      {
          $objectViewLink = html::a($original->objectViewURL, $original->objectTitle, "target='_blank'");
      }
      else
      {
          $objectViewLink = "<span class='alert-error'>{$lang->comment->deletedObject}</span>";
      }

      $commentTo = $original->type == 'reply' ? $lang->message->reply : $lang->comment->commentTo;

      $config->requestType = 'GET';
      echo <<<EOT
      <i class='icon-user'></i> <strong>$original->from</strong> &nbsp; <i class='icon-envelope green icon'></i> $message->email &nbsp; 
      <span class='gray'>$original->date</span> &nbsp; $commentTo $objectViewLink
EOT;
      ?>
    </td>
    <?php else:?>
    <td>
      <?php echo "<i class='icon-user'></i> <strong>{$original->from}</strong> &nbsp;";?>
      <?php echo "<span class='gray'>$original->date</span>";?>
      <?php if(!empty($original->link))  echo html::a($original->link, $original->link, "target='_blank'");?>
      <br/>
      <?php if(!empty($original->phone)) echo "<i class='icon-phone text-info icon'></i> {$original->phone} &nbsp; ";?>
      <?php if(!empty($original->email)) echo "<i class='icon-envelope text-warning icon'></i> {$original->email} &nbsp; ";?>
      <?php if(!empty($original->qq))    echo "<strong class='text-danger'>QQ</strong> {$original->qq} &nbsp; ";?>
    </td>
    <?php endif;?>
  </tr>
  <tr class='original'>
    <td class='content-box'>
      <textarea name="" id="" rows="2" class="form-control borderless" spellcheck="false"><?php echo $original->content;?></textarea>
    </td>
  </tr>
  <?php endif;?>
  <tr <?php if($original) echo 'class="separator"';?>>
    <?php if($message->type != 'message'):?>
    <td>
      <?php 
      $config->requestType = $config->frontRequestType;

      if(!empty($message->objectTitle))
      {
          $objectViewLink = html::a($message->objectViewURL, $message->objectTitle, "target='_blank'");
      }
      else
      {
          $objectViewLink = "<span class='alert-error'>{$lang->comment->deletedObject}</span>";
      }

      $commentTo = $message->type == 'reply' ? $lang->message->reply : $lang->comment->commentTo;

      $config->requestType = 'GET';
      echo <<<EOT
      <i class='icon-user'></i> <strong>$message->from</strong> &nbsp; <i class='icon-envelope green icon'></i> $message->email &nbsp; 
      <span class='gray'>$message->date</span> &nbsp; $commentTo $objectViewLink
EOT;
      ?>
    </td>
    <?php else:?>
    <td>
      <?php echo "<i class='icon-user'></i> <strong>{$message->from}</strong> &nbsp;";?>
      <?php echo "<span class='gray'>$message->date</span>";?>
      <?php if(!empty($message->link))  echo html::a($message->link, $message->link, "target='_blank'");?>
      <br/>
      <?php if(!empty($message->phone)) echo "<i class='icon-phone text-info icon'></i> {$message->phone} &nbsp; ";?>
      <?php if(!empty($message->email)) echo "<i class='icon-envelope text-warning icon'></i> {$message->email} &nbsp; ";?>
      <?php if(!empty($message->qq))    echo "<strong class='text-danger'>QQ</strong> {$message->qq} &nbsp; ";?>
    </td>
    <?php endif;?>
  </tr>
  <tr>
    <td class='content-box'>
      <textarea name="" id="" rows="2" class="form-control borderless" spellcheck="false"><?php echo $message->content;?></textarea>
    </td>
  </tr>
</table>
