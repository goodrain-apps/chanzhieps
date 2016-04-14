<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of wechat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     index
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class wechat extends control
{
    /**
     * The public account.
     * 
     * @var object   
     * @access public
     */
    public $public;

    /**
     * The wechat api object.
     * 
     * @var object   
     * @access public
     */
    public $api;

    /**
     * Set the wechat api.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function setAPI($public)
    {
        $this->api = $this->wechat->loadApi($public);
    }

    /**
     * The wechat auto response api.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function response($public)
    {
        $this->setAPI($public);
        $this->api->checkSign();

        $message  = $this->api->getMessage();
        $response = $this->wechat->getResponseForMessage($public, $message);
        if($response) $this->api->response($response);
        if(isset($message->event) and $message->event == 'subscribe') $this->wechat->createUser($public, $message);
        exit;
    }

    /**
     * Reply a message.
     * 
     * @param  int    $message 
     * @access public
     * @return void
     */
    public function reply($message)
    {
        $message = $this->dao->select('*')->from(TABLE_WX_MESSAGE)->where('id')->eq($message)->fetch();
        if(empty($message)) die();
        $this->setAPI($message->public);

        $user = $this->wechat->getFanInfoByOpenID($message->public, $message->from);
        $this->view->user = $user;

        if($_POST) $this->send($this->wechat->reply($this->api, $message));

        $this->view->title      = "<i class='icon-mail-reply'></i> " . $lang->wechat->message->reply;
        $this->view->modalWidth = 700;
        $this->view->public     = $this->wechat->getByID($message->public);
        $this->view->records    = $this->wechat->getRecords($message);
        $this->view->message    = $message;
        $this->display();
    }

    /**
     * Browse public in admin.
     * 
     * @access public
     * @return void
     */
    public function admin()
    {
        $publics = $this->wechat->getList();
        if(empty($publics)) $this->locate(inlink('create'));

        $this->view->title     = $this->lang->wechat->common;
        $this->view->publics   = $publics;
        $this->view->sslLoaded = extension_loaded('openssl');
        $this->display();
    }

    /**
     * Create a public.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        if($_POST) 
        {
            $publicID = $this->wechat->create();
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('integrate', "public={$publicID}")));
        }

        $this->view->title = $this->lang->wechat->create;
        $this->display();
    }

    /**
     * Display interface configuration information.
     * 
     * @param  int    $publicID 
     * @access public
     * @return void
     */
    public function integrate($publicID)
    {
        $this->view->title  = $this->lang->wechat->integrate;
        $this->view->public = $this->wechat->getByID($publicID);
        $this->display();
    } 

    /**
     * Edit a public.
     * 
     * @param  int    $publicID
     * @access public
     * @return void
     */
    public function edit($publicID)
    {
        if($_POST) 
        {
            $this->wechat->update($publicID);       
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin')));
        }

        $this->view->title  = $this->lang->wechat->edit;
        $this->view->public = $this->wechat->getByID($publicID);
        $this->display();
    }

    /**
     * Delete a public.
     * 
     * @param  int      $publicID 
     * @access public
     * @return void
     */
    public function delete($publicID)
    {
        if($this->wechat->delete($publicID)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }
    
    /**
     * Admin response for a public.
     * 
     * @param  int    $publicID 
     * @access public
     * @return void
     */
    public function adminResponse($publicID)
    {
        $this->view->title           = $this->lang->wechat->response->keywords;
        $this->view->publicID        = $publicID;
        $this->view->responseList    = $this->wechat->getResponseList($publicID);
        $this->view->articleCategory = $this->loadModel('tree')->getPairs(0, 'article');
        $this->view->productCategory = $this->tree->getPairs(0, 'product');
        $this->view->moduleList      = $this->wechat->getModuleList();
        $this->display();
    }

    /**
     * Set response for a public.
     * 
     * @param  int     $public 
     * @param  string  $group 
     * @param  string  $key
     * @access public
     * @return void
     */
    public function setResponse($public, $group = '', $key = '')
    {
        if($_POST) 
        {
            $this->wechat->setResponse($public);
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));

            $response['result']  = 'success';
            $response['message'] = $this->lang->saveSuccess;
            if($group == '') $response['locate'] = inlink('adminresponse', "publicID={$public}");
            if($group == 'default' or $group == 'subscribe') $response['locate'] = inlink('admin');
            $this->send($response);
        }

        if($key)
        {
            $response = $this->wechat->getResponseByKey($public, $key);
            if(!empty($response) and $response->source == 'system' and $response->type != 'news')
            {
                $response->source = $response->content;
            }
            $this->view->response = $response;
        }

        if($group == 'menu') unset($this->lang->wechat->menu);

        $this->view->articleTree = $this->loadModel('tree')->getOptionMenu('article', 0, $removeRoot = true);
        $this->view->productTree = $this->tree->getOptionMenu('product', 0, $removeRoot = true);
        $this->view->title       = $this->lang->wechat->response->set;
        $this->view->moduleList  = $this->wechat->getModuleList();
        $this->view->public      = $public;
        $this->view->group       = $group;
        $this->view->key         = $key;
        $this->display();
    }

    /**
     * Delete a response.
     * 
     * @param  int    $response 
     * @access public
     * @return void
     */
    public function deleteResponse($response)
    {
        if($this->wechat->deleteResponse($response)) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Commit menu. 
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function commitMenu($public)
    {
        $this->setApi($public);
        $menu   = $this->wechat->getMenu($public);
        $result = $this->api->commitMenu($menu);
        if($result['result'] == 'success') $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        $this->send($result);
    }

    /**
     * Delete menu of a public.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function deleteMenu($public)
    {
        $this->setAPI($public);
        if($this->api->deleteMenu()) $this->send(array('result' => 'success', 'message' => $this->lang->deleteSuccess));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
    }

    /**
     * Browse messages. 
     * 
     * @param  string    $mode   type|from|replied
     * @param  string    $query 
     * @param  string    $orderBy 
     * @param  int       $pageID 
     * @access public
     * @return void
     */
    public function message($mode = '', $query = '', $orderBy = 'id_desc', $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->lang->menuGroups->wechat = 'wechat';
        unset($this->lang->wechat->menu);

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $messageList = $this->wechat->getMessage($mode, $query, $orderBy, $pager);

        $users = $this->loadModel('user')->getList();

        $wechatUsers = array();
        foreach($users as $user)
        {
            if(!$user->openID) continue;
            $wechatUsers[$user->openID] = $user->realname;
        }

        foreach($messageList as $message)
        {
            if(isset($wechatUsers[$message->from])) $message->fromUserName = $wechatUsers[$message->from];
        }

        $this->view->title       = $this->lang->wechat->common;
        $this->view->publicList  = $this->wechat->getList(); 
        $this->view->messageList = $messageList;
        $this->view->pager       = $pager;
        $this->display();
    }

    /**
     * Upload the qrcode for a public.
     * 
     * @param  int    $publicID 
     * @access public
     * @return void
     */
    public function qrcode($publicID)
    {
        $public = $this->wechat->getByID($publicID);
        $qrcodeURL = $this->wechat->computeQRCodeURL($public);
        if(!$qrcodeURL and $public->certified and $public->type != 'subscribe')
        {
            $this->wechat->downloadQRCode($public);
            $qrcodeURL = $this->wechat->computeQRCodeURL($public);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $return = $this->wechat->uploadQRCode($public);
            if($return['result']) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => $return['message']));
        }

        $this->view->title      = "<i class='icon-paper-clip'></i> " . $this->lang->wechat->qrcode;
        $this->view->modalWidth = 1000;
        $this->view->qrcodeURL  = $qrcodeURL;
        $this->view->public     = $public;
        $this->display();
    }
}
