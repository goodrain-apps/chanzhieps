<?php
/**
 * The basic OAuth class.
 * 
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      chunsheng wang <chunsheng@cnezsoft.com> 
 * @package     OAuth
 * @version     $Id$
 * @Link        http://www.chanzhi.org
 */
class OAuth
{
    /**
     * The provider like qq, weibo or google.
     * 
     * @var string   
     * @access public
     */
    public $provider;

    /**
     * The client id.
     * 
     * @var int   
     * @access public
     */
    public $clientID;

    /**
     * The client secret.
     * 
     * @var string   
     * @access public
     */
    public $clientSecret;

    /**
     * The uri to redirect.
     * 
     * @var string
     * @access public
     */
    public $redirectURI;

    /**
     * The random string to keep state. string to pass to authorize api and return back to the redirect uri.
     * 
     * @var string   
     * @access public
     */
    public $state;

    /**
     * The factory function.
     * 
     * @param  string    $provider      the service provider like qq, sina, google. 
     * @param  object    $config        the config object. 
     * @param  string    $redirectURI   the redirect uri.
     * @static
     * @access public
     * @return object
     */
    public static function factory($provider, $config, $redirectURI = '')
    {
        $className = $provider;
        $classFile = dirname(__FILE__) . DS . $provider . '.class.php';
        if(!is_file($classFile)) return trigger_error("thie class file for {$provider} OAuth not found");

        include $classFile;

        return new $className($provider, $config, $redirectURI);
    }

    /**
     * The construct function, to init the client.
     * 
     * @param  string    $provider
     * @param  object    $config
     * @param  string    $redirectURI 
     * @access public
     * @return void
     */
    public function __construct($provider, $config, $redirectURI = '')
    {
        $this->provider     = $provider;
        $this->clientID     = $config->clientID;
        $this->clientSecret = $config->clientSecret;
        $this->redirectURI  = $redirectURI;

        $this->setState();
    }

    /**
     * Set the random state string.
     * 
     * @access public
     * @return void
     */
    public function setState()
    {
        if(isset($_SESSION['oauthState'])) return $this->state = $_SESSION['oauthState'];

        $this->state = md5(uniqid(mt_rand()));
        $_SESSION['oauthState'] = $this->state;
    }

    /**
     * Create the api of authorize.
     * 
     * @access public
     * @return string
     */
    public function createAuthorizeAPI()
    {
    }

    /**
     * Get tokeny data.
     * 
     * @param  string    $code 
     * @access public
     * @return misc
     */
    public function getToken($code)
    {
    }

    /**
     * Create the api of token.
     * 
     * @param  string    $token 
     * @access public
     * @return string
     */
    public function createTokenAPI($token)
    {
    }

    /**
     * Get open id data.
     * 
     * @param  string    $token 
     * @access public
     * @return misc
     */
    public function getOpenID($token)
    {
    }

    /**
     * Create the api of openID.
     * 
     * @param  string    $token 
     * @access public
     * @return string
     */
    public function createOpenIDAPI($token = '')
    {
    }

    /**
     * Get user info.
     * 
     * @param  string    $token 
     * @param  string    $openID 
     * @access public
     * @return misc
     */
    public function getUserInfo($token, $openID)
    {
    }

    /**
     * Create the api of user info.
     *
     * @param  string    $token 
     * @param  string    $openID 
     * @access public
     * @return string
     */
    public function createUserInfoAPI($token, $openID)
    {
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

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }   

    /**
     * Make a post request.
     * 
     * @param  string $url 
     * @param  array  $params 
     * @access public
     * @return void
     */
    public function post($url, $params)
    {
        if(!function_exists('curl_init')) die('I can\'t do post action without curl extension.');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
