<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The site module en file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->visual->common      = "Visual edit mode";
$lang->visual->editLogo    = "Edit logo";
$lang->visual->editSlogan  = "Edit Slogan";
$lang->visual->appendBlock = "Append block";
$lang->visual->removeBlock = "Remove Block";
$lang->visual->sortBlocks  = "Sort Blocks";

$lang->visual->info            = "Edit mode";
$lang->visual->preview         = "Preview";
$lang->visual->exit            = "Exit";
$lang->visual->exitVisualEdit  = "Exit visual edit mode";
$lang->visual->customTheme     = "Custom theme";
$lang->visual->admin           = "Admin";
$lang->visual->reload          = 'Reload';
$lang->visual->createBlock     = 'Create block';
$lang->visual->manageBlock     = 'Manage blocks';
$lang->visual->searchBlock     = 'Search blocks';
$lang->visual->allBlock        = 'All';
$lang->visual->openInNewWindow = 'Open current page in new window(or tab)';
$lang->visual->editPowerBy     = "<p>You can use changer cms freely under the <a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>license of change system</a>. Keeping the logo and link of changecms is very important for us.  If you want to remove the logo please <a href='http://www.chanzhi.org/license-search.html' target='_blank'> buy the business license</a> </p>";

$lang->visual->js = new stdclass();
$lang->visual->js->saved              = $lang->saveSuccess;
$lang->visual->js->deleted            = $lang->deleteSuccess;
$lang->visual->js->preview            = 'Preview';
$lang->visual->js->exitPreview        = 'Exit preview';
$lang->visual->js->removeBlock        = 'Remove block';
$lang->visual->js->invisible          = 'Invisible';
$lang->visual->js->carousel           = 'Carousel';
$lang->visual->js->operateFail        = 'Failed!';
$lang->visual->js->addContent         = 'Append content...';
$lang->visual->js->addContentTo       = 'Append content to 【{0}】';
$lang->visual->js->createBlock        = 'Create block';
$lang->visual->js->addSubRegion       = 'Add subregion';
$lang->visual->js->addBlock           = 'Add block';
$lang->visual->js->subRegion          = 'Subregion';
$lang->visual->js->subRegionDesc      = 'A block can contain other blocks';
$lang->visual->js->alreadyLastSlide   = 'Already last';
$lang->visual->js->alreadyFirstSlide  = 'Already first';
$lang->visual->js->slideOrder         = 'Current play order';
$lang->visual->js->gridWidth          = 'Grid value';
$lang->visual->js->actions            = array('edit' => 'Edit', 'delete' => 'Delete', 'move' => 'Move', 'add' => 'Add');

/* Language for config */
$lang->visual->setting = new stdclass();
$lang->visual->setting->logo                               = array('name' => "Logo/Sitename");
$lang->visual->setting->slogan                             = array('name' => "Slogan");
$lang->visual->setting->powerby                            = array('name' => "Chanzhi mark", 'actions' => array());
$lang->visual->setting->powerby['actions']['edit']         = array('title' => 'Remove chanzhi mark', 'text' => 'Remove chanzhi mark', 'alert' => $lang->visual->editPowerBy);
$lang->visual->setting->company                            = array('name' => "Company profile", 'actions' => array());
$lang->visual->setting->company['actions']['edit']         = array('text' => 'Eidt company profile');
$lang->visual->setting->companyName                        = array('name' => "Company name");
$lang->visual->setting->companyDesc                        = array('name' => "Company description");
$lang->visual->setting->companyContact                     = array('name' => "Contact information");
$lang->visual->setting->links                              = array('name' => "Links");
$lang->visual->setting->navbar                             = array('name' => "Navbar");
$lang->visual->setting->carousel                           = array();
$lang->visual->setting->carousel['groupActions']           = array();
$lang->visual->setting->carousel['groupActions']['add']    = array('text' => 'create a slide');
$lang->visual->setting->carousel['itemActions']            = array();
$lang->visual->setting->carousel['itemActions']['edit']    = array('text' => 'Edit', 'title' => 'Edit slide');
$lang->visual->setting->carousel['itemActions']['delete']  = array('text' => 'Delete', 'confirm' => 'Delete the slide?');
$lang->visual->setting->carousel['itemActions']['up']      = array('text' => 'Change play order to {0}');
$lang->visual->setting->carousel['itemActions']['down']    = array('text' => 'Change play order to {0}');
$lang->visual->setting->block                              = array('name' => "Block", 'actions' => array());
$lang->visual->setting->block['actions']['delete']         = array('confirm' => 'Remove {title} from the region？', 'success' => 'Removed {title}.'); 
$lang->visual->setting->block['actions']['layout']         = array('text' => 'Change layout', 'success' => 'Layout changes saved.');
$lang->visual->setting->block['actions']['add']            = array('title' => 'Add block {title}');
$lang->visual->setting->block['actions']['create']         = array('title' => 'Create and add block');
$lang->visual->setting->article                            = array('name' => 'Article');
$lang->visual->setting->articles                           = array('name' => 'Article list', 'actions' => array());
$lang->visual->setting->articles['actions']['add']         = array('text' => 'Publish article');
$lang->visual->setting->page                               = array('name' => 'Page');
$lang->visual->setting->pageList                           = array('name' => 'Page list', 'actions' => array());
$lang->visual->setting->pageList['actions']['add']         = array('text' => 'Publish page');
$lang->visual->setting->blog                               = array('name' => 'Blog');
$lang->visual->setting->blogList                           = array('name' => 'Blog list', 'actions' => array());
$lang->visual->setting->blogList['actions']['add']         = array('text' => 'Publish blog');
$lang->visual->setting->product                            = array('name' => 'Product');
$lang->visual->setting->products                           = array('name' => 'Product list', 'actions' => array());
$lang->visual->setting->products['actions']['add']         = array('text' => 'Publish product');
$lang->visual->setting->books                              = array('name' => 'Book catalog', 'actions' => array());
$lang->visual->setting->books['actions']['add']            = array('text' => 'Create book item');
$lang->visual->setting->bookCatalog                        = array('name' => "Book catalog");
$lang->visual->setting->book                               = array('name' => "Book");
$lang->visual->setting->boards                             = array('name' => 'Forum boards', 'actions' => array());
$lang->visual->setting->boards['actions']['add']           = array('text' => 'Manage boards');
$lang->visual->setting->thread                             = array('name' => 'Thread', 'actions' => array());
$lang->visual->setting->thread['actions']['edit']          = array('text' => 'Transfer');
