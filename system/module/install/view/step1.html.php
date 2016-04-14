<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of step1 method of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<?php
$wholeResult = strpos($phpResult . $pdoResult . $pdoMySQLResult . $tmpRootResult . $dataRootResult, 'fail') !== false ? 'fail' : 'ok';
js::set('wholeResult', $wholeResult);
?>
<div class='container'>
  <div class='modal-dialog'>
    <div class='modal-header'><strong><?php echo $lang->install->checking;?></strong></div>
    <div class='modal-body'>
      <table class='table table-bordered'>
        <thead>
          <tr>
            <th class='w-p20'><?php echo $lang->install->checkItem;?></th>
            <th class='w-p20'><?php echo $lang->install->current?></th>
            <th><?php echo $lang->install->result?></th>
            <th class='hide-on-ok'><?php echo $lang->install->action?></th>
          </tr>
        </thead>
        <tr>
          <th><?php echo $lang->install->phpVersion;?></th>
          <td><?php echo $phpVersion;?></td>
          <td class='<?php echo $phpResult;?>'><?php echo $lang->install->$phpResult;?></td>
          <td class='small hide-on-ok'><?php if($phpResult == 'fail') echo $lang->install->phpFail;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->install->pdo;?></th>
          <td><?php $pdoResult == 'ok' ? printf($lang->install->loaded) : printf($lang->install->unloaded);?></td>
          <td class='<?php echo $pdoResult;?>'><?php echo $lang->install->$pdoResult;?></td>
          <td class='small hide-on-ok'><?php if($pdoResult == 'fail') echo $lang->install->pdoFail;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->install->pdoMySQL;?></th>
          <td><?php $pdoMySQLResult == 'ok' ? printf($lang->install->loaded) : printf($lang->install->unloaded);?></td>
          <td class='<?php echo $pdoMySQLResult;?>'><?php echo $lang->install->$pdoMySQLResult;?></td>
          <td class='small hide-on-ok'><?php if($pdoMySQLResult == 'fail') echo $lang->install->pdoMySQLFail;?></td>
        </tr>
        <tr>
          <th><?php echo $lang->install->tmpRoot;?></th>
          <td>
            <?php
            $tmpRootInfo['exists']   ? print($lang->install->exists)   : print($lang->install->notExists);
            $tmpRootInfo['writable'] ? print($lang->install->writable) : print($lang->install->notWritable);
            ?>
          </td>
          <td class='<?php echo $tmpRootResult;?>'><?php echo $lang->install->$tmpRootResult;?></td>
          <td class='small hide-on-ok'>
            <?php 
            if(!$tmpRootInfo['exists'])   printf($lang->install->mkdir, $tmpRootInfo['path'], $tmpRootInfo['path']);
            if(!$tmpRootInfo['writable']) printf($lang->install->chmod, $tmpRootInfo['path'], $tmpRootInfo['path']);
            ?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->install->dataRoot;?></th>
          <td>
            <?php
            $dataRootInfo['exists']   ? print($lang->install->exists)   : print($lang->install->notExists);
            $dataRootInfo['writable'] ? print($lang->install->writable) : print($lang->install->notWritable);
            ?>
          </td>
          <td class='<?php echo $dataRootResult;?>'><?php echo $lang->install->$dataRootResult;?></td>
          <td class='small hide-on-ok'>
            <?php 
            if(!$dataRootInfo['exists'])   printf($lang->install->mkdir, $dataRootInfo['path'], $dataRootInfo['path']);
            if(!$dataRootInfo['writable']) printf($lang->install->chmod, $dataRootInfo['path'], $dataRootInfo['path']);
            ?>
          </td>
        </tr>
      </table>
      <?php if($pdoResult == 'fail' or $pdoMySQLResult == 'fail'):?>
      <div class='alert'><?php echo "<p class='small text-left'>" . '<strong>' . $lang->install->phpINI . '</strong><br />' . nl2br($this->install->getIniInfo()) . '</p>';?></div>
      <?php endif;?>
    </div>
    <div class='modal-footer'>
    <?php
    if($wholeResult == 'ok')   echo html::a(inLink('step2'), $lang->install->next, "class='btn btn-primary'");
    if($wholeResult == 'fail') echo html::a(inLink('step1'), $lang->install->reload, "class='btn btn-primary'");
    ?>
    </div>
  </div>
</div>

<?php include './footer.html.php';?>
