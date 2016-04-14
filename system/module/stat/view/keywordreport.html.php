<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The from view file of stat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chart.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('lineLabels', $labels);?>
<?php js::set('lineChart', $keywordLine);?>
<?php js::set('pieCharts', $pieCharts);?>
<div class='panel pd-l0'>
  <div class="panel-heading pd-l0">
    <div class="panel-actions pull-left">
      <ul class='nav nav-tabs'>
        <li <?php echo $mode == 'all' ? "class='active'" : '' ?>><?php echo html::a(inlink('page', "mode=all"), $lang->stat->all);?></li>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('keywordreport', "keyword={$keyword}&mode=$code"), $modeName);?></li>
        <?php endforeach;?>
         <li>
         <form method='get' action="<?php echo inlink('keywordreport')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'keywordreport') . html::hidden('keyword', $keyword) . html::hidden('mode', 'fixed');?>
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
    <strong>&nbsp; </strong>
  </div>
  <?php if(!empty($keywordLine)):?>
  <div class='chart-canvas'><canvas height='260' width='900' id='lineChart'></canvas></div>
  <?php endif;?>
  <?php if(!empty($pieCharts)):?>
  <div class='panel-body'>
    <div class='col-md-6'>
      <div class='chart-canvas'><canvas height='260' width='400' id='pieChart'></canvas></div>
      <div class='text-center w-400px' id='switchBar'>
        <label data-type='pv' class='active'> <?php echo $lang->stat->pv;?></label>
        <label data-type='uv'> <?php echo $lang->stat->uv;?></label>
        <label data-type='ip'> <?php echo $lang->stat->ipCount;?></label>
      </div>
    </div>
    <div class='clo-md-6'>
      <table class='table table-bordered table-report w-500px' id='reportData'>
        <thead>
          <tr class='text-center'>
            <td><?php echo $lang->stat->searchEngine?></td>
            <td><?php echo $lang->stat->pv;?></td>
            <td><?php echo $lang->stat->uv;?></td>
            <td><?php echo $lang->stat->ipCount;?></td>
          </tr>
        </thead>
        <?php for($i = 0 ; $i < count($pieCharts['pv']); $i ++):?>
        <?php $report = $pieCharts['pv'][$i];?>
        <tr class='text-center'>
          <td><?php echo $report->label;?></td>
          <td><?php echo $report->value;?></td>
          <td><?php echo $pieCharts['uv'][$i]->value;?></td>
          <td><?php echo $pieCharts['ip'][$i]->value;?></td>
        </tr>
        <?php endfor;?>
      </table>
  </div>  
  <?php else:?>
  <div class='panel-body text-danger'><?php echo $lang->stat->noData;?></div>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
