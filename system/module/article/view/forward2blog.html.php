<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<form method='post' id='ajaxForm' action='<?php echo inlink("forward2Blog", "articleID={$articleID}");?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-130px'><?php echo $lang->article->selectCategories;?></th>
      <td class='w-p40'>
        <div class='required required-wrapper'></div>
        <?php echo html::select("categories[]", $categories, '', "multiple='multiple' class='form-control chosen'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->article->addedDate;?></th>
      <td>
        <div class="input-append date">
          <?php echo html::input('addedDate', date('Y-m-d H:i', strtotime('+2 day')), "class='form-control form-datetime'");?>
          <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
        </div>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan='2'><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
