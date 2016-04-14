<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->stat->common        = '统计';
$lang->stat->setting       = '设置';
$lang->stat->view          = '查看';
$lang->stat->traffic       = '流量概况';
$lang->stat->report        = '详细报告';
$lang->stat->client        = '终端';
$lang->stat->device        = '设备类型';
$lang->stat->os            = '操作系统';
$lang->stat->browser       = '用户终端';
$lang->stat->from          = '来源分类';
$lang->stat->keywords      = '关键词统计';
$lang->stat->keyword       = '关键词';
$lang->stat->outSite       = '来源网站统计';
$lang->stat->search        = '搜索引擎';
$lang->stat->domain        = '来路域名';
$lang->stat->click         = '点击排行';
$lang->stat->link          = '链接';
$lang->stat->today         = '今天';
$lang->stat->yestoday      = '昨天';
$lang->stat->pv            = '浏览量(PV)';
$lang->stat->uv            = '访客数(UV)';
$lang->stat->ipCount       = 'IP数';
$lang->stat->totalPV       = '总访问数';
$lang->stat->searchEngine  = '搜索引擎';
$lang->stat->keywordReport = '关键词详细';
$lang->stat->domainList    = '来路域名';
$lang->stat->domainTrend   = '趋势';
$lang->stat->domainPage    = '页面';
$lang->stat->percentage    = '百分比';
$lang->stat->ignoreKeyword = '忽略关键词说明';
$lang->stat->keywordNotice = 'Google和百度取消了来路链接的关键词显示，因此无法统计其关键词信息。';

$lang->stat->all   = '全部';
$lang->stat->begin = '开始日期';
$lang->stat->end   = '结束日期';
$lang->stat->date  = '日期';

$lang->stat->noData    = '没有数据';
$lang->stat->dateError = '时间错误';

$lang->stat->itemList = new stdclass();
$lang->stat->itemList->self    = '直接访问';
$lang->stat->itemList->out     = '外链访问';
$lang->stat->itemList->search  = '搜索引擎';
$lang->stat->itemList->desktop = '桌面设备';
$lang->stat->itemList->mobile  = '移动设备';

$lang->stat->trafficModes = new stdclass();
$lang->stat->trafficModes->yestoday = '昨日';
$lang->stat->trafficModes->today    = '今日';
$lang->stat->trafficModes->weekly   = '最近一周';
$lang->stat->trafficModes->monthly  = '最近30天';

$lang->stat->fromList = new stdclass();
$lang->stat->fromList->self   = '直接访问';
$lang->stat->fromList->out    = '外链';
$lang->stat->fromList->search = '搜索引擎';

$lang->stat->dataTypes = new stdclass();
$lang->stat->dataTypes->pv = '浏览量(PV)';
$lang->stat->dataTypes->uv = '访客数(UV)';
$lang->stat->dataTypes->ip = 'IP数';

$lang->stat->page = new stdclass();
$lang->stat->page->common = '页面访问量';
$lang->stat->page->url    = '页面地址';
