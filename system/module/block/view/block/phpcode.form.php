<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The php code block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php if(!empty($block->content)) $content = isset($block->content->content) ? $block->content->content : '';?>
<tr>
  <th><?php echo $lang->block->phpcode;?></th>
  <td><?php echo html::textarea('content', !empty($content) ? $content : '<?php', "rows=20 class='form-control codeeditor' data-mode='php' data-height='350'");?></td>
</tr>
