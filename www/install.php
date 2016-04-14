<?php
/**
 * The install router file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/* Turn off error reporting first. */
error_reporting(0);

/* Start session. */
session_start();

/* Define the run mode as install. */
define('RUN_MODE', 'install');

/* Load the framework. */
include 'loader.php';

/* Instance the app and run it. */
$app = router::createApp('chanzhi', $systemRoot);
$config = $app->config;

/* Check installed or not. */
if(!isset($_SESSION['installing']) and !empty($config->installed)) die(header('location: index.php'));

/* Reset the config params. */
$config->set('requestType', 'GET');
$config->set('debug', true);
$config->set('default.module', 'install');
$app->setDebug();

/* If setted db parms, connect it. */
if(!empty($config->installed)) $dbh = $app->connectDB();

/* Run the app. */
$app->parseRequest();
$app->loadModule();
