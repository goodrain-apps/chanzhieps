<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The link front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php if($this->app->getModuleName() != 'links' and !empty($this->config->links->index)):?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><i class='icon'><?php echo $icon;?></i><?php echo $block->title;?></strong>
    <div class='pull-right'>
      <?php if(trim(strip_tags($this->config->links->all, '<a>'))):?>
      <?php echo html::a(helper::createLink('links', 'index'), $this->lang->more); ?>
      <?php endif;?>
    </div>
  </div>
  <div class='panel-body'><?php echo $this->config->links->index;?></div>
</div>
<?php endif;?>
