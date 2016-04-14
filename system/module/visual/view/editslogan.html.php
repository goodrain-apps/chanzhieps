<?php if(!defined("RUN_MODE")) die();?>
<?php include "header.html.php"; ?>
<form method='post' action='<?php echo helper::createLink('site', 'setbasic');?>' class='ve-form mw-800px center-block' enctype='multipart/form-data'>
  <table class='table table-form'>
    <tr>
      <th><?php echo $lang->site->slogan;?></th>
      <td><?php echo html::input('slogan', $this->config->site->slogan, "class='form-control'");?></td>
      <td>
      <?php
          echo html::submitButton();
          echo html::hidden('modules', 'initial');
      ?></td>
    </tr>
  </table>
</form>
<?php include "footer.html.php"; ?>
