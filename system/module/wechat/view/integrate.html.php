<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The integrate view file of wechat module of chanzhiEPS.
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
    <strong class='text-info'><i class="icon-plus-sign"></i> <?php echo $lang->wechat->integrateInfo;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' action="<?php echo inlink('edit', "publicID={$public->id}");?>">
      <table class='table table-form w-p50'>
       <tr>
          <th><?php echo $lang->wechat->token;?></th>
          <td><?php echo $public->token;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->wechat->url;?></th>
          <td><?php echo $public->url;?></td>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton($lang->wechat->integrateDone);?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
