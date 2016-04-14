<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The common simplified chinese file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      DaiTingting 
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$lang->nav->common   = 'Navigation';
$lang->nav->setNav   = 'Navigation';
$lang->nav->add      = 'Add';
$lang->nav->addChild = 'Child';
$lang->nav->delete   = 'Delete';

$lang->nav->inputUrl        = 'Please input url.';
$lang->nav->inputTitle      = 'Please input title.';
$lang->nav->cannotRemoveAll = 'Can not remove all navigation.';

/* nav type   */
$lang->nav->types['system']  = 'System modules';
$lang->nav->types['article'] = 'Article categories';
$lang->nav->types['blog']    = 'Blog categories';
$lang->nav->types['product'] = 'Product categories';
$lang->nav->types['page']    = 'Pages';
$lang->nav->types['custom']  = 'Custom';

/* common navs.*/
$lang->nav->system = new stdclass();
$lang->nav->system->home    = 'Home';
$lang->nav->system->company = 'About';
$lang->nav->system->contact = 'Contact';
$lang->nav->system->forum   = 'Forum';
$lang->nav->system->blog    = 'Blog';
$lang->nav->system->book    = 'Book';
$lang->nav->system->message = 'Inquire';

$lang->nav->desktop       = 'Desktop';
$lang->nav->desktop_blog  = 'Blog';
$lang->nav->mobile_top    = 'Top Of Mobile';
$lang->nav->mobile_bottom = 'Bottom Of Mobile';
$lang->nav->mobile_blog   = 'Blog Of Mobile';

/* Targets setting. */
$lang->nav->targetList = array();
$lang->nav->targetList['_self']  = 'Current window';
$lang->nav->targetList['_blank'] = 'New window';
$lang->nav->targetList['modal']  = 'Modal window';
