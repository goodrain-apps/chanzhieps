<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->order->common  = '訂單';

$lang->order->id             = 'ID';
$lang->order->productInfo    = '商品信息';
$lang->order->account        = '賬號';
$lang->order->address        = '收貨地址';
$lang->order->price          = '價格';
$lang->order->count          = '數量';
$lang->order->amount         = '金額';
$lang->order->sn             = '交易號';
$lang->order->payStatus      = '付款狀態';
$lang->order->paidDate       = '付款時間';
$lang->order->deliveryStatus = '發貨狀態';
$lang->order->deliveriedDate = '發貨時間';
$lang->order->confirmedDate  = '收貨時間';
$lang->order->payment        = '交易方式';
$lang->order->createdDate    = '下單時間';
$lang->order->express        = '快遞公司';
$lang->order->waybill        = '快遞單號';
$lang->order->expressInfo    = '快遞詳情';
$lang->order->receiver       = '收貨人';
$lang->order->noRecord       = '無';
$lang->order->status         = '狀態';
$lang->order->note           = '買家留言';

$lang->order->admin          = '訂單管理';
$lang->order->setting        = '系統設置';
$lang->order->browse         = '我的訂單';
$lang->order->bought         = '查看已買到的商品';
$lang->order->createdSuccess = '訂單創建成功！';
$lang->order->paidSuccess    = '訂單支付成功！';
$lang->order->submit         = '提交訂單';
$lang->order->cancel         = '取消';
$lang->order->pay            = '支付';
$lang->order->goToPay        = '訂單創建成功，請到支付頁面完成付款。';
$lang->order->return         = '收款';
$lang->order->delivery       = '發貨';
$lang->order->finish         = '完成';
$lang->order->confirm        = '確認訂單信息';
$lang->order->selectProducts = "選擇了 <strong class='text-danger'>%s</strong> 件商品，";
$lang->order->totalToPay     = "共計：<strong id='amount' class='text-danger'>%s</strong>";
$lang->order->payInfo        = "%s %s 商品訂單";
$lang->order->goToBank       = "請在綫支付您的訂單。";
$lang->order->track          = '查看物流';
$lang->order->life           = '訂單跟蹤';
$lang->order->days           = '天';
$lang->order->deliveryInfo   = '查看詳情';
$lang->order->backToCart     = '返回購物車修改';
$lang->order->paid           = '我已付款';
$lang->order->products       = '訂單產品';
$lang->order->selectPayment  = '選擇支付方式';
$lang->order->settlement     = '去結算';

$lang->order->confirmLimit         = '確認收貨周期';
$lang->order->confirmReceived      = '確認收貨';
$lang->order->deliveryConfirmed    = '您的訂單已經確認收貨成功！';
$lang->order->confirmWarning       = "請收到貨後，再確認收貨！否則您可能錢貨兩空！";
$lang->order->cancelWarning        = "確認取消訂單？";
$lang->order->cancelSuccess        = "訂單已取消";
$lang->order->paymentRequired      = '需要至少一種交易方式';
$lang->order->confirmLimitRequired = '需要設定確認收貨周期';
$lang->order->finishWarning        = "確認完成訂單？";
$lang->order->noProducts           = "訂單中沒有產品";
$lang->order->lowStocks            = "<strong>%s</strong> 庫存不足";

$lang->order->alipayPid   = '合作者ID';
$lang->order->alipayKey   = '合作者KEY';
$lang->order->alipayEmail = '支付寶郵箱';
$lang->order->score       = '積分充值';

$lang->order->placeholder = new stdclass();
$lang->order->placeholder->pid   = '合作身份者id，以2088開頭的16位純數字';
$lang->order->placeholder->key   = '安全檢驗碼，以數字和字母組成的32位字元';
$lang->order->placeholder->email = '支付寶商家郵箱';

$lang->order->paymentList = array();
$lang->order->paymentList['alipay']        = '支付寶即時到帳';
$lang->order->paymentList['alipaySecured'] = '支付寶擔保交易';
$lang->order->paymentList['COD']           = '貨到付款';

$lang->order->statusList = array();
$lang->order->statusList['not_paid']  = '待付款';
$lang->order->statusList['paid']      = '已付款';
$lang->order->statusList['not_send']  = '待發貨';
$lang->order->statusList['send']      = '已發貨';
$lang->order->statusList['confirmed'] = '已收貨';
$lang->order->statusList['normal']    = '進行中';
$lang->order->statusList['finished']  = '已完成';
$lang->order->statusList['canceled']  = '已取消';
