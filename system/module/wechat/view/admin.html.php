<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin view file of wechat of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php if(!checkCurlSSL()):?>
  <div class='alert alert-danger'>
    <?php echo $lang->wechat->curlSSLRequired;?>
  </div>
<?php else:?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-list-ul"></i> <?php echo $lang->wechat->list;?></strong>
    <div class='panel-actions'><?php commonModel::printLink('wechat', 'create', '', '<i class="icon-plus"></i>' . $lang->wechat->create, "class='btn btn-primary'");?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <th class='w-200px'><?php echo $lang->wechat->name;?></th>
        <th class='w-100px'><?php echo $lang->wechat->type;?></th>
        <th class='w-160px'><?php echo $lang->wechat->account;?></th>
        <th class='w-160px'><?php echo $lang->wechat->appID;?></th>
        <th><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($publics as $public):?>
      <tr class='text-center'>
        <td><?php echo $public->name;?></td>
        <td><?php echo $lang->wechat->typeList[$public->type];?></td>
        <td><?php echo $public->account;?></td>
        <td><?php echo $public->appID;?></td>
        <td>
          <?php
          commonModel::printLink('wechat', 'edit', "publicID=$public->id", $lang->edit);
          if(!$public->certified and $public->type == 'subscribe')
          {
             echo html::a('javascript:;', $lang->wechat->setMenu, "class='text-muted' data-container='body' data-toggle='popover' data-placement='right' data-content='{$lang->wechat->needCertified}'");
          }
          else
          {
              commonModel::printLink('tree', 'browse', "type=wechat_$public->id", $lang->wechat->setMenu);
          }
          commonModel::printLink('wechat', 'adminResponse', "publicID=$public->id", $lang->wechat->response->keywords);
          commonModel::printLink('wechat', 'setResponse', "publicID=$public->id&group=default&key=default", $lang->wechat->response->default, "data-toggle='modal'");
          commonModel::printLink('wechat', 'setResponse', "publicID=$public->id&group=subscribe&key=subscribe", $lang->wechat->response->subscribe, "data-toggle='modal'");
          commonModel::printLink('wechat', 'delete', "publicID=$public->id", $lang->delete, "class='deleter'");
          commonModel::printLink('wechat', 'integrate', "publicID=$public->id", $lang->wechat->integrate);
          commonModel::printLink('wechat', 'qrcode', "publicID=$public->id", $lang->wechat->qrcode, "data-toggle=modal");
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php endif;?>
<?php include '../../common/view/footer.admin.html.php';?>
