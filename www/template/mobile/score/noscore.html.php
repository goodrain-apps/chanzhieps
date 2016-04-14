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
<div class='panel'>
<div class='panel-heading'><strong><?php echo $lang->score->lblNoScore;?></strong></div>
<table class='table table-form'> 
  <tr>
    <td>
      <?php
      printf($lang->score->lblNoScoreReason, $lang->score->methods[$method], $score, $app->user->score);
      echo '<ol>';
      echo '<li>' . html::a($this->createLink('forum', 'index'), $lang->score->getByThread, "target='_blank'") . '</li>';
      echo '<li>' . html::a($this->createLink('forum', 'index'), $lang->score->getByReply, "target='_blank'") . '</li>';
      echo '<li>' . html::a($this->createLink('score', 'buyScore'), $lang->user->buyScore, "target='_blank'") . '</li>';
      echo '</ol>';
      echo $lang->score->lblDetail;
      echo html::a('#', $lang->goback, "onclick=history.go(-1) class='btn'");
      echo html::a($this->createLink('user', 'logout'), $lang->login, "class='btn'");
      ?>
    </td>
  </tr>  
</table>
</div>
