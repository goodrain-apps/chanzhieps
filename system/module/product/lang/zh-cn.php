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
$lang->product->common = '产品';
$lang->product->home   = '产品中心';

$lang->product->id         = '编号';
$lang->product->category   = '类目';
$lang->product->categories = '类目';
$lang->product->name       = '名称';
$lang->product->alias      = '别名';
$lang->product->mall       = '购买链接';
$lang->product->buyNow     = '立即购买';
$lang->product->brand      = '品牌';
$lang->product->model      = '型号';
$lang->product->color      = '颜色';
$lang->product->origin     = '产地';
$lang->product->unit       = '单位';
$lang->product->price      = '价格';
$lang->product->promotion  = '特价';
$lang->product->amount     = '数量';
$lang->product->keywords   = '关键字';
$lang->product->desc       = '简介';
$lang->product->content    = '详情';
$lang->product->author     = '作者';
$lang->product->editor     = '编辑';
$lang->product->addedDate  = '添加时间';
$lang->product->editedDate = '编辑时间';
$lang->product->status     = '状态';
$lang->product->views      = '浏览';
$lang->product->viewsCount = '浏览次数';
$lang->product->stick      = '置顶级别';
$lang->product->order      = '排序';
$lang->product->unsaleable = '非卖品';
$lang->product->attribute  = '产品属性';
$lang->product->custom     = '自定义属性';
$lang->product->sales      = '产品定价';
$lang->product->css        = 'CSS';
$lang->product->js         = 'JS';

$lang->product->currency = '货币';
$lang->product->stock    = '库存';

$lang->product->list         = '产品列表';
$lang->product->hot          = '热门产品';
$lang->product->admin        = '维护产品';
$lang->product->create       = '添加产品';
$lang->product->edit         = '编辑产品';
$lang->product->changeStatus = '修改产品状态';
$lang->product->setcss       = '设置CSS';
$lang->product->setjs        = '设置JS';
$lang->product->files        = '附件';
$lang->product->images       = '图片';
$lang->product->addToCart    = "<i class='icon icon-shopping-cart'></i> 加入购物车";
$lang->product->count        = '数量';
$lang->product->comments     = '评论';
$lang->product->detail       = '查看详情';
$lang->product->setting      = '设置';
$lang->product->soldout      = '已售罄';

$lang->product->congratulations  = "恭喜";
$lang->product->addToCartSuccess = "成功加入购物车。";
$lang->product->gotoCart         = "去购物车结算";
$lang->product->goback           = "返回";

$lang->product->confirmDelete = '您确定删除该产品吗？';

$lang->product->prev      = '上一个';
$lang->product->next      = '下一个';
$lang->product->none      = '没有了';
$lang->product->directory = '返回目录';
$lang->product->noCssTag  = '不需要&lt;style&gt;&lt;/style&gt;标签';
$lang->product->noJsTag   = '不需要&lt;script&gt;&lt;/script&gt;标签';

$lang->product->statusList['normal']  = '上架';
$lang->product->statusList['offline'] = '下架';

$lang->product->placeholder = new stdclass();
$lang->product->placeholder->label    = "属性名称：如颜色、价格等";
$lang->product->placeholder->value    = "属性值：如红色、￥1000等";
$lang->product->placeholder->currency = "请填写产品价格的货币符号，如人民币填写：￥";

$lang->product->listMode = new stdclass();
$lang->product->listMode->card  = "<i class='icon icon-th-large'></i>";
$lang->product->listMode->list  = "<i class='icon icon-list'></i>";

$lang->product->currencyList['rmb']  = '人民币';
$lang->product->currencyList['usd']  = '美元';
$lang->product->currencyList['hkd']  = '港元';
$lang->product->currencyList['twd']  = '台元';
$lang->product->currencyList['euro'] = '欧元';
$lang->product->currencyList['dem']  = '马克';
$lang->product->currencyList['chf']  = '瑞士法郎';
$lang->product->currencyList['frf']  = '法国法郎';
$lang->product->currencyList['gbp']  = '英镑';
$lang->product->currencyList['nlg']  = '荷兰盾';
$lang->product->currencyList['cad']  = '加拿大元';
$lang->product->currencyList['sur']  = '卢布';
$lang->product->currencyList['inr']  = '卢比';
$lang->product->currencyList['aud']  = '澳大利亚元';
$lang->product->currencyList['nzd']  = '新西兰元';
$lang->product->currencyList['thb']  = '泰国铢';
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
$lang->product->stockOptions[0] = '关闭';
$lang->product->stockOptions[1] = '开启';
