<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin browse view file of stat module of chanzhiEPS.
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
        <li <?php echo $class?>><?php $domainx = helper::safe64Encode($domain); echo html::a(inlink('domainpage', "domain={$domainx}&mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get' action="<?php echo inlink('domainpage')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'domainpage') . html::hidden('domain', $domain) . html::hidden('mode', 'fixed');?>
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
  <div class="panel-">
  <table class='table table-hover table-bordered'>
    <thead>
      <tr class='text-center'>
        <th class='text-middle'><?php echo $lang->stat->domainPage;?></th>
        <?php foreach($labels as $label):?>
        <th><?php echo date('Y-m-d', strtotime($label));?></th>
        <?php endforeach;?>
        <th class='text-middle'><?php echo $lang->stat->totalPV;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($pages as $page => $reports):?>
      <?php $pv = 0;?>
      <tr class='text-center text-middle'>
        <td><?php echo $page;?></td>
        <?php foreach($labels as $label):?>
        <?php if(isset($reports[$label])):?>
        <td class='<?php echo $label;?>'><?php echo $reports[$label]->pv;?></td>
      <?php $pv += $reports[$label]->pv;?>
        <?php else:?>
        <td class='<?php echo $label;?>'>0</td>
        <?php endif;?>
        <?php endforeach;?>
        <td><?php echo $pv;?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='20'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
