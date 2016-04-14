<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The all avaliabe actions in ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id$
 * @link        http://www.zentao.net
 */

/* Module order. */
$lang->moduelGroups = new stdclass();

$lang->moduelGroups->content = array();
$lang->moduelGroups->content[] = 'article';
$lang->moduelGroups->content[] = 'book';
$lang->moduelGroups->content[] = 'file';

$lang->moduelGroups->shop = array();
$lang->moduelGroups->shop[] = 'product';
$lang->moduelGroups->shop[] = 'order';

$lang->moduelGroups->user = array();
$lang->moduelGroups->user[] = 'user';
$lang->moduelGroups->user[] = 'message';
$lang->moduelGroups->user[] = 'forum';
$lang->moduelGroups->user[] = 'thread';
$lang->moduelGroups->user[] = 'reply';
$lang->moduelGroups->user[] = 'wechat';

$lang->moduelGroups->promote = array();
$lang->moduelGroups->promote[] = 'stat';
$lang->moduelGroups->promote[] = 'tag';
$lang->moduelGroups->promote[] = 'links';

$lang->moduelGroups->design = array();
$lang->moduelGroups->design[] = 'ui';
$lang->moduelGroups->design[] = 'block';
$lang->moduelGroups->design[] = 'slide';
$lang->moduelGroups->design[] = 'nav';
$lang->moduelGroups->design[] = 'visual';

$lang->moduelGroups->open = array();
$lang->moduelGroups->open[] = 'package';
$lang->moduelGroups->open[] = 'theme';

$lang->moduelGroups->setting = array();
$lang->moduelGroups->setting[] = 'site';
$lang->moduelGroups->setting[] = 'company';
$lang->moduelGroups->setting[] = 'guarder';
$lang->moduelGroups->setting[] = 'search';
$lang->moduelGroups->setting[] = 'score';
$lang->moduelGroups->setting[] = 'mail';

$lang->resource = new stdclass();

/* Article module. */
$lang->resource->article = new stdclass();
$lang->resource->article->admin         = 'admin';
$lang->resource->article->create        = 'create';
$lang->resource->article->edit          = 'edit';
$lang->resource->article->delete        = 'delete';
$lang->resource->article->setcss        = 'setcss';
$lang->resource->article->setjs         = 'setjs';
$lang->resource->article->stick         = 'stick';
$lang->resource->article->forward2Blog  = 'forward2Blog';
$lang->resource->article->forward2Forum = 'forward2Forum';
$lang->resource->article->check         = 'check';
$lang->resource->article->reject        = 'reject';

/* Block module. */
$lang->resource->block = new stdclass();
$lang->resource->block->admin     = 'admin';
$lang->resource->block->pages     = 'pages';
$lang->resource->block->setregion = 'setregion';
$lang->resource->block->create    = 'create';
$lang->resource->block->edit      = 'edit';
$lang->resource->block->delete    = 'delete';
$lang->resource->block->switchLayout = 'switchLayout';
$lang->resource->block->cloneLayout  = 'cloneLayout';
$lang->resource->block->removeLayout = 'removeLayout';
$lang->resource->block->renameLayout = 'renameLayout';

/* Book module. */
$lang->resource->book = new stdclass();
$lang->resource->book->admin     = 'admin';
$lang->resource->book->catalog   = 'catalog';
$lang->resource->book->create    = 'create';
$lang->resource->book->edit      = 'edit';
$lang->resource->book->sort      = 'sort';
$lang->resource->book->delete    = 'delete';

/* Company module. */
$lang->resource->company = new stdclass();
$lang->resource->company->setbasic   = 'setBasic';
$lang->resource->company->setcontact = 'setContact';

/* Guarder module. */
$lang->resource->guarder = new stdclass();
$lang->resource->guarder->setblacklist = 'setBlacklist';
$lang->resource->guarder->setwhitelist = 'setWhitelist';
$lang->resource->guarder->setcaptcha   = 'setCaptcha';
$lang->resource->guarder->addblacklist = 'addBlacklist';
$lang->resource->guarder->addcaptcha   = 'addCaptcha';
$lang->resource->guarder->setFilter    = array('module' => 'site', 'method' => 'setFilter');

/* File module. */
$lang->resource->file = new stdclass();
$lang->resource->file->browse       = 'browse';
$lang->resource->file->setPrimary   = 'setPrimary';
$lang->resource->file->upload       = 'upload';
$lang->resource->file->download     = 'download';
$lang->resource->file->edit         = 'edit';
$lang->resource->file->sort         = 'sort';
$lang->resource->file->fileManager  = 'fileManager';
$lang->resource->file->delete       = 'delete';

/* Forum module. */
$lang->resource->forum = new stdclass();
$lang->resource->forum->admin  = 'admin';
$lang->resource->forum->update = 'update';

/* Group module. */
$lang->resource->group = new stdclass();
$lang->resource->group->browse       = 'browse';
$lang->resource->group->create       = 'create';
$lang->resource->group->edit         = 'edit';
$lang->resource->group->copy         = 'copy';
$lang->resource->group->delete       = 'delete';
$lang->resource->group->managePriv   = 'managePrivByGroup';
$lang->resource->group->manageMember = 'manageMember';

/* Link module. */
$lang->resource->links = new stdclass();
$lang->resource->links->admin  = 'admin';

/* Mail module. */
$lang->resource->mail = new stdclass();
$lang->resource->mail->admin  = 'index';
$lang->resource->mail->detect = 'detect';
$lang->resource->mail->edit   = 'edit';
$lang->resource->mail->save   = 'save';
$lang->resource->mail->test   = 'test';
$lang->resource->mail->reset  = 'reset';

/* Message module. */
$lang->resource->message = new stdclass();
$lang->resource->message->admin  = 'admin';
$lang->resource->message->reply  = 'reply';
$lang->resource->message->pass   = 'pass';
$lang->resource->message->delete = 'delete';

/* Nav module. */
$lang->resource->nav = new stdclass();
$lang->resource->nav->admin  = 'common';

/* Visual module. */
$lang->resource->visual = new stdclass();
$lang->resource->visual->index       = 'common';
$lang->resource->visual->editlogo    = 'editLogo';
$lang->resource->visual->editslogan  = 'editSlogan';
$lang->resource->visual->removeBlock = 'removeBlock';
$lang->resource->visual->appendBlock = 'appendBlock';
$lang->resource->visual->sortBlocks  = 'sortBlocks';

/* Package module. */
$lang->resource->package = new stdclass();
$lang->resource->package->browse     = 'browse';
$lang->resource->package->obtain     = 'obtain';
$lang->resource->package->install    = 'install';
$lang->resource->package->uninstall  = 'uninstall';
$lang->resource->package->activate   = 'activate';
$lang->resource->package->deactivate = 'deactivate';
$lang->resource->package->upload     = 'upload';
$lang->resource->package->erase      = 'erase';
$lang->resource->package->upgrade    = 'upgrade';
$lang->resource->package->structure  = 'structure';

/* Theme module. */
$lang->resource->theme = new stdclass();
$lang->resource->theme->setFilter    = array('module' => 'ui', 'method' => 'themeStore');

/* Product module. */
$lang->resource->product = new stdclass();
$lang->resource->product->admin        = 'admin';
$lang->resource->product->create       = 'create';
$lang->resource->product->edit         = 'edit';
$lang->resource->product->changeStatus = 'changeStatus';
$lang->resource->product->setting      = 'setting';
$lang->resource->product->delete       = 'delete';
$lang->resource->product->setcss       = 'setcss';
$lang->resource->product->setjs        = 'setjs';

/* Reply module. */
$lang->resource->reply = new stdclass();
$lang->resource->reply->admin      = 'admin';
$lang->resource->reply->edit       = 'edit';
$lang->resource->reply->delete     = 'delete';
$lang->resource->reply->deleteFile = 'deleteFile';

/* Site module. */
$lang->resource->site = new stdclass();
$lang->resource->site->setBasic     = 'setBasic';
$lang->resource->site->setRobots    = 'setRobots';
$lang->resource->site->setUpload    = 'setUpload';
$lang->resource->site->setOauth     = 'setOauth';
$lang->resource->site->setsecurity  = 'setsecurity';
$lang->resource->site->setsensitive = 'setsensitive';
$lang->resource->site->setstat      = 'setStat';

/* Slide module. */
$lang->resource->slide = new stdclass();
$lang->resource->slide->admin       = 'admin';
$lang->resource->slide->browse      = 'browse';
$lang->resource->slide->create      = 'create';
$lang->resource->slide->edit        = 'edit';
$lang->resource->slide->delete      = 'delete';
$lang->resource->slide->sort        = 'sort';
$lang->resource->slide->createGroup = 'createGroup';
$lang->resource->slide->editGroup   = 'editGroup';
$lang->resource->slide->removeGroup = 'removeGroup';

/* Tag module. */
$lang->resource->tag = new stdclass();
$lang->resource->tag->admin = 'admin';
$lang->resource->tag->link  = 'link';

/* Thread module. */
$lang->resource->thread = new stdclass();
$lang->resource->thread->transfer     = 'transfer';
$lang->resource->thread->switchStatus = 'switchStatus';
$lang->resource->thread->delete       = 'delete';
$lang->resource->thread->deleteFile   = 'deleteFile';

/* Tree module. */
$lang->resource->tree = new stdclass();
$lang->resource->tree->browse   = 'browse';
$lang->resource->tree->edit     = 'edit';
$lang->resource->tree->children = 'children';
$lang->resource->tree->delete   = 'delete';
$lang->resource->tree->redirect = 'redirect';

/* Ui module. */
$lang->resource->ui = new stdclass();
$lang->resource->ui->setTemplate   = 'setTemplate';
$lang->resource->ui->customTheme   = 'custom';
$lang->resource->ui->setLogo       = 'setLogo';
$lang->resource->ui->deleteFavicon = 'deleteFavicon';
$lang->resource->ui->deleteLogo    = 'deleteLogo';
$lang->resource->ui->others        = 'others';
$lang->resource->ui->setcode       = 'setCode';
$lang->resource->ui->browseSource  = array('module' => 'file', 'method' => 'sourceList');
$lang->resource->ui->sourceDelete  = array('module' => 'file', 'method' => 'sourceDelete');
$lang->resource->ui->sourceEdit    = array('module' => 'file', 'method' => 'sourceEdit');
$lang->resource->ui->selectImage   = array('module' => 'file', 'method' => 'selectImage');

/* User module. */
$lang->resource->user = new stdclass();
$lang->resource->user->admin    = 'list';
$lang->resource->user->edit     = 'edit';
$lang->resource->user->create   = 'create';
$lang->resource->user->forbid   = 'forbid';
$lang->resource->user->adminlog = 'adminlog';

/* Wechat module. */
$lang->resource->wechat = new stdclass();
$lang->resource->wechat->admin          = 'admin';
$lang->resource->wechat->create         = 'create';
$lang->resource->wechat->integrate      = 'integrate';
$lang->resource->wechat->edit           = 'edit';
$lang->resource->wechat->delete         = 'delete';
$lang->resource->wechat->adminResponse  = 'adminResponse';
$lang->resource->wechat->setResponse    = 'setResponse';
$lang->resource->wechat->deleteResponse = 'deleteResponse';
$lang->resource->wechat->reply          = 'reply';
$lang->resource->wechat->commitMenu     = 'commitMenu';
$lang->resource->wechat->deleteMenu     = 'deleteMenu';
$lang->resource->wechat->message        = 'messageList';
$lang->resource->wechat->qrcode         = 'qrcode';

/* Order module. */
if(!isset($lang->resource->order))$lang->resource->order = new stdclass();
$lang->resource->order->admin    = 'admin';
$lang->resource->order->delivery = 'delivery';
$lang->resource->order->finish   = 'finish';
$lang->resource->order->pay      = 'pay';

/* Stat module. */
$lang->resource->stat = new stdclass();
$lang->resource->stat->traffic       = 'traffic';
$lang->resource->stat->from          = 'from';
$lang->resource->stat->search        = 'search';
$lang->resource->stat->client        = 'client';
$lang->resource->stat->keywords      = 'keywords';
$lang->resource->stat->keywordreport = 'keywordReport';
$lang->resource->stat->domainlist    = 'domainList';
$lang->resource->stat->domaintrend   = 'domainTrend';
$lang->resource->stat->domainpage    = 'domainPage';
$lang->resource->stat->ignorekeyword = 'ignoreKeyword';

/* Stat module. */
$lang->resource->score = new stdclass();
$lang->resource->score->setCounts = 'setCounts';

/* Search module. */
if(!isset($lang->resource->search))$lang->resource->search = new stdclass();
$lang->resource->search->buildIndex   = 'buildIndex';
