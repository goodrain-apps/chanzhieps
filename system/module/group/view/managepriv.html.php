<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The manage privilege view of group module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     group
 * @version     $Id: managepriv.html.php 4129 2013-01-18 01:58:14Z wwccss $
 * @link        http://www.ranzhico.com
 */
?>
<?php 
include '../../common/view/header.admin.html.php';
if($type == 'byGroup')  include 'privbygroup.html.php';
if($type == 'byModule') include 'privbymodule.html.php';
include '../../common/view/footer.admin.html.php';
