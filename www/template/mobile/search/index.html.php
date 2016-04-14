<?php if(!defined("RUN_MODE")) die();?>
<?php 
include TPL_ROOT . 'common/header.html.php';
?>
<div class='panel panel-section'>
  <div class='panel-heading'>
    <div class='titile'><i class='icon-search'></i> <?php echo $lang->search->index;?></div>
  </div>
  <div class='cards condensed cards-list'>
  <?php foreach($results as $object):?>
    <a class='card' href='<?php echo $object->url?>'>
      <div class='card-heading'>
        <h5><?php echo $object->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'><?php echo $object->summary;?></div>
          <div class='card-footer small text-muted'>
            <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($object->addedDate, 0, 10);?></span>
          </div>
        </div>
        <?php if(!empty($object->image)):?>
        <div class='table-cell thumbnail-cell'>
        <?php
          $title = $object->image->primary->title ? $object->image->primary->title : $object->title;
          echo html::a($url, html::image($object->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
        ?>
        </div>
        <?php endif;?>
      </div>
    </a>
  <?php endforeach;?>
  </div>
  <div class='panel-footer'>
    <div class='small text-muted'><?php printf($lang->search->executeInfo, $pager->recTotal, $consumed);?></div>
    <hr class='space'>
    <?php $pager->show('justify');?>
  </div>
</div>
<script>
$(function(){$('#searchToggle').dropdown('toggle');});
</script>
<?php include TPL_ROOT . 'common/footer.html.php';?>
