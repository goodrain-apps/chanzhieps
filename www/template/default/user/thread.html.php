<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-share'></i> <?php echo $lang->user->thread;?></strong></div>
        <table class='table table-hover'>
          <thead>
            <tr class='text-center hidden-xxxs'>
              <th><?php echo $lang->thread->title;?></th>
              <th class='hidden-xxs'><?php echo $lang->thread->postedDate;?></th>
              <?php if(isset($this->config->forum) and zget($this->config->forum, 'postReview', '') == 'open'):?>
              <th class='hidden-xxxs'><?php echo $lang->thread->status;?></th>
              <?php endif;?>
              <th class='hidden-xs'><?php echo $lang->thread->views;?></th>
              <th class='hidden-xxxs'><?php echo $lang->thread->replies;?></th>
              <th colspan='2' class='hidden-xxs'><?php echo $lang->thread->lastReply;?></th>
            </tr>  
          </thead>
          <tbody>
            <?php foreach($threads as $thread):?>
            <tr class='text-center'>
              <td class='text-left'><?php echo html::a($this->createLink('thread', 'view', "id=$thread->id"), $thread->title, "target='_blank'");?></td>
              <td class='w-120px hidden-xxs'><?php echo substr($thread->addedDate, 2, -3);?></td>
              <?php if(isset($this->config->forum->postReview) and $this->config->forum->postReview == 'open'):?>
              <td>
                <span class="<?php echo $thread->status == 'approved' ? 'text-success' : ''?>">
                  <?php echo zget($lang->thread->statusList, $thread->status);?>
                </span>
              </td>
              <?php endif;?>
              <td class='w-50px hidden-xs'><?php echo $thread->views;?></td>
              <td class='w-50px hidden-xxxs'><?php echo $thread->replies;?></td>
              <td class='w-200px text-left hidden-xxs'><?php if($thread->replies) echo substr($thread->repliedDate, 2, -3) . ' ' . $thread->repliedByRealname;?></td>  
            </tr>  
            <?php endforeach;?>
          </tbody>
          <tfoot><tr><td colspan='7'><?php $pager->show('right', 'short');?></td></tr></tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
