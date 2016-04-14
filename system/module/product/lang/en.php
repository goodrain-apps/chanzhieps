<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The product category zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->product->common = 'Product';
$lang->product->home   = 'Product';

$lang->product->id         = 'Id';
$lang->product->category   = 'Category';
$lang->product->categories = 'Categories';
$lang->product->name       = 'Name';
$lang->product->alias      = 'English alias';
$lang->product->mall       = 'Buy link';
$lang->product->buyNow     = 'Buy now';
$lang->product->brand      = 'Brand';
$lang->product->model      = 'Model';
$lang->product->color      = 'Color';
$lang->product->origin     = 'Origin';
$lang->product->unit       = 'Unit';
$lang->product->price      = 'Price';
$lang->product->promotion  = 'Promotion';
$lang->product->amount     = 'Amount';
$lang->product->keywords   = 'Keywords';
$lang->product->desc       = 'Description';
$lang->product->content    = 'Content';
$lang->product->author     = 'Author';
$lang->product->editor     = 'Editor';
$lang->product->addedDate  = 'Added date';
$lang->product->editedDate = 'Edited date';
$lang->product->status     = 'Status';
$lang->product->views      = 'Views';
$lang->product->viewsCount = 'Views count';
$lang->product->stick      = 'Sticky';
$lang->product->order      = 'Order';
$lang->product->unsaleable = 'Not for sale';
$lang->product->attribute  = 'Attribute';
$lang->product->custom     = 'Custom';
$lang->product->sales      = 'Price';
$lang->product->css        = 'CSS';
$lang->product->js         = 'JS';

$lang->product->currency   = 'Currency';
$lang->product->stock    = 'Stock';

$lang->product->list         = 'List';
$lang->product->hot          = 'Hot';
$lang->product->admin        = 'Admin';
$lang->product->create       = 'Create';
$lang->product->edit         = 'Edit';
$lang->product->changeStatus = 'Change status';
$lang->product->setcss       = 'Set CSS';
$lang->product->setjs        = 'Set JS';
$lang->product->files        = 'Files';
$lang->product->images       = 'Images';
$lang->product->addToCart    = "<i class='icon icon-shopping-cart'></i> Add to Cart";
$lang->product->count        = 'Count';
$lang->product->comments     = 'Comments';
$lang->product->detail       = 'Detail';
$lang->product->setting      = 'Setting';
$lang->product->soldout      = 'Sold out';

$lang->product->congratulations  = "Congratulations";
$lang->product->addToCartSuccess = "Added to Cart.";
$lang->product->gotoCart         = "Go to Cart";
$lang->product->goback           = "Go Back";

$lang->product->confirmDelete = 'Are you sure to delete it?';

$lang->product->prev      = 'Previous';
$lang->product->next      = 'Next';
$lang->product->none      = 'None';
$lang->product->directory = 'Back';
$lang->product->noCssTag  = 'No &lt;style&gt;&lt;/style&gt; tag';
$lang->product->noJsTag   = 'No &lt;script&gt;&lt;/script&gt; tag';

$lang->product->statusList['normal']  = 'On sale';
$lang->product->statusList['offline'] = 'Offline';

$lang->product->placeholder = new stdclass();
$lang->product->placeholder->label    = "Attribute name: price, color etc";
$lang->product->placeholder->value    = "Attribute value: $1000, red etc";
$lang->product->placeholder->currency = "Dollar sign for price of product, \"$\" for USD dollar.";

$lang->product->listMode = new stdclass();
$lang->product->listMode->card  = "<i class='icon icon-th-large'></i>";
$lang->product->listMode->list  = "<i class='icon icon-list'></i>";

$lang->product->currencyList['rmb']  = 'Renminbi Yuan';
$lang->product->currencyList['usd']  = 'U.S.Dollar';
$lang->product->currencyList['hkd']  = 'HongKong Dollars';
$lang->product->currencyList['twd']  = 'New Taiwan Dollar';
$lang->product->currencyList['euro'] = 'Euro';
$lang->product->currencyList['dem']  = 'Deutsche Mark';
$lang->product->currencyList['chf']  = 'Swiss Franc';
$lang->product->currencyList['frf']  = 'French Franc';
$lang->product->currencyList['gbp']  = 'Pound';
$lang->product->currencyList['nlg']  = 'Florin';
$lang->product->currencyList['cad']  = 'Canadian Dollar';
$lang->product->currencyList['sur']  = 'Rouble';
$lang->product->currencyList['inr']  = 'Indian Rupee';
$lang->product->currencyList['aud']  = 'Australian Dollar';
$lang->product->currencyList['nzd']  = 'New Zealand Dollar';
$lang->product->currencyList['thb']  = 'Thai Baht';
$lang->product->currencyList['sgd']  = 'Ssingapore Dollar';

/* Currency symbols setting. */
$lang->product->currencySymbols['rmb']  = '￥';
$lang->product->currencySymbols['usd']  = '$';
$lang->product->currencySymbols['hkd']  = 'HK$';
$lang->product->currencySymbols['twd']  = 'NT$';
$lang->product->currencySymbols['euro'] = 'ECU';
$lang->product->currencySymbols['dem']  = 'DM';
$lang->product->currencySymbols['chf']  = 'SF';
$lang->product->currencySymbols['frf']  = 'FF';
$lang->product->currencySymbols['gbp']  = '￡';
$lang->product->currencySymbols['nlg']  = 'F';
$lang->product->currencySymbols['cad']  = 'CAN$';
$lang->product->currencySymbols['sur']  = 'Rbs';
$lang->product->currencySymbols['inr']  = 'Rs';
$lang->product->currencySymbols['aud']  = 'A$';
$lang->product->currencySymbols['nzd']  = 'NZ$';
$lang->product->currencySymbols['thb']  = 'B';
$lang->product->currencySymbols['sgd']  = 'S$';

$lang->product->stockOptions = array();
$lang->product->stockOptions[0] = 'Close';
$lang->product->stockOptions[1] = 'open';
