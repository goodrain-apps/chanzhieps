<?php if(!defined("RUN_MODE")) die();?>
<?php $topNavs = $this->loadModel('nav')->getNavs('desktop_top');?>
<nav id='navbar' class='navbar' data-type='desktop_top' data-ve='block' data-id='<?php echo $block->id; ?>'>
  <div class='navbar-header'>
    <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbarCollapse'>
      <span class='icon-bar'></span>
      <span class='icon-bar'></span>
      <span class='icon-bar'></span>
    </button>
    <a class='navbar-brand' href='<?php echo helper::createLink('index');?>'><i class='icon-home'></i></a>
  </div>
  <div class='collapse navbar-collapse' id='navbarCollapse' data-ve='navbar'>
    <ul class='nav navbar-nav'>
      <?php $navCount = count($topNavs);?>
      <?php $i =0;?>
      <?php foreach($topNavs as $nav1):?>
        <?php if(empty($nav1->children)):?>
          <li class='<?php echo $nav1->class?>'><?php echo html::a($nav1->url, $nav1->title, "target='$nav1->target'");?></li>
          <?php else: ?>
            <li class="dropdown <?php echo $nav1->class?>">
              <?php echo html::a($nav1->url, $nav1->title . " <b class='caret'></b>", 'class="dropdown-toggle" data-toggle="dropdown"');?>
              <ul class='dropdown-menu' role='menu'>
                <?php foreach($nav1->children as $nav2):?>
                  <?php if(empty($nav2->children)):?>
                    <li class='<?php echo $nav2->class?>'><?php echo html::a($nav2->url, $nav2->title, "target='$nav2->target'");?></li>
                  <?php else: ?>
                  <li class="dropdown-submenu <?php echo $nav2->class?> <?php if($i == $navCount -1) echo 'pull-left'?>">
                      <?php echo html::a($nav2->url, $nav2->title, ($nav2->target != 'modal') ? "target='$nav2->target'" : '');?>
                      <ul class='dropdown-menu' role='menu'>
                        <?php foreach($nav2->children as $nav3):?>
                        <li><?php echo html::a($nav3->url, $nav3->title, ($nav3->target != 'modal') ? "target='$nav3->target'" : '');?></li>
                        <?php endforeach;?>
                      </ul>
                    </li>
                  <?php endif;?>
                <?php endforeach;?><!-- end nav2 -->
              </ul>
          </li>
        <?php endif;?>
        <?php $i++; ?>
      <?php endforeach;?><!-- end nav1 -->
      <?php if(!$setting->compatible && $setting->searchbar == 'insideNav'):?>
      <li class='nav-item-searchbar'><?php include "searchbar.html.php";?></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

