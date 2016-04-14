<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
  <?php if(RUN_MODE == 'front') $this->loadModel('block')->printRegion($layouts, 'all', 'bottom');?>
  </div></div><?php /* end div.page-content then div.page-wrapper in header.html.php */?>
  <footer id='footer' class='clearfix'>
    <div class='wrapper'>
      <div id='footNav'>
        <?php
        echo html::a($this->createLink('sitemap', 'index'), "<i class='icon-sitemap'></i> " . $lang->sitemap->common, "class='text-link'");

        if(empty($this->config->links->index) && !empty($this->config->links->all)) echo '&nbsp;' . html::a($this->createLink('links', 'index'), "<i class='icon-link'></i> " . $this->lang->link);
        ?>
      </div>
      <span id='copyright'>
        <?php
        $copyright = empty($config->site->copyright) ? '' : $config->site->copyright . '-';
        $contact   = json_decode($config->company->contact); 
        $company   = (empty($contact->site) or $contact->site == $this->server->http_host) ? $config->company->name : html::a('http://' . $contact->site, $config->company->name, "target='_blank'");
        echo "&copy; {$copyright}" . date('Y') . ' ' . $company . '&nbsp;&nbsp;';
        ?>
      </span>
      <span id='icpInfo'><?php echo $config->site->icpSN; ?></span>
      <div id='powerby'>
        <?php printf($lang->poweredBy, $config->version, k(), $config->version); ?>
      </div>
    </div>
  </footer>
   
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);

/* Load hook files for current page. */
$extPath      = dirname(dirname(dirname(__FILE__))) . '/common/ext/view/';
$extHookRule  = $extPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;

/* Load hook file for site.*/
$siteExtPath  = dirname(dirname(dirname(__FILE__))) . "/common/ext/_{$config->site->code}/view/";
$extHookRule  = $siteExtPath . 'footer.front.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
?>
<a href='#' id='go2top' class='icon-arrow-up' data-toggle='tooltip' title='<?php echo $lang->back2Top; ?>'></a>
</div><?php /* end "div.page-container" in "header.html.php" */ ?>
<?php include dirname(__FILE__) . '/qrcode.html.php';?>
<div class='hide'><?php if(RUN_MODE == 'front') $this->loadModel('block')->printRegion($layouts, 'all', 'footer');?></div>
</body>
</html>
