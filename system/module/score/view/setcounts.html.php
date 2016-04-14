<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setCounts view file of score of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     Score
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-cog"></i> <?php echo $lang->score->setCounts;?></strong>
  </div>
  <form method='post' action='<?php echo $this->createLink('score', 'setCounts');?>' id='ajaxForm' class='form'>
    <table class='table table-form borderless'>
      <tbody class='scoreCounts'>
        <tr>
          <th class='w-120px'><?php echo $lang->score->methods['register'] . $lang->score->methods['award'];?></th> 
          <td><?php echo html::input('register', $this->config->score->counts->register, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->methods['login'] . $lang->score->methods['award'];?></th> 
          <td><?php echo html::input('login', $this->config->score->counts->login, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->methods['maxLogin'];?></th> 
          <td><?php echo html::input('maxLogin', $this->config->score->counts->maxLogin, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->methods['thread'] . $lang->score->methods['award'];?></th> 
          <td><?php echo html::input('thread', $this->config->score->counts->thread, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->methods['reply'] . $lang->score->methods['award'];?></th> 
          <td><?php echo html::input('reply', $this->config->score->counts->reply, "class='form-control'");?></td><td></td>
        </tr>
        <?php if(commonModel::isAvailable('submittion')):?>
        <tr>
          <th><?php echo $lang->score->methods['approveSubmittion'] . $lang->score->methods['award'];?></th> 
          <td><?php echo html::input('approveSubmittion', $this->config->score->counts->approveSubmittion, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <tr>
          <th><?php echo $lang->score->methods['delThread'] .$lang->score->methods['punish'];?></th> 
          <td><?php echo html::input('delThread', $this->config->score->counts->delThread, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->methods['delReply'] . $lang->score->methods['punish'];?></th> 
          <td><?php echo html::input('delReply', $this->config->score->counts->delReply, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->methods['buyscore'];?></th> 
          <td>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo '1' . $lang->score->amountUnit . ' ' . $lang->equal;?></span>
              <?php echo html::input('perYuan', $this->config->score->buyScore->perYuan, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->score->common;?></span>
            </div>
          </td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->score->minAmount;?></th> 
          <td>
            <div class='input-group'>
              <?php echo html::input('minAmount', $this->config->score->buyScore->minAmount, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->score->amountUnit;?></span>
            </div>
          </td><td></td>
        </tr>
        <tr><td></td><td><?php echo html::submitButton();?></td></tr>
      </tbody>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
