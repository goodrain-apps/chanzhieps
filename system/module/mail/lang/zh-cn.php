<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->mail->common = '发信设置';
$lang->mail->index  = '首页';
$lang->mail->detect = '检测';
$lang->mail->edit   = '编辑配置';
$lang->mail->save   = '成功保存';
$lang->mail->test   = '测试发信';
$lang->mail->reset  = '重置';

$lang->mail->turnon       = '是否打开';
$lang->mail->fromAddress  = '发信邮箱';
$lang->mail->fromName     = '发信人';
$lang->mail->mta          = '发信方式';
$lang->mail->host         = 'smtp服务器';
$lang->mail->port         = 'smtp端口号';
$lang->mail->auth         = '是否需要验证';
$lang->mail->username     = 'smtp帐号';
$lang->mail->password     = 'smtp密码';
$lang->mail->secure       = '是否加密';
$lang->mail->debug        = '调试级别';
$lang->mail->getEmailCode = '获取邮箱验证码';

$lang->mail->turnonList[1] = '打开';
$lang->mail->turnonList[0] = '关闭';

$lang->mail->debugList[0] = '关闭';
$lang->mail->debugList[1] = '一般';
$lang->mail->debugList[2] = '较高';

$lang->mail->authList[1] = '需要';
$lang->mail->authList[0] = '不需要';

$lang->mail->secureList['']    = '不加密';
$lang->mail->secureList['ssl'] = 'ssl';
$lang->mail->secureList['tls'] = 'tls';

$lang->mail->inputFromEmail = '请输入发信邮箱：';
$lang->mail->nextStep       = '下一步';
$lang->mail->successSaved   = '配置信息已经成功保存。';
$lang->mail->subject        = '测试邮件';
$lang->mail->content        = '邮箱设置成功';
$lang->mail->sending        = "邮件正在发往 %s ,请稍侯...";
$lang->mail->successSended  = '成功发送！';
$lang->mail->needConfigure  = '无法找到邮件配置信息，请先配置邮件发送参数。';
$lang->mail->error          = '你的邮箱地址有误，请填写正确的邮箱地址。'; 
$lang->mail->trySendlater   = '三分钟内不能重复发送邮件。'; 

$lang->mail->captcha     = '验证码';
$lang->mail->sendContent = <<<EOT
%s 您好：
<br />您在<strong>%s</strong>(%s)上面的验证码为：%s
<br />如非您本人操作，请忽略。
<br />
<br /><strong>%s</strong>由<a href='http://www.chanzhi.org' target='_blank'>蝉知企业门户系统</a>搭建。
<br /><a href='http://www.cnezsoft.com' target='_blank'>易软天创</a>为天下企业提供专业的管理工具。
EOT;
