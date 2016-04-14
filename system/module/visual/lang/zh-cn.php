<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The site module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->visual->common      = "可视化编辑";
$lang->visual->editLogo    = "编辑标志";
$lang->visual->editSlogan  = "编辑口号";
$lang->visual->appendBlock = "插入区块";
$lang->visual->removeBlock = "移除区块";
$lang->visual->sortBlocks  = "区块排序";

$lang->visual->info            = "编辑模式";
$lang->visual->preview         = "预览";
$lang->visual->exit            = "退出";
$lang->visual->exitVisualEdit  = "关闭编辑模式";
$lang->visual->customTheme     = "自定义主题";
$lang->visual->admin           = "后台";
$lang->visual->reload          = '刷新';
$lang->visual->createBlock     = '创建区块';
$lang->visual->manageBlock     = '区块管理';
$lang->visual->searchBlock     = '搜索区块';
$lang->visual->allBlock        = '全部';
$lang->visual->openInNewWindow = '在新窗口中打开当前编辑页面';
$lang->visual->editPowerBy     = "<p>您可以在遵守我们<a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>授权协议</a>的前提下免费使用蝉知系统，保留蝉知标志是对宣传蝉知系统非常重要。如果您想去除蝉知的标志，请<a href='http://www.chanzhi.org/license-search.html' target='_blank'>购买蝉知商业授权</a>。</p>";

$lang->visual->js = new stdclass();
$lang->visual->js->saved             = $lang->saveSuccess;
$lang->visual->js->deleted           = $lang->deleteSuccess;
$lang->visual->js->preview           = '预览';
$lang->visual->js->exitPreview       = '取消预览';
$lang->visual->js->removeBlock       = '移除区块';
$lang->visual->js->invisible         = '不可见';
$lang->visual->js->carousel          = '幻灯片';
$lang->visual->js->operateFail       = '操作失败！';
$lang->visual->js->addContent        = '添加内容...';
$lang->visual->js->addContentTo      = '添加内容到 【{0}】';
$lang->visual->js->createBlock       = '创建新区块';
$lang->visual->js->addSubRegion      = '添加布局区块';
$lang->visual->js->addBlock          = '添加已有区块';
$lang->visual->js->subRegion         = '布局区块';
$lang->visual->js->subRegionDesc     = '可以包含其他区块';
$lang->visual->js->alreadyLastSlide  = '已是最后一张';
$lang->visual->js->alreadyFirstSlide = '已是第一张';
$lang->visual->js->slideOrder        = '当前播放顺序';
$lang->visual->js->gridWidth         = '栅格宽度';
$lang->visual->js->actions           = array('edit' => '编辑', 'delete' => '删除', 'move' => '移动', 'add' => '添加');

/* Language for config */
$lang->visual->setting = new stdclass();
$lang->visual->setting->logo                               = array('name' => "Logo/名称");
$lang->visual->setting->slogan                             = array('name' => "口号");
$lang->visual->setting->powerby                            = array('name' => "蝉知标识", 'actions' => array());
$lang->visual->setting->powerby['actions']['edit']         = array('title' => '移除蝉知标识', 'text' => '移除蝉知标识', 'alert' => $lang->visual->editPowerBy);
$lang->visual->setting->company                            = array('name' => "公司介绍", 'actions' => array());
$lang->visual->setting->company['actions']['edit']         = array('text' => '编辑公司介绍');
$lang->visual->setting->companyName                        = array('name' => "公司名称");
$lang->visual->setting->companyDesc                        = array('name' => "公司简介");
$lang->visual->setting->companyContact                     = array('name' => "联系方式");
$lang->visual->setting->links                              = array('name' => "友情链接");
$lang->visual->setting->navbar                             = array('name' => "导航");
$lang->visual->setting->carousel                           = array();
$lang->visual->setting->carousel['groupActions']           = array();
$lang->visual->setting->carousel['groupActions']['add']    = array('text' => '添加一张幻灯片');
$lang->visual->setting->carousel['itemActions']            = array();
$lang->visual->setting->carousel['itemActions']['edit']    = array('text' => '编辑', 'title' => '编辑幻灯片');
$lang->visual->setting->carousel['itemActions']['delete']  = array('text' => '删除这一张', 'confirm' => '是否删除此幻灯片？');
$lang->visual->setting->carousel['itemActions']['up']      = array('text' => '播放顺序提前为 {0}');
$lang->visual->setting->carousel['itemActions']['down']    = array('text' => '播放顺序延后为 {0}');
$lang->visual->setting->block                              = array('name' => "区块", 'actions' => array());
$lang->visual->setting->block['actions']['delete']         = array('confirm' => '确定从布局中移除 {title}？', 'success' => '{title} 已被移除。'); 
$lang->visual->setting->block['actions']['layout']         = array('text' => '更改布局', 'success' => '布局已保存');
$lang->visual->setting->block['actions']['add']            = array('title' => '添加内容到 【{title}】');
$lang->visual->setting->block['actions']['create']         = array('title' => '创建并添加区块');
$lang->visual->setting->article                            = array('name' => '文章');
$lang->visual->setting->articles                           = array('name' => '文章列表', 'actions' => array());
$lang->visual->setting->articles['actions']['add']         = array('text' => '发布新文章');
$lang->visual->setting->page                               = array('name' => '单页');
$lang->visual->setting->pageList                           = array('name' => '单页列表', 'actions' => array());
$lang->visual->setting->pageList['actions']['add']         = array('text' => '发布新单页');
$lang->visual->setting->blog                               = array('name' => '博客');
$lang->visual->setting->blogList                           = array('name' => '博客列表', 'actions' => array());
$lang->visual->setting->blogList['actions']['add']         = array('text' => '发布新博客');
$lang->visual->setting->product                            = array('name' => '产品');
$lang->visual->setting->products                           = array('name' => '产品列表', 'actions' => array());
$lang->visual->setting->products['actions']['add']         = array('text' => '发布新产品');
$lang->visual->setting->books                              = array('name' => '手册列表', 'actions' => array());
$lang->visual->setting->books['actions']['add']            = array('text' => '添加手册');
$lang->visual->setting->bookCatalog                        = array('name' => "手册目录");
$lang->visual->setting->book                               = array('name' => "手册");
$lang->visual->setting->boards                             = array('name' => '论坛板块', 'actions' => array());
$lang->visual->setting->boards['actions']['add']           = array('text' => '板块管理');
$lang->visual->setting->thread                             = array('name' => '帖子', 'actions' => array());
$lang->visual->setting->thread['actions']['edit']          = array('text' => '转移');
