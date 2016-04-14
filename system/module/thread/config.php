<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->thread->newDays = 3;

$config->thread->editor = new stdclass();
$config->thread->editor->post = array('id' => 'content', 'tools' => 'simple');
$config->thread->editor->view = array('id' => 'content', 'tools' => 'simple');
$config->thread->editor->edit = array('id' => 'content', 'tools' => 'simple');

$config->thread->require = new stdclass();
$config->thread->require->post = 'title, content';
$config->thread->require->edit = 'title, content';
$config->thread->require->link = 'title, link';
