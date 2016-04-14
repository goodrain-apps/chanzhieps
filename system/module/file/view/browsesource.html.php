<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::import($jsRoot . 'zeroclipboard/zeroclipboard.min.js');?>
<?php js::set('copySuccess', $lang->file->copySuccess);?>
<div class='modal fade' id='uploadModal'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'><?php echo $lang->file->uploadSource?></div>
      <?php $template = $this->config->template->{$this->device}->name;?>
      <?php $theme    = $this->config->template->{$this->device}->theme;?>
      <form id="fileForm" method='post' enctype='multipart/form-data' action='<?php echo inlink('upload', "objectType=source&objectID={$template}_{$theme}");?>'>
        <table class='table table-form'>
          <?php if($writeable):?>
          <tr>
            <td class='w-10px'></td>
            <td class='text-middle w-100px'><?php echo $lang->file->source . sprintf($lang->file->limit, $this->config->file->maxSize / 1024 /1024);?></td>
            <td><?php echo $this->fetch('file', 'buildForm');?></td>
            <te class='w-40px'></td>
          </tr>
          <tr><td colspan='4' class='text-center'><?php echo html::submitButton();?></td></tr>
          <?php else:?>
          <tr><td colspan='4'><h5 class='text-danger'><?php echo $lang->file->errorUnwritable;?></h5></td></tr>
          <?php endif;?>
        </table>
      </form>
    </div>
  </div>
</div>
<div class='panel'>
  <div class='panel-heading'>
    <?php echo $lang->file->sourceList?>
    <span class='panel-actions'>
      <?php echo html::a('javascript:void(0)', "<i class='icon icon-th-large'></i>", "class='image-view selected'")?>
      <?php echo html::a('javascript:void(0)', "<i class='icon icon-list'></i>", "class='list-view'")?>
      <?php echo html::commonButton($lang->file->uploadSource, 'btn btn-sm btn-primary', "data-toggle='modal' data-target='#uploadModal'")?>
    </span>
  </div>
  <div id='imageView' class='panel-body'>
    <ul class='files-list clearfix'>
    <?php foreach($files as $file):?>
        <?php
        $imageHtml = '';
        $fileHtml  = '';
        $fullURL = html::input('', $file->fullURL, "size='" . strlen($file->fullURL) . "' style='border:none; background:none;' onmouseover='this.select()'");
        if($file->isImage)
        {
            $imageHtml .= "<li class='file-image file-{$file->extension}'>";
            $imageHtml .= html::a(helper::createLink('file', 'download', "fileID=$file->id&mose=left"), html::image($file->fullURL), "target='_blank' data-toggle='lightbox'");
            $imageHtml .= "<div class='file-source'><input id='fullURL{$file->id}' type='text' value='{$file->fullURL}'/><button class='copyBtn' data-clipboard-target='fullURL{$file->id}'>{$lang->copy}</button></div>";
            $imageHtml .= "<span class='file-actions'>";
            $imageHtml .= html::a(helper::createLink('file', 'sourcedelete', "id=$file->id"), "<i class='icon-trash'></i>", "class='deleter'");
            $imageHtml .= html::a(helper::createLink('file', 'sourceedit', "id=$file->id"), "<i class='icon-edit'></i>", "data-toggle='modal'");
            $imageHtml .= '</span>';
            $imageHtml .= '</li>';
        }
        else
        {
            $file->title = $file->title . ".$file->extension";
            $fileHtml .= "<li class='file file-{$file->extension}'>";
            $fileHtml .= html::a(helper::createLink('file', 'download', "fileID=$file->id&mouse=left"), $file->title, "target='_blank'");
            $fileHtml .= "<div class='file-source'><input type='text' value='" . $file->fullURL . "'/></div>";
            $fileHtml .= "<span class='file-actions'>";
            $fileHtml .= html::a(helper::createLink('file', 'sourcedelete', "id=$file->id"), "<i class='icon-trash'></i>", "class='deleter'");
            $fileHtml .= html::a(helper::createLink('file', 'sourceedit', "id=$file->id"), "<i class='icon-edit'></i>", "data-toggle='modal'");
            $fileHtml .= '</span>';
            $fileHtml .= '</li>';
        }
        if($imageHtml or $fileHtml) echo $imageHtml . $fileHtml;
        ?>
    <?php endforeach;?>          
    </ul>
    <div class='clearfix'><?php $pager->show();?></div>
  </div>
  <div id='listView' class='hide'>
    <table class='table table-bordered'>
      <thead>
        <tr class='text-center'>
          <th class=' w-60px'><?php echo $lang->file->id;?></th>
          <th><?php echo $lang->file->source;?></th>
          <th><?php echo $lang->file->sourceURI;?></th>
          <th class='w-60px'><?php echo $lang->file->extension;?></th>
          <th class='w-80px'><?php echo $lang->file->size;?></th>
          <th class='w-100px'><?php echo $lang->file->addedBy;?></th>
          <th class='w-160px'><?php echo $lang->file->addedDate;?></th>
          <th class='w-80px'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($files as $file):?>
        <tr class='text-center text-middle'>
          <td><?php echo $file->id;?></td>
          <td>
            <?php
            if($file->isImage)
            {
                echo html::a(inlink('download', "id=$file->id"), html::image($file->smallURL, "class='image-small' title='{$file->title}'"), "data-toggle='lightbox' target='_blank'");
            }
            else
            {
                echo html::a(inlink('download', "id=$file->id"), $file->title, "target='_blank'");
            }
            ?>
          </td>
          <td class='text-left'><?php echo $file->fullURL;?></td>
          <td><?php echo $file->extension;?></td>
          <td><?php echo number_format($file->size / 1024 , 1) . 'K';?></td>
          <td><?php echo isset($users[$file->addedBy]) ? $users[$file->addedBy] : '';?></td>
          <td><?php echo $file->addedDate;?></td>
          <td class='text-center'>
            <?php
            commonModel::printLink('file', 'sourceedit',   "id=$file->id", $lang->edit, "data-toggle='modal'");
            commonModel::printLink('file', 'sourcedelete', "id=$file->id", $lang->delete, "class='deleter'");
            ?>
          </td>
        </tr>
        <?php endforeach;?>          
      </tbody>
      <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
    </table>
  </div>
</div>
<script type="text/javascript">
var copyBtns = $('.copyBtn');
var clip = new ZeroClipboard(copyBtns);
clip.on('aftercopy', function(){window.messager.success(v.copySuccess); });
</script>
<?php include '../../common/view/footer.admin.html.php';?>
