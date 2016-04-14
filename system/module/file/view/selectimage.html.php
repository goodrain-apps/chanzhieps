<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('id', $id);?>
<ul class='files-list clearfix'>
  <?php foreach($files as $file):?>
  <?php echo "<li class='file-image file-{$file->extension}'>" . html::a('javascript:void(0);', html::image($file->fullURL), "onclick=\"selectFile(this, $callback)\" data-url={$file->fullURL}") . "</li>";?>
  <?php endforeach;?>          
</ul>
<?php include '../../common/view/footer.modal.html.php';?>
