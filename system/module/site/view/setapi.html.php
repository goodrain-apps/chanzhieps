<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-link'></i> <?php echo $lang->site->api->common;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' class='form-inline' id='ajaxForm'>
      <table class='table table-form'>
        <tr>
          <th class='w-60px'><?php echo $lang->site->api->key;?></th>
          <td class='w-p60'><?php echo html::input('key', isset($this->config->site->api->key) ? $this->config->site->api->key : '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->api->ip;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input('ip', isset($this->config->site->api->ip) ? $this->config->site->api->ip: '', "class='form-control' placeholder='{$lang->site->api->ipTip}'");?>
              <div class='input-group-addon'>
                <label class='checkbox'><input type='checkbox' id='allip' name='allip' value='1'> <?php echo $lang->site->api->allip;?></label>
              </div>
            </div>
          </td>
          <td></td>
        </tr>
        <tr><th></th><td><?php echo html::submitButton();?></td><td></td></tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
