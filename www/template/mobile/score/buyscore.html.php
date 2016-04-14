<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The score view file of score module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     score
 * @version     $Id$
 * @link        http://www.chanzhi.net
 */
?>
<?php $isRequestModal = helper::isAjaxRequest();?>
<?php if($isRequestModal):?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'></i> <?php echo $lang->user->buyScore;?></h5>
    </div>
    <div class='modal-body'>
<?php else: ?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='panel panel-section'>
  <div class='panel-heading'><strong><?php echo $lang->user->buyScore?></strong></div>
  <div class='panel-body'>
<?php endif;?>
    <form method='post' id='buyScoreForm' action="<?php echo $this->createLink('score', 'buyScore')?>">
      <div class='form-group'>
        <?php echo html::input('amount', '', "class='form-control' placeholder='{$lang->score->setAmount}' onkeyup='getScore()'");?>
      </div>
      <div class='form-group'>
        <?php printf($lang->score->buyWaring, $config->score->buyScore->minAmount, $config->score->buyScore->perYuan)?>
      </div>
      <div class='form-group'>
        <span><?php echo $lang->score->getScore?></span>
         <span id='score'>0</span>
      </div> 
      <div class='form-group'>
        <?php echo html::submitButton('', 'btn primary block');?>
      </div>
    </form>
<?php if($isRequestModal):?>
    </div>
  </div>
</div>
<?php else: ?>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php';?>
<?php endif;?>
<script type='text/javascript'>
var $buyScoreForm = $('#buyScoreForm');
$buyScoreForm.ajaxform({onSuccess: function(response)
{
    if(response.result == 'success')
    {
        $.closeModal();
    }
}});

var scoreConfig = <?php echo $config->score->buyScore->perYuan?>;
function getScore()
{
    $('#score').html(Math.round($('#amount').val() * scoreConfig));
}
</script>
