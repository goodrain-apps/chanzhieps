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
$lang->block->mobile->typeList['html']     = 'Html block';
$lang->block->mobile->typeList['htmlcode'] = 'Html codes';
$lang->block->mobile->typeList['phpcode']  = 'php codes';

$lang->block->mobile->typeList['latestArticle'] = 'Latest Articles';
$lang->block->mobile->typeList['hotArticle']    = 'Hot Articles';

$lang->block->mobile->typeList['latestBlog']      = 'Latest Blogs';
$lang->block->mobile->typeList['latestThread']    = 'Latest Threads';

$lang->block->mobile->typeList['latestProduct']   = 'Latest Products';
$lang->block->mobile->typeList['featuredProduct'] = 'Featured Products';
$lang->block->mobile->typeList['hotProduct']      = 'Hot Products';

$lang->block->mobile->typeList['pageList']        = 'Page List';

$lang->block->mobile->typeList['articleTree'] = 'Article Categories';
$lang->block->mobile->typeList['productTree'] = 'Product Categories';
$lang->block->mobile->typeList['blogTree']    = 'Blog Categories';

$lang->block->mobile->typeList['contact']  = 'Contact';
$lang->block->mobile->typeList['followUs']  = 'Follow Us';
$lang->block->mobile->typeList['about']    = 'About';
$lang->block->mobile->typeList['links']    = 'Links';
$lang->block->mobile->typeList['slide']    = 'Slide';

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

$lang->block->mobile->pages['all']            = 'All';
$lang->block->mobile->pages['index_index']    = 'Home';
$lang->block->mobile->pages['company_index']  = 'About Us';

$lang->block->mobile->pages['article_browse'] = 'Browse article page';
$lang->block->mobile->pages['article_view']   = 'View article page';

$lang->block->mobile->pages['product_browse'] = 'Browse product page';
$lang->block->mobile->pages['product_view']   = 'View product page';

$lang->block->mobile->pages['blog_index']     = 'Browse blog page';
$lang->block->mobile->pages['blog_view']      = 'View blog page';

$lang->block->mobile->pages['forum_index']    = 'Forum home';
$lang->block->mobile->pages['forum_board']    = 'Forum board';
$lang->block->mobile->pages['thread_view']    = 'View thread';
$lang->block->mobile->pages['search_list']    = 'Search';

$lang->block->mobile->pages['book_index']     = 'Book';
$lang->block->mobile->pages['book_browse']    = 'Book catalogue';
$lang->block->mobile->pages['book_read']      = 'Book content';

$lang->block->mobile->pages['message_index']  = 'Inquire';

$lang->block->mobile->pages['page_view']      = 'Page';
$lang->block->mobile->pages['page_index']     = 'Page list';

/* page layou>mobile-> list. */
$lang->block->mobile->regions = new stdclass();
$lang->block->mobile->regions->all['header'] = 'Header(invisible)';
$lang->block->mobile->regions->all['top']    = 'Top';
$lang->block->mobile->regions->all['banner'] = 'Banner';
$lang->block->mobile->regions->all['bottom'] = 'Bottom';
$lang->block->mobile->regions->all['footer'] = 'Footer(invisible)';

$lang->block->mobile->regions->index_index['top']     = 'Top';
$lang->block->mobile->regions->index_index['middle']  = 'Middle';
$lang->block->mobile->regions->index_index['bottom']  = 'Bottom';

$lang->block->mobile->regions->company_index['top']          = 'Top';
$lang->block->mobile->regions->company_index['bottom']       = 'Bottom';

$lang->block->mobile->regions->article_browse['top']          = 'Top';
$lang->block->mobile->regions->article_browse['bottom']       = 'Bottom';

$lang->block->mobile->regions->article_view['top']          = 'Top';
$lang->block->mobile->regions->article_view['bottom']       = 'Bottom';

$lang->block->mobile->regions->product_browse['top']          = 'Top';
$lang->block->mobile->regions->product_browse['bottom']       = 'Bottom';

$lang->block->mobile->regions->product_view['top']          = 'Top';
$lang->block->mobile->regions->product_view['bottom']       = 'Bottom';

$lang->block->mobile->regions->blog_index['top']          = 'Top';
$lang->block->mobile->regions->blog_index['bottom']       = 'Bottom';

$lang->block->mobile->regions->blog_view['top']          = 'Top';
$lang->block->mobile->regions->blog_view['bottom']       = 'Bottom';

$lang->block->mobile->regions->forum_index['top']     = 'Top';
$lang->block->mobile->regions->forum_index['bottom']  = 'Bottom';
$lang->block->mobile->regions->forum_board['top']     = 'Top';
$lang->block->mobile->regions->forum_board['bottom']  = 'Bottom';
$lang->block->mobile->regions->thread_view['top']     = 'Top';
$lang->block->mobile->regions->thread_view['bottom']  = 'Bottom';

$lang->block->mobile->regions->book_browse['top']          = 'Top';
$lang->block->mobile->regions->book_browse['bottom']       = 'Bottom';

$lang->block->mobile->regions->book_read['top']       = 'Top';
$lang->block->mobile->regions->book_read['bottom']    = 'Bottom';

$lang->block->mobile->regions->message_index['top']          = 'Top';
$lang->block->mobile->regions->message_index['bottom']       = 'Bottom';

$lang->block->mobile->regions->page_view['top']          = 'Top';
$lang->block->mobile->regions->page_view['bottom']       = 'Bottom';
