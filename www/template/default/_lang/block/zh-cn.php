<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The block module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->default = new stdclass();
$lang->block->default->typeList['html']     = '自定义区块';
$lang->block->default->typeList['htmlcode'] = 'html源代码';
$lang->block->default->typeList['phpcode']  = 'php源代码';

$lang->block->default->typeList['latestArticle']   = '最新文章';
$lang->block->default->typeList['hotArticle']      = '热门文章';

$lang->block->default->typeList['latestBlog']      = '最新博文';
$lang->block->default->typeList['latestThread']    = '最新帖子';

$lang->block->default->typeList['latestProduct']   = '最新产品';
$lang->block->default->typeList['featuredProduct'] = '首页推荐产品';
$lang->block->default->typeList['hotProduct']      = '热门产品';

$lang->block->default->typeList['pageList']        = '单页列表';

$lang->block->default->typeList['articleTree']     = '文章分类';
$lang->block->default->typeList['productTree']     = '产品分类';
$lang->block->default->typeList['blogTree']        = '博客分类';

$lang->block->default->typeList['contact']         = '联系我们';
$lang->block->default->typeList['followUs']        = '关注我们';
$lang->block->default->typeList['about']           = '公司简介';
$lang->block->default->typeList['links']           = '友情链接';
$lang->block->default->typeList['slide']           = '幻灯片';
$lang->block->default->typeList['header']          = '网站头部';

$lang->block->default->typeGroups = array();
$lang->block->default->typeGroups['html']     = 'input';
$lang->block->default->typeGroups['htmlcode'] = 'input';
$lang->block->default->typeGroups['phpcode']  = 'input';

$lang->block->default->typeGroups['latestArticle'] = 'article';
$lang->block->default->typeGroups['hotArticle']    = 'article';

$lang->block->default->typeGroups['latestBlog']    = 'blog';
$lang->block->default->typeGroups['latestThread']  = 'thread';

$lang->block->default->typeGroups['latestProduct']   = 'product';
$lang->block->default->typeGroups['featuredProduct'] = 'product';
$lang->block->default->typeGroups['hotProduct']      = 'product';

$lang->block->default->typeGroups['pageList']        = 'page';

$lang->block->default->typeGroups['articleTree'] = 'category';
$lang->block->default->typeGroups['productTree'] = 'category';
$lang->block->default->typeGroups['blogTree']    = 'category';

$lang->block->default->typeGroups['contact']   = 'system';
$lang->block->default->typeGroups['followUs']  = 'system';
$lang->block->default->typeGroups['about']     = 'system';
$lang->block->default->typeGroups['links']     = 'system';
$lang->block->default->typeGroups['slide']     = 'system';
$lang->block->default->typeGroups['header']    = 'system';

$lang->block->default->pages['all']            = '全部页面';
$lang->block->default->pages['index_index']    = '首页';
$lang->block->default->pages['company_index']  = '关于我们';

$lang->block->default->pages['article_browse'] = '文章列表页面';
$lang->block->default->pages['article_view']   = '文章详情页面';

$lang->block->default->pages['product_browse'] = '产品列表页面';
$lang->block->default->pages['product_view']   = '产品详情页面';

$lang->block->default->pages['blog_index']     = '博客列表页面';
$lang->block->default->pages['blog_view']      = '博客详情页面';

$lang->block->default->pages['forum_index']    = '论坛首页';
$lang->block->default->pages['forum_board']    = '帖子列表页面';
$lang->block->default->pages['thread_view']    = '帖子查看页面';
$lang->block->default->pages['search_list']    = '搜索结果页';

$lang->block->default->pages['book_index']     = '手册中心';
$lang->block->default->pages['book_browse']    = '手册首页';
$lang->block->default->pages['book_read']      = '手册章节';

$lang->block->default->pages['message_index']  = '留言';

$lang->block->default->pages['page_view']      = '单页';

/* page layout list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(不可见)';
$lang->block->default->regions->all['top']    = '页头';
$lang->block->default->regions->all['banner'] = 'Banner';
$lang->block->default->regions->all['bottom'] = '页尾';
$lang->block->default->regions->all['footer'] = 'Footer(不可见)';

$lang->block->default->regions->index_index['top']     = '上部';
$lang->block->default->regions->index_index['middle']  = '中部';
$lang->block->default->regions->index_index['bottom']  = '底部';

$lang->block->default->regions->company_index['topBanner']    = '上部通栏';
$lang->block->default->regions->company_index['top']          = '上部';
$lang->block->default->regions->company_index['bottom']       = '底部';
$lang->block->default->regions->company_index['side']         = '侧边';
$lang->block->default->regions->company_index['bottomBanner'] = '底部通栏';

$lang->block->default->regions->article_browse['topBanner']    = '上部通栏';
$lang->block->default->regions->article_browse['top']          = '上部';
$lang->block->default->regions->article_browse['bottom']       = '底部';
$lang->block->default->regions->article_browse['side']         = '侧边';
$lang->block->default->regions->article_browse['bottomBanner'] = '底部通栏';

$lang->block->default->regions->article_view['topBanner']    = '上部通栏';
$lang->block->default->regions->article_view['top']          = '上部';
$lang->block->default->regions->article_view['bottom']       = '底部';
$lang->block->default->regions->article_view['side']         = '侧边';
$lang->block->default->regions->article_view['bottomBanner'] = '底部通栏';

$lang->block->default->regions->product_browse['topBanner']    = '上部通栏';
$lang->block->default->regions->product_browse['top']          = '上部';
$lang->block->default->regions->product_browse['bottom']       = '底部';
$lang->block->default->regions->product_browse['side']         = '侧边';
$lang->block->default->regions->product_browse['bottomBanner'] = '底部通栏';

$lang->block->default->regions->product_view['topBanner']    = '上部通栏';
$lang->block->default->regions->product_view['top']          = '上部';
$lang->block->default->regions->product_view['bottom']       = '底部';
$lang->block->default->regions->product_view['side']         = '侧边';
$lang->block->default->regions->product_view['bottomBanner'] = '底部通栏';

$lang->block->default->regions->blog_index['topBanner']    = '上部通栏';
$lang->block->default->regions->blog_index['top']          = '上部';
$lang->block->default->regions->blog_index['bottom']       = '底部';
$lang->block->default->regions->blog_index['side']         = '侧边';
$lang->block->default->regions->blog_index['bottomBanner'] = '底部通栏';

$lang->block->default->regions->blog_view['topBanner']    = '上部通栏';
$lang->block->default->regions->blog_view['top']          = '上部';
$lang->block->default->regions->blog_view['bottom']       = '底部';
$lang->block->default->regions->blog_view['side']         = '侧边';
$lang->block->default->regions->blog_view['bottomBanner'] = '底部通栏';

$lang->block->default->regions->forum_index['top']     = '上部';
$lang->block->default->regions->forum_index['bottom']  = '底部';
$lang->block->default->regions->forum_board['top']     = '上部';
$lang->block->default->regions->forum_board['bottom']  = '底部';
$lang->block->default->regions->thread_view['top']     = '上部';
$lang->block->default->regions->thread_view['bottom']  = '底部';

$lang->block->default->regions->book_browse['topBanner']    = '上部通栏';
$lang->block->default->regions->book_browse['top']          = '上部';
$lang->block->default->regions->book_browse['bottom']       = '底部';
$lang->block->default->regions->book_browse['side']         = '侧边';
$lang->block->default->regions->book_browse['bottomBanner'] = '底部通栏';

$lang->block->default->regions->book_read['top']       = '上部';
$lang->block->default->regions->book_read['bottom']    = '底部';

$lang->block->default->regions->message_index['topBanner']    = '上部通栏';
$lang->block->default->regions->message_index['top']          = '上部';
$lang->block->default->regions->message_index['bottom']       = '底部';
$lang->block->default->regions->message_index['side']         = '侧边';
$lang->block->default->regions->message_index['bottomBanner'] = '底部通栏';

$lang->block->default->regions->page_view['topBanner']    = '上部通栏';
$lang->block->default->regions->page_view['top']          = '上部';
$lang->block->default->regions->page_view['bottom']       = '底部';
$lang->block->default->regions->page_view['side']         = '侧边';
$lang->block->default->regions->page_view['bottomBanner'] = '底部通栏';

$lang->block->headerLayout = new stdclass();
$lang->block->headerLayout->compatibleEnable = '兼容老版本头部';

$lang->block->headerLayout->nav = array();
$lang->block->headerLayout->nav['besideLogo'] = 'logo右侧';
$lang->block->headerLayout->nav['row']        = '独占一行';

$lang->block->headerLayout->slogan = array();
$lang->block->headerLayout->slogan['besideLogo'] = 'Logo 右侧';
$lang->block->headerLayout->slogan['topLeft']    = '左上角';

$lang->block->headerLayout->searchbar = array();
$lang->block->headerLayout->searchbar['besideSlogan'] = '站点口号右侧';
$lang->block->headerLayout->searchbar['topRight']     = '右上角';
$lang->block->headerLayout->searchbar['insideNav']    = '导航右侧';
