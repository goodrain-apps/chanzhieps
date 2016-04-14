<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The wechat module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->wechat->common = '微信';

$lang->wechat->id        = '編號';
$lang->wechat->type      = '類型';
$lang->wechat->name      = '微信名';
$lang->wechat->account   = '原始ID';
$lang->wechat->appID     = 'AppID';
$lang->wechat->appSecret = 'AppSecret';
$lang->wechat->token     = 'Token';
$lang->wechat->url       = '接入地址';
$lang->wechat->certified = '是否認證';
$lang->wechat->users     = '微信會員';
$lang->wechat->content   = '內容';
$lang->wechat->qrcode    = '二維碼';

$lang->wechat->create         = '添加公眾號';
$lang->wechat->edit           = '編輯公眾號';
$lang->wechat->admin          = '維護公眾號';
$lang->wechat->list           = '公眾號列表';
$lang->wechat->set            = '微信設置';
$lang->wechat->setMenu        = '菜單';
$lang->wechat->integrate      = '接入';
$lang->wechat->adminResponse  = '響應';
$lang->wechat->setResponse    = '設置響應';
$lang->wechat->deleteResponse = '刪除響應';
$lang->wechat->reply          = '回覆';
$lang->wechat->commitMenu     = '菜單';
$lang->wechat->deleteMenu     = '刪除菜單';
$lang->wechat->messageList    = '消息';

$lang->wechat->typeList['subscribe'] = '訂閲號';
$lang->wechat->typeList['service']   = '服務號';

$lang->wechat->certifiedList[1] = '是';
$lang->wechat->certifiedList[0] = '否';

$lang->wechat->response = new stdclass();

$lang->wechat->response->keywords  = '關鍵字';
$lang->wechat->response->set       = '響應設置';
$lang->wechat->response->create    = '添加關鍵字';
$lang->wechat->response->default   = '預設響應';
$lang->wechat->response->subscribe = '訂閲響應';

$lang->wechat->response->type     = '類型';
$lang->wechat->response->source   = '來源';
$lang->wechat->response->module   = '模組';
$lang->wechat->response->block    = '內容';
$lang->wechat->response->link     = '連結';
$lang->wechat->response->category = '類目';
$lang->wechat->response->limit    = '數量';

$lang->wechat->response->list   = '響應列表';

$lang->wechat->response->typeList['link'] = '連結';
$lang->wechat->response->typeList['text'] = '文本消息';
$lang->wechat->response->typeList['news'] = '圖文消息';

$lang->wechat->response->sourceList['system'] = '系統';
$lang->wechat->response->sourceList['manual'] = '輸入';

$lang->wechat->response->moduleList['index']   = '首頁';
$lang->wechat->response->moduleList['company'] = '關於我們';
$lang->wechat->response->moduleList['blog']    = '博客';
$lang->wechat->response->moduleList['forum']   = '論壇';
$lang->wechat->response->moduleList['book']    = '手冊';
$lang->wechat->response->moduleList['manual']  = '自定義';

$lang->wechat->response->textBlockList['company'] = '公司簡介';
$lang->wechat->response->textBlockList['contact'] = '聯繫我們';
$lang->wechat->response->textBlockList['manual']  = '自定義';

$lang->wechat->response->newsBlockList['articleTree']   = '文章分類';
$lang->wechat->response->newsBlockList['latestArticle'] = '最新文章';
$lang->wechat->response->newsBlockList['hotArticle']    = '熱門文章';
$lang->wechat->response->newsBlockList['productTree']   = '產品分類';
$lang->wechat->response->newsBlockList['latestProduct'] = '最新產品';
$lang->wechat->response->newsBlockList['hotProduct']    = '熱門產品';

$lang->wechat->message = new stdclass();
$lang->wechat->message->from     = '稱呼';
$lang->wechat->message->type     = '類型';
$lang->wechat->message->status   = '狀態';
$lang->wechat->message->content  = '消息內容';
$lang->wechat->message->response = '響應';
$lang->wechat->message->menu     = '菜單';
$lang->wechat->message->time     = '時間';
$lang->wechat->message->reply    = '回覆';
$lang->wechat->message->record   = '消息記錄';
$lang->wechat->message->list     = '消息列表';

$lang->wechat->message->typeList['text']        = '文本';
$lang->wechat->message->typeList['image']       = '圖片';
$lang->wechat->message->typeList['voice']       = '語音';
$lang->wechat->message->typeList['location']    = '位置';
$lang->wechat->message->typeList['link']        = '連結';
$lang->wechat->message->typeList['subscribe']   = '訂閲';
$lang->wechat->message->typeList['unsubscribe'] = '取消訂閲';
$lang->wechat->message->typeList['scan']        = '掃瞄';
$lang->wechat->message->typeList['click']       = '點擊';
$lang->wechat->message->typeList['view']        = '連結';

$lang->wechat->message->tabList[] = 'mode=replied&replied=0|未回覆';
$lang->wechat->message->tabList[] = 'mode=type&type=text|留言';
$lang->wechat->message->tabList[] = 'mode=type&type=subscribe|新訂閲';
$lang->wechat->message->tabList[] = 'mode=type&type=unsubscribe|取消訂閲';
$lang->wechat->message->tabList[] = 'mode=replied&replied=1|已回覆';

$lang->wechat->noSelectedFile  = "沒有選擇圖片";
$lang->wechat->noAppID         = "沒有設置AppID";
$lang->wechat->qrcodeType      = "請上傳JPG格式二維碼圖片";

$lang->wechat->placeholder = new stdclass();
$lang->wechat->placeholder->limit    = '請輸條數，最多10條';
$lang->wechat->placeholder->category = '請選擇類目，最多10個';
$lang->wechat->placeholder->name     = '公眾號名稱';
$lang->wechat->placeholder->account  = '請輸入gh_xxx 格式的原始ID';
$lang->wechat->placeholder->token    = '必須為英文或數字，長度為3-32字元';

$lang->wechat->curlSSLRequired = "微信公眾號功能需要curl模組，並支持ssl加密傳輸。";
$lang->wechat->needCertified   = "此功能需要公眾號認證後使用。";
$lang->wechat->integrateInfo   = "請到微信的公眾平台完成接入，以獲取appID和appSecret信息。 <a href='http://api.chanzhi.org/goto.php?item=help_wechat' target='_blank'>幫助</a>";
$lang->wechat->integrateDone   = "已完成接入";
