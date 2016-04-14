<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The wechat qrcode front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
$block->content = json_decode($block->content);
$publicList = $this->loadModel('wechat')->getList();
?>
<?php if(!empty($publicList)):?>
<div id="block<?php echo $block->id;?>" class='panel panel-block hidden-sm hidden-xs <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
    <?php if(!empty($block->content->moreText) and !empty($block->content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($block->content->moreUrl, $block->content->moreText);?></div>
    <?php endif;?>
  </div>
  <div class='cards borderless with-icon'>
    <?php foreach($publicList as $public):?>
    <div class='card'>
      <i class='icon icon-s3 icon-wechat bg-success circle'></i>
      <div class='card-content'>
        <?php if($public->qrcode): ?>
        <div class='pull-right'>
          <a href='###' class='bg-primary-pale text-primary block' data-toggle='modal' data-type='custom' data-custom="<div class='text-center'><?php echo html::image($public->qrcode);?></div>" data-icon='qrcode' data-title='<?php echo $public->name ?>'><i class='icon icon-s3 icon-qrcode'></i></a>
        </div>
        <?php endif; ?>
        <small class="text-muted"><?php echo $this->lang->wechatTip?></small>
        <div class="lead"><?php echo $public->name;?></div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
