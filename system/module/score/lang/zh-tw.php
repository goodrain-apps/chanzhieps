<?php if(!defined("RUN_MODE")) die();?>
<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The action module zh-tw file of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     action
 * @version     $Id: zh-tw.php 824 2010-05-02 15:32:06Z wwccss $
 * @link        http://www.chanzhi.net
 */
$lang->score->back        = '返回';
$lang->score->rankingList = '積分排行榜';
$lang->score->rule        = '積分規則';

$lang->score->id      = '編號';
$lang->score->account = '用戶';
$lang->score->method  = '方式';
$lang->score->type    = '類型';
$lang->score->count   = '數量';
$lang->score->before  = '之前';
$lang->score->after   = '之後';
$lang->score->amount  = '價格';
$lang->score->note    = '備註';
$lang->score->time    = '時間';
$lang->score->product = '產品';
$lang->score->confirm = '確認訂單';
$lang->score->details = '積分詳情';

$lang->score->setCounts = '積分規則';

$lang->score->totalRank = '總排行榜';
$lang->score->rank      = '排名';
$lang->score->username  = '用戶名';
$lang->score->monthRank = '月排行榜';
$lang->score->weekRank  = '周排行榜';
$lang->score->dayRank   = '日排行榜';

$lang->score->methods['register'] = '註冊';
$lang->score->methods['login']    = '登錄';
$lang->score->methods['maxLogin'] = '每日登錄獲得積分上限';
$lang->score->methods['download'] = '下載';

$lang->score->methods['thread']      = '發貼';
$lang->score->methods['reply']       = '回貼';
$lang->score->methods['valuethread'] = '獎勵主題';
$lang->score->methods['valuereply']  = '獎勵回覆';
$lang->score->methods['delThread']   = '刪主題';
$lang->score->methods['delReply']    = '刪回覆';
$lang->score->methods['award']       = '獎勵積分';
$lang->score->methods['punish']      = '扣除積分';

$lang->score->methods['approveContribution'] = '投稿成功';

$lang->score->methods['buyscore']  = '購買積分';
$lang->score->methods['statement'] = '積分結算';

$lang->score->methods['vip'] = 'VIP用戶';
$lang->score->methods['co']  = '合作夥伴';

$lang->score->types['in']    = '增加';
$lang->score->types['out']   = '減少';

$lang->score->getByThread = '論壇發表主題賺積分'; 
$lang->score->getByReply  = '論壇發表回帖賺積分'; 

$lang->score->lblTotal         = "共有消耗積分：%s, 等級積分：%s ";
$lang->score->lblNoScore       = "抱歉，您的積分不夠";
$lang->score->lblNoScoreReason = "抱歉，您的積分不夠 %s 需要 <strong class='red'>%s</strong> 分，您現在有 <strong class='red'>%s</strong> 分";
$lang->score->lblDetail        = "詳情可參考<a href='http://www.zentao.net/thread-view-79915.html' target='_blank'>《如何獲得積分》</a><br /><br />";

$lang->score->setAmount   = '充值金額';
$lang->score->getScore    = '獲取積分';
$lang->score->amountUnit  = '元';
$lang->score->minAmount   = '最小充值';
$lang->score->buyWaring   = "最小充值%s元，1元=%s積分";
$lang->score->errorAmount = "充值不能小於%s元";
$lang->score->alipay      = "立即使用支付寶支付";
$lang->score->paySuccess  = '恭喜你，支付成功';
$lang->score->payFail     = '對不起，支付沒成功，如果有問題，請聯繫我們。';
$lang->score->viewHistory = '查看支付歷史';
