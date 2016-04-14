<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The set js view file of article module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<form id='ajaxForm' action="<?php echo inlink('setjs', "articleID=$article->id");?>" method='post'>
  <table class="table table-form">
    <tr><td><?php echo html::textarea('js', $article->js, "rows=5 class='form-control codeeditor' style='height:170px' data-mode='javascript'");?></td></tr>
    <tr>
      <td>
        <div class='form-action'>
          <?php echo html::submitButton();?>
          <strong class='text-info'><?php echo $lang->article->noJsTag;?></strong>
        </div>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
