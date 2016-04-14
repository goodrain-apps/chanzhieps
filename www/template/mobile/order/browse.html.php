<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of order for mobile template of chanzhiEPS.
 * The file should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'user/side.html.php';?>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-shopping-cart'></i> <?php echo $lang->order->admin?></div>
  </div>
  <div class='panel-body' id='orderListWrapper'>
    <div class='cards' id='orderList'>
      <?php foreach($orders as $order):?>
      <div class='card'>
        <div class='card-heading bg-gray-pale'>
          #<?php echo $order->id;?> &nbsp; &nbsp;
          <span><?php echo $lang->order->amount;?>: <strong class='text-danger'><?php echo $order->amount;?></strong></span> 
          <div class='pull-right'>
            <?php
            switch ($order->status)
            {
                case 'normal':
                case 'not_paid':
                  $statusClass = 'danger';
                  break;
                case 'paid':
                case 'not_send':
                  $statusClass = 'important';
                  break;
                case 'send':
                  $statusClass = 'special';
                  break;
                case 'confirmed':
                  $statusClass = 'primary';
                  break;
                case 'finished':
                  $statusClass = 'success';
                  break;
                case 'canceled':
                  $statusClass = 'muted';
                  break;
                default:
                  $statusClass = '';
                  break;
            }
            ?>
            <span class='text-<?php echo $statusClass?>'><?php echo $this->order->processStatus($order);?></span>
          </div>
        </div>
        <div class='list-group simple'>
        <?php foreach($order->products as $product):?>
          <div class='list-group-item'>
            <?php echo html::a(helper::createLink('product', 'view', "id={$product->productID}", "target='_blank'"), $product->productName, "class='text-primary'");?>
            <div class='pull-right'>
              <?php echo '<small class="text-muted">' . $lang->order->price . $lang->colon . '</small>' . $product->price . ' &nbsp;<small class="text-muted">' . $lang->order->count . $lang->colon . '</small>' . $product->count; ?>
            </div>
          </div>
        <?php endforeach;?>
        </div>
        <div class='card-footer'>
          <?php
            $history = '<li>' . $lang->order->createdDate . $lang->colon .  $order->createdDate . '</li>';
            if($order->payment != 'COD' and ($order->paidDate > $order->createdDate)) $history .= '<li>' . $lang->order->paidDate . $lang->colon .  $order->paidDate . '</li>';
            if($order->deliveriedDate > $order->createdDate) $history .= '<li>' . $lang->order->deliveriedDate . $lang->colon .  $order->deliveriedDate . '</li>';
            if($order->confirmedDate > $order->deliveriedDate) $history .= '<li>' . $lang->order->confirmedDate . $lang->colon .  $order->confirmedDate . '</li>';
            if($order->payment == 'COD' and ($order->paidDate > $order->createdDate)) $history .= '<li>' . $lang->order->paidDate . $lang->colon .  $order->paidDate . '</li>';
            if($order->note) $history .= '<li>' . $lang->order->note . $lang->colon . $order->note . '</li>';
            echo "<ul class='order-track-list text-muted'>{$history}</ul>";
          ?>
        </div>
        <div class='card-footer order-actions text-right'>
          <?php $this->order->printActions($order, true);?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>
<script>
$(function()
{
    var refreshOrderList = function()
    {
        $('#orderListWrapper').load(window.location.href + ' #orderList');
    };

    $(document).on('click', '.cancelLink', function(e)
    {
        var $this   = $(this);
        var options = $.extend({url: $this.data('rel'), confirm: '<?php echo $lang->order->cancelWarning?>', onSuccess: refreshOrderList}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    }).on('click', '.confirmDelivery', function(e)
    {
        var $this   = $(this);
        var options = $.extend({url: $this.data('rel'), confirm: "<?php echo $lang->order->confirmWarning?>", onSuccess: refreshOrderList}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });
});
</script>
<?php include TPL_ROOT . 'common/footer.html.php';?>
