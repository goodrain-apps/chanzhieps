<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php'; ?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-comments-alt"></i> <?php echo $lang->forum->threadList;?></strong>
    <div class='panel-actions'>
      <form method='get' class='form-inline form-search'>
        <?php echo html::hidden('m', 'forum');?>
        <?php echo html::hidden('f', 'admin');?>
        <?php echo html::hidden('boardID', $boardID);?>
        <?php echo html::hidden('orderBy', $orderBy);?>
        <?php echo html::hidden('recTotal', isset($this->get->recTotal) ? $this->get->recTotal : 0);?>
        <?php echo html::hidden('recPerPage', isset($this->get->recPerPage) ? $this->get->recPerPage : 10);?>
        <?php echo html::hidden('pageID', isset($this->get->pageID) ? $this->get->pageID :  1);?>
        <div class="input-group">
          <?php echo html::input('searchWord', $this->get->searchWord, "class='form-control search-query'");?>
          <span class="input-group-btn"><?php echo html::submitButton($lang->search->common, "btn btn-primary"); ?></span>
        </div>
      </form>
    </div>
  </div>
  <table class='table table-hover table-striped tablesorter' id='threadList'>
    <?php if($threads):?>
    <thead>
      <tr class='text-center'>
        <?php $vars = "boardID=$boardID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='text-center w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->thread->id);?></th>
        <th><?php echo $lang->thread->title;?></th>
        <th><?php commonModel::printOrderLink('author', $orderBy, $vars, $lang->thread->author);?></th>
        <th class='w-110px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->thread->postedDate);?></th>
        <th class='w-70px'><?php commonModel::printOrderLink('views', $orderBy, $vars, $lang->thread->views);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('replies', $orderBy, $vars, $lang->thread->replies);?></th>
        <th class='w-150px'><?php commonModel::printOrderLink('repliedDate', $orderBy, $vars, $lang->thread->lastReply);?></th>
        <?php if($this->config->forum->postReview == 'open'):?>
        <th class='w-80px'> <?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->thread->status);?></th>
        <?php endif;?>
        <th class='w-80px'><?php commonModel::printOrderLink('hidden', $orderBy, $vars, $lang->thread->display);?></th>
        <th class='w-180px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <?php endif;?>
    <tbody>
      <?php foreach($threads as $thread):?>
      <tr class='text-center'>
        <td><?php echo $thread->id;?></td>
        <td class='title text-left'>
          <?php echo html::a(commonModel::createFrontLink('thread', 'view', "threadID=$thread->id"), $thread->title, "target='_blank' title='{$thread->title}'"); ?>
        </td>
        <td><?php echo $thread->authorRealname;?></td>
        <td><?php echo substr($thread->addedDate, 5, -3);?></td>
        <td><?php echo $thread->views;?></td>
        <td><?php echo $thread->replies;?></td>
        <td class='text-left'><?php if($thread->replies) echo substr($thread->repliedDate, 5, -3) . ' ' . $thread->repliedByRealname;?></td>
        <?php if($this->config->forum->postReview == 'open'):?>
        <td>
          <span class="<?php echo $thread->status == 'approved' ? 'text-success' : 'text-warning'?>">
            <?php echo zget($lang->thread->statusList, $thread->status);?>
          </span>
        </td>
        <?php endif;?>
        <td><?php if($thread->status != 'wait')echo $thread->hidden ? '<span class="text-warning"><i class="icon-eye-close"></i> ' . $lang->thread->displayList['hidden'] .'</span>' : '<span class="text-success"><i class="icon-ok-sign"></i> ' . $lang->thread->displayList['normal'] . '</span>';?></td>
        <td>
          <?php
          if($this->config->forum->postReview == 'open' and $thread->status == 'wait')
          {
              commonmodel::printlink('thread', 'approve', "threadid=$thread->id&boardid=$thread->board", $lang->thread->approve, "class='reload'");
          }
          else
          {
              echo html::a('javascript:;', $lang->thread->approve, "class='disabled'");
          }
          $text = $thread->hidden ? $lang->thread->show : $lang->thread->hide;
          if($thread->status != 'wait')
          {
              commonModel::printLink('thread', 'switchStatus', "threadID=$thread->id", $text, "class='reload'");
              commonModel::printLink('thread', 'transfer', "threadID=$thread->id", $lang->thread->transfer, "data-toggle='modal'");
          }
          else
          {
              echo html::a('javascript:;', $text, "class='disabled'");
              echo html::a('javascript:;', $lang->thread->transfer, "class='disabled'");
          }
          commonModel::printLink('thread', 'delete', "threadID=$thread->id", $lang->delete, "class='deleter'");
          commonModel::printLink('guarder', 'addToBlacklist', "type=thread&id=$thread->id", $lang->addToBlacklist, "data-toggle='modal'");
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='12'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php'; ?>
