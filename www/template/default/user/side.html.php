<?php if(!defined("RUN_MODE")) die();?>
<style>
ul.user-control-nav > li > a{ padding:8px 18px;}
ul.user-control-nav > li.nav-icon > a{border-top:none; border-bottom:dashed 1px #ddd;}
ul.user-control-nav > li.nav-icon.active > a{border-bottom:none}
ul.user-control-nav > li.nav-icon:last-child > a{ border-bottom:1px solid #DDD;}
</style>
<?php $this->loadModel('user')->fixMenus();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<div class='col-md-2'>
  <ul class='nav nav-primary nav-stacked user-control-nav'>
    <?php foreach($this->config->user->navGroups as $group => $items):?>
    <?php if(isset($lang->user->navGroups->$group)):?>
    <li class='nav-heading'> <?php echo $lang->user->navGroups->$group;?></li>
    <?php endif;?>
    <?php $navs = explode(',', $items);?>
    <?php foreach($navs as $nav)
    {
        $class = '';
        $menu = zget($lang->user->control->menus, $nav, '');
        if(empty($menu)) continue;
        list($label, $module, $method) = explode('|', $menu);
        $module = strtolower($module);
        $method = strtolower($method);
        $menuInfo = explode('|', $menu);
        $params   = zget($menuInfo, 3 ,''); 
        if(!commonModel::isAvailable($module)) continue;
        if($module == $this->app->getModuleName() && $method == $this->app->getMethodName()) $class .= 'active';
        echo '<li class="nav-icon ' . $class . '">' . html::a($this->createLink($module, $method, $params), $label) . '</li>';
    }
    ?>
    <?php endforeach;?>
  </ul>
</div>
