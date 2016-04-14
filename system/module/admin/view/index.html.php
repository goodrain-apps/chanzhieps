<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The index view file of admin module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiyingl@xirangit.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php if(!$ignoreUpgrade) js::import('http://api.chanzhi.org/latest.php?version=' . $this->config->version);?>
<div class='container' id='shortcutBox'>

  <?php if(strpos($this->server->php_self, '/admin.php') !== false && empty($this->config->global->ignoreAdminEntry)):?>
  <form method='post' id='ajaxForm' action='<?php echo $this->createLink('admin', 'ignore');?>'>
    <div class="alert alert-danger">
      <button type="submit" class="close">&times;</button>
      <strong><?php echo $lang->admin->adminEntry;?></strong>
    </div>
  </form>
  <?php endif;?>

  <?php if(!$ignoreUpgrade):?>
  <div class='alert alert-success' id='upgradeNotice'>
    <div>
      <?php echo $lang->newVersion;?>
      <button class="close"><?php echo html::a(inlink('ignoreUpgrade'), '&times;', "class='reload'");?></button>
    </div>
  </div>
  <?php endif;?>

  <?php if(!$checkLocation):?>
  <div class='alert alert-success'>
    <div>
      <?php echo $lang->site->changeLocation;?>
      <?php echo html::a($this->createLink('site', 'setsecurity'), $lang->site->changeSetting, "class='red'");?>
    </div>
  </div>
  <?php endif;?>

  <div class='row summary'>
    <?php if(commonModel::isAvailable('order')):?>
    <div class='col-xs-6'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->order;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed table-borderless'>
          <?php foreach($orders as $order):?> 
          <?php $orderTitle = sprintf($lang->admin->orderTitle, $order->account, $currencySymbol . $order->amount);?>
            <tr>
              <td><?php commonModel::printLink('order', 'admin','', $orderTitle);?></td>
              <td><?php echo substr($order->createdDate, -8);?></td>
            </tr>
          <?php endforeach;?>
          <?php if(count($orders) == 5):?>
            <tr>
              <td></td><td align='right'><?php commonModel::printLink('order', 'admin', '', $lang->more . '...');?></td>
            </tr>
          <?php endif;?>
          </table>
        </div>
      </div>
    </div>
    <?php endif;?>
    <?php if(commonModel::isAvailable('forum')):?>
    <div class='col-xs-6'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->thread;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed table-borderless'>
          <?php foreach($threads as $thread):?> 
          <?php $threadTitle = $thread->author . '&nbsp&nbsp' . helper::substr($thread->title, 25);?>
            <tr>
              <td><?php echo html::a(commonmodel::createFrontLink('thread', 'view', "threadid=$thread->id"), $threadTitle);?></td>
              <td><?php echo substr($thread->addedDate, -8);?></td>
            </tr>
          <?php endforeach;?>
          <?php if(count($threads) == 5):?>
            <tr>
              <td></td><td align='right'><?php commonModel::printLink('forum', 'admin', "tab=feedback", $lang->more . '...');?></td>
            </tr>
          <?php endif;?>
          </table>
        </div>
      </div>
    </div>
    <?php endif;?>
    <div class='col-xs-6'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->feedback;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed table-borderless'>
          <?php foreach($messages as $type => $message):?> 
          <?php if($message != '0'):?>
          <?php $messageTitle = sprintf($lang->admin->$type, $message);?>
          <tr>
            <td><?php commonModel::printLink('message', 'admin', "type={$type}", $messageTitle);?></td>
          </tr>
          <?php endif;?>
          <?php endforeach;?>
          <?php if(!empty($threadReply) and $threadReply != '0'):?>
          <tr>
            <?php $threadReplyTitle = sprintf($lang->admin->threadReply, $threadReply);?>
            <td><?php commonModel::printLink('reply', 'admin', "order=id_desc&tab=feedback", $threadReplyTitle);?></td>
          </tr>
          <?php endif;?>
          <?php if(commonModel::isAvailable('submittion') and $submittionCount != '0'):?>
          <?php $submittionTitle = sprintf($lang->admin->submittion, $submittionCount);?>
          <tr>
            <td><?php commonModel::printLink('article', 'admin','type=submittion&tab=feedback', $submittionTitle);?></td>
          </tr>
          <?php endif;?>
          <?php if(!empty($todayReportTitle)):?>
          <tr>
            <?php $todayReportTitle = sprintf($lang->admin->todayReport, $todayReport->pv, $todayReport->uv, $todayReport->ip);?>
            <td><?php commonModel::printLink('stat', 'traffic', "mode=today", $todayReportTitle);?></td>
          </tr>
          <?php endif;?>
          <?php if(!empty($yestodayReportTitle)):?>
          <tr>
            <?php $yestodayReportTitle = sprintf($lang->admin->yestodayReport, $yestodayReport->pv, $yestodayReport->uv, $yestodayReport->ip);?>
            <td><?php commonModel::printLink('stat', 'traffic', "mode=yestoday", $yestodayReportTitle);?></td>
          </tr>
          <?php endif;?>
          </table>
        </div>
      </div>
    </div>
    <div class='col-xs-6'>
      <div class='row panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->shortcuts->common;?></strong></div>
        <div class='panel-body shortcutGroup'>
          <?php 
            if(!empty($articleCategories)) echo html::a($this->createLink('article', 'create'), $lang->admin->shortcuts->article, "class='btn btn-default'");
            else echo html::a($this->createLink('tree', 'browse',"type=article"), $lang->admin->shortcuts->articleCategories, "class='btn btn-default'")
          ?>
          <?php echo html::a($this->createLink('product', 'create'), $lang->admin->shortcuts->product, "class='btn btn-default'");?>
          <?php echo html::a($this->createLink('message', 'admin'), $lang->admin->shortcuts->feedback, "class='btn btn-default'");?>  
          <?php echo html::a($this->createLink('site', 'setBasic'), $lang->admin->shortcuts->site, "class='btn btn-default'");?>
          <?php echo html::a($this->createLink('company', 'setBasic'), $lang->admin->shortcuts->company, "class='btn btn-default'");?>
          <?php echo html::a($this->createLink('company', 'setcontact'), $lang->admin->shortcuts->contact, "class='btn btn-default'")?>  
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
