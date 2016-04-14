<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->mail->common = 'Mail';
$lang->mail->index  = 'Index';
$lang->mail->detect = 'Detect';
$lang->mail->edit   = 'Configure';
$lang->mail->save   = 'Successfully saved';
$lang->mail->test   = 'Testing';
$lang->mail->reset  = 'Reset';

$lang->mail->turnon       = 'Turnon';
$lang->mail->fromAddress  = 'From email';
$lang->mail->fromName     = 'From title';
$lang->mail->mta          = 'MTA';
$lang->mail->host         = 'SMTP host';
$lang->mail->port         = 'SMTP port';
$lang->mail->auth         = 'Authentication';
$lang->mail->username     = 'SMTP account';
$lang->mail->password     = 'SMTP password';
$lang->mail->secure       = 'Secure';
$lang->mail->debug        = 'Debug';
$lang->mail->getEmailCode = 'Get email code';

$lang->mail->turnonList[1] = 'on';
$lang->mail->turnonList[0] = 'off';

$lang->mail->debugList[0] = 'off';
$lang->mail->debugList[1] = 'normal';
$lang->mail->debugList[2] = 'high';

$lang->mail->authList[1]  = 'necessary';
$lang->mail->authList[0]  = 'unnecessary';

$lang->mail->secureList['']    = 'plain';
$lang->mail->secureList['ssl'] = 'ssl';
$lang->mail->secureList['tls'] = 'tls';

$lang->mail->inputFromEmail = 'Please enter email:';
$lang->mail->nextStep       = 'Next';
$lang->mail->successSaved   = 'The configuration has been successfully saved.';
$lang->mail->subject        = "It's a testing email from zentao.";
$lang->mail->content        = 'Well done, the email notification feature works now!';
$lang->mail->sending        = 'Mail is sent to %s, please wait ...';
$lang->mail->successSended  = 'Successfully sended!';
$lang->mail->needConfigure  = "I can not find the configuration, please configure it first.";
$lang->mail->error          = 'Please input correct email.'; 
$lang->mail->trySendlater   = 'Can not send email in three minutes.'; 

$lang->mail->captcha     = 'Email captcha';
$lang->mail->sendContent = <<<EOT
%s：
<br />You are requesting the verification code:%s from <strong>%s</strong>(%s).
<br />If not your request, please ignore it.
<br />
<br /><strong>%s</strong> build by <a href='http://www.chanzhi.org' target='_blank'>ChanZhiEPS</a>.
<br /><a href='http://www.cnezsoft.com' target='_blank'>Nature Easy Soft</a>
EOT;
