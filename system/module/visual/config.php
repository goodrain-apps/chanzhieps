<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->visual->setting = new stdclass();
$config->visual->setting->logo                    = array('actions' => array());
$config->visual->setting->logo['actions']['edit'] = array('width' => 900, 'module' => 'visual', 'method' => 'editlogo');

$config->visual->setting->slogan                    = array('actions' => array());
$config->visual->setting->slogan['actions']['edit'] = array('width' => 700, 'module' => 'visual', 'method' => 'editslogan');

$config->visual->setting->powerby                    = array('actions' => array());
$config->visual->setting->powerby['actions']['edit'] = array('width' => 600, 'icon' => 'info-sign', 'type' => 'alert');

$config->visual->setting->company                    = array('actions' => array());
$config->visual->setting->company['actions']['edit'] = array('method' => 'setbasic', 'params' => 'display=content', 'width' => 900);

$config->visual->setting->companyName                    = array('actions' => array());
$config->visual->setting->companyName['actions']['edit'] = array('module' => 'company', 'method' => 'setbasic', 'params' => 'display=name', 'width' => 900);

$config->visual->setting->companyDesc                    = array('actions' => array());
$config->visual->setting->companyDesc['actions']['edit'] = array('module' => 'company', 'method' => 'setbasic', 'params' => 'display=desc', 'width' => 900);

$config->visual->setting->companyContact                    = array('actions' => array());
$config->visual->setting->companyContact['actions']['edit'] = array('module' => 'company', 'method' => 'setcontact', 'width' => 900);

$config->visual->setting->links                    = array('actions' => array());
$config->visual->setting->links['actions']['edit'] = array('module' => 'links', 'method' => 'admin', 'width' => 900);

$config->visual->setting->navbar                    = array('actions' => array());
$config->visual->setting->navbar['actions']['edit'] = array('params' => 'type={type}', 'module' => 'nav', 'method' => 'admin', 'width' => 1200);

$config->visual->setting->carousel                           = array('hidden' => true, 'module' => 'slide');
$config->visual->setting->carousel['actions']                = array('edit' => false);
$config->visual->setting->carousel['groupActions']           = array();
$config->visual->setting->carousel['groupActions']['add']    = array('icon' => 'plus', 'method' => 'create', 'params' => 'groupID={id}');
$config->visual->setting->carousel['itemActions']            = array();
$config->visual->setting->carousel['itemActions']['edit']    = array('icon' => 'pencil', 'method' => 'edit', 'params' => 'id={id}');
$config->visual->setting->carousel['itemActions']['delete']  = array('icon' => 'remove', 'method' => 'delete', 'params' => 'id={id}');
$config->visual->setting->carousel['itemActions']['up']      = array('icon' => 'arrow-left', 'method' => 'sort');
$config->visual->setting->carousel['itemActions']['down']    = array('icon' => 'arrow-right', 'method' => 'sort');

$config->visual->setting->block                       = array('module' => 'visual', 'actions' => array());
$config->visual->setting->block['actions']['edit']    = array('module' => 'block', 'width' => 1200, 'params' => 'blockID={id}');
$config->visual->setting->block['actions']['delete']  = array('method' => 'removeBlock', 'params' => 'blockID={id}&page={page}&region={region}'); 
$config->visual->setting->block['actions']['move']    = array('method' => 'sortblocks','params' => 'page={page}&region={region}&pagent={parent}');
$config->visual->setting->block['actions']['layout']  = array('method' => 'fixblock', 'width' => 600, 'icon' => 'columns', 'params' => 'page={page}&region={region}&blockID={id}');
$config->visual->setting->block['actions']['add']     = array('method' => 'appendBlock', 'params' => 'page={page}&region={region}&parent={parent}&allowregionblock={allowregionblock}', 'hidden' => true, 'width' => '80%', 'title' => '添加区块 {title}');
$config->visual->setting->block['actions']['create']  = array('method' => 'create', 'params' => 'type=html', 'module' => 'block', 'width' => 1000, 'hidden' => true);

$config->visual->setting->article                      = array('actions' => array());
$config->visual->setting->article['actions']['delete'] = array('params' => 'articleID={id}');
$config->visual->setting->article['actions']['edit']   = array('params' => 'articleID={id}&type=article');

$config->visual->setting->articles                    = array('hidden' => true, 'actions' => array());
$config->visual->setting->articles['actions']['edit'] = false;
$config->visual->setting->articles['actions']['add']  = array('module' => 'article', 'icon' => 'plus', 'method' => 'create', "params" => 'type=article', 'onDismiss' => 'reload');

$config->visual->setting->page                      = array('module' => 'article', 'actions' => array());
$config->visual->setting->page['actions']['delete'] = array('params' => 'articleID={id}');
$config->visual->setting->page['actions']['edit']   = array('params' => 'articleID={id}&type=page');

$config->visual->setting->pageList                    = array('hidden' => true, 'actions' => array());
$config->visual->setting->pageList['actions']['edit'] = false;
$config->visual->setting->pageList['actions']['add']  = array('module' => 'article', 'icon' => 'plus', 'method' => 'create', "params" => 'type=page', 'onDismiss' => 'reload');

$config->visual->setting->blog                      = array('module' => 'article', 'actions' => array());
$config->visual->setting->blog['actions']['delete'] = array('params' => 'articleID={id}');
$config->visual->setting->blog['actions']['edit']   = array('params' => 'articleID={id}&type=blog');

$config->visual->setting->blogList                    = array('hidden' => true, 'actions' => array());
$config->visual->setting->blogList['actions']['edit'] = false;
$config->visual->setting->blogList['actions']['add']  = array('module' => 'article', 'icon' => 'plus', 'method' => 'create', "params" => 'type=blog', 'onDismiss' => 'reload');

$config->visual->setting->product                      = array('actions' => array(), 'params' => 'productID={id}');
$config->visual->setting->product['actions']['delete'] = true;
$config->visual->setting->product['actions']['edit']   = true;

$config->visual->setting->products                    = array('hidden' => true, 'actions' => array());
$config->visual->setting->products['actions']['edit'] = false;
$config->visual->setting->products['actions']['add']  = array('module' => 'product', 'icon' => 'plus', 'method' => 'create', "params" => 'category=0', 'onDismiss' => 'reload');

$config->visual->setting->books                    = array('hidden' => true, 'actions' => array());
$config->visual->setting->books['actions']['edit'] = false;
$config->visual->setting->books['actions']['add']  = array('module' => 'book', 'icon' => 'plus', 'method' => 'create', 'onDismiss' => 'reload');

$config->visual->setting->bookCatalog                    = array('actions' => array());
$config->visual->setting->bookCatalog['actions']['edit'] = array('width' => 1200, 'params' => 'bookID={id}', 'module' => 'book', 'method' => 'admin', 'onDismiss' => 'update');

$config->visual->setting->book                    = array('actions' => array());
$config->visual->setting->book['actions']['edit'] = array('width' => 1200, 'params' => 'nodeID={id}');

$config->visual->setting->boards                    = array('hidden' => true, 'actions' => array());
$config->visual->setting->boards['actions']['edit'] = false;
$config->visual->setting->boards['actions']['add']  = array('icon' => 'sitemap', 'module' => 'tree', 'method' => 'browse', 'params' => 'type=forum', 'onDismiss' => 'update');

$config->visual->setting->thread                      = array('actions' => array());
$config->visual->setting->thread['actions']['delete'] = true;
$config->visual->setting->thread['actions']['edit']   = array('width' => 600, 'icon' => 'location-arrow', 'method' => 'transfer', 'onDismiss' => 'reload');
