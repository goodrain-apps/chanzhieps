<?php if(!defined("RUN_MODE")) die();?>
<table class='table-1 f-12px' align='center'>
  <caption><?php echo $lang->file->browse;?></caption>
  <tr>
    <th><?php echo $lang->file->id;?></th>
    <th><?php echo $lang->file->title;?></th>
    <th><?php echo $lang->file->extension;?></th>
    <th><?php echo $lang->file->size;?></th>
    <th><?php echo $lang->file->addedDate;?></th>
    <th><?php echo $lang->file->public;?></th>
    <th><?php echo $lang->file->downloads;?></th>
    <th><?php echo $lang->file->download;?></th>
  </tr>
  <?php $i = 1;?>
  <?php foreach($files as $file):?>
  <tr class='a-center'>
    <td><?php echo $i ++;?></td>
    <th class='a-left'><?php echo html::a($this->createLink('file', 'download', "id=$file->id"), $file->title, $file->isImage ? "target='_blank'" : '');?></th>
    <td><?php echo $file->extension;?></td>
    <td><?php echo $file->size;?></td>
    <td><?php echo $file->addedDate;?></td>
    <td><?php $file->public or (!$file->public and $app->user->account != 'guest') ? print($lang->file->publics[$file->public]) : print(html::a($this->createLink('user', 'login'), $lang->file->publics[$file->public]));?></td>
    <td><?php echo $file->downloads;?></td>
    <td><?php echo html::a($this->createLink('file', 'download', "id=$file->id"), $lang->file->download, $file->isImage ? "target='_blank' class='red'" : "class='red'");?></td>
  </tr>
  <?php endforeach;?>
</table>
