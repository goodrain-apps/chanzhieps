<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The user module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     user
 * @version     $Id: zh-cn.php 824 2010-05-02 15:32:06Z wwccss $
 * @link        http://www.chanzhi.org
 */
$lang->user->common    = '会员';

$lang->user->id        = '编号';
$lang->user->account   = '用户名';
$lang->user->admin     = '管理员';
$lang->user->oldPwd    = '原密码';
$lang->user->password  = '密码';
$lang->user->password2 = '请重复密码';
$lang->user->realname  = '真实姓名';
$lang->user->nickname  = '昵称';
$lang->user->avatar    = '头像';
$lang->user->birthyear = '出生年';
$lang->user->birthday  = '出生月日';
$lang->user->gender    = '性别';
$lang->user->email     = '邮箱';
$lang->user->msn       = 'MSN';
$lang->user->qq        = 'QQ';
$lang->user->yahoo     = '雅虎通';
$lang->user->gtalk     = 'Gtalk';
$lang->user->wangwang  = '旺旺';
$lang->user->mobile    = '手机';
$lang->user->phone     = '电话';
$lang->user->company   = '公司/组织';
$lang->user->address   = '通讯地址';
$lang->user->zipcode   = '邮编';
$lang->user->join      = '注册日期';
$lang->user->visits    = '访问次数';
$lang->user->ip        = '最后IP';
$lang->user->last      = '最后登录';
$lang->user->allowTime = '开放时间';
$lang->user->status    = '状态';
$lang->user->captcha   = '验证码';
$lang->user->alert     = '您的帐号已被禁用';
$lang->user->privilege = '权限';

$lang->user->all             = '全部会员';
$lang->user->list            = '会员列表';
$lang->user->view            = "用户详情";
$lang->user->create          = "添加用户";
$lang->user->edit            = "编辑用户";
$lang->user->operate         = '操作';
$lang->user->changePassword  = "更改密码";
$lang->user->changeEmail     = "邮箱设置";
$lang->user->recoverPassword = "忘记密码";
$lang->user->newPassword     = "新密码";
$lang->user->update          = "编辑用户";
$lang->user->browse          = "浏览用户";
$lang->user->deny            = "访问受限";
$lang->user->confirmDelete   = "您确认删除该用户吗？";
$lang->user->confirmActivate = "您确认激活该用户吗？";
$lang->user->relogin         = "重新登录";
$lang->user->asGuest         = "游客访问";
$lang->user->goback          = "返回前一页";
$lang->user->allUsers        = '全部用户';
$lang->user->submit          = "提交";
$lang->user->forbid          = '禁用';
$lang->user->activate        = '解禁';
$lang->user->pullWechatFans  = '更新微信会员数据';
$lang->user->adminlog        = '登录日志';
$lang->user->checkEmail      = '绑定邮箱';
$lang->user->getEmailCode    = '获取邮箱验证码';
$lang->user->setEmail        = '邮箱设置';
$lang->user->newEmail        = '新邮箱';
$lang->user->rank            = '等级积分';
$lang->user->score           = '积分详情';
$lang->user->myScore         = '当前积分';
$lang->user->buyScore        = '积分充值';
$lang->user->addScore        = '奖励积分';
$lang->user->reduceScore     = '扣除积分';
$lang->user->yangcongLogin   = '洋葱登录';
$lang->user->bindAccount     = '绑定帐号';
$lang->user->batchDelete     = '批量删除用户';
$lang->user->deleteHistory   = '删除用户及历史数据';
$lang->user->question        = '密保问题';
$lang->user->answer          = '答案';

$lang->user->type        = '账户类型';
$lang->user->profile     = '个人信息';
$lang->user->editProfile = '编辑信息';
$lang->user->thread      = '我的主题';
$lang->user->messages    = '我的消息';
$lang->user->reply       = '我的回贴';
$lang->user->submittion  = '我的投稿';

$lang->user->userHistory       = "用户历史数据";
$lang->user->threadHistory     = "发帖";
$lang->user->replyHistory      = "回帖";
$lang->user->commentHistory    = "评论";
$lang->user->messageHistory    = "留言";
$lang->user->orderHistory      = "订单";
$lang->user->addressHistory    = "地址";
$lang->user->submittionHistory = "投稿";

$lang->user->message = new stdclass();
$lang->user->message->mine = "我的消息 <span class='label label-badge text-latin'>%s</span>";
$lang->user->message->from = '来自';

$lang->user->inputUserName       = '请输入用户名';
$lang->user->inputAccountOrEmail = '请输入用户名或Email';
$lang->user->inputPassword       = '请输入密码';
$lang->user->searchUser          = '搜索';

$lang->user->errorDeny         = "抱歉，您无权访问『<b>%s</b>』模块的『<b>%s</b>』功能。请联系管理员获取权限。点击后退返回上页。<br/> 5秒钟后将自动返回首页...";
$lang->user->loginFailed       = "登录失败，请检查您的用户名或密码是否填写正确。";
$lang->user->identifyFailed    = "验证失败，请检查您的密码是否正确。";
$lang->user->locked            = "用户已经被锁定，请%s后再重新尝试登录";
$lang->user->lockedForEver     = "用户已经被永久禁用。";
$lang->user->lblRegistered     = '恭喜您，已经成功注册。';
$lang->user->forbidSuccess     = '禁用成功';
$lang->user->forbidFail        = '禁用失败';
$lang->user->activateSuccess   = '解除禁用成功';
$lang->user->activateFail      = '解除禁用失败';
$lang->user->pullSuccess       = '获取微信会员成功';
$lang->user->wrongPwd          = '密码错误';
$lang->user->checkEmailSuccess = '邮箱绑定成功';
$lang->user->sendRecoverEmail  = '发送重置邮件';
$lang->user->resetSuccess      = '重置密码成功，请用新密码登录';

$lang->user->forbidUser = '禁用管理';
$lang->user->forbidDate = array();
$lang->user->forbidDate['1']    = '一天';
$lang->user->forbidDate['2']    = '两天';
$lang->user->forbidDate['3']    = '三天';
$lang->user->forbidDate['7']    = '一周';
$lang->user->forbidDate['30']   = '一个月';
$lang->user->forbidDate['3000'] = '永久';

$lang->user->adminList['super']  = '超级管理员';
$lang->user->adminList['common'] = '管理员';
$lang->user->adminList['no']     = '普通会员';

$lang->user->accountTypeList['no']      = '前台账号';
$lang->user->accountTypeList['common']  = '后台账号';

$lang->user->genderList = new stdclass();
$lang->user->genderList->m = '男';
$lang->user->genderList->f = '女';
$lang->user->genderList->u = '';

$lang->user->register  = new stdclass();
$lang->user->register->common      = '注册';
$lang->user->register->welcome     = '欢迎注册成为会员';
$lang->user->register->why         = '欢迎注册成为我们的会员，您可以享受更多的服务。';
$lang->user->register->lblUserInfo = '用户信息';
$lang->user->register->lblAccount  = '必须是三位以上的英文字母或数字';
$lang->user->register->lblPassword = '数字和字母组成，六位以上';

$lang->user->notice = new stdclass();
$lang->user->notice->password = '字母和数字组合，最少六位';

$lang->user->login  = new stdclass();
$lang->user->login->common  = "登录";
$lang->user->login->welcome = '已有帐号';
$lang->user->login->why     = '欢迎登陆，享用会员专属服务！';

$lang->user->resetPassword = new stdclass();
$lang->user->resetPassword->common  = "重置密码";
$lang->user->resetPassword->success = "密码更改链接已经发送到您的邮箱中";
$lang->user->resetPassword->failed  = "您的密保邮箱错误，请重新输入";

$lang->user->resetMail = new stdclass();
$lang->user->resetMail->subject  = '重置密码';
$lang->user->resetMail->account  = '你好，'; 
$lang->user->resetMail->resetUrl = '您在%s（%s）请求了重置密码操作，请点击下面的链接，进行重置密码：'; 
$lang->user->resetMail->notice   = '系统发信，请勿回复（如果您没有进行操作，请忽略此邮件）';

$lang->user->oauth = new stdclass();
$lang->user->oauth->common       = '开放登录';
$lang->user->oauth->provider     = '服务商';
$lang->user->oauth->verification = '网站验证';
$lang->user->oauth->widget       = '网页组件';
$lang->user->oauth->callbackURL  = '回调地址';

$lang->user->oauth->sina = new stdclass();
$lang->user->oauth->sina->clientID     = 'App Key';
$lang->user->oauth->sina->clientSecret = 'App Secret';

$lang->user->oauth->qq = new stdclass();
$lang->user->oauth->qq->clientID     = 'APP ID';
$lang->user->oauth->qq->clientSecret = 'APP KEY';

$lang->user->oauth->providers['sina'] = '新浪微博';
$lang->user->oauth->providers['qq']   = 'QQ';

$lang->user->oauth->typeList['sina']   = '新浪微博会员';
$lang->user->oauth->typeList['qq']     = 'QQ会员';
$lang->user->oauth->typeList['wechat'] = '微信会员';

$lang->user->oauth->lblWelcome       = '开放登录，快捷方便';
$lang->user->oauth->lblProfile       = "注册新用户";
$lang->user->oauth->lblBind          = "绑定已有用户";
$lang->user->oauth->lblUnbind        = "解除绑定";
$lang->user->oauth->lblUnbindSuccess = "解除绑定成功！";
$lang->user->oauth->lblUnbindFailed  = "解除绑定失败！";
$lang->user->oauth->lblBindFailed    = "绑定用户失败！";
$lang->user->oauth->ignore           = "忽略";

$lang->user->statusList = new stdclass();
$lang->user->statusList->locked    = "<label class='label label-danger'>锁定</label>";
$lang->user->statusList->forbidden = "<label class='label label-danger'>禁用</label>";
$lang->user->statusList->normal    = "<label class='label label-success'>正常</label>";

$lang->user->control = new stdclass();
$lang->user->control->common      = '用户中心';
$lang->user->control->welcome     = '欢迎您，<strong>%s</strong>';
$lang->user->control->lblPassword = "留空，则保持不变。";

$lang->user->navGroups = new stdclass();
$lang->user->navGroups->user    = '个人信息';
$lang->user->navGroups->order   = '订单信息';
$lang->user->navGroups->message = '主题消息';

$lang->user->control->menus['profile']    = '<i class="icon-user"></i> 个人信息 <i class="icon-chevron-right"></i>|user|profile';
$lang->user->control->menus['message']    = '<i class="icon-comments-alt"></i> 我的消息 <i class="icon-chevron-right"></i>|user|message';
$lang->user->control->menus['score']      = '<i class="icon-sun"></i> 积分详情 <i class="icon-chevron-right"></i>|user|score';
$lang->user->control->menus['recharge']   = '<i class="icon-bolt"></i> 积分充值 <i class="icon-chevron-right"></i>|score|buyscore';
$lang->user->control->menus['order']      = '<i class="icon-shopping-cart"></i> 我的订单 <i class="icon-chevron-right"></i>|order|browse';
$lang->user->control->menus['address']    = '<i class="icon-map-marker"> </i> 地址管理 <i class="icon-chevron-right"></i>|address|browse';
$lang->user->control->menus['thread']     = '<i class="icon-comment"></i> 我的主题 <i class="icon-chevron-right"></i>|user|thread';
$lang->user->control->menus['reply']      = '<i class="icon-mail-reply"></i> 我的回帖 <i class="icon-chevron-right"></i>|user|reply';
$lang->user->control->menus['submittion'] = '<i class="icon-envelope"></i> 我的投稿 <i class="icon-chevron-right"></i>|article|submittion'; 

$lang->user->log = new stdclass();
$lang->user->log->common = '日志';
$lang->user->log->list   = '登录日志';

$lang->user->log->id          = 'ID';
$lang->user->log->account     = '用户';
$lang->user->log->browser     = '浏览器';
$lang->user->log->ip          = 'IP';
$lang->user->log->location    = '登录地址';
$lang->user->log->date        = '登录时间';
$lang->user->log->desc        = '结果';

$lang->user->ipDenied             = '登录IP受限，请按提示操作。';
$lang->user->locationDenied       = '登录地区受限，请按提示操作。';
$lang->user->loginLocationChanged = '登录地址发生变化，请按提示操作。';
$lang->user->verifyFail           = '请填写正确的验证码';
$lang->user->confirmUnbind        = '您确定要解除绑定吗？';
$lang->user->forceYangcong        = '已开启强制洋葱登录，普通登录需要进行验证。';

$lang->user->placeholder = new stdclass();
$lang->user->placeholder->password   = '请输入您的网站登录密码';
$lang->user->placeholder->verifyCode = '请输入验证邮件里面收到的验证码';
