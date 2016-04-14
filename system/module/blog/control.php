<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of blog module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class blog extends control
{
    /** 
     * Browse blog in front.
     * 
     * @param int    $categoryID   the category id
     * @param int    $pageID       current page id
     * @access public
     * @return void
     */
    public function index($categoryID = 0, $pageID = 1)
    {   
        $category = $this->loadModel('tree')->getByID($categoryID, 'blog');

        $recPerPage = !empty($this->config->site->blogRec) ? $this->config->site->blogRec : $this->config->blog->recPerPage;
        $this->app->loadClass('pager', $static = true);
        $pager = new pager(0, $recPerPage, $pageID);

        $categoryID = is_numeric($categoryID) ? $categoryID : $category->id;
        $families   = $categoryID ? $this->tree->getFamily($categoryID, 'blog') : '';
        $articles   = $this->loadModel('article')->getList('blog', $families, 'addedDate_desc', $pager);

        $this->view->title      = $this->lang->blog->common;
        $this->view->categoryID = $categoryID;
        $this->view->articles   = $articles;
        $this->view->sticks     = $this->article->getSticks($families, 'blog');
        $this->view->pager      = $pager;
        $this->view->mobileURL  = helper::createLink('blog', 'index', "categoryID=$categoryID&pageID=$pageID", $category ? "category=$category->alias" : '', 'mhtml');
        $this->view->desktopURL = helper::createLink('blog', 'index', "categoryID=$categoryID&pageID=$pageID", $category ? "category=$category->alias" : '', 'html');
 
        if($category)
        {
            if($category->link) helper::header301($category->link);

            $this->view->category = $category;
            $this->view->title    = $category->name;
            $this->view->keywords = trim($category->keywords . ' ' . $this->config->site->keywords);
            $this->view->desc     = strip_tags($category->desc);
            $this->session->set('articleCategory', $category->id);
        }

        $this->display();
    }
    
    /**
     * View an article.
     * 
     * @param int $articleID 
     * @param int $currentCategory 
     * @access public
     * @return void
     */
    public function view($articleID, $currentCategory = 0)
    {
        $article = $this->loadModel('article')->getByID($articleID);
        if(!$article) die($this->fetch('error', 'index'));

        if($article->link) helper::header301($article->link);

        /* fetch category for display. */
        $category = array_slice($article->categories, 0, 1);
        $category = $category[0]->id;

        $currentCategory = $this->session->articleCategory;
        if($currentCategory > 0 && isset($article->categories[$currentCategory])) $category = $currentCategory;  
        $category = $this->loadModel('tree')->getByID($category);

        $title    = $article->title . ' - ' . $category->name;
        $keywords = $article->keywords . ' ' . $category->keywords . ' ' . $this->config->site->keywords;
        $desc     = strip_tags($article->summary);
        
        $this->view->title       = $title;
        $this->view->keywords    = $keywords;
        $this->view->desc        = $desc;
        $this->view->article     = $article;
        $this->view->prevAndNext = $this->loadModel('article')->getPrevAndNext($article->id, $category->id);
        $this->view->category    = $category;
        $this->view->contact     = $this->loadModel('company')->getContact();
        $this->view->mobileURL   = helper::createLink('blog', 'view', "articleID=$articleID&currentCategory=$currentCategory", "category=$category->alias&name=$article->alias", 'mhtml');
        $this->view->desktopURL  = helper::createLink('blog', 'view', "articleID=$articleID&currentCategory=$currentCategory", "category=$category->alias&name=$article->alias", 'html');

        if($article->source == 'article')
        {
            $copyArticle = $this->article->getByID($article->copyURL);
            $copyArticleCategory = current(array_slice($copyArticle->categories, 0, 1));
            $this->view->sourceURL = helper::createLink('article', 'view', "articleID=$copyArticle->id&categoryID=$copyArticleCategory->id", "category=$copyArticleCategory->alias&name=$copyArticle->alias", 'html');
        }

        $this->dao->update(TABLE_ARTICLE)->set('views = views + 1')->where('id')->eq($articleID)->exec();
        $this->display();
    }
}
