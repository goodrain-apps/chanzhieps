<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->guarder->captchaTags = array();
$config->guarder->captchaTags[] = "<span class='label label-danger'>|</span>";
$config->guarder->captchaTags[] = "<strong class='label label-danger'>|</strong>";
$config->guarder->captchaTags[] = "<i class='label label-danger'>|</i>";
$config->guarder->captchaTags[] = "<em class='label label-danger'>|</em>";

$config->guarder->require = new stdclass();
$config->guarder->require->addblacklist = 'identity';
