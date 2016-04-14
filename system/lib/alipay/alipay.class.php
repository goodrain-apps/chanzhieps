<?php
class alipay
{
    public $config;

    /* 构造函数。*/
    public function __construct($config)
    {
        $this->initConfig($config);
    }

    /* 生成支付链接。*/
    public function createPayLink($orderNO, $subject, $money, $body = '', $extra = '')
    {
        /* 将这些参数设置到config对象中。*/
        $this->setConfig('orderNO', $orderNO);
        $this->setConfig('subject', $subject);
        $this->setConfig('money',   $money);
        $this->setConfig('body',    $body);
        $this->setConfig('extra',   $extra);

        /* 生成支付所需要的参数，并生成链接。*/
        $params = $this->createPayParams();

        $link = $this->config->payGW . http_build_query($params);
        return $link;
    }

    /* 初始化配置。*/
    private function initConfig($config)
    {
        $this->config = $config;
    }

    /* 设置某一个配置参数的值。*/
    private function setConfig($key, $value)
    {
        $this->config->$key = $value;
    }

    /* 生成支付需要的参数。*/
    private function createPayParams()
    {
        foreach($this->config->map as $ourKey => $aliKey)
        {
            if(isset($this->config->$ourKey) and $this->config->$ourKey and $ourKey != 'key') $params[$aliKey] = $this->config->$ourKey;
        }
        $params['sign'] = $this->createSign($params);
        return $params;
    }

    public function checkNotify($params)
    {
        if(!isset($params['notify_id']) or !isset($params['sign'])) return false;

        /* 检查是否通知信息是否真实有效。*/
        $noticeID = $params['notify_id'];
        $exterface = $params['exterface'];
        if($exterface == 'create_direct_pay_by_user')
        {
            $checkURL = $this->config->direct->checkGW . "partner={$this->config->pid}&notify_id=$noticeID";
        }
        else
        {
            $checkURL = $this->config->secured->checkGW . "partner={$this->config->pid}&notify_id=$noticeID";
        }
        $result = strtolower(trim(file_get_contents($checkURL)));
        if($result != 'true') return false;

        /* 签名检查。*/
        $mySign = $this->createSign($params);
        return $mySign == $params['sign'];
    }

    /* 生成签名。*/
    private function createSign($params)
    {
        /* 去掉不参与加密运算的元素。*/
        unset($params['sign_type']);
        unset($params['sign']);
        unset($params['key']);

        /* 按照键值进行排序。*/
        ksort($params);

        /* 拼接变量。需要调用一下urldeocde，估计支付宝那边是把参数decode之后进行签名的。*/
        $queryString = urldecode(http_build_query($params));
        $queryString .= $this->config->key;

        /* 加密。*/
        return md5($queryString);
    }

    /**
     * Post delivery to alipay.
     * 
     * @param  int    $sn 
     * @param  int    $logistics 
     * @param  int    $waybill 
     * @param  int    $type 
     * @access public
     * @return void
     */
    public function postDelivery($sn, $logistics, $waybill, $type)
    {
        $params = array();
        $params["service"]        = "send_goods_confirm_by_platform";
        $params["partner"]        = $this->config->pid;
        $params["seller_email"]   = $this->config->email;
        $params["trade_no"]       = $sn;
        $params["logistics_name"] = $logistics;
        $params["invoice_no"]     = $waybill;
        $params["transport_type"] = 'EXPRESS';
        $params["_input_charset"] = $this->config->charset;
        $params['sign']           = $this->createSign($params);
        $params['sign_type']      = 'MD5';
        
        $url  = $this->config->payGW . "_input_charset=" . $this->config->charset;
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($curl, CURLOPT_CAINFO, $this->config->cacert);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_POST, true);
        curl_setopt($curl,CURLOPT_POSTFIELDS, $params);

        $response = curl_exec($curl);
        $errors   = curl_error($curl);
        curl_close($curl);
        if(!empty($errors)) 
        {
            return false;
        }

        $message = new simpleXMLElement($response);
        $result = new stdclass();

        foreach($message as $key => $value)
        {
            if( function_exists('lcfirst')) 
            {
                $key = lcfirst($key);
            }
            else
            {
                $first = strtolower(substr($key, 0, 1));   
                $key   = $first . substr($key, 1);
            }

            $value = $key == 'event' ? strtolower($value) : $value;
            $result->$key = (string)$value;
        }
        return $result->is_success == 'T';
    }
}
