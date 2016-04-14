<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The zipcode view of zipcode module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     zipcode 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class="page-user-control">
  <div class="row">
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class="col-md-10">
      <div class="panel">
        <div class='panel-heading'>
          <strong><?php echo $lang->address->browse;?></strong>
          <div class='panel-actions'><?php echo html::a('javascript:;', $lang->address->create, "id='createBtn' class='btn btn-primary'");?></div>
        </div>
        <div class="panel-body">
          <div id='createForm'></div>
          <?php foreach($addresses as $address):?>
          <?php
          if(!isset($checked)) $checked = 'checked';
          else $checked = '';
          ?>
          <div class='item'>
            <div class='address-list'>
              <?php if(helper::isAjaxRequest()):?>
              <span><input type='radio' <?php echo $checked;?> name='deliveryAddress' value='<?php echo $address->id;?>'/></span>
              <?php endif;?>
              <strong><?php echo $address->contact;?></strong>
              <span> <?php echo $address->phone;?></span>
              <span class='text-muted'> <?php echo $address->address;?></span>
              <span class='text-muted'> <?php echo $address->zipcode;?></span>
              <span class='pull-right'>
              <?php echo html::a(helper::createLink('address', 'edit', "id={$address->id}"), $lang->edit, "class='editor'");?>
              <?php echo html::a(helper::createLink('address', 'delete', "id={$address->id}"), $lang->delete, "class='deleter'");?>
              </span>
            </div>
            <div class='form-edit'>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
