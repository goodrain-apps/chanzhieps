<?php
$config->guarder = new stdclass();

$config->guarder->limits = new stdclass();

$config->guarder->limits->account = new stdclass;
$config->guarder->limits->account->interval = new stdclass;
$config->guarder->limits->account->day    = new stdclass;

$config->guarder->limits->ip = new stdclass;
$config->guarder->limits->ip->interval = new stdclass;
$config->guarder->limits->ip->day      = new stdclass;

$config->guarder->limits->ip->interval->register        = 10;
$config->guarder->limits->ip->interval->resetPassword   = 10;
$config->guarder->limits->ip->interval->resetPWDFailure = 10;
$config->guarder->limits->ip->interval->logonFailure    = 10;
$config->guarder->limits->ip->interval->post            = 10;
$config->guarder->limits->ip->interval->postThread      = 3;
$config->guarder->limits->ip->interval->postReply       = 5;
$config->guarder->limits->ip->interval->postComment     = 3;
$config->guarder->limits->ip->interval->error404        = 10;
$config->guarder->limits->ip->interval->search          = 10;
$config->guarder->limits->ip->interval->captchaFail     = 5;

$config->guarder->limits->ip->day->register        = 30;
$config->guarder->limits->ip->day->resetPassword   = 30;
$config->guarder->limits->ip->day->resetPWDFailure = 30;
$config->guarder->limits->ip->day->logonFailure    = 30;
$config->guarder->limits->ip->day->post            = 30;
$config->guarder->limits->ip->day->postThread      = 5;
$config->guarder->limits->ip->day->postReply       = 10;
$config->guarder->limits->ip->day->postComment     = 5;
$config->guarder->limits->ip->day->error404        = 100;
$config->guarder->limits->ip->day->search          = 100;
$config->guarder->limits->ip->day->captchaFail     = 20;

$config->guarder->limits->account = $config->guarder->limits->ip;

$config->guarder->interval = new stdclass();
$config->guarder->interval->ip      = new stdclass;
$config->guarder->interval->account = new stdclass;

$config->guarder->interval->ip->register        = 3;
$config->guarder->interval->ip->resetPassword   = 3;
$config->guarder->interval->ip->resetPWDFailure = 3;
$config->guarder->interval->ip->logonFailure    = 3;
$config->guarder->interval->ip->post            = 10;
$config->guarder->interval->ip->postThread      = 10;
$config->guarder->interval->ip->postComment     = 10;
$config->guarder->interval->ip->postReply       = 10;
$config->guarder->interval->ip->error404        = 1;
$config->guarder->interval->ip->search          = 1;
$config->guarder->interval->ip->captchaFail     = 1;

$config->guarder->interval->account = $config->guarder->interval->ip;


$config->guarder->punishment = new stdclass();

$config->guarder->punishment->account = new stdclass;
$config->guarder->punishment->account->minute = new stdclass;
$config->guarder->punishment->account->day    = new stdclass;

$config->guarder->punishment->ip = new stdclass;
$config->guarder->punishment->ip->interval = new stdclass;
$config->guarder->punishment->ip->day      = new stdclass;

$config->guarder->punishment->ip->interval->register        = 10;
$config->guarder->punishment->ip->interval->resetPassword   = 10;
$config->guarder->punishment->ip->interval->resetPWDFailure = 10;
$config->guarder->punishment->ip->interval->logonFailure    = 10;
$config->guarder->punishment->ip->interval->post            = 60;
$config->guarder->punishment->ip->interval->postThread      = 60;
$config->guarder->punishment->ip->interval->postReply       = 30;
$config->guarder->punishment->ip->interval->postComment     = 30;
$config->guarder->punishment->ip->interval->error404        = 10;
$config->guarder->punishment->ip->interval->search          = 5;
$config->guarder->punishment->ip->interval->captchaFail     = 30;

$config->guarder->punishment->ip->day->register        = 10;
$config->guarder->punishment->ip->day->resetPassword   = 10;
$config->guarder->punishment->ip->day->resetPWDFailure = 10;
$config->guarder->punishment->ip->day->logonFailure    = 10;
$config->guarder->punishment->ip->day->post            = 60;
$config->guarder->punishment->ip->day->postThread      = 60;
$config->guarder->punishment->ip->day->postReply       = 60;
$config->guarder->punishment->ip->day->postComment     = 60;
$config->guarder->punishment->ip->day->error404        = 10;
$config->guarder->punishment->ip->day->search          = 5;
$config->guarder->punishment->ip->day->captchaFail     = 30;

$config->guarder->punishment->account = new stdclass();
$config->guarder->punishment->account->interval = new  stdclass();
$config->guarder->punishment->account->day      = new  stdclass();

$config->guarder->punishment->account->interval->resetPassword   = 10;
$config->guarder->punishment->account->interval->resetPWDFailure = 10;
$config->guarder->punishment->account->interval->logonFailure    = 10;
$config->guarder->punishment->account->interval->post            = 60;
$config->guarder->punishment->account->interval->postThread      = 60;
$config->guarder->punishment->account->interval->postReply       = 30;
$config->guarder->punishment->account->interval->postComment     = 30;
$config->guarder->punishment->account->interval->error404        = 5;
$config->guarder->punishment->account->interval->search          = 5;
$config->guarder->punishment->account->interval->captchaFail     = 30;

$config->guarder->punishment->account->day->register        = 10;
$config->guarder->punishment->account->day->resetPassword   = 10;
$config->guarder->punishment->account->day->resetPWDFailure = 10;
$config->guarder->punishment->account->day->logonFailure    = 10;
$config->guarder->punishment->account->day->post            = 60;
$config->guarder->punishment->account->day->postThread      = 60;
$config->guarder->punishment->account->day->postReply       = 60;
$config->guarder->punishment->account->day->postComment     = 60;
$config->guarder->punishment->account->day->error404        = 5;
$config->guarder->punishment->account->day->search          = 5;
$config->guarder->punishment->account->day->captchaFail     = 30;
