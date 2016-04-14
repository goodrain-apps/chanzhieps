<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->order = new stdclass();
$config->order->require = new stdclass();
$config->order->require->create   = 'account,address';
$config->order->require->delivery = 'deliveriedDate,express,waybill,deliveriedBy';
$config->order->require->setting  = 'payment,pid,key,confirmLimit,email';
