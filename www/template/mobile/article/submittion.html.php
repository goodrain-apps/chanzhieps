<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'user/side.html.php';?>
<div class='panel-section'>
  <div class='panel-heading'>
    <button type='button' class='btn primary block' data-toggle='modal' data-remote="<?php echo inlink('post');?>"><i class='icon-plus'></i> <?php echo $lang->article->post;?></button>
  </div>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-envolope-alt'></i> <?php echo $lang->user->submittion;?></div>
  </div>
  <div class='cards condensed cards-list'>
    <?php foreach($articles as $article):?>
    <div class='card' id="article<?php echo $article->id?>" data-ve='article'>
      <div class='card-heading'>
        <div class='pull-right'>
          <small class='bg-danger-pale text-danger'><?php echo $lang->submittion->status[$article->submittion];?></small>
        </div>
        <h5>
          <?php 
          if($article->submittion == 2) echo html::a($this->article->createPreviewLink($article->id), $article->title, "target='_blank'");
          if($article->submittion != 2) echo $article->title;
          ?>
        </h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'>
            <div>
              <span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $article->views;?></span>
              &nbsp;&nbsp; <span title="<?php echo $lang->article->submissionTime;?>"><i class='icon-time'></i> <?php echo $article->editedDate;?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'><?php $pager->show('justify');?></div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
