<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->wechat->require = new stdclass();
$config->wechat->require->create = 'name,account,token';
$config->wechat->require->edit   = 'name,account,token,appID,appSecret';
