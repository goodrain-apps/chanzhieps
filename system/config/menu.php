<?php
$config->menus = new stdclass();
$config->menus->home    = 'admin,order,message,comment,reply,thread,forumreply';
$config->menus->content = 'article,page,blog,book,submittion';
$config->menus->shop    = 'order,product,orderSetting';
$config->menus->user    = 'user,message,comment,reply,forum,wechat,submittion';
$config->menus->promote = 'stat,tag,links,setstat,';
$config->menus->design  = 'ui,logo,slide,nav,block,visual,others';
$config->menus->setting = 'site,company,security';
$config->menus->open    = 'package,themestore';

$config->menuGroups = new stdclass();
foreach($config->menus as $group => $modules)
{
    $menus = explode(',', $modules);
    foreach($menus as $menu)
    {
        if($menu) $config->menuGroups->$menu = $group;
    }
}

$config->multiEntrances = array();
$config->multiEntrances[] = 'order_admin';
$config->multiEntrances[] = 'message_admin';
$config->multiEntrances[] = 'forum_admin';
$config->multiEntrances[] = 'reply_admin';
$config->multiEntrances[] = 'article_admin';

$config->menuDependence = new stdclass();
$config->menuDependence->submittion   = 'submittion';
$config->menuDependence->page         = 'page';
$config->menuDependence->blog         = 'blog';
$config->menuDependence->orderSetting = 'product';

$config->menuExtra = new stdclass();
$config->menuExtra->visual = "target='_blank'";

$config->moduleMenu = new stdclass();
