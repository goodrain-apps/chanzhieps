<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The site module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->visual->common      = "可視化編輯";
$lang->visual->editLogo    = "編輯標誌";
$lang->visual->editSlogan  = "編輯口號";
$lang->visual->appendBlock = "插入區塊";
$lang->visual->removeBlock = "移除區塊";
$lang->visual->sortBlocks  = "區塊排序";

$lang->visual->info               = "編輯模式";
$lang->visual->preview            = "預覽";
$lang->visual->exit               = "退出";
$lang->visual->exitVisualEdit     = "關閉編輯模式";
$lang->visual->customTheme        = "自定義主題";
$lang->visual->admin              = "後台";
$lang->visual->reload             = '刷新';
$lang->visual->createBlock        = '創建區塊';
$lang->visual->manageBlock        = '區塊管理';
$lang->visual->searchBlock        = '搜索區塊';
$lang->visual->allBlock           = '全部';
$lang->visual->openInNewWindow    = '在新窗口中打開當前編輯頁面';
$lang->visual->editpowerbycontent = "<p>蟬知企業門戶系統是開源免費的，但根據我們的<a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>授權協議</a>，去除蟬知的標識需要購買我們的商業授權。</p><p>蟬知標識並不會影響網站功能，我們建議您保留。</p><hr><div class='text-center'><a class='btn btn-success' href='http://www.chanzhi.org/vip/25_vip-support.html' target='_blank'>瞭解蟬知系統商業服務列表和授權 <i class='icon-arrow-right'></i></a></div>";

$lang->visual->js = new stdclass();
$lang->visual->js->saved             = $lang->saveSuccess;
$lang->visual->js->deleted           = $lang->deleteSuccess;
$lang->visual->js->preview           = '預覽';
$lang->visual->js->exitPreview       = '取消預覽';
$lang->visual->js->removeBlock       = '移除區塊';
$lang->visual->js->invisible         = '不可見';
$lang->visual->js->carousel          = '幻燈片';
$lang->visual->js->operateFail       = '操作失敗！';
$lang->visual->js->addContent        = '添加內容...';
$lang->visual->js->addContentTo      = '添加內容到 【{0}】';
$lang->visual->js->createBlock       = '創建新區塊';
$lang->visual->js->addSubRegion      = '添加佈局區塊';
$lang->visual->js->addBlock          = '添加已有區塊';
$lang->visual->js->subRegion         = '佈局區塊';
$lang->visual->js->subRegionDesc     = '可以包含其他區塊';
$lang->visual->js->alreadyLastSlide  = '已是最後一張';
$lang->visual->js->alreadyFirstSlide = '已是第一張';
$lang->visual->js->slideOrder        = '當前播放順序';
$lang->visual->js->gridWidth         = '柵格寬度';
$lang->visual->js->actions           = array('edit' => '編輯', 'delete' => '刪除', 'move' => '移動', 'add' => '添加');

/* Language for config */
$lang->visual->setting = new stdclass();
$lang->visual->setting->logo                               = array('name' => "Logo/名稱");
$lang->visual->setting->slogan                             = array('name' => "口號");
$lang->visual->setting->powerby                            = array('name' => "蟬知標識", 'actions' => array());
$lang->visual->setting->powerby['actions']['edit']         = array('title' => '移除蟬知標識', 'text' => '移除蟬知標識');
$lang->visual->setting->company                            = array('name' => "公司介紹", 'actions' => array());
$lang->visual->setting->company['actions']['edit']         = array('text' => '編輯公司介紹');
$lang->visual->setting->companyName                        = array('name' => "公司名稱");
$lang->visual->setting->companyDesc                        = array('name' => "公司簡介");
$lang->visual->setting->companyContact                     = array('name' => "聯繫方式");
$lang->visual->setting->links                              = array('name' => "友情連結");
$lang->visual->setting->navbar                             = array('name' => "導航");
$lang->visual->setting->carousel                           = array();
$lang->visual->setting->carousel['groupActions']           = array();
$lang->visual->setting->carousel['groupActions']['add']    = array('text' => '添加一張幻燈片');
$lang->visual->setting->carousel['itemActions']            = array();
$lang->visual->setting->carousel['itemActions']['edit']    = array('text' => '編輯', 'title' => '編輯幻燈片');
$lang->visual->setting->carousel['itemActions']['delete']  = array('text' => '刪除這一張', 'confirm' => '是否刪除此幻燈片？');
$lang->visual->setting->carousel['itemActions']['up']      = array('text' => '播放順序提前為 {0}');
$lang->visual->setting->carousel['itemActions']['down']    = array('text' => '播放順序延後為 {0}');
$lang->visual->setting->block                              = array('name' => "區塊", 'actions' => array());
$lang->visual->setting->block['actions']['delete']         = array('confirm' => '確定從佈局中移除 {title}？', 'success' => '{title} 已被移除。'); 
$lang->visual->setting->block['actions']['layout']         = array('text' => '更改佈局', 'success' => '佈局已保存');
$lang->visual->setting->block['actions']['add']            = array('title' => '添加內容到 【{title}】');
$lang->visual->setting->block['actions']['create']         = array('title' => '創建並添加區塊');
$lang->visual->setting->article                            = array('name' => '文章');
$lang->visual->setting->articles                           = array('name' => '文章列表', 'actions' => array());
$lang->visual->setting->articles['actions']['add']         = array('text' => '發佈新文章');
$lang->visual->setting->page                               = array('name' => '單頁');
$lang->visual->setting->pageList                           = array('name' => '單頁列表', 'actions' => array());
$lang->visual->setting->pageList['actions']['add']         = array('text' => '發佈新單頁');
$lang->visual->setting->blog                               = array('name' => '博客');
$lang->visual->setting->blogList                           = array('name' => '博客列表', 'actions' => array());
$lang->visual->setting->blogList['actions']['add']         = array('text' => '發佈新博客');
$lang->visual->setting->product                            = array('name' => '產品');
$lang->visual->setting->products                           = array('name' => '產品列表', 'actions' => array());
$lang->visual->setting->products['actions']['add']         = array('text' => '發佈新產品');
$lang->visual->setting->books                              = array('name' => '手冊列表', 'actions' => array());
$lang->visual->setting->books['actions']['add']            = array('text' => '添加手冊');
$lang->visual->setting->bookCatalog                        = array('name' => "手冊目錄");
$lang->visual->setting->book                               = array('name' => "手冊");
$lang->visual->setting->boards                             = array('name' => '論壇板塊', 'actions' => array());
$lang->visual->setting->boards['actions']['add']           = array('text' => '板塊管理');
$lang->visual->setting->thread                             = array('name' => '帖子', 'actions' => array());
$lang->visual->setting->thread['actions']['edit']          = array('text' => '轉移');
