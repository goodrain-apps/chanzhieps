<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->package = new stdclass();
$config->package->apiRoot   = 'http://api.chanzhi.org/extension-';
$config->package->extPathes = array('module', 'bin', 'www', 'library', 'config');
