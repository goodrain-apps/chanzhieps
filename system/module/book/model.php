<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of book module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class bookModel extends model
{
    /**
     * Set the menu for admin.
     * 
     * @access public
     * @return void
     */
    public function setMenu()
    {
        $this->lang->book->menu = new stdclass();

        $books = $this->getBookList();
        foreach($books as $bookID => $book)
        {
            $this->lang->book->menu->$bookID = $book->title . '|book|admin|book=' . $bookID;
        }

        $this->lang->book->menu->createBook = $this->lang->book->createBook . '|book|create|'; 
        $this->lang->menuGroups->tree = 'book';
    }

    /**
     * Get a book by id or alias.
     *
     * @param  string|int $id   the id can be the number id or the alias.
     * @access public
     * @return object
     */
    public function getBookByID($id)
    {
        $book = $this->dao->select('*')->from(TABLE_BOOK)->where('alias')->eq($id)->andWhere('type')->eq('book')->fetch();
        if(!$book) $book = $this->dao->select('*')->from(TABLE_BOOK)->where('id')->eq($id)->fetch();
        return $book;
    }

    /**
     * Get a node's book.
     * 
     * @param  object    $node 
     * @access public
     * @return object
     */
    public function getBookByNode($node)
    {
       return $this->getBookByID($this->extractBookID($node->path));
    }

    /**
     * Extract the book id from a node path.
     * 
     * @param  string    $path 
     * @access public
     * @return int
     */
    public function extractBookID($path)
    {
        $path = explode(',', trim($path, ','));
        return $path[0];
    }

    /**
     * Get the first book.
     * 
     * @access public
     * @return object|bool
     */
    public function getFirstBook()
    {
        return $this->dao->select('*')->from(TABLE_BOOK)->where('type')->eq('book')->orderBy('`order`')->limit(1)->fetch();
    }

    /**
     * Get book list.
     *
     * @access public
     * @return array
     */
    public function getBookList()
    {
        return $this->dao->select('*')->from(TABLE_BOOK)->where('type')->eq('book')->orderBy('`order`')->fetchAll('id');
    }

    /**
     * Get origins tree of node.
     * 
     * @param  object    $node 
     * @access public
     * @return void
     */
    public function getOriginsTree($node)
    {
        if($node->type === 'book' || empty($node->origins)) return null;

        $tree = array();

        foreach($node->origins as $originNode)
        {
            if($node->id == $originNode->id) continue;

            $subTree = array();
            $children = $this->getChildren($originNode->id);
            $subNode = new stdclass();
            foreach($children as $child)
            {
                $childNode = new stdclass();
                $childNode->id      = $child->id;
                $childNode->alias   = $child->alias;
                $childNode->title   = $child->title;
                $childNode->type    = $child->type;
                $childNode->current = stripos($node->path, ',' . $child->id . ',') !== false;
                if($childNode->current) $subNode->current = $childNode;
                $subTree[] = $childNode;
            }
            
            $subNode->nodes = $subTree;
            $tree[] = $subNode;
        }
        return $tree;
    }

    /**
     * Get book catalog for front.
     * 
     * @param  int    $nodeID 
     * @access public
     * @return string
     */
    public function getFrontCatalog($nodeID, $serials)
    {
        $node = $this->getNodeByID($nodeID);
        if(!$node) return '';

        $nodeList = $this->dao->select('id,alias,type,path,`order`,parent,grade,title')->from(TABLE_BOOK)->where('path')->like("{$node->path}%")->orderBy('grade_desc,`order`')->fetchGroup('parent');
        $book = zget(end($nodeList), '0', '');
        foreach($nodeList as $parent => $nodes)
        {
            if($parent === 'catalog') continue;

            $catalog = '<dl>';
            foreach($nodes as $node)
            {
                $serial = $node->type != 'book' ? $serials[$node->id] : '';
                if($node->type == 'chapter')
                {
                    $link = helper::createLink('book', 'browse', "nodeID=$node->id", "book=$book->alias&node=$node->alias");
                    $catalog .= "<dd class='catalogue chapter'><strong><span class='order'>$serial</span>&nbsp;" . html::a($link, $node->title) . '</strong></dd>';
                }
                elseif($node->type == 'article')
                {
                    $link = helper::createLink('book', 'read', "articleID=$node->id", "book=$book->alias&node=$node->alias");
                    $catalog .= "<dd class='catalogue article'><strong><span class='order'>$serial</span></strong>&nbsp;" . html::a($link, $node->title) . '</dd>';
                }
                if(isset($nodeList[$node->id]) and isset($nodeList[$node->id]['catalog'])) $catalog .= $nodeList[$node->id]['catalog'];
            }
            $catalog .= '</dl>';
            $nodeList[$parent]['catalog'] = $catalog;
        }

        return zget(end($nodeList), 'catalog', '');
    }

    /**
     * Get book catalog for admin.
     * 
     * @param  int    $nodeID 
     * @param  array  $serials  the serial number list for all nodes. 
     * @access public
     * @return void
     */
    public function getAdminCatalog($nodeID, $serials)
    {
        $catalog = '';
        
        $node = $this->getNodeByID($nodeID);
        if(!$node) return $catalog;

        $children = $this->getChildren($nodeID);
        if($node->type != 'book') $serial = $serials[$nodeID];

        $anchor      = "name='node{$node->id}' id='node{$node->id}'";
        $titleLink   = $node->type == 'book' ? $node->title : html::a(helper::createLink('book', 'admin', "bookID=$node->id"), $node->title);
        $editLink    = commonModel::hasPriv('book', 'edit') ? html::a(helper::createLink('book', 'edit', "nodeID=$node->id"), $this->lang->edit, $anchor) : '';
        $delLink     = commonModel::hasPriv('book', 'edit') ? html::a(helper::createLink('book', 'delete', "bookID=$node->id"), $this->lang->delete, "class='deleter'") : '';
        $filesLink   = commonModel::hasPriv('file', 'browse') ? html::a(helper::createLink('file', 'browse', "objectType=book&objectID=$node->id&isImage=0"), $this->lang->book->files, "data-toggle='modal' data-width='1000'") : '';
        $catalogLink = commonModel::hasPriv('book', 'catalog') ? html::a(helper::createLink('book', 'catalog', "nodeID=$node->id"), $this->lang->book->catalog) : '';
        $moveLink    = commonModel::hasPriv('book', 'sort') ? html::a('javascript:;', "<i class='icon-move'></i>", "class='sort sort-handle'") : '';

        $childrenHtml = '';
        if($children) 
        {
            $childrenHtml .= '<dl>';
            foreach($children as $child) $childrenHtml .=  $this->getAdminCatalog($child->id, $serials);
            $childrenHtml .= '</dl>';
        }
        if($node->type == 'book')    $catalog .= "<dt class='book' data-id='" . $node->id . "'><strong>" . $titleLink . '</strong><span class="actions">' . $editLink . $catalogLink . $delLink . '</span></dt>' . $childrenHtml;
        if($node->type == 'chapter') $catalog .= "<dd class='catalog chapter' data-id='" . $node->id . "'><strong><span class='order'>" . $serial . '</span>&nbsp;' . $titleLink . '</strong><span class="actions">' . $editLink . $catalogLink . $delLink . $moveLink . '</span>' . $childrenHtml . '</dd>';
        if($node->type == 'article') $catalog .= "<dd class='catalog article' data-id='" . $node->id . "'><strong><span class='order'>" . $serial . '</span>&nbsp;' . $node->title . '</strong><span class="actions">' . $editLink . $filesLink . $delLink . $moveLink . '</span>' . $childrenHtml . '</dd>';
        return $catalog;
    }

    /**
     * Get article id list of string.
     * 
     * @param  int    $nodeID 
     * @access public
     * @return string
     */
    public function getArticleIDs($nodeID)
    {
        $node = $this->getNodeByID($nodeID);
        if(!$node) return '';

        if($node->type == 'article') return $node->id;

        $ids      = '';
        $children = $this->getChildren($nodeID);
        if(!$children) return '';

        foreach($children as $child)
        {
            $result = $this->getArticleIDs($child->id);
            if(strlen($result) == 0) continue;
            $ids .= $result . ',';
        }
        return trim($ids, ',');
    }

    /**
     * Compute the serial number for all nodes of a book.
     * 
     * @param  string    $path 
     * @access public
     * @return void
     */
    public function computeSN($bookID)
    {
        /* Get all children of the startNode. */
        $nodes = $this->dao->select('id, parent, `order`, path')->from(TABLE_BOOK)
            ->where('path')->like(",$bookID,%")
            ->andWhere('type')->ne('book')
            ->orderBy('grade, `order`')
            ->fetchAll('id');

        /* Group them by their parent. */
        $groupedNodes = array();
        foreach($nodes as $node) $groupedNodes[$node->parent][$node->id] = $node;

        $serials = array();
        foreach($nodes as $node)
        {
            $path      = explode(',', $node->path);
            $bookID    = $path[1];
            $startNode = $path[2];

            $serial = '';
            foreach($path as $nodeID)
            {
                /* If the node id is empty or is the bookID, skip. */
                if(!$nodeID) continue;
                if($nodeID == $bookID) continue;

                /* Compute the serial. */
                $parentID = $nodes[$nodeID]->parent;
                $brothers = $groupedNodes[$parentID];
                $serial  .= array_search($nodeID, array_keys($brothers)) + 1 . '.';
            }

            $serials[$node->id] = rtrim($serial, '.');
        }
        return $serials;
    }

    /**
     * Get a node of a book.
     *
     * @param  int      $nodeID
     * @param  bool     $replaceTag
     * @access public
     * @return object
     */
    public function getNodeByID($nodeID, $replaceTag = true)
    {
        $node = $this->dao->select('*')->from(TABLE_BOOK)
            ->where('id')->eq($nodeID)
            ->beginIf(defined('RUN_MODE') and RUN_MODE == 'front')
            ->andWhere('addedDate')->le(helper::now())
            ->fi()
            ->fetch();

        if(!$node) $node = $this->dao->select('*')->from(TABLE_BOOK)->where('alias')->eq($nodeID)->fetch();
        if(!$node) return false;
                
        $node->origins = $this->dao->select('id, type, alias, title')->from(TABLE_BOOK)->where('id')->in($node->path)->orderBy('grade')->fetchAll('id');
        $node->book    = current($node->origins);
        $node->files   = $this->loadModel('file')->getByObject('book', $nodeID);
        $node->content = $replaceTag ? $this->loadModel('tag')->addLink($node->content) : $node->content;
        
        return $node;
    }

    /**
     * Get children nodes of a node.
     * 
     * @param  int    $nodeID 
     * @access public
     * @return array
     */
    public function getChildren($nodeID)
    {
        return $this->dao->select('*')->from(TABLE_BOOK)->where('parent')->eq($nodeID)->orderBy('`order`')->fetchAll('id');
    }

    /**
     * Get the prev and next ariticle.
     * 
     * @param  int    $current  the current article id.
     * @param  int    $parent   the parent id.
     * @access public
     * @return array
     */
    public function getPrevAndNext($current)
    {
        $idList = explode(',', $this->getArticleIDs($current->book->id));
        $idListFlip = array_flip($idList);

        $currentOrder = isset($idListFlip[$current->id]) ? $idListFlip[$current->id] : -1;
        $prev = isset($idList[$currentOrder - 1]) ? $idList[$currentOrder - 1] : 0;
        $next = isset($idList[$currentOrder + 1]) ? $idList[$currentOrder + 1] : 0;

        $prev = $this->dao->select('id, title, alias')->from(TABLE_BOOK)->where('id')->eq($prev)->fetch();
        $next = $this->dao->select('id, title, alias')->from(TABLE_BOOK)->where('id')->eq($next)->fetch();

        return array('prev' => $prev, 'next' => $next);
    }

    /**
     * Get families of a node.
     * 
     * @param  object    $node 
     * @access public
     * @return array
     */
    public function getFamilies($node)
    {
        return $this->dao->select('*')->from(TABLE_BOOK)->where('path')->like($node->path . '%')->fetchAll('id');
    }

    /**
     * Create a tree menu in <select> tag.
     * 
     * @param  int    $startParent 
     * @param  bool   $removeRoot 
     * @access public
     * @return string
     */
    public function getOptionMenu($startParent = 0, $removeRoot = false)
    {
        /* First, get all catalogues. */
        $treeMenu   = array();
        $stmt       = $this->dbh->query($this->buildQuery($startParent));
        $catalogues = array();
        while($catalogue = $stmt->fetch()) $catalogues[$catalogue->id] = $catalogue;

        /* Cycle them, build the select control.  */
        foreach($catalogues as $catalogue)
        {
            $origins = explode(',', $catalogue->path);
            $catalogueTitle = '/';
            foreach($origins as $origin)
            {
                if(empty($origin)) continue;
                $catalogueTitle .= $catalogues[$origin]->title . '/';
            }
            $catalogueTitle = rtrim($catalogueTitle, '/');
            $catalogueTitle .= "|$catalogue->id\n";

            if(isset($treeMenu[$catalogue->id]) and !empty($treeMenu[$catalogue->id]))
            {
                if(isset($treeMenu[$catalogue->parent]))
                {
                    $treeMenu[$catalogue->parent] .= $catalogueTitle;
                }
                else
                {
                    $treeMenu[$catalogue->parent] = $catalogueTitle;;
                }

                $treeMenu[$catalogue->parent] .= $treeMenu[$catalogue->id];
            }
            else
            {
                if(isset($treeMenu[$catalogue->parent]) and !empty($treeMenu[$catalogue->parent]))
                {
                    $treeMenu[$catalogue->parent] .= $catalogueTitle;
                }
                else
                {
                    $treeMenu[$catalogue->parent] = $catalogueTitle;
                }    
            }
        }

        $topMenu = @array_pop($treeMenu);
        $topMenu = explode("\n", trim($topMenu));
        if(!$removeRoot) $lastMenu[] = '/';

        foreach($topMenu as $menu)
        {
            if(!strpos($menu, '|')) continue;

            $menu        = explode('|', $menu);
            $label       = array_shift($menu);
            $catalogueID = array_pop($menu);
           
            $lastMenu[$catalogueID] = $label;
        }

        return $lastMenu;
    }

    /**
     * Build the sql to execute.
     * 
     * @param  int    $startParent   the start parent id
     * @access public
     * @return string
     */
    public function buildQuery($startParent = 0)
    {
        /* Get the start parent path according the $startParent. */
        $startPath = '';
        if($startParent > 0)
        {
            $startParent = $this->getNodeById($startParent);
            if($startParent) $startPath = $startParent->path . '%';
        }

        return $this->dao->select('*')->from(TABLE_BOOK)
            ->where('type')->ne('article')
            ->beginIF($startPath)->andWhere('path')->like($startPath)->fi()
            ->orderBy('grade desc, `order`')
            ->get();
    }

    /**
     * Create a book.
     *
     * @access public
     * @return bool
     */
    public function createBook()
    {
        $now = helper::now();
        $book = fixer::input('post')
            ->add('parent', 0)
            ->add('grade', 1)
            ->add('type', 'book')
            ->add('addedDate', $now)
            ->add('editedDate', $now)
            ->setForce('alias',    seo::unify($this->post->alias, '-'))
            ->setForce('keywords', seo::unify($this->post->keywords, ','))
            ->get();

        $this->dao->insert(TABLE_BOOK)
            ->data($book)
            ->autoCheck()
            ->batchCheck($this->config->book->require->book, 'notempty')
            ->check('alias', 'unique', "`type`='book' AND `lang`='{$this->app->getClientLang()}'")
            ->exec();

        if(dao::isError()) return false;

        /* Update the path and order field. */
        $bookID   = $this->dao->lastInsertID();
        $bookPath = ",$bookID,";
        $this->dao->update(TABLE_BOOK)
            ->set('path')->eq($bookPath)
            ->set('`order`')->eq($bookID)
            ->where('id')->eq($bookID)
            ->exec();

        if(dao::isError()) return false;

        /* Save keywrods. */
        $this->loadModel('tag')->save($book->keywords);

        /* Return the book id. */
        return $bookID;
    }

    /**
     * Manage a node's catalog.
     *
     * @param  int    $parentNode 
     * @access public
     * @return bool
     */
    public function manageCatalog($parentNode)
    {
        $parentNode = $this->getNodeByID($parentNode);

        /* Init the catalogue object. */
        $now = helper::now();
        $node = new stdclass();
        $node->parent = $parentNode ? $parentNode->id : 0;
        $node->grade  = $parentNode ? $parentNode->grade + 1 : 1;

        foreach($this->post->title as $key => $nodeTitle)
        {
            if(empty($nodeTitle)) continue;
            $mode = $this->post->mode[$key];

            /* First, save the child without path field. */
            $node->title     = $nodeTitle;
            $node->type      = $this->post->type[$key];
            $node->author    = $this->post->author[$key];
            $node->alias     = $this->post->alias[$key];
            $node->keywords  = $this->post->keywords[$key];
            $node->addedDate = $this->post->addedDate[$key];
            $node->order     = $this->post->order[$key];
            $node->alias     = seo::unify($node->alias, '-');
            $node->keywords  = seo::unify($node->keywords, ',');

            if($mode == 'new')
            {
                $node->editedDate = $now;
                $this->dao->insert(TABLE_BOOK)->data($node)->exec();

                /* After saving, update it's path. */
                $nodeID   = $this->dao->lastInsertID();
                $nodePath = $parentNode->path . "$nodeID,";
                $this->dao->update(TABLE_BOOK)->set('path')->eq($nodePath)->where('id')->eq($nodeID)->exec();
            }
            else
            {
                $nodeID = $key;
                $node->editedDate = $now;
                $node->editor     = $this->app->user->account;
                $this->dao->update(TABLE_BOOK)->data($node)->autoCheck()->where('id')->eq($nodeID)->exec();
            }

            /* Save keywords. */
            $this->loadModel('tag')->save($node->keywords);

            if($node->type == 'article')
            {
                $article = $this->dao->select('*')->from(TABLE_BOOK)->where('id')->eq($nodeID)->fetch();
                $this->loadModel('search')->save('book', $article);
            }
        }

        return !dao::isError();
    }

    /**
     * Check if alias available.
     *
     * @access public
     * @return void
     */
    public function checkAlias()
    {
        /* Define the return var. */
        $return = array();
        $return['result'] = true;

        /* Count the chapter alias's counts. */
        $chapterAlias = array();
        foreach($this->post->type as $key => $type)
        {
            if($type == 'chapter') $chapterAlias[] = seo::unify($this->post->alias[$key], '-'); 
        }
        $chapterAlias = array_count_values($chapterAlias);

        foreach($this->post->title as $key => $title)
        {
            $type  = $this->post->type[$key];
            $alias = seo::unify($this->post->alias[$key], '-');
            $mode  = $this->post->mode[$key];

            if($type == 'article' or $alias == '' or $title == '') continue;

            /* Check the alias exists in database or not. */
            $dbExists = $this->dao->select('count(*) AS count')
                ->from(TABLE_BOOK)
                ->where('type')->eq('chapter')
                ->andWhere('alias')->eq($alias)
                ->beginIF($mode == 'update')->andWhere('id')->ne($key)->fi()
                ->fetch('count');

            if($dbExists or $chapterAlias[$alias] > 1)
            {
                $return['result']      = false;
                $return['alias'][$key] = $alias;
            }
        }

        return $return;
    }

    /**
     * Update a node.
     *
     * @param int $nodeID
     * @access public
     * @return bool
     */
    public function update($nodeID)
    {
        $oldNode = $this->getNodeByID($nodeID);

        $node = fixer::input('post')
            ->add('id',            $nodeID)
            ->add('editor',        $this->app->user->account)
            ->add('editedDate',    helper::now())
            ->setForce('keywords', seo::unify($this->post->keywords, ','))
            ->setForce('alias',    seo::unify($this->post->alias, '-'))
            ->setForce('type',     $oldNode->type)
            ->stripTags('content', $this->config->allowedTags->admin)
            ->get();

        $this->dao->update(TABLE_BOOK)
            ->data($node, $skip = 'uid,referer')
            ->autoCheck()
            ->batchCheckIF($node->type == 'book', $this->config->book->require->book, 'notempty')
            ->batchCheckIF($node->type != 'book', $this->config->book->require->node, 'notempty')
            ->checkIF($node->type == 'book', 'alias', 'unique', "`type` = 'book' AND id != '$nodeID'")
            ->where('id')->eq($nodeID)
            ->exec();

        if(dao::isError()) return false;

        $this->fixPath($oldNode->book->id);
        if(dao::isError()) return false;

        $this->loadModel('tag')->save($node->keywords);
        if(dao::isError()) return false;

        if($node->type == 'article')
        {
            $this->loadModel('file')->updateObjectID($this->post->uid, $nodeID, 'book');
            $this->file->copyFromContent($this->post->content, $nodeID, 'book');
            if(dao::isError()) return false;
        }
        $book = $this->getNodeByID($nodeID);
        return $this->loadModel('search')->save('book', $book);
    }

    /**
     * Fix the path, grade fields according to the id and parent fields.
     *
     * @param  string    $type 
     * @access public
     * @return void
     */
    public function fixPath($bookID)
    {
        /* Get all nodes grouped by parent. */
        $groupNodes = $this->dao->select('id, parent')->from(TABLE_BOOK)
            ->where('path')->like(",$bookID,%")
            ->fetchGroup('parent', 'id');
        $nodes = array();

        /* Cycle the groupNodes until it has no item any more. */
        while(count($groupNodes) > 0)
        { 
            /* Record the counts before processing. */
            $oldCounts = count($groupNodes);

            foreach($groupNodes as $parentNodeID => $childNodes)
            {
                /** 
                 * If the parentNode doesn't exsit in the nodes, skip it. 
                 * If exists, compute it's child nodes. 
                 */
                if(!isset($nodes[$parentNodeID]) and $parentNodeID != 0) continue;

                if($parentNodeID == 0)
                {
                    $parentNode = new stdclass();
                    $parentNode->grade = 0;
                    $parentNode->path  = ',';
                }
                else
                {
                    $parentNode = $nodes[$parentNodeID];
                }

                /* Compute it's child nodes. */
                foreach($childNodes as $childNodeID => $childNode)
                {
                    $childNode->grade = $parentNode->grade + 1;
                    $childNode->path  = $parentNode->path . $childNode->id . ',';

                    /**
                     * Save child node to nodes, 
                     * thus the child of child can compute it's grade and path.
                     */
                    $nodes[$childNodeID] = $childNode;
                }

                /* Remove it from the groupNodes.*/
                unset($groupNodes[$parentNodeID]);
            }

            /* If after processing, no node processed, break the cycle. */
            if(count($groupNodes) == $oldCounts) break;
        }

        /* Save nodes to database. */
        foreach($nodes as $node)
        {
            $this->dao->update(TABLE_BOOK)->data($node)
                ->where('id')->eq($node->id)
                ->exec();
        }
    }
    /**
     * Delete a book.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id, $null = null)
    {
        $book = $this->getNodeByID($id);
        if(!$book) return false;
        $families = $this->getFamilies($book);

        foreach($families as $node)
        {
            $this->dao->delete()->from(TABLE_BOOK)->where('id')->eq($node->id)->exec();
        }
        return $this->loadModel('search')->deleteIndex('book', $bookID);
    }

    /**
     * Create content navigation according the content. 
     * 
     * @param  int    $content 
     * @access public
     * @return string;
     */
    public function addMenu($content)
    {
        $nav = "<ul class='nav nav-content'>";
        $content = str_replace('<h3', '<h4', $content);
        $content = str_replace('h3>', 'h4>', $content);
        preg_match_all('|<h4.*>(.*)</h4>|isU', $content, $result);
        if(count($result[0]) >= 2)
        {
            foreach($result[0] as $id => $item)
            {
                $nav .= "<li><a href='#$id'>" . strip_tags($item) . "</a></li>";
                $replace = str_replace('<h4', "<h4 id=$id", $item);
                $content = str_replace($item, $replace, $content);
            }
            $nav .= "</ul>";
            $content = $nav . "<div class='content'>" . $content . '</div>';
        }

        return $content;
    }

    /**
     * sort books
     * 
     * @access public
     * @return void
     */
    public function sort()
    {
        $nodes = fixer::input('post')->get();
        foreach($nodes->sort as $id => $order)
        {
            $order = explode('.', $order);
            $num   = end($order);
            $this->dao->update(TABLE_BOOK)->set('`order`')->eq($num)->where('id')->eq($id)->exec();
        }
        return !dao::isError();
    }
    /**
     * Explode path.
     *
     * @access public
     * @return string
     */
    public function explodePath($str)
    {
        $path = '';
        $chapters = explode(',', $str, -2);
        foreach($chapters as $chapterID)
        {
            $chapter = $this->dao->select('title')->from(TABLE_BOOK)->where('id')->eq($chapterID)->fetch('title'); 
            $path .= $chapter.'/';
        }
        
        return $path;
    }
}
