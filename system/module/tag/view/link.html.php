<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The link magange view file of tag of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     tag
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='linkForm' class='form-horizontal' action='<?php echo inlink('link', "tageID={$tag->id}")?>'  method='post'>
  <div class='form-group'>
    <label for='link' class='col-xs-3 control-label'><?php echo $tag->tag;?></label>
    <div class='col-xs-8'>
      <?php echo html::input('link', $tag->link, "class='form-control' placeholder='{$lang->tag->inputLink}'");?>
    </div>
  </div>
  <div class='form-group'>
    <div class='col-xs-3'></div>
    <div class='col-xs-8'>
      <?php echo html::submitButton();?>
    </div>
  </div>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
