<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The blog index view file for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'blog/header.html.php';?>
<div class='block-region region-top blocks' data-region='blog_index-top'><?php $this->loadModel('block')->printRegion($layouts, 'blog_index', 'top');?></div>
<hr class='space'>
<div class='panel panel-section'>
  <div class='cards condensed cards-list bordered' id='blogList'>
    <?php foreach($sticks as $stick):?>
    <?php if(!isset($category)) $category = array_shift($stick->categories);?>
    <?php $url = inlink('view', "id=$stick->id", "category={$category->alias}&name=$stick->alias"); ?>
    <a class='card' href='<?php echo $url?>' id="blog<?php echo $stick->id?>" data-ve='blog'>
      <div class='card-heading'>
        <div class='pull-right'>
          <small class='bg-danger-pale text-danger'><?php echo $lang->article->stick;?></small>
        </div>
        <h5><?php echo $stick->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'>
            <?php echo $stick->summary;?>
            <div><span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $stick->views;?></span>
                <?php if($stick->comments):?>&nbsp;&nbsp; <span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $stick->comments;?></span> &nbsp;<?php endif;?>
                &nbsp;&nbsp; <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($stick->addedDate, 0, 10);?></span></div>
          </div>
        </div>
        <?php if(!empty($stick->image)):?>
        <div class='table-cell thumbnail-cell'>
        <?php
          $title = $stick->image->primary->title ? $stick->image->primary->title : $stick->title;
          echo html::image($stick->image->primary->smallURL, "title='{$title}' class='thumbnail'" );
        ?>
        </div>
        <?php endif;?>
      </div>
    </a>
    <?php unset($articles[$stick->id]);?>
    <?php endforeach;?>

    <?php foreach($articles as $article):?>
    <?php if(!isset($category)) $category = array_shift($article->categories);?>
    <?php $url = inlink('view', "id=$article->id", "category={$category->alias}&name=$article->alias"); ?>
    <a class='card' href='<?php echo $url?>' id="blog<?php echo $article->id?>" data-ve='blog'>
      <div class='card-heading'>
        <h5><?php echo $article->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'>
            <?php echo $article->summary;?>
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

<div class='block-region region-bottom blocks' data-region='blog_index-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'blog_index', 'bottom');?></div>
<?php include TPL_ROOT . 'blog/footer.html.php';?>
