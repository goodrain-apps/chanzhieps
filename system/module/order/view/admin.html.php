<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The admin view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('finishWarning', $lang->order->finishWarning);?>
<div class='panel'>
  <div class='panel-heading'>
    <ul id='typeNav' class='nav nav-tabs'>
      <li data-type='internal' <?php echo $param == 'normal' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "mode=status&status=normal"), $lang->order->statusList['normal']);?>
      </li>
      <li data-type='internal' <?php echo $param == 'finished' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "mode=status&status=finished"), $lang->order->statusList['finished']);?>
      </li>
      <li data-type='internal' <?php echo $param == 'canceled' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "mode=status&status=canceled"), $lang->order->statusList['canceled']);?>
      </li>
    </ul> 
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode=$mode&param={$param}&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->order->id);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('account', $orderBy, $vars, $lang->order->account);?></th>
        <th><?php echo $lang->order->productInfo;?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('amount', $orderBy, $vars, $lang->order->amount);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->product->status);?></th>
        <th><?php echo $lang->order->note;?></th>
        <th class='w-110px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($orders as $order):?>
      <tr class='text-center text-top'>
        <td><?php echo $order->id;?></td>
        <td><?php echo zget($users, $order->account);?></td>
        <td>
          <?php if($order->type == 'score'):?>
          <?php echo $lang->order->score;?>
          <?php else:?>
            <?php foreach($order->products as $product):?>
            <div class='text-left'>
              <span><?php echo html::a(commonModel::createFrontLink('product', 'view', "id=$product->productID"), $product->productName, "class='product' target='_blank'");?></span>
              <span><?php echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon . $product->count;?></span>
            </div>
            <?php endforeach;?>
          <?php endif;?>
        </td>
        <td><?php echo $order->amount;?></td>
        <td><?php echo $this->order->processStatus($order);?></td>
        <td class='text-left'><?php echo $order->note;?></td>
        <td class='text-left'><?php $this->order->printActions($order);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='9'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
