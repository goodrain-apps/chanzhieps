<?php
/**
 * The qq client class for OAuth.
 * 
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @author      chunsheng wang <chunsheng@cnezsoft.com> 
 * @package     OAuth
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @version     $Id$
 * @Link        http://www.chanzhi.org
 */
class qq extends OAuth
{
    /**
     * The authorize api.
     * 
     * @var string
     * @access public
     */
    public $authorizeAPI = 'https://graph.qq.com/oauth2.0/authorize?';

    /**
     * The authorize scope.
     * 
     * @var string
     * @access public
     */
    public $authorizeScope = 'get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist,add_idol,del_idol,get_tenpay_addr';

    /**
     * The token api.
     * 
     * @var string
     * @access public
     */
    public $tokenAPI ='https://graph.qq.com/oauth2.0/token?';

    /**
     * The open id api.
     * 
     * @var string
     * @access public
     */
    public $openIdAPI = 'https://graph.qq.com/oauth2.0/me?';

    /**
     * The user info api.
     * 
     * @var string
     * @access public
     */
    public $userInfoAPI = 'https://graph.qq.com/user/get_user_info?';

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
        $params['scope']         = $this->authorizeScope;

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
        $data = $this->get($this->createTokenAPI($code));
        parse_str($data, $tokens);
        return $tokens['access_token'];
    }

    /**
     * Create the api of token.
     * 
     * @param  string   $code 
     * @access public
     * @return string
     */
    public function createTokenAPI($code)
    {
        $params['grant_type']    = 'authorization_code';
        $params['client_id']     = $this->clientID;
        $params['client_secret'] = $this->clientSecret;
        $params['redirect_uri']  = $this->redirectURI;
        $params['code']          = $code;

        return $this->tokenAPI . http_build_query($params);
    }

    /**
     * Get the open id.
     * 
     * @param  string    $token 
     * @access public
     * @return string
     */
    public function getOpenID($token)
    {
        $data = $this->get($this->createOpenIDAPI($token));

        if(strpos($data, 'callback') !== false)
        {
            $left  = strpos($data, '(');
            $right = strrpos($data, ')');
            $data = substr($data, $left + 1, $right - $left -1);
        }

        $data = json_decode($data);
        return $data->openid;
    }

    /**
     * Create the api of openID.
     * 
     * @param  int    $token 
     * @access public
     * @return string
     */
    public function createOpenIDAPI($token = '')
    {
        return $this->openIdAPI . "access_token=$token";
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
        $data = $this->get($this->createUserInfoAPI($token, $openID));
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
        $params['oauth_consumer_key'] = $this->clientID;
        $params['access_token']       = $token;
        $params['openid']             = $openID;
        $params['format']             = 'json';

        return $this->userInfoAPI . http_build_query($params);
    }
}
