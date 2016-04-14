<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit view file of address for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     address
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-map-marker'></i> <?php echo $lang->address->edit;?></h5>
    </div>
    <div class='modal-body'>
      <form id='editForm' action='<?php echo inlink('edit', "id={$address->id}");?>' method='post'>
        <div class='form-group'>
          <?php echo html::input('contact', $address->contact, "class='form-control' placeholder='{$lang->address->contact}'");?>
        </div>
        <div class='form-group'>
          <?php echo html::input('phone', $address->phone, "class='form-control' placeholder='{$lang->address->phone}'");?>
        </div>
        <div class='form-group'>
          <?php echo html::input('address', $address->address, "class='form-control' placeholder='{$lang->address->address}'");?>
        </div>
        <div class='form-group'>
          <?php echo html::input('zipcode', $address->zipcode, "class='form-control' placeholder='{$lang->address->zipcode}'");?>
        </div>
        <div class='form-group'>
          <?php echo html::submitButton('', 'btn primary block');?>
        </div>
      </form>
    </div>
  </div>
</div>
