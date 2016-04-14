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
$lang->block->default = new stdclass();
$lang->block->default->typeList['html']     = '自定義區塊';
$lang->block->default->typeList['htmlcode'] = 'html原始碼';
$lang->block->default->typeList['phpcode']  = 'php原始碼';

$lang->block->default->typeList['latestArticle']   = '最新文章';
$lang->block->default->typeList['hotArticle']      = '熱門文章';

$lang->block->default->typeList['latestBlog']      = '最新博文';
$lang->block->default->typeList['latestThread']    = '最新帖子';

$lang->block->default->typeList['latestProduct']   = '最新產品';
$lang->block->default->typeList['featuredProduct'] = '首頁推薦產品';
$lang->block->default->typeList['hotProduct']      = '熱門產品';

$lang->block->default->typeList['pageList']        = '單頁列表';

$lang->block->default->typeList['articleTree']     = '文章分類';
$lang->block->default->typeList['productTree']     = '產品分類';
$lang->block->default->typeList['blogTree']        = '博客分類';

$lang->block->default->typeList['contact']         = '聯繫我們';
$lang->block->default->typeList['followUs']        = '關注我們';
$lang->block->default->typeList['about']           = '公司簡介';
$lang->block->default->typeList['links']           = '友情連結';
$lang->block->default->typeList['slide']           = '幻燈片';
$lang->block->default->typeList['header']          = '網站頭部';

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

$lang->block->default->typeGroups['contact']  = 'system';
$lang->block->default->typeGroups['followUs'] = 'system';
$lang->block->default->typeGroups['about']    = 'system';
$lang->block->default->typeGroups['links']    = 'system';
$lang->block->default->typeGroups['slide']    = 'system';
$lang->block->default->typeGroups['header']   = 'system';

$lang->block->default->pages['all']            = '全部頁面';
$lang->block->default->pages['index_index']    = '首頁';
$lang->block->default->pages['company_index']  = '關於我們';

$lang->block->default->pages['article_browse'] = '文章列表頁面';
$lang->block->default->pages['article_view']   = '文章詳情頁面';

$lang->block->default->pages['product_browse'] = '產品列表頁面';
$lang->block->default->pages['product_view']   = '產品詳情頁面';

$lang->block->default->pages['blog_index']     = '博客列表頁面';
$lang->block->default->pages['blog_view']      = '博客詳情頁面';

$lang->block->default->pages['forum_index']    = '論壇首頁';
$lang->block->default->pages['forum_board']    = '帖子列表頁面';
$lang->block->default->pages['thread_view']    = '帖子查看頁面';
$lang->block->default->pages['search_list']    = '搜索結果頁';

$lang->block->default->pages['book_index']     = '手冊中心';
$lang->block->default->pages['book_browse']    = '手冊首頁';
$lang->block->default->pages['book_read']      = '手冊章節';

$lang->block->default->pages['message_index']  = '留言';

$lang->block->default->pages['page_view']      = '單頁';

/* page layout list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(不可見)';
$lang->block->default->regions->all['top']    = '頁頭';
$lang->block->default->regions->all['banner'] = 'Banner';
$lang->block->default->regions->all['bottom'] = '頁尾';
$lang->block->default->regions->all['footer'] = 'Footer(不可見)';

$lang->block->default->regions->index_index['top']     = '上部';
$lang->block->default->regions->index_index['middle']  = '中部';
$lang->block->default->regions->index_index['bottom']  = '底部';

$lang->block->default->regions->company_index['topBanner']    = '上部通欄';
$lang->block->default->regions->company_index['top']          = '上部';
$lang->block->default->regions->company_index['bottom']       = '底部';
$lang->block->default->regions->company_index['side']         = '側邊';
$lang->block->default->regions->company_index['bottomBanner'] = '底部通欄';

$lang->block->default->regions->article_browse['topBanner']    = '上部通欄';
$lang->block->default->regions->article_browse['top']          = '上部';
$lang->block->default->regions->article_browse['bottom']       = '底部';
$lang->block->default->regions->article_browse['side']         = '側邊';
$lang->block->default->regions->article_browse['bottomBanner'] = '底部通欄';

$lang->block->default->regions->article_view['topBanner']    = '上部通欄';
$lang->block->default->regions->article_view['top']          = '上部';
$lang->block->default->regions->article_view['bottom']       = '底部';
$lang->block->default->regions->article_view['side']         = '側邊';
$lang->block->default->regions->article_view['bottomBanner'] = '底部通欄';

$lang->block->default->regions->product_browse['topBanner']    = '上部通欄';
$lang->block->default->regions->product_browse['top']          = '上部';
$lang->block->default->regions->product_browse['bottom']       = '底部';
$lang->block->default->regions->product_browse['side']         = '側邊';
$lang->block->default->regions->product_browse['bottomBanner'] = '底部通欄';

$lang->block->default->regions->product_view['topBanner']    = '上部通欄';
$lang->block->default->regions->product_view['top']          = '上部';
$lang->block->default->regions->product_view['bottom']       = '底部';
$lang->block->default->regions->product_view['side']         = '側邊';
$lang->block->default->regions->product_view['bottomBanner'] = '底部通欄';

$lang->block->default->regions->blog_index['topBanner']    = '上部通欄';
$lang->block->default->regions->blog_index['top']          = '上部';
$lang->block->default->regions->blog_index['bottom']       = '底部';
$lang->block->default->regions->blog_index['side']         = '側邊';
$lang->block->default->regions->blog_index['bottomBanner'] = '底部通欄';

$lang->block->default->regions->blog_view['topBanner']    = '上部通欄';
$lang->block->default->regions->blog_view['top']          = '上部';
$lang->block->default->regions->blog_view['bottom']       = '底部';
$lang->block->default->regions->blog_view['side']         = '側邊';
$lang->block->default->regions->blog_view['bottomBanner'] = '底部通欄';

$lang->block->default->regions->forum_index['top']     = '上部';
$lang->block->default->regions->forum_index['bottom']  = '底部';
$lang->block->default->regions->forum_board['top']     = '上部';
$lang->block->default->regions->forum_board['bottom']  = '底部';
$lang->block->default->regions->thread_view['top']     = '上部';
$lang->block->default->regions->thread_view['bottom']  = '底部';

$lang->block->default->regions->book_browse['topBanner']    = '上部通欄';
$lang->block->default->regions->book_browse['top']          = '上部';
$lang->block->default->regions->book_browse['bottom']       = '底部';
$lang->block->default->regions->book_browse['side']         = '側邊';
$lang->block->default->regions->book_browse['bottomBanner'] = '底部通欄';

$lang->block->default->regions->book_read['top']       = '上部';
$lang->block->default->regions->book_read['bottom']    = '底部';

$lang->block->default->regions->message_index['topBanner']    = '上部通欄';
$lang->block->default->regions->message_index['top']          = '上部';
$lang->block->default->regions->message_index['bottom']       = '底部';
$lang->block->default->regions->message_index['side']         = '側邊';
$lang->block->default->regions->message_index['bottomBanner'] = '底部通欄';

$lang->block->default->regions->page_view['topBanner']    = '上部通欄';
$lang->block->default->regions->page_view['top']          = '上部';
$lang->block->default->regions->page_view['bottom']       = '底部';
$lang->block->default->regions->page_view['side']         = '側邊';
$lang->block->default->regions->page_view['bottomBanner'] = '底部通欄';

$lang->block->headerLayout = new stdclass();
$lang->block->headerLayout->compatibleEnable = '兼容老版本头部';

$lang->block->headerLayout->nav = array();
$lang->block->headerLayout->nav['besideLogo'] = 'Logo右侧';
$lang->block->headerLayout->nav['row']        = '独占一行';

$lang->block->headerLayout->slogan = array();
$lang->block->headerLayout->slogan['besideLogo'] = 'Logo 右侧';
$lang->block->headerLayout->slogan['topLeft']    = '左上角';

$lang->block->headerLayout->searchbar = array();
$lang->block->headerLayout->searchbar['besideSlogan'] = '站点口号右侧';
$lang->block->headerLayout->searchbar['topRight']     = '右上角';
$lang->block->headerLayout->searchbar['insideNav']    = '导航右侧';
