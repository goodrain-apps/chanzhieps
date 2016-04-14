<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The upgrade module zh-cn file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $$
 * @link        http://www.chanzhi.org
 */
$lang->upgrade->common  = '升级';

$lang->upgrade->result  = '升级结果';
$lang->upgrade->fail    = '升级失败';
$lang->upgrade->success = '升级成功';
$lang->upgrade->tohome  = '返回首页';

$lang->upgrade->backup        = '备份数据';
$lang->upgrade->prepair       = '准备升级';
$lang->upgrade->selectVersion = '确认升级之前的版本';
$lang->upgrade->confirm       = '确认要执行的SQL语句';
$lang->upgrade->execute       = '确认执行';
$lang->upgrade->next          = '下一步';
$lang->upgrade->updateLicense = '蝉知 4.0 已更换授权协议至 Z PUBLIC LICENSE(ZPL) 1.2。';

$lang->upgrade->backupData = <<<EOT
<pre>
<strong>使用phpMyAdmin或者mysqldump命令备份数据库。</strong>
<textarea class='autoSelect w-500px red' readonly rows='1' > mysqldump -u %s -p%s %s > chanzhi.sql </textarea>
</pre>
EOT;

$lang->upgrade->createSlidePath = <<<EOT
<div class='alert'> 请创建幻灯片目录：<b>%s</b> 并开启该目录写权限后继续。 </div>
EOT;

$lang->upgrade->chmodThemePath = <<<EOT
<div class='alert'> 请开启<b>%s</b> 目录写权限后继续。 </div>
EOT;

$lang->upgrade->versionNote = "务必选择正确的版本，否则会造成数据丢失。";

$lang->upgrade->fromVersions['1_1']      = '1.1.stable';
$lang->upgrade->fromVersions['1_2']      = '1.2.stable';
$lang->upgrade->fromVersions['1_3']      = '1.3.stable';
$lang->upgrade->fromVersions['1_4']      = '1.4.stable';
$lang->upgrade->fromVersions['1_5']      = '1.5.stable';
$lang->upgrade->fromVersions['1_6']      = '1.6.stable';
$lang->upgrade->fromVersions['1_7']      = '1.7.stable';
$lang->upgrade->fromVersions['1_8']      = '1.8.stable';
$lang->upgrade->fromVersions['2_0']      = '2.0.stable';
$lang->upgrade->fromVersions['2_0_1']    = '2.0.1.stable';
$lang->upgrade->fromVersions['2_1']      = '2.1.stable';
$lang->upgrade->fromVersions['2_2']      = '2.2.stable';
$lang->upgrade->fromVersions['2_2_1']    = '2.2.1.stable';
$lang->upgrade->fromVersions['2_3']      = '2.3.stable';
$lang->upgrade->fromVersions['2_4']      = '2.4.stable';
$lang->upgrade->fromVersions['2_5_beta'] = '2.5.beta';
$lang->upgrade->fromVersions['2_5_1']    = '2.5.1';
$lang->upgrade->fromVersions['2_5_2']    = '2.5.2';
$lang->upgrade->fromVersions['2_5_3']    = '2.5.3';
$lang->upgrade->fromVersions['3_0']      = '3.0';
$lang->upgrade->fromVersions['3_0_1']    = '3.0.1';
$lang->upgrade->fromVersions['3_1']      = '3.1';
$lang->upgrade->fromVersions['3_2']      = '3.2';
$lang->upgrade->fromVersions['3_3']      = '3.3';
$lang->upgrade->fromVersions['4_0']      = '4.0';
$lang->upgrade->fromVersions['4_1_beta'] = '4.1.beta';
$lang->upgrade->fromVersions['4_2']      = '4.2';
$lang->upgrade->fromVersions['4_2_1']    = '4.2.1';
$lang->upgrade->fromVersions['4_3_beta'] = '4.3.beta';
$lang->upgrade->fromVersions['4_4']      = '4.4';
$lang->upgrade->fromVersions['4_4_1']    = '4.4.1';
$lang->upgrade->fromVersions['4_5']      = '4.5';
$lang->upgrade->fromVersions['4_5_1']    = '4.5.1';
$lang->upgrade->fromVersions['4_5_2']    = '4.5.2';
$lang->upgrade->fromVersions['4_6']      = '4.6';
$lang->upgrade->fromVersions['5_0']      = '5.0';
$lang->upgrade->fromVersions['5_0_1']    = '5.0.1';
$lang->upgrade->fromVersions['5_1']      = '5.1';
