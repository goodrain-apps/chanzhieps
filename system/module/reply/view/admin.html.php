<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php'; ?>
<div class='panel'>
  <div class='panel-heading'>
  <div class='panel-actions'>
      <form method='get' class='form-inline form-search'>
        <?php echo html::hidden('m', 'reply');?>
        <?php echo html::hidden('f', 'admin');?>
        <?php echo html::hidden('orderBy', 'addedDate_desc');?>
        <?php echo html::hidden('recTotal', isset($this->get->recTotal) ? $this->get->recTotal : 0);?>
        <?php echo html::hidden('recPerPage', isset($this->get->recPerPage) ? $this->get->recPerPage : 20);?>
        <?php echo html::hidden('pageID', isset($this->get->pageID) ? $this->get->pageID :  1);?>
        <div class="input-group">
          <?php echo html::input('searchWord', $this->get->searchWord, "class='form-control search-query'");?>
          <span class="input-group-btn"><?php echo html::submitButton($lang->search->common, "btn btn-primary"); ?></span>
        </div>
      </form>
    </div>
  <strong><i class='icon-comments'></i> <?php echo $lang->reply->list;?></strong></div>
  <table class='table table-hover table-bordered table-striped' id='replyList'>
    <thead>
      <tr class='text-center'>
        <th class='w-80px'><?php echo $lang->reply->id;?></th>
        <th><?php echo $lang->reply->content;?></th>
        <th class='w-120px'><?php echo $lang->reply->author;?></th>
        <th class='w-100px'><?php echo $lang->reply->addedDate;?></th>
        <th class='w-80px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($replies as $reply):?>
      <tr class='text-center'>
        <td><?php echo $reply->id;?></td>
        <td class='text-left relpy-content'>
          <?php 
          echo html::a(commonModel::createFrontLink('thread', 'locate', "threadID={$reply->thread}&replyID={$reply->id}"), $reply->content, "target=_blank");
          ?>
        </td>
        <td><?php echo $reply->authorRealname;?></td>
        <td><?php echo substr($reply->addedDate, 5, -3);?></td>
        <td>
          <?php commonModel::printLink('reply', 'delete', "replyID=$reply->id", $lang->delete, "class='deleter'"); ?>
          <?php commonModel::printLink('guarder', 'addToBlacklist', "type=reply&id=$reply->id", $lang->addToBlacklist, "data-toggle='modal'"); ?>
        </td>
      </tr>  
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php'; ?>
