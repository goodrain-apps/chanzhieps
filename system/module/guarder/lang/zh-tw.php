<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The comment module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     comment
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->guarder = new stdclass();

$lang->guarder->common       = '安全設置';
$lang->guarder->action       = '操作';
$lang->guarder->then         = '則';
$lang->guarder->setBlacklist = '黑名單管理';
$lang->guarder->setWhitelist = '白名單管理';
$lang->guarder->setCaptcha   = '驗證碼設置';
$lang->guarder->addBlacklist = '添加黑名單';
$lang->guarder->addCaptcha   = '添加驗證碼';
$lang->guarder->getEmailCode = '獲取郵箱驗證碼';

$lang->guarder->captcha        = '驗證碼';
$lang->guarder->question       = '問題';
$lang->guarder->answer         = '答案';
$lang->guarder->numbers        = array('零', '壹', '貳', '叄', '肆', '伍', '陸', '柒', '捌', '玖', '拾');
$lang->guarder->operators      = array('*' => '乘', '-' => '減', '+' => '加');
$lang->guarder->equal          = '=';
$lang->guarder->placeholder    = '數字、文字';
$lang->guarder->password       = '管理密碼';
$lang->guarder->passwordHolder = '請輸入當前帳號的密碼';
$lang->guarder->identityTip    = '請輸入IP、 Email、用戶名或敏感詞';
$lang->guarder->captchaTip     = '自定義驗證碼後, 前台將只隨機調用此組驗證碼';

$lang->guarder->verify           = '為了安全起見，當前操作需要驗證您的管理員權限';
$lang->guarder->okFile           = '檔案方式';
$lang->guarder->created          = '我已創建';
$lang->guarder->email            = '郵箱驗證碼';
$lang->guarder->securityQuestion = '密保問題';
$lang->guarder->captcha          = '驗證碼';
$lang->guarder->needVerify       = '需要驗證管理員身份';
$lang->guarder->emailFail        = '請填寫正確的驗證碼';
$lang->guarder->questionFail     = '請填寫正確的密保答案';
$lang->guarder->verifySuccess    = '驗證通過，請繼續操作';
$lang->guarder->noConfigure      = "無法找到發信配置信息";
$lang->guarder->noEmail          = "未填寫個人郵箱";
$lang->guarder->noQuestion       = "未設置密保問題";
$lang->guarder->noCaptcha        = "郵箱驗證無法啟用。";
$lang->guarder->okFileVerify     = "請在伺服器創建 <span class='red'>%s</span> 檔案，並寫入內容 <span class='red'>%s</span> 。";
$lang->guarder->sendSuccess      = '驗證碼已發送至 %s';
$lang->guarder->options          = '驗證方式';

$lang->guarder->blacklistModes['all']      = '全部';
$lang->guarder->blacklistModes['ip']       = 'ip地址';
$lang->guarder->blacklistModes['account']  = '帳號';
$lang->guarder->blacklistModes['keywords'] = '關鍵詞';
$lang->guarder->blacklistModes['guard']    = '網址';
$lang->guarder->blacklistModes['email']    = '郵箱地址';

$lang->guarder->whitelist = new stdclass();
$lang->guarder->whitelist->ip            = 'IP白名單';
$lang->guarder->whitelist->account       = '賬號白名單';
$lang->guarder->whitelist->accountHolder = '多個賬戶使用 , 隔開如zhangsan,lisi';
$lang->guarder->whitelist->ipHolder      = '多個IP使用 , 隔開如202.194.133.1,202.194.132.0/28';
$lang->guarder->whitelist->wrongIP       = 'IP 格式錯誤';

$lang->guarder->permanent = '永久';
$lang->guarder->interval  = '分鐘內';
$lang->guarder->perDay    = '每天超過';
$lang->guarder->exceed    = '超過';
$lang->guarder->times     = '次';
$lang->guarder->disable   = '禁用';

$lang->guarder->operationList = new stdclass();

$lang->guarder->operationList->ip = new stdclass();
$lang->guarder->operationList->ip->logonFailure    = '登錄失敗';
$lang->guarder->operationList->ip->register        = '註冊數量';
$lang->guarder->operationList->ip->resetPassword   = '找回密碼';
$lang->guarder->operationList->ip->resetPWDFailure = '重置密碼失敗';
$lang->guarder->operationList->ip->postThread      = '發表主題';
$lang->guarder->operationList->ip->postComment     = '發表評論';
$lang->guarder->operationList->ip->postReply       = '回覆帖子';
$lang->guarder->operationList->ip->post            = 'POST請求';
$lang->guarder->operationList->ip->search          = '搜索次數';
$lang->guarder->operationList->ip->error404        = '404次數';
$lang->guarder->operationList->ip->captchaFail     = '驗證碼錯誤';

$lang->guarder->operationList->account = new stdclass();
$lang->guarder->operationList->account->logonFailure    = '登錄失敗';
$lang->guarder->operationList->account->resetPassword   = '找回密碼';
$lang->guarder->operationList->account->resetPWDFailure = '重置密碼失敗';
$lang->guarder->operationList->account->postThread      = '發表主題';
$lang->guarder->operationList->account->postComment     = '發表評論';
$lang->guarder->operationList->account->postReply       = '回覆帖子';
$lang->guarder->operationList->account->post            = 'POST請求';
$lang->guarder->operationList->account->search          = '搜索次數';
$lang->guarder->operationList->account->error404        = '404次數';
$lang->guarder->operationList->account->captchaFail     = '驗證碼錯誤';

$lang->guarder->punishOptions = array();
$lang->guarder->punishOptions[5]     = '5分鐘'; 
$lang->guarder->punishOptions[10]    = '10分鐘'; 
$lang->guarder->punishOptions[30]    = '半小時'; 
$lang->guarder->punishOptions[60]    = '1小時'; 
$lang->guarder->punishOptions[720]   = '12小時'; 
$lang->guarder->punishOptions[1440]  = '24小時'; 
$lang->guarder->punishOptions[10080] = '一周'; 
$lang->guarder->punishOptions[43200] = '一個月'; 
$lang->guarder->punishOptions[0]     = '永久'; 

$lang->blacklist = new stdclass();
$lang->blacklist->type        = '類型';
$lang->blacklist->title       = '標題';
$lang->blacklist->identity    = '內容';
$lang->blacklist->reason      = '原因';
$lang->blacklist->expiredDate = '解禁時間';
$lang->blacklist->ip          = 'IP';
$lang->blacklist->keywords    = '關鍵詞';
$lang->blacklist->account     = '賬戶';
$lang->blacklist->email       = '郵箱';
$lang->blacklist->other       = '其他';
