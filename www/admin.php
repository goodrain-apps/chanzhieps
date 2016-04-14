<?php
/**
 * The router file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/* Turn off error reporting first. */

/* Start output buffer. */
ob_start();

/* Define the run mode as admin. */
define('RUN_MODE', 'admin');

/* Load the framework.*/
include 'loader.php';

/* Check admin entry. */
checkAdminEntry();

/* Instance the app. */
$app = router::createApp('chanzhi', $systemRoot);
$config = $app->config;

/* Check the reqeust is getconfig or not. Check installed or not. */
if(isset($_GET['mode']) and $_GET['mode'] == 'getconfig') die($app->exportConfig());
if(!isset($config->installed) or !$config->installed) die(header('location: install.php'));

/* Change the request settings. */
$config->frontRequestType = $config->requestType;
$config->requestType = 'GET';
$config->default->module = 'admin'; 
$config->default->method = 'index';

/* Run it. */
$common = $app->loadCommon();
$app->parseRequest();
$common->checkPriv();
$app->loadModule();

/* Flush the buffer. */
echo helper::removeUTF8Bom(ob_get_clean());
