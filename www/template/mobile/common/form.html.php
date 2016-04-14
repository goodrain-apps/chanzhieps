<?php if(!defined("RUN_MODE")) die();?>
<style>
.captcha {width: 100%; background-color: #fafafa; padding: 8px 10px; border: 1px solid #CCC; border-radius: 2px;}
.captcha label {padding-top: 8px; margin-top: 0; margin-bottom: 0; line-height: 20px;}
.captcha input[name='captcha'] {margin-left: -2px; display: inline-block; max-width: 80px;}
.captcha .label {font-size: 20px; background-color: #D9534F; color: #fff; display: block; padding: 6px 12px; text-align: center; border-radius: 2px;}
table.captcha {margin-bottom: 15px;}
table.captcha td {padding: 5px;}
table.captcha td label {padding: 0;}
.captcha-box > th {display: none}
</style>
<?php 
if(!isset($templateCommonRoot))
{
    $thisModuleName     = $this->app->getModuleName();
    $thisMethodName     = $this->app->getMethodName();
    $templateCommonRoot = $config->webRoot . "theme/" . $this->config->template->{$this->device}->name . "/common/";
}
if($thisModuleName === 'user' and $thisMethodName === 'login')
{
    js::import($jsRoot . 'md5.js');
    js::import($jsRoot . 'fingerprint/fingerprint.js');
    js::set('random', $this->session->random);
}
js::import($templateCommonRoot . 'js/mzui.form.min.js');
?>
