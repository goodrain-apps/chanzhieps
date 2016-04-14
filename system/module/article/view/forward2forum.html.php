<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php js::set('parents', $parents);?>
<form method='post' id='ajaxForm' action='<?php echo inlink("forward2Forum", "articleID={$articleID}");?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-100px'><?php echo $lang->article->selectBoard;?></th>
      <td class='w-p40'>
        <div class='required required-wrapper'></div>
        <?php echo html::select('board', $categories, '', "class='form-control'");?>
      </td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->article->addedDate;?></th>
      <td>
        <div class="input-append date">
          <?php echo html::input('addedDate', date('Y-m-d H:i', strtotime('+2 day')), "class='form-control form-datetime'");?>
          <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
        </div>
      </td>
      <td><span class="help-inline"><?php echo $lang->article->placeholder->addedDate;?></span></td>
    </tr>
    <tr>
      <td></td>
      <td colspan='2'><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
