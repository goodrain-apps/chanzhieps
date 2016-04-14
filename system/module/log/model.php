<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The model file of log module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     log
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class logModel extends model
{
    /**
     * Save visitor info.
     * 
     * @access public
     * @return object
     */
    public function saveVisitor()
    {
        $browserName    = helper::getBrowser();
        $browserVersion = helper::getBrowserVersion();
        if(!empty($_COOKIE['vid']))
        {           
            $visitor = $this->getVisitorByID($this->cookie->vid); 
            if(!empty($visitor))
            {
                $visitor->new = false;
                if($visitor->browserName == $browserName and $visitor->browserVersion = $browserVersion and $visitor->osName == helper::getOS()) return $visitor;
            }
        }

        $visitor = fixer::input('get')
            ->add('device', $this->app->device)
            ->add('osName', helper::getOS())
            ->add('browserName', helper::getBrowser())
            ->add('browserVersion', helper::getBrowserVersion())
            ->add('createdTime', helper::now())
            ->get();

        if($visitor->browserName == 'ie') $visitor->browserName .= $visitor->browserVersion;

        $this->dao->insert(TABLE_STATVISITOR)->data($visitor, 'referer')->autocheck()->exec();
        $visitor->new = true;
        $vid = $this->dao->lastInsertId();

        setcookie('vid', $vid, strtotime('+5 year'));
        $visitor->id = $vid;
        return $visitor;
    }

    /**
     * Get a visitor by ID.
     * 
     * @param  int    $vid 
     * @access public
     * @return void
     */
    public function getVisitorByID($vid)
    {
        return $this->dao->select('*')->from(TABLE_STATVISITOR)->where('id')->eq($vid)->fetch();
    }

    /**
     * Save referer info.
     * 
     * @access public
     * @return array
     */
    public function saveReferer()
    {
        if(!$this->get->referer)
        {
            if($this->session->referer)
            {
                $referer = $this->getRefererByID($this->session->referer);
                if(!empty($referer)) return $referer;
            }
            return null;
        }

        $url = helper::safe64decode($this->get->referer);
        $refererInDB = $this->dao->select("*")->from(TABLE_STATREFERER)->where('url')->eq($url)->fetch();

        if(!empty($refererInDB))
        {
            $this->session->set('referer', $refererInDB->id);
            return $refererInDB;
        }

        $referer = parse_url($url);
        if(isset($this->config->searchEngine->domains[$referer['host']]))
        {
            $searchEngine = $this->config->searchEngine->domains[$referer['host']];
            $param        = $this->config->searchEngine->params[$searchEngine];
            parse_str($referer['query'], $queryInfo);
            if(is_array($param))
            {
                foreach($param as $paramName) 
                {
                    if(isset($queryInfo[$paramName])) $keywords = $queryInfo[$paramName];
                }
            }
            else
            {
                $keywords = $queryInfo[$param];
            }
            $referer['searchEngine'] = $searchEngine;
            $referer['keywords']     = $keywords;
        }
        $referer['domain'] = $referer['host'];
        $referer['url']    = $url;

        $this->dao->replace(TABLE_STATREFERER)->data($referer, "port,host,query,path,scheme")->autoCheck()->exec();
        $referer['id'] = $this->dao->lastInsertId();

        $this->session->set('referer', $referer['id']);
        return (object)$referer;
    }

    /**
     * Get a referer by id. 
     * 
     * @param  int    $refererID 
     * @access public
     * @return object
     */
    public function getRefererByID($refererID)
    {
        return $this->dao->select('*')->from(TABLE_STATREFERER)->where('id')->eq($refererID)->fetch();
    }

    /**
     * Save report data.
     * 
     * @param  int    $visitor 
     * @param  int    $referer 
     * @access public
     * @return void
     */
    public function saveReport($visitor, $referer)
    {
        $beforeDay = date('Ymd00', strtotime('-2 day'));
        $this->dao->delete()->from(TABLE_STATREPORT)->where('timeType')->eq('hour')->andWhere('timeValue')->le($beforeDay)->exec();

        $year  = date('Y');
        $month = date('Ym');
        $day   = date('Ymd');
        $hour  = date('YmdH');

        $time = new stdclass();
        $time->year  = $year;
        $time->month = $month;
        $time->day   = $day;
        $time->hour  = $hour;

        /* Save data to eps_statlog. */
        $log = new stdclass();

        $log->url            = $this->server->http_referer;
        $log->visitor        = $visitor->id;
        $log->osName         = $visitor->osName;
        $log->browserName    = $visitor->browserName;
        $log->browserVersion = $visitor->browserVersion;

        $log->referer      = !empty($referer) ? $referer->id : 0;
        $log->domain       = isset($referer->domain) ? $referer->domain : '';
        $log->link         = isset($referer->url) ? $referer->url : '';
        $log->searchEngine = isset($referer->searchEngine) ? $referer->searchEngine : '';
        $log->keywords     = isset($referer->keywords) ? $referer->keywords : '';
        $log->ip           = helper::getRemoteIp();

        $location = $this->app->loadClass('IP')->find($log->ip);
        $log->country  = $location[0];
        $log->province = $location[1];
        $log->city     = $location[2];
        $log->account  = $this->app->user->account;
        $log->year     = $year;
        $log->month    = $month;
        $log->day      = $day;
        $log->hour     = $hour;
        $log->new      = $visitor->new ? 1 : 0;
        $log->mobile   = $this->app->device == 'mobile' ? 1 : 0;
        $this->dao->insert(TABLE_STATLOG)->data($log)->exec();

        /* Save basic report data. */
        $this->saveReportItem('basic', 'total', $time, $log);
        $this->saveReportItem('url', $this->server->http_referer, $time, $log);
        if(!$visitor->new and time() - strtotime($visitor->createdTime) > 60 * 60 * 24) $this->saveReportItem($type = 'basic', $item = 'return', $time, $log);
        if($log->mobile) $this->saveReportItem($type = 'device', $item = 'mobile', $time, $log);
        if(!$log->mobile) $this->saveReportItem($type = 'device', $item = 'desktop', $time, $log);

        /* Save serachengine data. */
        if(isset($referer->searchEngine) and $referer->searchEngine != '') $this->saveReportItem($type = 'search', $item = $referer->searchEngine, $time, $log);
        if(isset($referer->keywords) and $referer->keywords != '') $this->saveReportItem($type = 'keywords', $item = $referer->keywords, $time, $log, $referer->searchEngine);
        
        /* Save referer data. */
        if(!empty($referer)) $this->saveReportItem($type = 'referer', $item = $referer->id, $time, $log);
        if(!empty($referer)) $this->saveReportItem($type = 'domain', $item = $referer->domain, $time, $log, $referer->url);

        /* Save os data. */
        $this->saveReportItem($type = 'os', $item = $visitor->osName, $time, $log);

        /* Save browser data. */
        $this->saveReportItem($type = 'browser', $item = $visitor->browserName, $time, $log);

        /* Save from data. */
        if($log->referer != 0 and $log->searchEngine == '') $this->saveReportItem($type = 'from', $item = 'out', $time, $log);
        if($log->referer == 0) $this->saveReportItem($type = 'from', $item = 'self', $time, $log);
        if(!empty($log->referer) and $log->searchEngine != '') $this->saveReportItem($type = 'from', $item = 'search', $time, $log);
    }

    /**
     * Get ip and uv.
     * 
     * @param  string    $type 
     * @param  string    $item 
     * @param  string    $timeType 
     * @param  string    $timeValue
     * @param  object    $log 
     * @param  string    $extra
     * @access public
     * @return object
     */
    public function getIpAndUv($type, $item, $timeType, $timeValue, $log, $extra = '')
    {
        $ipAndUv = new stdclass();
        $ipAndUv->ip = 0;
        $ipAndUv->uv = 0;

        $allowedTypes = array('basic', 'search', 'keywords', 'os', 'url', 'domain', 'browser', 'from');
        if(!in_array($type, $allowedTypes)) return $ipAndUv;

        if($timeType == 'year') return $ipAndUv;

        $ipAndUv = $this->dao->select('count(distinct(ip)) as ip, count(distinct(visitor)) as uv')
            ->from(TABLE_STATLOG)
            ->where($timeType)->eq($timeValue)

            ->beginIF($type == 'basic' and $item == 'return')
            ->andWhere('new')->eq(0)
            ->fi()

            ->beginIF($type == 'basic' and $item == 'mobile')
            ->andWhere('mobile')->eq(1)
            ->fi()

            ->beginIF($type == 'search')
            ->andWhere('searchEngine')->eq($log->searchEngine)
            ->fi()

            ->beginIF($type == 'keywords')
            ->andWhere('keywords')->eq($log->keywords)
            ->andWhere('searchEngine')->eq($extra)
            ->fi()

            ->beginIF($type == 'os')
            ->andWhere('osName')->eq($log->osName)
            ->fi()

            ->beginIF($type == 'url')
            ->andWhere('link')->eq($log->url)
            ->fi()

            ->beginIF($type == 'domain')
            ->andWhere('link')->eq($log->link)
            ->fi()

            ->beginIF($type == 'browser')
            ->andWhere('browserName')->eq($log->browserName)
            ->fi()

            ->beginIF($type == 'from' and $item == 'out')
            ->andWhere('referer')->ne(0)->andWhere('searchEngine')->eq('')
            ->fi()

            ->beginIF($type == 'from' and $item == 'self')
            ->andWhere('referer')->eq(0)
            ->fi()

            ->beginIF($type == 'from' and $item == 'search')
            ->andWhere('searchEngine')->ne('')
            ->fi()

            ->fetch();

        if(empty($ipAndUv))
        {
            $ipAndUv = new stdclass();
            $ipAndUv->ip = 0;
            $ipAndUv->uv = 0;
        }

        return $ipAndUv;
    }

    /**
     * Save a report item of all timeType (year, month, day, hour)
     * 
     * @param  string    $type 
     * @param  string    $item 
     * @param  object    $time 
     * @param  object    $log 
     * @param  string    extra
     * @access public
     * @return void
     */
    public function saveReportItem($type, $item, $time, $log, $extra = '')
    {
        foreach($time as $timeType => $timeValue)
        {
            $oldReport = $this->dao->select('*')->from(TABLE_STATREPORT)
                ->where('type')->eq($type)->andWhere('item')->eq($item)
                ->andWhere('timeType')->eq($timeType)
                ->andWhere('timeValue')->eq($timeValue)
                ->beginIf($extra)->andWhere('extra')->eq($extra)->fi()
                ->fetch();

            if(!empty($oldReport))
            {
                $ipAndUv = $this->getIpAndUv($type, $item, $timeType, $timeValue, $log, $extra);

                $this->dao->update(TABLE_STATREPORT)
                    ->set('pv = pv + 1')
                    ->set('ip')->eq($ipAndUv->ip)
                    ->set('uv')->eq($ipAndUv->uv)
                    ->where('id')->eq($oldReport->id)
                    ->exec();
            }
            else
            {
                $report = new stdclass();
                $report->type      = $type;
                $report->item      = $item;
                $report->timeType  = $timeType;
                $report->timeValue = $timeValue;
                $report->pv        = 1;
                $report->uv        = 1;
                $report->ip        = 1;
                $report->extra     = $extra;
                $this->dao->insert(TABLE_STATREPORT)->data($report)->exec();
            }
        }
    }

    /**
     * Save region data.
     * 
     * @access public
     * @return void
     */
    public function saveRegion()
    {
        $year  = date('Y');
        $month = date('Ym');
        $day   = date('Ymd');
        $hour  = date('YmdH');

        $time = new stdclass();
        $time->year  = $year;
        $time->month = $month;
        $time->day   = $day;
        $time->hour  = $hour;

        foreach($time as $type => $value)
        {
            $oldRegion = $this->dao->select('*')->from(TABLE_STATREGION)
                ->where('timeType')->eq($type)
                ->andWhere('timeValue')->eq($value)
                ->fetch();

            if(!empty($oldRegion))
            {
                $ipAndUv = $this->dao->select('count(distinct(ip)) as ip, count(distinct(visitor)) as uv')
                    ->from(TABLE_STATLOG)
                    ->where($type)->eq($value)
                    ->fetch();

                $this->dao->update(TABLE_STATREGION)
                    ->set('pv = pv + 1')
                    ->set('uv')->eq($ipAndUv->uv)
                    ->set('ip')->eq($ipAndUv->ip)
                    ->where('id')->eq($oldRegion->id)
                    ->exec();
            }
            else
            {
                $location = $this->app->loadClass('IP')->find(helper::getRemoteIp());
                $region = new stdclass();
                $region->timeType  = $type;
                $region->timeValue = $value;
                $region->country   = $location[0];
                $region->province  = $location[1];
                $region->city      = $location[2];
                $region->pv        = 1; 
                $region->uv        = 1; 
                $region->ip        = 1;

                $this->dao->insert(TABLE_STATREGION)->data($region)->exec();
            }
        }

        return !dao::isError();
    }

    /**
     * Clear report.
     * 
     * @access public
     * @return void
     */
    public function clearLog()
    { 
        $saveDays = !empty($this->config->site->saveDays) ? $this->config->site->saveDays : 30;
        $date = date('Ymd', strtotime("-{$saveDays} day"));
        $this->dao->delete()->from(TABLE_STATLOG)->where('day')->lt($date)->exec();
        return !dao::isError();
    }
}
