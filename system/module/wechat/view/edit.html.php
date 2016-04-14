<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit view file of wechat module of chanzhiEPS.
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
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-edit"></i> <?php echo $lang->wechat->edit;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table class='table table-form w-p50'>
        <tr>
          <th class='w-100px'><?php echo $lang->wechat->type;?></th>
          <td><?php echo html::select('type', $lang->wechat->typeList, $public->type, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->name;?></th>
          <td><?php echo html::input('name', $public->name, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->account;?></th>
          <td><?php echo html::input('account', $public->account, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->appID;?></th>
          <td><?php echo html::input('appID', $public->appID, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->appSecret;?></th>
          <td><?php echo html::input('appSecret', $public->appSecret, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->token;?></th>
          <td><?php echo html::input('token', $public->token, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->certified;?></th>
          <td><?php echo html::radio('certified', $lang->wechat->certifiedList, $public->certified);?></td>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
