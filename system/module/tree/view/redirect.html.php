<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The redirect view file of tree module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>

<div class='form-group'>
<div class='col-xs-6 col-md-6 col-md-offset-3 alert'>
  <i class='icon-info-sign'></i>
  <div class='content'>
    <h4><?php echo $message; ?></h4>
    <p><?php echo $lang->tree->timeCountDown; ?></p>
    <?php commonModel::printLink('tree', 'browse', "type=$type", $lang->tree->redirect, "class='btn btn-primary' id='countDownBtn'"); ?>
  </div>
</div>
</div>

<?php include '../../common/view/footer.admin.html.php';?>
