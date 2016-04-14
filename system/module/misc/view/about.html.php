<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<style>
#aboutNav {margin: 10px 0;}
#aboutNav > li > a {display: block; padding: 7px 8px 7px 40px;}
#aboutNav > li > a:hover, #aboutNav > li > a:active {background-color: #e5e5e5; text-decoration: none;}
</style>
<div class='row'>
  <div class='col-xs-6 text-center'>
    <?php echo html::image($this->config->webRoot . 'theme/default/default/images/main/logo.login.admin.png'); ?>
    <h4><?php printf($lang->misc->version, $config->version);?></h4>
  </div>
  <div class='col-xs-6' style='border-left: 1px solid #ddd'>
    <ul class='list-unstyled' id='aboutNav'>
      <li><?php echo html::a('http://api.chanzhi.org/goto.php?item=official', "<i class='icon-globe'></i> " . $lang->misc->offcialSite, "target='_blank'")?></li>
      <li><?php echo html::a('http://api.chanzhi.org/goto.php?item=support', "<i class='icon-question-sign'></i> " . $lang->misc->support, "target='_blank'")?></li>
      <li><?php echo html::a('http://api.chanzhi.org/goto.php?item=book', "<i class='icon-book'></i> " . $lang->misc->userbook, "target='_blank'")?></li>
      <li><?php echo html::a('http://api.chanzhi.org/goto.php?item=forum', "<i class='icon-comments-alt'></i> " . $lang->misc->forum, "target='_blank'")?></li>
    </ul>
  </div>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
