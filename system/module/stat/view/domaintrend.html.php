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
<?php js::set('lineChart',  $lineChart);?>
<div class='panel'>
  <div class="panel-heading pd-l0">
    <div class="panel-actions pull-left">
      <ul class='nav nav-tabs'>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('domaintrend', "domain={$domain}&mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get' action="<?php echo inlink('domaintrend')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'domaintrend') . html::hidden('domain', $domain) . html::hidden('mode', 'fixed');?>
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
      <ul>
    </div>
    <strong>&nbsp;</strong>
  </div>
</div>
<?php if(!empty($lineChart)):?>
<div class="col-md-6"> <div class='chart-canvas'><canvas height='<?php echo min(count($labels) * 65, 700)?>' width='900' id='lineChart'></canvas></div> </div>
<?php endif;?>
<div class="col-md-6">
  <table class='table table-hover table-bordered'>
    <thead>
      <tr class='text-center'>
        <th><?php echo $lang->stat->date;?></th>
        <th><?php echo $lang->stat->pv;?></th>
        <th><?php echo $lang->stat->uv;?></th>
        <th><?php echo $lang->stat->ipCount;?></th>
      </tr>
    </thead>
    <tbody>
      <?php for($i = 0; $i < count($labels); $i ++):?>
      <tr class='text-center text-middle'>
        <th><?php echo $labels[$i];?></th>
        <td class='w-100px'><?php echo $lineChart[0]->data[$i]?></td>
        <td class='w-100px'><?php echo $lineChart[1]->data[$i]?></td>
        <td class='w-100px'><?php echo $lineChart[2]->data[$i]?></td>
      </tr>
      <?php endfor;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
