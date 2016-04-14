<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The createGroup view file of slide module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Qiaqia LI<liqiaqia@cnezsoft.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php'?>
<form id='ajaxForm' method='post' action="<?php echo inlink('createGroup');?>">
  <table class='table table-form'>
    <tr>
      <th class='w-100px'><?php echo $lang->slide->groupName;?></th>
      <td><?php echo html::input('name', '', "class='form-control'");?></td>
      <td class='w-200px'><?php echo html::submitButton($lang->slide->createGroup);?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php'?>
