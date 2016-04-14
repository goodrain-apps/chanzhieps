<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->article->require = new stdclass();
$config->article->require->create         = 'categories, title, content';
$config->article->require->page           = 'title, content';
$config->article->require->link           = 'categories, title, link';
$config->article->require->pageLink       = 'title, link';
$config->article->require->edit           = 'categories, title, content';
$config->article->require->forward2Blog   = 'categories';
$config->article->require->forward2Forum  = 'board';
$config->article->require->post           = 'title, content';
$config->article->require->modify         = 'title, content';

$config->article->editor = new stdclass();
$config->article->editor->create = array('id' => 'content', 'tools' => 'full');
$config->article->editor->edit   = array('id' => 'content', 'tools' => 'full');
$config->article->editor->post   = array('id' => 'content', 'tools' => 'simple');
$config->article->editor->modify = array('id' => 'content', 'tools' => 'simple');

/* Set the recPerPage of article. */
$config->article->recPerPage = 5;
