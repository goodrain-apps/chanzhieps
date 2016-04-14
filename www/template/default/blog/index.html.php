<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The index view file of blog module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'blog/header.html.php';
include TPL_ROOT . 'common/treeview.html.php';
if(isset($category)) $path = array_keys($category->pathNames);
if(!empty($path))         js::set('path',  $path);
if(!empty($category->id)) js::set('categoryID', $category->id);
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->blog->home) . '</li>';
if(!empty($category)) echo $common->printPositionBar($category, '', '', $root);
?>
<div class='row blocks' data-region='blog_index-topBanner'><?php $this->block->printRegion($layouts, 'blog_index', 'topBanner', true);?></div>
<div class='row'>
  <div class='col-md-9 col-main'>
    <div class='row blocks' data-region='blog_index-top'><?php $this->block->printRegion($layouts, 'blog_index', 'top', true);?></div>
    <div id='blogList'>
      <?php foreach($sticks as $stick):?>
      <?php if(!isset($category)) $category = array_shift($stick->categories);?>
        <?php $url = inlink('view', "id=$stick->id", "category={$category->alias}&name=$stick->alias"); ?>
        <div class="card" data-ve='blog' id='blog<?php echo $stick->id;?>'>
          <h4 class='card-heading'>
            <?php echo html::a($url, $stick->title);?>
            <span class='label label-danger'><?php echo $lang->article->stick;?></span>
          </h4>
          <div class='card-content text-muted'>
            <?php if(!empty($stick->image)):?>
              <div class='media pull-right'>
                <?php
                $title = $stick->image->primary->title ? $stick->image->primary->title : $stick->title;
                echo html::a($url, html::image($stick->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
                ?>
              </div>
            <?php endif;?>
            <?php echo $stick->summary;?>
          </div>
          <div class="card-actions text-muted">
            <span data-toggle='tooltip' title='<?php printf($lang->article->lblAddedDate, formatTime($stick->addedDate));?>'><i class="icon-time"></i> <?php echo date('Y/m/d', strtotime($stick->addedDate));?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblAuthor, $stick->author);?>'><i class="icon-user"></i> <?php echo $stick->author;?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblViews, $stick->views);?>'><i class="icon-eye-open"></i> <?php echo $stick->views;?></span>
            <?php if($stick->comments):?>&nbsp; <a href="<?php echo $url . '#commentForm'?>"><span data-toggle='tooltip' title='<?php printf($lang->article->lblComments, $stick->comments);?>'><i class="icon-comments-alt"></i> <?php echo $stick->comments;?></span></a><?php endif;?>
          </div>
        </div>
      <?php unset($articles[$stick->id]);?>
      <?php endforeach;?>
      <?php foreach($articles as $article):?>
      <?php if(!isset($category)) $category = array_shift($article->categories);?>
        <?php $url = inlink('view', "id=$article->id", "category={$category->alias}&name=$article->alias"); ?>
        <div class="card" data-ve='blog' id='blog<?php echo $article->id;?>'>
          <h4 class='card-heading'><?php echo html::a($url, $article->title);?></h4>
          <div class='card-content text-muted'>
            <?php if(!empty($article->image)):?>
              <div class='media pull-right'>
                <?php
                $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
                echo html::a($url, html::image($article->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
                ?>
              </div>
            <?php endif;?>
            <?php echo $article->summary;?>
          </div>
          <div class="card-actions text-muted">
            <span data-toggle='tooltip' title='<?php printf($lang->article->lblAddedDate, formatTime($article->addedDate));?>'><i class="icon-time"></i> <?php echo date('Y/m/d', strtotime($article->addedDate));?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblAuthor, $article->author);?>'><i class="icon-user"></i> <?php echo $article->author;?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblViews, $article->views);?>'><i class="icon-eye-open"></i> <?php echo $article->views;?></span>
            <?php if($article->comments):?>&nbsp; <a href="<?php echo $url . '#commentForm'?>"><span data-toggle='tooltip' title='<?php printf($lang->article->lblComments, $article->comments);?>'><i class="icon-comments-alt"></i> <?php echo $article->comments;?></span></a><?php endif;?>
          </div>
        </div>
      <?php endforeach;?>
      <div class='clearfix pager'><?php $pager->show('right', 'short');?></div>
    </div>
    <div class='row blocks' data-region='blog_index-bottom'><?php $this->block->printRegion($layouts, 'blog_index', 'bottom', true);?></div>
  </div>
  <div class='col-md-3 col-side'>
    <side class='page-side'>
      <div class='panel-pure panel'><?php echo html::a(helper::createLink('rss', 'index', '?type=blog', '', 'xml'), "<i class='icon-rss text-warning'></i> " . $lang->blog->subscribe, "target='_blank' class='btn btn-lg btn-block'"); ?></div>
      <div class='blocks' data-region='blog_index-side'><?php $this->block->printRegion($layouts, 'blog_index', 'side');?></div>
    </side>
  </div>
</div>
<div class='row'><?php $this->block->printRegion($layouts, 'blog_index', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'blog/footer.html.php';?>
