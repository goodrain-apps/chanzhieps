<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The slide form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php $slideGroups = $this->loadModel('tree')->getPairs('', 'slide');?>
<tr>
  <th><?php echo $lang->block->slide;?></th>
  <td>
    <div class='row'>
      <div class='col-sm-6'>
        <?php echo html::select('params[group]', $slideGroups, isset($block->content->group) ? $block->content->group : '', "class='text-4 form-control'");?></td>
      </div>
    </div>
  </td>
</tr>
