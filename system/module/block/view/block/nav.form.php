<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The nav block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<tr>
  <th><?php echo $lang->block->navType;?></th>
  <td><?php echo html::select('params[navType]', $lang->block->navTypeList, isset($block->content->navType) ? $block->content->navType : '', "class='form-control'");?></td>
</tr>
