<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class productModel extends model
{
    /** 
     * Get an product by id.
     * 
     * @param  int      $productID 
     * @param  bool     $replaceTag 
     * @access public
     * @return bool|object
     */
    public function getByID($productID, $replaceTag = true)
    {   
        /* Get product self. */
        $product = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($productID)->fetch();
        if(!$product) return false;

        /* Add link to content if necessary. */
        if($replaceTag) $product->content = $this->loadModel('tag')->addLink($product->content);

        /* Get it's categories. */
        $product->categories = $this->dao->select('t1.*')
            ->from(TABLE_CATEGORY)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')->on('t2.category = t1.id')
            ->where('t2.type')->eq('product')
            ->andWhere('t2.id')->eq($productID)
            ->fetchAll('id');

        /* Get product path to highlight main nav. */
        $path = '';
        foreach($product->categories as $category)
        {   
            $path .= $category->path;
            if($category->unsaleable and !$product->unsaleable) $product->unsaleable = 1;
        }
        $product->path = explode(',', trim($path, ','));

        /* Get product attributes. */
        $product->attributes = $this->getAttributesByID($productID);

        /* Get it's files. */
        $product->files = $this->loadModel('file')->getByObject('product', $productID);

        $product->images = $this->file->getByObject('product', $productID, $isImage = true );

        $product->image = new stdclass();
        $product->image->list    = $product->images;
        $product->image->primary = !empty($product->image->list) ? $product->image->list[0] : '';
         
        return $product;
    }   

    /**
     * Get attributes by product id. 
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function getAttributesByID($productID)
    {
        return $this->dao->select('*')->from(TABLE_PRODUCT_CUSTOM)
            ->where('product')->eq($productID)
            ->orderBy('`order`')
            ->fetchAll('order');
    }

    /** 
     * Get product list.
     * 
     * @param  array   $categories 
     * @param  string  $orderBy 
     * @param  object  $pager 
     * @access public
     * @return array
     */
    public function getList($categories, $orderBy, $pager = null, $image = false) 
    {   
        $this->loadModel('file');
        $searchWord = $this->get->searchWord;
        $categoryID = $this->get->categoryID;

        /* Get products(use groupBy to distinct products).  */
        $productIDList = $this->dao->select('id')->from(TABLE_RELATION)
            ->where('type')->eq('product')
            ->andWhere('category')->in($categories)
            ->fetchPairs();

        if($image)
        {
            $objectIDList = $this->dao->setAutoLang(false)->select('`objectID`')->from(TABLE_FILE)
                ->where('objectType')->eq('product')
                ->andWhere('extension')->in($this->config->file->imageExtensions)->fi() 
                ->orderBy('objectID desc') 
                ->fetchPairs();

            $productIDList = array_merge($productIDList, $objectIDList);
        }

        $products = $this->dao->select('*')->from(TABLE_PRODUCT)
            ->where('1 = 1')
            ->beginIF(!empty($categories) or $image)->andWhere('id')->in($productIDList)->fi()
            ->beginIF(RUN_MODE == 'front')->andWhere('status')->eq('normal')->fi()

            ->beginIF($searchWord)
            ->andWhere('name', true)->like("%{$searchWord}%")
            ->orWhere('brand')->like("%{$searchWord}%")
            ->orWhere('model')->like("%{$searchWord}%")
            ->orWhere('color')->like("%{$searchWord}%")
            ->orWhere('origin')->like("%{$searchWord}%")
            ->orWhere('keywords')->like("%{$searchWord}%")
            ->orWhere('`desc`')->like("%{$searchWord}%")
            ->orWhere('content')->like("%{$searchWord}%")
            ->markRight(1)
            ->fi()

            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');
        if(!$products) return array();

        /* Get categories for these products. */
        $categories = $this->dao->select('t2.id, t2.name, t2.abbr, t2.alias, t2.unsaleable, t1.id AS product')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t2.type')->eq('product')
            ->andWhere('t1.id')->in(array_keys($products))
            ->fetchGroup('product', 'id');

        /* Get images for these products. */
        $images = $this->file->getByObject('product', array_keys($products), $isImage = true);

        foreach($products as $product)
        {
            /* Assign categories to it's product. */
            $product->categories = !empty($categories[$product->id]) ? $categories[$product->id] : array();
            $product->category   = current($product->categories);
            foreach($product->categories as $category)  $product->unsaleable = ($category->unsaleable and !$product->unsaleable);

            /* Assign images to it's product. */
            if(empty($images[$product->id])) continue;
            $product->image = new stdclass();
            if(isset($images[$product->id]))  $product->image->list = $images[$product->id];
            if(!empty($product->image->list)) $product->image->primary = $product->image->list[0];
            $product->desc = empty($product->desc) ? helper::substr(strip_tags($product->content), 250) : $product->desc;
        }

        return $products;
    }

    /**
     * Get product pairs.
     * 
     * @param string $categories 
     * @param string $orderBy 
     * @param object $pager 
     * @access public
     * @return array
     */
    public function getPairs($categories, $orderBy = '`order`', $pager = null)
    {
        return $this->dao->select('t1.id, name')->from(TABLE_PRODUCT)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')
            ->on('t1.id = t2.id')
            ->beginIF($categories)->where('t2.category')->in($categories)->fi()
            ->orderBy($orderBy)
            ->page($pager, false)
            ->fetchPairs('id', 'name');
    }

    /**
     * get latest products. 
     *
     * @param array      $categories
     * @param int        $count
     * @access public
     * @return array
     */
    public function getLatest($categories, $count, $image)
    {
        $family = array();
        $this->loadModel('tree');

        if(!is_array($categories)) $categories = explode(',', $categories);
        foreach($categories as $category) $family = array_merge($family, $this->tree->getFamily($category));

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList($family, '`order` desc', $pager, $image);
    }

    /**
     * get hot products. 
     *
     * @param array      $categories
     * @param int        $count
     * @access public
     * @return array
     */
    public function getHot($categories, $count)
    {
        $family = array();
        $this->loadModel('tree');

        if(!is_array($categories)) $categories = explode(',', $categories);
        foreach($categories as $category) $family = array_merge($family, $this->tree->getFamily($category));

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $count, 1);
        return $this->getList($family, 'views_desc', $pager);
    }

    /**
     * Get the prev and next product.
     * 
     * @param  int    $current  the current product order.
     * @param  int    $category the category id.
     * @access public
     * @return array
     */
    public function getPrevAndNext($current, $category)
    {
       $prev = $this->dao->select('t1.id, name, alias, t1.order')->from(TABLE_PRODUCT)->alias('t1')
           ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
           ->where('t2.category')->eq($category)
            ->beginIF(RUN_MODE == 'front')->andWhere('t1.status')->eq('normal')->fi()
           ->andWhere('t1.order')->lt($current)
           ->orderBy('t1.order_desc')
           ->limit(1)
           ->fetch();

       $next = $this->dao->select('t1.id, name, alias, t1.order')->from(TABLE_PRODUCT)->alias('t1')
           ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
           ->where('t2.category')->eq($category)
            ->beginIF(RUN_MODE == 'front')->andWhere('t1.status')->eq('normal')->fi()
           ->andWhere('t1.order')->gt($current)
           ->orderBy('t1.order')
           ->limit(1)
           ->fetch();

        return array('prev' => $prev, 'next' => $next);
    }

    /**
     * Create a product.
     * 
     * @access public
     * @return int|bool
     */
    public function create()
    {
        $now = helper::now();
        $product = fixer::input('post')
            ->join('categories', ',')
            ->stripTags('content,desc', $this->config->allowedTags->admin)
            ->setDefault('price', 0)
            ->setDefault('amount', 0)
            ->setDefault('promotion', 0)
            ->setDefault('order', 0)
            ->add('author', $this->app->user->account)
            ->add('addedDate', $now)
            ->add('editedDate', $now)
            ->get();

        $product->alias    = seo::unify($product->alias, '-');
        $product->keywords = seo::unify($product->keywords, ',');

        $this->dao->insert(TABLE_PRODUCT)
            ->data($product, $skip = 'categories,uid,label,value')
            ->autoCheck()
            ->batchCheck($this->config->product->require->create, 'notempty')
            ->checkIF($product->mall, 'mall', 'URL')
            ->exec();

        $productID = $this->dao->lastInsertID();

        if(!$this->post->order) $this->dao->update(TABLE_PRODUCT)->set('order')->eq($productID)->where('id')->eq($productID)->exec();

        $attributes = $this->saveAttributes($productID);
        if($attributes === false) return false;

        $this->loadModel('file')->updateObjectID($this->post->uid, $productID, 'product');
        $this->file->copyFromContent($this->post->content, $productID, 'product');

        if(dao::isError()) return false;

        $this->loadModel('tag')->save($product->keywords);
        $this->processCategories($productID, $this->post->categories);

        $product = $this->getByID($productID);
        $product->attributes = $attributes; 
        $this->loadModel('search')->save('product', $product);

        return $productID;
    }

    /**
     * Update a product.
     * 
     * @param  int $productID 
     * @access public
     * @return void
     */
    public function update($productID)
    {
        $product = fixer::input('post')
            ->join('categories', ',')
            ->stripTags('content,desc', $this->config->allowedTags->admin)
            ->setDefault('price', 0)
            ->setDefault('amount', 0)
            ->setDefault('promotion', 0)
            ->setDefault('unsaleable', 0)
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->get();

        $product->alias    = seo::unify($product->alias, '-');
        $product->keywords = seo::unify($product->keywords, ',');

        $this->dao->update(TABLE_PRODUCT)
            ->data($product, $skip = 'categories,uid,label,value')
            ->autoCheck()
            ->batchCheck($this->config->product->require->edit, 'notempty')
            ->checkIF($product->mall, 'mall', 'URL')
            ->where('id')->eq($productID)
            ->exec();

        $attributes = $this->saveAttributes($productID);
        if($attributes === false) return false;


        $this->loadModel('file')->updateObjectID($this->post->uid, $productID, 'product');
        $this->file->copyFromContent($this->post->content, $productID, 'product');

        if(dao::isError()) return false;

        $this->loadModel('tag')->save($product->keywords);
        $this->processCategories($productID, $this->post->categories);

        $product = $this->getByID($productID);
        if(empty($product)) return false;
        $product->attributes = $attributes; 
        return $this->loadModel('search')->save('product', $product);
    }

    /**
     * Save one product's attributes.
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function saveAttributes($productID)
    {
        $labels = fixer::input('post')->get('label');
        $values =  fixer::input('post')->get('value');

        $data = new stdclass();
        $data->product = $productID;

        $this->dao->delete()->from(TABLE_PRODUCT_CUSTOM)->where('product')->eq($productID)->exec();

        $attributes = '';
        $order = 0;
        foreach($labels as $key => $label)
        {
            $data->label = $label;
            $data->order = $order;
            $data->value = isset($values[$key]) ? $values[$key] : '';
            $attributes .= $label . $this->lang->colon . $data->value; 
            $this->dao->replace(TABLE_PRODUCT_CUSTOM)->data($data)->exec();
            $order ++;
        }
        if(dao::isError()) return false;
        return $attributes;
    }

    /**
     * Delete a product.
     * 
     * @param  int      $productID 
     * @access public
     * @return void
     */
    public function delete($productID, $null = null)
    {
        $product = $this->getByID($productID);
        if(!$product) return false;

        $this->dao->delete()->from(TABLE_RELATION)->where('id')->eq($productID)->andWhere('type')->eq('product')->exec();
        $this->dao->delete()->from(TABLE_PRODUCT)->where('id')->eq($productID)->exec();
        $this->dao->delete()->from(TABLE_PRODUCT_CUSTOM)->where('product')->eq($productID)->exec();

        return $this->loadModel('search')->deleteIndex('product', $productID);
    }

    /**
     * Process categories for a product.
     * 
     * @param  int    $productID 
     * @param  array  $categories 
     * @access public
     * @return void
     */
    public function processCategories($productID, $categories = array())
    {
       if(!$productID) return false;
       $type = 'product'; 

       /* First delete all the records of current product from the releation table.  */
       $this->dao->delete()->from(TABLE_RELATION)
           ->where('type')->eq($type)
           ->andWhere('id')->eq($productID)
           ->autoCheck()
           ->exec();

       /* Then insert the new data. */
       foreach($categories as $category)
       {
           if(!$category) continue;

           $data = new stdclass();
           $data->type     = $type; 
           $data->id       = $productID;
           $data->category = $category;

           $this->dao->insert(TABLE_RELATION)->data($data)->exec();
       }
    }

    /**
     * Set css.
     * 
     * @param  int      $productID 
     * @access public
     * @return int
     */
    public function setCss($productID)
    {
        $data = fixer::input('post')
            ->add('editor', $this->app->user->account)
            ->stripTags('css', $this->config->allowedTags->admin)
            ->add('editedDate', helper::now())
            ->get();

        $this->dao->update(TABLE_PRODUCT)->data($data, $skip = 'uid')->autoCheck()->where('id')->eq($productID)->exec();
        
        return !dao::isError();
    }

    /**
     * Set js.
     * 
     * @param  int      $productID 
     * @access public
     * @return int
     */
    public function setJs($productID)
    {
        $data = fixer::input('post')
            ->stripTags('js', $this->config->allowedTags->admin)
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->get();

        $this->dao->update(TABLE_PRODUCT)->data($data, $skip = 'uid')->autoCheck()->where('id')->eq($productID)->exec();
        
        return !dao::isError();
    }

    /**
     * Save settings.
     * 
     * @access public
     * @return bool 
     */
    public function saveSetting()
    {
        $setting = new stdclass();
        $setting->stock    = $this->post->stock;
        $setting->currency = $this->post->currency;
        $setting->currencySymbol = $this->lang->product->currencySymbols[$this->post->currency];

        $this->loadModel('setting')->setItems('system.common.product', $setting);
        return !dao::isError();
    }
}
