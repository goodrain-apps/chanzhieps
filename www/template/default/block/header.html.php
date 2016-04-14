<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The header view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php
$isSearchAvaliable = commonModel::isAvailable('search'); 
$setting           = !empty($block->content) ? json_decode($block->content) : new stdclass();
$device            = helper::getDevice();
$template          = $this->config->template->{$device}->name;
$theme             = $this->config->template->{$device}->theme;
$logoSetting       = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();
$logo              = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);

/* Set default header layout setting. */
$setting->compatible = zget($setting, 'compatible', 0);
$setting->nav        = zget($setting, 'nav',       'row');
$setting->slogan     = zget($setting, 'slogan',    'besideLogo');
$setting->searchbar  = zget($setting, 'searchbar', 'besideSlogan');

if($setting->compatible)
{
    include "header.default.html.php";
}
else
{
    include "header.layout.html.php";
}
