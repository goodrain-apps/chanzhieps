<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<form method='post' id='qrcodeForm' enctype='multipart/form-data' action="<?php echo inlink('qrcode', "public={$public->id}")?>">
  <table class='table table-form'>
    <tr>
      <?php if(!empty($qrcodeURL)) echo '<td>' . html::image($qrcodeURL) . '</td>';?>
      <td><input type='file' name='file' id='file' class='form-control'></td>
      <td><?php echo html::submitButton();?></td>
      <td class='w-200px'><strong class='text-info'><?php echo $lang->wechat->qrcodeType; ?></strong></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
