<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The block module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->common          = '區塊佈局';
$lang->block->id              = '編號';
$lang->block->title           = '名稱';
$lang->block->amount          = '數量';
$lang->block->limit           = '總數量';
$lang->block->recPerRow       = '每行數量';
$lang->block->type            = '類型';
$lang->block->htmlcode        = 'html代碼';
$lang->block->phpcode         = 'php代碼';
$lang->block->content         = '內容';
$lang->block->moreLink        = '更多連結';
$lang->block->page            = '頁面';
$lang->block->regionList      = '區域列表';
$lang->block->select          = '請選擇區塊';
$lang->block->categories      = '分類';
$lang->block->showImage       = '圖文';
$lang->block->showCategory    = '顯示類目';
$lang->block->showBoard       = '顯示版塊';
$lang->block->showTime        = '顯示時間';
$lang->block->product         = '產品';
$lang->block->slide           = '幻燈片';
$lang->block->titleless       = '無標題';
$lang->block->borderless      = '無邊框';
$lang->block->icon            = '表徵圖';
$lang->block->padding         = '內邊距';
$lang->block->border          = '邊框';
$lang->block->grid            = '寬度';
$lang->block->more            = '更多';
$lang->block->color           = '顏色';
$lang->block->backgroundColor = '背景顏色';
$lang->block->textColor       = '文字顏色';
$lang->block->borderColor     = '邊框顏色';
$lang->block->linkColor       = '連結顏色';
$lang->block->iconColor       = '表徵圖顏色';
$lang->block->heading         = '標題欄';
$lang->block->content         = '內容';
$lang->block->background      = '背景';
$lang->block->custom          = '自定義';
$lang->block->preview         = '樣式預覽';
$lang->block->textExample     = '區塊文字樣式示例，<a href="###">連結示例</a>';
$lang->block->customStyleTip  = '在這裡調整區塊的顏色及背景';
$lang->block->style           = '樣式';
$lang->block->sort            = '排序';
$lang->block->class           = 'css類名';
$lang->block->subRegion       = '子佈局';
$lang->block->currentLayout   = '當前佈局：%s';
$lang->block->renameLayout    = '方案重命名';
$lang->block->planName        = '方案名稱';
$lang->block->saveLayoutAs    = '複製佈局：%s';
$lang->block->defaultPlan     = '預設方案';

$lang->block->admin        = "區塊管理";
$lang->block->pages        = "佈局";
$lang->block->add          = "添加";
$lang->block->addChild     = "子區塊";
$lang->block->template     = "模板";
$lang->block->create       = '添加區塊';
$lang->block->browseBlocks = '區塊列表';
$lang->block->browseRegion = '佈局設置';
$lang->block->edit         = '編輯區塊';
$lang->block->view         = '查看區塊';
$lang->block->setPage      = '配置頁面';
$lang->block->setregion    = '配置佈局';
$lang->block->switchPlan   = '切換佈局';
$lang->block->cloneLayout  = '佈局另存為';
$lang->block->switchLayout = '切換佈局';
$lang->block->removeLayout = '刪除佈局方案';
$lang->block->planIsUseing = '此方案正在使用，不能刪除';

$lang->block->paddingTop    = '上';
$lang->block->paddingBottom = '下';
$lang->block->paddingLeft   = '左';
$lang->block->paddingRight  = '右';

$lang->block->placeholder = new stdclass();
$lang->block->placeholder->moreText               = '區塊右上角文字';
$lang->block->placeholder->moreUrl                = '區塊右上角連結地址';
$lang->block->placeholder->padding                = '0';
$lang->block->placeholder->customStyleTip         = '樣式表支持Less語法，可以用#blockID作為id選擇器。';
$lang->block->placeholder->desktopCustomScriptTip = '已包含 jQuery 1.9.0，可以用#blockID作為id選擇器。';
$lang->block->placeholder->mobileCustomScriptTip  = '支持基本的jQuery語法，可以用#blockID作為id選擇器。';
$lang->block->placeholder->class                  = '多個類名之間用空格隔開';

$lang->block->gridOptions[0]  = '自動';
$lang->block->gridOptions[6]  = '1/2';
$lang->block->gridOptions[4]  = '1/3';
$lang->block->gridOptions[8]  = '2/3';
$lang->block->gridOptions[3]  = '1/4';
$lang->block->gridOptions[9]  = '3/4';
$lang->block->gridOptions[2]  = '1/6';
$lang->block->gridOptions[10] = '5/6';
$lang->block->gridOptions[12] = '100%';

$lang->block->categoryList['custom']  = '自定義';
$lang->block->categoryList['article'] = '文章';
$lang->block->categoryList['product'] = '產品';
$lang->block->categoryList['system']  = '系統';

$lang->block->category = new stdclass();
$lang->block->category->showChildren = '顯示子分類';
$lang->block->category->fromCurrent  = '當前類目開始';

$lang->block->category->showChildrenList[1] = '是';
$lang->block->category->showChildrenList[0] = '否';

$lang->block->category->fromCurrentList[1] = '是';
$lang->block->category->fromCurrentList[0] = '否';

$lang->block->category->showCategoryList['abbr'] = '簡稱';
$lang->block->category->showCategoryList['name'] = '全稱';
