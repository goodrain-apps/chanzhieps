<?php if(!defined("RUN_MODE")) die();?>
<?php 
/**
 * The create view of address module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     address 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<form id='createForm' action='<?php echo inlink('create')?>' method='post'>
  <table class='table table-borderless address-form table-list'>
    <tr>
      <td class='w-100px'><?php echo html::input('contact', '', "class='form-control' placeholder='{$lang->address->contact}'");?></td>
      <td class='w-130px'><?php echo html::input('phone', '', "class='form-control' placeholder='{$lang->address->phone}'");?></td>
      <td><?php echo html::input('address', '', "class='form-control' placeholder='{$lang->address->address}'");?></td>
      <td class='w-100px'><?php echo html::input('zipcode', '', "class='form-control' placeholder='{$lang->address->zipcode}'");?></td>
      <td class='w-50px'><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
