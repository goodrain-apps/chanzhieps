<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The about front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php
$block->content = json_decode($block->content);
$groupID = !empty($block->content->group) ? $block->content->group : '';
$slides  = $this->loadModel('slide')->getList($groupID);
$slideId = 'slide' . $block->id . '-' . $groupID;
if($slides):
?>
<div class='block' id='block<?php echo $block->id?>'>
<div id='<?php echo $slideId;?>' class='carousel slide' class='carousel slide' data-ride='carousel' data-ve='carousel' data-id='<?php echo $groupID?>'>
  <div class='carousel-inner'>
    <?php $height = 0; $index = 0;?>
    <?php foreach($slides as $slide):?>
    <?php $url    = empty($slide->mainLink) ? '' : " data-url='" . $slide->mainLink . "'";?>
    <?php $target = " data-target='" . (isset($slide->target) ? $slide->target : '') . "'";?>
    <?php if($height == 0 and $slide->height) $height = $slide->height;?>
    <?php if ($slide->backgroundType == 'image'): ?>
    <div class='item<?php if($index === 0) echo ' active';?>'<?php echo $url . ' ' . $target;?>>
    <?php print(html::image($slide->image));?>
    <?php else: ?>
    <div class='item<?php if($index === 0) echo ' active';?>'<?php echo $url . ' ' . $target;?> style='<?php echo 'background-color: ' . $slide->backgroundColor . '; height: ' . $height . 'px';?>'>
    <?php endif ?>
      <div class='carousel-caption'>
        <h2 style='color:<?php echo $slide->titleColor;?>'><?php echo $slide->title;?></h2>
        <div><?php echo $slide->summary;?></div>
        <?php
        foreach($slide->label as $key => $label):
        if(trim($label) != '')
        {
            if($slide->buttonUrl[$key])  echo html::a($slide->buttonUrl[$key], $label, "class='btn btn-{$slide->buttonClass[$key]}' target='{$slide->buttonTarget[$key]}'");
            if(!$slide->buttonUrl[$key]) echo html::commonButton($label, "btn {$slide->buttonClass[$key]}");
        }
        endforeach;
        ?>
      </div>
    </div>
    <?php $index++; ?>
    <?php endforeach;?>
  </div>
  <?php if(count($slides) > 1):?>
  <a class='left carousel-control' href='#<?php echo $slideId;?>' data-slide='prev'> <i class='icon icon-chevron-left'></i> </a>
  <a class='right carousel-control' href='#<?php echo $slideId;?>' data-slide='next'> <i class='icon icon-chevron-right'></i> </a>
  <?php endif;?>
</div>
</div>
<?php endif;?>
