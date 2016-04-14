<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The comment module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     comment
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->guarder = new stdclass();

$lang->guarder->common       = 'Security setting';
$lang->guarder->action       = 'Action';
$lang->guarder->then         = 'Then';
$lang->guarder->setBlacklist = 'Blacklist';
$lang->guarder->setWhitelist = 'Whitelist';
$lang->guarder->setCaptcha   = 'Captcha';
$lang->guarder->addBlacklist = 'Add blacklist';
$lang->guarder->addCaptcha   = 'Add captcha';
$lang->guarder->getEmailCode = 'Get email code';

$lang->guarder->captcha        = 'Captcha';
$lang->guarder->question       = 'Question';
$lang->guarder->answer         = 'Answer';
$lang->guarder->numbers        = array('Zero', 'I', 'II', 'III', 'Four', 'Five', '6', '7', '8', '9', '10');
$lang->guarder->operators      = array('*' => 'x', '-' => '-', '+' => '+');
$lang->guarder->equal          = '=';
$lang->guarder->placeholder    = 'Nubmer 、words';
$lang->guarder->password       = 'Admin Password';
$lang->guarder->passwordHolder = 'Please enter password of current account';
$lang->guarder->identityTip    = 'Please input IP, Email, Account or Sensitive words';
$lang->guarder->captchaTip     = 'The front desk will call this group captchas randomly after setting them.';

$lang->guarder->verify        = 'For security reason do the following';
$lang->guarder->okFile        = 'File';
$lang->guarder->created       = 'Created';
$lang->guarder->email         = 'Email';
$lang->guarder->setSecurity   = 'Set security question';
$lang->guarder->captcha       = 'Email captcha';
$lang->guarder->needVerify    = 'Need to verify your identity of Administrator';
$lang->guarder->emailFail     = 'Wrong captcha';
$lang->guarder->questionFail  = 'Wrong answer';
$lang->guarder->verifySuccess = 'Right captcha';
$lang->guarder->noConfigure   = "Can't find the configuration";
$lang->guarder->noEmail       = "Can't find your email address";
$lang->guarder->noQuestion    = "Can't find your security question";
$lang->guarder->noCaptcha     = "can't send email captcha.";
$lang->guarder->okFileVerify  = "Create <span class='red'>%s</span> file, write content: <span class='red'>%s</span> .";
$lang->guarder->sendSuccess   = 'Captcha has been sent to %s.';
$lang->guarder->options       = 'Options';

$lang->guarder->blacklistModes['all']      = 'all';
$lang->guarder->blacklistModes['ip']       = 'ip';
$lang->guarder->blacklistModes['account']  = 'Account';
$lang->guarder->blacklistModes['keywords'] = 'Keywords';
$lang->guarder->blacklistModes['guard']    = 'Site';
$lang->guarder->blacklistModes['email']    = 'Email';

$lang->guarder->whitelist = new stdclass();
$lang->guarder->whitelist->ip            = 'IP Whitelist';
$lang->guarder->whitelist->account       = 'Account Whitelist';
$lang->guarder->whitelist->accountHolder = 'Multiple users separated by commas, like zhangsan,lisi';
$lang->guarder->whitelist->ipHolder      = 'Multiple IP separated by commas , like 202.194.133.1,202.194.132.0/28';
$lang->guarder->whitelist->wrongIP       = 'IP Malformed';

$lang->guarder->permanent = 'Permanent';
$lang->guarder->interval  = 'Minutes';
$lang->guarder->perDay    = 'A Day More Than';
$lang->guarder->exceed    = 'Exceed';
$lang->guarder->times     = 'Times';
$lang->guarder->disable   = 'Disabled';

$lang->guarder->operationList = new stdclass;

$lang->guarder->operationList->ip = new stdclass;
$lang->guarder->operationList->ip->logonFailure    = 'Login Failed';
$lang->guarder->operationList->ip->register        = 'Registration Number';
$lang->guarder->operationList->ip->resetPassword   = 'Reset Password';
$lang->guarder->operationList->ip->resetPWDFailure = 'Reset Password Failure';
$lang->guarder->operationList->ip->postThread      = 'Post Topic';
$lang->guarder->operationList->ip->postComment     = 'Post Comment';
$lang->guarder->operationList->ip->postReply       = 'Reply To Post';
$lang->guarder->operationList->ip->post            = 'Post Requests';
$lang->guarder->operationList->ip->search          = 'Searches';
$lang->guarder->operationList->ip->error404        = '404 Times';
$lang->guarder->operationList->ip->captchaFail     = 'Validation Error';

$lang->guarder->operationList->account = new stdclass;
$lang->guarder->operationList->account->logonFailure    = 'Login Failed';
$lang->guarder->operationList->account->resetPassword   = 'Reset Password';
$lang->guarder->operationList->account->resetPWDFailure = 'Reset Password Failure';
$lang->guarder->operationList->account->postThread      = 'Post Topic';
$lang->guarder->operationList->account->postComment     = 'Post Comment';
$lang->guarder->operationList->account->postReply       = 'Reply To Post';
$lang->guarder->operationList->account->post            = 'Post Requests';
$lang->guarder->operationList->account->search          = 'Searches';
$lang->guarder->operationList->account->error404        = '404 Times';
$lang->guarder->operationList->account->captchaFail     = 'Validation Error';

$lang->guarder->punishOptions = array();
$lang->guarder->punishOptions[5]     = '5min'; 
$lang->guarder->punishOptions[10]    = '10min'; 
$lang->guarder->punishOptions[30]    = '30min'; 
$lang->guarder->punishOptions[60]    = '1h'; 
$lang->guarder->punishOptions[720]   = '12h'; 
$lang->guarder->punishOptions[1440]  = '24h'; 
$lang->guarder->punishOptions[10080] = 'one week'; 
$lang->guarder->punishOptions[43200] = 'one month'; 
$lang->guarder->punishOptions[0]     = 'Permanently'; 

$lang->blacklist = new stdclass();
$lang->blacklist->type        = 'Type';
$lang->blacklist->title       = 'Title';
$lang->blacklist->identity    = 'Value';
$lang->blacklist->reason      = 'Reason';
$lang->blacklist->expiredDate = 'Expiration';
$lang->blacklist->ip          = 'IP';
$lang->blacklist->keywords    = 'keywords';
$lang->blacklist->account     = 'Account';
$lang->blacklist->email       = 'Email';
$lang->blacklist->other       = 'Other';
