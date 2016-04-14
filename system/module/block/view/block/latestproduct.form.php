<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The product form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php include '../../common/view/chosen.html.php';?>
<?php $categories = $this->loadModel('tree')->getOptionMenu('product');?>
<tr>
  <th><?php echo $lang->block->categories;?></th>
  <td><?php echo html::select('params[category][]', $categories, isset($block->content->category) ? $block->content->category : '', "class='text-4 form-control chosen' multiple='multiple'");?></td>
</tr>
<tr>
  <th><?php echo $lang->block->amount;?></th>
  <td>
    <div class='input-group'>
      <span class='input-group-addon'><?php echo $lang->block->limit;?></span>
      <?php echo html::input('params[limit]', isset($block->content->limit) ? $block->content->limit : '', "class='text-4 form-control'");?>
      <span class='input-group-addon fix-border'><?php echo $lang->block->recPerRow;?></span>
      <?php echo html::input('params[recPerRow]', isset($block->content->recPerRow) ? $block->content->recPerRow : '', "class='text-4 form-control'");?>
    </div>
  </td>
</tr>
<tr>
  <th><?php echo $lang->block->showCategory;?></th>
  <td>
    <div class='input-group'>
      <span class='input-group-addon'>
        <input type='checkbox' name='params[showCategory]' <?php if(isset($block->content->showCategory) && $block->content->showCategory) echo 'checked';?> value='1' />
      </span>
      <?php echo html::select('params[categoryName]', $lang->block->category->showCategoryList, isset($block->content->categoryName) ? $block->content->categoryName : '', "class='form-control'");?>
    </div>
  </td>
</tr>
<tr>
  <th><?php echo $lang->block->showImage;?></th>
  <td><input type='checkbox' name='params[image]' <?php if(isset($block->content->image) && $block->content->image) echo 'checked';?> value='1' /></td>
</tr>
