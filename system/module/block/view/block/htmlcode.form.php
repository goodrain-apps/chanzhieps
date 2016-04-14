<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The code block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php $content = (isset($block->content) and !is_object($block->content)) ? $block->content : (isset($block->content->content) ? $block->content->content : '');?>
<tr>
  <th><?php echo $lang->block->htmlcode;?></th>
  <td><?php echo html::textarea('content', $content, "rows=20 class='form-control codeeditor' data-height='350'");?></td>
</tr>
