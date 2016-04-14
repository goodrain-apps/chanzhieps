<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of company module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     company
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php $displayAll = $display === 'all'; ?>
<div class='panel display-<?php echo $display?>'>
  <div class='panel-heading'><strong><i class='icon-building'></i> <?php echo $lang->company->setBasic;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='ve-form'>
      <table class='table table-form'>
        <tr data-row='name'>
          <th class='w-100px'><?php echo $lang->company->name;?></th>
          <td class='w-p50'><?php echo html::input('name', isset($this->config->company->name) ? $this->config->company->name : '', "class='form-control'");?></td><td></td>
        </tr>
        <tr data-row='desc'>
          <th><?php echo $lang->company->desc;?></th>
          <td colspan='2'><?php echo html::textarea('desc',  isset($this->config->company->desc) ? htmlspecialchars($this->config->company->desc) : '', "class='form-control' rows='5'");?></td>
        </tr>
        <tr data-row='content'>
          <th><?php echo $lang->company->content;?></th>
          <td colspan='2'><?php echo html::textarea('content',  isset($this->config->company->content) ? htmlspecialchars($this->config->company->content) : '', "class='form-control' rows='15'");?></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
