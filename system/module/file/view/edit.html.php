<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' enctype='multipart/form-data' id='fileForm' action='<?php echo $this->createLink('file', 'edit', "fileID=$file->id")?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->file->title;?></th> 
      <td><?php echo html::input('title',$file->title, "class='form-control'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->file->editFile;?></th>
      <td><?php echo html::file('upFile', "class='form-control'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton() . html::commonButton($lang->goback, 'btn btn-default goback')?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
