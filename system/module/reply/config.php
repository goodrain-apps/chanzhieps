<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->reply->recPerPage = 10;

$config->reply->editor = new stdclass();
$config->reply->editor->edit = array('id' => 'content', 'tools' => 'simple');

$config->reply->require = new stdclass();
$config->reply->require->post = 'content';
$config->reply->require->edit = 'content';
