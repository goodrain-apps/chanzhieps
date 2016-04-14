<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->stat->common        = '統計';
$lang->stat->setting       = '設置';
$lang->stat->view          = '查看';
$lang->stat->traffic       = '流量概況';
$lang->stat->report        = '詳細報告';
$lang->stat->client        = '終端';
$lang->stat->device        = '設備類型';
$lang->stat->os            = '操作系統';
$lang->stat->browser       = '用戶終端';
$lang->stat->from          = '來源分類';
$lang->stat->keywords      = '關鍵詞統計';
$lang->stat->keyword       = '關鍵詞';
$lang->stat->outSite       = '來源網站統計';
$lang->stat->search        = '搜索引擎';
$lang->stat->domain        = '來路域名';
$lang->stat->click         = '點擊排行';
$lang->stat->link          = '連結';
$lang->stat->today         = '今天';
$lang->stat->yestoday      = '昨天';
$lang->stat->pv            = '瀏覽量(PV)';
$lang->stat->uv            = '訪客數(UV)';
$lang->stat->ipCount       = 'IP數';
$lang->stat->totalPV       = '總訪問數';
$lang->stat->searchEngine  = '搜索引擎';
$lang->stat->keywordReport = '關鍵詞詳細';
$lang->stat->domainList    = '來路域名';
$lang->stat->domainTrend   = '趨勢';
$lang->stat->domainPage    = '頁面';
$lang->stat->percentage    = '百分比';
$lang->stat->ignoreKeyword = '忽略關鍵詞說明';
$lang->stat->keywordNotice = 'Google和百度取消了來路連結的關鍵詞顯示，因此無法統計其關鍵詞信息。';

$lang->stat->all   = '全部';
$lang->stat->begin = '開始日期';
$lang->stat->end   = '結束日期';
$lang->stat->date  = '日期';

$lang->stat->noData    = '沒有數據';
$lang->stat->dateError = '時間錯誤';

$lang->stat->itemList = new stdclass();
$lang->stat->itemList->self    = '直接訪問';
$lang->stat->itemList->out     = '外鏈訪問';
$lang->stat->itemList->search  = '搜索引擎';
$lang->stat->itemList->desktop = '桌面設備';
$lang->stat->itemList->mobile  = '移動設備';

$lang->stat->trafficModes = new stdclass();
$lang->stat->trafficModes->yestoday = '昨日';
$lang->stat->trafficModes->today    = '今日';
$lang->stat->trafficModes->weekly   = '最近一周';
$lang->stat->trafficModes->monthly  = '最近30天';

$lang->stat->fromList = new stdclass();
$lang->stat->fromList->self   = '直接訪問';
$lang->stat->fromList->out    = '外鏈';
$lang->stat->fromList->search = '搜索引擎';

$lang->stat->dataTypes = new stdclass();
$lang->stat->dataTypes->pv = '瀏覽量(PV)';
$lang->stat->dataTypes->uv = '訪客數(UV)';
$lang->stat->dataTypes->ip = 'IP數';

$lang->stat->page = new stdclass();
$lang->stat->page->common = '頁面訪問量';
$lang->stat->page->url    = '頁面地址';
