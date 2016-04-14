<?php
/* Shop items. */
$config->shop = new stdclass();
$config->shop->confirmLimit = 7;
$config->shop->payment      = 'COD';

 /* Alipay items. */
$config->alipay = new stdclass();
$config->alipay->direct = new stdclass();
$config->alipay->direct->payGW     = 'https://www.alipay.com/cooperate/gateway.do?';
$config->alipay->direct->checkGW   = "http://notify.alipay.com/trade/notify_query.do?";
$config->alipay->direct->service   = 'create_direct_pay_by_user'; 
$config->alipay->direct->signType  = 'MD5';
$config->alipay->direct->payType   = 1;
$config->alipay->direct->charset   = 'utf-8';

$config->alipay->direct->pid   = '';
$config->alipay->direct->key   = '';
$config->alipay->direct->email = '';

$config->alipay->direct->map['service']   = 'service';
$config->alipay->direct->map['signType']  = 'sign_type';
$config->alipay->direct->map['payType']   = 'payment_type';
$config->alipay->direct->map['charset']   = '_input_charset';
$config->alipay->direct->map['notifyURL'] = 'notify_url';
$config->alipay->direct->map['returnURL'] = 'return_url';

$config->alipay->direct->map['pid']       = 'partner';
$config->alipay->direct->map['key']       = 'security_code';
$config->alipay->direct->map['email']     = 'seller_email';

$config->alipay->direct->map['orderNO'] = 'out_trade_no';
$config->alipay->direct->map['subject'] = 'subject';
$config->alipay->direct->map['money']   = 'total_fee';
$config->alipay->direct->map['body']    = 'body';
$config->alipay->direct->map['extra']   = 'extra_common';

$config->alipay->secured = new stdclass();
$config->alipay->secured->payGW         = 'https://mapi.alipay.com/gateway.do?';
$config->alipay->secured->checkGW       = "http://notify.alipay.com/trade/notify_query.do?";
$config->alipay->secured->service       = 'create_partner_trade_by_buyer'; 
$config->alipay->secured->signType      = 'MD5';
$config->alipay->secured->payType       = 1;
$config->alipay->secured->charset       = 'utf-8';
$config->alipay->secured->quantity      = '1';

$config->alipay->secured->logisticsType    = 'EXPRESS';
$config->alipay->secured->logisticsPayment = 'SELLER_PAY';
$config->alipay->secured->logisticsFee     = '0.00';

$config->alipay->secured->pid   = '';
$config->alipay->secured->key   = '';
$config->alipay->secured->email = '';

$config->alipay->secured->map['service']   = 'service';
$config->alipay->secured->map['signType']  = 'sign_type';
$config->alipay->secured->map['payType']   = 'payment_type';
$config->alipay->secured->map['charset']   = '_input_charset';
$config->alipay->secured->map['notifyURL'] = 'notify_url';
$config->alipay->secured->map['returnURL'] = 'return_url';
$config->alipay->secured->map['quantity']  = 'quantity';

$config->alipay->secured->map['pid']       = 'partner';
$config->alipay->secured->map['key']       = 'security_code';
$config->alipay->secured->map['email']     = 'seller_email';

$config->alipay->secured->map['orderNO'] = 'out_trade_no';
$config->alipay->secured->map['subject'] = 'subject';
$config->alipay->secured->map['money']   = 'price';
$config->alipay->secured->map['body']    = 'body';
$config->alipay->secured->map['extra']   = 'extra_common';

$config->alipay->secured->map['logisticsType']    = 'logistics_type';
$config->alipay->secured->map['logisticsPayment'] = 'logistics_payment';
$config->alipay->secured->map['logisticsFee']     = 'logistics_fee';
