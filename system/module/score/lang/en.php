<?php if(!defined("RUN_MODE")) die();?>
<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The action module English file of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     action
 * @version     $Id$
 * @link        http://www.chanzhi.net
 */
$lang->score->back        = 'Back';
$lang->score->rankingList = 'Score Ranking';
$lang->score->rule        = 'Score Rule';

$lang->score->id      = 'ID';
$lang->score->account = 'Account';
$lang->score->method  = 'Method';
$lang->score->type    = 'Type';
$lang->score->count   = 'Count';
$lang->score->before  = 'Before';
$lang->score->after   = 'After';
$lang->score->amount  = 'Amount';
$lang->score->note    = 'Note';
$lang->score->time    = 'Time';
$lang->score->product = 'Product';
$lang->score->confirm = 'Confirm order';
$lang->score->details = 'Score details';

$lang->score->setCounts = 'Set score rule';

$lang->score->totalRank = 'Total rank';
$lang->score->rank      = 'Rank';
$lang->score->username  = 'Username';
$lang->score->monthRank = 'Month rank';
$lang->score->weekRank  = 'Weekly rank';
$lang->score->dayRank   = 'Daily rank';

$lang->score->methods['register']     = 'Register';
$lang->score->methods['login']        = 'Login';
$lang->score->methods['maxLogin']     = 'Max Scores of Daily Loging';
$lang->score->methods['download']     = 'Download';

$lang->score->methods['thread']      = 'Thread';
$lang->score->methods['reply']       = 'Reply';
$lang->score->methods['valuethread'] = 'Valueable thread';
$lang->score->methods['valuereply']  = 'Valueable reply';
$lang->score->methods['delThread']   = 'Delete thread';
$lang->score->methods['delReply']    = 'Delete reply';
$lang->score->methods['award']       = 'Reward Scores';
$lang->score->methods['punish']      = 'Deduct Scores';

$lang->score->methods['approveSubmittion'] = 'Submittion Successfully';

$lang->score->methods['buyscore']  = 'Buy score';
$lang->score->methods['statement'] = 'Integral Settlement';

$lang->score->methods['vip'] = 'VIP';
$lang->score->methods['co']  = 'Partner';

$lang->score->types['in']  = 'Increase';
$lang->score->types['out'] = 'Decreate';

$lang->score->getByThread = 'Published Thread'; 
$lang->score->getByReply  = 'Replied Thread'; 

$lang->score->lblTotal         = "Consume score：%s, Rank score: %s ";
$lang->score->lblNoScore       = "Sorry, your score isn't enouth.";
$lang->score->lblNoScoreReason = "<p>Sorry, your scores is not enough.<strong>%s</strong> need <strong class='red'>%s</strong>scores，now you have <strong class='red'>%s</strong> scores.</p>";
$lang->score->lblDetail        = "You can refer to <a href='http://www.chanzhi.net/thread-view-79915.html' target='_blank'>\"how to get scores\"</a><br /><br />";

$lang->score->setAmount   = 'Amount';
$lang->score->getScore    = 'Get scores';
$lang->score->amountUnit  = 'yuan';
$lang->score->minAmount   = 'Minimum Amount';
$lang->score->buyWaring   = "at least %s yuan,1 yuan = %s scores";
$lang->score->errorAmount = "At least %s yuan";
$lang->score->alipay      = "Immediately use Alipay";
$lang->score->paySuccess  = 'Congratulations, paid successfully!';
$lang->score->payFail     = 'Sorry, paid failed. If you have problems, please contact us.';
$lang->score->viewHistory = 'View payment history';
