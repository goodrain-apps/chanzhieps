<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The user module english file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->user->common    = 'User';

$lang->user->id        = 'ID';
$lang->user->account   = 'Account';
$lang->user->admin     = 'Admin';
$lang->user->oldPwd    = 'Old password';
$lang->user->password  = 'Password';
$lang->user->password2 = 'Repeat it';
$lang->user->realname  = 'Name';
$lang->user->nickname  = 'Nick';
$lang->user->avatar    = 'Avatar';
$lang->user->birthyear = 'Birthyear';
$lang->user->birthday  = 'Birthday';
$lang->user->gender    = 'Gendar';
$lang->user->email     = 'Email';
$lang->user->msn       = 'MSN';
$lang->user->qq        = 'QQ';
$lang->user->yahoo     = 'Y!';
$lang->user->gtalk     = 'GTalk';
$lang->user->wangwang  = 'Wangwang';
$lang->user->mobile    = 'Mobile';
$lang->user->phone     = 'Phone';
$lang->user->company   = 'Company';
$lang->user->address   = 'Address';
$lang->user->zipcode   = 'Zipcode';
$lang->user->join      = 'Join Date';
$lang->user->visits    = 'Visits';
$lang->user->ip        = 'Last ip address';
$lang->user->last      = 'Last login time';
$lang->user->allowTime = 'Allow time';
$lang->user->status    = 'Status';
$lang->user->captcha   = 'Captcha';
$lang->user->alert     = 'Your account has been forbidden';
$lang->user->privilege = 'Privilege';

$lang->user->all             = 'All users';
$lang->user->list            = 'User list';
$lang->user->view            = "User info";
$lang->user->create          = "Add a user";
$lang->user->edit            = "Edit user";
$lang->user->changePassword  = "Change password";
$lang->user->changeEmail     = "Email setting";
$lang->user->recoverPassword = "recover password";
$lang->user->newPassword     = "New password";
$lang->user->update          = "Edit user";
$lang->user->browse          = "Borwse";
$lang->user->deny            = "Access denied";
$lang->user->confirmDelete   = "Are you sure to delete this user?";
$lang->user->confirmActivate = "Are you sure to activate this user?";
$lang->user->relogin         = "Relogin";
$lang->user->asGuest         = "Visits as guest";
$lang->user->goback          = "Go back";
$lang->user->allUsers        = 'All users';
$lang->user->submit          = "Submit";
$lang->user->forbid          = 'Forbid';
$lang->user->activate        = 'Activate';
$lang->user->pullWechatFans  = 'Pull wechat uses';
$lang->user->adminlog        = 'Admin login';
$lang->user->checkEmail      = 'Check Email';
$lang->user->getEmailCode    = 'Get email code';
$lang->user->setEmail        = 'Set Email';
$lang->user->newEmail        = 'New Email';
$lang->user->rank            = 'Level Scores';
$lang->user->score           = 'Integral Details';
$lang->user->myScore         = 'My Score';
$lang->user->buyScore        = 'Score Recharge';
$lang->user->addScore        = 'Reward Score';
$lang->user->reduceScore     = 'Deduct Score';
$lang->user->yangcongLogin   = 'Yangcong Login';
$lang->user->bindAccount     = 'Bind Account';
$lang->user->batchDelete     = 'Batch delete users';
$lang->user->deleteHistory   = 'Delete user and history data';
$lang->user->question        = 'Security question';
$lang->user->answer          = 'Answer';

$lang->user->type        = 'Account Type';
$lang->user->profile     = 'Profile';
$lang->user->editProfile = 'Edit profile';
$lang->user->thread      = 'My threads';
$lang->user->messages    = 'My Messages';
$lang->user->reply       = 'My replies';
$lang->user->submittion  = 'My Submittion';

$lang->user->userHistory       = "User History Data";
$lang->user->threadHistory     = "Post";
$lang->user->replyHistory      = "Reply";
$lang->user->commentHistory    = "Comment";
$lang->user->messageHistory    = "Message";
$lang->user->orderHistory      = "Order";
$lang->user->addressHistory    = "Address";
$lang->user->submittionHistory = "Submittion";

$lang->user->message = new stdclass();
$lang->user->message->mine = "My message <span class='label label-badge text-latin'>%s</span>";
$lang->user->message->from = 'From';

$lang->user->inputUserName       = 'Please enter your username';
$lang->user->inputAccountOrEmail = 'Please enter account or Email';
$lang->user->inputPassword       = 'Please enter password';
$lang->user->searchUser          = 'Search';

$lang->user->errorDeny         = "Sorry, you don't have the permission to access <b>%s</b>'s<b>%s</b>. Please contact the administrator.<br/> This page will jump to homepage after 5 seconds";
$lang->user->loginFailed       = "Login failed, please check you account and password.";
$lang->user->identifyFailed    = "identify failed，please check you password.";
$lang->user->locked            = "Failed too much, please login again after ten minutes";
$lang->user->lockedForEver     = "User has been forbidden for ever.";
$lang->user->lblRegistered     = 'Congratulations, register successfully!';
$lang->user->forbidSuccess     = 'Successfully forbid.';
$lang->user->forbidFail        = 'Failed forbid';
$lang->user->activateSuccess   = 'Successfully activate.';
$lang->user->activateFail      = 'Failed activate.';
$lang->user->pullSuccess       = 'Get wechat users successfully';
$lang->user->wrongPwd          = 'Wrong password';
$lang->user->checkEmailSuccess = 'Check email successfully';
$lang->user->sendRecoverEmail  = 'Send recover password email.';
$lang->user->resetSuccess      = 'Reset password successed, please login';

$lang->user->forbidUser = 'Forbid User';
$lang->user->forbidDate = array();
$lang->user->forbidDate['1']     = '1d';
$lang->user->forbidDate['2']     = '2d';
$lang->user->forbidDate['3']     = '3d';
$lang->user->forbidDate['7']     = '7d';
$lang->user->forbidDate['30']    = '30d';
$lang->user->forbidDate['3000']  = 'Forever';
$lang->user->operate             = 'Operate';

$lang->user->adminList['super']  = 'Super administrator';
$lang->user->adminList['common'] = 'Administrator';
$lang->user->adminList['no']     = 'Member';

$lang->user->accountTypeList['no']      = 'Visitor Account';
$lang->user->accountTypeList['common']  = 'Admin Account';

$lang->user->genderList = new stdclass();
$lang->user->genderList->m = 'Male';
$lang->user->genderList->f = 'Female';
$lang->user->genderList->u = '';

$lang->user->register  = new stdclass();
$lang->user->register->common     = 'Register';
$lang->user->register->welcome    = 'Welcome to join the membership.';
$lang->user->register->why        = 'After register, you can enjoy more features and services.';
$lang->user->register->lblUserInfo= 'User info';
$lang->user->register->lblAccount = 'The account must be a series of letters and/or numbers';
$lang->user->register->lblPassword= 'Please set you password, at lest six letters or numbers.';

$lang->user->notice = new stdclass();
$lang->user->notice->password = 'Numbers and letters, at least six';

$lang->user->login  = new stdclass();
$lang->user->login->common  = "Login";
$lang->user->login->welcome = 'Welcome';
$lang->user->login->why     = 'Login, and use more feature.';

$lang->user->resetPassword = new stdclass();
$lang->user->resetPassword->common  = "Reset Password";
$lang->user->resetPassword->success = "Password change link has been sent to your mailbox";
$lang->user->resetPassword->failed  = "Please input your correct mail";

$lang->user->resetMail = new stdclass();
$lang->user->resetMail->subject  = 'Modify password';
$lang->user->resetMail->account  = 'Hello,'; 
$lang->user->resetMail->resetUrl = 'You have requested a reset password operation in %s(%s). Please click the link to change your password:';
$lang->user->resetMail->notice   = 'System letter, please do not reply';

$lang->user->oauth = new stdclass();
$lang->user->oauth->common       = 'OAuth';
$lang->user->oauth->provider     = 'Provider';
$lang->user->oauth->verification = 'Verification';
$lang->user->oauth->widget       = 'Widget';
$lang->user->oauth->callbackURL  = 'callbackURL';

$lang->user->oauth->sina = new stdclass();
$lang->user->oauth->sina->clientID     = 'App Key';
$lang->user->oauth->sina->clientSecret = 'App Secret';

$lang->user->oauth->qq = new stdclass();
$lang->user->oauth->qq->clientID     = 'APP ID';
$lang->user->oauth->qq->clientSecret = 'APP KEY';

$lang->user->oauth->providers['sina'] = 'Sina weibo';
$lang->user->oauth->providers['qq']   = 'QQ';

$lang->user->oauth->typeList['sina']   = 'Sina membership';
$lang->user->oauth->typeList['qq']     = 'QQ membership';
$lang->user->oauth->typeList['wechat'] = 'Wechat membership';

$lang->user->oauth->lblWelcome       = 'OAuth login';
$lang->user->oauth->lblProfile       = "<h3>Register a new account</h3>";
$lang->user->oauth->lblBind          = "<h3>Or bind an registered account</h3>";
$lang->user->oauth->lblUnbind        = "Unbind";
$lang->user->oauth->lblUnbindSuccess = "Unbind successfully!";
$lang->user->oauth->lblUnbindFailed  = "Unbind failed!";
$lang->user->oauth->lblBindFailed    = "Bind user failed！";
$lang->user->oauth->ignore           = "Ignore";

$lang->user->statusList = new stdclass();
$lang->user->statusList->locked    = "<label class='label label-danger'>Locked</label>";
$lang->user->statusList->forbidden = "<label class='label label-danger'>Forbidden</label>";
$lang->user->statusList->normal    = "<label class='label label-success'>Normal</label>";

$lang->user->control = new stdclass();
$lang->user->control->common      = 'User dashboard';
$lang->user->control->welcome     = 'Welcome, <strong>%s</strong>';
$lang->user->control->lblPassword = "Keep empty, will not change it.";

$lang->user->navGroups = new stdclass();
$lang->user->navGroups->user    = 'User profile';
$lang->user->navGroups->order   = 'Order Info';
$lang->user->navGroups->message = 'My messages';

$lang->user->control->menus['profile']    = '<i class="icon-large icon-user"></i> Profile <i class="icon-chevron-right"></i>|user|profile';
$lang->user->control->menus['message']    = '<i class="icon-large icon-comments-alt"></i> Messages <i class="icon-chevron-right"></i>|user|message';
$lang->user->control->menus['score']      = '<i class="icon-sun"></i> Score <i class="icon-chevron-right"></i>|user|score';
$lang->user->control->menus['recharge']   = '<i class="icon-bolt"></i> Recharge Score <i class="icon-chevron-right"></i>|score|buyscore';
$lang->user->control->menus['order']      = '<i class="icon-shopping-cart"></i> My Orders <i class="icon-chevron-right"></i>|order|browse';
$lang->user->control->menus['address']    = '<i class="icon-map-marker"> </i> Addresses <i class="icon-chevron-right"></i>|address|browse';
$lang->user->control->menus['thread']     = '<i class="icon-comment"></i> My Theme <i class="icon-chevron-right"></i>|user|thread';
$lang->user->control->menus['reply']      = '<i class="icon-mail-reply"></i> My Replies <i class="icon-chevron-right"></i>|user|reply';
$lang->user->control->menus['submittion'] = '<i class="icon-envelope"></i> My Submittion <i class="icon-chevron-right"></i>|article|submittion'; 

$lang->user->log = new stdclass();
$lang->user->log->common = 'Log';
$lang->user->log->list   = 'Admin user login log';

$lang->user->log->id          = 'ID';
$lang->user->log->account     = 'User';
$lang->user->log->browser     = 'Browser';
$lang->user->log->ip          = 'IP';
$lang->user->log->location    = 'Location';
$lang->user->log->date        = 'Date';
$lang->user->log->desc        = 'Result';

$lang->user->ipDenied             = 'This IP not allowed login, please do these steps.';
$lang->user->locationDenied       = 'This location not allowed login, please do these steps.';
$lang->user->loginLocationChanged = 'Location has been changed, please do these steps.';
$lang->user->verifyFail           = 'Check email fail,Please input correct email.';
$lang->user->confirmUnbind        = 'Are you sure you want to remove the binding?';
$lang->user->forceYangcong        = 'Yangcong has been open, please confirm your identity.';

$lang->user->placeholder = new stdclass();
$lang->user->placeholder->password   = 'Please enter your website login password';
$lang->user->placeholder->verifyCode = 'Please enter the code you received.';
