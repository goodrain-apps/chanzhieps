<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The category form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<tr>
  <th><?php echo $lang->block->category->showChildren;?></th>
  <td><?php echo html::radio('params[showChildren]', $lang->block->category->showChildrenList, isset($block->content->showChildren) ? $block->content->showChildren : 'no');?></td>
</tr>
<tr>
  <th><?php echo $lang->block->category->fromCurrent;?></th>
  <td><?php echo html::radio('params[fromCurrent]', $lang->block->category->fromCurrentList, isset($block->content->fromCurrent) ? $block->content->fromCurrent : 'no');?></td>
</tr>
