<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-envelope'></i> <?php echo $lang->mail->common;?> <i class='icon-arrow-right'></i> <?php echo $lang->mail->edit; ?></strong></div>
  <div class='panel-body'>
    <form method='post' action='<?php echo inlink('save');?>' id='dataform'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-4 col-sm-3 col-md-2'><?php echo $lang->mail->turnon; ?></th>
          <td colspan='2'><?php echo html::radio('turnon', $lang->mail->turnonList, 1);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->fromAddress; ?></th>
          <td class='col-xs-9 col-sm-8 col-md-5'><?php echo html::input('fromAddress', $mailConfig->fromAddress, 'class=form-control');?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->fromName; ?></th>
          <td><?php echo html::input('fromName', $mailConfig->fromName, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->host; ?></th>
          <td><?php echo html::input('host', $mailConfig->host, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->port; ?></th>
          <td><?php echo html::input('port', $mailConfig->port, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->auth; ?></th>
          <td colspan='2'><?php echo html::radio('auth', $lang->mail->authList, $mailConfig->auth, 'onchange=setAuth(this.value)'); ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->username; ?></th>
          <td><?php echo html::input('username', $mailConfig->username, "class='form-control'") ?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->password; ?></th>
          <td><?php echo html::password('password', $mailConfig->password, 'class="form-control" autocomplete="off"') ?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->secure; ?></th>
          <td colspan='2'><?php echo html::radio('secure', $lang->mail->secureList, $mailConfig->secure); ?></td>
        </tr>
        <tr>
          <th><?php echo $lang->mail->debug; ?></th>
          <td colspan='2'><?php echo html::radio('debug', $lang->mail->debugList, $mailConfig->debug);?></td>
        </tr>
        <tr>
          <td></td>
          <td>
           <?php 
           echo html::submitButton();
           if($this->config->mail->turnon) echo html::linkButton($lang->mail->test, inlink('test'));
           echo html::linkButton($lang->mail->reset, inlink('reset'));
           ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
