<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin view file of product of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<?php js::set('categoryID', $categoryID);?>
<div class='panel'>
  <div class='panel-heading'>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->product->list;?></strong>
  <div class='panel-actions'>
    <form method='get' class='form-inline form-search'>
      <?php echo html::hidden('m', 'product');?>
      <?php echo html::hidden('f', 'admin');?>
      <?php echo html::hidden('categoryID', $categoryID);?>
      <?php echo html::hidden('orderBy', $orderBy);?>
      <?php echo html::hidden('recTotal', isset($this->get->recTotal) ? $this->get->recTotal : 0);?>
      <?php echo html::hidden('recPerPage', isset($this->get->recPerPage) ? $this->get->recPerPage : 10);?>
      <?php echo html::hidden('pageID', isset($this->get->pageID) ? $this->get->pageID : 1);?>
      <div class="input-group">
      <?php echo html::input("searchWord", $this->get->searchWord, "class='form-control search-query'");?>
      <span class="input-group-btn"><?php echo html::submitButton($lang->search->common, "btn btn-primary");?> </span>
      </div>
    </form>
    <?php commonModel::printLink('product', 'create', "category={$categoryID}", '<i class="icon-plus"></i> ' . $lang->product->create, 'class="btn btn-primary"');?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "categoryID=$categoryID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->product->id);?></th>
        <th><?php commonModel::printOrderLink('name', $orderBy, $vars, $lang->product->name);?></th>
        <th class='w-p10'><?php commonModel::printOrderLink('category', $orderBy, $vars, $lang->product->category);?></th>
        <th class='w-p10'><?php commonModel::printOrderLink('amount', $orderBy, $vars, $lang->product->amount);?></th>
        <th class='w-160px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->product->addedDate);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->product->status);?></th>
        <th class='w-70px'><?php commonModel::printOrderLink('views', $orderBy, $vars, $lang->product->views);?></th>
        <th style='width: 270px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($products as $product):?>
      <tr class='text-center'>
        <td><?php echo $product->id;?></td>
        <td class='text-left'><?php echo $product->name;?></td>
        <td class='text-left'><?php foreach($product->categories as $category) echo $category->name . ' ';?></td>
        <td><?php echo $product->amount;?></td>
        <td><?php echo $product->addedDate;?></td>
        <td><?php echo isset($lang->product->statusList[$product->status]) ? $lang->product->statusList[$product->status] : '';?></td>
        <td><?php echo $product->views;?></td>
        <td>
          <?php
          $categories    = $product->categories;
          $categoryAlias = !empty($categories) ? current($categories)->alias : '';
          $changeStatus  = $product->status == 'normal' ? 'offline' : 'normal';
          commonModel::printLink('product', 'edit', "productID=$product->id", $lang->edit);
          commonModel::printLink('file', 'browse', "objectType=product&objectID=$product->id&isImage=1", $lang->product->images, "data-toggle='modal' data-width='1000'");
          commonModel::printLink('file', 'browse', "objectType=product&objectID=$product->id&isImage=0", $lang->product->files, "data-toggle='modal' data-width='1000'");
          commonModel::printLink('product', 'changeStatus', "productID=$product->id&status=$changeStatus", $lang->product->statusList[$changeStatus], "class='changeStatus'");
          echo html::a(commonModel::createFrontLink('product', 'view',  "productID=$product->id", "name=$product->alias&category=$categoryAlias"), $lang->preview, "target='_blank'");
          ?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='javascript:;'><?php echo $this->lang->more;?><span class='caret'></span></a>
            <ul class='dropdown-menu pull-right'>    
              <li><?php commonModel::printLink('product', 'delete', "productID=$product->id", $lang->delete, "class='deleter'");?></li>
              <li><?php commonModel::printLink('product', 'setcss', "productID=$product->id", $lang->product->css, "data-toggle='modal'");?></li>
              <li><?php commonModel::printLink('product', 'setjs',  "productID=$product->id", $lang->product->js, "data-toggle='modal'");?></li>
            </ul>
          </span>
        </td>
      </tr> <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
