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
$lang->block->mobile = new stdclass();
$lang->block->mobile->typeList['html']     = '自定义区块';
$lang->block->mobile->typeList['htmlcode'] = 'html源代码';
$lang->block->mobile->typeList['phpcode']  = 'php源代码';

$lang->block->mobile->typeList['latestArticle']   = '最新文章';
$lang->block->mobile->typeList['hotArticle']      = '热门文章';

$lang->block->mobile->typeList['latestBlog']      = '最新博文';
$lang->block->mobile->typeList['latestThread']    = '最新帖子';

$lang->block->mobile->typeList['latestProduct']   = '最新产品';
$lang->block->mobile->typeList['featuredProduct'] = '首页推荐产品';
$lang->block->mobile->typeList['hotProduct']      = '热门产品';

$lang->block->mobile->typeList['pageList']        = '单页列表';

$lang->block->mobile->typeList['articleTree']     = '文章分类';
$lang->block->mobile->typeList['productTree']     = '产品分类';
$lang->block->mobile->typeList['blogTree']        = '博客分类';

$lang->block->mobile->typeList['contact']         = '联系我们';
$lang->block->mobile->typeList['followUs']        = '关注我们';
$lang->block->mobile->typeList['about']           = '公司简介';
$lang->block->mobile->typeList['links']           = '友情链接';
$lang->block->mobile->typeList['slide']           = '幻灯片';

$lang->block->mobile->typeGroups = array();
$lang->block->mobile->typeGroups['html']     = 'input';
$lang->block->mobile->typeGroups['htmlcode'] = 'input';
$lang->block->mobile->typeGroups['phpcode']  = 'input';

$lang->block->mobile->typeGroups['latestArticle'] = 'article';
$lang->block->mobile->typeGroups['hotArticle']    = 'article';

$lang->block->mobile->typeGroups['latestBlog']    = 'blog';
$lang->block->mobile->typeGroups['latestThread']  = 'thread';

$lang->block->mobile->typeGroups['latestProduct']   = 'product';
$lang->block->mobile->typeGroups['featuredProduct'] = 'product';
$lang->block->mobile->typeGroups['hotProduct']      = 'product';

$lang->block->mobile->typeGroups['pageList']        = 'page';

$lang->block->mobile->typeGroups['articleTree'] = 'category';
$lang->block->mobile->typeGroups['productTree'] = 'category';
$lang->block->mobile->typeGroups['blogTree']    = 'category';

$lang->block->mobile->typeGroups['contact']  = 'system';
$lang->block->mobile->typeGroups['followUs'] = 'system';
$lang->block->mobile->typeGroups['about']    = 'system';
$lang->block->mobile->typeGroups['links']    = 'system';
$lang->block->mobile->typeGroups['slide']    = 'system';

$lang->block->mobile->pages['all']            = '全部页面';
$lang->block->mobile->pages['index_index']    = '首页';
$lang->block->mobile->pages['company_index']  = '关于我们';

$lang->block->mobile->pages['article_browse'] = '文章列表页面';
$lang->block->mobile->pages['article_view']   = '文章详情页面';

$lang->block->mobile->pages['product_browse'] = '产品列表页面';
$lang->block->mobile->pages['product_view']   = '产品详情页面';

$lang->block->mobile->pages['blog_index']     = '博客列表页面';
$lang->block->mobile->pages['blog_view']      = '博客详情页面';

$lang->block->mobile->pages['forum_index']    = '论坛首页';
$lang->block->mobile->pages['forum_board']    = '帖子列表页面';
$lang->block->mobile->pages['thread_view']    = '帖子查看页面';
$lang->block->mobile->pages['search_list']    = '搜索结果页';

$lang->block->mobile->pages['book_index']     = '手册中心';
$lang->block->mobile->pages['book_browse']    = '手册首页';
$lang->block->mobile->pages['book_read']      = '手册章节';

$lang->block->mobile->pages['message_index']  = '留言';

$lang->block->mobile->pages['page_view']      = '单页';
$lang->block->mobile->pages['page_index']     = '单页列表';

/* page layout list. */
$lang->block->mobile->regions = new stdclass();
$lang->block->mobile->regions->all['header'] = 'Header(不可见)';
$lang->block->mobile->regions->all['top']    = '页头';
$lang->block->mobile->regions->all['banner'] = 'Banner';
$lang->block->mobile->regions->all['bottom'] = '页尾';
$lang->block->mobile->regions->all['footer'] = 'Footer(不可见)';

$lang->block->mobile->regions->index_index['top']     = '上部';
$lang->block->mobile->regions->index_index['middle']  = '中部';
$lang->block->mobile->regions->index_index['bottom']  = '底部';

$lang->block->mobile->regions->company_index['top']          = '上部';
$lang->block->mobile->regions->company_index['bottom']       = '底部';

$lang->block->mobile->regions->article_browse['top']          = '上部';
$lang->block->mobile->regions->article_browse['bottom']       = '底部';

$lang->block->mobile->regions->article_view['top']          = '上部';
$lang->block->mobile->regions->article_view['bottom']       = '底部';

$lang->block->mobile->regions->product_browse['top']          = '上部';
$lang->block->mobile->regions->product_browse['bottom']       = '底部';

$lang->block->mobile->regions->product_view['top']          = '上部';
$lang->block->mobile->regions->product_view['bottom']       = '底部';

$lang->block->mobile->regions->blog_index['top']          = '上部';
$lang->block->mobile->regions->blog_index['bottom']       = '底部';

$lang->block->mobile->regions->blog_view['top']          = '上部';
$lang->block->mobile->regions->blog_view['bottom']       = '底部';

$lang->block->mobile->regions->forum_index['top']     = '上部';
$lang->block->mobile->regions->forum_index['bottom']  = '底部';
$lang->block->mobile->regions->forum_board['top']     = '上部';
$lang->block->mobile->regions->forum_board['bottom']  = '底部';
$lang->block->mobile->regions->thread_view['top']     = '上部';
$lang->block->mobile->regions->thread_view['bottom']  = '底部';

$lang->block->mobile->regions->book_browse['top']          = '上部';
$lang->block->mobile->regions->book_browse['bottom']       = '底部';

$lang->block->mobile->regions->book_read['top']       = '上部';
$lang->block->mobile->regions->book_read['bottom']    = '底部';

$lang->block->mobile->regions->message_index['top']          = '上部';
$lang->block->mobile->regions->message_index['bottom']       = '底部';

$lang->block->mobile->regions->page_view['top']          = '上部';
$lang->block->mobile->regions->page_view['bottom']       = '底部';
$lang->block->mobile->regions->page_index['top']          = '上部';
$lang->block->mobile->regions->page_index['bottom']       = '底部';

