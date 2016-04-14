<?php
/**
 * The upgrade router file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/* Turn off error reporting. */
error_reporting(0);

/* Set run mode. */
define('RUN_MODE', 'upgrade');
define('LANG_CREATED', false);

/* Load the framework. */
include 'loader.php';

/* Instance the app and run it. */
$app = router::createApp('chanzhi', $systemRoot);
$config = $app->config;

/* Judge my.php exists or not. */
$myConfig = $systemRoot . 'config/my.php';
if(!file_exists($myConfig))
{
    echo "文件" . $myConfig . "不存在！ 提示：不要重命名原来的蝉知安装目录，下载最新的源码包，覆盖即可。" . "<br />";
    echo $myConfig . " doesn't exists! Please don't rename xirang directory, get source code and just override it!";
    exit;
}

/* Reset the config params to make sure the install program will be lauched. */
$config->frontRequestType = $config->requestType;
$config->set('requestType', 'GET');
$config->set('default.module', 'upgrade');
$common = $app->loadCommon();
$app->setDebug();

/* Check the installed version is the latest or not. */
$config->installedVersion = $common->loadModel('setting')->getVersion();
if(version_compare($config->version, $config->installedVersion) <= 0) die(header('location: index.php'));

/* Run it. */
$app->parseRequest();
$app->loadModule();
