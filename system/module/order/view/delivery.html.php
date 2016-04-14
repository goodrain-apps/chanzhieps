<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The delivery view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<form method='post' action='<?php echo inlink('delivery', "orderID={$order->id}");?>' id='ajaxForm'>
  <table class='table table-form'>
    <tr>
      <th class='w-100px'><?php echo $lang->order->express;?></th>
      <td><?php echo html::select('express', $expressList, '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-100px'><?php echo $lang->order->waybill;?></th>
      <td><?php echo html::textarea('waybill', '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-100px'><?php echo $lang->order->deliveriedDate;?></th>
      <td>
        <div class="input-append date">
          <?php echo html::input('deliveriedDate', date('Y-m-d H:i'), "class='form-control'");?>
          <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
        </div>
      </td>
    </tr>
    <tr>
      <td></td>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>

<?php include '../../common/view/footer.modal.html.php';?>

