<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of article for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php
$path = array_keys($category->pathNames);
js::set('path', $path);
js::set('categoryID', $category->id);
?>
<div class='block-region blocks region-top' data-region='article_browse-top'><?php $this->loadModel('block')->printRegion($layouts, 'article_browse', 'top');?></div>
<div class='panel panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><strong><?php echo $category->name;?></strong></div>
  </div>
  <div class='cards condensed cards-list bordered' id='articles'>
    <?php foreach($articles as $article):?>
    <?php $url = inlink('view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");?>
    <a class='card' href='<?php echo $url?>' id="article<?php echo $article->id?>" data-ve='article'>
      <div class='card-heading'>
        <?php if($article->sticky):?>
        <div class='pull-right'>
          <small class='bg-danger-pale text-danger'><?php echo $lang->article->stick;?></small>
        </div>
        <?php endif;?>
        <h5><?php echo $article->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'>
              <?php echo helper::substr($article->summary, 40, '...');?>
              <div><span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $article->views;?></span>
                <?php if($article->comments):?>&nbsp;&nbsp; <span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $article->comments;?></span> &nbsp;<?php endif;?>
                &nbsp;&nbsp; <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($article->addedDate, 0, 10);?></span></div>
          </div>

        </div>
        <?php if(!empty($article->image)):?>
        <div class='table-cell thumbnail-cell'>
        <?php
          $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
          echo html::image($article->image->primary->smallURL, "title='{$title}' class='thumbnail'" );
        ?>
        </div>
        <?php endif;?>
      </div>
    </a>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>

<div class='block-region blocks region-bottom' data-region='article_browse-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'article_browse', 'bottom');?></div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
