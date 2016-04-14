<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<article class='text-center'>
  <h2 class='text-success'><strong><?php echo $lang->misc->thanksTitle;?></strong></h2>
<div class='row'>
  <?php foreach($this->config->thanksList as $item => $link):?>
  <div class='col-md-3'>
    <a target='_blank' href="<?php echo $link;?>" class='card'>
      <strong class='card-heading'><?php echo $item;?></strong>
    </a>
  </div>
  <?php endforeach;?>
</div>
<div class="right-footer">
  <?php printf($lang->misc->thanksFooter, "<a href='http://www.zzsec.com/' target='_blank' style='color: green'><strong>" . $lang->misc->thanksObjectName . '</strong></a>');?>
</div>
  
<?php include '../../common/view/footer.modal.html.php';?>
