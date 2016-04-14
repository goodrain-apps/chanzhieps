<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The traffic view file of stat module of chanzhiEPS.
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
<?php js::set('lineLabels', $labels);?>
<?php js::set('lineChart', $lineChart);?>
<?php include '../../common/view/datepicker.html.php';?>
<div class='panel'>
  <div class="panel-heading pd-l0">
    <div class="panel-actions pull-left"> 
      <ul class='nav nav-tabs'>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('traffic', "mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get' action="<?php echo inlink('traffic')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'traffic') . html::hidden('mode', 'fixed');?>
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
    <strong>&nbsp;</strong>
  </div>
</div>
<div class='panel'>
  <?php if(!empty($dayCharts)):?> <div><?php echo html::radio('lineType', $lang->stat->dataTypes, 'pv');?></div><?php endif;?>
  <table class='table table-bordered table-condensed'>
    <thead>
      <tr class='text-center'>
        <th></th>
        <th><?php echo $lang->stat->pv;?></th>
        <th><?php echo $lang->stat->uv;?></th>
        <th><?php echo $lang->stat->ipCount;?></th>
      </tr>
    </thead>
    <tbody>
      <tr class='text-center'>
        <td class='text-center'><?php echo $lang->stat->today;?></td>
        <td><?php echo $todayReport ? zget($todayReport->pv, 0) : 0;?></td>
        <td><?php echo $todayReport ? zget($todayReport->uv, 0) : 0;?></td>
        <td><?php echo $todayReport ? zget($todayReport->ip, 0) : 0;?></td>
      </tr>
      <tr class='text-center'>
        <td class='text-center'><?php echo $lang->stat->yestoday;?></td>
        <td><?php echo $yestodayReport ? zget($yestodayReport->pv, 0) : 0;?></td>
        <td><?php echo $yestodayReport ? zget($yestodayReport->uv, 0) : 0;?></td>
        <td><?php echo $yestodayReport ? zget($yestodayReport->ip, 0) : 0;?></td>
      </tr>
    </tbody>
  </table> 
</div>
<div class='panel'>
  <div class='chart-canvas'><canvas height='260' width='900' id='lineChart'></canvas></div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
