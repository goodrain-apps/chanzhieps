<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of score module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     score
 * @version     $Id: model.php 824 2010-05-02 15:32:06Z wwccss $
 * @link        http://www.chanzhi.net
 */
?>
<?php
class scoreModel extends model
{
    /**
     * Get score history of one user.
     * 
     * @param  string $account 
     * @access public
     * @return array
     */
    public function getByUser($account, $pager = null)
    {
        return $this->dao->setAutoLang(false)->select('*')->from(TABLE_SCORE)->where('account')->eq($account)->orderBy('time_desc,id_desc')->page($pager)->fetchAll('id');
    }

    /**
     * Get score history of one object.
     * 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @param  string $method 
     * @access public
     * @return array
     */
    public function getByObject($objectType, $objectID, $method = 'all')
    {
        return $this->dao->setAutoLang(false)->select('*')->from(TABLE_SCORE)
            ->where('objectType')->eq($objectType)
            ->andWhere('objectID')->in($objectID)
            ->beginIF($method != 'all')->andWhere('method')->eq($method)->fi()
            ->orderBy('time_desc')
            ->fetchAll('id');
    }

    /**
     * Get total score of domain. 
     * 
     * @param  string $domain 
     * @access public
     * @return void
     */
    public function getTotalScoreOfDomain($domain)
    {
        $totalScore = $this->dao->setAutoLang(false)->select('SUM(score) as sum')->from(TABLE_REFERER)
            ->where('domain')->eq($domain)
            ->andWhere('status')->eq('verified')
            ->fetch();
        return $totalScore->sum;
    }

    /**
     * Get score of link. 
     * 
     * @param  int    $parsedUrl 
     * @access public
     * @return void
     */
    public function getScoreOfLink($parsedUrl)
    {
        $linkScore = 0;
        if(!isset($parsedUrl['query']) and 1 == preg_match_all('/\//', $parsedUrl['path'], $matches))
        {
            if($parsedUrl['path'] == '/' or 1 == preg_match('/\/index\./i', $parsedUrl['path']) or 1 == preg_match('/\/default\./i', $parsedUrl['path']))
            {
                echo 'is domain';
                $linkScore = $this->config->score->counts->indexPage;
            }
        }
        if($linkScore == 0)
        {
            echo 'is not domain';
            $linkScore = $this->config->score->counts->subPage;
        }
        return $linkScore;
    }

    /**
     * Log the score.
     * 
     * @param  string $account
     * @param  string $method
     * @param  string $type     in|out|punish
     * @param  int    $count 
     * @param  string $note 
     * @access public
     * @return bool
     */
    public function log($account, $method, $type, $count, $note, $objectType = '', $objectID = '', $force = false)
    {
        if(empty($count)) return true;

        /* Get the user info. */
        $account = strip_tags($account);
        $user    = $this->loadModel('user')->getByAccount($account);
        $before  = $method == 'register' ? 0 : $user->score;
        $rank    = $method == 'register' ? 0 : $user->rank;

        /* Compute the score. */
        if($type == 'in') $after = $before + $count;
        if($type == 'out' or $type == 'punish') $after = $before - $count;
        if($after < 0 and $type == 'out' and !$force) return false;

        /* Update score table. */
        $data = new stdclass();
        $data->method     = strtolower($method);
        $data->type       = $type;
        $data->count      = $count;
        $data->note       = $note;
        $data->before     = $before;
        $data->after      = $after;
        $data->account    = $account;
        $data->objectType = $objectType;
        $data->objectID   = $objectID;
        $data->actor      = $this->app->user->account == 'guest' ? $account : $this->app->user->account;
        $data->time       = date('Y-m-d H:i:s');
        $this->dao->insert(TABLE_SCORE)->data($data)->check('count', 'notempty')->exec();

        if(!dao::isError())
        {
            /* Update user table. */
            $data = new stdclass();
            $data->score = $after;
            $data->rank  = $rank;
            if($type == 'in') $data->rank = $rank + $count;
            if($type == 'punish') $data->rank = $rank - $count;
            $this->dao->setAutoLang(false)->update(TABLE_USER)->data($data)->where('account')->eq($account)->exec();

            return !dao::isError();
        }
        return false;
    }

    /**
     * Earn score.
     * 
     * @param  string $account 
     * @param  string $method 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @param  string $note 
     * @access public
     * @return bool
     */
    public function earn($method, $objectType = '', $objectID = '', $note = '', $account = '')
    {
        if($account == '') $account = $this->app->user->account;
        $count   = $this->config->score->counts->$method;
        $type    = 'in';
        if($note == '') $note = strtoupper($objectType) . ":$objectID";
        return $this->log($account, $method, $type, $count, $note, $objectType, $objectID);
    }

    /**
     * Cost some score for some reason.
     * 
     * @param  string $method 
     * @param  int    $count 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @param  string $note 
     * @access public
     * @return bool
     */
    public function cost($method, $count, $objectType, $objectID = 0, $note = '', $account = '', $force = false)
    {
        if(!$count) return true;
        $account = empty($account) ? $this->app->user->account : $account;
        $type    = 'out';
        if($note == '') $note = strtoupper($objectType) . ":$objectID";
        return $this->log($account, $method, $type, $count, $note, $objectType, $objectID, $force);
    }

    /**
     * Award a user some scores for some reason.
     * 
     * @param  string    $account 
     * @param  string    $method 
     * @param  int       $count 
     * @param  string    $objectType 
     * @param  int       $objectID 
     * @param  string    $note 
     * @access public
     * @return bool
     */
    public function award($account, $method, $count, $objectType = '', $objectID = 0, $note = '' )
    {
        $type = 'in';
        if($note == '') $note = strtoupper($objectType) . ":$objectID";
        return $this->log($account, $method, $type, $count, $note, $objectType, $objectID);
    }

    /**
     * Punish a user for some reason.
     * 
     * @param  string $account 
     * @param  string $method 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @param  string $note 
     * @access public
     * @return bool
     */
    public function punish($account, $method, $count, $objectType = '', $objectID = 0, $note = '')
    {
        $type = 'punish';
        if($note == '') $note = strtoupper($objectType) . ":$objectID";
        return $this->log($account, $method, $type, $count, $note, $objectType, $objectID);
    }

    /**
     * Judge the user has download a file or not.
     * 
     * @param  string $account 
     * @param  int    $fileID 
     * @access public
     * @return bool
     */
    public function hasFileDowned($account, $fileID)
    {
        return $this->dao->setAutoLang(false)->select('id')->from(TABLE_SCORE)
            ->where('account')->eq($account)
            ->andWhere('objectType')->eq('file')
            ->andWhere('objectID')->eq($fileID)
            ->fetch();
    }

    /**
     * Judge an ip has been scored or not.
     *
     * @param string $account
     * @param string $ip
     * @param string $objectType
     * @param int    $objectID
     * @access public
     * @return bool
     */
    public function hasIpScored($account, $ip, $objectType, $objectID = 0)
    {
        return $this->dao->setAutoLang(false)->select('count(*) AS count')->from(TABLE_IP)
            ->where('account')->eq($account)
            ->andWhere('objectType')->eq($objectType)
            ->andWhere('ip')->eq($ip)
            ->andWhere('`date`')->eq(date('Y-m-d'))
            ->beginIF($objectID)->andWhere('objectID')->eq($objectID)->fi()
            ->fetch('count'); 
    }

    /**
     * Save the ip.
     *
     * @param string $account
     * @param string $objectType
     * @param int    $objectID
     * @access public
     * @return void 
     */
    public function saveIp($account, $objectType, $objectID = 0)
    {
        $data = new stdclass();
        $data->account    = strip_tags($account);
        $data->objectType = $objectType;
        $data->objectID   = (int)$objectID;
        $data->ip         = $this->server->remote_addr;
        $data->date       = date('Y-m-d');

        $this->dao->insert(TABLE_IP)->data($data)->exec(); 
    }

    /**
     * Save order.
     * 
     * @access public
     * @return void
     */
    public function saveOrder()
    {
        $data = fixer::input('post')
            ->add('account', $this->app->user->account)
            ->add('createdDate', helper::now())
            ->add('payment', 'alipay')
            ->add('status', 'normal')
            ->add('payStatus', 'not_paid')
            ->add('type', 'score')
            ->get();
        $this->dao->insert(TABLE_ORDER)->data($data)->check('amount', 'notempty')->exec();
        if(!dao::isError()) return $this->dao->lastInsertID();
        return false;
    }

    /**
     * Get order by id 
     * 
     * @param  int    $rawOrder 
     * @access public
     * @return object
     */
    public function getOrderByRawID($rawOrder)
    {
        $order = $this->dao->setAutoLang(false)->select('*')->from(TABLE_ORDER)->where('id')->eq((int)$rawOrder)->fetch();
        $order->subject = $this->lang->user->buyScore;
        if(!$order) return false;
        $order->humanOrder = $this->loadModel('order')->getHumanOrder($order->id);
        return $order;
    }

    /**
     * Process an order.
     * 
     * @param  object $order
     * @access public
     * @return string | bool
     */
    public function processOrder($order)
    {
        if($order->payStatus == 'paid') return true;
        $result = $this->loadModel('order')->processOrder($order);
        if($result)
        {
            $account = $order->account;
            $count   = round($order->amount * $this->config->score->buyScore->perYuan);
            $type    = 'in';
            $note = strtoupper('buyScore') . ":" . $order->id;
            return $this->log($account, 'buyScore', $type, $count, $note, 'buyScore', $order->id);
        }
        else
        {
            return $result;
        }
    }

    /**
     * Get ranking list 
     * 
     * @param  string    $type 
     * @access public
     * @return void
     */
    public function getRankingList($type)
    {
        return $this->dao->setAutoLang(false)->select('t1.account, SUM(t1.count) as sumScore, t2.score')->from(TABLE_SCORE)->alias('t1')
            ->leftJoin(TABLE_USER)->alias('t2')->on('t1.account=t2.account')
            ->where('t1.type')->eq('in')
            ->andWhere('t1.account')->ne('')
            ->beginIF($type == 'month')->andWhere('DATE_SUB(CURDATE(), INTERVAL 1 MONTH) <= date(t1.time)')->fi()
            ->beginIF($type == 'week')->andWhere('DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(t1.time)')->fi()
            ->beginIF($type == 'today')->andWhere('t1.time')->like('%' . date('Y-m-d') . '%')->fi()
            ->beginIF($type == 'yesteday')->andWhere('t1.time')->like('%' . date('Y-m-d', strtotime('-1 day')) . '%')->fi()
            ->groupBy('t1.account')->orderBy('sumScore desc')->limit($this->config->score->ranking->limit)->fetchAll('account');
    }
}
