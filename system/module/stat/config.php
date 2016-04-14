<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->stat = new stdclass();

$config->stat->searchEngines = array();
$config->stat->searchEngines[] = 'haosou';
$config->stat->searchEngines[] = 'bing';
$config->stat->searchEngines[] = 'sogou';
$config->stat->searchEngines[] = 'other';

$config->stat->hourLabels  = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23);
$config->stat->monthLabels = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', 10, 11, 12);

$config->stat->chartColors = array('green', 'blue', 'red', '#F1A325', '#8666B8', '#333333', '#F745C1', '#EAF210', '#EDEDED', '#9A3AAD', '#34A4A8');
