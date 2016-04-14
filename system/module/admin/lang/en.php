<?php if(!defined("RUN_MODE")) die();?>
<?php 
$lang->admin->common        = 'Admin';
$lang->admin->index         = 'Index';
$lang->admin->ignore        = 'Ignore safety warning';
$lang->admin->ignoreupgrade = 'Ignore upgrade prompt';

$lang->admin->shortcuts = new stdclass();
$lang->admin->shortcuts->common             = 'Quick Entry';
$lang->admin->shortcuts->articleCategories  = 'Article Categories';
$lang->admin->shortcuts->article            = 'Article';
$lang->admin->shortcuts->product            = 'Product';
$lang->admin->shortcuts->feedback           = 'Feedback';
$lang->admin->shortcuts->site               = 'Site';
$lang->admin->shortcuts->logo               = 'Logo';
$lang->admin->shortcuts->company            = 'Company';
$lang->admin->shortcuts->contact            = 'Contact';

$lang->admin->thread       = 'New Threads';
$lang->admin->order        = 'New orders';
$lang->admin->feedback     = 'New Feedback';

$lang->admin->adminEntry     = "Warning: Your management portal is still admin.php, please rename it to enhance system security.";
$lang->admin->orderTitle     = 'User %s created a %s order';
$lang->admin->message        = 'There are %s messages awaiting moderation';
$lang->admin->reply          = 'There are %s replies awaiting moderation';
$lang->admin->comment        = 'There are %s comments awaiting moderation';
$lang->admin->threadReply    = 'There are %s replies to your thread today';
$lang->admin->submittion     = 'There are %s submittion awaiting moderation today';
$lang->admin->todayReport    = 'Today this site has %s PV,  %s UV , %s IP';
$lang->admin->yestodayReport = 'Yestoday this site has %s PV,  %s UV , %s IP';
