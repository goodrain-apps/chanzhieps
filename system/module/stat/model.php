<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of stat module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class statModel extends model
{
    /**
     * Get basic line.
     * 
     * @param  string    $type 
     * @param  string    $timeType 
     * @param  array    $labels 
     * @access public
     * @return array
     */
    public function getBasicLine($type, $timeType, $labels)
    {
        $traffic = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq('basic')->andWhere('item')->eq($type)
            ->andWhere('timeValue')->in($labels)
            ->andWhere('timeType')->eq($timeType)
            ->fetchAll('timeValue');

        foreach($labels as $time)
        {
            $pv[] = isset($traffic[$time]) ? $traffic[$time]->pv : 0;
            $uv[] = isset($traffic[$time]) ? $traffic[$time]->uv : 0;
            $ip[] = isset($traffic[$time]) ? $traffic[$time]->ip : 0;
        }

        $chartData = array();

        $pvChart = new stdclass(); 
        $pvChart->label = $this->lang->stat->pv;
        $pvChart->color = 'green';
        $pvChart->data  = $pv;

        $uvChart = new stdclass(); 
        $uvChart->label = $this->lang->stat->uv;
        $uvChart->color = 'blue';
        $uvChart->data  = $uv;

        $ipChart = new stdclass(); 
        $ipChart->label = $this->lang->stat->ipCount;
        $ipChart->color = 'red';
        $ipChart->data  = $ip;

        $chartData['pv'] = $pvChart;
        $chartData['uv'] = $uvChart;
        $chartData['ip'] = $ipChart;
        return $chartData;
    }

    /**
     * Get item lines of a type.
     * 
     * @param  string    $type 
     * @param  string    $timeType 
     * @param  array     $labels 
     * @access public
     * @return array
     */
    public function getTypeLine($type = '', $timeType, $labels, $groupBy = 'item')
    {
        $traffic = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq($type)
            ->andWhere('timeType')->eq($timeType)
            ->andWhere('timeValue')->in($labels)
            ->fetchGroup($groupBy, 'timeValue');

        if(empty($traffic)) return array();

        $colors = $this->config->stat->chartColors;

        $i = 0;
        foreach($traffic as $item => $reports)
        {
            $i ++;
            $colors[$item] = isset($colors[$item]) ? $colors[$item] : $colors[$i];

            $pvChart = new stdclass;
            $pvChart->data  = array();
            $pvChart->label = zget($this->lang->stat->itemList, $item);
            $pvChart->color = $colors[$item];

            $uvChart = new stdclass;
            $uvChart->data  = array();
            $uvChart->label = zget($this->lang->stat->itemList, $item);
            $uvChart->color = $colors[$item];

            $ipChart = new stdclass;
            $ipChart->data  = array();
            $ipChart->label = zget($this->lang->stat->itemList, $item);
            $ipChart->color = $colors[$item];

            foreach($labels as $day)
            {
                $pvChart->data[] = isset($reports[$day]) ? $reports[$day]->pv : 0;
                $uvChart->data[] = isset($reports[$day]) ? $reports[$day]->uv : 0;
                $ipChart->data[] = isset($reports[$day]) ? $reports[$day]->ip : 0;
            }

            $pvCharts[] = $pvChart;
            $uvCharts[] = $uvChart;
            $ipCharts[] = $ipChart;
        }
        return array('pvChart' => $pvCharts, 'uvChart' => $uvCharts, 'ipChart' => $ipCharts);
    }

    /**
     * Get pie chart data of one type.
     * 
     * @param  string  $type
     * @param  int     $begin 
     * @param  int     $end 
     * @access public
     * @return array
     */
    public function getPieByType($type, $begin, $end, $groupBy = 'item')
    {
        $charts  = array();
        $reports = $this->dao->select('*, sum(ip) as ip, sum(pv) as pv, sum(uv) as uv')->from(TABLE_STATREPORT)
            ->where('type')->eq($type)
            ->andWhere('timeType')->eq('day')
            ->beginIf($begin != '')->andWhere('timeValue')->ge($begin)->fi()
            ->beginIf($end != '')->andWhere('timeValue')->le($end)->fi()
            ->groupBy($groupBy)
            ->fetchAll($groupBy);

        $colors = $this->config->stat->chartColors;
        $this->loadModel('log');
        
        $i = 0;       
        foreach($reports as $item => $report)
        {
            $color[$item] = isset($color[$item]) ? $color[$item] : $colors[$i];
            $i ++;
            
            $pv = new stdclass();
            $pv->value = $report->pv;
            $pv->color = $color[$item];
            $pv->label = zget($this->lang->stat->itemList, $item);

            $uv = new stdclass();
            $uv->value = $report->uv;
            $uv->color = $color[$item];
            $uv->label = zget($this->lang->stat->itemList, $item);

            $ip = new stdclass();
            $ip->value = $report->ip;
            $ip->color = $color[$item];
            $ip->label = zget($this->lang->stat->itemList, $item);

            $charts['pv'][] = $pv;
            $charts['uv'][] = $uv;
            $charts['ip'][] = $ip;
        }

        return $charts;
    }

    /**
     * Get day labels between begin and end date.
     * 
     * @param  int    $begin 
     * @param  int    $end 
     * @access public
     * @return void
     */
    public function getDayLabels($begin, $end)
    {
        $days = (strtotime($end) - strtotime($begin)) / (24 * 60 * 60);
        for($i = $days; $i >= 0;  $i--) $dayLabels[] = date('Ymd', strtotime("-{$i} day", strtotime($end)));
        return $dayLabels;
    }

    /**
     * Get hour labels of one date.
     * 
     * @param  int     $day 
     * @param  bool    $showDate
     * @access public
     * @return array
     */
    public function getHourLabels($day, $showDate = true)
    {
        if($showDate)
        {
            foreach($this->config->stat->hourLabels as $hour) $labels[] = $day . $hour;
        }
        else
        {
            foreach($this->config->stat->hourLabels as $hour) $labels[] = $hour . ':00';
        }
        return $labels;
    }
    
    /**
     * Get keywords list.
     * 
     * @param  int       $begin 
     * @param  int       $end 
     * @param  string    $orderBy 
     * @param  object    $pager 
     * @access public
     * @return void
     */
    public function getKeywordsList($begin, $end, $orderBy, $pager)
    {
        return $this->dao->select('*, sum(pv) as pv, sum(uv) as uv, sum(ip) as ip')->from(TABLE_STATREPORT)
            ->where('type')->eq('keywords')
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->ge($begin)
            ->andWhere('timeValue')->le($end)
            ->groupBy('concat(item, extra)')
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchGroup('item', 'extra');
    }

    /**
     * Get keywords list.
     * 
     * @param  int       $begin 
     * @param  int       $end 
     * @param  string    $orderBy 
     * @param  object    $pager 
     * @access public
     * @return void
     */
    public function getDomainList($begin, $end, $orderBy, $pager)
    {
        return $this->dao->select('*, sum(pv) as pv, sum(uv) as uv, sum(ip) as ip')->from(TABLE_STATREPORT)
            ->where('type')->eq('domain')
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->ge($begin)
            ->andWhere('timeValue')->le($end)
            ->groupBy('item')
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('item');
    }

    /**
     * Get traffic info of a keyword.
     * 
     * @param  string    $keyword 
     * @param  int    $begin 
     * @param  int    $end 
     * @access public
     * @return object
     */
    public function getTrafficByKeyword($keyword, $begin, $end)
    {
         return $this->dao->select('*, sum(pv) as pv, sum(uv) as uv, sum(ip) as ip')->from(TABLE_STATREPORT)
            ->where('type')->eq('keywords')
            ->andWhere('item')->eq($keyword)
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->ge($begin)
            ->andWhere('timeValue')->le($end)
            ->fetch();
    }

    /**
     * Get data for keyword line chart.
     * 
     * @param  string    $keyword 
     * @param  int    $begin 
     * @param  int    $end 
     * @access public
     * @return array
     */
    public function getItemLine($type, $item, $begin, $end)
    {
        $labels  = $this->getDayLabels($begin, $end);
        if($begin == $end) $labels = $this->getHourLabels($begin);
        $traffic = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq($type)
            ->andWhere('item')->eq($item)
            ->beginIf($begin == $end)->andWhere('timeType')->eq('hour')->fi()
            ->beginIf($begin != $end)->andWhere('timeType')->eq('day')->fi()
            ->andWhere('timeValue')->in($labels)
            ->fetchAll('timeValue');

        if(empty($traffic)) return array();

        foreach($labels as $time)
        {
            $pv[] = isset($traffic[$time]) ? $traffic[$time]->pv : 0;
            $uv[] = isset($traffic[$time]) ? $traffic[$time]->uv : 0;
            $ip[] = isset($traffic[$time]) ? $traffic[$time]->ip : 0;
        }

        $chartData = array();

        $pvChart = new stdclass(); 
        $pvChart->label = $this->lang->stat->pv;
        $pvChart->color = 'green';
        $pvChart->data  = $pv;

        $uvChart = new stdclass(); 
        $uvChart->label = $this->lang->stat->uv;
        $uvChart->color = 'blue';
        $uvChart->data  = $uv;

        $ipChart = new stdclass(); 
        $ipChart->label = $this->lang->stat->ipCount;
        $ipChart->color = 'red';
        $ipChart->data  = $ip;

        $chartData[] = $pvChart;
        $chartData[] = $uvChart;
        $chartData[] = $ipChart;
        return $chartData;
    }

    /**
     * Parse begin and end date.
     * 
     * @param  string    $mode 
     * @param  int       $begin 
     * @param  int       $end 
     * @access public
     * @return void
     */
    public function parseDate($mode, $begin, $end)
    {
        if($mode == 'today')
        {
            $begin = $end = date("Ymd");
        }
        elseif($mode == 'yestoday')
        {
            $begin = $end = date("Ymd", strtotime("-1 day"));
        }
        elseif($mode == 'weekly')
        {
            $begin =  date("Ymd", strtotime("-7 day"));
            $end   = date('Ymd');
        }
        elseif($mode == 'monthly')
        {
            $begin =  date("Ymd", strtotime("-30 day"));
            $end   = date('Ymd');
        }
        else
        {
            $begin = date('Ymd', strtotime($begin));
            $end   = date('Ymd', strtotime($end));
        }

        if(!$begin) $begin = date('Ymd', strtotime($begin));
        if(!$end)   $end   = date('Ymd', strtotime($end));

        $params = new stdclass();
        $params->begin = $begin;
        $params->end   = $end;
        return $params;
    }

    /**
     * Get item extra pie data.
     * 
     * @param  string   $domain 
     * @param  int      $begin 
     * @param  int      $end 
     * @access public
     * @return void
     */
    public function getItemExtraPie($type, $item, $begin, $end)
    {
        $charts  = array();
        $reports = $this->dao->select('*, sum(ip) as ip, sum(pv) as pv, sum(uv) as uv')->from(TABLE_STATREPORT)
            ->where('type')->eq($type)
            ->andWhere('item')->eq($item)
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->ge($begin)
            ->andWhere('timeValue')->le($end)
            ->groupBy('extra')
            ->fetchAll('extra');

        $colors = $this->config->stat->chartColors;
        $this->loadModel('log');
        
        $i = 0;       
        foreach($reports as $extra => $report)
        {
            $color[$extra] = isset($color[$extra]) ? $color[$extra] : $colors[$i];
            $i ++;

            $pv = new stdclass();
            $pv->value = $report->pv;
            $pv->color = $color[$extra];
            $pv->label = $report->extra;

            $uv = new stdclass();
            $uv->value = $report->uv;
            $uv->color = $color[$extra];
            $uv->label = $report->extra;

            $ip = new stdclass();
            $ip->value = $report->ip;
            $ip->color = $color[$extra];
            $ip->label = $report->extra;

            $charts['pv'][] = $pv;
            $charts['uv'][] = $uv;
            $charts['ip'][] = $ip;
        }
        return $charts;
    }

    /**
     * Get page report data.
     * 
     * @param  int    $domain 
     * @param  int    $begin 
     * @param  int    $end 
     * @param  int    $pager 
     * @access public
     * @return void
     */
    public function getPageReport($domain, $begin, $end, $pager)
    {
        return $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq('domain')
            ->andWhere('item')->eq($domain)
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->ge($begin)
            ->andWhere('timeValue')->le($end)
            ->orderBy('pv_desc')
            ->page($pager)
            ->fetchGroup('extra', 'timeValue');
    }

    /**
     * Get today report 
     * 
     * @access public
     * @return array 
     */
    public function getTodayReport()
    {
        $todayReport = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('timeType')->eq('day')
            ->andWhere('timeValue')->eq(date('Ymd'))
            ->fetch(); 

        return $todayReport;
    }

    /**
     * Get yestoday report 
     * 
     * @access public
     * @return array 
     */
    public function getYestodayReport()
    {
        $yestodayReport = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('timeType')->eq('day')
            ->andWhere('timeValue')->eq(date('Ymd', strtotime("-1 day")))
            ->fetch();

        return $yestodayReport;
    }
}
