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
$lang->block->common          = 'Block';
$lang->block->id              = 'ID';
$lang->block->title           = 'Title';
$lang->block->amount          = 'Amount';
$lang->block->limit           = 'Limit';
$lang->block->recPerRow       = 'Amount per row';
$lang->block->type            = 'Type';
$lang->block->htmlcode        = 'html codes';
$lang->block->phpcode         = 'php codes';
$lang->block->content         = 'Content';
$lang->block->moreLink        = 'More Button';
$lang->block->page            = 'Page';
$lang->block->regionList      = 'Regions List';
$lang->block->select          = 'Please select a block';
$lang->block->categories      = 'Categories';
$lang->block->showImage       = 'Show image';
$lang->block->showCategory    = 'Show Category';
$lang->block->showBoard       = 'Show Board';
$lang->block->showTime        = 'Show time';
$lang->block->product         = 'Product';
$lang->block->slide           = 'Slide';
$lang->block->titleless       = 'Hide Title';
$lang->block->borderless      = 'Hide Border';
$lang->block->icon            = 'Icon';
$lang->block->padding         = 'Padding';
$lang->block->border          = 'Border';
$lang->block->grid            = 'Width';
$lang->block->more            = 'More';
$lang->block->color           = 'Color';
$lang->block->backgroundColor = 'Background';
$lang->block->textColor       = 'Text Color';
$lang->block->borderColor     = 'Border Color';
$lang->block->linkColor       = 'Link Color';
$lang->block->iconColor       = 'Icon Color';
$lang->block->heading         = 'Heading';
$lang->block->content         = 'Content';
$lang->block->background      = 'Background';
$lang->block->custom          = 'Custom';
$lang->block->preview         = 'Style preview';
$lang->block->textExample     = 'Block text style example，<a href="###">link text</a>';
$lang->block->customStyleTip  = 'Change block color and background here.';
$lang->block->style           = 'Style';
$lang->block->sort            = 'Sort';
$lang->block->class           = 'Class selector';
$lang->block->subRegion       = 'Sub Region';
$lang->block->currentLayout   = 'Current Theme：%s';
$lang->block->renameLayout    = 'Rename Plan';
$lang->block->planName        = 'Plan name';
$lang->block->saveLayoutAs    = 'Copy plan from %s';
$lang->block->defaultPlan     = 'Default plan';

$lang->block->layout            = 'Layout';
$lang->block->logoPosition      = 'Logo';
$lang->block->navPosition       = 'navigation';
$lang->block->searchbarPosition = 'searchbae';
$lang->block->sloganPosition    = 'slogan';

$lang->block->admin        = "Block management";
$lang->block->pages        = "Layout";
$lang->block->add          = "Add";
$lang->block->addChild     = "Add Child";
$lang->block->template     = "Template";
$lang->block->create       = 'Create Block';
$lang->block->browseBlocks = 'Browse Blocks';
$lang->block->browseRegion = 'Browse Regions';
$lang->block->edit         = 'Edit';
$lang->block->view         = 'view';
$lang->block->setPage      = 'Set page blocks';
$lang->block->setregion    = 'Set region';
$lang->block->switchPlan   = 'Switch plan';
$lang->block->cloneLayout  = 'Copy plan';
$lang->block->switchLayout = 'Switch Layout';
$lang->block->removeLayout = 'Remove layout';
$lang->block->planIsUseing = 'Can not remove useing plan';

$lang->block->paddingTop    = 'Top';
$lang->block->paddingBottom = 'Bottom';
$lang->block->paddingLeft   = 'Left';
$lang->block->paddingRight  = 'Right';

$lang->block->placeholder = new stdclass();
$lang->block->placeholder->moreText = 'Text for button of more';
$lang->block->placeholder->moreUrl  = 'Url for button of more';
$lang->block->placeholder->padding  = '0';
$lang->block->placeholder->customStyleTip         = 'Stylesheet supports Less syntax, #blockID can be used as id selector.';
$lang->block->placeholder->desktopCustomScriptTip = 'Already included jQuery 1.9.0, #blockID can be used as id selector.';
$lang->block->placeholder->mobileCustomScriptTip  = 'Support basic jQuery syntax, #blockID can be used as id selector.';
$lang->block->placeholder->class                  = 'Separated by a space between the plurality of selectors';

$lang->block->gridOptions[0]  = 'Auto';
$lang->block->gridOptions[6]  = '1/2';
$lang->block->gridOptions[4]  = '1/3';
$lang->block->gridOptions[8]  = '2/3';
$lang->block->gridOptions[3]  = '1/4';
$lang->block->gridOptions[9]  = '3/4';
$lang->block->gridOptions[2]  = '1/6';
$lang->block->gridOptions[10] = '5/6';
$lang->block->gridOptions[12] = '100%';

$lang->block->categoryList['custom']  = 'Custom';
$lang->block->categoryList['article'] = 'Article';
$lang->block->categoryList['product'] = 'Product';
$lang->block->categoryList['system']  = 'System';

$lang->block->category = new stdclass();
$lang->block->category->showChildren = 'Show Children';
$lang->block->category->fromCurrent  = 'From Current';

$lang->block->category->showChildrenList[1] = 'Yes';
$lang->block->category->showChildrenList[0] = 'No';

$lang->block->category->fromCurrentList[1] = 'Yes';
$lang->block->category->fromCurrentList[0] = 'No';

$lang->block->category->showCategoryList['abbr'] = 'Abbr';
$lang->block->category->showCategoryList['name'] = 'Name';

$lang->block->navTypeList = new stdclass();
$lang->block->navTypeList->desktop_top   = 'Desktop';
$lang->block->navTypeList->desktop_blog  = 'Blog';
$lang->block->navTypeList->mobile_top    = 'Top of Mobile';
$lang->block->navTypeList->mobile_bottom = 'Button of Mobile';
$lang->block->navTypeList->mobile_blog   = 'Blog of Mobile';
