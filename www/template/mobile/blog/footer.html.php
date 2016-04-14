<?php if(!defined("RUN_MODE")) die();?>
<div class='block-region region-all-bottom blocks' data-region='all-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'all', 'bottom');?></div>
<footer  class="appbar fix-bottom">
  <ul class="nav">
    <li><?php echo html::a(helper::createLink('rss', 'index', '?type=blog', '', 'xml'), "<i class='icon-rss text-warning'></i> " . $lang->blog->subscribe, "target='_blank' class='text-important'"); ?></li>
    <?php if(!isset($this->config->site->type) or $this->config->site->type != 'blog'):?>
    <li><?php echo html::a($config->webRoot, "<i class='icon icon-home'></i> {$lang->blog->siteHome}", "class='text-primary'");?></li>
    <?php endif; ?>
  </ul>
</footer>
<?php if(isset($pageJS)) js::execute($pageJS); ?>
<div class='block-region region-all-footer hidden blocks' data-region='all-footer'><?php $this->loadModel('block')->printRegion($layouts, 'all', 'footer');?></div>
<?php include TPL_ROOT . 'common/log.html.php';?>
</body>
</html>
