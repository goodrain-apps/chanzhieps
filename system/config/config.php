<?php
/**
 * The config file of chanzhiEPS
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/* Judge class config and function getWebRoot exists or not, make sure php shells can work. */
if(!class_exists('config')){class config{}}
if(!function_exists('getWebRoot')){function getWebRoot(){}}

/* The basic settings. */
$config = new config();
$config->version     = '5.2';           // The version number, don't change.
$config->encoding    = 'UTF-8';           // The encoding.
$config->cookiePath  = '/';               // The path of cookies.
$config->webRoot     = getWebRoot();      // The web root.
$config->cookieLife  = time() + 2592000;  // The lifetime of cookies.
$config->timezone    = 'Asia/Shanghai';   // Time zone setting, more plese visit http://www.php.net/manual/en/timezones.php
$config->multi       = false;             // The config of multi site.

/* The request settins. */
$config->requestType = 'PATH_INFO';       // PATH_INFO or GET.
$config->seoMode     = true;              // Whether turn on seo mode or not.
$config->requestFix  = '-';               // RequestType=PATH_INFO: the divider of the params, can be - _ or /
$config->moduleVar   = 'm';               // RequestType=GET: the name of the module var.
$config->methodVar   = 'f';               // RequestType=GET: the name of the method var.
$config->viewVar     = 't';               // RequestType=GET: the name of the view var.
$config->langVar     = 'l';               // RequestType=GET: the name of the view var.
$config->sessionVar  = RUN_MODE . 'sid';  // The session var name.

/* Set the allowed tags.  */
$config->allowedTags = new stdclass();
$config->allowedTags->front = '<p><span><h1><h2><h3><h4><h5><em><u><strong><br><ol><ul><li><img><a><b><font><hr><pre><embed>';           // For front mode.
$config->allowedTags->admin = $config->allowedTags->front . '<dd><dt><dl><div><table><td><th><tr><tbody><iframe><style><header><nav><meta>'; // For admin users.

/* Views and themes. */
$config->views  = ',html,mhtml,json,xml,'; // Supported view types.

$config->site = new stdclass();
$config->site->resetPassword     = 'open'; 
$config->site->importantValidate = 'okFile,email';
$config->site->modules           = 'article,product';
$config->site->type              = 'portal';
$config->site->filterFunction    = 'close';

$config->template = new stdclass();
$config->template->desktop = new stdclass();
$config->template->desktop->name  = 'default';   // Supported themes.
$config->template->desktop->theme = 'default';   // Supported themes.
$config->template->parser         = 'default';   // Default parser.
$config->template->customVersion  = '';
$config->template->mobile = new stdclass();
$config->template->mobile->name  = 'mobile';   // Supported themes.
$config->template->mobile->theme = 'default';   // Supported themes.

$config->layout = new stdclass();
$config->layout->default_default = 0;
$config->layout->default_tartan  = 0;
$config->layout->default_wide    = 0;
$config->layout->default_clean   = 0;
$config->layout->default_blank   = 0;
$config->layout->mobile_default  = 0;
$config->layout->mobile_colorful = 0;

$config->cdn = new stdclass();
$config->cdn->open = 'close';
$config->cdn->host = 'http://cdn.chanzhi.org/';

$config->css = new stdclass();
$config->js  = new stdclass();

/* Suported languags. */
$config->langs['zh-cn'] = '简体';
$config->langs['zh-tw'] = '繁体';
$config->langs['en']    = 'English';

/* Suported languags label. */
$config->langAbbrLabels['zh-cn'] = '简';
$config->langAbbrLabels['zh-tw'] = '繁';
$config->langAbbrLabels['en']    = 'En';

/* Languags shortcuts. */
$config->langsShortcuts['zh-cn'] = 'cn';
$config->langsShortcuts['zh-tw'] = 'tw';
$config->langsShortcuts['en']    = 'en';

/* Default params. */
$config->default = new stdclass();          
$config->default->view   = 'html';             // Default view.
$config->default->lang   = 'zh-cn';            // Default language.
$config->default->theme  = 'default';          // Default theme.
$config->default->module = 'index';            // Default module.
$config->default->method = 'index';            // Default metho.d

/* Upload settings. */
$config->file = new stdclass();          
$config->file->dangers = 'php,php3,php4,phtml,php5,jsp,py,rb,asp,aspx,ashx,asa,cer,cdx,aspl,shtm,shtml,html,htm'; // Dangerous file types.
$config->file->allowed = ',txt,doc,docx,dot,wps,wri,pdf,ppt,xls,xlsx,ett,xlt,xlsm,csv,jpg,jpeg,png,psd,gif,ico,bmp,swf,avi,rmvb,rm,mp3,mp4,3gp,flv,mov,movie,rar,zip,bz,bz2,tar,gz,'; // Allowed file types.
$config->file->maxSize = 2 * 1024 * 1024;  // Max size allowed(Byte).

/*Thanks list*/
$config->thanksList['IPIP.NET']            = 'http://www.ipip.net/';
$config->thanksList['Lessphp v0.4.0']      = 'http://leafo.net/lessphp/';
$config->thanksList['MobileDetect 2.8.15'] = 'http://mobiledetect.net/';
$config->thanksList['PhpConcept 2.8.2']    = 'http://www.phpconcept.net/';
$config->thanksList['PHPMailer 5.1']       = 'http://phpmailer.worxware.com/';
$config->thanksList['PhpThumb 3.0']        = 'http://phpthumb.sourceforge.net/';
$config->thanksList['HTML Purifier 4.6.0'] = 'http://htmlpurifier.org/';
$config->thanksList['PHP QRCode 1.1.4']    = 'http://phpqrcode.sourceforge.net/';
$config->thanksList['Snoopy 1.2.4']        = 'http://snoopy.sourceforge.net/';
$config->thanksList['Spyc 0.5']            = 'http://code.google.com/p/spyc/';

/* Module dependence setting. */
$config->dependence = new stdclass();
$config->dependence->article[]      = 'article';
$config->dependence->blog[]         = 'blog';
$config->dependence->page[]         = 'page';
$config->dependence->product[]      = 'product';
$config->dependence->book[]         = 'book';
$config->dependence->user[]         = 'user';
$config->dependence->forum[]        = 'forum';
$config->dependence->forum[]        = 'user';
$config->dependence->reply[]        = 'forum';
$config->dependence->reply[]        = 'user';
$config->dependence->message[]      = 'message';
$config->dependence->message[]      = 'user';
$config->dependence->shop[]         = 'shop';
$config->dependence->shop[]         = 'user';
$config->dependence->cart[]         = 'shop';
$config->dependence->address[]      = 'shop';
$config->dependence->express[]      = 'shop';
$config->dependence->order[]        = 'user';
$config->dependence->search[]       = 'search';
$config->dependence->score[]        = 'score';
$config->dependence->score[]        = 'user';
$config->dependence->stat[]         = 'stat';
$config->dependence->log[]          = 'stat';
$config->dependence->submittion[]   = 'submittion';
$config->dependence->submittion[]   = 'user';
$config->dependence->orderSetting[] = 'product';

/* Database settings. */
$config->db = new stdclass();          
$config->db->persistant = false;               // Persistant connection or not.
$config->db->driver     = 'mysql';             // The driver of pdo, only mysql yet.
$config->db->encoding   = 'UTF8';              // The encoding of the database.
$config->db->strictMode = false;               // Turn off the strict mode.
$config->db->prefix     = 'eps_';              // The prefix of the table name.

/* Include my.php, domain.php and front or admin.php. */
$configRoot      = dirname(__FILE__) . DS;
$guarderConfig   = $configRoot . 'guarder.php';
$myConfig        = $configRoot . 'my.php';
$routeConfig     = $configRoot . 'route.php';
$domainConfig    = $configRoot . 'domain.php';
$modeConfig      = $configRoot . RUN_MODE . '.php';
$shopConfig      = $configRoot . 'shop.php';
$sensitiveConfig = $configRoot . 'sensitive.php';

if(file_exists($guarderConfig))   include $guarderConfig;
if(file_exists($myConfig))        include $myConfig;
if(file_exists($routeConfig))     include $routeConfig;
if(file_exists($domainConfig))    include $domainConfig;
if(file_exists($modeConfig))      include $modeConfig;
if(file_exists($shopConfig))      include $shopConfig;
if(file_exists($sensitiveConfig)) include $sensitiveConfig;
if(RUN_MODE == 'admin')           include $configRoot . 'menu.php';

/* The tables. */
define('TABLE_CONFIG',         $config->db->prefix . 'config');
define('TABLE_CATEGORY',       $config->db->prefix . 'category');
define('TABLE_PACKAGE',        $config->db->prefix . 'package');
define('TABLE_RELATION',       $config->db->prefix . 'relation');
define('TABLE_PRODUCT',        $config->db->prefix . 'product');
define('TABLE_PRODUCT_CUSTOM', $config->db->prefix . 'product_custom');
define('TABLE_ARTICLE',        $config->db->prefix . 'article');
define('TABLE_BLOCK',          $config->db->prefix . 'block');
define('TABLE_TAG',            $config->db->prefix . 'tag');
define('TABLE_BOOK',           $config->db->prefix . 'book');
define('TABLE_LAYOUT',         $config->db->prefix . 'layout');
define('TABLE_COMMENT',        $config->db->prefix . 'comment');
define('TABLE_THREAD',         $config->db->prefix . 'thread');
define('TABLE_REPLY',          $config->db->prefix . 'reply');
define('TABLE_USER',           $config->db->prefix . 'user');
define('TABLE_OAUTH',          $config->db->prefix . 'oauth');
define('TABLE_GROUP',          $config->db->prefix . 'group');
define('TABLE_GROUPPRIV',      $config->db->prefix . 'grouppriv');
define('TABLE_USERGROUP',      $config->db->prefix . 'usergroup');
define('TABLE_FILE',           $config->db->prefix . 'file');
define('TABLE_DOWN',           $config->db->prefix . 'down');
define('TABLE_LOG',            $config->db->prefix . 'log');
define('TABLE_MESSAGE',        $config->db->prefix . 'message');
define('TABLE_WX_PUBLIC',      $config->db->prefix . 'wx_public');
define('TABLE_WX_MESSAGE',     $config->db->prefix . 'wx_message');
define('TABLE_WX_RESPONSE',    $config->db->prefix . 'wx_response');
define('TABLE_SEARCH_INDEX',   $config->db->prefix . 'search_index');
define('TABLE_SEARCH_DICT',    $config->db->prefix . 'search_dict');
define('TABLE_CART',           $config->db->prefix . 'cart');
define('TABLE_ORDER',          $config->db->prefix . 'order');
define('TABLE_ORDER_PRODUCT',  $config->db->prefix . 'order_product');
define('TABLE_ADDRESS',        $config->db->prefix . 'address');
define('TABLE_SLIDE',          $config->db->prefix . 'slide');
define('TABLE_STATLOG',        $config->db->prefix . 'statlog');
define('TABLE_STATVISITOR',    $config->db->prefix . 'statvisitor');
define('TABLE_STATREFERER',    $config->db->prefix . 'statreferer');
define('TABLE_STATREPORT',     $config->db->prefix . 'statreport');
define('TABLE_STATREGION',     $config->db->prefix . 'statregion');
define('TABLE_SCORE',          $config->db->prefix . 'score');
define('TABLE_BLACKLIST',      $config->db->prefix . 'blacklist');
define('TABLE_OPERATIONLOG',   $config->db->prefix . 'operationlog');

/* Include extension config files. */
$extConfigFiles = glob($configRoot . 'ext' . DS . '*.php');
if($extConfigFiles) foreach($extConfigFiles as $extConfigFile) include $extConfigFile;

/* Include the cache file. */
$cacheConfigFile = dirname($configRoot) . DS . 'tmp' . DS . 'cache' . DS . 'config.php';
if(file_exists($cacheConfigFile)) include $cacheConfigFile;
