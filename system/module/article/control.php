<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of article module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class article extends control
{
    /** 
     * The index page, locate to the first category or home page if no category.
     * 
     * @access public
     * @return void
     */
    public function index()
    {   
        $category = $this->loadModel('tree')->getFirst('article');
        if($category) $this->locate(inlink('browse', "category=$category->id"));
        $this->locate($this->createLink('index'));
    }   

    /** 
     * Browse article in front.
     * 
     * @param int    $categoryID   the category id
     * @param int    $pageID       current page id
     * @access public
     * @return void
     */
    public function browse($categoryID = 0, $pageID = 1)
    {   
        $category = $this->loadModel('tree')->getByID($categoryID, 'article');

        if($category->link) helper::header301($category->link);

        $recPerPage = !empty($this->config->site->articleRec) ? $this->config->site->articleRec : $this->config->article->recPerPage;
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal = 0, $recPerPage, $pageID);

        $categoryID = is_numeric($categoryID) ? $categoryID : $category->id;
        $families   = $categoryID ? $this->tree->getFamily($categoryID, 'article') : '';
        $sticks     = $this->article->getSticks($families, 'article');
        $articles   = $this->article->getList('article', $families, 'addedDate_desc', $pager);
        $articles   = $sticks + $articles;

        if($category)
        {
            $title    = $category->name;
            $keywords = trim($category->keywords . ' ' . $this->config->site->keywords);
            $desc     = strip_tags($category->desc);
            $this->session->set('articleCategory', $category->id);
        }
        else
        {
            die($this->fetch('error', 'index'));
        }

        $this->view->title      = $title;
        $this->view->keywords   = $keywords;
        $this->view->desc       = $desc;
        $this->view->category   = $category;
        $this->view->articles   = $articles;
        $this->view->pager      = $pager;
        $this->view->contact    = $this->loadModel('company')->getContact();
        $this->view->mobileURL  = helper::createLink('article', 'browse', "categoryID={$category->id}", "category={$category->alias}", 'mhtml');
        $this->view->desktopURL = helper::createLink('article', 'browse', "categoryID={$category->id}", "category={$category->alias}", 'html');

        $this->display();
    }
    
    /**
     * Browse article in admin.
     * 
     * @param string $type        the article type
     * @param int    $categoryID  the category id
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function admin($type = 'article', $categoryID = 0, $orderBy = '`id` desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {   
        if($this->get->tab == 'user') 
        {
            $type = 'submittion';
            $this->lang->menuGroups->article = 'submittion';
            unset($this->lang->article->menu);
            $this->view->title = $this->lang->submittion->common;
        }
        else
        {
            $this->lang->article->menu = $this->lang->$type->menu;
            $this->lang->menuGroups->article = $type;
            $this->view->title = $this->lang->$type->common;
        }

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $families = $categoryID ? $this->loadModel('tree')->getFamily($categoryID, $type) : '';
        $sticks   = $this->get->tab != 'feedback' ? $this->article->getSticks($families, $type) : array();
        $articles = $this->article->getList($type, $families, $orderBy, $pager);
        $articles = $sticks + $articles;

        if($type != 'page' and $type != 'submittion') 
        {
            $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink =  html::a(helper::createLink('tree', 'browse', "type={$type}"), $this->lang->tree->manage);
        }

        $this->view->type       = $type;
        $this->view->categoryID = $categoryID;
        $this->view->articles   = $articles;
        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;

        $this->display();
    }   

    /**
     * Create an article.
     * 
     * @param  string $type 
     * @param  int    $categoryID
     * @access public
     * @return void
     */
    public function create($type = 'article', $categoryID = '')
    {
        $this->lang->article->menu = $this->lang->{$type}->menu;
        $this->lang->menuGroups->article = $type;

        $categories = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        if(empty($categories) && $type != 'page')
        {
            die(js::locate($this->createLink('tree', 'redirect', "type=$type")));
        }

        if($_POST)
        {
            $this->article->create($type);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            if(RUN_MODE == 'front') $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('submittion')));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin', "type=$type")));
        }

        if($type != 'page') 
        {
            $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type={$type}"), $this->lang->tree->manage);
        }
        $maxID = $this->dao->select('max(id) as maxID')->from(TABLE_ARTICLE)->fetch('maxID');

        $this->view->title           = $this->lang->{$type}->create;
        $this->view->currentCategory = $categoryID;
        $this->view->categories      = $categories ;
        $this->view->order           = $maxID + 1;
        $this->view->type            = $type;

        $this->display();
    }

    /**
     * Create an submittion.
     * 
     * @param  string $type 
     * @param  int    $categoryID
     * @access public
     * @return void
     */
    public function post()
    {
        if(!commonModel::isAvailable('submittion')) die();
        if($_POST)
        {
            $this->article->create('submittion');
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            if(RUN_MODE == 'front') $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('submittion')));
        }

        $this->view->title = $this->lang->article->create;
        $this->display();
    }

    /**
     * edit an submittion.
     * 
     * @param  string $type 
     * @param  int    $categoryID
     * @access public
     * @return void
     */
    public function modify($articleID)
    {
        if(!commonModel::isAvailable('submittion')) die();
        $article = $this->article->getByID($articleID);
        if(RUN_MODE == 'front' and $article->addedBy != $this->app->user->account) return false;

        if($_POST)
        {
            $this->article->update($articleID, 'submittion');
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('submittion')));
        }

        $this->view->title      = $this->lang->article->edit;
        $this->view->article    = $article;
        $this->display();
    }

    /**
     * check submittion.
     * 
     * @param  int    $id 
     * @access public
     * @return void
     */
    public function check($id)
    {
        if($_POST)
        {
            $type = $this->post->type;
            $categories = $type == 'article' ? $this->post->articleCategories : $this->post->blogCategories;
            if(empty($categories))$this->send(array('result' => 'fail', 'message' => $this->lang->article->categoryEmpty));
            $result = $this->article->approve($id, $type, $categories);
            if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type=submittion&tab=feedback")));
        }

        $this->lang->article->menu       = $this->lang->feedback->menu;
        $this->lang->menuGroups->article = 'feedback';
        
        $this->view->title             = $this->lang->submittion->check;
        $this->view->article           = $this->article->getByID($id);
        $this->view->articleCategories = $this->loadModel('tree')->getOptionMenu('article', 0, $removeRoot = true);
        $this->view->blogCategories    = $this->loadModel('tree')->getOptionMenu('blog', 0, $removeRoot = true);
        $this->display();

    }

    /**
     * Edit an article.
     * 
     * @param  int    $articleID 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function edit($articleID, $type)
    {
        $this->lang->article->menu = $this->lang->$type->menu;
        $this->lang->menuGroups->article = $type;

        $article  = $this->article->getByID($articleID, $replaceTag = false);

        $categories = $this->loadModel('tree')->getOptionMenu($type, 0, $removeRoot = true);
        if(empty($categories) && $type != 'page')
        {
            die(js::alert($this->lang->tree->noCategories) . js::locate($this->createLink('tree', 'browse', "type=$type")));
        }

        if($_POST)
        {
            $this->article->update($articleID, $type);
            if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type=$type")));
        }

        if($type != 'page') 
        {
            $this->view->treeModuleMenu = $this->loadModel('tree')->getTreeMenu($type, 0, array('treeModel', 'createAdminLink'));
            $this->view->treeManageLink = html::a(helper::createLink('tree', 'browse', "type={$type}"), $this->lang->tree->manage);
        }

        $this->view->title      = $this->lang->$type->edit;
        $this->view->article    = $article;
        $this->view->categories = $categories;
        $this->view->type       = $type;
        $this->display();
    }

    /**
     * View an article.
     * 
     * @param int $articleID 
     * @access public
     * @return void
     */
    public function view($articleID)
    {
        $article  = $this->article->getByID($articleID);
        if(!$article) die($this->fetch('error', 'index'));

        if($article->link)
        {
            $this->dao->update(TABLE_ARTICLE)->set('views = views + 1')->where('id')->eq($articleID)->exec();
            helper::header301($article->link);
        }

        /* fetch category for display. */
        $category = array_slice($article->categories, 0, 1);
        $category = $category[0]->id;

        $currentCategory = $this->session->articleCategory;
        if($currentCategory > 0)
        {
            if(isset($article->categories[$currentCategory]))
            {
                $category = $currentCategory;  
            }
            else
            {
                foreach($article->categories as $articleCategory)
                {
                    if(strpos($articleCategory->path, $currentCategory)) $category = $articleCategory->id;
                }
            }
        }

        $category = $this->loadModel('tree')->getByID($category);
        $this->session->set('articleCategory', $category->id);

        $title    = $article->title . ' - ' . $category->name;
        $keywords = $article->keywords . ' ' . $category->keywords . ' ' . $this->config->site->keywords;
        $desc     = strip_tags($article->summary);
        
        $this->view->title       = $title;
        $this->view->keywords    = $keywords;
        $this->view->desc        = $desc;
        $this->view->article     = $article;
        $this->view->prevAndNext = $this->article->getPrevAndNext($article->id, $category->id);
        $this->view->category    = $category;
        $this->view->contact     = $this->loadModel('company')->getContact();
        $this->view->mobileURL   = helper::createLink('article', 'view', "articleID={$article->id}", "category={$category->alias}&name={$article->alias}", 'mhtml');
        $this->view->desktopURL  = helper::createLink('article', 'view', "articleID={$article->id}", "category={$category->alias}&name={$article->alias}", 'html');

        $this->dao->update(TABLE_ARTICLE)->set('views = views + 1')->where('id')->eq($articleID)->exec();

        $this->display();
    }

    /**
     * Delete an article.
     * 
     * @param  int      $articleID 
     * @access public
     * @return void
     */
    public function delete($articleID)
    {
        if($this->article->delete($articleID)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Set css.
     * 
     * @param  int      $articleID 
     * @access public
     * @return void
     */
    public function setCss($articleID)
    {
        $article = $this->article->getByID($articleID);
        if($_POST)
        {
            if($this->article->setCss($articleID)) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type={$article->type}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->article->css;
        $this->view->article = $article;
        $this->display();
    }


    /**
     * Set js.
     * 
     * @param  int      $articleID 
     * @access public
     * @return void
     */
    public function setJs($articleID)
    {
        $article = $this->article->getByID($articleID);
        if($_POST)
        {
            if($this->article->setJs($articleID)) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type={$article->type}")));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title   = $this->lang->article->js;
        $this->view->article = $article;
        $this->display();
    }

    /**
     * Stick an article.
     * 
     * @param  int    $articleID 
     * @param  int    $stick 
     * @access public
     * @return void
     */
    public function stick($articleID, $stick)
    {
        $article = $this->article->getByID($articleID);

        $this->dao->update(TABLE_ARTICLE)->set('sticky')->eq($stick)->where('id')->eq($articleID)->exec();
        if(dao::isError()) $this->send(array('result' =>'fail', 'message' => dao::getError()));

        $message = $stick == 0 ? $this->lang->article->successUnstick : $this->lang->article->successStick;
        $this->send(array('result' => 'success', 'message' => $message, 'locate' => inlink('admin', "type={$article->type}")));
    }

    /**
     * Forward an article to blog. 
     * 
     * @param  int    $articleID 
     * @access public
     * @return void
     */
    public function forward2Blog($articleID)
    {
        $categories = $this->loadModel('tree')->getOptionMenu('blog', 0, $removeRoot = true);

        if($_POST)
        {
            $result = $this->article->forward2Blog($articleID);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->title      = $this->lang->article->forward2Blog;
        $this->view->categories = $categories;
        $this->view->articleID  = $articleID;
        $this->display();
    }
    
    /**
     * Forward an article to forum. 
     * 
     * @param  int    $articleID 
     * @access public
     * @return void
     */
    public function forward2Forum($articleID)
    {
        $categories = $this->loadModel('tree')->getOptionMenu('forum', 0, $removeRoot = true);
        if($_POST)
        {
            $result = $this->article->forward2Forum($articleID);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $parents = $this->dao->select('*')->from(TABLE_CATEGORY)->where('parent')->eq(0)->andWhere('type')->eq('forum')->fetchAll('id');

        $this->view->title      = $this->lang->article->forward2Forum;
        $this->view->parents    = array_keys($parents);
        $this->view->categories = $categories;
        $this->view->articleID  = $articleID;
        $this->display();
    }

    /**
     * Manage article submittion.
     * 
     * @access public
     * @return void
     */
    public function submittion($orderBy = 'id_desc', $recTotal = 0, $recPerPage = 20, $pageID = 1)
    {
        if(!commonModel::isAvailable('submittion')) die();
        $this->app->loadLang('user');

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $articles = $this->dao->select('*')->from(TABLE_ARTICLE)
            ->where('submittion')->ne(0)
            ->andWhere('addedBy')->eq($this->app->user->account)
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchall('id'); 
        
        $this->view->title    = $this->lang->user->submittion;
        $this->view->articles = $articles;

        $this->view->pager      = $pager;
        $this->view->orderBy    = $orderBy;

        $this->view->mobileURL  = helper::createLink('article', 'submittion', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('article', 'submittion', '', '', 'html');
        $this->display();
    }

    /**
     * Reject an article.
     * 
     * @param  int    $articleID 
     * @access public
     * @return void
     */
    public function reject($articleID)
    {
        $result = $this->article->reject($articleID);
        if(!$result) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin', "type=submittion&tab=feedback")));
    }
}
