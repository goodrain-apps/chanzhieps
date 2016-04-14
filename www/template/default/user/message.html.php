<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <?php include TPL_ROOT . 'user/side.html.php';?>
  <div class='col-md-10'>
    <form id='ajaxForm' method='post' target='hiddenwin' action="<?php echo $this->createLink('message', 'batchDelete');?>">
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-comments-alt'></i> <?php echo $lang->user->messages;?></strong></div>
        <table class='table table-bordered table-hover' id='messages'>
          <thead>
            <tr class='text-center hidden-xxxs'>
              <th class='w-10px'><input type='checkbox' id='selectAll'></th>
              <th class='w-80px hidden-xxxs'><?php echo $lang->message->from;?></th>
              <th class='w-150px hidden-xxs'><?php echo $lang->message->date;?></th>
              <th><?php echo $lang->message->content;?></th>
              <th class='w-60px hidden-xs'><?php echo $lang->message->readed;?></th>
              <th class='w-80px hidden-xxs'><?php echo $lang->actions;?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($messages as $message):?>
            <tr class='text-center'>
              <td><input type='checkbox' name='messages[]' value="<?php echo $message->id?>" /></td>
              <td class='hidden-xxxs'><?php echo $message->from;?></td>
              <td class='hidden-xxs'><?php echo substr($message->date, 5);?></td>
              <td class='text-left break-all'><?php echo $message->content;?></td>
              <td class='hidden-xs'><?php echo $lang->message->readedStatus[$message->readed];?></td>
              <?php if(!$message->readed):?>
              <td class='hidden-xxs'><?php echo html::a($this->createLink('message', 'view', "message=$message->id"), $message->link ? $lang->message->view : $lang->message->readed);?></td>
              <?php else:?>
              <td class='hidden-xxs'><?php echo $message->link ? html::a($this->createLink('message', 'view', "message=$message->id"), $lang->message->view) : $lang->message->readed;?></td>
              <?php endif;?>
            </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan='6'>
                <?php
                if($messages) echo html::submitButton($lang->message->deleteSelected);
                $pager->show();
                ?>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
