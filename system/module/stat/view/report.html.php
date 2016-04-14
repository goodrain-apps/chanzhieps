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
<?php if(isset($pieCharts)) js::set('pieCharts', $pieCharts);?>
<?php if(isset($lineCharts)) js::set('lineCharts', $lineCharts);?>
<?php if(isset($lineLabels)) js::set('lineLabels', $lineLabels);?>
<?php js::set('type', $type);?>
<div class='panel'>
  <div class="panel-heading pd-l0">
    <div class='panel-actions pull-left'>
      <ul class='nav nav-tabs'>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink($type, "&mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get'>
            <?php echo html::hidden('m', 'stat');?>
            <?php echo  html::hidden('f', $type);?>
            <?php echo html::hidden('mode', 'fixed');?>
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
  <?php if(!empty($lineCharts)) include 'linechart.html.php';?>
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
            <td><?php echo zget($lang->stat, $type);?></td>
            <td><?php echo $lang->stat->pv;?></td>
            <td><?php echo $lang->stat->uv;?></td>
            <td><?php echo $lang->stat->ipCount;?></td>
            <?php if(isset($totalPV)):?>
            <td><?php echo $lang->stat->percentage;?></td>
            <?php endif;?>
          </tr>
        </thead>
        <?php for($i = 0 ; $i < count($pieCharts['pv']); $i ++):?>
        <?php $report = $pieCharts['pv'][$i];?>
        <tr class='text-center'>
          <?php if($type == 'domain'):?>
          <td><?php echo $report->label . ' ' . html::a(inlink('domain', "domain=" . urlencode($report->label)), " <i class='icon icon-search'></i>");?></td>
          <?php else:?>
          <td><?php echo $report->label;?></td>
          <?php endif;?>
          <td><?php echo $report->value;?></td>
          <td><?php echo $pieCharts['uv'][$i]->value;?></td>
          <td><?php echo $pieCharts['ip'][$i]->value;?></td>
          <?php if(isset($totalPV)):?>
          <td><?php echo number_format($pieCharts['pv'][$i]->value * 100 / $totalPV, 2);?>%</td>
          <?php endif;?>
        </tr>
        <?php endfor;?>
      </table>
  </div>  
  <?php else:?>
  <div class='panel-body text-danger'><?php echo $lang->stat->noData;?></div>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
