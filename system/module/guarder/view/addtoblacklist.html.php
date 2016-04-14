<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='ajaxForm' method='post' action="<?php echo inlink('addToBlacklist', "objectType={$objectType}&objectID={$object->id}");?>">
  <table class='table table-form form-inline table-borderd'>
  <?php if($objectType == 'thread'):?>
    <tr>
      <th class='w-80px'><?php echo $lang->blacklist->title;?></th>
      <td colspan='3'>
        <div class='objectTitle'>
        <?php echo $object->title;?>
        </div>
      </td>
    </tr>
    <?php endif;?> 
    <tr>
      <th class='w-80px content'><?php echo $lang->blacklist->identity;?></th>
      <td colspan='3' class='w-180px'>
        <div class='objectContent'>
        <?php echo $object->content;?>
        </div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->blacklist->keywords;?></th>
      <td colspan='3'>
        <?php echo html::textarea('keywords', '', "placeholder='{$lang->keywordsHolder}'class='form-control'");?>
      </td>
    </tr>
    <?php if(!empty($object->ip)):?>
    <tr>
      <th><?php echo $lang->blacklist->ip;?></th>
      <td class='w-180px'>
        <?php echo html::checkbox('item[ip]', array($object->ip => $object->ip), '', "checkbox-inline");?>
      </td>
      <td class='w-180px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::select('hour[ip]', $lang->guarder->punishOptions, '', "class='form-control'");?>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($object->author)):?>
    <tr>
      <th><?php echo $lang->blacklist->account;?></th>
      <td class='w-180px'>
        <?php echo html::checkbox('item[account]', array($object->author => $object->author), '', "checkbox-inline");?>
      </td>
      <td class='w-180px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::select('hour[account]', $lang->guarder->punishOptions, '', "class='form-control'");?>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($object->email)):?>
    <tr>
      <th><?php echo $lang->blacklist->email;?></th>
      <td class='w-180px'>
        <?php echo html::checkbox('item[email]', array($object->email => $object->email), '', "checkbox-inline");?>
      </td>
      <td class='w-180px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::select('hour[email]', $lang->guarder->punishOptions, '', "class='form-control'");?>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>

