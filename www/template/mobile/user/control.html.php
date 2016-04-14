<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>

<hr class='space'>
<div class='panel panel-body panel-section'>
  <div class='alert bg-primary-pale'><?php printf($lang->user->control->welcome, $this->app->user->realname);?></div>
</div>

<?php include TPL_ROOT . 'user/side.html.php';?>

<?php include TPL_ROOT . 'common/footer.html.php';?>
