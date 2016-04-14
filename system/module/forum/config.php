<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->forum->newDays     = 3;
$config->forum->recPerPage  = 10;
if(!isset($config->forum->postReview)) $config->forum->postReview = 'close';
