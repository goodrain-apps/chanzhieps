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
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <?php include TPL_ROOT . 'user/side.html.php';?>
  <div class='col-md-10'>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->user->buyScore?></strong></div>
      <div class='panel-body'>
        <form method='post' id='ajaxForm'>
          <table class='table table-form'>
            <tr>
              <th width='100'><?php echo $lang->score->setAmount?></th>
              <td><?php echo html::input('amount', '', "style='width:45px' onkeyup='getScore()'")?><?php echo $lang->score->amountUnit;?> <span class='ml-10px red'><?php printf($lang->score->buyWaring, $config->score->buyScore->minAmount, $config->score->buyScore->perYuan)?></span></td>
            </tr>
            <tr>
              <th><?php echo $lang->score->getScore?></th>
              <td><span id='score'>0</span></td>
            </tr>
            <tr>
              <th></th>
              <td><?php echo html::submitButton()?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
var scoreConfig = <?php echo $config->score->buyScore->perYuan?>;
</script>
<?php include TPL_ROOT . 'common/footer.html.php';?>

