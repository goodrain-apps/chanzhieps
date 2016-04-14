<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The site module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->site->common        = "站點";

$lang->site->type            = '站點類型';
$lang->site->status          = '站點狀態';
$lang->site->pauseTip        = '暫停提示';
$lang->site->name            = '網站名稱';
$lang->site->module          = '功能模組';
$lang->site->lang            = '站點語言';
$lang->site->defaultLang     = '預設語言';
$lang->site->domain          = '主域名';
$lang->site->allowedDomain   = '可訪問域名';
$lang->site->keywords        = '關鍵詞';
$lang->site->indexKeywords   = '首頁關鍵詞';
$lang->site->meta            = 'Meta 標籤';
$lang->site->desc            = '站點描述';
$lang->site->icpSN           = '備案編號';
$lang->site->icpLink         = '備案連結';
$lang->site->slogan          = '站點口號';
$lang->site->mission         = '站點使命';
$lang->site->copyright       = '創建年份';
$lang->site->allowUpload     = '允許上傳附件';
$lang->site->allowedFiles    = '允許附件類型';
$lang->site->setImageSize    = '圖片縮略圖大小';
$lang->site->captcha         = '前台表單';
$lang->site->mailCaptcha     = '郵箱驗證碼';
$lang->site->twContent       = '繁體內容';
$lang->site->cn2tw           = '自動從簡體版複製';
$lang->site->cdn             = 'CDN地址';
$lang->site->sensitive       = '敏感詞';
$lang->site->scheme          = '預設訪問協議';
$lang->site->saveDays        = '日誌保存天數';

$lang->site->importantOption  = '重要操作';
$lang->site->resetPassword    = '前台找回密碼';
$lang->site->checkIP          = '後台登錄IP白名單';
$lang->site->checkLocation    = '後台登錄地區驗證';
$lang->site->checkEmail       = '會員郵箱綁定';
$lang->site->filterFunction   = '過濾功能';
$lang->site->allowedLocation  = '允許登錄地區';
$lang->site->checkSessionIP   = '後台檢查IP';
$lang->site->forceYangcong    = '後台強制洋蔥登錄';
$lang->site->setsecurity      = '安全設置';
$lang->site->setsensitive     = '敏感詞設置';
$lang->site->filterSensitive  = '敏感詞過濾';
$lang->site->setBlacklist     = '黑名單管理';
$lang->site->mobileTemplate   = '移動模板';
$lang->site->score            = '積分';
$lang->site->setCounts        = '積分規則';
$lang->site->front            = '網站瀏覽';
$lang->site->closeScoreTip    = '禁用積分功能後不再記錄積分，會員保持原有積分不變。';
$lang->site->cdnTip           = 'cdn資源僅在非debug模式下啟用，包含：字型、css和js，不包含附件。';
$lang->site->useCDN           = '啟用CDN';

$lang->site->setBasic      = "基本信息設置";
$lang->site->setCDN        = "CDN設置";
$lang->site->setLang       = "語言設置";
$lang->site->setFilter     = "過濾設置";
$lang->site->ipFilter      = "ip過濾";
$lang->site->accountFilter = "賬號過濾";
$lang->site->setSecurity   = "安全設置";
$lang->site->setUpload     = "附件上傳";
$lang->site->setRobots     = "Robots 設置";
$lang->site->setOauth      = "開放登錄";
$lang->site->setSinaOauth  = "新浪微博接入";
$lang->site->setYangcong   = "洋蔥登錄設置";
$lang->site->setQQOauth    = "QQ接入";
$lang->site->oauthHelp     = "使用幫助";
$lang->site->setRecPerPage = "列表數量設置";
$lang->site->useLocation   = "使用當前登錄地址: <span>%s</span>";
$lang->site->changeSetting = "更改設置";
$lang->site->setStat       = "流量統計設置";

$lang->site->typeList = new stdclass();
$lang->site->typeList->portal = '企業門戶';
$lang->site->typeList->blog   = '個人博客';

$lang->site->statusList = new stdclass();
$lang->site->statusList->normal = '正常';
$lang->site->statusList->pause  = '暫停';

$lang->site->resetPasswordList = array();
$lang->site->resetPasswordList['open']  = '開啟';
$lang->site->resetPasswordList['close'] = '關閉';

$lang->site->forceYangcongList = array();
$lang->site->forceYangcongList['open']  = '開啟';
$lang->site->forceYangcongList['close'] = '關閉';

$lang->site->checkIPList = array();
$lang->site->checkIPList['open']  = '開啟';
$lang->site->checkIPList['close'] = '關閉';

$lang->site->filterSensitiveList = array();
$lang->site->filterSensitiveList['open']  = '開啟';
$lang->site->filterSensitiveList['close'] = '關閉';

$lang->site->checkLocationList = array();
$lang->site->checkLocationList['open']  = '開啟';
$lang->site->checkLocationList['close'] = '關閉';

$lang->site->checkEmailList = array();
$lang->site->checkEmailList['open']  = '開啟';
$lang->site->checkEmailList['close'] = '關閉';

$lang->site->sessionIpoptions = array();
$lang->site->sessionIpoptions[1] = '檢查';
$lang->site->sessionIpoptions[0] = '不檢查';

$lang->site->imageSize['s'] = '小圖';
$lang->site->imageSize['m'] = '中圖';
$lang->site->imageSize['l'] = '大圖';

$lang->site->image['width']  = '寬度';
$lang->site->image['height'] = '高度';

$lang->site->captchaList = array();
$lang->site->captchaList['open']  = '一直啟用驗證碼';
$lang->site->captchaList['auto']  = '有敏感內容時自動啟用驗證碼';
$lang->site->captchaList['close'] = '不用驗證碼';

$lang->site->validateTypes = new stdclass();
$lang->site->validateTypes->okFile           = '檔案驗證';
$lang->site->validateTypes->email            = '郵件驗證碼驗證';
$lang->site->validateTypes->securityQuestion = '密保問題驗證';

$lang->site->schemeList = array();
$lang->site->schemeList['http']  = 'http';
$lang->site->schemeList['https'] = 'https';

$lang->site->frontList = array();
$lang->site->frontList['login'] = '需要登錄';
$lang->site->frontList['guest'] = '不需要登錄';

$lang->site->mobileTemplateList['open']  = '啟用';
$lang->site->mobileTemplateList['close'] = '禁用';

$lang->site->scoreList['open']  = '啟用';
$lang->site->scoreList['close'] = '禁用';

$lang->site->cdnList['open']  = '啟用';
$lang->site->cdnList['close'] = '關閉';

$lang->site->filterFunctionList['open']  = '啟用';
$lang->site->filterFunctionList['close'] = '關閉';

$lang->site->moduleAvailable = array();
$lang->site->moduleAvailable['user']       = '會員';
$lang->site->moduleAvailable['article']    = '文章';
$lang->site->moduleAvailable['blog']       = '博客';
$lang->site->moduleAvailable['product']    = '產品';
$lang->site->moduleAvailable['book']       = '手冊';
$lang->site->moduleAvailable['page']       = '單頁';
$lang->site->moduleAvailable['forum']      = '論壇';
$lang->site->moduleAvailable['message']    = '評論留言';
$lang->site->moduleAvailable['search']     = '搜索';
$lang->site->moduleAvailable['shop']       = '商城';
$lang->site->moduleAvailable['score']      = '積分';
$lang->site->moduleAvailable['stat']       = '統計';
$lang->site->moduleAvailable['submittion'] = '投稿';

$lang->site->metaHolder       = '可放置<meta><script><style>和<link>標籤。';
$lang->site->fileAllowedRole  = '多個尾碼名之間請用 "," 隔開';
$lang->site->domainTip        = '設置主域名可使所有網站訪問跳轉到該域名，設置前請確保主域名解析正確。該值為空時不進行跳轉。';
$lang->site->allowedDomainTip = '多個域名使用 , 隔開，如www.chanzhi.org,www.chanzhi.com。該值為空時允許所有域名訪問。';
$lang->site->allowedIPTip     = '多個IP使用 , 隔開，如202.194.133.1,202.194.132.0/28。允許所有IP訪問請留空。';
$lang->site->wrongAllowedIP   = 'IP 格式錯誤';
$lang->site->changeLocation   = '您當前的登錄地區與允許登錄地區不一致。';
$lang->site->sessionIpTip     = '開啟後，如IP變化將自動退出登錄。';
$lang->site->schemeTip        = '所有訪問會跳轉至預設訪問協議。';
$lang->site->saveDaysTip      = '訪問日誌保存天數必須為為 >0 的數字。';
$lang->site->yangcongTip      = '開啟強制洋蔥登錄後，您可以通過設置密保問題開啟密保登錄作為備用。';

$lang->site->robots            = 'Robots';
$lang->site->robotsUnwriteable = 'Robots檔案%s 不可寫，請修改權限後設置。';
$lang->site->reloadForRobots   = '刷新頁面';
$lang->site->defaultTip        = '站點維護中……';
$lang->site->icpTip            = '';

$lang->site->customizableList = new stdclass();
$lang->site->customizableList->article = '文章列表數量';
$lang->site->customizableList->product = '產品列表數量';
$lang->site->customizableList->blog    = '博客列表數量';
$lang->site->customizableList->forum   = '論壇列表數量';
$lang->site->customizableList->reply   = '回帖列表數量';
$lang->site->customizableList->message = '留言列表數量';
$lang->site->customizableList->comment = '評論列表數量';

$lang->site->yangcong = new stdclass();
$lang->site->yangcong->appID = 'APP ID';
$lang->site->yangcong->key   = 'APP KEY';
$lang->site->yangcong->auth  = 'Auth ID';
