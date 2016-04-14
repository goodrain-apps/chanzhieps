<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The obtain view file of theme module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @theme     theme
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <ul id='typeNav' class='nav nav-tabs'>
      <li data-type='internal' <?php echo $type == 'installed' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('themestore', "type=installed"), $lang->package->installed);?>
      </li>
      <li data-type='internal' <?php echo $type != 'installed' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('themestore'), $lang->ui->theme->online);?>
      </li>
    </ul> 
  </div>
  <div id='mainArea'>
    <?php if($type != 'installed'):?>
    <div id='industryBox'>
      <?php if($type != 'installed') echo $industryTree;?>
      <?php foreach($lang->ui->theme->searchLabels as $code => $label):?>
      <?php echo html::a(inlink('themestore', "type={$code}"), $label);?>
      <?php endforeach;?>
    </div>
    <?php endif;?>
    <?php if($themes):?>
    <div id='storeThemes' class='cards cards-borderless themes row' data-param='<?php echo $param ?>'>
      <?php foreach($themes as $theme):?>
      <?php 
      $currentRelease = $theme->currentRelease;
      $latestRelease  = isset($theme->latestRelease) ? $theme->latestRelease : '';

      $themeImages = array();
      ?>
      <div class="col-theme col-md-2">
        <div class="card theme">
          <div class='media-wrapper theme-img'>
            <?php if(!empty($theme->images)):?>
            <?php echo html::a('javascript:;', html::image($theme->images[0]), "data-image='{$theme->images[0]}' title='{$theme->name}' data-group='{$theme->code}' data-toggle='lightbox' class='preview-theme'");?>
            <?php foreach($theme->images as $key => $image):?>
            <?php if($key > 0) echo html::a('javascript:;', html::image($image), "data-image='{$image}' title='{$theme->name}' data-group='{$theme->code}' data-toggle='lightbox' class='preview-theme hide'");?>
            <?php endforeach;?>
            <?php endif;?>
          </div>
          <div class='theme-info'>
            <div class='theme-price'>
              <?php echo "<strong class='text-danger price'>￥" . number_format($theme->latestRelease->lifePrice, 2) . '</strong>'; ?>
              <span class='pull-right'><i class='icon icon-thumbs-o-up'></i> <?php echo $theme->stars?></span> &nbsp; 
              <span class='pull-right'><i class='icon icon-download-alt'></i> <?php echo $theme->downloads?></span>
            </div>
            <div class='theme-desc'>
              <?php echo html::a($theme->viewLink, $theme->name, "target='_blank'");?>
              <div class="dropdown dropup pull-right">
                <button type="button" data-toggle="dropdown" class="btn btn-mini" role="button"><span class='icon icon-cog'></span></button>
                <ul class="dropdown-menu pull-right">
                  <li><?php echo html::a($theme->viewLink, $lang->package->view, 'target="_blank"');?></li>
                  <?php
                  if($theme->type != 'computer' and $theme->type != 'mobile')
                  {
                      if(isset($installeds[$theme->code]))
                      {
                          if($installeds[$theme->code]->version != $theme->latestRelease->releaseVersion and $this->theme->checkVersion($theme->latestRelease->chanzhiCompatible))
                          {
                              echo '<li>';
                              commonModel::printLink('theme', 'upgrade', "theme=$theme->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5=$currentRelease->md5&type=$theme->type", $lang->theme->upgrade, "data-toggle='modal'");
                              echo '</li>';
                          }
                          else
                          {
                              echo '<li>' . html::a('javascript:;', $lang->theme->installed, "class='disabled'") . '</li>';
                          }
                      }
                  }

                  if(!$currentRelease->charge)
                  {
                      $label = $currentRelease->compatible ? $lang->package->installAuto : $lang->package->installForce;
                      echo '<li>';
                      commonModel::printLink('package', 'install',  "theme=$theme->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5={$currentRelease->md5}&type=$theme->type&overridePackage=no&ignoreCompitable=yes", $label, "data-toggle='modal'");
                      echo '</li>';
                  }
                  echo '<li>' . html::a($currentRelease->downLink, $currentRelease->charge ? $lang->package->buy : $lang->package->downloadAB, 'class="manual" target="_blank"') . '</li>';
                  echo '<li>' . html::a($theme->site, $lang->package->site, "target='_blank'") . '</li>';
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div  class='modal fade'  id="<?php echo $theme->code . 'Modal'?>">
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <strong><?php echo $theme->name . "($currentRelease->releaseVersion)";?></strong>
                <div class='pull-right'>
                  <span class='text-muted'><i class='icon icon-thumbs-o-up'></i> <?php echo $theme->stars?></span> &nbsp; 
                  <span class='text-muted'><i class='icon icon-download-alt'></i> <?php echo $theme->stars?></span>
                </div>
              </div>
              <div class='modal-body'>
                <p class=''><?php echo $theme->abstract;?></p>
                <p>
                <?php
                echo "{$lang->package->author}:     {$theme->author} ";
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
                </p>
                <div class='text-center'>
                  <div class='btn-group text-center'>
                  <?php
                  echo html::a($theme->viewLink, $lang->package->view, 'class="btn" target="_blank"');
                  if($theme->type != 'computer' and $theme->type != 'mobile')
                  {
                      if(isset($installeds[$theme->code]))
                      {
                          if($installeds[$theme->code]->version != $theme->latestRelease->releaseVersion and $this->theme->checkVersion($theme->latestRelease->chanzhiCompatible))
                          {
                              commonModel::printLink('theme', 'upgrade', "theme=$theme->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5=$currentRelease->md5&type=$theme->type", $lang->theme->upgrade, "class='btn' data-toggle='modal'");
                          }
                          else
                          {
                              echo html::a('javascript:;', $lang->theme->installed, "class='btn disabled'");
                          }
                      }
                  }

                  if(!$currentRelease->charge)
                  {
                      $label = $currentRelease->compatible ? $lang->package->installAuto : $lang->package->installForce;
                      commonModel::printLink('package', 'install',  "theme=$theme->code&downLink=" . helper::safe64Encode($currentRelease->downLink) . "&md5={$currentRelease->md5}&type=$theme->type&overridePackage=no&ignoreCompitable=yes", $label, "data-toggle='modal' class='btn'");
                  }
                  echo html::a($currentRelease->downLink, $currentRelease->charge ? $lang->package->buy : $lang->package->downloadAB, 'class="manual btn" target="_blank"');
                  echo html::a($theme->site, $lang->package->site, "class='btn' target='_blank'");
                  ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <?php if($pager):?>
    <div class='clearfix'>
      <?php $pager->show('right', 'lite')?>
    </div>
  </div>
  <?php endif; ?>
  <?php elseif($type != 'installed'):?>
  <div class='panel-body'>
  </div>
  <?php elseif($type == 'installed'):?>
  <div class='panel-body'>
  </div>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
