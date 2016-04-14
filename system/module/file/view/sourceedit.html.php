<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' enctype='multipart/form-data' id='sourceEditForm' action='<?php echo $this->createLink('file', 'sourceedit', "fileID=$file->id")?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->file->title;?></th> 
      <td><?php echo html::input('filename',$file->title, "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-80px'><?php echo $lang->file->pathname;?></th> 
      <td><?php echo $file->pathname;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->file->editFile;?></th>
      <td><?php echo html::file('upFile', "class='form-control'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton()?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
