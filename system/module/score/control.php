<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of score module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     score
 * @version     $Id$
 * @link        http://www.chanzhi.net
 */
class score extends control
{
    /**
     * Construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct($moduleName = '', $methodName = '')
    {
        parent::__construct($moduleName, $methodName);
        $this->loadModel('user');
    }

    /**
     * No score page.
     * 
     * @param  string $method 
     * @param  int    $score 
     * @access public
     * @return void
     */
    public function noscore($method, $score)
    {
        $this->view->method = $method;
        $this->view->score  = $score;
        $this->display();
    }

    /**
     * Buy score use money.
     * 
     * @access public
     * @return void
     */
    public function buyScore()
    {
        if($this->app->user->account == 'guest') $this->locate($this->createLink('user', 'login'));
        if($_POST)
        {
            if($this->post->amount < $this->config->score->buyScore->minAmount) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->score->errorAmount, $this->config->score->buyScore->minAmount)));

            $orderID = $this->score->saveOrder();
            if(!$orderID) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('payOrder', "orderID=$orderID")));
        }
        $this->view->title = $this->lang->user->buyScore;
        $this->display();
    }

    /**
     * Pay order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function payOrder($orderID)
    {
        if($this->app->user->account == 'guest') $this->locate($this->createLink('user', 'login'));

        $order = $this->score->getOrderByRawID($orderID);

        $this->view->title   = $this->lang->score->confirm;
        $this->view->payLink = $this->loadModel('order')->createPayLink($order);
        $this->view->order   = $order;
        $this->display();
    }

    /**
     * Process order.
     * 
     * @param  string $type
     * @param  string $mode return|notify
     * @access public
     * @return object
     */
    public function processOrder($type = 'alipay', $mode = 'return')
    {
        /* Get the orderID from the order. */
        $order = $this->loadModel('order')->getOrderFromAlipay($mode);
        if(!$order) die('STOP!');

        /* Process the order. */
        $result = $this->score->processOrder($order);

        /* Notify mode. */
        if($mode == 'notify')
        {
            $this->order->saveAlipayLog();
            if($result) die('success');
            die('fail');
        }
        $this->view->result  = $result;
        $this->view->orderID = $order->id;
        $this->display();
    }

    /**
     * Ranking list 
     * 
     * @access public
     * @return void
     */
    public function rankingList()
    {
        $allScore   = $this->dao->select('account, score')->from(TABLE_USER)->where('account')->ne('guest')->orderBy('score desc')->limit($this->config->score->ranking->limit)->fetchAll();
        $monthScore = $this->score->getRankingList('month');
        $weekScore  = $this->score->getRankingList('week');
        $dayScore   = $this->score->getRankingList('today');
        if(count($dayScore) < $this->config->score->ranking->limit) $dayScore = $this->score->getRankingList('yesteday');

        $users = array();
        foreach($allScore   as $score) $users[$score->account] = $score->account;
        foreach($monthScore as $score) $users[$score->account] = $score->account;
        foreach($weekScore  as $score) $users[$score->account] = $score->account;
        foreach($dayScore   as $score) $users[$score->account] = $score->account;

        $this->view->allScore   = $allScore;
        $this->view->monthScore = $monthScore; 
        $this->view->weekScore  = $weekScore;
        $this->view->dayScore   = $dayScore;
        $this->view->users      = $this->loadModel('user')->getBasicInfo($users);
        $this->display();
    }

    /**
     * Set counts for score.
     * 
     * @access public
     * @return void
     */
    public function rule()
    {
        $this->view->title = $this->lang->score->rule;
        $this->display();
    }

    /**
     * Set counts for score.
     * 
     * @access public
     * @return void
     */
    public function setCounts()
    {
        if($_POST)
        {
            $setting = fixer::input('post')->remove('perYuan, minAmount')->get();
            $result = $this->loadModel('setting')->setItems('system.score.counts', $setting);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $buyScore = fixer::input('post')->get('perYuan, minAmount');
            $result = $this->loadModel('setting')->setItems('system.score.buyScore', $buyScore);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
        }

        $this->view->title = $this->lang->score->setCounts;
        $this->display();
    }

    /**
     * Reset the max login field.
     * 
     * @access public
     * @return void
     */
    public function resetMaxLogin()
    {
        $this->dao->update(TABLE_USER)->set('maxLogin')->eq($this->config->score->counts->maxLogin)->exec();
        if(!dao::isError()) return $this->loadModel('setting')->setItem('system.common.site.resetMaxLoginDate', date('Y-m-d'));
        return false;
    }

    /**
     * Statement score.
     * 
     * @param  string  $date 
     * @access public
     * @return void
     */
    public function statement($date = 'lastMonth')
    {
        $date   = $date == 'lastMonth' ? date('Y-m-d', strtotime('-1 month')) : '';
        $scores = $this->dao->select('*')->from(TABLE_SCORE)
            ->where('1=1')
            ->beginIF($date)->andWhere('`time`')->le($date)->fi()
            ->orderBy('date_asc,id_asc')
            ->fetchAll('account');
        $outs = $this->dao->select('*')->from(TABLE_SCORE)->where('type')->ne('in')
            ->beginIF($date)->andWhere('`time`')->le($date)->fi()
            ->orderBy('date_asc,id_asc')
            ->fetchAll('account');

        $now        = $date ? $date : helper::now();
        $clientLang = $this->app->getClientLang();
        foreach($scores as $account => $score)
        {
            $this->dao->delete()->from(TABLE_SCORE)->where('account')->eq($account)
                ->andWhere('type')->in('in')
                ->beginIF($date)->andWhere('`time`')->le($date)->fi()
                ->exec();

            $count  = $score->after;
            $before = 0;
            if($outs[$account])
            {
                $out    = $outs[$account];
                $count  = $score->after - $out->after;
                $before = $out->after;
            }

            $data = new stdclass();
            $data->account = $account;
            $data->method  = 'statement';
            $data->type    = 'in';
            $data->count   = $count;
            $data->before  = $before;
            $data->after   = $score->after;
            $data->actor   = 'SYSTEM';
            $data->note    = 'STATEMENT';
            $data->time    = $now;
            $data->lang    = $clientLang;
            $this->dao->insert(TABLE_SCORE)->data($data)->exec();

            if(empty($date))
            {
                $data = new stdclass();
                $data->score = $score->after;
                $this->dao->update(TABLE_USER)->data($data)->where('account')->eq($account)->exec();
            }
            echo "Statement {$account} finish\n";
        }
    }
}
