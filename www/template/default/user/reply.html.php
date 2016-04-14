<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-mail-reply'></i> <?php echo $lang->user->reply;?></strong></div>
        <table class='table table-hover'>
          <thead>
            <tr class='text-center'>
              <th><?php echo $lang->thread->common;?></th>
              <th><?php echo $lang->reply->addedDate;?></th>
            </tr>  
          </thead>
          <tbody>
            <?php foreach($replies as $reply):?>
            <tr>
              <td><?php echo html::a($this->createLink('thread', 'view', "id=$reply->thread") . "#$reply->id", $reply->title . " <i>(#$reply->id)</i>", "target='_blank'");?></td>
              <td class='text-center'><?php echo substr($reply->addedDate, 2, -3);?></td>
            </tr>  
            <?php endforeach;?>
          </tbody>
          <tfoot><tr><td colspan='2'><?php $pager->show('right', 'short');?></td></tr></tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
