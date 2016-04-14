<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of article module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class articleModel extends model
{
    /** 
     * Get an article by id.
     * 
     * @param  int      $articleID 
     * @param  bool     $replaceTag 
     * @access public
     * @return bool|object
     */
    public function getByID($articleID, $replaceTag = true)
    {   
        /* Get article self. */
        $article = $this->dao->select('*')->from(TABLE_ARTICLE)->where('alias')->eq($articleID)->fetch();
        if(!$article) $article = $this->dao->select('*')->from(TABLE_ARTICLE)->where('id')->eq($articleID)->fetch();

        if(!$article) return false;
        
        /* Add link to content if necessary. */
        if($replaceTag) $article->content = $this->loadModel('tag')->addLink($article->content);

        /* Get it's categories. */
        $article->categories = $this->dao->select('t2.*')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t1.type')->eq($article->type)
            ->andWhere('t1.id')->eq($articleID)
            ->fetchAll('id');

        /* Get article path to highlight main nav. */
        $path = '';
        foreach($article->categories as $category) $path .= $category->path;
        $article->path = explode(',', trim($path, ','));

        /* Get it's files. */
        $article->files = $this->loadModel('file')->getByObject($article->type, $articleID);

        return $article;
    }   

    /**
     * Get page by ID.
     * 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function getPageByID($pageID)
    {
        /* Get article self. */
        $page = $this->dao->select('*')->from(TABLE_ARTICLE)->where('alias')->eq($pageID)->andWhere('type')->eq('page')->fetch();
        if(!$page) $page = $this->dao->select('*')->from(TABLE_ARTICLE)->where('id')->eq($pageID)->fetch();

        if(!$page) return false;
        
        /* Add link to content if necessary. */
        $page->content = $this->loadModel('tag')->addLink($page->content);
        
        /* Get it's files. */
        $page->files = $this->loadModel('file')->getByObject('page', $page->id);

        return $page;
    }

    /** 
     * Get article list.
     *
     * @param  string  $type 
     * @param  array   $categories 
     * @param  string  $orderBy 
     * @param  object  $pager 
     * @access public
     * @return array
     */
    public function getList($type, $categories, $orderBy, $pager = null)
    {
        $searchWord = $this->get->searchWord;
        $categoryID = $this->get->categoryID;
        if($type == 'page')
        {
            $articles = $this->dao->select('*')->from(TABLE_ARTICLE)
                ->where('type')->eq('page')
                ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
                ->andWhere('addedDate')->le(helper::now())
                ->andWhere('status')->eq('normal')
                ->fi()
                ->beginIf($searchWord)
                ->andWhere('title')->like("%{$searchWord}%")
                ->orWhere('keywords')->like("%{$searchWord}%")->andWhere('type')->eq($type)
                ->orWhere('summary')->like("%{$searchWord}%")->andWhere('type')->eq($type)
                ->orWhere('content')->like("%{$searchWord}%")->andWhere('type')->eq($type)
                ->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll('id');
        }
        elseif($type == 'submittion')
        {
            $articles = $this->dao->select('*')->from(TABLE_ARTICLE)
                ->where('submittion')->ne(0)
                ->beginIf(RUN_MODE == 'front')
                ->andWhere('addedBy')->eq($this->app->user->account)
                ->fi()
                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll('id');
        }
        else
        {
            /*Get articles containing the search word (use groupBy to distinct articles).  */
            $articleIdList = $this->dao->select('id')->from(TABLE_RELATION)
                ->where('type')->eq($type)
                ->andWhere('category')->in($categories)
                ->fetchAll('id');

            $articles = $this->dao->select('*')->from(TABLE_ARTICLE)
                ->where('type')->eq($type)
                ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
                ->andWhere('addedDate')->le(helper::now())
                ->andWhere('status')->eq('normal')
                ->fi()
                ->beginIf(!empty($categories))->andWhere('id')->in(array_keys($articleIdList))->fi()

                ->beginIf($searchWord)
                ->andWhere('title', true)->like("%{$searchWord}%")
                ->orWhere('keywords')->like("%{$searchWord}%")
                ->orWhere('summary')->like("%{$searchWord}%")
                ->orWhere('content')->like("%{$searchWord}%")
                ->markRight(1)
                ->fi()

                ->orderBy($orderBy)
                ->page($pager)
                ->fetchAll('id');
        }
        if(!$articles) return array();

        return $this->processArticleList($articles, $type);
    }

    /**
     * Get page pairs.
     * 
     * @param string $pager 
     * @access public
     * @return array
     */
    public function getPagePairs($pager = null)
    {
        return $this->dao->select('id, title')->from(TABLE_ARTICLE)
            ->where('type')->eq('page')
            ->andWhere('addedDate')->le(helper::now())
            ->andWhere('status')->eq('normal')
            ->orderBy('id_desc')
            ->page($pager, false)
            ->fetchPairs();
    }

    /**
     * Get article pairs.
     * 
     * @param string $modules 
     * @param string $orderBy 
     * @param string $pager 
     * @access public
     * @return array
     */
    public function getPairs($categories, $orderBy, $pager = null)
    {
        return $this->dao->select('t1.id, t1.title, t1.alias')->from(TABLE_ARTICLE)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
            ->where('1=1')
            ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
            ->andWhere('t1.addedDate')->le(helper::now())
            ->andWhere('t1.status')->eq('normal')
            ->fi()
            ->beginIF($categories)->andWhere('t2.category')->in($categories)->fi()
            ->orderBy($orderBy)
            ->page($pager, false)
            ->fetchAll('id');
    }

    /**
     * get hot articles. 
     *
     * @param string|array    $categories
     * @param int             $count
     * @param string          $type
     * @access public
     * @return array
     */
    public function getHot($categories, $count, $type = 'article')
    {
        $family = array();
        $this->loadModel('tree');

        if(!is_array($categories)) $categories = explode(',', $categories);
        foreach($categories as $category) $family = array_merge($family, $this->tree->getFamily($category));

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList($type, $family, 'sticky_desc, views_desc', $pager);
    }

    /**
     * get latest articles. 
     *
     * @param string|array     $categories
     * @param int              $count
     * @param string           $type
     * @access public
     * @return array
     */
    public function getLatest($categories, $count, $type = 'article')
    {
        $family = array();
        $this->loadModel('tree');

        if(!is_array($categories)) $categories = explode(',', $categories);
        foreach($categories as $category) $family = array_merge($family, $this->tree->getFamily($category));

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList($type, $family, 'sticky_desc, addedDate_desc', $pager);
    }

    /**
     * Get page list. 
     *
     * @param int              $count
     * @param string           $type
     * @access public
     * @return array
     */
    public function getPageList($count)
    {
        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList('page', '', '`order` desc', $pager);
    }

    /**
     * Get stick articles.
     * 
     * @param  mix    $categories 
     * @access public
     * @return array
     */
    public function getSticks($categories, $type)
    { 
        $sticks = $this->dao->select('t1.*, t2.category')->from(TABLE_ARTICLE)->alias('t1')
                ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
                ->where('t1.sticky')->ne(0)
                ->andWhere('t2.type')->eq($type)
                ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
                ->andWhere('t1.addedDate')->le(helper::now())
                ->andWhere('t1.status')->eq('normal')
                ->fi()
                ->beginIf($categories)->andWhere('t2.category')->in($categories)->fi()
                ->orderBy('t1.sticky_desc, t1.addedDate_desc')
                ->fetchAll('id');

        if(!$sticks) return array();

        return $this->processArticleList($sticks, $type);
    }

    /**
     * Process article list.
     * 
     * @param  array    $articles 
     * @param  string   $type 
     * @access public
     * @return array
     */
    public function processArticleList($articles, $type)
    {
        $categories = $this->dao->select('t2.id, t2.name, t2.abbr, t2.alias, t1.id AS article')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t2.type')->eq($type)
            ->andWhere('t1.id')->in(array_keys($articles))
            ->fetchGroup('article', 'id');

        /* Assign categories to it's article. */
        foreach($articles as $article)
        {
            $article->categories = isset($categories[$article->id]) ? $categories[$article->id] : array();
            $article->category   = current($article->categories);
        }

        /* Get images for these articles. */
        $images = $this->loadModel('file')->getByObject($type, array_keys($articles), $isImage = true);

        /* Assign images to it's article. */
        foreach($articles as $article)
        {
            if(empty($images[$article->id])) continue;

            $article->image = new stdclass();
            $article->image->list    = $images[$article->id];
            $article->image->primary = $article->image->list[0];
        }

        /* Assign summary to it's article. */
        foreach($articles as $article) $article->summary = empty($article->summary) ? helper::substr(strip_tags($article->content), 200, '...') : $article->summary;

        /* Assign comments to it's article. */
        $articleIdList = array_keys($articles);
        $comments = $this->dao->select("objectID, count(*) as count")->from(TABLE_MESSAGE)
            ->where('type')->eq('comment')
            ->andWhere('objectType')->eq('article')
            ->andWhere('objectID')->in($articleIdList)
            ->andWhere('status')->eq(1)
            ->groupBy('objectID')
            ->fetchPairs('objectID', 'count');
        foreach($articles as $article) $article->comments = isset($comments[$article->id]) ? $comments[$article->id] : 0;
 
        return $articles;
    }

    /**
     * Get the prev and next ariticle.
     * 
     * @param  int    $current  the current article id.
     * @param  int    $category the category id.
     * @access public
     * @return array
     */
    public function getPrevAndNext($current, $category)
    {
        $current = $this->getByID($current);
        $prev = $this->dao->select('t1.id, title, alias')->from(TABLE_ARTICLE)->alias('t1')
           ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
           ->where('t2.category')->eq($category)
           ->andWhere('t1.status')->eq('normal')
           ->andWhere('t1.addedDate')->lt($current->addedDate)
           ->orderBy('t1.addedDate_desc')
           ->limit(1)
           ->fetch();

       $next = $this->dao->select('t1.id, title, alias')->from(TABLE_ARTICLE)->alias('t1')
           ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
           ->where('t2.category')->eq($category)
           ->andWhere('t1.addedDate')->le(helper::now())
           ->andWhere('t1.status')->eq('normal')
           ->andWhere('t1.addedDate')->gt($current->addedDate)
           ->orderBy('t1.addedDate')
           ->limit(1)
           ->fetch();

        return array('prev' => $prev, 'next' => $next);
    }

    /**
     * Create an article.
     * 
     * @param  string $type 
     * @access public
     * @return int|bool
     */
    public function create($type)
    {
        $now = helper::now();
        $article = fixer::input('post')
            ->join('categories', ',')
            ->setDefault('addedDate', $now)
            ->add('editedDate', $now)
            ->add('type', $type)
            ->add('addedBy', $this->app->user->account)
            ->setIF(!$this->post->isLink, 'link', '')
            ->setIF(RUN_MODE == 'front', 'submittion', 1)
            ->stripTags('content,link', $this->config->allowedTags->admin)
            ->get();

        $article->keywords = seo::unify($article->keywords, ',');
        if(!empty($article->alias)) $article->alias = seo::unify($article->alias, '-');
        $article->content = $this->rtrimContent($article->content);

        $this->dao->insert(TABLE_ARTICLE)
            ->data($article, $skip = 'categories,uid,isLink')
            ->autoCheck()
            ->batchCheckIF($type != 'page' and $type != 'submittion' and !$this->post->isLink, $this->config->article->require->create, 'notempty')
            ->batchCheckIF($type == 'submittion', $this->config->article->require->post, 'notempty')
            ->batchCheckIF($type == 'page' and !$this->post->isLink, $this->config->article->require->page, 'notempty')
            ->batchCheckIF($type != 'page' and $this->post->isLink, $this->config->article->require->link, 'notempty')
            ->batchCheckIF($type == 'page' and $this->post->isLink, $this->config->article->require->pageLink, 'notempty')
            ->checkIF(($type == 'page') and $this->post->alias, 'alias', 'unique', "type='page'")
            ->exec();
        $articleID = $this->dao->lastInsertID();
        $this->loadModel('file')->updateObjectID($this->post->uid, $articleID, $type); 
        $this->file->copyFromContent($this->post->content, $articleID, $type);

        if(dao::isError()) return false;

        /* Save article keywords. */
        $this->loadModel('tag')->save($article->keywords);
        if($type != 'page' and $type != 'submittion') $this->processCategories($articleID, $type, $this->post->categories);

        if($article->submittion == 0)
        {
            $article = $this->getByID($articleID);
            $this->loadModel('search')->save($type, $article);
        }

        return $articleID;
    }

    /**
     * forward an article to blog. 
     * 
     * @param  int    $articleID 
     * @access public
     * @return bool 
     */
    public function forward2Blog($articleID)
    {
        if(!commonModel::isAvailable('blog')) return false;
        $blog = $this->dao->select('*')->from(TABLE_ARTICLE)->where('alias')->eq($articleID)->fetch();
        if(!$blog) $blog = $this->dao->select('*')->from(TABLE_ARTICLE)->where('id')->eq($articleID)->fetch();

        if(!$blog) return false;
        
        $blog->source     = 'article';
        $blog->type       = 'blog';
        $blog->categories = $this->post->categories;
        $blog->copyURL    = $articleID; 
        $blog->author     = $this->app->user->account;
        $blog->addedDate  = $this->post->addedDate ? $this->post->addedDate : helper::now();
        $blog->editedDate = $blog->addedDate;
        $blog->views      = 0;
        $blog->sticky     = 0;

        $this->dao->insert(TABLE_ARTICLE)->data($blog, $skip='id,categories')->autoCheck()->batchCheck($this->config->article->require->forward2Blog, 'notempty')->exec();
        $blogID = $this->dao->lastInsertID();
        
        $files = $this->dao->select('*')->from(TABLE_FILE)->where('objectID')->eq($articleID)->andWhere('objectType')->eq('article')->fetchAll();
        foreach($files as $file)
        {
            $file->objectType = 'blog';
            $file->objectID   = $blogID;
            $file->downloads  = 0;
            $this->dao->insert(TABLE_FILE)->data($file, $skip='id')->autoCheck()->exec();
        }

        if(dao::isError()) return false;

        /* Save blog keywords. */
        $this->loadModel('tag')->save($blog->keywords);
        $this->processCategories($blogID, 'blog', $this->post->categories);

        $blog = $this->getByID($blogID);
        return $this->loadModel('search')->save('blog', $blog);
    }
    
    /**
     * Forward an article to forum. 
     * 
     * @param  int    $articleID 
     * @access public
     * @return bool 
     */
    public function forward2Forum($articleID)
    {
        if(!commonModel::isAvailable('forum')) return false;
        $article  = $this->getByID($articleID);
        $category = current($article->categories);
        $address  = $this->loadModel('common')->getSysURL() . $this->createPreviewLink($articleID);

        $thread = $this->dao->select('*')->from(TABLE_ARTICLE)->where('alias')->eq($articleID)->fetch();
        if(!$thread) $thread = $this->dao->select('title, content')->from(TABLE_ARTICLE)->where('id')->eq($articleID)->fetch();

        if(!$thread) return false;
        
        $thread->board       = $this->post->board;
        $thread->author      = $this->app->user->realname;
        $thread->content    .= "<br><br><div style='text-align: right'>" . $this->lang->article->forwardFrom . ' ' . html::a($address, $address) . '</div>';
        $thread->addedDate   = $this->post->addedDate ? $this->post->addedDate : helper::now();
        $thread->editedDate  = $thread->addedDate;
        $thread->repliedDate = $thread->addedDate;

        $this->dao->insert(TABLE_THREAD)->data($thread)->autoCheck()->batchCheck($this->config->article->require->forward2Forum, 'notempty')->exec();
            
        $threadID = $this->dao->lastInsertID();
        $thread   = $this->loadModel('thread')->getByID($threadID);
        if(dao::isError()) return false;

        $files = $this->dao->select('*')->from(TABLE_FILE)->where('objectID')->eq($articleID)->andWhere('objectType')->eq('article')->fetchAll();
        foreach($files as $file)
        {
            $file->objectType = 'thread';
            $file->objectID   = $threadID;
            $this->dao->insert(TABLE_FILE)->data($file, $skip='id')->autoCheck()->exec();
        }
        if(dao::isError()) return false;

        $this->loadModel('search')->save('thread', $thread);

        return !dao::isError(); 
    }
    /**
     * Update an article.
     * 
     * @param string   $articleID 
     * @access public
     * @return void
     */
    public function update($articleID, $type = 'article')
    {
        $article  = $this->getByID($articleID);
        $category = array_keys($article->categories);

        $article = fixer::input('post')
            ->stripTags('content,link', $this->config->allowedTags->admin)
            ->join('categories', ',')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->setIF(!$this->post->isLink, 'link', '')
            ->get();

        $article->keywords = seo::unify($article->keywords, ',');
        if(!empty($article->alias)) $article->alias = seo::unify($article->alias, '-');
        $article->content  = $this->rtrimContent($article->content);

        $this->dao->update(TABLE_ARTICLE)
            ->data($article, $skip = 'categories,uid,isLink')
            ->autoCheck()
            ->batchCheckIF($type == 'submittion', $this->config->article->require->post, 'notempty')
            ->batchCheckIF($type != 'page' and $type != 'submittion' and !$this->post->isLink, $this->config->article->require->edit, 'notempty')
            ->batchCheckIF($type == 'page' and !$this->post->isLink, $this->config->article->require->page, 'notempty')
            ->batchCheckIF($type != 'page' and $this->post->isLink, $this->config->article->require->link, 'notempty')
            ->batchCheckIF($type == 'page' and $this->post->isLink, $this->config->article->require->pageLink, 'notempty')
            ->checkIF(($type == 'page') and $this->post->alias, 'alias', 'unique', "type='page' and id<>{$articleID}")
            ->where('id')->eq($articleID)
            ->exec();

        $this->loadModel('file')->updateObjectID($this->post->uid, $articleID, $type);
        $this->file->copyFromContent($this->post->content, $articleID, $type);

        if(dao::isError()) return false;

        $this->loadModel('tag')->save($article->keywords);
        if($type != 'page' and $type != 'submittion') $this->processCategories($articleID, $type, $this->post->categories);

        if(dao::isError()) return false;

        $article = $this->getByID($articleID);
        if(empty($article)) return false;
        if($type = 'submittion') return true;
        return $this->loadModel('search')->save($type, $article);
    }
        
    /**
     * Delete an article.
     * 
     * @param  int      $articleID 
     * @access public
     * @return void
     */
    public function delete($articleID, $null = null)
    {
        $article = $this->getByID($articleID);
        if(!$article) return false;
        if(RUN_MODE == 'front' and $article->addedBy != $this->app->user->account) die();
        /* If this article is a submittion and has been adopt, front cannot delete it.*/
        if(RUN_MODE == 'front' and $article->submittion == 2) die();

        $this->dao->delete()->from(TABLE_RELATION)->where('id')->eq($articleID)->andWhere('type')->eq($article->type)->exec();
        $this->dao->delete()->from(TABLE_ARTICLE)->where('id')->eq($articleID)->exec();
        return $this->loadModel('search')->deleteIndex($article->type, $articleID);
    }

    /**
     * Process categories for an article.
     * 
     * @param  int    $articleID 
     * @param  string $tree
     * @param  array  $categories 
     * @access public
     * @return void
     */
    public function processCategories($articleID, $type = 'article', $categories = array())
    {
       if(!$articleID) return false;

       /* First delete all the records of current article from the releation table.  */
       $this->dao->delete()->from(TABLE_RELATION)
           ->where('type')->eq($type)
           ->andWhere('id')->eq($articleID)
           ->autoCheck()
           ->exec();

       /* Then insert the new data. */
       foreach($categories as $category)
       {
           if(!$category) continue;

           $data = new stdclass();
           $data->type     = $type; 
           $data->id       = $articleID;
           $data->category = $category;
           $this->dao->insert(TABLE_RELATION)->data($data)->exec();
       }
    }

    /**
     * Create preview link. 
     * 
     * @param  int    $articleID 
     * @access public
     * @return string
     */
    public function createPreviewLink($articleID, $viewType = '')
    {
        $article = $this->getByID($articleID);
        if(empty($article)) return null;
        $module  = $article->type;
        $param   = "articleID=$articleID";
        if($article->type != 'page')
        {
            $categories    = $article->categories;
            $categoryAlias = current($categories)->alias;
            $alias         = "category=$categoryAlias&name=$article->alias";
        }
        else
        {
            $alias = "name=$article->alias";
        }

        $link = commonModel::createFrontLink($module, 'view', $param, $alias, $viewType);
        if($article->link) $link = $article->link;

        return $link;
    }

    /**
     * Delete '<p><br /></p>' if it at string's last. 
     * 
     * @param  string    $content 
     * @access public
     * @return string
     */
    public function rtrimContent($content)
    {
        /* Delete empty line such as '<p><br /></p>' if article content has it at last */
        $res   = '';
        $match = '/(\s+?<p><br \/>\s+?<\/p>)+$/';
        preg_match($match, $content, $res);
        if(isset($res[0]))
        {
            $content = substr($content, 0, strlen($content) - strlen($res[0]));
        }
        return $content;
    }

    /**
     * Set css.
     * 
     * @param  int      $articleID 
     * @access public
     * @return int
     */
    public function setCss($articleID)
    {
        $data = fixer::input('post')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->stripTags('css', $this->config->allowedTags->admin)
            ->get();

        $this->dao->update(TABLE_ARTICLE)->data($data, $skip = 'uid')->autoCheck()->where('id')->eq($articleID)->exec();
        
        return !dao::isError();
    }

    /**
     * Set js.
     * 
     * @param  int      $articleID 
     * @access public
     * @return int
     */
    public function setJs($articleID)
    {
        $data = fixer::input('post')
            ->stripTags('js', $this->config->allowedTags->admin)
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->get();

        $this->dao->update(TABLE_ARTICLE)->data($data, $skip = 'uid')->autoCheck()->where('id')->eq($articleID)->exec();
        
        return !dao::isError();
    }

    /**
     * Saving setting in config table. 
     * 
     * @access public
     * @return bool 
     */
    public function saveSetting()
    {
        $setting = new stdclass();
        $setting->submittion = $this->post->submittion; 
        $this->loadModel('setting')->setItems('system.common.article', $setting);
        return !dao::isError();
    }

    /**
     * Approve an submittion. 
     * 
     * @param  int    $articleID 
     * @access public
     * @return void
     */
    public function approve($articleID, $type, $categories)
    {
        $this->processCategories($articleID, $type, $categories);
        $this->dao->update(TABLE_ARTICLE)->set('type')->eq($type)->set('submittion')->eq(2)->where('id')->eq($articleID)->exec();
        $article = $this->getByID($articleID);
        if(commonModel::isAvailable('score')) $this->loadModel('score')->earn('approveSubmittion', 'article', $articleID, '', $article->addedBy);
        
        $this->loadModel('search')->save($article->type, $article);
        $this->loadModel('message')->send($this->app->user->account, $article->addedBy, sprintf($this->lang->article->approveMessage, $article->title, $this->config->score->counts->approveSubmittion));

        return !dao::isError();
    }

    /**
     * Reject article.
     * 
     * @param  int    $articleID 
     * @access public
     * @return void
     */
    public function reject($articleID)
    {
        $this->dao->update(TABLE_ARTICLE)->set('submittion')->eq(3)->where('id')->eq($articleID)->exec();
        $article = $this->getByID($articleID);
        $this->loadModel('message')->send($this->app->user->account, $article->addedBy, sprintf($this->lang->article->rejectMessage, $article->title));

        return !dao::isError();
    }

    /**
     * Get new submittion list.
     * 
     * @access public
     * @return array
     */
    public function getSubmittionCount()
    {
        return $this->dao->select('count(*) as count')->from(TABLE_ARTICLE)
            ->where('type')->eq('submittion')
            ->andWhere('submittion')->ne(3)
            ->andWhere('editedDate')->like(date("Y-m-d") . '%')
            ->fetch('count');
    }
}
