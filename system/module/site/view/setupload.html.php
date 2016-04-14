<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setupload  view file of site module of chanzhiEPS.
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
<?php include '../../common/view/kindeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setUpload;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-130px'><?php echo $lang->site->allowUpload;?></th>
          <td class='w-p40'><input type='checkbox' name='allowUpload' value='1' <?php if(isset($this->config->site->allowUpload) and $this->config->site->allowUpload) echo 'checked'?>/></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->allowedFiles;?></th>
          <td colspan='2'>
            <?php echo html::textarea('allowedFiles', $this->config->file->allowed, "rows='4' class='form-control'");?>
            <span class='text-important'><?php echo $lang->site->fileAllowedRole;?></span>
          </td>
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
