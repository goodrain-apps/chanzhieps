<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of cart module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     cart
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class cartModel extends model
{
    /**
     * Add a prodcut to cart. 
     * 
     * @param  int    $productID 
     * @param  int    $count 
     * @access public
     * @return void
     */
    public function add($productID, $count)
    {
        $hasProduct = $this->dao->select('count(*) as count')->from(TABLE_CART)->where('account')->eq($this->app->user->account)->andWhere('product')->eq($productID)->fetch('count');

        if(!$hasProduct)
        {
            $product = new stdclass();
            $product->product = $productID;
            $product->account = $this->app->user->account;
            $product->count   = $count;
            $this->dao->insert(TABLE_CART)->data($product)->exec();
        }
        else
        {
            $this->dao->update(TABLE_CART)->set("count= count + {$count}")->where('account')->eq($this->app->user->account)->andWhere('product')->eq($productID)->exec();
        }

        return !dao::isError();
    }

    /**
     * Get product list in cart of an account.
     * 
     * @param  string $account 
     * @access public
     * @return void
     */
    public function getListByAccount($account = '')
    {
        if($this->app->user->account != 'guest')
        {
            $goodsList = $this->dao->select('*')->from(TABLE_CART)->where('account')->eq($account)->fetchAll('product');
        }
        else
        {
            $goodsInDb     = $this->dao->select('*')->from(TABLE_CART)->where('account')->eq($account)->fetchAll('product');
            $goodsInCookie = $this->getListByCookie();
            $goodsList     = (array) $goodsInDb + (array) $goodsInCookie;
        }

        /* Get products(use groupBy to distinct products).  */
        $products = $this->dao->select('t1.*, t2.category')->from(TABLE_PRODUCT)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
            ->where('t1.id')->in(array_keys($goodsList))
            ->andWhere('t2.type')->eq('product')
            ->beginIF(RUN_MODE == 'front')->andWhere('t1.status')->eq('normal')->fi()
            ->groupBy('t2.id')
            ->fetchAll('id');

        if(empty($products)) return array();

        /* Get categories for these products. */
        $categories = $this->dao->select('t2.id, t2.name, t2.alias, t1.id AS product')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t2.type')->eq('product')
            ->andWhere('t1.id')->in(array_keys($products))
            ->fetchGroup('product', 'id');

        /* Assign categories to it's product. */
        foreach($products as $product) $product->categories = !empty($categories[$product->id]) ? $categories[$product->id] : array();

        /* Get images for these products. */
        $images = $this->loadModel('file')->getByObject('product', array_keys($products), $isImage = true);

        /* Assign images to it's product. */
        foreach($products as $product)
        {
            $product->count = $goodsList[$product->id]->count;
            if(empty($images[$product->id])) continue;
            $product->image = new stdclass();
            if(isset($images[$product->id]))  $product->image->list = $images[$product->id];
            if(!empty($product->image->list)) $product->image->primary = $product->image->list[0];
        }
        
        return $products;
    }

    /**
     * Get list from cookie. 
     * 
     * @access public
     * @return array
     */
    public function getListByCookie()
    {
        $cart    = ($this->cookie->cart === false or $this->cookie->cart == '') ? array() : json_decode($this->cookie->cart);
        $newCart = array();
        foreach($cart as $product)
        {
            $pro = new stdclass();
            $pro->account = 'guest';
            $pro->product = $product->product;
            $pro->count   = $product->count;
            $pro->lang    = 'zh-cn';
            $newCart[$product->product] = $pro;
        }
        return $newCart;
    }

    /**
     * Add a prodcut to cart, save in cookie. 
     * 
     * @param  int    $productID 
     * @param  int    $count 
     * @access public
     * @return void
     */
    public function addInCookie($productID, $count)
    {
        $cart = $this->getListByCookie();

        if(isset($cart[$productID]))
        {
            $cart[$productID]->count += $count;
        }
        else
        {
            $tmp  = new stdclass();
            $tmp->product = $productID;
            $tmp->count   = $count;
            $cart[$productID] = $tmp;
        }

        setcookie('cart', json_encode($cart), time() + 60 * 60 * 24);
    }

    /**
     * Delete a product to cart, save in cookie. 
     * 
     * @param  int    $productID 
     * @access public
     * @return void
     */
    public function deleteInCookie($productID)
    {
        $cart = $this->getListByCookie();
        if(isset($cart[$productID])) unset($cart[$productID]);
        setcookie('cart', json_encode($cart), time() + 60 * 60 * 24);
    }

    /**
     * Merge goods in cookie to db if user is logon. 
     * 
     * @access public
     * @return void
     */
    public function mergeToDb()
    {
        if($this->app->user->account == 'guest') return true;
        $goodsList = $this->getListByCookie();
        foreach($goodsList as $id => $goods)
        {
            $goods->account = $this->app->user->account;
            $this->dao->insert(TABLE_CART)->data($goods)->exec();
            unset($goodsList[$id]);
        }
        setcookie('cart', json_encode($goodsList), time() + 60 * 60 * 24);
    }
}
