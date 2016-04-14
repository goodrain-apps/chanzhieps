<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The wechat module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->wechat->common = '微信';

$lang->wechat->id        = '编号';
$lang->wechat->type      = '类型';
$lang->wechat->name      = '微信名';
$lang->wechat->account   = '原始ID';
$lang->wechat->appID     = 'AppID';
$lang->wechat->appSecret = 'AppSecret';
$lang->wechat->token     = 'Token';
$lang->wechat->url       = '接入地址';
$lang->wechat->certified = '是否认证';
$lang->wechat->users     = '微信会员';
$lang->wechat->content   = '内容';
$lang->wechat->qrcode    = '二维码';

$lang->wechat->create         = '添加公众号';
$lang->wechat->edit           = '编辑公众号';
$lang->wechat->admin          = '维护公众号';
$lang->wechat->list           = '公众号列表';
$lang->wechat->set            = '微信设置';
$lang->wechat->setMenu        = '菜单';
$lang->wechat->integrate      = '接入';
$lang->wechat->adminResponse  = '响应';
$lang->wechat->setResponse    = '设置响应';
$lang->wechat->deleteResponse = '删除响应';
$lang->wechat->reply          = '回复';
$lang->wechat->commitMenu     = '菜单';
$lang->wechat->deleteMenu     = '删除菜单';
$lang->wechat->messageList    = '消息';

$lang->wechat->typeList['subscribe'] = '订阅号';
$lang->wechat->typeList['service']   = '服务号';

$lang->wechat->certifiedList[1] = '是';
$lang->wechat->certifiedList[0] = '否';

$lang->wechat->response = new stdclass();

$lang->wechat->response->keywords  = '关键字';
$lang->wechat->response->set       = '响应设置';
$lang->wechat->response->create    = '添加关键字';
$lang->wechat->response->default   = '默认响应';
$lang->wechat->response->subscribe = '订阅响应';

$lang->wechat->response->type     = '类型';
$lang->wechat->response->source   = '来源';
$lang->wechat->response->module   = '模块';
$lang->wechat->response->block    = '内容';
$lang->wechat->response->link     = '链接';
$lang->wechat->response->category = '类目';
$lang->wechat->response->limit    = '数量';

$lang->wechat->response->list   = '响应列表';

$lang->wechat->response->typeList['link'] = '链接';
$lang->wechat->response->typeList['text'] = '文本消息';
$lang->wechat->response->typeList['news'] = '图文消息';

$lang->wechat->response->sourceList['system'] = '系统';
$lang->wechat->response->sourceList['manual'] = '输入';

$lang->wechat->response->moduleList['index']   = '首页';
$lang->wechat->response->moduleList['company'] = '关于我们';
$lang->wechat->response->moduleList['blog']    = '博客';
$lang->wechat->response->moduleList['forum']   = '论坛';
$lang->wechat->response->moduleList['book']    = '手册';
$lang->wechat->response->moduleList['manual']  = '自定义';

$lang->wechat->response->textBlockList['company'] = '公司简介';
$lang->wechat->response->textBlockList['contact'] = '联系我们';
$lang->wechat->response->textBlockList['manual']  = '自定义';

$lang->wechat->response->newsBlockList['articleTree']   = '文章分类';
$lang->wechat->response->newsBlockList['latestArticle'] = '最新文章';
$lang->wechat->response->newsBlockList['hotArticle']    = '热门文章';
$lang->wechat->response->newsBlockList['productTree']   = '产品分类';
$lang->wechat->response->newsBlockList['latestProduct'] = '最新产品';
$lang->wechat->response->newsBlockList['hotProduct']    = '热门产品';

$lang->wechat->message = new stdclass();
$lang->wechat->message->from     = '称呼';
$lang->wechat->message->type     = '类型';
$lang->wechat->message->status   = '状态';
$lang->wechat->message->content  = '消息内容';
$lang->wechat->message->response = '响应';
$lang->wechat->message->menu     = '菜单';
$lang->wechat->message->time     = '时间';
$lang->wechat->message->reply    = '回复';
$lang->wechat->message->record   = '消息记录';
$lang->wechat->message->list     = '消息列表';

$lang->wechat->message->typeList['text']        = '文本';
$lang->wechat->message->typeList['image']       = '图片';
$lang->wechat->message->typeList['voice']       = '语音';
$lang->wechat->message->typeList['location']    = '位置';
$lang->wechat->message->typeList['link']        = '链接';
$lang->wechat->message->typeList['subscribe']   = '订阅';
$lang->wechat->message->typeList['unsubscribe'] = '取消订阅';
$lang->wechat->message->typeList['scan']        = '扫描';
$lang->wechat->message->typeList['click']       = '点击';
$lang->wechat->message->typeList['view']        = '链接';

$lang->wechat->message->tabList[] = 'mode=replied&replied=0|未回复';
$lang->wechat->message->tabList[] = 'mode=type&type=text|留言';
$lang->wechat->message->tabList[] = 'mode=type&type=subscribe|新订阅';
$lang->wechat->message->tabList[] = 'mode=type&type=unsubscribe|取消订阅';
$lang->wechat->message->tabList[] = 'mode=replied&replied=1|已回复';

$lang->wechat->noSelectedFile  = "没有选择图片";
$lang->wechat->noAppID         = "没有设置AppID";
$lang->wechat->qrcodeType      = "请上传JPG格式二维码图片";

$lang->wechat->placeholder = new stdclass();
$lang->wechat->placeholder->limit    = '请输条数，最多10条';
$lang->wechat->placeholder->category = '请选择类目，最多10个';
$lang->wechat->placeholder->name     = '公众号名称';
$lang->wechat->placeholder->account  = '请输入gh_xxx 格式的原始ID';
$lang->wechat->placeholder->token    = '必须为英文或数字，长度为3-32字符';

$lang->wechat->curlSSLRequired = "微信公众号功能需要curl模块，并支持ssl加密传输。";
$lang->wechat->needCertified   = "此功能需要公众号认证后使用。";
$lang->wechat->integrateInfo   = "请到微信的公众平台完成接入，以获取appID和appSecret信息。 <a href='http://api.chanzhi.org/goto.php?item=help_wechat' target='_blank'>帮助</a>";
$lang->wechat->integrateDone   = "已完成接入";
