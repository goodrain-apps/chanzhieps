<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The obtain view file of package module of ChanZhiEPS.
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
<?php include '../../common/view/treeview.html.php';?>
<div class='row'>
  <div class='col-md-2'>
    <form id='searchForm' class='side-search mgb-20' method='post' action='<?php echo inlink('obtain', 'type=bySearch');?>'>
      <div class='input-group'>
        <?php echo html::input('key', $this->post->key, "class='form-control' placeholder='{$lang->package->bySearch}'");?>
        <span class='input-group-btn'>
          <button class='btn btn-submit' id='submit' type='submit'><i class='icon-search'></i></button>
        </span>
      </div>
    </form>
    <div class='list-group'>
      <?php echo html::a(inlink('obtain', 'type=byUpdatedTime'), $lang->package->byUpdatedTime, "id='byupdatedtime' class='list-group-item'");?>
      <?php echo html::a(inlink('obtain', 'type=byAddedTime'),   $lang->package->byAddedTime,   "id='byaddedtime' class='list-group-item'");?>
      <?php echo html::a(inlink('obtain', 'type=byDownloads'),   $lang->package->byDownloads,   "id='bydownloads' class='list-group-item'");?>
    </div>
    <div class='panel panel-sm'>
      <div class='panel-heading'><?php echo $lang->package->byCategory;?></div>
      <div class='panel-body'>
        <?php $moduleTree ? print($moduleTree) : print($lang->package->errorGetModules);?>
      </div>
    </div>
  </div>
  <div class='col-md-10'>
    <?php if($packages):?>
    <div class='cards pd-0 mg-0'>
    <?php foreach($packages as $package):?>
      <?php 
      $currentRelease = $package->currentRelease;
      $latestRelease  = isset($package->latestRelease) ? $package->latestRelease : '';
      ?>
      <div class='card'>
        <div class='card-heading'>
          <small class='pull-right text-important'>
            <?php 
            if($latestRelease and $latestRelease->releaseVersion != $currentRelease->releaseVersion) 
            {
                printf($lang->package->latest, $latestRelease->viewLink, $latestRelease->releaseVersion, $latestRelease->zentaoCompatible);
            }?>
          </small>
          <h5 class='mg-0'><?php echo $package->name . "($currentRelease->releaseVersion)";?></h5>
        </div>
        <div class='card-content text-muted'>
          <?php echo $package->abstract;?>
        </div>
        <div class='card-actions'>
          <div style='margin-bottom: 10px'>
            <?php
            echo "{$lang->package->author}:     {$package->author} ";
            echo "{$lang->package->downloads}:  {$package->downloads} ";
            echo "{$lang->package->compatible}: {$lang->package->compatibleList[$currentRelease->compatible]} ";
            
            echo " {$lang->package->depends}: ";
            if(!empty($currentRelease->depends))
            {
                foreach(json_decode($currentRelease->depends) as $code => $limit)
                {
                    echo $code;
                    if($limit != 'all')
                    {
                        echo '(';
                        if(!empty($limit['min'])) echo '>= v' . $limit['min'];
                        if(!empty($limit['max'])) echo '<= v' . $limit['min'];
                        echo ')';
                    }
                    echo ' ';
                }
            }
            ?>
          </div>
          <?php echo "{$lang->package->grade}: ",   html::printStars($package->stars); ?>
          <div class='pull-right' style='margin-top: -15px'>
            <div class='btn-group'>
            <?php
            echo html::a($package->viewLink, $lang->package->view, 'class="btn package" target="_blank"');
            if($currentRelease->public)
            {
                if($package->type != 'computer' and $package->type != 'mobile')
                {
                    if(isset($installeds[$package->code]))
                    {
                        if($installeds[$package->code]->version != $package->latestRelease->releaseVersion and $this->package->checkVersion($package->latestRelease->chanzhiCompatible))
                        {
                            commonModel::printLink('package', 'upgrade', "package=$package->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5=$currentRelease->md5&type=$package->type", $lang->package->upgrade, "class='btn' data-toggle='modal'");
                        }
                        else
                        {
                            echo html::a('javascript:;', $lang->package->installed, "class='btn disabled'");
                        }
                    }
                    else
                    {
                        $label = $currentRelease->compatible ? $lang->package->installAuto : $lang->package->installForce;
                        commonModel::printLink('package', 'install',  "package=$package->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5={$currentRelease->md5}&type=$package->type&overridePackage=no&ignoreCompitable=yes", $label, "data-toggle='modal' class='btn'");
                    }
                }
            }
            echo html::a($currentRelease->downLink, $lang->package->downloadAB, 'class="manual btn"');
            echo html::a($package->site, $lang->package->site, "class='btn' target='_blank'");
            ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach;?>
    </div>
    <?php if($pager):?>
    <div class='clearfix'>
      <?php $pager->show()?>
    </div>
    <?php endif; ?>
    <?php else:?>
    <div class='alert alert-default'>
      <i class='icon icon-remove-sign'></i>
      <div class='content'>
        <h4><?php echo $lang->package->errorOccurs;?></h4>
        <div><?php echo $lang->package->errorGetPackages;?></div>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<script>
$('#<?php echo $type;?>').addClass('active')
$('#module<?php echo $moduleID;?>').addClass('active')
</script>
<?php include '../../common/view/footer.admin.html.php';?>
