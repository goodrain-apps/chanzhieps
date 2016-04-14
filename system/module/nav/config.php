<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The nav config file of chanzhiEPS. 
 * 
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html
 * @author      Xiying Guan
 * @package     nav
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$config->nav->system = new stdclass();

$config->nav->system->home    = 'index|index';
$config->nav->system->company = 'company|index';
$config->nav->system->contact = 'company|contact';
$config->nav->system->forum   = 'forum|index';
$config->nav->system->blog    = 'blog|index';
$config->nav->system->book    = 'book|index';
$config->nav->system->message = 'message|index';
