<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of yangcong of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     yangcong
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class yangcong extends control
{
    public function __construct()
    {
        parent::__construct();
        if(empty($this->config->site->yangcong))
        {
            $this->send(array('result' => 'fail', 'message' => $this->lang->yangcong->getQrcodeFaild)); 
        }

        $config = json_decode($this->config->site->yangcong);

        $this->app->loadClass('yangcongapi', true);
        $this->api = new yangcongapi($config);
    }

    public function qrcode($referer = '')
    {
        $result  = $this->api->getQrcode();
        $result->event_id = helper::safe64Encode($result->event_id);
        $this->view->result  = $result;
        $this->view->referer = $referer;
        $this->view->title   = $this->lang->yangcong->qrcodeInfo;
        $this->view->modalWidth = '300';
        $this->display();
    }

    public function getResult($eventID)
    {
        $eventID = helper::safe64Decode($eventID);
        $result = $this->api->getResultByEvent($eventID);
        if($result->status != 200) $this->send(array('result' => 'fail',  'message' => $result->description));
        $this->session->set('openID', $result->uid);
        $this->session->set('oauthProvider', 'yangcong');
        $this->send(array('result' => 'success'));
    }
}

