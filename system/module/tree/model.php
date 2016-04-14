<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of tree module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     tree
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class treeModel extends model
{
    /**
     * Get category info by id.
     * 
     * @param  int|string  $categoryID 
     * @param  string      $type 
     * @access public
     * @return bool|object
     */
    public function getByID($categoryID, $type = 'article')
    {
        if(isset($this->config->categories[$type][$categoryID])) 
        {
           $category = $this->config->categories[$type][$categoryID];
        }
        else
        {
            $category = $this->dao->select('*')->from(TABLE_CATEGORY)->where('alias')->eq($categoryID)->andWhere('type')->eq($type)->fetch();
            if(!$category) $category = $this->dao->findById((int)$categoryID)->from(TABLE_CATEGORY)->fetch();

            if(!$category) return false;
        }

        if($type == 'forum') 
        {
            $speakers = array();
            $category->moderators = explode(',', trim($category->moderators, ','));
            foreach($category->moderators as $moderators) $speakers[] = $moderators;
            $speakers = $this->loadModel('user')->getRealNamePairs($speakers);
            foreach($category->moderators as $key => $moderators) $category->moderators[$key] = isset($speakers[$moderators]) ? $speakers[$moderators] : '';
            $category->moderators = implode(',', $category->moderators);
        }

        $category->pathNames = $this->dao->select('id, name')->from(TABLE_CATEGORY)->where('id')->in($category->path)->orderBy('grade')->fetchPairs();
        return $category;
    }

    /**
     * Get category alias by id.
     * 
     * @param  int      $categoryID 
     * @access public
     * @return string
     */
    public function getAliasByID($categoryID)
    {
        if(isset($this->config->categoryAlias[$categoryID])) return $this->config->categoryAlias[$categoryID];
        return "";
    }

    /**
     * Get the first category.
     * 
     * @param  string $type 
     * @access public
     * @return object|bool
     */
    public function getFirst($type = 'article')
    {
        return $this->dao->select('*')->from(TABLE_CATEGORY)->where('type')->eq($type)->orderBy('id')->limit(1)->fetch();
    }

    /**
     * Get the id => name pairs of some categories.
     * 
     * @param  string $categories   the category lists
     * @param  string $type         the type
     * @access public
     * @return array
     */
    public function getPairs($categories = '', $type = 'article')
    {
        return $this->dao->select('id, name')->from(TABLE_CATEGORY)
            ->where('1=1')
            ->beginIF($categories)->andWhere('id')->in($categories)->fi()
            ->beginIF($type)->andWhere('type')->eq($type)->fi()
            ->fetchPairs();
    }

    /**
     * Get origin of a category.
     * 
     * @param  int     $categoryID 
     * @access public
     * @return array
     */
    public function getOrigin($categoryID)
    {
        if($categoryID == 0) return array();

        $path = $this->dao->select('path')->from(TABLE_CATEGORY)->where('id')->eq((int)$categoryID)->fetch('path');
        $path = trim($path, ',');
        if(!$path) return array();

        return $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->in($path)->orderBy('grade')->fetchAll('id');
    }

    /**
     * Get id list of a family.
     * 
     * @param  int      $categoryID 
     * @param  string   $type 
     * @access public
     * @return array
     */
    public function getFamily($categoryID, $type = '')
    {
        if($categoryID == 0 and empty($type)) return array();
        $category = $this->getByID($categoryID, $type);

        if($category)  return $this->dao->select('id')->from(TABLE_CATEGORY)->where('path')->like($category->path . '%')->fetchPairs();
        if(!$category) return $this->dao->select('id')->from(TABLE_CATEGORY)->where('type')->eq($type)->fetchPairs();
    }

    /**
     * Get children categories of one category.
     * 
     * @param  int      $categoryID 
     * @param  string   $type 
     * @access public
     * @return array
     */
    public function getChildren($categoryID, $type = 'article')
    {
        return $this->dao->select('*')->from(TABLE_CATEGORY)
            ->where('parent')->eq((int)$categoryID)
            ->andWhere('type')->eq($type)
            ->orderBy('`order`')
            ->fetchAll('id');
    }

    /**
     * Build the sql to execute.
     * 
     * @param string $type              the tree type, for example, article|forum
     * @param int    $startCategory     the start category id
     * @access public
     * @return string
     */
    public function buildQuery($type, $startCategory = 0)
    {
        /* Get the start category path according the $startCategory. */
        $startPath = '';
        if($startCategory > 0)
        {
            $startCategory = $this->getById($startCategory);
            if($startCategory) $startPath = $startCategory->path . '%';
        }

        return $this->dao->select('*')->from(TABLE_CATEGORY)
            ->where('type')->eq($type)
            ->beginIF($startPath)->andWhere('path')->like($startPath)->fi()
            ->orderBy('grade desc, `order`')
            ->get();
    }

    /**
     * Create a tree menu in <select> tag.
     * 
     * @param  string $type 
     * @param  int    $startCategory 
     * @param  bool   $removeRoot 
     * @access public
     * @return string
     */
    public function getOptionMenu($type = 'article', $startCategory = 0, $removeRoot = false)
    {
        /* First, get all categories. */
        $treeMenu   = array();
        $lastMenu   = array();
        $stmt       = $this->dbh->query($this->buildQuery($type, $startCategory));
        $categories = array();
        while($category = $stmt->fetch()) $categories[$category->id] = $category;

        /* Cycle them, build the select control.  */
        foreach($categories as $category)
        {
            $origins = explode(',', $category->path);
            $categoryName = '/';
            foreach($origins as $origin)
            {
                if(empty($categories[$origin]->name)) continue;
                $categoryName .= $categories[$origin]->name . '/';
            }
            $categoryName = rtrim($categoryName, '/');
            $categoryName .= "|$category->id\n";

            if(isset($treeMenu[$category->id]) and !empty($treeMenu[$category->id]))
            {
                if(isset($treeMenu[$category->parent]))
                {
                    $treeMenu[$category->parent] .= $categoryName;
                }
                else
                {
                    $treeMenu[$category->parent] = $categoryName;;
                }
                $treeMenu[$category->parent] .= $treeMenu[$category->id];
            }
            else
            {
                if(isset($treeMenu[$category->parent]) and !empty($treeMenu[$category->parent]))
                {
                    $treeMenu[$category->parent] .= $categoryName;
                }
                else
                {
                    $treeMenu[$category->parent] = $categoryName;
                }
            }
        }

        $topMenu = @array_pop($treeMenu);
        $topMenu = explode("\n", trim($topMenu));
        if(!$removeRoot) $lastMenu[] = '/';

        foreach($topMenu as $menu)
        {
            if(!strpos($menu, '|')) continue;

            $menu       = explode('|', $menu);
            $label      = array_shift($menu);
            $categoryID = array_pop($menu);
           
            $lastMenu[$categoryID] = $label;
        }

        return $lastMenu;
    }

    /**
     * Get the tree menu in <ul><ol> type.
     * 
     * @param string    $type           the tree type
     * @param int       $startCategoryID  the start category
     * @param string    $userFunc       which function to be called to create the link
     * @access public
     * @return string   the html code of the tree menu.
     */
    public function getTreeMenu($type = 'article', $startCategoryID = 0, $userFunc, $siteID = 0)
    {
        $treeMenu = array();
        $stmt = $this->dbh->query($this->buildQuery($type, $startCategoryID, $siteID));

        $modelName = class_exists('exttreeModel') ? 'exttreeModel' : 'treeModel';
        if(isset($userFunc[0])) $userFunc[0] = $modelName;

        while($category = $stmt->fetch())
        {
            if(treeModel::isWechatMenu($type))
            {
                $category->children = $this->dao->select('id')->from(TABLE_CATEGORY)->where('parent')->eq($category->id)->fetchAll();
            }
            $linkHtml = call_user_func($userFunc, $category);

            if(isset($treeMenu[$category->id]) and !empty($treeMenu[$category->id]))
            {
                if(!isset($treeMenu[$category->parent])) $treeMenu[$category->parent] = '';
                $treeMenu[$category->parent] .= "<li>$linkHtml";  
                $treeMenu[$category->parent] .= "<ul>".$treeMenu[$category->id]."</ul>\n";
            }
            else
            {
                if(isset($treeMenu[$category->parent]) and !empty($treeMenu[$category->parent]))
                {
                    $treeMenu[$category->parent] .= "<li>$linkHtml\n";  
                }
                else
                {
                    $treeMenu[$category->parent] = "<li>$linkHtml\n";  
                }    
            }
            $treeMenu[$category->parent] .= "</li>\n"; 
        }
        $lastMenu = "<ul class='tree'>" . @array_pop($treeMenu) . "</ul>\n";
        return $lastMenu; 
    }

    /**
     * Create the admin link.
     * 
     * @param  int      $category 
     * @access public
     * @return string
     */
    public static function createAdminLink($category)
    {
        if($category->type == 'forum' or $category->type == 'product')
        {
            $categoryName = $category->type;
            $vars         = "categoryID=$category->id";
        }
        else
        {
            $categoryName = 'article';
            $vars         = "type=$category->type&categoryID=$category->id";
        }

        $methodName = 'admin';
        $linkHtml   = html::a(helper::createLink($categoryName, $methodName, $vars), $category->name, "id='category{$category->id}'");

        return $linkHtml;
    }

    /**
     * Create the browse link.
     * 
     * @param  int      $category 
     * @access public
     * @return string
     */
    public static function createBrowseLink($category)
    {
        $linkHtml = html::a(helper::createLink('article', 'browse', "categoryID={$category->id}", "category={$category->alias}"), $category->name, "id='category{$category->id}'");
        return $linkHtml;
    }

    /**
     * Create the product browse link.
     * 
     * @param  int      $category 
     * @access public
     * @return string
     */
    public static function createProductBrowseLink($category)
    {
        $linkHtml = html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), $category->name, "id='category{$category->id}'");
        return $linkHtml;
    }

    /**
     * Create the blog browse link.
     * 
     * @param  int      $category 
     * @access public
     * @return string
     */
    public static function createBlogBrowseLink($category)
    {
        $linkHtml = html::a(helper::createLink('blog', 'index', "category={$category->id}", "category={$category->alias}"), $category->name, "id='category{$category->id}'");
        return $linkHtml;
    }

    /**
     * Create the manage link.
     * 
     * @param  int         $category 
     * @access public
     * @return string
     */
    public static function createManageLink($category)
    {
        global $lang, $config;

        /* Set the class of children link. */
        $childrenLinkClass = '';

        $linkHtml  = $category->name;
        if(strpos($config->tree->editableTypes, ",{$category->type},") !== false) $linkHtml .= ' ' . html::a(helper::createLink('tree', 'edit',     "category={$category->id}&type={$category->type}"), $lang->tree->edit, "class='ajax'");

        $gradeLimit = zget($config->tree->gradeLimits, $category->type, 999); 
        if($category->grade < $gradeLimit) $linkHtml .= ' ' . html::a(helper::createLink('tree', 'children', "type={$category->type}&category={$category->id}"), $lang->category->children, "class='$childrenLinkClass ajax'");
        $linkHtml .= ' ' . html::a(helper::createLink('tree', 'delete',   "category={$category->id}"), $lang->delete, "class='deleter'");

        return $linkHtml;
    }

    /**
     * Create the manage link for wechat menu.
     * 
     * @param  int         $category 
     * @access public
     * @return string
     */
    public static function createWechatMenuLink($category)
    {
        global $lang;

        $public = str_replace('wechat_', '', $category->type);

        $linkHtml  = $category->name;
        if($category->parent == 0)     $linkHtml .= ' ' . html::a(helper::createLink('tree', 'children', "type={$category->type}&category={$category->id}"), $lang->wechatMenu->children, "class='ajax'");
        if(empty($category->children)) $linkHtml .= ' ' . html::a(helper::createLink('wechat', 'setResponse', "public={$public}&group=menu&key=m_{$category->id}"), $lang->tree->setResponse, "class='ajax'");
        $linkHtml .= ' ' . html::a(helper::createLink('tree', 'delete',   "category={$category->id}"), $lang->delete, "class='deleter'");

        return $linkHtml;
    }

    /**
     * Create the slide admin link.
     * 
     * @param  object      $group 
     * @access public
     * @return string
     */
    public static function createSlideAdminLink($group)
    {
        $linkHtml = html::a(helper::createLink('slide', 'admin', "group={$group->id}"), $group->name, "id='group{$group->id}'");
        return $linkHtml;
    }

    /**
     * Update a category.
     * 
     * @param  int     $categoryID 
     * @access public
     * @return void
     */
    public function update($categoryID)
    {
        $category = fixer::input('post')
            ->join('moderators', ',')
            ->stripTags('desc,link', $this->config->allowedTags->admin)
            ->setDefault('readonly', 0)
            ->setDefault('unsaleable', 0)
            ->setIF(!$this->post->isLink, 'link', '')
            ->get();

        $category->alias    = seo::unify($category->alias, '-');
        $category->keywords = seo::unify($category->keywords, ',');

        /* Set moderators. */
        if(!isset($category->moderators))
        {
            $category->moderators = '';
        }
        else
        {
            $category->moderators = trim($category->moderators, ',');
            $category->moderators = empty($category->moderators) ? '' : ',' . $category->moderators . ',';
        }

        /* Add id to check alias. */
        $category->id = $categoryID; 
        if(!$this->checkAlias($category)) return sprintf($this->lang->tree->aliasRepeat, $category);

        $parent = $this->getById($this->post->parent);
        $category->grade = $parent ? $parent->grade + 1 : 1;

        $this->dao->update(TABLE_CATEGORY)
            ->data($category, $skip = 'uid,isLink')
            ->autoCheck()
            ->checkIF(!$this->post->isLink, $this->config->tree->require->edit, 'notempty')
            ->batchCheckIF($this->post->isLink, $this->config->tree->require->link, 'notempty')
            ->where('id')->eq($categoryID)
            ->exec();

        $this->fixPath($category->type);

        $this->loadModel('file')->updateObjectID($this->post->uid, $categoryID, 'category');
        $this->file->copyFromContent($this->post->content, $categoryID, 'category');

        return !dao::isError();
    }
        
    /**
     * Delete a category.
     * 
     * @param  int     $categoryID 
     * @access public
     * @return void
     */
    public function delete($categoryID, $null = null)
    {
        $category = $this->getById($categoryID);
        $family   = $this->getFamily($categoryID);

        $this->dao->update(TABLE_CATEGORY)->set('`grade` = `grade` - 1')->where('id')->in($family)->andWhere('grade')->gt(0)->exec();                      // Update family's grade.
        $this->dao->update(TABLE_CATEGORY)->set('parent')->eq($category->parent)->where('parent')->eq($categoryID)->exec();  // Update children's parent to their grandpa.
        $this->dao->delete()->from(TABLE_CATEGORY)->where('id')->eq($categoryID)->exec();                                    // Delete my self.
        $this->fixPath($category->type);

        return !dao::isError();
    }

    /**
     * Manage children of one category.
     * 
     * @param string $type 
     * @param string $children 
     * @access public
     * @return void
     */
    public function manageChildren($type, $parent, $children)
    {
        /* Get parent. */
        $parent = $this->getByID($parent);

        /* Init the category object. */
        $category = new stdclass();
        $category->parent     = $parent ? $parent->id : 0;
        $category->grade      = $parent ? $parent->grade + 1 : 1;
        $category->type       = $type;
        $category->postedDate = helper::now();

        $i = 1;
        foreach($children as $key => $categoryName)
        {
            $alias = $this->post->alias[$key];
            $alias = seo::unify($alias, '-');
            $order = $i * 10;
            if(empty($categoryName)) continue;

            /* First, save the child without path field. */
            $category->name  = $categoryName;
            $category->alias = $alias;
            $category->order = $order;
            $mode = $this->post->mode[$key];

            /* Add id to check alias. */
            $category->id = $mode == 'new' ?  0: $category->id = $key;
            if(!$this->checkAlias($category)) return sprintf($this->lang->tree->aliasRepeat, $alias);
            if($category->type == 'forum' or $category->type == 'blog')
            {
                if(is_numeric($category->alias)) return $this->lang->tree->aliasNumber;
            }

            if($mode == 'new')
            {
                unset($category->id);
                $this->dao->insert(TABLE_CATEGORY)->data($category)->exec();

                /* After saving, update it's path. */
                $categoryID   = $this->dao->lastInsertID();
                $categoryPath = $parent ? $parent->path . $categoryID . ',' : ",$categoryID,";
                $this->dao->update(TABLE_CATEGORY)
                    ->set('path')->eq($categoryPath)
                    ->where('id')->eq($categoryID)
                    ->exec();
            }
            else
            {
                $categoryID = $key;
                $this->dao->update(TABLE_CATEGORY)
                    ->set('name')->eq($categoryName)
                    ->set('alias')->eq($alias)
                    ->set('order')->eq($order)
                    ->where('id')->eq($categoryID)
                    ->exec();
            }
            $i ++;
        }

        return !dao::isError();
    }

    /**
     * Create slide group.
     * 
     * @access public
     * @return bool
     */
    public function createSlideGroup()
    {
        $group = new stdclass();
        $group->name     = $this->post->name;
        $group->parent   = 0; 
        $group->grade    = 1; 
        $group->type     = 'slide'; 
        $group->postedDate = helper::now(); 

        $this->dao->insert(TABLE_CATEGORY)->data($group)->autoCheck()->exec();
        if(dao::isError()) return false;

        $groupID = $this->dao->lastInsertID();
        $path = ",$groupID,";
        $this->dao->update(TABLE_CATEGORY)->set('path')->eq($path)->where('id')->eq($groupID)->exec();

        return !dao::isError();
    }
    
    /**
     * Edit slide group. 
     * 
     * @param  string $newName 
     * @param  int    $groupID 
     * @access public
     * @return bool 
     */
    public function editSlideGroup($groupID)
    {
        $this->dao->update(TABLE_CATEGORY)->set('name')->eq($this->post->groupName)->autoCheck()->where('id')->eq($groupID)->exec(); 
        return !dao::isError();
    }

    /**
     * Check if alias available.
     *
     * @param  object    $category 
     * @access public
     * @return void
     */
    public function checkAlias($category)
    {
        if(empty($category)) return false;
        if($category->alias == '') return true;
        if(empty($category->id)) $category->id = 0;
        if(in_array($category->type, array('article', 'product')) and strpos($this->config->tree->systemModules, ",{$category->alias},") !== false)
        {
            $this->lang->tree->aliasRepeat = $this->lang->tree->aliasConflict;
            return false;
        }

        $scope = array();
        $scope['article'] = 'article,product';
        $scope['product'] = 'article,product';
        $scope['blog']    = 'blog';
        $scope['forum']   = 'forum';

        $count = $this->dao->select('count(*) as count')->from(TABLE_CATEGORY)
            ->where('`alias`')->eq($category->alias)->andWhere('id')->ne($category->id)
            ->andWhere('type')->in($scope[$category->type])->fetch('count');
        return $count < 1;
    }

    /**
     * Fix the path, grade fields according to the id and parent fields.
     *
     * @param  string    $type 
     * @access public
     * @return void
     */
    public function fixPath($type)
    {
        /* Get all categories grouped by parent. */
        $groupCategories = $this->dao->select('id, parent')->from(TABLE_CATEGORY)
            ->where('type')->eq($type)
            ->fetchGroup('parent', 'id');
        $categories = array();

        /* Cycle the groupCategories until it has no item any more. */
        while(count($groupCategories) > 0)
        { 
            /* Record the counts before processing. */
            $oldCounts = count($groupCategories);

            foreach($groupCategories as $parentCategoryID => $childCategories)
            {
                /** 
                 * If the parentCategory doesn't exsit in the categories, skip it. 
                 * If exists, compute it's child categories. 
                 */
                if(!isset($categories[$parentCategoryID]) and $parentCategoryID != 0) continue;

                if($parentCategoryID == 0)
                {
                    $parentCategory = new stdclass();
                    $parentCategory->grade = 0;
                    $parentCategory->path  = ',';
                }
                else
                {
                    $parentCategory = $categories[$parentCategoryID];
                }

                /* Compute it's child categories. */
                foreach($childCategories as $childCategoryID => $childCategory)
                {
                    $childCategory->grade = $parentCategory->grade + 1;
                    $childCategory->path  = $parentCategory->path . $childCategory->id . ',';

                    /**
                     * Save child category to categories, 
                     * thus the child of child can compute it's grade and path.
                     */
                    $categories[$childCategoryID] = $childCategory;
                }

                /* Remove it from the groupCategories.*/
                unset($groupCategories[$parentCategoryID]);
            }

            /* If after processing, no category processed, break the cycle. */
            if(count($groupCategories) == $oldCounts) break;
        }

        /* Save categories to database. */
        foreach($categories as $category)
        {
            $this->dao->update(TABLE_CATEGORY)->data($category)
                ->where('id')->eq($category->id)
                ->exec();
        }
    }

    /**
     * Check if a category is wechatMenu by type.
     * 
     * @param  string    $type 
     * @static
     * @access public
     * @return bool
     */
    public static function isWechatMenu($type)
    {
        return substr($type, 0, 7) == 'wechat_';
    }

    /**
     * Fix lang for different types.
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function fixLang($type = 'article')
    {
        $lang = zget($this->config->tree->langs, $type, 'category');
        $this->lang->category = $this->lang->{$lang};
    }

    /**
     * Fix menu and menu group of different types.
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function fixMenu($type = 'article')
    {
        $menuGroup = zget($this->config->tree->menuGroups, $type);

        unset($this->lang->tree->menu);
        If(isset($this->lang->{$menuGroup}->menu)) $this->lang->tree->menu = $this->lang->{$menuGroup}->menu;
        $this->lang->menuGroups->tree = $menuGroup;
    }
}
