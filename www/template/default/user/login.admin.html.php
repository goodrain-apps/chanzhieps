<?php if(!defined("RUN_MODE")) die();?>
<?php
include TPL_ROOT . 'common/header.lite.html.php';
js::import($jsRoot . 'md5.js');
js::import($jsRoot . 'fingerprint/fingerprint.js');
js::set('random', $this->session->random);
?>
<div class='container'>
  <div id='adminLogin'>
    <div id='siteName'>
      <?php echo $this->config->site->name;?>
    </div>
    <form method='post' id='ajaxForm' data-checkfingerprint='1'>
      <div id='formError' class='alert alert-danger hiding'></div>
      <div class='row'>
        <div class='col-xs-4 text-center'>
        <?php echo html::image($this->config->webRoot . 'theme/default/default/images/main/logo.login.admin.png'); ?>
        </div>
        <div class='col-xs-8'>
          <table class="table table-form">
            <tr>
              <th class='w-60px'><?php echo $lang->user->account?></th>
              <td><?php echo html::input('account','',"class='form-control' placeholder='{$lang->user->inputAccountOrEmail}'");?></td>
            </tr>
            <tr>
              <th><?php echo $lang->user->password?></th>
              <td><?php echo html::password('password','',"class='form-control' placeholder='{$lang->user->inputPassword}'");?></td>
            </tr>
            <tr>
              <th><?php echo html::a('', $lang->save, "data-toggle='modal' class='hidden captchaModal'")?></th>
              <td><?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn');?></td>
            </tr>
          </table>
          <?php echo html::hidden('referer', $referer);?>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);
?>
</body>
</html>
