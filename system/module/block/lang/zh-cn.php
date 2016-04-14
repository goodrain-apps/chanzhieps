<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The block module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->common          = '区块布局';
$lang->block->id              = '编号';
$lang->block->title           = '名称';
$lang->block->amount          = '数量';
$lang->block->limit           = '总数量';
$lang->block->recPerRow       = '每行数量';
$lang->block->type            = '类型';
$lang->block->htmlcode        = 'html代码';
$lang->block->phpcode         = 'php代码';
$lang->block->content         = '内容';
$lang->block->moreLink        = '更多链接';
$lang->block->page            = '页面';
$lang->block->regionList      = '区域列表';
$lang->block->select          = '请选择区块';
$lang->block->categories      = '分类';
$lang->block->showImage       = '图文';
$lang->block->showCategory    = '显示类目';
$lang->block->showBoard       = '显示版块';
$lang->block->showTime        = '显示时间';
$lang->block->product         = '产品';
$lang->block->slide           = '幻灯片';
$lang->block->titleless       = '无标题';
$lang->block->borderless      = '无边框';
$lang->block->icon            = '图标';
$lang->block->padding         = '内边距';
$lang->block->border          = '边框';
$lang->block->grid            = '宽度';
$lang->block->more            = '更多';
$lang->block->color           = '颜色';
$lang->block->backgroundColor = '背景颜色';
$lang->block->textColor       = '文字颜色';
$lang->block->borderColor     = '边框颜色';
$lang->block->linkColor       = '链接颜色';
$lang->block->iconColor       = '图标颜色';
$lang->block->heading         = '标题栏';
$lang->block->content         = '内容';
$lang->block->background      = '背景';
$lang->block->custom          = '自定义';
$lang->block->preview         = '样式预览';
$lang->block->textExample     = '区块文字样式示例，<a href="###">链接示例</a>';
$lang->block->customStyleTip  = '在这里调整区块的颜色及背景';
$lang->block->style           = '样式';
$lang->block->sort            = '排序';
$lang->block->class           = 'css类名';
$lang->block->subRegion       = '子布局';
$lang->block->currentLayout   = '当前布局：%s';
$lang->block->renameLayout    = '方案重命名';
$lang->block->planName        = '方案名称';
$lang->block->saveLayoutAs    = '复制布局：%s';
$lang->block->defaultPlan     = '默认方案';

$lang->block->layout            = '布局';
$lang->block->logoPosition      = 'Logo';
$lang->block->navPosition       = '导航';
$lang->block->searchbarPosition = '搜索框';
$lang->block->sloganPosition    = '站点口号';

$lang->block->admin        = "区块管理";
$lang->block->pages        = "布局";
$lang->block->add          = "添加";
$lang->block->addChild     = "子区块";
$lang->block->template     = "模板";
$lang->block->create       = '添加区块';
$lang->block->browseBlocks = '区块列表';
$lang->block->browseRegion = '布局设置';
$lang->block->edit         = '编辑区块';
$lang->block->view         = '查看区块';
$lang->block->setPage      = '配置页面';
$lang->block->setregion    = '配置布局';
$lang->block->switchPlan   = '切换布局';
$lang->block->cloneLayout  = '布局另存为';
$lang->block->switchLayout = '切换布局';
$lang->block->removeLayout = '删除布局方案';
$lang->block->planIsUseing = '此方案正在使用，不能删除';

$lang->block->paddingTop    = '上';
$lang->block->paddingBottom = '下';
$lang->block->paddingLeft   = '左';
$lang->block->paddingRight  = '右';

$lang->block->placeholder = new stdclass();
$lang->block->placeholder->moreText               = '区块右上角文字';
$lang->block->placeholder->moreUrl                = '区块右上角链接地址';
$lang->block->placeholder->padding                = '0';
$lang->block->placeholder->customStyleTip         = '样式表支持Less语法，可以用#blockID作为id选择器。';
$lang->block->placeholder->desktopCustomScriptTip = '已包含 jQuery 1.9.0，可以用#blockID作为id选择器。';
$lang->block->placeholder->mobileCustomScriptTip  = '支持基本的jQuery语法，可以用#blockID作为id选择器。';
$lang->block->placeholder->class                  = '多个类名之间用空格隔开';

$lang->block->gridOptions[0]  = '自动';
$lang->block->gridOptions[6]  = '1/2';
$lang->block->gridOptions[4]  = '1/3';
$lang->block->gridOptions[8]  = '2/3';
$lang->block->gridOptions[3]  = '1/4';
$lang->block->gridOptions[9]  = '3/4';
$lang->block->gridOptions[2]  = '1/6';
$lang->block->gridOptions[10] = '5/6';
$lang->block->gridOptions[12] = '100%';

$lang->block->categoryList['custom']  = '自定义';
$lang->block->categoryList['article'] = '文章';
$lang->block->categoryList['product'] = '产品';
$lang->block->categoryList['system']  = '系统';

$lang->block->category = new stdclass();
$lang->block->category->showChildren = '显示子分类';
$lang->block->category->fromCurrent  = '当前类目开始';

$lang->block->category->showChildrenList[1] = '是';
$lang->block->category->showChildrenList[0] = '否';

$lang->block->category->fromCurrentList[1] = '是';
$lang->block->category->fromCurrentList[0] = '否';

$lang->block->category->showCategoryList['abbr'] = '简称';
$lang->block->category->showCategoryList['name'] = '全称';

$lang->block->navTypeList = new stdclass();
$lang->block->navTypeList->desktop_top   = '桌面';
$lang->block->navTypeList->desktop_blog  = '博客';
$lang->block->navTypeList->mobile_top    = '移动版顶部';
$lang->block->navTypeList->mobile_bottom = '移动版底部';
$lang->block->navTypeList->mobile_blog   = '移动版博客';
