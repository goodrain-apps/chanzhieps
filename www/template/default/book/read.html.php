<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php js::set('objectType', 'book');?>
<?php js::set('objectID', $article->id);?>
<div class='row blocks' data-region='book_read-top'><?php $this->block->printRegion($layouts, 'book_read', 'top', true);?></div>
<?php $common->printPositionBar($article->origins);?>
<div class='article' id='book' data-id='<?php echo $article->id?>'>
  <header>
    <h2><?php echo $article->title;?></h2>
    <dl class='dl-inline'>
      <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblAddedDate, formatTime($article->addedDate));?>'><i class='icon-time icon-large'></i> <?php echo formatTime($article->addedDate);?></dd>
      <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblAuthor, $article->author);?>'><i class='icon-user icon-large'></i> <?php echo $article->author; ?></dd>
      <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblViews, $article->views);?>'><i class='icon-eye-open'></i> <?php echo $article->views; ?></dd>
      <?php if($article->editor):?>
      <dd data-toggle='tooltip' data-placement='top' ><i class='icon-edit icon-large'></i><?php printf($lang->book->lblEditor, $this->loadModel('user')->getByAccount($article->editor)->realname, formatTime($article->editedDate));?></dd>
      <?php endif;?>
    </dl>
    <?php if($article->summary):?>
    <section class='abstract'><strong><?php echo $lang->book->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
    <?php endif; ?>
  </header>
  <section class='article-content'>
    <?php echo $content;;?>
  </section>
  <section><?php $this->loadModel('file')->printFiles($article->files);?></section>
  <footer>
    <?php if($article->keywords):?>
    <p class='small'><strong class='text-muted'><?php echo $lang->book->keywords;?></strong><span class='article-keywords'><?php echo $lang->colon . $article->keywords;?></span></p>
    <?php endif; ?>
    <?php extract($prevAndNext);?>
    <ul class='pager pager-justify'>
      <?php if($prev): ?>
      <li class='previous'><?php echo html::a(inlink('read', "articleID=$prev->id", "book={$book->alias}&node={$prev->alias}"), "<i class='icon-arrow-left'></i> " . $prev->title); ?></li>
      <?php else: ?>
      <li class='preious disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->book->none); ?></a></li>
      <?php endif; ?>
      <li><?php echo html::a(inlink('browse', "bookID={$parent->id}", "book={$book->alias}&title={$parent->alias}"), "<i class='icon-list-ul'></i> " . $lang->book->chapter);?></li>
      <?php if($next):?>
      <li class='next'><?php echo html::a(inlink('read', "articleID=$next->id", "book={$book->alias}&node={$next->alias}"), $next->title . " <i class='icon-arrow-right'></i>"); ?></li>
      <?php else:?>
      <li class='next disabled'><a href='###'> <?php print($lang->book->none); ?><i class='icon-arrow-right'></i></a></li>
      <?php endif; ?>
    </ul>
  </footer>
</div>
<?php if(commonModel::isAvailable('message')):?>
<div id='commentBox'></div>
<?php endif;?>
<div class='blocks' data-region='book_read-bottom'><?php $this->block->printRegion($layouts, 'book_read', 'bottom');?></div>
<?php include TPL_ROOT . 'common/jplayer.html.php'; ?>
<?php include TPL_ROOT . 'common/footer.html.php'; ?>
