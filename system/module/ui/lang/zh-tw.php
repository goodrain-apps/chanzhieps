<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The ui module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ui->common = "界面";

$lang->ui->clientDesktop   = '桌面';
$lang->ui->clientMobile    = '移動';
$lang->ui->logo            = 'Logo';
$lang->ui->favicon         = '小表徵圖';
$lang->ui->setLogo         = "標誌設置";
$lang->ui->setTemplate     = '模板設置';
$lang->ui->manageTemplate  = '模板管理';
$lang->ui->manageTheme     = '主題管理';
$lang->ui->installTemplate = '導入模板';
$lang->ui->exportTheme     = '導出主題';
$lang->ui->setTheme        = '主題設置';
$lang->ui->setFavicon      = "Favicon設置";
$lang->ui->deleteFavicon   = "不顯示Favicon";
$lang->ui->deleteLogo      = "刪除Logo";
$lang->ui->others          = "其他設置";
$lang->ui->productView     = "產品點擊量";
$lang->ui->QRCode          = "移動二維碼";
$lang->ui->templateName    = "模板";
$lang->ui->currentTheme    = '當前主題';
$lang->ui->internalTheme   = '內置主題';
$lang->ui->uploadTheme     = '導入主題';
$lang->ui->installTheme    = '導入主題';
$lang->ui->importedBlocks  = '導入區塊';
$lang->ui->matchedBlock    = '對應區塊';
$lang->ui->createBlock     = '導入新區塊';
$lang->ui->useOldBlock     = '使用已有區塊';
$lang->ui->themeStore      = '主題市場';
$lang->ui->help            = "幫助";
$lang->ui->deleteLogo      = "刪除Logo";
$lang->ui->setCode         = "代碼";
$lang->ui->enableTheme     = "使用此主題";
$lang->ui->industry        = "行業";

$lang->ui->noLogo                 = "未上傳Logo";
$lang->ui->noFavicon              = "未上傳小表徵圖";
$lang->ui->noStyleTag             = "請填寫全局CSS樣式代碼，不需要&lt;style&gt;&lt;/style&gt;標籤";
$lang->ui->noJsTag                = "請填寫全局JS代碼，不需要&lt;script&gt;&lt;/script&gt;標籤";
$lang->ui->setLogoFailed          = "設置Logo失敗";
$lang->ui->noSelectedFile         = "獲取上傳圖片失敗，可能是圖片大小超出上傳限制";
$lang->ui->notAlloweFileType      = "請選擇正確的%s檔案";
$lang->ui->suitableLogoSize       = '最佳高度範圍：%s，最佳寬度範圍：%s';
$lang->ui->exportedSuccess        = '導出成功';
$lang->ui->deleteThemeSuccess     = '刪除主題成功';
$lang->ui->deleteThemeFail        = '刪除主題失敗';
$lang->ui->fileRequired           = '請選擇一個檔案';
$lang->ui->importThemeSuccess     = '導入主題成功';
$lang->ui->packagePathUnwriteable = '上傳目錄：%s 不可寫';
$lang->ui->selectSourceImage      = '從素材庫選擇';

$lang->ui->deviceList = new stdclass();
$lang->ui->deviceList->desktop = "<i class='icon icon-desktop'></i> 桌面";
$lang->ui->deviceList->mobile  = "<i class='icon icon-tablet'></i> 移動";

$lang->ui->productViewList[1] = '顯示'; 
$lang->ui->productViewList[0] = '不顯示'; 

$lang->ui->QRCodeList[1] = '顯示'; 
$lang->ui->QRCodeList[0] = '不顯示'; 

$lang->ui->logoList['current'] = '當前主題';
$lang->ui->logoList['all']     = '所有主題';

$lang->ui->deleteThemeList['blue']       = '藍色';
$lang->ui->deleteThemeList['brightdark'] = '蟬憩';
$lang->ui->deleteThemeList['flat']       = '清泉';
$lang->ui->deleteThemeList['tree']       = '蟬之樹';
$lang->ui->deleteThemeList['colorful']   = '繽紛';

$lang->ui->template = new stdclass();
$lang->ui->template->name            = '名稱';
$lang->ui->template->code            = '代碼';
$lang->ui->template->version         = '版本';
$lang->ui->template->author          = '作者';
$lang->ui->template->charge          = '費用';
$lang->ui->template->chanzhiVersion  = '兼容版本';
$lang->ui->template->desc            = '簡介';
$lang->ui->template->theme           = '主題';
$lang->ui->template->license         = '版權';
$lang->ui->template->preview         = '效果圖';
$lang->ui->template->availableThemes = '<strong>%s</strong> 款可用主題';
$lang->ui->template->currentTheme    = '正在使用 <strong>%s</strong>';
$lang->ui->template->changeTheme     = '切換主題';
$lang->ui->template->apply           = '應用模板';
$lang->ui->template->current         = '當前模板';
$lang->ui->template->conflicts       = "警告！已有名為<strong> %s </strong> 的模板。";
$lang->ui->template->override        = "覆蓋並安裝";
$lang->ui->template->reupload        = "重新上傳";
$lang->ui->template->installSuccess  = '恭喜，模板上傳成功';
$lang->ui->template->manageTemplate  = '設置模板';
$lang->ui->template->manageBlock     = '設置區塊';
$lang->ui->template->enable          = '啟用';
$lang->ui->template->reload          = '刷新頁面';
$lang->ui->template->doInstall       = '確認安裝';
$lang->ui->template->info            = '模板信息';
$lang->ui->template->demo            = '演示網址';
$lang->ui->template->qq              = 'QQ';
$lang->ui->template->email           = 'Email';
$lang->ui->template->site            = 'site';

$lang->ui->appearance  = '外觀';
$lang->ui->custom      = '自定義';
$lang->ui->themeSaved  = '主題配置已保存';
$lang->ui->unWritable  = "不能生成樣式檔案，請檢查 %s目錄的權限";
$lang->ui->codeHolder  = "字母加數字組合成的主題代號";

$lang->ui->blocks2Merge  = "可合併區塊";
$lang->ui->blocks2Create = "新創建區塊";

$lang->ui->theme = new stdclass();
$lang->ui->theme->reset                                = '重置為預設';
$lang->ui->theme->default                              = '預設';
$lang->ui->theme->resetTip                             = '參數已重置，保存後生效';
$lang->ui->theme->sizeTip                              = '預設單位為像素，如1px';
$lang->ui->theme->colorTip                             = '如: red 或 #FFF';
$lang->ui->theme->positionTip                          = '如: 100px, 50%, left, top, center';
$lang->ui->theme->backImageTip                         = '圖片地址，如: image.jpg';
$lang->ui->theme->extraStyle                           = 'CSS';
$lang->ui->theme->extraScript                          = 'Javascript';
$lang->ui->theme->customStyleTip                       = '樣式表支持Less語法。';
$lang->ui->theme->customScriptTip                      = '已包含 jQuery 1.9.0。';
$lang->ui->theme->borderStyleList['none']              = '無邊框';
$lang->ui->theme->borderStyleList['solid']             = '實線';
$lang->ui->theme->borderStyleList['dashed']            = '虛線';
$lang->ui->theme->borderStyleList['dotted']            = '點線';
$lang->ui->theme->borderStyleList['double']            = '雙線條';
$lang->ui->theme->imageRepeatList['repeat']            = '預設';
$lang->ui->theme->imageRepeatList['repeat']            = '重複';
$lang->ui->theme->imageRepeatList['repeat-x']          = 'X軸重複';
$lang->ui->theme->imageRepeatList['repeat-y']          = 'Y軸重複';
$lang->ui->theme->imageRepeatList['no-repeat']         = '不重複';
$lang->ui->theme->fontWeightList['inherit']            = '預設';
$lang->ui->theme->fontWeightList['normal']             = '正常';
$lang->ui->theme->fontWeightList['bold']               = '加粗';
$lang->ui->theme->fontList['inherit']                  = '預設';
$lang->ui->theme->fontList['SimSun']                   = '宋體';
$lang->ui->theme->fontList['FangSong']                 = '仿宋';
$lang->ui->theme->fontList['SimHei']                   = '黑體';
$lang->ui->theme->fontList['Microsoft YaHei']          = '微軟雅黑';
$lang->ui->theme->fontList['Arial']                    = 'Arial';
$lang->ui->theme->fontList['Courier']                  = 'Courier';
$lang->ui->theme->fontList['Console']                  = 'Console';
$lang->ui->theme->fontList['Tahoma']                   = 'Tahoma';
$lang->ui->theme->fontList['Verdana']                  = 'Verdana';
$lang->ui->theme->fontList['ZenIcon']                  = '表徵圖字型 ZenIcon';
$lang->ui->theme->fontSizeList['inherit']              = '預設';
$lang->ui->theme->fontSizeList['12px']                 = '12px';
$lang->ui->theme->fontSizeList['13px']                 = '13px';
$lang->ui->theme->fontSizeList['14px']                 = '14px';
$lang->ui->theme->fontSizeList['15px']                 = '15px';
$lang->ui->theme->fontSizeList['16px']                 = '16px';
$lang->ui->theme->fontSizeList['18px']                 = '18px';
$lang->ui->theme->fontSizeList['20px']                 = '20px';
$lang->ui->theme->fontSizeList['24px']                 = '24px';
$lang->ui->theme->navbarLayoutList['false']            = '普通';
$lang->ui->theme->navbarLayoutList['true']             = '自適應寬度';
$lang->ui->theme->sidebarPullLeftList['false']         = '靠右';
$lang->ui->theme->sidebarPullLeftList['true']          = '靠左';
$lang->ui->theme->sidebarWidthList["16.666666666667%"] = "1/6";
$lang->ui->theme->sidebarWidthList["25%"]              = "1/4";
$lang->ui->theme->sidebarWidthList["33.333333333333%"] = "1/3";
$lang->ui->theme->sidebarWidthList["50%"]              = "1/2";
$lang->ui->theme->underlineList['none']                = '無';
$lang->ui->theme->underlineList['underline']           = '帶下劃線';

$lang->ui->groups = new stdclass();
$lang->ui->groups->basic  = '基本樣式';
$lang->ui->groups->navbar = '導航條';
$lang->ui->groups->block  = '區塊';
$lang->ui->groups->button = '按鈕';
$lang->ui->groups->footer = '頁腳';

$lang->ui->color          = '顏色';
$lang->ui->colorset       = '配色';
$lang->ui->pageBackground = '頁面背景';
$lang->ui->pageText       = '頁面文字';
$lang->ui->aLink          = '普通連結';
$lang->ui->aVisited       = '已訪問連結';
$lang->ui->aHover         = '高亮連結';
$lang->ui->underline      = '下劃線';
$lang->ui->transparent    = '透明';
$lang->ui->none           = '無';

$lang->ui->layout        = '佈局';
$lang->ui->navbar        = '導航條';
$lang->ui->panel         = '子面板';
$lang->ui->menuBorder    = '菜單邊框';
$lang->ui->submenuBorder = '子菜單邊框';
$lang->ui->menuNormal    = '菜單普通';
$lang->ui->menuHover     = '菜單高亮';
$lang->ui->menuActive    = '菜單選中';
$lang->ui->submenuNormal = '子菜單普通';
$lang->ui->submenuHover  = '子菜單高亮';
$lang->ui->submenuActive = '子菜單選中';
$lang->ui->heading       = '標題';
$lang->ui->body          = '主體';
$lang->ui->background    = '背景';
$lang->ui->button        = '按鈕';
$lang->ui->text          = '文字';
$lang->ui->column        = '分欄';
$lang->ui->sidebarLayout = '側邊欄佈局';
$lang->ui->sidebarWidth  = '側邊欄寬度';

$lang->ui->primaryColor    = '基色';
$lang->ui->backcolor       = '背景色';
$lang->ui->forecolor       = '前景色';
$lang->ui->backgroundImage = '背景圖片';
$lang->ui->repeat          = '重複方式';
$lang->ui->position        = '位置';
$lang->ui->style           = '樣式';
$lang->ui->fontSize        = '字型大小';
$lang->ui->fontFamily      = '字型';
$lang->ui->fontWeight      = '加粗';
$lang->ui->layout          = '佈局';
$lang->ui->border          = '邊框';
$lang->ui->borderColor     = '邊框顏色';
$lang->ui->borderWidth     = '邊框寬度';
$lang->ui->width           = '寬度';
$lang->ui->radius          = '圓角';
$lang->ui->linkColor       = '連結顏色';
$lang->ui->default         = '普通';
$lang->ui->primary         = '主要';
$lang->ui->info            = '信息';
$lang->ui->danger          = '危險';
$lang->ui->warning         = '警告';
$lang->ui->success         = '積極';
$lang->ui->removeDirFaild  = "<h4>以下目錄刪除失敗</h4><pre>%s</pre> <div class='text-important'>請手動刪除，或者設置這些檔案的可寫權限後繼續。</div>";

$lang->ui->themeColors = array();
$lang->ui->themeColors[] = 'FF2A2A';
$lang->ui->themeColors[] = 'F8F100';
$lang->ui->themeColors[] = '7AE441';
$lang->ui->themeColors[] = '0084FF';
$lang->ui->themeColors[] = 'FF63E8';
$lang->ui->themeColors[] = '964B00';
$lang->ui->themeColors[] = '7F7F7F';
$lang->ui->themeColors[] = '000000';
