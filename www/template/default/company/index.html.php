<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php'; ?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='row blocks' data-region='company_index-topBanner'><?php $this->block->printRegion($layouts, 'company_index', 'topBanner', true);?></div>
<div class="row">
  <?php if(isset($layouts['company_index']['side'])):?>
  <div class="col-md-9 col-main">
  <?php else:?>
  <div class="col-md-12">
  <?php endif;?>
    <div class='row blocks' data-region='company_index-top'><?php $this->block->printRegion($layouts, 'company_index', 'top', true);?></div>
    <div class='panel' id='company'>
      <div class='panel-heading'><strong><i class='icon-group'></i> <?php echo $lang->aboutUs; ?></strong></div>
      <div class="panel-body">
        <div class='article-content'>
          <?php echo $company->content;?>
        </div>
      </div>
    </div>
    <div class='row blocks' data-region='company_index-bottom'><?php $this->block->printRegion($layouts, 'company_index', 'bottom', true);?></div>
  </div>
  <?php if(isset($layouts['company_index'])):?>
  <div class='col-md-3 col-side'><side class='page-side blocks' data-region='company_index-side'><?php $this->block->printRegion($layouts, 'company_index', 'side');?></side></div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='company_index-bottomBanner'><?php $this->block->printRegion($layouts, 'company_index', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
