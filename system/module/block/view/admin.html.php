<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='row'>
  <?php foreach($config->block->categoryList as $category => $blockList):?>
  <div class='col-sm-3'>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->block->categoryList[$category];?></strong>
        <div class='panel-actions'><?php echo html::a(inlink('create'), "<i class='icon icon-plus'> </i>" . $lang->block->add, "class='btn btn-primary btn-sm'");?></div>
      </div>
      <div class='panel-body'>
        <?php foreach($blocks as $block):?>
        <?php if(strpos($blockList, ",$block->type,") !== false):?>
        <?php if(strpos($block->type, 'code') === false) $block->content = json_decode($block->content); ?>
        <span class='block-item'>
          <a href='<?php echo inlink('edit', "block={$block->id}")?>' title="<?php echo $block->title?>"> <?php echo helper::subStr($block->title, 20);?> </a>
          <?php echo html::a(helper::createLink('block', 'delete', "blockID=$block->id"), "<i class='icon icon-remove-sign text-important '></i>", "class='deleter pull-right'");?>
        </span>
        <?php endif;?>
        <?php endforeach;?>
        <p></p>
        <br/>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
