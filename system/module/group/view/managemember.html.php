<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The manage member view of group module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     group
 * @version     $Id: managemember.html.php 4627 2013-04-10 05:42:20Z chencongzhi520@gmail.com $
 * @link        http://www.ranzhico.com
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-user'></i> <?php echo $lang->group->manageMember;?></strong>
  </div>
  <div class='panel-body'>
    <form class='form-condensed pdb-20' method='post' id='ajaxForm'>
      <table class='table table-form'> 
        <?php if($groupUsers):?>
        <tr>
          <th class='w-100px'><?php echo $lang->group->inside;?></th>
          <td id='group' class='f-14px'><?php $i = 1;?>
            <?php foreach($groupUsers as $account => $realname):?>
            <div class='group-item'><?php echo html::checkbox('members', array($account => $realname), $account);?></div>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endif;?>
        <tr>
          <th class='w-100px'><?php echo $lang->group->outside;?></th>
          <td id='other'><?php $i = 1;?>
            <?php foreach($otherUsers as $account => $realname):?>
            <div class='group-item'><?php echo html::checkbox('members', array($account => $realname), '');?></div>
            <?php endforeach;?>
          </td>
        </tr>
      </table>
    </div>
    <div class='panel-footer text-center'>
      <?php 
      echo html::submitButton();
      echo html::linkButton($lang->goback, $this->createLink('group', 'browse'));
      echo html::hidden('foo'); // Just a var, to make sure $_POST is not empty.
      ?>
    </div>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
