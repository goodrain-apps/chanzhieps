<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The set sensitive view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setsensitive;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-150px'><?php echo $lang->site->filterSensitive;?></th>
          <td><?php echo html::radio('filterSensitive', $lang->site->filterSensitiveList, isset($this->config->site->filterSensitive) ? $this->config->site->filterSensitive : 'close');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->sensitive;?></th>
          <td><?php echo html::textarea('sensitive', !empty($this->config->site->sensitive) ? $this->config->site->sensitive : $config->sensitive, "class='form-control' rows=14");?></td>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
