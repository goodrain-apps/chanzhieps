<?php if(!defined("RUN_MODE")) die();?>
<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The action module zh-cn file of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     action
 * @version     $Id: zh-cn.php 824 2010-05-02 15:32:06Z wwccss $
 * @link        http://www.chanzhi.net
 */
$lang->score->back        = '返回';
$lang->score->rankingList = '积分排行榜';
$lang->score->rule        = '积分规则';

$lang->score->id      = '编号';
$lang->score->account = '用户';
$lang->score->method  = '方式';
$lang->score->type    = '类型';
$lang->score->count   = '数量';
$lang->score->before  = '之前';
$lang->score->after   = '之后';
$lang->score->amount  = '价格';
$lang->score->note    = '备注';
$lang->score->time    = '时间';
$lang->score->product = '产品';
$lang->score->confirm = '确认订单';
$lang->score->details = '积分详情';

$lang->score->setCounts = '积分规则';

$lang->score->totalRank = '总排行榜';
$lang->score->rank      = '排名';
$lang->score->username  = '用户名';
$lang->score->monthRank = '月排行榜';
$lang->score->weekRank  = '周排行榜';
$lang->score->dayRank   = '日排行榜';

$lang->score->methods['register'] = '注册';
$lang->score->methods['login']    = '登录';
$lang->score->methods['maxLogin'] = '每日登录积分上限';
$lang->score->methods['download'] = '下载';

$lang->score->methods['thread']      = '发贴';
$lang->score->methods['reply']       = '回贴';
$lang->score->methods['valuethread'] = '奖励主题';
$lang->score->methods['valuereply']  = '奖励回复';
$lang->score->methods['delThread']   = '删主题';
$lang->score->methods['delReply']    = '删回复';
$lang->score->methods['award']       = '奖励积分';
$lang->score->methods['punish']      = '扣除积分';

$lang->score->methods['approveSubmittion'] = '投稿成功';

$lang->score->methods['buyscore']  = '购买积分';
$lang->score->methods['statement'] = '积分结算';

$lang->score->methods['vip'] = 'VIP用户';
$lang->score->methods['co']  = '合作伙伴';

$lang->score->types['in']    = '增加';
$lang->score->types['out']   = '减少';

$lang->score->getByThread = '论坛发表主题赚积分'; 
$lang->score->getByReply  = '论坛发表回帖赚积分'; 

$lang->score->lblTotal         = "共有消耗积分：%s, 等级积分：%s ";
$lang->score->lblNoScore       = "抱歉，您的积分不够";
$lang->score->lblNoScoreReason = "抱歉，您的积分不够 %s 需要 <strong class='red'>%s</strong> 分，您现在有 <strong class='red'>%s</strong> 分";
$lang->score->lblDetail        = "详情可参考<a href='http://www.zentao.net/thread-view-79915.html' target='_blank'>《如何获得积分》</a><br /><br />";

$lang->score->setAmount   = '充值金额';
$lang->score->getScore    = '获取积分';
$lang->score->amountUnit  = '元';
$lang->score->minAmount   = '最小充值';
$lang->score->buyWaring   = "最小充值%s元，1元=%s积分";
$lang->score->errorAmount = "充值不能小于%s元";
$lang->score->alipay      = "立即使用支付宝支付";
$lang->score->paySuccess  = '恭喜你，支付成功';
$lang->score->payFail     = '对不起，支付没成功，如果有问题，请联系我们。';
$lang->score->viewHistory = '查看支付历史';
