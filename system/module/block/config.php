<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->block->allowedTags = $config->allowedTags->admin . '<script><style><object><param><embed><form><button>';

$config->block->editor = new stdclass();
$config->block->editor->create = array('id' => 'content', 'tools' => 'full');
$config->block->editor->edit   = array('id' => 'content', 'tools' => 'full');

$config->block->require = new stdclass();
$config->block->require->create = 'title, template';
$config->block->require->edit   = 'title';

$config->block->categoryList = new stdclass();
$config->block->categoryList->custom  = ',html,htmlcode,phpcode,';
$config->block->categoryList->article = ',latestArticle,hotArticle,latestBlog,latestThread,pageList,articleTree,blogTree,';
$config->block->categoryList->product = ',latestProduct,hotProduct,featuredProduct,productTree,';
$config->block->categoryList->system  = ',contact,followUs,about,links,slide,header,';

$config->block->defaultIcons = array();
$config->block->defaultIcons['about']         = 'icon-group';
$config->block->defaultIcons['html']          = '';
$config->block->defaultIcons['contact']       = 'icon-phone';
$config->block->defaultIcons['followUs']      = 'icon-weixin';
$config->block->defaultIcons['links']         = 'icon-link';

$config->block->defaultIcons['latestArticle'] = 'icon-list-ul';
$config->block->defaultIcons['hotArticle']    = 'icon-list-ul';

$config->block->defaultIcons['latestBlog']    = 'icon-list-ul';
$config->block->defaultIcons['latestThread']  = 'icon-list-ul';

$config->block->defaultIcons['latestProduct'] = 'icon-th';
$config->block->defaultIcons['hotProduct']    = 'icon-th';

$config->block->defaultIcons['pageList'] = 'icon-list-ul';

$config->block->defaultIcons['articleTree']   = 'icon-folder-close';
$config->block->defaultIcons['productTree']   = 'icon-folder-close';
$config->block->defaultIcons['blogTree']      = 'icon-folder-close';

$config->block->defaultMoreUrl['html']          = '';
$config->block->defaultMoreUrl['latestArticle'] = '';
$config->block->defaultMoreUrl['hotArticle']    = '';
$config->block->defaultMoreUrl['latestProduct'] = '';
$config->block->defaultMoreUrl['hotProduct']    = '';
$config->block->defaultMoreUrl['latestThread']  = '';
$config->block->defaultMoreUrl['about']         = commonModel::createFrontLink('company', 'index');
$config->block->defaultMoreUrl['contact']       = commonModel::createFrontLink('company', 'index');
