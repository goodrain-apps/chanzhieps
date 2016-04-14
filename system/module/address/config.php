<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->address = new stdclass();
$config->address->require = new stdclass();
$config->address->require->create = 'account,address,phone,contact';
$config->address->require->edit   = 'account,address,phone,contact';
