<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setpage view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
  <form id='ajaxForm' action="<?php echo inlink('setregion', "page={$page}&region={$region}");?>" method='post'>
    <div id='blockList'>
      <?php $key = 0; foreach($blocks as $block){ echo $this->block->createEntry($template, $region, $block, $key); $key = $this->block->counter; $key ++;}?>
    </div>
    <div><?php echo html::submitButton();?></div>
  </form>
  <div class='hide'>
    <div id='entry'><?php echo $this->block->createEntry($template, $region, null, 'key');?></div>
    <div id='child'><?php echo $this->block->createEntry($template, $region, null, 'key', 2);?></div>
  </div>
</div>
<div class='modal-footer'>
<?php js::set('key', $key);?>
<?php include '../../common/view/footer.modal.html.php';?>
