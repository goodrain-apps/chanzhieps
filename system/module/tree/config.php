<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->tree->langs = new stdclass();
$config->tree->langs->forum = 'board';

$config->tree->menuGroups = new stdclass();
$config->tree->menuGroups->forum   = 'forum';
$config->tree->menuGroups->article = 'article';
$config->tree->menuGroups->product = 'product';
$config->tree->menuGroups->blog    = 'blog';
$config->tree->menuGroups->express = 'orderSetting';

$config->tree->editableTypes = ",article,product,blog,forum,";

$config->tree->gradeLimits = new stdclass;
$config->tree->gradeLimits->slide   = 1;
$config->tree->gradeLimits->forum   = 2;
$config->tree->gradeLimits->express = 1;

$config->tree->require = new stdclass();
$config->tree->require->edit = 'name';
$config->tree->require->link = 'name, link';

$config->tree->editor = new stdclass();
$config->tree->editor->edit = array('id' => 'desc', 'tools' => 'simple');

$config->tree->systemModules  = ',admin,block,book,captcha,company,file,index,links,message,';
$config->tree->systemModules .= 'nav,product,rss,site,slide,thread,ui,user,article,blog,cache,';
$config->tree->systemModules .= 'common,error,forum,install,mail,misc,page,reply,setting,sitemap,tag,tree,upgrade,';
