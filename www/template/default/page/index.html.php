<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php $common->printPositionBar();?>
<div class='row blocks' data-region='page_index-top'><?php $this->block->printRegion($layouts, 'page_index', 'top', true);?></div>
<div class='row'>
  <div class='col-md-9'>
    <div class='list list-condensed'>
      <header><h2><?php echo $this->lang->page->list;?></h2></header>
      <section class='items items-hover' id='pageList'>
        <?php foreach($pages as $page):?>
        <?php $url = inlink('view', "id=$page->id", "name=$page->alias");?>
        <div class='item' id='page<?php echo $page->id;?>' data-ve='page'>
          <div class='item-heading'>
            <h4><?php echo html::a($url, $page->title);?></h4>
          </div>
          <div class='item-content'>
            <?php if(!empty($page->image)):?>
            <div class='media pull-right'>
              <?php
              $title = $page->image->primary->title ? $page->image->primary->title : $page->title;
              echo html::a($url, html::image($page->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
              ?>
            </div>
            <?php endif;?>
            <div class='text text-muted'><?php echo helper::substr($page->summary, 120, '...');?></div>
          </div>
          <div class='item-footer text-muted'>
            <span><i class='icon-eye-open'></i> <?php echo $page->views;?></span> &nbsp;
            <span><i class='icon-time'></i> <?php echo substr($page->addedDate, 0, 10);?></span>
          </div>
        </div>
        <?php endforeach;?>
      </section>
    </div>
  </div>
  <div class='col-md-3'><side class='page-side blocks blocks' data-region='page_index-side'><?php $this->block->printRegion($layouts, 'page_index', 'side');?></side></div>
</div>
<div class='row blocks' data-region='page_index-bottom'><?php $this->block->printRegion($layouts, 'page_index', 'bottom', true);?></div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
