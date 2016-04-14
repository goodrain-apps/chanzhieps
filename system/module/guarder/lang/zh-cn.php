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

$lang->guarder->common       = '安全设置';
$lang->guarder->action       = '操作';
$lang->guarder->then         = '则';
$lang->guarder->setBlacklist = '黑名单管理';
$lang->guarder->setWhitelist = '白名单管理';
$lang->guarder->setCaptcha   = '验证码设置';
$lang->guarder->addBlacklist = '添加黑名单';
$lang->guarder->addCaptcha   = '添加验证码';
$lang->guarder->getEmailCode = '获取邮箱验证码';

$lang->guarder->captcha        = '验证码';
$lang->guarder->question       = '问题';
$lang->guarder->answer         = '答案';
$lang->guarder->numbers        = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖', '拾');
$lang->guarder->operators      = array('*' => '乘', '-' => '减', '+' => '加');
$lang->guarder->equal          = '=';
$lang->guarder->placeholder    = '数字、文字';
$lang->guarder->password       = '管理密码';
$lang->guarder->passwordHolder = '请输入当前帐号的密码';
$lang->guarder->identityTip    = '请输入IP、 Email、用户名或敏感词';
$lang->guarder->captchaTip     = '自定义验证码后, 前台将只随机调用此组验证码';

$lang->guarder->verify        = '为了安全起见，当前操作需要验证您的管理员权限';
$lang->guarder->okFile        = '文件方式';
$lang->guarder->created       = '我已创建';
$lang->guarder->email         = '邮箱验证码';
$lang->guarder->setSecurity   = '密保问题';
$lang->guarder->captcha       = '验证码';
$lang->guarder->needVerify    = '需要验证管理员身份';
$lang->guarder->emailFail     = '请填写正确的验证码';
$lang->guarder->questionFail  = '请填写正确的密保答案';
$lang->guarder->verifySuccess = '验证通过，请继续操作';
$lang->guarder->noConfigure   = "无法找到发信配置信息";
$lang->guarder->noEmail       = "未填写个人邮箱";
$lang->guarder->noQuestion    = "未设置密保问题";
$lang->guarder->noCaptcha     = "邮箱验证无法启用。";
$lang->guarder->okFileVerify  = "请在服务器创建 <span class='red'>%s</span> 文件，并写入内容 <span class='red'>%s</span> 。";
$lang->guarder->sendSuccess   = '验证码已发送至 %s';
$lang->guarder->options       = '验证方式';

$lang->guarder->blacklistModes['all']      = '全部';
$lang->guarder->blacklistModes['ip']       = 'ip地址';
$lang->guarder->blacklistModes['account']  = '帐号';
$lang->guarder->blacklistModes['keywords'] = '关键词';
$lang->guarder->blacklistModes['guard']    = '网址';
$lang->guarder->blacklistModes['email']    = '邮箱地址';

$lang->guarder->whitelist = new stdclass();
$lang->guarder->whitelist->ip            = 'IP白名单';
$lang->guarder->whitelist->account       = '账号白名单';
$lang->guarder->whitelist->accountHolder = '多个账户使用 , 隔开如zhangsan,lisi';
$lang->guarder->whitelist->ipHolder      = '多个IP使用 , 隔开如202.194.133.1,202.194.132.0/28';
$lang->guarder->whitelist->wrongIP       = 'IP 格式错误';

$lang->guarder->permanent = '永久';
$lang->guarder->interval  = '分钟内';
$lang->guarder->perDay    = '每天超过';
$lang->guarder->exceed    = '超过';
$lang->guarder->times     = '次';
$lang->guarder->disable   = '禁用';

$lang->guarder->operationList = new stdclass();

$lang->guarder->operationList->ip = new stdclass();
$lang->guarder->operationList->ip->logonFailure    = '登录失败';
$lang->guarder->operationList->ip->register        = '注册数量';
$lang->guarder->operationList->ip->resetPassword   = '找回密码';
$lang->guarder->operationList->ip->resetPWDFailure = '重置密码失败';
$lang->guarder->operationList->ip->postThread      = '发表主题';
$lang->guarder->operationList->ip->postComment     = '发表评论';
$lang->guarder->operationList->ip->postReply       = '回复帖子';
$lang->guarder->operationList->ip->post            = 'POST请求';
$lang->guarder->operationList->ip->search          = '搜索次数';
$lang->guarder->operationList->ip->error404        = '404次数';
$lang->guarder->operationList->ip->captchaFail     = '验证码错误';

$lang->guarder->operationList->account = new stdclass();
$lang->guarder->operationList->account->logonFailure    = '登录失败';
$lang->guarder->operationList->account->resetPassword   = '找回密码';
$lang->guarder->operationList->account->resetPWDFailure = '重置密码失败';
$lang->guarder->operationList->account->postThread      = '发表主题';
$lang->guarder->operationList->account->postComment     = '发表评论';
$lang->guarder->operationList->account->postReply       = '回复帖子';
$lang->guarder->operationList->account->post            = 'POST请求';
$lang->guarder->operationList->account->search          = '搜索次数';
$lang->guarder->operationList->account->error404        = '404次数';
$lang->guarder->operationList->account->captchaFail     = '验证码错误';

$lang->guarder->punishOptions = array();
$lang->guarder->punishOptions[5]     = '5分钟'; 
$lang->guarder->punishOptions[10]    = '10分钟'; 
$lang->guarder->punishOptions[30]    = '半小时'; 
$lang->guarder->punishOptions[60]    = '1小时'; 
$lang->guarder->punishOptions[720]   = '12小时'; 
$lang->guarder->punishOptions[1440]  = '24小时'; 
$lang->guarder->punishOptions[10080] = '一周'; 
$lang->guarder->punishOptions[43200] = '一个月'; 
$lang->guarder->punishOptions[0]     = '永久'; 

$lang->blacklist = new stdclass();
$lang->blacklist->type        = '类型';
$lang->blacklist->title       = '标题';
$lang->blacklist->identity    = '内容';
$lang->blacklist->reason      = '原因';
$lang->blacklist->expiredDate = '解禁时间';
$lang->blacklist->ip          = 'IP';
$lang->blacklist->keywords    = '关键词';
$lang->blacklist->account     = '账户';
$lang->blacklist->email       = '邮箱';
$lang->blacklist->other       = '其他';
