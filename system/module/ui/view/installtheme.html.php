<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The install view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('browseLink', inlink('browse'));?>
<?php if($blocksMerged and empty($error)):?>
<form method='post' action= '<?php echo inlink('fixTheme');?>' id='ajaxForm'>
  <div class='panel matched-blocks'>
    <div class='panel-heading'>
      <strong><?php echo html::a('###', "{$lang->ui->blocks2Merge} <i class='icon icon-caret-down'> </i>");?></strong>
    </div>
    <table class='table tabel-condensed' <?php if(!empty($unMatchedBlocks)) echo "style='display:none'";?>>
      <tr>
        <th class='w-140px text-center'><?php echo $lang->ui->importedBlocks;?></th>
        <th class='text-center'><?php echo $lang->ui->matchedBlock;?></th>
      </tr>
      <?php foreach($matchedBlocks as $originID => $id):?>
      <?php $newBlock = zget($importedBlocks, $originID);?>
      <tr class='matched'>
        <td class='text-middle'><?php echo $newBlock->title;?></td>
        <td>
          <div class='input-group'>
            <select name='blocks2Merge[<?php echo $newBlock->originID?>]' class='form-control'>
              <?php foreach($oldBlocks as $block):?>
                <?php $selected = ($block->id == $id) ? 'selected' : '';?>
                <option value='<?php echo $block->id?>' <?php echo $selected?>><?php echo $block->title;?></option>
              <?php endforeach;?>
            </select>
            <span class='input-group-addon'>
            <?php echo html::checkbox('blocks2Create', array($newBlock->id => $lang->ui->createBlock));?>
            </span>
          </div>
        </td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <?php if(!empty($unMatchedBlocks)):?>
  <div class='panel'>
    <div class='panel-heading'>
      <strong><?php echo $lang->ui->blocks2Create;?></strong>
    </div>
    <table class='table tabel-condensed'>
      <tr>
        <th class='w-140px'><?php echo $lang->ui->importedBlocks;?></th>
        <th><?php echo $lang->ui->matchedBlock;?></th>
      </tr>
      <?php foreach($importedBlocks as $newBlock):?>
      <?php if(isset($matchedBlocks[$newBlock->originID])) continue;?>
      <tr>
        <td class='text-middle'><?php echo $newBlock->title;?></td>
        <td>
          <div class='input-group'>
            <select name='blocks2Merge[<?php echo $newBlock->originID?>]' class='form-control'>
              <option value='0'></option>
              <?php $selected = '';?>
              <?php foreach($oldBlocks as $block):?>
                <?php $selected = ((strpos(',html,htmlcode,php,', ",{$newBlock->type},") === false) and $selected == '' and $block->type == $newBlock->type) ? 'selected' : '';?>
                <?php if($block->type == $newBlock->type and $block->title == $newBlock->title and $block->content == $newBlock->content) $selected = 'selected'?>
                <option value='<?php echo $block->id?>' <?php echo $selected?>><?php echo $block->title;?></option>
              <?php endforeach;?>
            </select>
            <span class='input-group-addon'>
            <?php echo html::checkbox('blocks2Create', array($newBlock->id => $lang->ui->createBlock));?>
            </span>
          </div>
        </td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <?php endif;?>
  <div><?php echo html::submitButton() . html::hidden('package', $package)?></div>
</form>
<?php elseif($error):?>
  <div class='alert alert-default'>
    <i class='icon-remove-sign'></i>
    <div class='content'>
      <h4><?php sprintf($lang->package->installFailed, 'install');?></h4>
      <p><?php echo $error;?></p>
      <hr>
      <?php echo html::a('javascript:;', $lang->package->refreshPage, "class='btn btn-reload'");?>
    </div>
  </div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
