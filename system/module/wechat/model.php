<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of wechat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@cxirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class wechatModel extends model
{
    /**
     * Load api.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function loadApi($public)
    {
        $public = $this->getByID($public);
        if(empty($public)) return false;
        $this->app->loadClass('wechatapi', true);
        return new wechatapi($public->token, $public->appID, $public->appSecret, $this->config->debug);
    }

    /**
     * Get a public account by id.
     * 
     * @param  string    $account 
     * @access public
     * @return object
     */
    public function getByAccount($account)
    {
        return $this->dao->select('*')->from(TABLE_WX_PUBLIC)->where('account')->eq($account)->fetch();
    }

    /**
     * Get a public account by id.
     * 
     * @param  int    $id 
     * @access public
     * @return object
     */
    public function getByID($id)
    {
        $public = $this->dao->findByID($id)->from(TABLE_WX_PUBLIC)->fetch();
        if(empty($public)) return false;
        $public->url = 'http://' . $this->server->http_host . commonModel::createFrontLink('wechat', 'response', "id=$public->id");
        return $public;
    }

    /** 
     * Get public list.
     * 
     * @access public
     * @return array
     */
    public function getList()
    {
        $publics = $this->dao->select('*')->from(TABLE_WX_PUBLIC)->orderBy('addedDate')->fetchAll('id');
        if(!$publics) return array();

        foreach($publics as $public)
        {
            $public->url    = rtrim(getWebRoot(true), '/') . commonModel::createFrontLink('wechat', 'response', "id=$public->id");
            $public->qrcode = $this->computeQRCodeURL($public);
        }

        return $publics;
    }

    /**
     * Download the qrcode file for a public account.
     * 
     * @param  object    $public 
     * @access public
     * @return bool
     */
    public function downloadQRCode($public)
    {
        $api = $this->loadApi($public->id);
        $qrcodeFile = $this->computeQRCodeFile($public);
        return $api->getQRCode($qrcodeFile); 
    }

    /**
     * Upload the qrcode file for a public.
     * 
     * @param  object  $public 
     * @access public
     * @return array
     */
    public function uploadQRCode($public)
    {
        if(empty($_FILES)) return array('result' => false, 'message' => $this->lang->wechat->noSelectedFile);

        $qrcodeFile = $this->computeQRCodeFile($public);
        $result = move_uploaded_file($_FILES['file']['tmp_name'], $qrcodeFile);

        if($result) return array('result' => true);
        if(!$result) return array('result' => false, 'message' => $this->lang->fail);
    }

    /**
     * Compute the qrcode file.
     * 
     * @param  object    $public 
     * @access public
     * @return string
     */
    public function computeQRCodeFile($public)
    {
        $qrcodeFile = $this->app->getDataRoot() . 'wechat' . DS . $public->account . '.jpg';
        if(!is_dir(dirname($qrcodeFile))) @mkdir(dirname($qrcodeFile));
        return $qrcodeFile;
    }

    /**
     * Compute the qrcode url.
     * 
     * @param  object    $public 
     * @access public
     * @return string|bool
     */
    public function computeQRCodeURL($public)
    {
        $qrcodeFile = $this->computeQRCodeFile($public);
        if(!is_file($qrcodeFile)) return false;
        return $this->app->getWebRoot() . 'data/wechat/' . $public->account . '.jpg';
    }

    /**
     * Create a public.
     * 
     * @access public
     * @return int|bool
     */
    public function create()
    {
        if(!validater::checkReg($this->post->token, '|^[a-zA-Z0-9]{1}[a-zA-Z0-9]{1,30}[a-zA-Z0-9]{1}$|')) dao::$errors['token'][] = $this->lang->error->token;

        $public = fixer::input('post')->add('addedDate', helper::now())->get();
        $this->dao->insert(TABLE_WX_PUBLIC)
            ->data($public)
            ->autoCheck()
            ->batchCheck($this->config->wechat->require->create, 'notempty')
            ->exec();

        $publicID = $this->dao->lastInsertID();
        return $publicID;
    }

    /**
     * Update a public.
     * 
     * @param  int $publicID 
     * @access public
     * @return void
     */
    public function update($publicID)
    {
        if(!validater::checkReg($this->post->token, '|^[a-zA-Z0-9]{1}[a-zA-Z0-9]{1,30}[a-zA-Z0-9]{1}$|')) dao::$errors['token'][] = $this->lang->error->token;

        $public = fixer::input('post')->get();
        $this->dao->update(TABLE_WX_PUBLIC)
            ->data($public)
            ->autoCheck()
            ->batchCheck($this->config->wechat->require->edit, 'notempty')
            ->where('id')->eq($publicID)
            ->exec();
        return !dao::isError();
    }

    /**
     * Delete a public.
     * 
     * @param  int      $publicID 
     * @access public
     * @return void
     */
    public function delete($publicID, $null = null)
    {
        $this->dao->delete()->from(TABLE_WX_PUBLIC)->where('id')->eq($publicID)->exec();
        return !dao::isError();
    }

    /** 
     * Get response list.
     * 
     * @param  int    $publicID 
     * @access public
     * @return array
     */
    public function getResponseList($publicID)
    {
        $responses = $this->dao->select('*')->from(TABLE_WX_RESPONSE)->where('public')->eq($publicID)->andWhere('`group`')->eq('')->fetchAll('id');

        foreach($responses as $response) $this->processResponse($response);

        return $responses;
    }

    /**
     * Get response for a message.
     * 
     * @param  int       $public 
     * @param  object    $message 
     * @access public
     * @return object
     */
    public function getResponseForMessage($public, $message)
    {
        if(isset($message->event) && in_array($message->event, array('unsubscribe', 'location')))
        {
            $this->saveMessage($public, $message);
            return false;
        }

        if($message->msgType == 'text')  $response = $this->getResponseByKey($public, $message->content);
        if($message->msgType == 'event') $response = $this->getResponseByKey($public, isset($message->eventKey) ? $message->eventKey : '');
        if(isset($message->event) && $message->event == 'subscribe') $response = $this->getResponseByKey($public, 'subscribe');

        if(empty($response)) $response = $this->getResponseByKey($public, 'default');    

        if(!empty($response))
        {
            $message->response = $response->id;
            if(isset($message->event) && $message->event == 'VIEW') 
            {
                 $message->response = $this->dao->select('id')->from(TABLE_WX_RESPONSE)->where('`key`')->like('m_%')->andWhere('concat(content, source)')->eq($message->eventKey)->fetch('id');
            }

            if($response->type == 'text' or $response->type == 'link')
            {
                $reply = new stdclass();
                $reply->msgType = 'text';
                $reply->content = $response->content;
            } 
            elseif($response->type == 'news')
            {
                $reply = $response->content;
            }
        }
        $this->saveMessage($public, $message);
        if(!isset($reply)) $reply = false;
        return $reply;
    }

    /**
     * Create user from a message.
     * 
     * @param  int       $pulicID
     * @param  object    $message 
     * @access public
     * @return void
     */
    public function createUser($publicID, $message)
    {
        $public = $this->getByID($publicID);
        $openID = $message->fromUserName;
        $users  = $this->loadModel('user')->getByOpenID($openID, 'wechat');
        if($users) return true;

        $api  = $this->loadApi($publicID);
        $fan  = $api->getUserInfo($openID);

        if(empty($fan) or !isset($fan->openid)) return false;

        return $this->loadModel('user')->createWechatUser($fan, $public->account);
    }

    /**
     * Get response by key.
     * 
     * @param  int    $public 
     * @param  int    $key 
     * @access public
     * @return object
     */
    public function getResponseByKey($public, $key)
    {
        if($key == 'SCAN') $key = 'subscribe';
        $response = $this->dao->select('*')->from(TABLE_WX_RESPONSE)
            ->where('public')->eq($public)
            ->andWhere('`key`')->eq($key)
            ->fetch();
        return $this->processResponse($response);
    }

    /**
     * Process a response. 
     * 
     * @param  object    $response 
     * @access public
     * @return void
     */
    public function processResponse($response)
    {
        if(empty($response)) return $response;
        
        if($response->type == 'text')
        {
            if($response->source != 'manual')
            {
                $response->content = $this->parseResponseContent($response->source);
            }
        }

        if($response->type == 'news')
        {
            $response->params  = json_decode($response->content);
            $response->content = $this->parseResponseContent($response->params);
        }

        if($response->type == 'link')
        {
            if($response->source != 'manual')
            {
               $response->content = $response->source;
            }
        }

        return $response;
    }

    /**
     * Create response for a public.
     * 
     * @param  int     $publicID
     * @access public
     * @return void
     */
    public function setResponse($publicID)
    {
        $response = fixer::input('post')->add('public', $publicID)->get();

        if($response->type == 'news')
        { 
            $response->source = 'system';
            $content = array();
            $content['block']    = $response->block;
            $content['category'] = $response->category;
            if(isset($response->limit)) $content['limit'] = $response->limit;
            $response->content = helper::jsonEncode($content);
        }

        $this->dao->replace(TABLE_WX_RESPONSE)
            ->data($response, $skip = 'linkModule, textBlock, block, category, limit')
            ->autoCheck()
            ->exec();

        return !dao::isError();
    }

    /**
     * Get menu to commit.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function getMenu($public)
    {
        $menus = $this->dao->select('*')->from(TABLE_CATEGORY)->where('type')->like("wechat_{$public}%")->orderBy('`order`')->fetchGroup('parent');
        $responseList = $this->dao->select('*')->from(TABLE_WX_RESPONSE)->where('public')->eq($public)->andWhere('`group`')->eq('menu')->fetchAll('key');
        foreach($responseList as $response) $response = $this->processResponse($response);

        $buttons = array();
        foreach($menus[0] as $menu)
        {
            if(!empty($menus[$menu->id]))
            {
                $submenus = new stdclass();
                $submenus->name = $menu->name;
                foreach($menus[$menu->id] as $submenu)
                {
                    if(!isset($responseList['m_' . $submenu->id])) continue;
                    $response = $this->convertResponse2Menu($responseList['m_' . $submenu->id]);
                    $response->name = $submenu->name;
                    $submenus->sub_button[] = $response;
                }
                $buttons[] = $submenus;
            }
            else
            {
                if(!isset($responseList['m_' . $menu->id])) continue;
                $response = $this->convertResponse2Menu($responseList['m_' . $menu->id]);
                $response->name = $menu->name;
                $buttons[] = $response;
            }
        }
        return array('button' => $buttons);
    }

    /**
     * Convert response.
     * 
     * @param  int    $response 
     * @access public
     * @return void
     */
    public function convertResponse2Menu($response)
    {
        $result = new stdclass();
        if($response->type == 'link')
        {
            $result->type = 'view';
            $result->url  = $response->source == 'manual' ? $response->content : $response->source;
        }
        else
        {
            $result->type = 'click';
            $result->key  = $response->key;
        }
        return $result;
    }

    /**
     * Delete a response.
     * 
     * @param  int     $response 
     * @access public
     * @return void
     */
    public function deleteResponse($response, $null = null)
    {
        $this->dao->delete()->from(TABLE_WX_RESPONSE)->where('id')->eq($response)->exec();
        return !dao::isError();
    }

    /**
     * Parse response content. 
     * 
     * @param  string|object    $content 
     * @access public
     * @return void
     */
    public function parseResponseContent($content)
    {
        if(!is_object($content))
        {
            if($content == 'company') return strip_tags($this->config->company->desc);
            if($content == 'contact')
            {
                $contact = json_decode($this->config->company->contact);
                $text = '';
                foreach($contact as $item => $value)
                {
                    if(empty($value)) continue;
                    $text .= $this->lang->company->{$item} . $this->lang->colon . $value . "\n";
                }
                return $text;
            }
            return $content;
        } 
        else
        {
            $userFunc = array('wechatModel', 'parse' . ucfirst($content->block));
            return call_user_func($userFunc, $content);
        }
    }

    /**
     * Parse article tree. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseArticleTree($content)
    {
        return $this->parseTree($content, 'article');
    }

    /**
     * Parse product tree. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseProductTree($content)
    {
        return $this->parseTree($content, 'product');
    }

    /**
     * Parse tree. 
     * 
     * @param  object    $content 
     * @param  string    $type 
     * @access public
     * @return object
     */
    public function parseTree($content, $type)
    {
        $categories = $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->in($content->category)->fetchAll('id');

        $response = new stdclass();
        $response->msgType = 'news';

        $isFirst = true;
        $viewType = isset($this->config->site->mobileTemplate) && $this->config->site->mobileTemplate == 'open' ? 'mhtml' : '';
        foreach($content->category as $categoryID)
        {
            if(empty($categories[$categoryID])) continue;
            $category = $categories[$categoryID];

            $article = new stdclass();
            $article->title       = $category->name;
            $article->url         = getHostURL() . commonModel::createFrontLink($type, 'browse', "categoryID={$category->id}", "category={$category->alias}", $viewType);
            $article->description =  $category->desc;

            if($isFirst) $article->picUrl = getWebRoot(true) . "theme/default/images/main/wechat{$type}.png";

            $isFirst = false;
            $response->articles[] = $article;
        }
        return $response;
    }

    /**
     * Parse latest article. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseLatestArticle($content)
    {
        return $this->parseArticles($content);
    }

    /**
     * Parse hot article. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseHotArticle($content)
    {
        return $this->parseArticles($content);
    }

    /**
     * Parse articles. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseArticles($content)
    {
        $orderByList = array('latestArticle' => 'id_desc', 'hotArticle' => 'views_desc');

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $content->limit, 1);

        $articles = $this->loadModel('article')->getList('article', $content->category, $orderByList[$content->block], $pager);

        $response = new stdclass();
        $response->msgType = 'news';

        $isFirst = true;
        $viewType = isset($this->config->site->mobileTemplate) && $this->config->site->mobileTemplate == 'open' ? 'mhtml' : '';
        foreach($articles as $article)
        {
            $item = new stdclass();
            $item->title       = $article->title;
            $item->url         = getHostURL() . $this->article->createPreviewLink($article->id, $viewType);
            $item->description = $article->summary;
            if(!empty($article->image))
            {
                $image = $isFirst ?  $article->image->primary->middleURL : $article->image->primary->smallURL;
                $item->picUrl = rtrim(getWebRoot(true), '/') . $image;
            }
            $response->articles[] = $item;
            $isFirst = false;
        }
        return $response;
    }

    /**
     * Parse latest product. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseLatestProduct($content)
    {
        return $this->parseProducts($content);
    }

    /**
     * Parse hot product. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseHotProduct($content)
    {
        return $this->parseProducts($content);
    }

    /**
     * Parse products. 
     * 
     * @param  object    $content 
     * @access public
     * @return object
     */
    public function parseProducts($content)
    {
        $orderByList = array('latestProduct' => 'id_desc', 'hotProduct' => 'views_desc');

        $this->app->loadClass('pager', true);
        $pager = new pager($recTotal = 0, $recPerPage = $content->limit, 1);

        $products = $this->loadModel('product')->getList($content->category, $orderByList[$content->block], $pager);

        $response = new stdclass();
        $response->msgType = 'news';

        $viewType = isset($this->config->site->mobileTemplate) && $this->config->site->mobileTemplate == 'open' ? 'mhtml' : '';
        foreach($products as $product)
        {
            $categories    = $product->categories;
            $categoryAlias = current($categories)->alias;

            $article = new stdclass();
            $article->title       = $product->name;
            $article->url         = getHostURL() . commonModel::createFrontLink('product', 'view',  "productID=$product->id", "name=$product->alias&category=$categoryAlias", $viewType);
            $article->description = isset($product->summary) ? $product->summary : '';
            if(!empty($product->image)) $article->picUrl = rtrim(getWebRoot(true), '/') . $product->image->primary->smallURL;
            $response->articles[] = $article;
        }
        return $response;
    }

    /**
     * Save message. 
     * 
     * @param  int      $public 
     * @param  object   $data 
     * @access public
     * @return void
     */
    public function saveMessage($public, $data)
    {
        $message = new stdclass();
        $message->public   = $public;
        $message->wid      = isset($data->msgId) ? $data->msgId : '';
        $message->from     = $data->fromUserName;
        $message->to       = $data->toUserName;

        if(isset($data->response)) $message->response = $data->response;

        $message->type     = $data->msgType;
        $message->content  = isset($data->content) ? $data->content : helper::jsonEncode($data);

        if($data->msgType == 'event')
        {
            $message->type    = $data->event;
            $message->content = isset($data->eventKey) ? $data->eventKey : '';
        }

        if(isset($data->event) && in_array($data->event, array('subscribe', 'unsubscribe', 'SCAN')))
        {
            $message->content = isset($data->eventKey) ? $data->eventKey : $data->event;
        }

        $message->replied = isset($data->replied) ? $data->replied : 0;
        $message->time    = helper::now();

        $this->dao->insert(TABLE_WX_MESSAGE)->data($message)->autoCheck()->exec();
        return !dao::isError();
    }

    /**
     * Get message. 
     * 
     * @param  object   $query 
     * @param  string   $orderBy 
     * @param  object   $pager 
     * @access public
     * @return array 
     */
    public function getMessage($mode, $query, $orderBy, $pager = null)
    {
        $messages = $this->dao->select('*')->from(TABLE_WX_MESSAGE)
            ->where('type')->ne('reply')
            ->beginIf($mode == 'type')->andWhere('type')->eq($query)->fi()
            ->beginIf($mode == 'replied')->andWhere('replied')->eq($query)->fi()
            ->beginIf($mode == 'from')->andWhere('`from`')->eq($query)->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');

        $menus = $this->dao->select('r.id as rid, c.*')->from(TABLE_CATEGORY)->alias('c')
            ->leftJoin(TABLE_WX_RESPONSE)->alias('r')->on("concat('m_', c.id) = r.key")
            ->where('c.type')->like('wechat%')->fetchAll('rid');

        foreach($messages as $message)
        {
            $content = json_decode($message->content);
            if(is_object($content)) $message->content = $content;

            /* Deal with event message. */
            if(isset($this->lang->wechat->message->eventList[$message->type]))
            {
                if(in_array($message->type, array('VIEW', 'CLICK'))) $menu = $menus[$message->response];
                $message->content = $this->lang->wechat->message->eventList[$message->type];
                if(!empty($menu)) $message->content .= $this->lang->colon . $menu->name;
                continue;
            }
        }
        return $messages;
    }

    /**
     * Get fan info By OpenID. 
     * 
     * @param  int    $public 
     * @param  int    $openID 
     * @access public
     * @return void
     */
    public function getFanInfoByOpenID($public, $openID)
    {
        $user = $this->dao->select('*')->from(TABLE_OAUTH)->where('provider')->eq('wechat')->andWhere('openID')->eq($openID)->fetch();
        if($user)
        {
            $user = $this->dao->select('*')
                ->from(TABLE_OAUTH)->alias('o')
                ->leftJoin(TABLE_USER)->alias('u')
                ->on('o.account=u.account')
                ->where('o.account')->eq($user->account)
                ->fetch();
            if($user->nickname) return $user;
        }

        $fan = $this->pullFanInfo($user);
        if(empty($fan)) return false;
        $fan->openID = $openID;
        $public = $this->getByID($public);

        $this->loadModel('user')->createWechatUser($fan, $public->account);

        return $fan;
    }

    /**
     * Pull fans.
     * 
     * @access public
     * @return void
     */
    public function pullFans()
    {
        $publicList = $this->dao->select('*')->from(TABLE_WX_PUBLIC)->fetchAll();
        $pulledFans = $this->dao->select('*')->from(TABLE_OAUTH)->where('provider')->eq('wechat')->fetchAll('openID');
        foreach($publicList as $public)
        {
            if(!$public->certified) continue;
            $this->app->loadClass('wechatapi', true);
            $api  = new wechatapi($public->token, $public->appID, $public->appSecret, $this->config->debug);
            $fans = $api->getFans();

            if(empty($fans->data))continue;

            foreach($fans->data->openid as $openID)
            {
                if(isset($pulledFans[$openID])) continue;

                $user = array();
                $user['openID']   = $openID;
                $user['provider'] = 'wechat';
                $user['public']   = $public->account;
                $user['account']  = uniqid('wx_');
                $user['join']     = helper::now();

                $this->dao->insert(TABLE_OAUTH)->data($user, $skip = 'public,join')->exec();
                $this->dao->insert(TABLE_USER)->data($user, $skip = 'openID,provider')->exec();
            }
        }
        return true;
    }

    /**
     * Pull fan info.
     * 
     * @param  object    $user 
     * @access public
     * @return void
     */
    public function pullFanInfo($user)
    {
        if(!$user->public) return false;
        $public = $this->getByAccount($user->public);
        if(empty($public) or !$public->certified) return false;

        $api  = $this->loadApi($public->id);
        $fan  = $api->getUserInfo($user->openID);
        $user = $this->loadModel('user')->createWechatUser($fan, $public->account);
    }

    /**
     * Get fans info. 
     * 
     * @param  array    $users 
     * @access public
     * @return void
     */
    public function batchPullFanInfo($users)
    {
        foreach($users as $user)
        {
            if(!$user->nickname and $user->public) $user = $this->pullFanInfo($user);
        }
        return $users;
    }

    /**
     * reply 
     * 
     * @param  object    $api 
     * @param  object    $message 
     * @access public
     * @return void
     */
    public function reply($api, $message)
    {
        $reply = new stdclass();
        $reply->content = $this->post->content;
        $result = $api->reply($message->from, 'text', $reply);

        if($result['result'] != 'success') return $result;

        $this->dao->update(TABLE_WX_MESSAGE)->set('replied')->eq('1')->where('id')->eq($message->id)->exec();

        $this->dao->insert(TABLE_WX_MESSAGE)
            ->set('public')->eq($message->public)
            ->set('wid')->eq($message->wid)
            ->set('`from`')->eq($this->app->user->account)
            ->set('to')->eq($message->from)
            ->set('content')->eq($this->post->content)
            ->set('type')->eq('reply')
            ->set('time')->eq(helper::now())
            ->autoCheck()
            ->exec();

        if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());
        return array('result' => 'success', 'message' => $this->lang->sendSuccess, 'locate' => $this->post->referer);
    }

    /**
     * getRecords 
     * 
     * @param  object    $message 
     * @access public
     * @return void
     */
    public function getRecords($message)
    {
        $records = $this->dao->select('*')->from(TABLE_WX_MESSAGE)->where('public')->eq($message->public)->andWhere('`from`')->eq($message->from)->fetchAll();
        $replies = $this->dao->select('*')->from(TABLE_WX_MESSAGE)->where('public')->eq($message->public)->andWhere('`to`')->eq($message->from)->andWhere('type')->eq('reply')->fetchGroup('wid');

        foreach($records as $record)
        {
             if(isset($replies[$record->wid])) $record->replies = $replies[$record->wid];
        }
        return $records;
    }

    /**
     * Get modeulList.
     * 
     * @access public
     * @return void
     */
    public function getModuleList()
    {
        $hostURL = getHostURL();
        $viewType = isset($this->config->site->mobileTemplate) && $this->config->site->mobileTemplate == 'open' ? 'mhtml' : '';
        foreach($this->lang->wechat->response->moduleList as $module => $title)
        {
            if($module != 'manual') $moduleList[$hostURL . commonModel::createFrontLink($module, 'index', '', '', $viewType)] = $title;
            if($module == 'manual') $moduleList[$module] = $title;
        }
        return $moduleList;
    }
}
