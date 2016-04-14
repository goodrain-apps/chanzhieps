<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The common simplified chinese file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      DaiTingting 
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.zentao.net
 */

$lang->nav->common   = '導航設置';
$lang->nav->setNav   = '導航設置';
$lang->nav->add      = '添加';
$lang->nav->addChild = '添加子導航';
$lang->nav->delete   = '刪除導航';

$lang->nav->inputUrl        = '請輸入連結';
$lang->nav->inputTitle      = '請輸入標題';
$lang->nav->cannotRemoveAll = '不能刪除所有導航';

/* nav type   */
$lang->nav->types['system']  = '系統模組';
$lang->nav->types['article'] = '文章類目';
$lang->nav->types['blog']    = '博客類目';
$lang->nav->types['product'] = '產品類目';
$lang->nav->types['page']    = '單頁';
$lang->nav->types['custom']  = '自定義';

/* common navs.*/
$lang->nav->system = new stdclass();
$lang->nav->system->home    = '首頁';
$lang->nav->system->company = '關於我們';
$lang->nav->system->contact = '聯繫我們';
$lang->nav->system->forum   = '論壇';
$lang->nav->system->blog    = '博客';
$lang->nav->system->book    = '手冊';
$lang->nav->system->message = '留言';

$lang->nav->desktop       = '桌面';
$lang->nav->desktop_blog  = '博客';
$lang->nav->mobile_top    = '移動版頂部';
$lang->nav->mobile_bottom = '移動版底部';
$lang->nav->mobile_blog   = '移動版博客';

/* Targets setting. */
$lang->nav->targetList = array();
$lang->nav->targetList['_self']  = '當前窗口';
$lang->nav->targetList['_blank'] = '新開窗口';
$lang->nav->targetList['modal']  = '彈出窗口';
