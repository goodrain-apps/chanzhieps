<?php if(!defined("RUN_MODE")) die();?>
<?php 
foreach($lang->user->oauth->providers as $providerCode => $providerName) $providerConfig[$providerCode] = isset($config->oauth->$providerCode) ? json_decode($config->oauth->$providerCode) : '';
if(!empty($providerConfig['sina']->clientID) or !empty($providerConfig['qq']->clientID) or !empty($this->config->site->yangcong)):
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
            $params = "provider=$providerCode&fingerprint=fingerprintval";
            if($referer and !strpos($referer, 'login') and !strpos($referer, 'oauth')) $params .= "&referer=" . helper::safe64Encode($referer);
            echo html::a(inlink('oauthLogin', $params), "<i class='icon-{$providerCode} icon'></i> " . $providerName, "class='btn btn-default btn-oauth btn-lg btn-block btn-{$providerCode}'");
        }
        ?>
        <?php if(!empty($this->config->site->yangcong)) echo html::a(helper::createLink('yangcong', 'qrcode', "referer=" . helper::safe64Encode($referer)), "<i class='icon icon-yangcong icon-lg'></i>{$lang->user->yangcongLogin}", "class='btn btn-lg btn-block btn-default btn-yangcong btn-oauth' data-toggle='modal'");?>
      </div>
    </div>
  </div>
  <div class='col-md-6'>
<?php else:?>
  <div class='col-md-12'>
<?php endif;?>
<script>
$().ready(function()
{
    $('a.btn-oauth').each(function()
    {
        fingerprint = getFingerprint();
        $(this).attr('href', $(this).attr('href').replace('fingerprintval', fingerprint) )
    })
})
</script>
