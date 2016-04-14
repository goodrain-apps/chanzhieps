<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<?php js::set('page', $page);?>
<div class='col-xs-2'>
  <div class="leftmenu hiddden-xs hidden-sm">
    <ul class="nav nav-left nav-primary nav-stacked">
      <?php foreach($pageList as $pageCode => $name):?>
      <li>
        <?php echo html::a(inlink('setcode', "page={$pageCode}"), $name . "<i class='icon-chevron-right'></i>");?>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
</div>
<div class='col-xs-10'>
<form method='post' id='ajaxForm'>
  <div class='panel' id='mainPanel'>
    <div class='panel-heading'>
      <ul class='nav nav-tabs'>
        <li class='active'><a href='#cssTab' data-toggle='tab'><?php echo $lang->ui->theme->extraStyle; ?></a></li>
        <li><a href='#jsTab' data-toggle='tab'><?php echo $lang->ui->theme->extraScript; ?></a></li>
      </ul>
    </div>
    <div class='tab-content'>
      <div class='tab-pane theme-control-tab-pane active' id='cssTab'>
        <?php echo html::textarea('css', zget($this->config->css, "{$template}_{$theme}_{$page}", ''), "rows=20 class='form-control codeeditor' data-mode='css' data-height='350'");?>
      </div>
      <div class='tab-pane theme-control-tab-pane' id='jsTab'>
        <?php echo html::textarea('js', zget($this->config->js, "{$template}_{$theme}_{$page}", ''), "rows=20 class='form-control codeeditor' data-mode='javascript' data-height='350'");?>
      </div>
    </div>
    <div class="panel-footer">
      <?php echo html::submitButton();?>
      <span id='cssTab' class='text-info text-tip'><?php echo $lang->ui->theme->customStyleTip; ?></span>
      <span id='jsTab'  class='text-info text-tip'><?php echo $lang->ui->theme->customScriptTip; ?></span>
    </div>
  </div>
</form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
