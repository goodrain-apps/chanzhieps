<?php
/**
 * The sina client class for OAuth.
 * 
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      chunsheng wang <chunsheng@cnezsoft.com> 
 * @package     OAuth
 * @version     $Id$
 * @Link        http://www.chanzhi.org
 */
class sina extends OAuth
{
    /**
     * The authorize api.
     * 
     * @var string
     * @access public
     */
    public $authorizeAPI = 'https://api.weibo.com/oauth2/authorize?';

    /**
     * The token api.
     * 
     * @var string
     * @access public
     */
    public $tokenAPI ='https://api.weibo.com/oauth2/access_token';

    /**
     * The user info api.
     * 
     * @var string
     * @access public
     */
    public $userInfoAPI = 'https://api.weibo.com/2/users/show.json?';

    /**
     * Create the api of authorize.
     * 
     * @access public
     * @return string
     */
    public function createAuthorizeAPI()
    {
        $params['response_type'] = 'code';
        $params['client_id']     = $this->clientID;
        $params['redirect_uri']  = $this->redirectURI;
        $params['state']         = $this->state;
		$params['display']       = 'default';

        return $this->authorizeAPI . http_build_query($params);
    }

    /**
     * Get token data.
     * 
     * @param  string    $code 
     * @access public
     * @return void
     */
    public function getToken($code)
    {
        $data = $this->post($this->tokenAPI, $this->createTokenParams($code));
        $data = json_decode($data);

        $token = new stdclass();
        $token->openID      = isset($data->uid) ? $data->uid : '';
        $token->accessToken = isset($data->access_token) ? $data->access_token : '';

        return $token;
    }

    /**
     * Create the params for token api.
     * 
     * @param  string   $code 
     * @access public
     * @return array
     */
    public function createTokenParams($code)
    {
        $params['grant_type']    = 'authorization_code';
        $params['client_id']     = $this->clientID;
        $params['client_secret'] = $this->clientSecret;
        $params['redirect_uri']  = $this->redirectURI;
        $params['code']          = $code;

        return http_build_query($params);
    }

    /**
     * Get the open id.
     * 
     * @param  object    $token 
     * @access public
     * @return int
     */
    public function getOpenID($token)
    {
        return $token->openID;
    }

    /**
     * Get user info.
     * 
     * @param  string    $token 
     * @param  string    $openID 
     * @access public
     * @return object
     */
    public function getUserInfo($token, $openID)
    {
        $data = $this->get($this->createUserInfoAPI($token->accessToken, $openID));
        return json_decode($data);
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
        $params['access_token'] = $token;
        $params['uid']          = $openID;

        return $this->userInfoAPI . http_build_query($params);
    }
}
