<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The product category zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->product->common = '產品';
$lang->product->home   = '產品中心';

$lang->product->id         = '編號';
$lang->product->category   = '類目';
$lang->product->categories = '類目';
$lang->product->name       = '名稱';
$lang->product->alias      = '別名';
$lang->product->mall       = '購買連結';
$lang->product->buyNow     = '立即購買';
$lang->product->brand      = '品牌';
$lang->product->model      = '型號';
$lang->product->color      = '顏色';
$lang->product->origin     = '產地';
$lang->product->unit       = '單位';
$lang->product->price      = '價格';
$lang->product->promotion  = '特價';
$lang->product->amount     = '數量';
$lang->product->keywords   = '關鍵字';
$lang->product->desc       = '簡介';
$lang->product->content    = '詳情';
$lang->product->author     = '作者';
$lang->product->editor     = '編輯';
$lang->product->addedDate  = '添加時間';
$lang->product->editedDate = '編輯時間';
$lang->product->status     = '狀態';
$lang->product->views      = '瀏覽';
$lang->product->viewsCount = '瀏覽次數';
$lang->product->stick      = '置頂級別';
$lang->product->order      = '排序';
$lang->product->unsaleable = '非賣品';
$lang->product->attribute  = '產品屬性';
$lang->product->custom     = '自定義屬性';
$lang->product->sales      = '產品定價';
$lang->product->css        = 'CSS';
$lang->product->js         = 'JS';

$lang->product->currency = '貨幣';
$lang->product->stock    = '庫存';

$lang->product->list         = '產品列表';
$lang->product->hot          = '熱門產品';
$lang->product->admin        = '維護產品';
$lang->product->create       = '添加產品';
$lang->product->edit         = '編輯產品';
$lang->product->changeStatus = '修改產品狀態';
$lang->product->setcss       = '設置CSS';
$lang->product->setjs        = '設置JS';
$lang->product->files        = '附件';
$lang->product->images       = '圖片';
$lang->product->addToCart    = "<i class='icon icon-shopping-cart'></i> 加入購物車";
$lang->product->count        = '數量';
$lang->product->comments     = '評論';
$lang->product->detail       = '查看詳情';
$lang->product->setting      = '設置';
$lang->product->soldout      = '已售罄';

$lang->product->congratulations  = "恭喜";
$lang->product->addToCartSuccess = "成功加入購物車。";
$lang->product->gotoCart         = "去購物車結算";
$lang->product->goback           = "返回";

$lang->product->confirmDelete = '您確定刪除該產品嗎？';

$lang->product->prev      = '上一個';
$lang->product->next      = '下一個';
$lang->product->none      = '沒有了';
$lang->product->directory = '返回目錄';
$lang->product->noCssTag  = '不需要&lt;style&gt;&lt;/style&gt;標籤';
$lang->product->noJsTag   = '不需要&lt;script&gt;&lt;/script&gt;標籤';

$lang->product->statusList['normal']  = '上架';
$lang->product->statusList['offline'] = '下架';

$lang->product->placeholder = new stdclass();
$lang->product->placeholder->label    = "屬性名稱：如顏色、價格等";
$lang->product->placeholder->value    = "屬性值：如紅色、￥1000等";
$lang->product->placeholder->currency = "請填寫產品價格的貨幣符號，如人民幣填寫：￥";

$lang->product->listMode = new stdclass();
$lang->product->listMode->card  = "<i class='icon icon-th-large'></i>";
$lang->product->listMode->list  = "<i class='icon icon-list'></i>";

$lang->product->currencyList['rmb']  = '人民幣';
$lang->product->currencyList['usd']  = '美元';
$lang->product->currencyList['hkd']  = '港元';
$lang->product->currencyList['twd']  = '台元';
$lang->product->currencyList['euro'] = '歐元';
$lang->product->currencyList['dem']  = '馬克';
$lang->product->currencyList['chf']  = '瑞士法郎';
$lang->product->currencyList['frf']  = '法國法郎';
$lang->product->currencyList['gbp']  = '英鎊';
$lang->product->currencyList['nlg']  = '荷蘭盾';
$lang->product->currencyList['cad']  = '加拿大元';
$lang->product->currencyList['sur']  = '盧布';
$lang->product->currencyList['inr']  = '盧比';
$lang->product->currencyList['aud']  = '澳大利亞元';
$lang->product->currencyList['nzd']  = '新西蘭元';
$lang->product->currencyList['thb']  = '泰國銖';
$lang->product->currencyList['sgd']  = '新加坡元';

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
$lang->product->stockOptions[0] = '關閉';
$lang->product->stockOptions[1] = '開啟';
