<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     package
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading clearfix'>
    <ul id='typeNav' class='nav nav-tabs pull-left'>
      <li data-type='internal' <?php echo $status == 'installed' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('browse', "status=installed"), $lang->package->installed);?>
      </li>
      <li data-type='internal' <?php echo $status == 'deactivated' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('browse', "status=deactivated"), $lang->package->deactivated);?>
      </li>
      <li data-type='internal' <?php echo $status == 'available' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('browse', "status=available"), $lang->package->available);?>
      </li>
    </ul> 
    <div class='panel-actions'>
      <?php commonModel::printLink('package', 'upload', '', $lang->package->upload, "class='btn btn-primary' data-toggle='modal'");?>
      <?php commonModel::printLink('package', 'obtain', '', $lang->package->obtain, "class='btn btn-primary'");?>
    </div>
  </div>
  <div class='panel-body'>
  <div class='cards'>
    <?php
    $structurePriv  = commonModel::hasPriv('package', 'structure');
    $deactivatePriv = commonModel::hasPriv('package', 'deactivate');
    $activatePriv   = commonModel::hasPriv('package', 'activate');
    $uninstallPriv  = commonModel::hasPriv('package', 'uninstall');
    $installPriv    = commonModel::hasPriv('package', 'install');
    $erasePriv      = commonModel::hasPriv('package', 'erase');
    ?>
    <?php foreach($packages as $package):?>
    <div class='col-md-6'><div class='card'>
      <div class='card-heading'><strong><?php echo $package->name;?></strong></div>
      <div class='card-content text-muted'><?php echo $package->desc;?></div>
        <div class='card-actions'>
          <div class='pull-right'>
            <div class='btn-group'>
              <?php
              $structureCode  = $structurePriv  ? html::a(inlink('structure',  "package=$package->code"), $lang->package->structure,  "class='btn' data-toggle='modal'") : '';
              $deactivateCode = $deactivatePriv ? html::a(inlink('deactivate', "package=$package->code"), $lang->package->deactivate, "class='btn' data-toggle='modal'") : '';
              $activateCode   = $activatePriv   ? html::a(inlink('activate',   "package=$package->code"), $lang->package->activate,   "class='btn' data-toggle='modal'") : '';
              $uninstallCode  = $uninstallPriv  ? html::a(inlink('uninstall',  "package=$package->code"), $lang->package->uninstall,  "class='btn' data-toggle='modal'") : '';
              $installCode    = $installPriv    ? html::a(inlink('install',    "package=$package->code"), $lang->package->install,    "class='btn' data-toggle='modal'") : '';
              $eraseCode      = $erasePriv      ? html::a(inlink('erase',      "package=$package->code"), $lang->package->erase,      "class='btn' data-toggle='modal'") : '';
              
              if(isset($package->viewLink))
              {
                  echo html::a($package->viewLink, $lang->package->view, "class='btn package'");
              }
              if($package->status == 'installed')
              {
                  echo $structureCode;
              }
              if($package->status == 'installed' and !empty($package->upgradeLink))
              {
                  echo html::a($package->upgradeLink, $lang->package->upgrade, "class='btn iframe'");
              }
   
              if($package->type != 'patch')
              {
                  if($package->status == 'installed')   echo $deactivateCode . $uninstallCode;
                  if($package->status == 'deactivated') echo $activateCode   . $uninstallCode;
                  if($package->status == 'available')   echo $installCode    . $eraseCode;
              }
              echo html::a($package->site, $lang->package->site, 'class=btn');
              ?>          
            </div>
          </div>
          <?php
          echo "{$lang->package->version}: <i>{$package->version}</i> ";
          echo "{$lang->package->author}:  <i>{$package->author}</i> ";
          ?>
        </div>
      </div></div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
