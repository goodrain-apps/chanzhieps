<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The deliveryInfo view file of order module of ZenTaoPMS.
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
<table class='table table-form'>
  <tr>
    <th class='w-100px'><?php echo $lang->order->express;?></th>
    <td><?php echo zget($expressList, $order->express);?></td>
  </tr>
  <tr>
    <th class='w-100px'><?php echo $lang->order->waybill;?></th>
    <td><?php echo $order->waybill;?></td>
  </tr>
  <tr>
    <th class='w-100px'><?php echo $lang->order->deliveriedDate;?></th>
    <td> <?php echo $order->deliveriedDate;?> </td>
  </tr>
</table>
<?php include '../../common/view/footer.modal.html.php';?>

