<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The settheme view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php $currentTheme    = $this->config->template->{$this->device}->theme; ?>
<?php $currentTemplate = $this->config->template->{$this->device}->name; ?>
<div class='panel' id='mainPanel'>
  <div class='panel-heading'>
    <ul class='nav nav-tabs' id='typeNav'>
      <li data-type='internal' class='active'><?php echo html::a('#internalSection', $lang->ui->internalTheme, "data-toggle='tab'");?></li>
      <li data-type='store'><?php echo html::a('#storeSection', $lang->ui->themeStore, "data-toggle='tab'");?></li>
    </ul>
  </div>
  <div class='panel-body tab-content'>
    <section class='cards cards-borderless themes tab-pane active' id='internalSection'>
      <?php foreach($template['themes'] as $code => $theme):?>
      <?php $url = $this->createLink('ui', 'setTemplate', "template={$template['code']}&theme={$code}&custom=1");?>
      <?php $templateRoot = $webRoot . 'template/' . $template['code'] . '/';?>
      <?php $isCurrent =  $currentTheme === $code; ?>
      <div class='col-theme'>
        <div class='card theme <?php if($isCurrent) echo 'current';?>' data-url='<?php echo $url?>'>
          <i class='icon-ok icon'></i>
          <?php echo html::a($url, html::image($themeRoot . $code . '/preview.png'), "class='media-wrapper theme-img'");?>
          <div class='text-center theme-name text-ellipsis'>
            <?php echo $theme;?>
          </div>
          <div class='actions'>
            <?php if(!in_array("$currentTemplate.$code", $this->config->ui->systemThemes)) commonModel::printLink('ui', 'deleteTheme', "template={$currentTemplate}&theme={$code}", "<span class='icon-trash'></span>", "title='{$lang->delete}' class='deleter btn btn-link btn-mini' data-type='ajax' data-backdrop='true'") ?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </section>
    <section class='tab-pane' id='storeSection'>
      <div class='text-center text-muted load-icon' style='padding: 50px'><i class='icon icon-2x icon-spinner icon-spin'></i></div>
    </section>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
