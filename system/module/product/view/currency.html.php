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
<?php include '../../common/view/header.modal.html.php';?>
<form id='ajaxForm' action="<?php echo inlink('currency');?>" method='post'>
  <table class="table table-form">
    <tr>
      <td><?php echo html::radio('currency', $lang->product->currencyList, isset($config->product->currency) ? $config->product->currency : '');?></td>
    </tr>
    <tr>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
