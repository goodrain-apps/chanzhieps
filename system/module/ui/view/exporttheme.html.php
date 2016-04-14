<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('themes', $themes) ?>
<?php js::set('template', $this->config->template->{$this->device}->name);?>
<?php js::set('theme', $this->config->template->{$this->device}->theme);?>
<form id='ajaxForm' class='export-theme-form' method='post' action="<?php echo inlink('exportTheme');?>">
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->ui->templateName?></th>
      <td>
        <div class='required required-wrapper'></div>
        <div class='input-group'>
          <?php echo html::select('template', $templateOptions, $this->config->template->{$this->device}->name, "class='form-control'");?>
          <span class='input-group-addon'></span>
          <?php echo html::select('theme', array(''), '', "class='form-control'");?>
        </div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->name;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('name', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->code;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('code', '', "placeholder='{$lang->ui->codeHolder}' class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->preview;?></th>
      <td>
        <?php echo html::file('file', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->author;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('author', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->email;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('email', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->demo;?></th>
      <td>
        <?php echo html::input('demo', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->template->qq;?></th>
      <td>
        <?php echo html::input('qq', '', "class='form-control'");?>
      </td>
    </tr>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
