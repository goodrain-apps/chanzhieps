<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<?php js::import($jsRoot . 'less/min.js'); ?>
<div class='col-xs-12'>
<?php if(!$hasPriv):?>
<div class='alert alert-danger'>
  <div>
    <?php echo $errors;?>
    <span class='pull-right'><?php commonModel::printLink('ui', 'customtheme', "theme={$theme}&template={$template}", $lang->ui->template->reload, "class='btn btn-primary'");?></span>
  </div>
</div>
<?php else:?>
<form method='post' action='<?php echo inlink('customtheme', "theme={$theme}&template={$template}");?>' id='customThemeForm' class='form ve-form' data-theme='<?php echo $theme?>' data-template='<?php echo $template?>'>
  <div class='panel' id='mainPanel'>
    <div class='panel-heading'>
      <ul class='nav nav-tabs'>
        <?php if(isset($this->config->ui->themes[$template][$theme])):?>
        <?php foreach($lang->ui->groups as $group => $name):?>
        <li><?php echo html::a('#' . $group . 'Tab', $name, "data-toggle='tab' class='theme-control-tab'");?></li>
        <?php endforeach;?>
        <?php endif;?>
      </ul>
    </div>
    <div class='panel-body'>
      <div class='tab-content'>
        <?php if(isset($this->config->ui->themes[$template][$theme])):?>
        <?php foreach($lang->ui->groups as $group => $name):?>
        <div class='tab-pane theme-control-tab-pane' id='<?php echo $group?>Tab'>
          <table class='table table-form borderless'>
            <?php
            $options = isset($config->ui->themes[$template][$theme][$group]) ? $config->ui->themes[$template][$theme][$group] : '';
            if($options) foreach($options as $selector => $attributes):
            ?>
            <tr class='theme-control-group'>
              <th><?php echo $lang->ui->{$selector};?></th>
              <td>
                <div class='row'>
                  <?php foreach($attributes as $label => $params):?>
                  <?php $value = isset($setting[$params['name']]) ? $setting[$params['name']] : '';?>
                  <div class='col-sm-3' title='@<?php echo $params['name']?>'><?php $this->ui->printFormControl($label, $params, $value);?></div>
                  <?php endforeach;?>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
          </table>
        </div>
        <?php endforeach;?>
        <?php endif;?>
      </div>
      <div class="form-footer">
        <?php echo html::hidden('theme', $theme) . html::hidden('template', $template) . html::submitButton();?> <button type='button' id='resetTheme' class='btn btn-link btn-sm text-danger' data-success-tip='<?php echo $lang->ui->theme->resetTip?>'><?php echo $lang->ui->theme->reset?></button>
      </div>
    </div>
  </div>
</form>
<?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
