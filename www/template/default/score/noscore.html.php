<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of download method of file module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoCMS
 * @version     $Id$
 */
?>
<div class='alert alert-info with-icon'>
  <i class='icon-frown'></i>
  <div class='panel-body'>
    <h4><?php printf($lang->score->lblNoScoreReason, $lang->score->methods[$method], $score, $app->user->score);?></h4>
    <?php
    echo html::a($this->createLink('score', 'buyScore'), $lang->user->buyScore, "target='_blank' class='btn' ");
    echo html::a($this->createLink('score', 'rule'), $lang->score->scoreGuider, "target='_blank' class='btn'");
    echo html::a("javascript:history.go(-1)", $lang->goback, "class='btn'");
    ?>
  </div>
</div>
