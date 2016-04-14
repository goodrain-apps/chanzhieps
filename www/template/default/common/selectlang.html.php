<?php if(!defined("RUN_MODE")) die();?>
<?php $clientLang = $this->app->getClientLang();?>
<a href='###' class='dropdown-toggle' data-toggle='dropdown'><i class='icon-globe icon-large'></i> &nbsp;<?php echo $config->langs[$clientLang]?><span class='caret'></span></a>
<ul class='dropdown-menu'>
  <?php
  $langs = $config->langs;
  unset($langs[$clientLang]);
  foreach($langs as $langKey => $currentLang) echo "<li><a rel='nofollow' href='javascript:selectLang(\"$langKey\")'>$currentLang</a></li>";
  ?>
</ul>
