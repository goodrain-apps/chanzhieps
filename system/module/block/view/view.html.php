<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The view view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><?php echo $block->title;?></strong></div>
  <div class='panel-body'><?php echo $block->content;?></div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
