<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <?php include TPL_ROOT . 'user/side.html.php';?>
  <div class='col-md-10'>
    <div class='panel panel-section'>
      <div class='panel-body'>
        <table class='table'>
          <tr> 
            <th><?php echo $lang->score->id;?></th>
            <th><?php echo $lang->score->product;?></th>
            <?php if(!empty($order->ip)):?>
            <th>IP</th>
            <?php endif;?>
            <?php if(!empty($order->hostID)):?>
            <th>MAC</th>
            <?php endif;?>
            <th width='50'><?php echo $lang->score->amount;?></th>
          </tr>
          <tr class='text-center'> 
            <td><?php echo $order->humanOrder;?></td>
            <td><?php echo $order->subject;?></td>
            <?php if(!empty($order->ip)):?>
            <td><?php echo $order->ip;?></td>
            <?php endif;?>
            <?php if(!empty($order->hostID)):?>
            <td><?php echo $order->hostID;?></td>
            <?php endif;?>
            <td><?php echo $order->amount;?></td>
          </tr>
          <tr class='text-center'>
            <td colspan='5'><?php echo html::a($payLink, $lang->score->alipay, "class='btn primary block'");?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
