<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The view file of page for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     page
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php 
include TPL_ROOT . 'common/header.html.php';
include TPL_ROOT . 'common/files.html.php';
js::set('pageID', $page->id);
css::internal($page->css);
js::execute($page->js);
?>
<div class='block-region region-top blocks' data-region='page_view-top'><?php $this->loadModel('block')->printRegion($layouts, 'page_view', 'top');?></div>
<div id='page' data-id='<?php echo $page->id ?>'>
<div class='appheader'>
  <div class='heading'>
    <h2><?php echo $page->title;?></h2>
  </div>
</div>

<div class='panel-section article'>
  <div class='panel-body'>
    <hr class="space">
    <section class='article-content'>
      <?php echo $page->content;?>
    </section>
  </div>
  <?php if(!empty($page->files)):?>
  <section class="article-files">
    <?php $this->loadModel('file')->printFiles($page->files);?>
  </section>
  <?php endif;?>
  <div class='panel-footer'>
    <div class='article-moreinfo clearfix'>
      <?php if($page->keywords):?>
      <p class='small'><strong class="text-muted"><?php echo $lang->article->keywords;?></strong><span class="article-keywords"><?php echo $lang->colon . $page->keywords;?></span></p>
      <?php endif; ?>
    </div>
  </div>
</div>
</div>
<div class='block-region region-bottom blocks' data-region='page_view-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'page_view', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
