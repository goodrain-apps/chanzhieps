<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of upgrade license method of upgrade module of ChanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      chujilu <chujilu@cnezsoft.com>
 * @package     upgrade
 * @version     $Id: selectversion.html.php 1292 2014-06-05 03:03:52Z guanxiying $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<form method='post'>
  <div class='container'>
    <div class='modal-dialog modal-lg'>
      <div class='modal-header'>
        <h3><?php echo $lang->upgrade->updateLicense;?></h3>
      </div>
      <div class='modal-body'>
        <?php echo html::textarea('license', $license, "class='form-control mgb-10' rows='12'")?>
        <div class='text-left mgb-10'>
          <label class='checkbox-inline'><input type='checkbox' id='agree' checked='checked' /><?php echo $lang->agreement;?></label>
        </div>
      </div>
      <div class='modal-footer'>
        <?php echo html::a(inlink('upgradelicense', 'agree=true'), $lang->upgrade->next, "class='btn btn-primary btn-install'");?>
      </div>
    </div>
  </div>
</form>
<?php include '../../install/view/footer.html.php';?>
