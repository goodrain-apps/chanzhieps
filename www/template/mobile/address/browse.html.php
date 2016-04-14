<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of address for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     address
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'user/side.html.php';?>

<div class='panel-section'>
  <div class='panel-heading'>
    <button type='button' class='btn primary block' data-toggle='modal' data-remote='<?php echo inlink('create'); ?>'><i class='icon icon-plus'></i> <?php echo $lang->address->create?></button>
  </div>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-map-marker'></i> <?php echo $lang->address->browse?></div>
  </div>
  <div id='addressListWrapper'>
    <div class='cards condensed cards-list' id='addressList'>
      <?php foreach($addresses as $address):?>
      <?php
        if(!isset($checked)) $checked = 'checked';
        else $checked = '';
      ?>
      <div class='card'>
        <div class='card-heading'>
          <?php if(helper::isAjaxRequest()):?>
          <input type='radio' <?php echo $checked;?> name='deliveryAddress' value='<?php echo $address->id;?>'/>
          <?php endif;?>
          <strong class='lead'><?php echo $address->contact;?></strong>
          &nbsp;&nbsp;<span class='text-special'><i class='icon icon-phone'></i> <?php echo $address->phone;?></span>
        </div>
        <div class='card-content'>
          <?php echo $address->address;?> <span class='text-muted'>(<?php echo $lang->address->zipcode ?>: <?php echo $address->zipcode;?>)</span>
        </div>
        <div class='card-footer'>
          <?php echo html::a(helper::createLink('address', 'edit', "id={$address->id}"), $lang->edit, "class='editor text-primary' data-toggle='modal'");?>&nbsp;&nbsp;
          <?php echo html::a(helper::createLink('address', 'delete', "id={$address->id}"), $lang->delete, "class='deleter text-primary'");?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <?php if(count($addresses) >= 5): ?>
  <div class='panel-footer'>
    <button type='button' class='btn primary block' data-toggle='modal' data-remote='<?php echo inlink('create'); ?>'><i class='icon icon-plus'></i> <?php echo $lang->address->create?></button>
  </div>
  <?php endif; ?>
</div>
<script>
$(function()
{
    $.refreshAddressList = function()
    {
        $('#addressListWrapper').load(window.location.href + ' #addressList');
    };
});
</script>
<?php include TPL_ROOT . 'common/form.html.php';?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
