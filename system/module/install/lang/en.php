<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The install module English file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->install->common  = 'Install';
$lang->install->next    = 'Next';
$lang->install->pre     = 'Back';
$lang->install->reload  = 'Reload';
$lang->install->error   = 'Error ';

$lang->install->start            = 'Start install';
$lang->install->keepInstalling   = 'Keep install this version';
$lang->install->welcome          = 'Welcome to use chanzhiEPS.';
$lang->install->license          = 'License';
$lang->install->desc             = <<<EOT
<p>Using chanzhiEPS, you can do</p>
<blockquote>
  <ul>
    <li><strong>Branding</strong>：Build a professional website to advertise your brand.</li>
    <li><strong>Marketing</strong>：Many ways to promot product and service.</li>
    <li><strong>E-commerce</strong>：Show products and get order online.</li>
    <li><strong>Service</strong>：Support service to customers online.</li>
  </ul>
</blockquote>
EOT;

$lang->install->newVersion = "Notice: ChanzhiEPS has been upgraded to version: <span id='version'></span> at <span id='releaseDate'></span>. <a href='' target='_blank' id='upgradeLink'>DownLoad Now</a>";

$lang->install->choice     = 'You can ';
$lang->install->checking   = 'System checking';
$lang->install->ok         = 'OK(√)';
$lang->install->fail       = 'Failed(×)';
$lang->install->loaded     = 'Loaded';
$lang->install->unloaded   = 'Not loaded';
$lang->install->exists     = 'Exists ';
$lang->install->notExists  = 'Not exists ';
$lang->install->writable   = 'Writable ';
$lang->install->notWritable= 'Not writable ';
$lang->install->phpINI     = 'PHP ini file';
$lang->install->checkItem  = 'Items';
$lang->install->current    = 'Current';
$lang->install->result     = 'Result';
$lang->install->action     = 'How to fix';

$lang->install->phpVersion = 'PHP version';
$lang->install->phpFail    = 'Must > 5.2.0';

$lang->install->pdo          = 'PDO extension';
$lang->install->pdoFail      = 'Edit the php.ini file to load PDO extsion.';
$lang->install->pdoMySQL     = 'PDO_MySQL extension';
$lang->install->pdoMySQLFail = 'Edit the php.ini file to load PDO_MySQL extsion.';
$lang->install->tmpRoot      = 'Temp directory';
$lang->install->dataRoot     = 'Upload directory.';
$lang->install->mkdir        = '<p>Should creat the directory %s。<br /> Under linux, can try<br /> mkdir -p %s</p>';
$lang->install->chmod        = 'Should change the permission of "%s".<br />Under linux, can try<br />chmod o=rwx -R %s';

$lang->install->settingDB      = 'Set database';
$lang->install->dbHost         = 'Database host';
$lang->install->dbHostNote     = 'If localhost can connect, try 127.0.0.1';
$lang->install->dbPort         = 'Host port';
$lang->install->dbUser         = 'Database user';
$lang->install->dbPassword     = 'Database password';
$lang->install->dbName         = 'Database name';
$lang->install->dbPrefix       = 'Table prefix';
$lang->install->createDB       = 'Auto create database';
$lang->install->clearDB        = 'Clear chanzhi tables if already exists.';
$lang->install->importDemoData = 'Import demo data';

$lang->install->errorDBName        = "'.' are not allowed in database name";
$lang->install->errorConnectDB     = 'Database connect failed.';
$lang->install->errorCreateDB      = 'Database create failed.';
$lang->install->errorDBExists      = 'Database alread exists, to continue install, check the clear db box.';
$lang->install->errorCreateTable   = 'Table create failed.';

$lang->install->setConfig  = 'Create config file';
$lang->install->key        = 'Item';
$lang->install->value      = 'Value';
$lang->install->saveConfig = 'Save config';
$lang->install->save2File  = '<div class="a-center"><span class="fail">Failed to save the config file automaticly.</span></div>Copy the text of the textareaand save to "<strong> %s </strong>".';
$lang->install->saved2File = 'The config file has saved to "<strong>%s</strong> ".';
$lang->install->errorNotSaveConfig = 'Config file was not saved.';

$lang->install->setAdmin = 'Create an Administrator';
$lang->install->account  = 'Account';
$lang->install->password = 'Password';
$lang->install->errorEmptyPassword = "Can't be empty";

$lang->install->success    = "Success installed";
$lang->install->visitAdmin = 'Go Administrator Dashboard';
