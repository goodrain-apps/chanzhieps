<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of cart of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     cart 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class cart extends control
{
    public function __construct()
    {
        parent::__construct();
        if($this->app->user->account != 'guest') $this->cart->mergeToDb();
    }
    /**
     * Add a product to cart.
     * 
     * @param  int    $product 
     * @access public
     * @return void
     */
    public function add($product, $count)
    {
        if($this->app->user->account == 'guest')
        {
            /* Save info to cookie if user is guest. */
            $this->cart->addInCookie($product, $count);
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }
        else
        {
            $result = $this->cart->add($product, $count);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }
    }

    /**
     * Browse products in my cart.
     * 
     * @access public
     * @return void
     */
    public function browse()
    {
        $this->app->loadLang('product');
        $this->app->loadConfig('product');
        $this->app->loadLang('order');
        $this->view->currencySymbol = $this->config->product->currencySymbol;
        $this->view->title      = $this->lang->cart->browse;
        $this->view->products   = $this->cart->getListByAccount($this->app->user->account);
        $this->view->mobileURL  = helper::createLink('cart', 'browse', '', '', 'mhtml');
        $this->view->desktopURL = helper::createLink('cart', 'browse', '', '', 'html');
        $this->display();
    }

    /**
     * Print cart msg in topbar.
     * 
     * @access public
     * @return void
     */
    public function printtopbar()
    {
        $count = 0;

        $goodsInCookie = $this->cart->getListByCookie();

        if($this->app->user->account != 'guest')
        {
            $count = $this->dao->select('count(*) as count')->from(TABLE_CART)
                ->where('account')->eq($this->app->user->account)
                ->beginIf(!empty($goodsInCookie))->andWhere('product')->notin(array_keys($goodsInCookie))->fi()
                ->fetch('count');
        }
        $count = $count + count($goodsInCookie);

        if($this->app->user->account != 'guest' or $count != 0) echo html::a($this->createLink('cart', 'browse'), sprintf($this->lang->cart->topbarInfo, $count));
    }

    /**
     * Get count of products in cart
     *
     * @access public
     * @return void
     */
    public function count()
    {
        /* Get info from cookie. */
        $cart  = $this->cart->getListByCookie();
        $count = count($cart);

        /* Save cookie's cart info. */
        if($this->app->user->account != 'guest')
        {
            if(count($cart) > 0)
            {
                foreach($cart as $product) $this->cart->add($product->product, $product->count);
                setcookie('cart', '[]', time() + 60 * 60 * 24);
            }
            $count = $this->dao->select('count(*) as count')->from(TABLE_CART)->where('account')->eq($this->app->user->account)->fetch('count');
        }
        $this->send(array('result' => 'success', 'count' => (int) $count));
    }

    /**
     * Delete product from cart.
     * 
     * @param  int    $product 
     * @access public
     * @return void
     */
    public function delete($product)
    {
        $this->dao->delete()->from(TABLE_CART)->where('product')->eq($product)->andWhere('account')->eq($this->app->user->account)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->cart->deleteInCookie($product);
        $this->send(array('result' => 'success', 'message' => $this->lang->deleteSuccess, 'locate' => inlink('browse')));
    }
}
