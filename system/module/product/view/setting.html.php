<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The currency view file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon icon-cog'> </i><?php echo $lang->product->setting;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' action="<?php echo inlink('setting');?>" method='post' class='form-inline'>
      <table class="table table-form">
        <tr>
          <th class='w-120px'><?php echo $lang->product->currency;?></th>
          <td class='w-200px'><?php echo html::select('currency', $lang->product->currencyList, isset($config->product->currency) ? $config->product->currency : '', "class='chosen'");?></td>
          <td></td>
        </tr>
        <?php if(commonModel::isAvailable('shop')):?>
        <tr>
          <th><?php echo $lang->product->stock;?></th>
          <td class='w-100px'><?php echo html::radio('stock', $lang->product->stockOptions, isset($config->product->stock) ? $config->product->stock : '', "class='checkbox'");?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->order->confirmLimit;?></th> 
          <td>
            <div class='input-group'>
              <?php echo html::input('confirmLimit', isset($this->config->shop->confirmLimit) ? $this->config->shop->confirmLimit: 7, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->order->days;?></span>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->order->payment;?></th> 
          <td colspan='2'><?php echo html::checkbox('payment', $lang->order->paymentList, isset($this->config->shop->payment) ? $this->config->shop->payment : 'COD,alipay', "class='checkbox'");?></td>
        </tr>
        <tr class='alipay-item'>
          <th><?php echo $lang->order->alipayPid;?></th>
          <td colspan='2'><?php echo html::input('pid', isset($this->config->alipay->pid) ? $this->config->alipay->pid : '', "class='form-control' placeholder='{$lang->order->placeholder->pid}'" );?>
        </tr>
        <tr class='alipay-item'>
          <th><?php echo $lang->order->alipayKey;?></th>
          <td colspan='2'><?php echo html::input('key', isset($this->config->alipay->key) ? $this->config->alipay->key : '', "class='form-control' placeholder='{$lang->order->placeholder->key}'" );?>
        </tr>
        <tr class='alipay-item'>
          <th><?php echo $lang->order->alipayEmail;?></th>
          <td colspan='2'><?php echo html::input('email', isset($this->config->alipay->email) ? $this->config->alipay->email : '', "class='form-control' placeholder='{$lang->order->placeholder->email}'" );?>
        </tr>
        <?php endif;?>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
