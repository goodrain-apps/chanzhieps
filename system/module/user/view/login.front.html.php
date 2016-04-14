<?php if(!defined("RUN_MODE")) die();?>
<?php
include '../../common/view/header.html.php';
js::import($jsRoot . 'md5.js');
js::set('random', $this->session->random);
?>
<div class='panel panel-body' id='login'>
  <div class='row'>
    <?php 
    foreach($lang->user->oauth->providers as $providerCode => $providerName) $providerConfig[$providerCode] = isset($config->oauth->$providerCode) ? json_decode($config->oauth->$providerCode) : '';
    if(!empty($providerConfig['sina']->clientID) or !empty($providerConfig['qq']->clientID)):
    ?>
    <div class='col-md-6'>
      <div class='panel panel-pure'>
        <div class='panel-heading'><strong><?php echo $lang->user->oauth->lblWelcome;?></strong></div>
        <div class='panel-body'>
        <?php 
        foreach($lang->user->oauth->providers as $providerCode => $providerName) 
        {
            $providerConfig = isset($config->oauth->$providerCode) ? json_decode($config->oauth->$providerCode) : '';
            if(empty($providerConfig->clientID)) continue;
            $params = "provider=$providerCode";
            if($referer and !strpos($referer, 'login') and !strpos($referer, 'oauth')) $params .= "&referer=" . helper::safe64Encode($referer);
            echo html::a(inlink('oauthLogin', $params), "<i class='icon-{$providerCode} icon'></i> " . $providerName, "class='btn btn-default btn-oauth btn-lg btn-block btn-{$providerCode}'");
        }
        ?>
        </div>
      </div>
    </div>
    <div class='col-md-6'>
    <?php else:?>
    <div class='col-md-12'>
    <?php endif;?>
      <div class='panel panel-pure'>
        <div class='panel-heading'><strong><?php echo $lang->user->login->welcome;?></strong></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' role='form'>
            <div class='form-group hiding'><div id='formError' class='alert alert-danger'></div></div>
            <div class='form-group'><?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='form-control input-lg'");?></div>
            <div class='form-group'><?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='form-control input-lg'");?></div>
            <?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn-wider btn-lg');?> &nbsp; &nbsp; 
            <?php echo html::a(inlink('register'), $lang->user->register->common);?> &nbsp; &nbsp; 
            <?php if($config->mail->turnon) echo html::a(inlink('resetpassword'), $lang->user->recoverPassword);?>
            <?php echo html::hidden('referer', $referer);?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
