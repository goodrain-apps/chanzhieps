<?php if(!defined("RUN_MODE")) die();?>
<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot            = $config->webRoot;
$jsRoot             = $webRoot . "js/";
$templateName       = $this->config->template->{$this->device}->name;
$themeName          = $this->config->template->{$this->device}->theme;
$templateRoot       = $webRoot . "template/{$templateName}/";
$templateThemeRoot  = "{$templateRoot}theme/";
$templateCommonRoot = "{$templateThemeRoot}common/";
$thisModuleName     = $this->app->getModuleName();
$thisMethodName     = $this->app->getMethodName();
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><?php echo !empty($title) ? $title : '';?></h5>
    </div>
    <div class='modal-body'>
<?php else:?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>

<div class='block-region region-all-top blocks' data-region='all-top'><?php $this->block->printRegion($layouts, 'all', 'top');?></div>

<?php $topNavs = $this->loadModel('nav')->getNavs('mobile_top');?>
<header class='appbar fix-top' id='appbar'>
  <div class='appbar-title'>
    <a href='<?php echo $webRoot;?>' id='logo'>
      <?php
      $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();
      $logo = isset($logoSetting->$templateName->themes->$themeName) ? $logoSetting->$templateName->themes->$themeName : (isset($logoSetting->$templateName->themes->all) ? $logoSetting->$templateName->themes->all : false);
      if($logo)
      {
          echo html::image($logo->webPath, "class='logo' title='{$this->config->company->name}'");
      }
      else
      {
          echo '<h4>' . $this->config->site->name . '</h4>';
      }
      ?>
    </a>
  </div>
  <div class='appbar-actions'>
    <?php if(commonModel::isAvailable('search')):?>
    <div class='dropdown'>
      <button type='button' class='btn' data-toggle='dropdown' id='searchToggle'><i class='icon-search'></i></button>
      <div class='dropdown-menu fade search-bar' id='searchbar'>
        <form action='<?php echo helper::createLink('search')?>' method='get' role='search'>
          <div class='input-group'>
            <?php $keywords = ($this->app->getModuleName() == 'search') ? $this->session->serachIngWord : '';?>
            <?php echo html::input('words', $keywords, "class='form-control' placeholder=''");?>
            <?php if($this->config->requestType == 'GET') echo html::hidden($this->config->moduleVar, 'search') . html::hidden($this->config->methodVar, 'index');?>
            <div class='input-group-btn'>
              <button class='btn default' type='submit'><i class='icon icon-search'></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php endif; ?>
    <?php if(commonModel::isAvailable('shop')):?>
    <a class='btn with-badge' href='<?php echo $this->createLink('cart', 'browse');?>'><i class='icon icon-shopping-cart'></i><strong class='cart-count badge small text-danger circle hide'>12</strong></a>
    <?php endif; ?>
    <?php
    $isMultiLangAvailable = count(explode(',', $config->site->lang)) > 1;
    $isUserAvailable = commonModel::isAvailable('user');
    ?>
    <?php if($isUserAvailable || $isMultiLangAvailable):?>
    <div class='dropdown'>
      <button type='button' class='btn' data-toggle='dropdown'><i class='icon-bars circle'></i></button>
      <ul class='dropdown-menu dropdown-menu-right'>
        <?php
        if($isUserAvailable) echo commonModel::printTopBar(true);
        if($isUserAvailable && $isMultiLangAvailable) echo "<li class='divider'></li>";
        if($isMultiLangAvailable) echo commonModel::printLanguageBar(true);
        ?>
      </ul>
    </div>
    <?php endif; ?>
  </div>
</header>

<nav class='appnav fix-top appnav-auto' id='appnav' data-ve='navbar' data-type='mobile_top'>
  <div class='mainnav'>
    <ul class='nav'>
    <?php $subnavs = '';?>
    <?php foreach($topNavs as $nav1):?>
      <li class='<?php echo $nav1->class?>'>
      <?php
      if(empty($nav1->children))
      {
          echo html::a($nav1->url, $nav1->title, ($nav1->target != 'modal') ? "target='$nav1->target'" : "data-toggle='modal'");
      }
      else
      {
          echo html::a("#sub-{$nav1->class}", $nav1->title . " <i class='icon-caret-down'></i>", ($nav1->target != 'modal') ? "target='$nav1->target'" : "data-toggle='modal'");
          $subnavs .= "<ul class='nav' id='sub-{$nav1->class}'>\n";
          foreach($nav1->children as $nav2)
          {
              $subnavs .= "<li class='{$nav2->class}'>";
              if(empty($nav2->children))
              {
                  $subnavs .= html::a($nav2->url, $nav2->title, ($nav2->target != 'modal') ? "target='$nav2->target'" : "data-toggle='modal' class='text-important'");
              }
              else
              {
                  $subnavs .= html::a("javascript:;", $nav2->title . " <i class='icon-caret-down'></i>", "data-toggle='dropdown' class='text-important'");
                  $subnavs .= "<ul class='dropdown-menu'>";
                  foreach($nav2->children as $nav3)
                  {
                      $subnavs .= "<li>" . html::a($nav3->url, $nav3->title, ($nav3->target != 'modal') ? "target='$nav3->target'" : "data-toggle='modal' class='text-important'") . '</li>';
                  }
                  $subnavs .= "</ul>\n";
              }
              $subnavs .= "</li>\n";
          }
          $subnavs .= "</ul>\n";
      }
      ?>
      </li>
    <?php endforeach;?><!-- end nav1 -->
    </ul>
  </div>
  <div class='subnavs fade'>
    <?php echo $subnavs;?>
  </div>
</nav>

<div class='block-region region-all-banner blocks' data-region='all-banner'>
  <?php $this->block->printRegion($layouts, 'all', 'banner');?>
</div>
<?php endif;?>
