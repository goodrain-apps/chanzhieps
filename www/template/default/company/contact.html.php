<?php if(!defined("RUN_MODE")) die();?>
<?php 
include TPL_ROOT . 'common/header.html.php';
?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='panel' id='companyContact'>
  <div class='panel-heading'>
    <strong><i class='icon icon-comments-alt'></i> <?php echo $lang->company->contact;?></strong>
    <?php if(!empty($block->content->moreText) and !empty($block->content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($block->content->moreUrl, $block->content->moreText);?></div>
    <?php endif;?>
  </div>
  <div class='panel-body'>
    <table class='table table-data'>
      <?php foreach($contact as $item => $value):?>
      <tr>
        <th><?php echo $this->lang->company->$item . $this->lang->colon;?></th>
        <td><?php echo $value;?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
