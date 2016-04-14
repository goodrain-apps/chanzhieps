<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The ui module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ui->common = "Site";

$lang->ui->clientDesktop = 'Desktop';
$lang->ui->clientMobile  = 'Mobile';
$lang->ui->logo            = 'Logo';
$lang->ui->favicon         = 'Favicon';
$lang->ui->setLogo         = "Set Logo";
$lang->ui->setTemplate     = 'Set Template';
$lang->ui->manageTemplate  = 'Templates';
$lang->ui->manageTheme     = 'Themes';
$lang->ui->installTemplate = 'Import Template';
$lang->ui->exportTheme     = 'Export Theme';
$lang->ui->setTheme        = 'Set Theme';
$lang->ui->setFavicon      = "Set favicon";
$lang->ui->deleteFavicon   = "Not display favicon";
$lang->ui->deleteLogo      = "Delete logo";
$lang->ui->others          = "Set others";
$lang->ui->productView     = "Product view";
$lang->ui->QRCode          = "QR Code";
$lang->ui->templateName    = "Template Name";
$lang->ui->currentTheme    = 'Used template&theme';
$lang->ui->internalTheme   = 'Internal Theme';
$lang->ui->uploadTheme     = 'Upload Theme';
$lang->ui->installTheme    = 'Install Theme';
$lang->ui->importedBlocks  = 'Import Blocks';
$lang->ui->matchedBlock    = 'Matched Blocks';
$lang->ui->createBlock     = 'Create Block';
$lang->ui->useOldBlock     = 'Use Old Blocks';
$lang->ui->themeStore      = 'Theme store';
$lang->ui->help            = "Help";
$lang->ui->deleteLogo      = "Delete Logo";
$lang->ui->setCode         = "Code";
$lang->ui->installedThemes = "Installed Themes";
$lang->ui->enableTheme     = "Use this theme";
$lang->ui->industry        = "Industry";
$lang->ui->offcial         = "Offcial";

$lang->ui->uploadLogo             = "Upload Logo";
$lang->ui->uploadFavicon          = "Upload Favicon";
$lang->ui->noStyleTag             = "Please write base CSS file code, No &lt;style&gt;&lt;/style&gt; tag.";
$lang->ui->noJsTag                = "Please write base JS file code, No &lt;script&gt;&lt;/script&gt; tag.";
$lang->ui->setLogoFailed          = "Set logo failed.";
$lang->ui->noSelectedFile         = "No file selected.";
$lang->ui->notAlloweFileType      = "Please select %s files.";
$lang->ui->suitableLogoSize       = 'Suitable height: %s, width: %s';
$lang->ui->faviconHelp            = "Please upload favicon with .ico extension. <a href='%s' target='_blank'>Help</a>";
$lang->ui->exportedSuccess        = 'Export Successfully';
$lang->ui->deleteThemeSuccess     = 'Delete theme successfully';
$lang->ui->deleteThemeFail        = 'Delete theme failed';
$lang->ui->fileRequired           = 'Please select file';
$lang->ui->importThemeSuccess     = 'Import theme successfully';
$lang->ui->packagePathUnwriteable = 'Package directory is not writable.';
$lang->ui->selectSourceImage      = 'Select image from source';

$lang->ui->deviceList = new stdclass();
$lang->ui->deviceList->desktop = "<i class='icon icon-desktop'></i>Desktop";
$lang->ui->deviceList->mobile  = "<i class='icon icon-tablet'></i>Mobile";

$lang->ui->productViewList[1] = 'Show'; 
$lang->ui->productViewList[0] = 'Hide'; 

$lang->ui->QRCodeList[1] = 'Show'; 
$lang->ui->QRCodeList[0] = 'Hide'; 

$lang->ui->logoList['current'] = 'Current theme';
$lang->ui->logoList['all']     = 'All theme';

$lang->ui->deleteThemeList['blue']       = 'Blue';
$lang->ui->deleteThemeList['brightdark'] = 'Brightdark';
$lang->ui->deleteThemeList['flat']       = 'Flat';
$lang->ui->deleteThemeList['tree']       = 'Tree';
$lang->ui->deleteThemeList['colorful']   = 'Colorful';

$lang->ui->template = new stdclass();
$lang->ui->template->name            = 'Name';
$lang->ui->template->code            = 'Code';
$lang->ui->template->version         = 'Version';
$lang->ui->template->author          = 'Author';
$lang->ui->template->charge          = 'Charge';
$lang->ui->template->chanzhiVersion  = 'Compatible version';
$lang->ui->template->desc            = 'Desc';
$lang->ui->template->theme           = 'Theme';
$lang->ui->template->license         = 'License';
$lang->ui->template->preview         = 'Preview';
$lang->ui->template->availableThemes = 'There are <strong>%s</strong> themes available.';
$lang->ui->template->currentTheme    = '<strong>%s</strong> is using';
$lang->ui->template->changeTheme     = 'Change theme';
$lang->ui->template->apply           = 'Apply template';
$lang->ui->template->current         = 'Current template';
$lang->ui->template->conflicts       = "Warning！Tempate <strong> %s </strong> already exists.";
$lang->ui->template->override        = "Override and install";
$lang->ui->template->reupload        = 'Reupload';
$lang->ui->template->installSuccess  = 'Template successfully uploaded';
$lang->ui->template->manageTemplate  = 'Manage template';
$lang->ui->template->manageBlock     = 'Manage blocks';
$lang->ui->template->enable          = 'Enable';
$lang->ui->template->reload          = 'Reload page';
$lang->ui->template->doInstall       = 'Do install';
$lang->ui->template->info            = 'Template info';
$lang->ui->template->demo            = 'Demo';
$lang->ui->template->qq              = 'QQ';
$lang->ui->template->email           = 'Email';
$lang->ui->template->site            = 'site';

$lang->ui->appearance  = 'Appearance';
$lang->ui->custom      = 'Custom';
$lang->ui->themeSaved  = 'Theme settings saved.';
$lang->ui->unWritable  = "Failed to save css file Please check %s is writable.";
$lang->ui->codeHolder  = "Code must be a combination of number and letters.";

$lang->ui->blocks2Merge  = "Blocks to merged";
$lang->ui->blocks2Create = "blocks to created";

$lang->ui->theme = new stdclass();
$lang->ui->theme->reset                                = 'Reset';
$lang->ui->theme->online                               = 'Store';
$lang->ui->theme->default                              = 'Default';
$lang->ui->theme->resetTip                             = 'Setting changed, take effect after saved.';
$lang->ui->theme->sizeTip                              = 'The default unit is pixels, such as 1px';
$lang->ui->theme->colorTip                             = 'Such as: red or #FFF';
$lang->ui->theme->positionTip                          = 'Such as: 100px, 50%, left, top, center';
$lang->ui->theme->backImageTip                         = 'Image URL: image.jpg';
$lang->ui->theme->extraStyle                           = 'CSS';
$lang->ui->theme->extraScript                          = 'Javascript';
$lang->ui->theme->customStyleTip                       = 'Extra style support LESS.';
$lang->ui->theme->customScriptTip                      = 'Include jQuery 1.9.0.';

$lang->ui->theme->borderStyleList['none']              = 'No Border';
$lang->ui->theme->borderStyleList['solid']             = 'Solid';
$lang->ui->theme->borderStyleList['dashed']            = 'Dashed';
$lang->ui->theme->borderStyleList['dotted']            = 'Dotted';
$lang->ui->theme->borderStyleList['double']            = 'Double';

$lang->ui->theme->imageRepeatList['repeat']            = 'Default';
$lang->ui->theme->imageRepeatList['repeat']            = 'Repeat';
$lang->ui->theme->imageRepeatList['repeat-x']          = 'Repeat-X';
$lang->ui->theme->imageRepeatList['repeat-y']          = 'Repeat-Y';
$lang->ui->theme->imageRepeatList['no-repeat']         = 'No Repeat';

$lang->ui->theme->fontWeightList['inherit']            = 'Default';
$lang->ui->theme->fontWeightList['normal']             = 'Normal';
$lang->ui->theme->fontWeightList['bold']               = 'Bold';

$lang->ui->theme->fontList['inherit']                  = 'Default';
$lang->ui->theme->fontList['SimSun']                   = 'SimSun';
$lang->ui->theme->fontList['FangSong']                 = 'FangSong';
$lang->ui->theme->fontList['SimHei']                   = 'SimHei';
$lang->ui->theme->fontList['Microsoft YaHei']          = 'Microsoft YaHei';
$lang->ui->theme->fontList['Arial']                    = 'Arial';
$lang->ui->theme->fontList['Courier']                  = 'Courier';
$lang->ui->theme->fontList['Console']                  = 'Console';
$lang->ui->theme->fontList['Tahoma']                   = 'Tahoma';
$lang->ui->theme->fontList['Verdana']                  = 'Verdana';
$lang->ui->theme->fontList['ZenIcon']                  = '图标字体 ZenIcon';

$lang->ui->theme->fontSizeList['inherit']              = 'Default';
$lang->ui->theme->fontSizeList['12px']                 = '12px';
$lang->ui->theme->fontSizeList['13px']                 = '13px';
$lang->ui->theme->fontSizeList['14px']                 = '14px';
$lang->ui->theme->fontSizeList['15px']                 = '15px';
$lang->ui->theme->fontSizeList['16px']                 = '16px';
$lang->ui->theme->fontSizeList['18px']                 = '18px';
$lang->ui->theme->fontSizeList['20px']                 = '20px';
$lang->ui->theme->fontSizeList['24px']                 = '24px';

$lang->ui->theme->navbarLayoutList['false']            = 'Normal';
$lang->ui->theme->navbarLayoutList['true']             = 'Adaptive Width';

$lang->ui->theme->sidebarPullLeftList['false']         = 'Right';
$lang->ui->theme->sidebarPullLeftList['true']          = 'Left';

$lang->ui->theme->sidebarWidthList["16.666666666667%"] = "1/6";
$lang->ui->theme->sidebarWidthList["25%"]              = "1/4";
$lang->ui->theme->sidebarWidthList["33.333333333333%"] = "1/3";
$lang->ui->theme->sidebarWidthList["50%"]              = "1/2";

$lang->ui->theme->underlineList['none']                = 'None';
$lang->ui->theme->underlineList['underline']           = 'Underline';

$lang->ui->theme->searchLabels = new stdclass();
$lang->ui->theme->searchLabels->sales  = 'Most Saled';
$lang->ui->theme->searchLabels->latest = 'Latest';
$lang->ui->theme->searchLabels->hot    = 'Hot';
$lang->ui->theme->searchLabels->rand   = 'Recommend';
$lang->ui->theme->searchLabels->free   = 'Free';

$lang->ui->groups = new stdclass();
$lang->ui->groups->basic  = 'Basic Style';
$lang->ui->groups->navbar = 'Navbar';
$lang->ui->groups->block  = 'Block';
$lang->ui->groups->button = 'Button';
$lang->ui->groups->footer = 'Footer';

$lang->ui->color          = 'Color';
$lang->ui->colorset       = 'Set Color';
$lang->ui->pageBackground = 'Page Background';
$lang->ui->pageText       = 'Page Text';
$lang->ui->aLink          = 'Normal Link';
$lang->ui->aVisited       = 'Visited Link';
$lang->ui->aHover         = 'Hover Link';
$lang->ui->underline      = 'Underline';
$lang->ui->transparent    = 'Transparent';
$lang->ui->none           = 'None';

$lang->ui->layout        = 'Layout';
$lang->ui->navbar        = 'Navbar';
$lang->ui->panel         = 'Panel';
$lang->ui->menuBorder    = 'Menu Border';
$lang->ui->submenuBorder = 'Submenu Border';
$lang->ui->menuNormal    = 'Normal menu';
$lang->ui->menuHover     = 'Hover menu';
$lang->ui->menuActive    = 'Active menu';
$lang->ui->submenuNormal = 'Normal submenu';
$lang->ui->submenuHover  = 'Hover submenu';
$lang->ui->submenuActive = 'Active submenu';
$lang->ui->heading       = 'Heading';
$lang->ui->body          = 'Body';
$lang->ui->background    = 'Background';
$lang->ui->button        = 'Button';
$lang->ui->text          = 'Text';
$lang->ui->column        = 'Column';
$lang->ui->sidebarLayout = 'Sidebar Layout';
$lang->ui->sidebarWidth  = 'Sidebar Width';

$lang->ui->primaryColor    = 'Color';
$lang->ui->backcolor       = 'Background';
$lang->ui->forecolor       = 'Foreground';
$lang->ui->backgroundImage = 'Background Image';
$lang->ui->repeat          = 'Repeat';
$lang->ui->position        = 'Position';
$lang->ui->style           = 'Style';
$lang->ui->fontSize        = 'Font Size';
$lang->ui->fontFamily      = 'Font Family';
$lang->ui->fontWeight      = 'Font Weight';
$lang->ui->layout          = 'Layout';
$lang->ui->border          = 'Border';
$lang->ui->borderColor     = 'Border Color';
$lang->ui->borderWidth     = 'Border Width';
$lang->ui->width           = 'width';
$lang->ui->radius          = 'Radius';
$lang->ui->linkColor       = 'Link Color';
$lang->ui->default         = 'Default';
$lang->ui->primary         = 'Primary';
$lang->ui->info            = 'Info';
$lang->ui->danger          = 'Danger';
$lang->ui->warning         = 'Warning';
$lang->ui->success         = 'Success';
$lang->ui->removeDirFaild  = "<h4>Delete the following directories failed</h4><pre>%s</pre> <div class='text-important'>Please manually delete, or set up these files writable. </div>";

$lang->ui->themeColors = array();
$lang->ui->themeColors[] = 'FF2A2A';
$lang->ui->themeColors[] = 'F8F100';
$lang->ui->themeColors[] = '7AE441';
$lang->ui->themeColors[] = '0084FF';
$lang->ui->themeColors[] = 'FF63E8';
$lang->ui->themeColors[] = '964B00';
$lang->ui->themeColors[] = '7F7F7F';
$lang->ui->themeColors[] = '000000';
