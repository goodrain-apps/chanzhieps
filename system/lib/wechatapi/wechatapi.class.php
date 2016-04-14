<?php
/**
 * The wechat class file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     lib
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class wechatapi
{
    /**
     * The token.
     * 
     * @var string   
     * @access public
     */
    public $token;

    /**
     * The application id.
     * 
     * @var string   
     * @access public
     */
    public $appID;

    /**
     * The application secret.
     * 
     * @var string   
     * @access public
     */
    public $secret;

    /**
     * The signature computed.
     * 
     * @var int   
     * @access public
     */
    public $signature;

    /**
     * The raw data posted by wechat server.
     * 
     * @var string   
     * @access public
     */
    public $rawData;

    /**
     * The message object.
     * 
     * @var object   
     * @access public
     */
    public $message;

    /**
     * The response object.
     * 
     * @var object   
     * @access public
     */
    public $response;

    /**
     * The reply object.
     * 
     * @var object   
     * @access public
     */
    public $reply;

    /**
     * Debug or not.
     * 
     * @var bool   
     * @access public
     */
    public $debug;

    /**
     * The log file.
     * 
     * @var string   
     * @access public
     */
    public $logFile;

    /**
     * The construct function.
     * 
     * @param  string    $token 
     * @param  string    $appID 
     * @param  string    $secret 
     * @param  bool      $debug 
     * @access public
     * @return void
     */
    public function __construct($token, $appID, $secret, $debug = false)
    {
        $this->setToken($token);
        $this->setAppID($appID);
        $this->setSecret($secret);
        $this->setDebug($debug);
    }

    /**
     * Set debug.
     * 
     * @param  bool    $debug 
     * @access public
     * @return void
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * Set the application token.
     * 
     * @param  string    $token 
     * @access public
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set the application id.
     * 
     * @param  string    $appID 
     * @access public
     * @return void
     */
    public function setAppID($appID)
    {
        $this->appID = $appID;
    }

    /**
     * Set the application secret.
     * 
     * @param  string    $secret 
     * @access public
     * @return void
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Check the signature.
     * 
     * @access public
     * @return void
     */
    public function checkSign()
    {
        if(empty($_GET['signature']) or empty($_GET['timestamp']) or empty($_GET['nonce'])) die('evil');

        $sign = $_GET['signature'];
        $time = $_GET['timestamp'];
        $rand = $_GET['nonce'];    

        $this->computeSign($time, $rand);
        if($sign != $this->signature) die('signature error');
        if(isset($_GET['echostr'])) die($_GET['echostr']);
    }

    /**
     * Compute the signature.
     * 
     * @param  int    $time 
     * @param  string $rand 
     * @access public
     * @return void
     */
    public function computeSign($time, $rand)
    {
        $sign = array($this->token, $time, $rand);
        sort($sign, SORT_STRING);
        $this->signature = sha1(join($sign));
    }

    /**
     * Get a message from wechat server.
     * 
     * @access public
     * @return void
     */
    public function getMessage()
    {
        $this->rawData = '';
        $this->message = new stdclass();
        $post = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : file_get_contents('php://input');
        if($post)
        {
            $this->rawData = str_replace('&', '&amp;', $post);
            $message = new simpleXMLElement($this->rawData);
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
                $this->message->$key = (string)$value;
            }
        }

        return $this->message;
    }

    /**
     * Response a message.
     * 
     * @param  object    $response 
     * @access public
     * @return void
     */
    public function response($response)
    {
        $response->toUserName   = $this->message->fromUserName;
        $response->fromUserName = $this->message->toUserName;
        $response->createTime   = time();
        $this->response = $this->convertResponse2XML($response);
        echo $this->response;
    }

    /**
     * Convert a response object to a xml message.
     * 
     * @param  object    $response 
     * @access public
     * @return string
     */
    public function convertResponse2XML($response)
    {
        /* Split the articles if the message is news. */
        $msgType = ucfirst($response->msgType);
        if($msgType == 'News') 
        {
            $articles = $response->articles;
            unset($response->articles);
        }

        /* Join other fields. */
        $xml = "<xml>\n";
        foreach($response as $key => $value)
        {
            $key = ucfirst($key);
            if($key == 'MediaId') $xml .= "<$msgType><$key><![CDATA[$value]]></$key></$msgType>";
            if($key != 'MediaId') $xml .= "<$key><![CDATA[$value]]></$key>\n";
        }
        if(!isset($articles)) return $xml . '</xml>';

        /* Join articles. */
        $xml .= '<ArticleCount>' . count($articles) . "</ArticleCount>\n<Articles>\n";
        foreach($articles as $article)
        {
            $xml .= "<item>\n";
            foreach($article as $key => $value)
            {
                $key = ucfirst($key);
                $xml .= "<$key><![CDATA[$value]]></$key>\n";
            }
            $xml .= "</item>\n";
        }
        $xml .= "</Articles>\n</xml>";
        return $xml;
    }

    /**
     * Reply a message.
     * 
     * @param  string    $to 
     * @param  string    $type 
     * @param  object    $message 
     * @access public
     * @return void
     */
    public function reply($to, $type, $message)
    {
        $reply = new stdclass();
        $reply->touser  = $to;
        $reply->msgtype = $type;
        $reply->$type   = $message;
        $this->reply    = $reply;
        
        $token = $this->getAccessToken(true);
        $url   = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$token";

        $result = $this->post($url, $this->convertReply2JSON($this->reply));
        $result = json_decode($result);

        if(isset($result->errcode) and $result->errcode == 0) return array('result' => 'success');
        return array('result' => 'fail' , 'message' => $result->errcode . ':' . $result->errmsg);
    }

    /**
     * Convert an reply object to json.
     * 
     * @param   object    $reply 
     * @access public
     * @return json
     */
    public function convertReply2JSON($reply)
    {
        if(isset($reply->text->content)) $reply->text->content = urlencode($reply->text->content);
        if(isset($reply->articles))
        {
            foreach($reply->articles as $article)
            {
                if(isset($article->title)) $article->title = urlencode($article->title);
                if(isset($article->description)) $article->description = urlencode($article->description);
            }
        }

        return urldecode(json_encode($reply));
    }

    /**
     * Commit menu to wechat server.
     * 
     * @param  array    $menu 
     * @access public
     * @return bool
     */
    public function commitMenu($menu)
    {
        $token  = $this->getAccessToken(true);
        $url    = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$token";
        $menu   = $this->convertMenu2JSON($menu);
        $result = $this->post($url, $menu);
        $result = json_decode($result);

        if(isset($result->errcode) and $result->errcode == 0) return array('result' => 'success');
        return array('result' => 'fail' , 'message' => $result->errcode . ':' . $result->errmsg);
    }

    /**
     * Delete menu.
     * 
     * @access public
     * @return void
     */
    public function deleteMenu()
    {
        $token  = $this->getAccessToken(true);
        $url    = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=$token";
        $result = json_decode($this->get($url));

        if(isset($result->errcode) and $result->errcode == 0) return true;
        return false;
    }

    /**
     * Convert menu array into json format.
     * 
     * @param  array    $menu 
     * @access public
     * @return void
     */
    public function convertMenu2JSON($menu)
    {
        foreach($menu['button'] as $button)
        {
            if(isset($button->name)) $button->name = urlencode($button->name);
            if(isset($button->url))  $button->url  = urlencode($button->url);
            if(isset($button->sub_button)) 
            {
                foreach($button->sub_button as $subButton)
                {
                    if(isset($subButton->name)) $subButton->name = urlencode($subButton->name);
                    if(isset($subButton->url))  $subButton->url  = urlencode($subButton->url);
                }
            }
        }

        return urldecode(json_encode($menu));
    }

    /**
     * Upload a media file.
     * 
     * @param  string $type 
     * @param  string $file 
     * @access public
     * @return string
     */
    public function uploadMedia($type, $file)
    {
        $fields['media'] = "@$file";
        $token = $this->getAccessToken(true);
        $url   = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";

        $result = $this->post($url, $fields);
        $result = json_decode($result);

        if(isset($result->media_id)) return $result->media_id;
        return false;
    }

    /**
     * Get a media file.
     * 
     * @param  string    $id 
     * @access public
     * @return binary
     */
    public function getMedia($id)
    {
        $token  = $this->getAccessToken(true);
        $url    = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$token&media_id=$id";
        $result = $this->get($url);

        if(json_decode($result)) return false;
        return $result;
    }

    /**
     * Get fans.
     * 
     * @param  string $next 
     * @access public
     * @return object
     */
    public function getFans($next = '')
    {
        $token = $this->getAccessToken(true);
        $url   = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=$next";
        $result = $this->get($url);
        return json_decode($result);
    }

    /**
     * Get user info.
     * 
     * @param  string $openID 
     * @param  string $lang 
     * @access public
     * @return object
     */
    public function getUserInfo($openID, $lang = 'zh_CN')
    {
        $token = $this->getAccessToken();
        $url   = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openID&lang=$lang";
        $data  = json_decode($this->get($url));
        if($data and !isset($data->errorcode)) return $data;

        $token = $this->getAccessToken(true);
        $url   = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openID&lang=$lang";
        return json_decode($this->get($url));
    }

    /**
     * Get qrcode for a public account.
     * 
     * @param  string    $file 
     * @access public
     * @return void
     */
    public function getQRCode($file)
    {
        /* The params to post. */
        $params['action_name'] = 'QR_LIMIT_SCENE';
        $params['action_info']['scene']['scene_id'] = 1;

        /* Get the ticket. */
        $token = $this->getAccessToken(true);
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
        $data = json_decode($this->post($url, json_encode($params)));
        if(!isset($data->ticket) or (isset($data->errcode) and $data->errcode)) return false;

        /* Get qrcode. */
        $url  = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($data->ticket);
        $data = $this->get($url);
        return file_put_contents($file, $data);
    }

    /**
     * Get access token.
     *
     * @param  bool    $refresh 
     * @access public
     * @return void
     */
    public function getAccessToken($refresh = false)
    {
        /* First try to use the token in session. */
        if(isset($_SESSION['wxToken'][$this->appID]) and $refresh == false)
        {
            if(time() < $_SESSION['wxToken'][$this->appID]->expires) return $_SESSION['wxToken'][$this->appID]->token;
        }

        /* Set params. */
        $time = time();
        $param['appid']      = $this->appID;
        $param['secret']     = $this->secret;
        $param['grant_type'] = 'client_credential';

        /* Get the token. */
        $api  = 'https://api.weixin.qq.com/cgi-bin/token?' . http_build_query($param);
        $data = $this->get($api);
        $data = json_decode($data);
        if(isset($data->errcode) or !$data) return false;

        /* Save it to session. */
        $token = new stdclass();
        $token->token   = $data->access_token;
        $token->expires = $time + ($data->expires_in / 2);
        $_SESSION['wxToken'][$this->appID] = $token;

        return $token->token;
    }

    /** 
     * Make a http get request and fetch the contents.
     * 
     * @param  string    $url 
     * @access public
     * @return string
     */
    public function get($url)
    {   
        if(!function_exists('curl_init')) die('I can\'t fetch anything, please set allow_url_fopen to ture or install curl extension');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }   

    /**
     * Make a http post request.
     * 
     * @param  string    $url 
     * @param  string    $data 
     * @access public
     * @return void
     */
    public function post($url, $data)
    {   
        if(!function_exists('curl_init')) die('I can\'t do post action without curl extension.');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }   

    /**
     * The destruct function, save log.
     * 
     * @access public
     * @return void
     */
    public function __destruct()
    {
        if(!$this->debug) return;

        /* Set log file. */
        $logFile = dirname(dirname(dirname(__FILE__))) . '/tmp/log/wechat.' . date('Ymd') . '.log.php';
        if(!is_writable(dirname($logFile))) return false;

        if(!file_exists($logFile)) file_put_contents($logFile, "<?php die();?> \n");

        /* Init the signature. */
        if(!isset($_GET['signature'])) $_GET['signature'] = '';

        $log  = date('H:i:s: ') . $_SERVER['REQUEST_URI'] . "\n\n";
        $log .= "[Signature]\n" . $_GET['signature'] . " got\n" . $this->signature . " computed\n\n";
        $log .= "[Message]\n" . $this->rawData . "\n";
        $log .= print_r($this->message, true) . "\n";
        $log .= "[Response]\n" . print_r($this->response, true) . "\n";
        $log .= "[Reply]\n" . print_r($this->reply, true) . "\n";

        $fh = fopen($logFile, 'a+');
        fwrite($fh, $log);
    }
}
