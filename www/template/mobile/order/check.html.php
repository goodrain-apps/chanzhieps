<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The check view file of order for mobile template of chanzhiEPS.
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
<?php js::set('currencySymbol', $currencySymbol);?>
<?php js::set('createdSuccess', $lang->order->createdSuccess);?>
<?php js::set('goToPay', $lang->order->goToPay);?>

<div class='panel panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><i class='icon icon-shopping-cart'></i> <strong><?php echo $lang->order->selectPayment;?></strong></div>
  </div>
  <form id='checkForm' action='<?php echo helper::createLink('order', 'pay', "orderID=$order->id"); ?>' method='post' target='_blank'>
    <div class="panel-body">
      <div class='alert bg-gray-pale'><strong><?php echo $lang->order->payment;?></strong></div>
      <div class="form-group">
        <?php echo html::radio('payment', $paymentList);?>
      </div>
    </div>
    <div class='panel-body'>
      <div class='alert bg-primary-pale'>
        <?php printf($lang->order->selectProducts, count($products));?>
        <?php printf($lang->order->totalToPay, $currencySymbol . $order->amount);?>
      </div>
    </div>
    <div class='panel-footer'>
      <?php echo html::submitButton($lang->order->settlement, 'btn-order-submit btn danger block'); ?>
    </div>
  </form>
</div>

<?php include TPL_ROOT . 'common/form.html.php';?>
<script>
$(function()
{
    $('[name=payment]').first().prop('checked', true);

    $.refreshAddressList = function()
    {
        $('#addressListWrapper').load('<?php echo helper::createLink('address', 'browse') ?> #addressList', function()
        {
            $('#addressList').find('.card-footer').remove();
        });
    };

    $.refreshAddressList();

    $('#submit').click(function(){
        var payment = $('input:radio[name=payment]:checked').val();
        if(payment == 'COD')
        {
            $('#checkForm').attr('target', '');
        }
        else
        {
            $('#checkForm').attr('target', '_blank');

            bootbox.dialog(
            {  
                message: v.goToPay,  
                buttons:
                {  
                    paySuccess:
                    {
                        label:     v.paid,  
                        className: 'btn-primary',  
                        callback:  function() { setTimeout(function(){location.href = createLink('order', 'browse');}, 600); }  
                    }
                }
            });
        }
    });
});
</script>
<?php include TPL_ROOT . 'common/footer.html.php';?>
