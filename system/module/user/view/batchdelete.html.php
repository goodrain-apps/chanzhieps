<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->user->deleteHistory;?></strong></div>
  <form id='ajaxForm' method='post' action="<?php echo inlink('batchDelete');?>">
    <table class='table table-hover table-striped text-center' id='batchForm'>
      <thead>
        <tr class='text-center'>
          <th><?php echo $lang->user->realname;?></th>
          <th><?php echo $lang->user->account;?></th>
          <th><?php echo $lang->user->threadHistory;?></th>
          <th><?php echo $lang->user->replyHistory;?></th>
          <th><?php echo $lang->user->submittionHistory;?></th>
          <th><?php echo $lang->user->commentHistory;?></th>
          <th><?php echo $lang->user->messageHistory;?></th>
          <th><?php echo $lang->user->orderHistory;?></th>
          <th><?php echo $lang->user->addressHistory;?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($userHistory as $account => $history):?>
      <tr>
        <td><?php echo $users[$account];?></td>
        <td><?php echo $account;?></td>
        <td><span class='<?php echo $history->thread ? 'warning' : '';?>'><?php echo $history->thread;?></span></td>
        <td><span class='<?php echo $history->reply ? 'warning' : '';?>'><?php echo $history->reply;?></span></td>
        <td><span class='<?php echo $history->submittion ? 'warning' : '';?>'><?php echo $history->submittion;?></span></td>
        <td><span class='<?php echo $history->comment ? 'warning' : '';?>'><?php echo $history->comment;?></span></td>
        <td><span class='<?php echo $history->message ? 'warning' : '';?>'><?php echo $history->message;?></span></td>
        <td><span class='<?php echo $history->order ? 'warning' : '';?>'><?php echo $history->order;?></span></td>
        <td><span class='<?php echo $history->address ? 'warning' : '';?>'><?php echo $history->address;?></span></td>
      </tr>
      <?php endforeach;?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan='9'>
          <div style='float:left'>
          <?php echo $lang->guarder->password;?>
          <?php echo html::password('password', '', "placeholder='{$lang->guarder->passwordHolder}'");?>
          <?php echo html::a('javascript:;', $lang->delete, "class='btn btn-primary submit'");?>
          <?php echo html::hidden('users', implode(',', array_keys($userHistory)));?>
          </div>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
