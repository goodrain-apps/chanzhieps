<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The transfer view of thread module of ZenTaoMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('parents', $parents);?>
<?php js::set('currentBoard', $thread->board);?>
<form id='ajaxForm' class='form-horizontal' action='<?php echo inlink('transfer', "threadID={$thread->id}")?>'  method='post'>
  <div class='form-group'>
    <label for='link' class='col-xs-2 control-label'><?php echo $lang->thread->board;?></label>
    <div class='col-xs-8'>
      <?php echo html::select('targetBoard', $boards, '', "class='form-control chosen'");?>
    </div>
  </div>
  <div class='form-group'>
    <div class='col-xs-2'></div>
    <div class='col-xs-8'>
      <?php echo html::submitButton();?>
    </div>
  </div>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
