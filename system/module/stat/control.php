<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of stat of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class stat extends control
{
    /**
     * Traffic statistics.
     * 
     * @param  string $mode 
     * @access public
     * @return void
     */
    public function traffic($mode = '', $begin = '', $end = '')
    {
        if(!$mode) $mode = date("H") < 10 ? 'yestoday' : 'today';
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;
        $this->view->todayReport    = $this->stat->getTodayReport(); 
        $this->view->yestodayReport = $this->stat->getYestodayReport(); 

        if($begin == $end)
        {
            $labels = $this->stat->getHourLabels($begin);
            $this->view->labels    = $this->stat->getHourLabels($begin, false);;
            $this->view->lineChart = $this->stat->getBasicLine('total', 'hour', $labels);
        }
        else
        {
            $labels = $this->stat->getDayLabels($begin, $end);
            foreach($labels as $label ) $this->view->labels[] = date('Y-m-d', strtotime($label));
            $this->view->lineChart = $this->stat->getBasicLine('total', 'day', $labels);
        }

        $this->view->title = $this->lang->stat->traffic;
        $this->view->mode  = $mode;

        $this->display();
    }

    /**
     * From statistics report page.
     * 
     * @param  string $begin 
     * @param  string $end 
     * @access public
     * @return void
     */
    public function from($mode = '', $begin = '', $end = '')
    {
        if(!$mode) $mode = date("H") < 10 ? 'yestoday' : 'today';
        $type = 'from';
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;
        if($begin < $end) 
        {
            $labels = $this->stat->getDayLabels($begin, $end);
            foreach($labels as $label ) $this->view->lineLabels[] = date('Y-m-d', strtotime($label));
        }
        if($begin == $end) 
        {
            $labels = $this->stat->getHourLabels($begin);
            $this->view->lineLabels = $this->stat->getHourLabels($begin, false);
        }
        
        $this->view->pieCharts  = $this->stat->getPieByType($type, $begin, $end);

        $timeType = $begin == $end ? 'hour' : 'day';
        $this->view->lineCharts = $this->stat->getTypeLine($type, $timeType, $labels);
        
        $this->view->title = $this->lang->stat->from;
        $this->view->mode  = $mode; 
        $this->view->type  = $type;
        
        $this->display();
    }

    /**
     * Search statistics report page.
     * 
     * @param  string $begin 
     * @param  string $end 
     * @access public
     * @return void
     */
    public function search($mode = '', $begin = '', $end = '')
    {
        if(!$mode) $mode = date("H") < 10 ? 'yestoday' : 'today';
        $type = 'search';
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;
        if($begin < $end) 
        {
            $labels = $this->stat->getDayLabels($begin, $end);
            foreach($labels as $label ) $this->view->lineLabels[] = date('Y-m-d', strtotime($label));
        }
        if($begin == $end) 
        {
            $labels = $this->stat->getHourLabels($begin);
            $this->view->lineLabels = $this->stat->getHourLabels($begin, false);
        }
        
        $this->view->pieCharts  = $this->stat->getPieByType($type, $begin, $end);

        $timeType = $begin == $end ? 'hour' : 'day';
        $this->view->lineCharts = $this->stat->getTypeLine($type, $timeType, $labels);
        
        $this->view->title = $this->lang->stat->search;
        $this->view->mode  = $mode; 
        $this->view->type  = $type;
        
        $this->display();
    }


    /**
     * From statistics report page.
     * 
     * @param  string $begin 
     * @param  string $end 
     * @access public
     * @return void
     */
    public function client($type = 'browser', $mode = '', $begin = '', $end = '')
    {
        if(!$mode) $mode = date("H") < 10 ? 'yestoday' : 'today';
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;
        if($begin < $end) 
        {
            $labels = $this->stat->getDayLabels($begin, $end);
            foreach($labels as $label ) $this->view->lineLabels[] = date('Y-m-d', strtotime($label));
        }
        if($begin == $end) 
        {
            $labels = $this->stat->getHourLabels($begin);
            $this->view->lineLabels = $this->stat->getHourLabels($begin, false);
        }
        
        $this->view->pieCharts  = $this->stat->getPieByType($type, $begin, $end);

        if(empty($this->view->lineLabels)) 
        {
            $this->view->error = $this->lang->stat->dateError;
            $this->display();
            exit;
        }

        $timeType = $begin == $end ? 'hour' : 'day';
        $this->view->totalPV = $this->dao->select('sum(pv) as pv')->from(TABLE_STATREPORT)
            ->where('type')->eq('basic')
            ->andWhere('item')->eq('total')
            ->beginIf($begin != '')->andWhere('timeValue')->ge($begin)->fi()
            ->beginIf($end != '')->andWhere('timeValue')->le($end)->fi()
            ->fetch('pv');

        $this->view->title = $this->lang->stat->{$type}; 
        $this->view->mode  = $mode; 
        $this->view->type  = $type; 
        $this->display();
    }

    /**
     * Keywords report page.
     * 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function keywords($mode = 'today', $begin = '', $end = '', $orderBy = 'pv_desc',  $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {   
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;

        $keywordList = $this->stat->getKeywordsList($begin, $end, $orderBy, $pager);
        foreach($keywordList as $keyword => $reports)
        {
            $other = new stdclass();
            $other->pv = 0; 
            $other->uv = 0;
            $other->ip = 0;
            foreach($reports as $engine => $report)
            {
                if(in_array($engine, $this->config->stat->searchEngines)) continue;
                $other->pv += $report->pv;
                $other->uv += $report->uv;
                $other->ip += $report->ip;
            }
            $keywordList[$keyword]['other'] = $other;
        }

        $this->view->searchEngines = $this->config->stat->searchEngines;
        $this->view->keywordList   = $keywordList;
        $this->view->title         = $this->lang->stat->keyword;
        $this->view->mode          = $mode;
        $this->view->begin         = $begin;
        $this->view->end           = $end;
        $this->view->orderBy       = $orderBy;
        $this->view->pager         = $pager;
        $this->display();
    }

    /**
     * Report page of one keyword.
     * 
     * @param  string    $keyword 
     * @param  string    $mode 
     * @param  string    $begin 
     * @param  string    $end 
     * @access public
     * @return void
     */
    public function keywordReport($keyword, $mode = 'today', $begin = '', $end = '')
    {
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;

        if($begin < $end) 
        {
            $labels = $this->stat->getDayLabels($begin, $end);
            foreach($labels as &$label) $label = date('Y-m-d', strtotime($label));
        }

        if($begin == $end) $labels = $this->stat->getHourLabels($begin, false);

        $this->view->keyword     = $keyword;
        $this->view->labels      = $labels;
        $this->view->mode        = $mode;
        $this->view->totalInfo   = $this->stat->getTrafficByKeyword($keyword, $begin, $end);
        $this->view->keywordLine = $this->stat->getItemLine('keywords', $keyword, $begin, $end);
        $this->view->pieCharts   = $this->stat->getItemExtraPie('keywords', $keyword, $begin, $end);
        $this->display();
    }

    /**
     * Domain report.
     * 
     * @param  string    $mode 
     * @param  string    $begin 
     * @param  string    $end 
     * @access public
     * @return void
     */
    public function domainList($mode = '', $begin = '', $end = '', $orderBy = 'pv_desc',  $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        if(!$mode) $mode = date("H") < 10 ? 'yestoday' : 'today';
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;

        if($begin < $end)  $labels = $this->stat->getDayLabels($begin, $end);
        if($begin == $end) $labels = $this->stat->getHourLabels($begin, false);

        $this->view->title   = $this->lang->stat->domain;
        $this->view->labels  = $labels;
        $this->view->mode    = $mode;
        $this->view->domains = $this->stat->getDomainList($begin, $end, $orderBy, $pager);
        $this->view->pager   = $pager;

        $this->display();
    }

    /**
     * Domain trend report.
     * 
     * @param  string    $domain 
     * @param  string    $mode 
     * @param  string    $begin 
     * @param  string    $end 
     * @access public
     * @return void
     */
    public function domainTrend($domain, $mode = 'today', $begin = '', $end = '')
    {
        $domain = helper::safe64decode($domain);
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;

        if($begin < $end)  $labels = $this->stat->getDayLabels($begin, $end);
        if($begin == $end) $labels = $this->stat->getHourLabels($begin, false);

        $this->view->title     = $this->lang->stat->domain . ' - ' . $domain;
        $this->view->domain    = $domain;
        $this->view->labels    = $labels;
        $this->view->mode      = $mode;
        $this->view->lineChart = $this->stat->getItemLine('domain', $domain, $begin, $end);
        $this->view->pieCharts = $this->stat->getItemExtraPie('domain', $domain, $begin, $end);

        $this->display();
    }

    /**
     * Domain pages report.
     * 
     * @param  string    $domain 
     * @param  string    $mode 
     * @param  string    $begin 
     * @param  string    $end 
     * @access public
     * @return void
     */
    public function domainPage($domain, $mode = 'today', $begin = '', $end = '', $recTotal = 0, $recPerPage = 50, $pageID = 1)
    {
        $domain = helper::safe64Decode($domain);
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;

        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $labels = $this->stat->getDayLabels($begin, $end);

        $this->view->type   = $this->lang->stat->domain . ' - ' . $domain;
        $this->view->domain = $domain;
        $this->view->labels = $labels;
        $this->view->mode   = $mode;
        $this->view->pages  = $this->stat->getPageReport($domain, $begin, $end, $pager);
        $this->view->pager  = $pager;

        $this->display();
    }
   /**
     * Page ranking.
     * 
     * @param  string   $mode 
     * @param  string   $orderBy 
     * @param  int      $begin 
     * @param  int      $end 
     * @access public
     * @return void
     */
    public function page($mode = '', $begin = '', $end = '')
    {
        if(!$mode) $mode = date("H") < 10 ? 'yestoday' : 'today';
        $date  = $this->stat->parseDate($mode, $begin, $end);
        $begin = $date->begin;
        $end   = $date->end;
        $pages = $this->dao->select('*, sum(pv) as pv')->from(TABLE_STATREPORT)
            ->where('type')->eq('url')
            ->andWhere('item')->ne('')
            ->beginIf($mode != 'all')
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->ge($begin)
            ->andWhere('timeValue')->le($end)
            ->fi()
            ->groupBy('item')
            ->orderBy('pv_desc')
            ->limit(100)
            ->fetchAll();

        $this->view->title = $this->lang->stat->click;
        $this->view->mode  = $mode;
        $this->view->pages = $pages;
        $this->view->begin = $begin;
        $this->view->end   = $end;
        $this->display();
    }

    /**
     * Ignore keyword notice.
     *
     * @access public
     * @return void
     */
    public function ignoreKeyword()
    {
        $result = $this->loadModel('setting')->setItems('system.common.global', array('ignoreKeyword' => true));
        if($result) $this->send(array('result' => 'success', 'locate' => inlink('keywords')));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
    }

    /**
     * Set log.
     * 
     * @access public
     * @return void
     */
    public function setting()
    {
        if(!empty($_POST))
        {
            $setting = fixer::input('post')->get();
            if(!$setting->saveDays or !validater::checkInt($setting->saveDays)) $this->send(array('result' => 'fail', 'message' => $this->lang->site->saveDaysTip));
            $result = $this->loadModel('setting')->setItems('system.common.site', $setting);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->stat->setting;
        $this->display();
    }
}
