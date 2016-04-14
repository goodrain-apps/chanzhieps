<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->slide->editor = new stdclass();
$config->slide->editor->create = array('id' => 'summary', 'tools' => 'full');
$config->slide->editor->edit   = array('id' => 'summary', 'tools' => 'full');

$config->slide->require = new stdclass();
$config->slide->require->create = 'backgroundColor,height';
$config->slide->require->edit   = 'backgroundColor,height';
