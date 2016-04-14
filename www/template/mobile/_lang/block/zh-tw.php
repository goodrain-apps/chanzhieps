<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The block module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->block->mobile = new stdclass();
$lang->block->mobile->typeList['html']     = '自定義區塊';
$lang->block->mobile->typeList['htmlcode'] = 'html原始碼';
$lang->block->mobile->typeList['phpcode']  = 'php原始碼';

$lang->block->mobile->typeList['latestArticle']   = '最新文章';
$lang->block->mobile->typeList['hotArticle']      = '熱門文章';

$lang->block->mobile->typeList['latestBlog']      = '最新博文';
$lang->block->mobile->typeList['latestThread']    = '最新帖子';

$lang->block->mobile->typeList['latestProduct']   = '最新產品';
$lang->block->mobile->typeList['featuredProduct'] = '首頁推薦產品';
$lang->block->mobile->typeList['hotProduct']      = '熱門產品';

$lang->block->mobile->typeList['pageList']        = '單頁列表';

$lang->block->mobile->typeList['articleTree']     = '文章分類';
$lang->block->mobile->typeList['productTree']     = '產品分類';
$lang->block->mobile->typeList['blogTree']        = '博客分類';

$lang->block->mobile->typeList['contact']         = '聯繫我們';
$lang->block->mobile->typeList['followUs']        = '關注我們';
$lang->block->mobile->typeList['about']           = '公司簡介';
$lang->block->mobile->typeList['links']           = '友情連結';
$lang->block->mobile->typeList['slide']           = '幻燈片';

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

$lang->block->mobile->pages['all']            = '全部頁面';
$lang->block->mobile->pages['index_index']    = '首頁';
$lang->block->mobile->pages['company_index']  = '關於我們';

$lang->block->mobile->pages['article_browse'] = '文章列表頁面';
$lang->block->mobile->pages['article_view']   = '文章詳情頁面';

$lang->block->mobile->pages['product_browse'] = '產品列表頁面';
$lang->block->mobile->pages['product_view']   = '產品詳情頁面';

$lang->block->mobile->pages['blog_index']     = '博客列表頁面';
$lang->block->mobile->pages['blog_view']      = '博客詳情頁面';

$lang->block->mobile->pages['forum_index']    = '論壇首頁';
$lang->block->mobile->pages['forum_board']    = '帖子列表頁面';
$lang->block->mobile->pages['thread_view']    = '帖子查看頁面';
$lang->block->mobile->pages['search_list']    = '搜索結果頁';

$lang->block->mobile->pages['book_index']     = '手冊中心';
$lang->block->mobile->pages['book_browse']    = '手冊首頁';
$lang->block->mobile->pages['book_read']      = '手冊章節';

$lang->block->mobile->pages['message_index']  = '留言';

$lang->block->mobile->pages['page_view']      = '單頁';
$lang->block->mobile->pages['page_index']     = '單頁列表';

/* page layout list. */
$lang->block->mobile->regions = new stdclass();
$lang->block->mobile->regions->all['header'] = 'Header(不可見)';
$lang->block->mobile->regions->all['top']    = '頁頭';
$lang->block->mobile->regions->all['banner'] = 'Banner';
$lang->block->mobile->regions->all['bottom'] = '頁尾';
$lang->block->mobile->regions->all['footer'] = 'Footer(不可見)';

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

