<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The zh-cn language file of install module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->install->common  = '安装';
$lang->install->next    = '下一步';
$lang->install->pre     = '返回';
$lang->install->reload  = '刷新';
$lang->install->error   = '错误 ';

$lang->install->start            = '开始安装';
$lang->install->keepInstalling   = '继续安装当前版本';
$lang->install->welcome          = '您睿智地选择了蝉知企业门户系统!';
$lang->install->license          = '授权协议';
$lang->install->desc             = <<<EOT
<p>使用蝉知，您可以：</p>
<blockquote>
  <ul>
    <li><strong>品牌宣传</strong>：建立品牌网站，展示企业形象。</li>
    <li><strong>营销推广</strong>：SEO, 邮件、短信、微博、微信...</li>
    <li><strong>电子商务</strong>：展示产品，在线销售。</li>
    <li><strong>客户关怀</strong>：售后支持，维系客户。</li>
  </ul>
</blockquote>
EOT;

$lang->install->newVersion = "提示：蝉知系统已于 <span id='releaseDate'></span> 发布 <span id='version'></span>版本。<a href='' target='_blank' id='upgradeLink'>马上下载</a>";

$lang->install->choice     = '您可以选择：';
$lang->install->checking   = '系统检查';
$lang->install->ok         = '通过(√)';
$lang->install->fail       = '失败(×)';
$lang->install->loaded     = '已加载';
$lang->install->unloaded   = '未加载';
$lang->install->exists     = '目录存在 ';
$lang->install->notExists  = '目录不存在 ';
$lang->install->writable   = '目录可写 ';
$lang->install->notWritable= '目录不可写 ';
$lang->install->phpINI     = 'PHP配置文件';
$lang->install->checkItem  = '检查项';
$lang->install->current    = '当前配置';
$lang->install->result     = '检查结果';
$lang->install->action     = '如何修改';

$lang->install->phpVersion = 'PHP版本';
$lang->install->phpFail    = 'PHP版本必须大于5.2.0';

$lang->install->pdo          = 'PDO扩展';
$lang->install->pdoFail      = '修改PHP配置文件，加载PDO扩展。';
$lang->install->pdoMySQL     = 'PDO_MySQL扩展';
$lang->install->pdoMySQLFail = '修改PHP配置文件，加载pdo_mysql扩展。';
$lang->install->tmpRoot      = '临时文件目录';
$lang->install->dataRoot     = '上传文件目录';
$lang->install->mkdir        = '<p>需要创建目录%s。linux下面命令为：<br /> <code>mkdir -p %s</code></p>';
$lang->install->chmod        = '需要修改目录 "%s" 的权限。linux下面命令为：<br /><code>chmod o=rwx -R %s</code>';

$lang->install->settingDB      = '设置数据库';
$lang->install->dbHost         = '数据库服务器';
$lang->install->dbHostNote     = '如果127.0.0.1无法访问，尝试使用localhost';
$lang->install->dbPort         = '服务器端口';
$lang->install->dbUser         = '数据库用户名';
$lang->install->dbPassword     = '数据库密码';
$lang->install->dbName         = '数据库名';
$lang->install->dbPrefix       = '建表使用的前缀';
$lang->install->createDB       = '自动创建数据库';
$lang->install->clearDB        = '清空已有蝉知数据';
$lang->install->importDemoData = '导入demo数据';

$lang->install->errorDBName        = "数据库名不能带'.'";
$lang->install->errorConnectDB     = '数据库连接失败。 ';
$lang->install->errorCreateDB      = '数据库创建失败。';
$lang->install->errorDBExists      = '数据库已经存在，继续安装返回上步并选中“清空数据”选项。';
$lang->install->errorCreateTable   = '创建表失败。';

$lang->install->setConfig  = '数据库配置';
$lang->install->key        = '配置项';
$lang->install->value      = '值';
$lang->install->saveConfig = '保存配置文件';
$lang->install->save2File  = '<span class="red">尝试写入配置文件，失败！</span>拷贝上面文本框中的内容，将其保存到 "<strong> %s </strong>"中。';
$lang->install->saved2File = '配置信息已经成功保存到" <strong>%s</strong> "中。您后面还可继续修改此文件。';
$lang->install->errorNotSaveConfig = '还没有保存配置文件';

$lang->install->setAdmin = '设置管理员';
$lang->install->account  = '帐号';
$lang->install->password = '密码';
$lang->install->errorEmptyPassword = '密码不能为空';

$lang->install->success    = "安装成功！";
$lang->install->visitAdmin = '登录后台';
