<?php if(!defined("RUN_MODE")) die();?>
<style>
.user-control-nav {padding: 0 7px 4px; border-bottom: 1px solid #e5e5e5; margin-top: 10px; margin-bottom: 10px;}
.user-control-nav > li {float: left; margin: 0 3px 6px;}
.user-control-nav > li > a {float: left; border: 1px solid #f1f1f1; border-radius: 2px; min-width: 100px;}
.user-control-nav > li.active > a {background-color: #ebf2f9; color: #3280fc; border-color: #3280fc;}
.user-control-nav > li > a > .icon-chevron-right {display: none}
.user-control-nav > li > a > [class*='icon-'] {color: #666;}
.user-control-nav > li.active > a > [class*='icon-'] {color: #3280fc;}
</style>
<ul class='nav user-control-nav clearfix'>
<?php if($thisMethodName !== 'control'): ?>
  <li><?php echo html::a($this->createLink('user', 'control'), "<i class='icon-th-large'></i> " . $lang->user->control->common, "class='btn default'"); ?></li>
<?php endif; ?>
<?php
ksort($lang->user->control->menus);
foreach($lang->user->control->menus as $menu)
{
    $class = '';
    list($label, $module, $method) = explode('|', $menu);

    if(in_array($method, array('thread', 'reply')) && !commonModel::isAvailable('forum')) continue;

    if($module == $this->app->getModuleName() && $method == $this->app->getMethodName()) $class .= 'active';

    echo '<li class="' . $class . '">' . html::a($this->createLink($module, $method), $label, "class='btn default'") . '</li>';
}
?>
</ul>
