<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The install view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if($canManage['result'] == 'success'):?>
<?php js::set('browseLink', inlink('browse'));?>
<?php if($error):?>
<div class='alert alert-default'>
  <i class='icon-remove-sign'></i>
  <div class='content'>
    <h4><?php sprintf($lang->package->installFailed, $installType);?></h4>
    <p><?php echo $error;?></p>
    <hr>
    <?php echo html::a('javascript:;', $lang->package->refreshPage, "class='btn btn-reload'");?>
  </div>
</div>
<?php elseif(isset($license)):?>
<div class='alert'>
  <i class='icon-info-sign'></i>
  <div class='content'>
    <h4><?php echo $lang->package->license;?></h4>
    <p><?php echo html::textarea('license', $license, "class='form-control' disabled rows='15'");?></p>
    <?php echo html::a($agreeLink, $lang->package->agreeLicense, "class='btn btn-primary loadInModal'");?>
  </div>
</div>
<?php else:?>
<div class='alert'>
  <h2 class='text-center text-success'><?php echo sprintf($lang->package->installFinished, $installType);?></h2>
  <div class='text-center'>
    <?php if($type == 'template'):?>
    <?php echo html::a($this->createLink('ui', 'settemplate'), $lang->package->settemplate, "class='btn btn-primary'");?>
    <?php else:?>
    <?php echo html::a('javascript:;', $lang->package->viewInstalled, "class='btn btn-primary' onclick='return parent.location.href=v.browseLink'");?>
    <?php endif;?>
  </div>
  <?php
  echo "<h5 class='success'>{$lang->package->successInstallDB}</h5>";
  echo "<h5 class='success'>{$lang->package->successCopiedFiles}</h5>";
  echo '<pre>';
  foreach($files as $fileName => $md5)
  {
      echo "$fileName<br/>";
  }
  echo '</pre>';
  ?>
</div>
<?php endif;?>
<?php else:?>
<div>
  <?php printf($lang->guarder->okFileVerify, $canManage['name'], $canManage['content']);?>
  <div class='text-right'><?php echo html::a('javascript:;', $lang->confirm, "class='btn btn-primary okFile' onclick='$.reloadAjaxModal()'");?></div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
