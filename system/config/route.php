<?php
$config->seo = new stdclass();
$config->seo->alias = new stdclass();

$config->seo->alias->category = array();
$config->seo->alias->page     = array();
$config->seo->alias->method   = array();

$config->seo->alias->method['article']['browse'] = 'browse';  
$config->seo->alias->method['article']['view']   = 'view';  

$config->seo->alias->method['product']['browse'] = 'browse';  
$config->seo->alias->method['product']['view']   = 'view';  

$config->seo->alias->method['forum']['browse']   = 'board';  
$config->seo->alias->method['thread']['view']    = 'view';  

$config->seo->alias->method['blog']['browse']    = 'index';  
$config->seo->alias->method['blog']['view']      = 'view';  

$config->seo->alias->method['book']['browse']    = 'browse';  
$config->seo->alias->method['book']['view']      = 'read';  

$config->seo->alias->method['page']['view']      = 'view';  
