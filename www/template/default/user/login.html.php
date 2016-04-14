<?php if(!defined("RUN_MODE")) die();?>
<?php
if(RUN_MODE == 'front')
{
    if(isset($this->config->site->front) and $this->config->site->front == 'login')
    {
        include TPL_ROOT . 'user/login.admin.html.php';
    }
    else
    {
        include  TPL_ROOT . 'user/login.front.html.php';
    }
}
else
{
    include TPL_ROOT . 'user/login.admin.html.php';
}
