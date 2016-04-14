<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::set('confirmWarning', $lang->order->confirmWarning);?>
<?php js::set('cancelWarning', $lang->order->cancelWarning);?>
<div class="page-user-control">
  <div class="row">
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class="col-md-10">
      <div class='panel'>
        <div class='panel-heading'>
        <strong><i class="icon-shopping-cart"> </i><?php echo $lang->order->admin;?></strong>
        </div>
        <table class='table table-hover table-striped tablesorter'>
          <thead>
            <tr class='text-center'>
              <td class='w-60px'><?php echo $lang->order->id;?></td>
              <td class='w-260px text-left'><?php echo $lang->order->productInfo;?></td>
              <td class='w-80px text-right'><?php echo $lang->order->amount;?></td>
              <td class='w-220px'><?php echo $lang->order->life;?></td>
              <td class='w-60px'><?php echo $lang->product->status;?></td>
              <td><?php echo $lang->order->note;?></td>
              <td class='w-200px'><?php echo $lang->actions;?></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order):?>
            <tr>
              <td class='text-center text-middle'><?php echo $order->id;?></td>
              <td class='text-middle'>
                <?php if($order->type == 'score'):?>
                <?php echo $lang->order->score;?>
                <?php else:?>
                  <?php foreach($order->products as $product):?>
                  <div class='text-left'>
                    <span><?php echo html::a(helper::createLink('product', 'view', "id={$product->productID}", "target='_blank'"), $product->productName);?></span>
                    <span>
                    <?php echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon. $product->count; ?>
                    </span>
                  </div>
                  <?php endforeach;?>
                <?php endif;?>
              </td>
              <td class='text-right text-middle'><?php echo $order->amount;?></td>
              <td class='text-center text-middle'>
                <?php echo $lang->order->createdDate . $lang->colon .  $order->createdDate;?>
                <?php if($order->payment != 'COD' and ($order->paidDate > $order->createdDate)) echo $lang->order->paidDate . $lang->colon .  $order->paidDate;?>
                <?php if($order->deliveriedDate > $order->createdDate)echo $lang->order->deliveriedDate . $lang->colon .  $order->deliveriedDate;?>
                <?php if($order->confirmedDate > $order->deliveriedDate)echo $lang->order->confirmedDate . $lang->colon .  $order->confirmedDate;?>
                <?php if($order->payment == 'COD' and ($order->paidDate > $order->createdDate)) echo $lang->order->paidDate . $lang->colon .  $order->paidDate;?>
              </td>
              <td class='text-center text-middle'>
                <?php echo $this->order->processStatus($order);?>
              </td>
              <td class='text-left'><?php echo $order->note;?></td>
              <td class='text-center text-middle'><?php $this->order->printActions($order);?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
