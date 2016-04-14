<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php $common->printPositionBar('rankingList')?>
<div class='row'>
  <div class='col-md-3'>
    <div class='panel'>
	  <div class='panel-heading'><?php echo $lang->score->totalRank;?></div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span><?php echo $lang->score->rank;?></span><?php echo $lang->score->username;?></strong></dt>
		  <dd class='strong'><?php echo $lang->score->common;?></dd>
          <?php $i = 1;?>
          <?php foreach($allScore as $ranking):?>
          <?php if($ranking->account == 'guest') continue;?>
          <dt>
            <span class='strong'>Top<?php echo $i?></span>
            <?php
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
            ?>
          </dt>
          <dd><?php echo $ranking->score?></dd>
          <?php $i++;?>
          <?php endforeach;?>
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'><?php echo $lang->score->monthRank;?></div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span><?php echo $lang->score->rank;?></span><?php echo $lang->score->username;?></strong></dt>
          <dd class='strong'><?php echo $lang->score->common;?></dd>
          <?php $i = 1;?>
          <?php foreach($monthScore as $ranking):?>
          <?php if($ranking->account == 'guest') continue;?>
          <dt>
            <span class='strong'>Top<?php echo $i?></span>
            <?php
            $ranking->account = trim($ranking->account);
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
            ?>
          </dt>
          <dd><?php echo $ranking->sumScore?></dd>
          <?php $i++;?>
          <?php endforeach;?>
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'><?php echo $lang->score->weekRank;?></div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span><?php echo $lang->score->rank;?></span><?php echo $lang->score->username;?></strong></dt>
          <dd class='strong'><?php echo $lang->score->common;?></dd>
          <?php $i = 1;?>
          <?php foreach($weekScore as $ranking):?>
          <?php if($ranking->account == 'guest') continue;?>
          <dt>
            <span class='strong'>Top<?php echo $i?></span>
            <?php
            $ranking->account = trim($ranking->account);
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
            ?>
          </dt>
          <dd><?php echo $ranking->sumScore?></dd>
          <?php $i++;?>
          <?php endforeach;?>
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'><?php echo $lang->score->dayRank;?></div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span><?php echo $lang->score->rank;?></span><?php echo $lang->score->username;?></strong></dt>
          <dd class='strong'><?php echo $lang->score->common;?></dd>
          <?php $i = 1;?>
          <?php foreach($dayScore as $ranking):?>
          <?php if($ranking->account == 'guest') continue;?>
          <dt>
            <span class='strong'>Top<?php echo $i?></span>
            <?php
            $ranking->account = trim($ranking->account);
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
            ?>
          </dt>
          <dd><?php echo $ranking->sumScore?></dd>
          <?php $i++;?>
          <?php endforeach;?>
        </dl>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
