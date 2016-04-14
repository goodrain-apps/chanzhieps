<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The track view file of order for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><?php echo $lang->order->track;?></h5>
    </div>
    <div class='modal-body'>
      <table class='table table-layout'>
        <tbody>
          <tr>
            <th class='small'><?php echo $lang->order->address;?></th>
            <td><?php echo $fullAddress;?></td>
          </tr>
          <tr>
            <th class='small'><?php echo $lang->order->deliveriedDate;?></th>
            <td><?php echo $order->deliveriedDate;?></td>
          </tr>
          <tr>
            <th class='small'><?php echo $lang->order->express;?></th>
            <td><?php if(!empty($order->express)) echo $expressList[$order->express];?></td>
          </tr>
          <tr>
            <th class='small'><?php echo $lang->order->waybill;?></th>
            <td><?php echo $order->waybill;?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
