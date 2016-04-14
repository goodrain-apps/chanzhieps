<?php if(!defined("RUN_MODE")) die();?>
<?php $templates       = $this->loadModel('ui')->getTemplates(); ?>
<?php $currentTemplate = $this->config->template->{$this->device}->name; ?>
<?php $currentTheme    = $this->config->template->{$this->device}->theme; ?>
<?php $currentDevice   = $this->session->device ? $this->session->device : 'desktop';?>
<nav id='menu' style='padding-left:15px;'>
  <?php 
    $lang->ui->menu = $lang->theme->menu;
    if(!isset($this->config->ui->themes[$currentTemplate][$currentTheme])) unset($lang->ui->menu->custom);
    $moduleMenu = commonModel::createModuleMenu($moduleName, '', false);
  ?>
  <?php if($moduleMenu) echo $moduleMenu;?>
  <div class="pull-right">
    <ul class="nav">
      <li><?php echo html::a(helper::createLink('visual', 'index'), '<i class="icon-magic"></i> ' . $lang->visualEdit, "target='_blank' class='navbar-link'");?></li>
      <li><?php commonModel::printLink('ui', 'uploadTheme', '', '<i class="icon-download-alt"></i> ' . $lang->ui->uploadTheme, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'exportTheme', '', '<i class="icon-upload-alt"></i> ' . $lang->ui->exportTheme, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'themestore',  '', '<i class="icon-th-large"></i> ' . $lang->ui->themeStore, "data-width='600'")?></li>
    </ul>
  </div>
</nav>
<style> #menu > .nav > li{padding:4px;} </style>
