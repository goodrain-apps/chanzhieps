<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The domain list view file of stat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<div class='panel'>
  <div class="panel-heading pd-l0">
    <div class='panel-actions pull-left'>
      <ul class='nav nav-tabs'>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('domainlist', "mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get' action="<?php echo inlink('domainreport')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'domain') . html::hidden('mode', 'fixed');?>
            <table class='table table-borderless'>
              <tr>
                <td style='padding:4px'>
                  <?php echo html::input('begin', $this->get->begin, "placeholder='{$lang->stat->begin}' class='form-date w-120px'")?> 
                  <?php echo html::input('end', $this->get->end, "placeholder='{$lang->stat->end}' class='form-date w-120px'")?>
                  <?php echo html::submitButton($lang->stat->view, "btn btn-xs btn-info");?>
                </td>
              </tr>
            </table>
          </form>
        </li>
      </ul>
    </div>
    <strong><i class='icon-stats'></i> &nbsp;</strong>
  </div>
</div>
<div class="panel">
  <table class='table table-hover table-bordered'>
    <thead>
      <tr class='text-center'>
        <th class='text-middle'><?php echo $lang->stat->domain;?></th>
        <th>pv</th>
        <th>uv</th>
        <th>ip</th>
        <th class='text-middle'><?php echo $lang->actions?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($domains as $domain => $report):?>
      <tr class='text-center text-middle'>
        <td class='text-left'><?php echo $domain;?></td>
        <td class='w-100px'><?php echo $report->pv;?></td>
        <td class='w-100px'><?php echo $report->uv;?></td>
        <td class='w-100px'><?php echo $report->ip;?></td>
        <td class='w-100px'>
          <?php $domain = helper::safe64Encode($domain);?>
          <?php echo html::a(inlink('domaintrend', "domain={$domain}&mode={$mode}&begin={$this->get->begin}&end={$this->get->end}"), $lang->stat->domainTrend);?>
          <?php echo html::a(inlink('domainpage', "domain={$domain}&mode={$mode}&begin={$this->get->begin}&end={$this->get->end}"), $lang->stat->domainPage);?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='5'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
