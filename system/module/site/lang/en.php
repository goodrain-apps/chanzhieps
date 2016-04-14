<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The site module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->site->common        = "Site";

$lang->site->type            = 'Type';
$lang->site->status          = 'Status';
$lang->site->pauseTip        = 'Tip for pause site';
$lang->site->name            = 'Name';
$lang->site->module          = 'Modules';
$lang->site->lang            = 'Language';
$lang->site->defaultLang     = 'Default Language';
$lang->site->domain          = 'Main Domain';
$lang->site->allowedDomain   = 'Allowed Domain';
$lang->site->keywords        = 'Site Keywords';
$lang->site->indexKeywords   = 'Index Keywords';
$lang->site->meta            = 'Meta';
$lang->site->desc            = 'Description';
$lang->site->icpSN           = 'ICP';
$lang->site->icpLink         = 'ICP Link';
$lang->site->slogan          = 'Slogan';
$lang->site->mission         = 'Mission';
$lang->site->copyright       = 'Copyright';
$lang->site->allowUpload     = 'Allow upload files';
$lang->site->allowedFiles    = 'Allowed file types';
$lang->site->setImageSize    = 'Set thumbs';
$lang->site->captcha         = 'Captcha';
$lang->site->mailCaptcha     = 'Mail captcha';
$lang->site->twContent       = 'traditional contents';
$lang->site->cn2tw           = 'Copy from simplified Chinese content';
$lang->site->cdn             = 'CND Site';
$lang->site->sensitive       = 'Sensitive Words';
$lang->site->scheme          = 'Default scheme';
$lang->site->saveDays        = 'Save days';

$lang->site->importantOption  = 'Important option';
$lang->site->resetPassword    = 'Member Reset Password';
$lang->site->checkIP          = 'Check login IP';
$lang->site->checkLocation    = 'Check login location';
$lang->site->checkEmail       = 'Check Email';
$lang->site->filterFunction   = 'Filter function';
$lang->site->allowedLocation  = 'Allowed location';
$lang->site->checkSessionIP   = 'Check admin ip';
$lang->site->forceYangcong    = 'Enforce Admin login by yangcong';
$lang->site->setsecurity      = 'Security setting';
$lang->site->setsensitive     = 'Set sensitive words';
$lang->site->filterSensitive  = 'Filter sensitive words';
$lang->site->setBlacklist     = 'Blacklist Management';
$lang->site->mobileTemplate   = 'Mobile Template';
$lang->site->score            = 'Score';
$lang->site->setCounts        = 'Set score rule';
$lang->site->front            = 'Visit website';
$lang->site->closeScoreTip    = 'After disabling the integral function, CV will not be cummulative and remain unchanged.';
$lang->site->cdnTip           = 'CDN source take place when debug is closed, Contains css, js, font files. not include uploaded files.';
$lang->site->useCDN           = 'Enable CDN';

$lang->site->setBasic      = "Baisc";
$lang->site->setCDN        = "CDN Setting";
$lang->site->setLang       = "Languages";
$lang->site->setFilter     = "Filter Settings";
$lang->site->ipFilter      = "ip Filter";
$lang->site->accountFilter = "Account Filter";
$lang->site->setSecurity   = "Security";
$lang->site->setUpload     = "Upload";
$lang->site->setRobots     = "Robots";
$lang->site->setOauth      = "Oauth";
$lang->site->setSinaOauth  = "Weibo Oauth";
$lang->site->setYangcong   = "Yangcong Login";
$lang->site->setQQOauth    = "QQ Oauth";
$lang->site->oauthHelp     = "Help";
$lang->site->setRecPerPage = "Record per page";
$lang->site->useLocation   = "Use current Location: <span>%s</span>";
$lang->site->changeSetting = "Change settings";
$lang->site->setStat       = "Stats Settings";

$lang->site->typeList = new stdclass();
$lang->site->typeList->portal = 'Portal';
$lang->site->typeList->blog   = 'Blog';

$lang->site->statusList = new stdclass();
$lang->site->statusList->normal = 'Normal';
$lang->site->statusList->pause  = 'Pause';

$lang->site->resetPasswordList = array();
$lang->site->resetPasswordList['open']  = 'Open';
$lang->site->resetPasswordList['close'] = 'Close';

$lang->site->forceYangcongList = array();
$lang->site->forceYangcongList['open']  = 'Open';
$lang->site->forceYangcongList['close'] = 'Close';

$lang->site->checkIPList = array();
$lang->site->checkIPList['open']  = 'Open';
$lang->site->checkIPList['close'] = 'Close';

$lang->site->filterSensitiveList = array();
$lang->site->filterSensitiveList['open']  = 'Open';
$lang->site->filterSensitiveList['close'] = 'Close';

$lang->site->checkLocationList = array();
$lang->site->checkLocationList['open']  = 'Open';
$lang->site->checkLocationList['close'] = 'Close';

$lang->site->checkEmailList = array();
$lang->site->checkEmailList['open']  = 'Open';
$lang->site->checkEmailList['close'] = 'Close';

$lang->site->sessionIpoptions = array();
$lang->site->sessionIpoptions[1] = 'Check';
$lang->site->sessionIpoptions[0] = "Don't check";

$lang->site->imageSize['s'] = 'Small';
$lang->site->imageSize['m'] = 'Middle';
$lang->site->imageSize['l'] = 'Large';

$lang->site->image['width']  = 'Width';
$lang->site->image['height'] = 'Height';

$lang->site->captchaList = array();
$lang->site->captchaList['open']  = 'Open';
$lang->site->captchaList['auto']  = 'Automatic';
$lang->site->captchaList['close'] = 'Close';

$lang->site->validateTypes = new stdclass();
$lang->site->validateTypes->okFile      = 'File';
$lang->site->validateTypes->email       = 'Email';
$lang->site->validateTypes->setSecurity = 'Security Question';

$lang->site->schemeList = array();
$lang->site->schemeList['http']  = 'http';
$lang->site->schemeList['https'] = 'https';

$lang->site->frontList = array();
$lang->site->frontList['login'] = 'Need login';
$lang->site->frontList['guest'] = "Needn't login";

$lang->site->mobileTemplateList['open']  = 'Open';
$lang->site->mobileTemplateList['close'] = 'Close';

$lang->site->scoreList['open']  = 'Open';
$lang->site->scoreList['close'] = 'Close';

$lang->site->cdnList['open']  = 'open';
$lang->site->cdnList['close'] = 'close';

$lang->site->filterFunctionList['open']  = 'open';
$lang->site->filterFunctionList['close'] = 'close';

$lang->site->moduleAvailable = array();
$lang->site->moduleAvailable['user']       = 'Member';
$lang->site->moduleAvailable['article']    = 'Article';
$lang->site->moduleAvailable['blog']       = 'Blog';
$lang->site->moduleAvailable['product']    = 'Product';
$lang->site->moduleAvailable['book']       = 'Book';
$lang->site->moduleAvailable['page']       = 'Page';
$lang->site->moduleAvailable['forum']      = 'Forum';
$lang->site->moduleAvailable['message']    = 'Message';
$lang->site->moduleAvailable['search']     = 'Search';
$lang->site->moduleAvailable['shop']       = 'Shop';
$lang->site->moduleAvailable['score']      = 'Score';
$lang->site->moduleAvailable['stat']       = 'Statistics';
$lang->site->moduleAvailable['submittion'] = 'Submittion';

$lang->site->metaHolder       = 'Tags, like <meta>, <script>, <style>, <link>, is accepted.';
$lang->site->fileAllowedRole  = 'Use "," to divide different extension name.';
$lang->site->domainTip        = 'Redirect all request to this domian.';
$lang->site->allowedDomainTip = 'Use "," to divide different domain.';
$lang->site->allowedIPTip     = 'Use "," to divide different IP.';
$lang->site->wrongAllowedIP   = 'Wrong IP';
$lang->site->changeLocation   = 'Your current login location not in allowed location.';
$lang->site->sessionIpTip     = 'If opened login ip would be checked.';
$lang->site->schemeTip        = 'Redirect all request to this scheme.';
$lang->site->saveDaysTip      = "The access logs' save day must be a positive number.";
$lang->site->yangcongTip      = 'After opening force yangcong login, you can open security question login as a backup through setting security question.';

$lang->site->robots            = 'Robots';
$lang->site->robotsUnwriteable = 'Can not write robots file, please make sure %s writeable first.';
$lang->site->reloadForRobots   = 'Reload this ppage';
$lang->site->defaultTip        = 'Under maintenance.';
$lang->site->icpTip            = 'For Mainland China site only';

$lang->site->customizableList = new stdclass();
$lang->site->customizableList->article = 'Article List Number';
$lang->site->customizableList->product = 'Product List Number';
$lang->site->customizableList->blog    = 'Blog List Number';
$lang->site->customizableList->forum   = 'Thread List Number';
$lang->site->customizableList->reply   = 'Reply List Number';
$lang->site->customizableList->message = 'Message List Number';
$lang->site->customizableList->comment = 'Comment List Number';

$lang->site->yangcong = new stdclass();
$lang->site->yangcong->appID = 'APP ID';
$lang->site->yangcong->key   = 'APP KEY';
$lang->site->yangcong->auth  = 'Auth ID';

$lang->site->api = new stdclass();
$lang->site->api->common = 'API';
$lang->site->api->key    = 'KEy';
$lang->site->api->ip     = 'IP List';
$lang->site->api->allip  = 'All IP';
$lang->site->api->ipTip  = 'Allow the caller to use these IP, use "," to divide different IP, support IP segment, such as 192.168.1.*';
