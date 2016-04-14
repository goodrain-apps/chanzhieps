<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The structure view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Yangyang Shi <shiyangyang@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php 
$appRoot = $this->app->getAppRoot();
$files   = json_decode($package->files);
echo '<pre>';
foreach($files as $file => $md5) echo $appRoot . $file . "<br />";
echo '</pre>';
?>  
<?php include '../../common/view/footer.modal.html.php';?>
