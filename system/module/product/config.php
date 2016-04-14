<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->product->recPerPage = 15;

$config->product->require = new stdclass();
$config->product->require->create = 'categories, name, content';
$config->product->require->edit   = 'categories, name, content';

$config->product->editor = new stdclass();
$config->product->editor->create = array('id' => 'desc,content', 'tools' => 'full');
$config->product->editor->edit   = array('id' => 'desc,content', 'tools' => 'full');

if(!isset($config->product->currency)) $config->product->currency = 'rmb';
if(!isset($config->product->currencySymbol)) $config->product->currencySymbol = '￥';
