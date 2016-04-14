<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The reduce score view file of user module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     User
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('reduceScore', "account=$account");?>' id='ajaxForm' class='form'>
  <table class='table table-form borderless'>
    <tr>
      <th class="w-100px"><?php echo $lang->score->count;?></th>
      <td><?php echo html::input('count', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->score->note;?></th>
      <td><?php echo html::textarea('note', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
