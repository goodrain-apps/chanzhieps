<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The view file of blog view method of chanzhiEPS.
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
$path = !empty($category->pathNames) ? array_keys($category->pathNames) : array();
js::set('path', $path);
js::set('categoryID', $category->id);
js::set('objectType', 'article');
js::set('objectID', $article->id);
if(isset($article->css)) css::internal($article->css);
if(isset($article->js))  js::execute($article->js);
include TPL_ROOT . 'common/treeview.html.php';
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->blog->home) . '</li>';
$common->printPositionBar($category, $article, '', $root);
?>
<div class='row blocks' data-region='blog_view-topBanner'><?php $this->block->printRegion($layouts, 'blog_view', 'topBanner', true);?></div>
<div class='row'>
  <div class='col-md-9 col-main'>
    <div class='row blocks' data-region='blog_view-top'><?php $this->block->printRegion($layouts, 'blog_view', 'top', true);?></div>
    <div class='article' id='blog' data-id='<?php echo $article->id;?>'>
      <header>
        <h1><?php echo $article->title;?></h1>
        <dl class='dl-inline'>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblAddedDate, formatTime($article->addedDate));?>'><i class="icon-time icon-large"></i> <?php echo formatTime($article->addedDate);?></dd>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblAuthor, $article->author);?>'><i class='icon-user icon-large'></i> <?php echo $article->author; ?></dd>
          <?php if($article->source and $article->source != 'original' and $article->copyURL != ''):?>
          <dt><?php echo $lang->article->lblSource; ?></dt>
          <?php if($article->source == 'article') $article->copyURL = $this->loadModel('common')->getSysURL() . $this->article->createPreviewLink($article->copyURL);?>
          <dd><?php $article->copyURL ? print(html::a($article->copyURL, $article->copySite, "target='_blank'")) : print($article->copySite); ?></dd>
          <?php endif; ?>
          <dd class='pull-right'>
            <?php
            if(!empty($this->config->oauth->sina))
            {
                $sina = json_decode($this->config->oauth->sina);
                if($sina->widget) echo "<div class='sina-widget'>" . $sina->widget . '</div>';
            }
            ?>
            <?php if($article->source):?><span class='label label-success'><?php echo $lang->article->sourceList[$article->source]; ?></span><?php endif;?>
            <span class='label label-warning' data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblViews, $article->views);?>'><i class='icon-eye-open'></i> <?php echo $article->views; ?></span>
          </dd>
        </dl>
        <?php if($article->summary):?>
        <section class='abstract'><strong><?php echo $lang->article->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
        <?php endif; ?>
      </header>
      <section class='article-content'>
        <?php echo $article->content;?>
      </section>
      <section>
        <?php $this->loadModel('file')->printFiles($article->files);?>
      </section>
      <footer>
        <?php if($article->keywords):?>
        <p class='small'><strong class='text-muted'><?php echo $lang->article->keywords;?></strong><span class='article-keywords'><?php echo $lang->colon . $article->keywords;?></span></p>
        <?php endif; ?>
        <?php extract($prevAndNext);?>
        <ul class='pager pager-justify'>
          <?php if($prev): ?>
          <li class='previous'><?php echo html::a(inlink('view', "id=$prev->id", "category={$category->alias}&name={$prev->alias}"), '<i class="icon-arrow-left"></i> ' . $prev->title); ?></li>
          <?php else: ?>
          <li class='preious disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->article->none); ?></a></li>
          <?php endif; ?>
          <?php if($next):?>
          <li class='next'><?php echo html::a(inlink('view', "id=$next->id", "category={$category->alias}&name={$next->alias}"), $next->title . ' <i class="icon-arrow-right"></i>'); ?></li>
          <?php else:?>
          <li class='next disabled'><a href='###'> <?php print($lang->article->none); ?><i class='icon-arrow-right'></i></a></li>
          <?php endif; ?>
        </ul>
      </footer>
    </div>
    <?php if(commonModel::isAvailable('message')):?>
    <div id='commentBox'></div>
    <?php endif;?>
    <div class='row blocks' data-region='blog_view-bottom'><?php $this->block->printRegion($layouts, 'blog_view', 'bottom', true);?></div>
  </div>
  <div class='col-md-3 col-side'>
    <side class='page-side'>
      <div class='panel-pure panel'><?php echo html::a(helper::createLink('rss', 'index', '?type=blog', '', 'xml'), "<i class='icon-rss text-warning'></i> " . $lang->blog->subscribe, "target='_blank' class='btn btn-lg btn-block'"); ?></div>
      <div class='blocks' data-region='blog_view-side'><?php $this->block->printRegion($layouts, 'blog_view', 'side');?></div>
    </side>
  </div>
</div>
<div class='row'><?php $this->block->printRegion($layouts, 'blog_view', 'bottomBanner', true);?></div>
<?php if(strpos($article->content, '<embed ') !== false) include TPL_ROOT . 'common/jplayer.html.php'; ?>
<?php include TPL_ROOT . 'blog/footer.html.php';?>
