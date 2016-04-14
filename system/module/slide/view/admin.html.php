<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin view file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <i class='icon-th'></i> <strong><?php echo $lang->slide->group;?></strong>
    <div class='panel-actions'><?php commonModel::printLink('slide', 'createGroup', '', '<i class="icon-plus-sign"></i> ' . $lang->slide->createGroup, "class='btn btn-primary' data-toggle='modal'");?></div>
  </div>
  <div class='panel-body'>
    <section class='row cards-borderless'>
      <?php foreach($groups as $group):?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <a class='card card-slide' href='<?php echo inLink('browse', "groupID=$group->id") ?>'>
          <?php $count = count($group->slides); ?>
          <?php $slide = $group->slide;?>
          <div class='slides-holder slides-holder-<?php echo min(5, $count);?>'>
            <?php if(!empty($group->slides)): ?>
            <div class='slide-item'>
              <?php if ($slide->backgroundType == 'image'): ?>
              <?php print(html::image($slide->image));?>
              <?php else: ?>
              <div class='plain-slide' style='<?php echo 'background-color: ' . $slide->backgroundColor;?>'></div>
              <?php endif; ?>
              <div class='slides-count'><i class='icon-picture'></i> <?php echo $count; ?></div>
            </div>
            <?php else: ?>
            <div class='empty-holder'>
              <i class='icon-pencil icon-3x icon'></i>
              <div id='toBeAdded'>
                <?php echo $lang->toBeAdded;?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </a>
        <div class='card-heading text-center'>
          <div class='group-title' data-id='<?php echo $group->id;?>' data-action="<?php echo inlink('editGroup', "groupID=$group->id");?>">
            <span class='group-name'><?php echo $group->name;?></span>&nbsp;&nbsp;
            <?php echo html::a(inLink('browse', "groupID=$group->id"), $lang->edit);?>
            <?php echo html::a('javascript:;', $lang->slide->rename, "class='edit-group-btn'");?>
            <?php echo html::a(inlink('removeGroup', "groupID=$group->id"), $lang->delete, "class='deleter'");?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <?php commonModel::printLink('slide', 'createGroup', "", '<div class="slides-holder create-btn"><div class="empty-holder"><i class="icon-plus-sign icon icon-3x"></i> ' . $lang->slide->createGroup . '</div></div>', "class='card card-slide' data-toggle='modal'");?>
      </div>
    </section>
  </div>
</div>
<form id="editGroupForm" class='edit-form' method='post' >
  <div class='editGroup input-group'>
    <?php echo html::input('groupName', $group->name, "class='form-control'");?>
    <span class="input-group-btn fix-border"><?php echo html::submitButton('', 'submit btn btn-primary');?> </span>
    <span class="input-group-btn"><?php echo html::commonButton($lang->cancel, 'btn-close-form btn');?></span>
    <?php echo html::hidden('groupID', '', "class='groupID'");?>
  </div>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
