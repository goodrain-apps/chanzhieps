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
$lang->block->default->typeList['html']     = 'Html block';
$lang->block->default->typeList['htmlcode'] = 'Html codes';
$lang->block->default->typeList['phpcode']  = 'php codes';

$lang->block->default->typeList['latestArticle'] = 'Latest Articles';
$lang->block->default->typeList['hotArticle']    = 'Hot Articles';

$lang->block->default->typeList['latestBlog']      = 'Latest Blogs';
$lang->block->default->typeList['latestThread']    = 'Latest Threads';

$lang->block->default->typeList['latestProduct']   = 'Latest Products';
$lang->block->default->typeList['featuredProduct'] = 'Featured Products';
$lang->block->default->typeList['hotProduct']      = 'Hot Products';

$lang->block->default->typeList['pageList']        = 'Page List';

$lang->block->default->typeList['articleTree'] = 'Article Categories';
$lang->block->default->typeList['productTree'] = 'Product Categories';
$lang->block->default->typeList['blogTree']    = 'Blog Categories';

$lang->block->default->typeList['contact']   = 'Contact';
$lang->block->default->typeList['followUs']  = 'Follow Us';
$lang->block->default->typeList['about']     = 'About';
$lang->block->default->typeList['links']     = 'Links';
$lang->block->default->typeList['slide']     = 'Slide';
$lang->block->default->typeList['header']    = 'Header';

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

$lang->block->default->pages['all']            = 'All';
$lang->block->default->pages['index_index']    = 'Home';
$lang->block->default->pages['company_index']  = 'About Us';

$lang->block->default->pages['article_browse'] = 'Browse article page';
$lang->block->default->pages['article_view']   = 'View article page';

$lang->block->default->pages['product_browse'] = 'Browse product page';
$lang->block->default->pages['product_view']   = 'View product page';

$lang->block->default->pages['blog_index']     = 'Browse blog page';
$lang->block->default->pages['blog_view']      = 'View blog page';

$lang->block->default->pages['forum_index']    = 'Forum home';
$lang->block->default->pages['forum_board']    = 'Forum board';
$lang->block->default->pages['thread_view']    = 'View thread';
$lang->block->default->pages['search_list']    = 'Search';

$lang->block->default->pages['book_index']     = 'Book';
$lang->block->default->pages['book_browse']    = 'Book catalogue';
$lang->block->default->pages['book_read']      = 'Book content';

$lang->block->default->pages['message_index']  = 'Inquire';

$lang->block->default->pages['page_view']      = 'Page';

/* page layou>default-> list. */
$lang->block->default->regions = new stdclass();
$lang->block->default->regions->all['header'] = 'Header(invisible)';
$lang->block->default->regions->all['top']    = 'Top';
$lang->block->default->regions->all['banner'] = 'Banner';
$lang->block->default->regions->all['bottom'] = 'Bottom';
$lang->block->default->regions->all['footer'] = 'Footer(invisible)';

$lang->block->default->regions->index_index['top']     = 'Top';
$lang->block->default->regions->index_index['middle']  = 'Middle';
$lang->block->default->regions->index_index['bottom']  = 'Bottom';

$lang->block->default->regions->company_index['topBanner']    = 'TopBanner';
$lang->block->default->regions->company_index['top']          = 'Top';
$lang->block->default->regions->company_index['bottom']       = 'Bottom';
$lang->block->default->regions->company_index['side']         = 'Side';
$lang->block->default->regions->company_index['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->article_browse['topBanner']    = 'TopBanner';
$lang->block->default->regions->article_browse['top']          = 'Top';
$lang->block->default->regions->article_browse['bottom']       = 'Bottom';
$lang->block->default->regions->article_browse['side']         = 'Side';
$lang->block->default->regions->article_browse['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->article_view['topBanner']    = 'TopBanner';
$lang->block->default->regions->article_view['top']          = 'Top';
$lang->block->default->regions->article_view['bottom']       = 'Bottom';
$lang->block->default->regions->article_view['side']         = 'Side';
$lang->block->default->regions->article_view['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->product_browse['topBanner']    = 'TopBanner';
$lang->block->default->regions->product_browse['top']          = 'Top';
$lang->block->default->regions->product_browse['bottom']       = 'Bottom';
$lang->block->default->regions->product_browse['side']         = 'Side';
$lang->block->default->regions->product_browse['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->product_view['topBanner']    = 'TopBanner';
$lang->block->default->regions->product_view['top']          = 'Top';
$lang->block->default->regions->product_view['bottom']       = 'Bottom';
$lang->block->default->regions->product_view['side']         = 'Side';
$lang->block->default->regions->product_view['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->blog_index['topBanner']    = 'TopBanner';
$lang->block->default->regions->blog_index['top']          = 'Top';
$lang->block->default->regions->blog_index['bottom']       = 'Bottom';
$lang->block->default->regions->blog_index['side']         = 'Side';
$lang->block->default->regions->blog_index['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->blog_view['topBanner']    = 'TopBanner';
$lang->block->default->regions->blog_view['top']          = 'Top';
$lang->block->default->regions->blog_view['bottom']       = 'Bottom';
$lang->block->default->regions->blog_view['side']         = 'Side';
$lang->block->default->regions->blog_view['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->forum_index['top']     = 'Top';
$lang->block->default->regions->forum_index['bottom']  = 'Bottom';
$lang->block->default->regions->forum_board['top']     = 'Top';
$lang->block->default->regions->forum_board['bottom']  = 'Bottom';
$lang->block->default->regions->thread_view['top']     = 'Top';
$lang->block->default->regions->thread_view['bottom']  = 'Bottom';

$lang->block->default->regions->book_browse['topBanner']    = 'TopBanner';
$lang->block->default->regions->book_browse['top']          = 'Top';
$lang->block->default->regions->book_browse['bottom']       = 'Bottom';
$lang->block->default->regions->book_browse['side']         = 'Side';
$lang->block->default->regions->book_browse['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->book_read['top']       = 'Top';
$lang->block->default->regions->book_read['bottom']    = 'Bottom';

$lang->block->default->regions->message_index['topBanner']    = 'TopBanner';
$lang->block->default->regions->message_index['top']          = 'Top';
$lang->block->default->regions->message_index['bottom']       = 'Bottom';
$lang->block->default->regions->message_index['side']         = 'Side';
$lang->block->default->regions->message_index['bottomBanner'] = 'BottomBanner';

$lang->block->default->regions->page_view['topBanner']    = 'TopBanner';
$lang->block->default->regions->page_view['top']          = 'Top';
$lang->block->default->regions->page_view['bottom']       = 'Bottom';
$lang->block->default->regions->page_view['side']         = 'Side';
$lang->block->default->regions->page_view['bottomBanner'] = 'BottomBanner';

$lang->block->headerLayout = new stdclass();
$lang->block->headerLayout->compatibleEnable  = 'Compatible old header';

$lang->block->headerLayout->nav = array();
$lang->block->headerLayout->nav['besideLogo'] = 'Right of logo';
$lang->block->headerLayout->nav['row']        = 'A whole row';

$lang->block->headerLayout->slogan = array();
$lang->block->headerLayout->slogan['besideLogo'] = 'Right of Logo';
$lang->block->headerLayout->slogan['topLeft']    = 'Top left';

$lang->block->headerLayout->searchbar = array();
$lang->block->headerLayout->searchbar['besideSlogan'] = 'Right of slogan';
$lang->block->headerLayout->searchbar['topRight']     = 'Top right';
$lang->block->headerLayout->searchbar['insideNav']    = 'Right of navigation';
