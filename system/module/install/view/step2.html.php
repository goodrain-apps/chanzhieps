<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of step2 method of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog'>
    <form method='post' action='<?php echo $this->createLink('install', 'step3');?>' class='form-inline' id='form1'>
      <div class='modal-header'><strong><?php echo $lang->install->setConfig;?></strong></div>
      <div class='modal-body'>
        <table class='table table-bordered table-form'>
          <thead>
            <tr class='text-center'>
              <th class='w-p20'><?php echo $lang->install->key;?></th>
              <th colspan='2'><?php echo $lang->install->value?></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th><?php echo $lang->install->dbHost;?></th>
              <td><?php echo html::input('dbHost', '127.0.0.1', "class='form-control'");?></td>
              <td><?php echo $lang->install->dbHostNote;?></td>
            </tr>
            <tr>
              <th><?php echo $lang->install->dbPort;?></th>
              <td><?php echo html::input('dbPort', '3306', "class='form-control'");?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->install->dbUser;?></th>
              <td><?php echo html::input('dbUser', '', "class='form-control'");?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->install->dbPassword;?></th>
              <td><?php echo html::input('dbPassword', '', "class='form-control'");?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->install->dbName;?></th>
              <td><?php echo html::input('dbName', '', "class='form-control'");?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->install->dbPrefix;?></th>
              <td><?php echo html::input('dbPrefix', 'eps_', "class='form-control'");?></td>
              <td><?php echo html::checkBox('clearDB', $lang->install->clearDB);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class='modal-footer'>
        <?php echo html::hidden('requestType','PATH_INFO2');?>
        <?php echo html::submitButton();?>
      </div>
    </form>
  </div>
</div>
<?php include './footer.html.php';?>
