<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin view file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('type', $type);?>
<div class="panel">
  <div class="panel-heading">
    <ul id='typeNav' class='nav nav-tabs'>
      <li data-type='internal' <?php echo $status == 0 ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "type={$type}&status=0"), $lang->message->statusList[0]);?>
      </li>
      <li data-type='internal' <?php echo $status == 1 ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "type={$type}&status=1"), $lang->message->statusList[1]);?>
      </li>
    </ul> 
  </div>
  <div class='panel-body'>
    <?php foreach($messages as $messageID => $message):?>
    <div class='message w-p100'>
      <div class='message-id'><?php echo $messageID;?></div>
      <?php
      if($type != 'message')
      {
          include 'admin.common.html.php';
      }
      else
      {
          include 'admin.message.html.php';
      }
      ?>
      <div class='message-action'>
        <?php
        commonModel::printLink('message', 'reply', "messageID=$message->id", $lang->message->reply, "data-toggle='modal'");
        commonModel::printLink('guarder', 'addToBlacklist', "type=message&id={$message->id}", $lang->addToBlacklist, "data-toggle='modal'");
        echo '<br />';
        if($status == 0) commonModel::printLink('message', 'pass', "messageID=$message->id&type=single", $lang->message->pass, "class='pass'");
        if($status == 0) commonModel::printLink('message', 'pass', "messageID=$message->id&type=pre", $lang->message->passPre, "class='pre' data-confirm='{$lang->message->confirmPassPre}'");
        echo '<br />';
        commonModel::printLink('message', 'delete', "messageID=$message->id&type=single&status=$status", $lang->message->delete, "class='deleter'");
        if($status == 0) commonModel::printLink('message', 'delete', "messageID=$message->id&type=pre&status=$status", $lang->message->deletePre, "class='pre' data-confirm='{$lang->message->confirmDeletePre}'");
        ?>
      </div>
    </div>
    <?php endforeach;?>
    <?php $pager->show();?>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
