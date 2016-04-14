<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The featured product form view file of block module of chanzhiEPS.
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
<?php $products = $this->loadModel('product')->getPairs(0);?>
<tr>
  <th><?php echo $lang->block->product;?></th>
  <td>
    <div class='row'>
      <div class='col-sm-6'>
        <?php echo html::select('params[product]', $products, isset($block->content->product) ? $block->content->product : '', "class='text-4 form-control'");?></td>
      </div>
    </div>
</tr>
<tr>
  <th><?php echo $lang->block->showCategory;?></th>
  <td>
    <div class='row'>
      <div class='col-sm-6'>
        <div class='input-group'>
          <span class='input-group-addon'>
            <input type='checkbox' name='params[showCategory]' <?php if(isset($block->content->showCategory) && $block->content->showCategory) echo 'checked';?> value='1' />
          </span>
          <?php echo html::select('params[categoryName]', $lang->block->category->showCategoryList, isset($block->content->categoryName) ? $block->content->categoryName : '', "class='form-control'");?>
        </div>
      </div>
    </div>
  </td>
</tr>
