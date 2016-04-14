<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The header view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<header id='header' data-ve='block' data-id='<?php echo $block->id;?>' class='<?php if($setting->nav == 'row') echo 'without-navbar'; ?>'>
  <div id='headNav' class='<?php if($setting->slogan == 'topLeft') echo 'with-slogan' ?><?php if($setting->searchbar == 'topRight') echo ' with-searchbar' ?>'>
    <div class='row'>
      <?php if($setting->slogan == 'topLeft'):?>
      <div id='siteSlogan' class='nobr'><span><?php echo $this->config->site->slogan;?></span></div>
      <?php endif;?>
      <nav id='siteNav'>
        <?php echo commonModel::printTopBar();?>
        <?php commonModel::printLanguageBar();?>
      </nav>
      <?php if($setting->searchbar == 'topRight') include 'searchbar.html.php';?>
    </div>
  </div>
  <div id='headTitle' class='<?php if($setting->nav == 'besideLogo') echo 'with-navbar' ?><?php if($setting->slogan == 'besideLogo') echo ' with-slogan' ?>'>
    <div class='row'>
      <div id='siteTitle'>
        <?php if($logo):?>
        <div id='siteLogo' data-ve='logo'><?php echo html::a($this->config->webRoot, html::image($logo->webPath, "class='logo' title='{$this->config->company->name}'"));?></div>
        <?php else: ?>
        <div id='siteName' data-ve='logo'><h2><?php echo html::a($this->config->webRoot, $this->config->site->name);?></h2></div>
        <?php endif;?>
        <?php if($setting->slogan == 'besideLogo'):?>
        <div id='siteSlogan' data-ve='slogan'><span><?php echo $this->config->site->slogan;?></span></div>
        <?php endif;?>
      </div>
      <?php if($setting->nav == 'besideLogo'):?>
      <div id='navbarWrapper'><?php include 'nav.html.php' ?></div>
      <?php endif; ?>
      <?php if($setting->searchbar == 'besideSlogan') include 'searchbar.html.php';?>
    </div>
  </div>
</header>
<?php if($setting->nav == 'row') include 'nav.html.php';?>
<style>
#header {padding: 0; margin-bottom: 14px;}
#headNav {min-height: 30px; line-height: 30px; padding: 0; margin-bottom: 8px;}
#headNav, #headTitle {position: static; display: block;}
#headNav > .row {margin: 0}
#headTitle > .row, #headNav > .row {display: table; width: 100%; margin: 0}
#headNav > .row > #siteNav,
#headNav > .row > #siteSlogan,
#headNav > .row > #searchbar,
#headTitle > .row > #siteTitle,
#headTitle > .row > #searchbar {display: table-cell; vertical-align: middle;}

#headTitle {padding: 0;}
#siteNav {text-align: right;}
@media (max-width: 767px){#siteNav {padding-left: 8px; padding-right: 8px;}}

#searchbar {max-width: initial;}
#searchbar > form {max-width: 260px; float: right;}
#navbar .navbar-nav {width: 100%}
#navbarCollapse {padding: 0;}
#navbar .navbar-nav {margin: 0;}
#navbar li.nav-item-searchbar {float: right;}
#navbar li.nav-item-searchbar #searchbar > form {margin: 4px;}
<?php if($setting->searchbar == 'topRight'):?>
#searchbar {padding-left: 10px; width: 260px;}
#searchbar > form {max-width: 100%; float: none; margin: 4px 0}
@media (max-width: 767px){#headNav > .row > #searchbar {display: none}}
<?php endif;?>

<?php if($setting->slogan == 'topLeft'):?>
#headNav #siteSlogan {padding: 0; font-size: 16px; line-height: 30px; text-align: left;}
@media (max-width: 767px){#headNav #siteSlogan {padding-left: 8px; padding-right: 8px;}}
<?php endif;?>

<?php if($setting->nav == 'besideLogo'):?>
#headTitle > .row > #navbarWrapper {display: table-cell; vertical-align: middle; padding-left: 8px;}
#headTitle > .row > #navbarWrapper > #navbar {margin:0}
#siteLogo img {min-width: 150px;}
@media (max-width: 767px)
{
  #headTitle {padding: 0;}
  #headTitle > .row {margin: 0; display: block;}
  #headTitle > .row > #siteTitle {display: block; position: absolute; z-index: 10015; left: 8px;}
  #headTitle > .row > #navbarWrapper {display: block; padding: 0}
  #headTitle > .row > #navbarWrapper > #navbar {margin-bottom: 14px; width: 100%}
  #headTitle #siteLogo img {margin-top: 2px;}*/
<?php endif;?>
</style>
