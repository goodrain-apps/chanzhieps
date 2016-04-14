<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The index view file of page for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     page
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='block-region region-top blocks' data-region='page_index-top'><?php $this->loadModel('block')->printRegion($layouts, 'page_index', 'top');?></div>
<div class='panel panel-section'>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $this->lang->page->list;?></strong></div>
  </div>
  <div class='cards condensed cards-list' id='pageList'>
    <?php foreach($pages as $page):?>
    <?php $url = inlink('view', "id=$page->id", "name=$page->alias");?>
    <a class='card' href='<?php echo $url?>' id='page<?php echo $page->id?>' data-ve='page'>
      <div class='card-heading'>
        <h5><?php echo $page->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'><?php echo helper::substr($page->summary, 60, '...');?></div>
          <div class='card-footer small text-muted'>
            <span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $page->views;?></span>
            <?php if($page->comments):?>&nbsp;&nbsp; <span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $page->comments;?></span> &nbsp;<?php endif;?>
            &nbsp;&nbsp; <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($page->addedDate, 0, 10);?></span>
          </div>
        </div>
        <?php if(!empty($page->image)):?>
        <div class='table-cell thumbnail-cell'>
        <?php
          $title = $page->image->primary->title ? $page->image->primary->title : $page->title;
          echo html::a($url, html::image($page->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
        ?>
        </div>
        <?php endif;?>
      </div>
    </a>
    <?php endforeach;?>
  </div>
</div>

<div class='block-region region-bottom blocks' data-region='page_index-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'page_index', 'bottom');?></div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
