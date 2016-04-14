<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php if(!isset($block)) $block = new stdclass();?>
<?php if(!isset($block->content)) $block->content = new stdclass();?>
<tr>
  <th><?php echo $lang->block->layout;?></th>
  <td>
    <div class='input-group layout-group'>
      <span class='input-group-addon'><?php echo $lang->block->navPosition;?></span>
      <?php echo html::select('params[nav]', $lang->block->headerLayout->nav, zget($block->content, 'nav', 'besideLogo'), "class='form-control'");?>
      <span class='input-group-addon'><?php echo $lang->block->sloganPosition;?></span>
      <?php echo html::select('params[slogan]', $lang->block->headerLayout->slogan, zget($block->content, 'slogan', 'row'), "class='form-control'");?>
      <span class='input-group-addon'><?php echo $lang->block->searchbarPosition;?></span>
      <?php echo html::select('params[searchbar]', $lang->block->headerLayout->searchbar, zget($block->content, 'searchbar', 'besideSlogan'), "class='form-control'");?>
    </div>
    <div class='checkbox'><label><input style='margin-top: 3px' type='checkbox' id='compatible'  name='params[compatible]' value='1'<?php if(zget($block->content, 'compatible', 0)) echo " checked='checked'" ?>> <?php echo $lang->block->headerLayout->compatibleEnable ?></label></div>
  </td>
</tr>
<script>
$(function()
{
    $('[name*=nav]').change(function()
    {
        if($(this).val() == 'besideLogo')
        {
            $('[name*=slogan]').find('[value=besideLogo]').prop('disabled', true).hide().change();
            $('[name*=slogan]').val('topLeft');
        }
        else
        {
            $('[name*=slogan]').find('[value=besideLogo]').prop('disabled', false).show().change();
        }
    });

    $('[name*=slogan]').change(function()
    {
        if($(this).val() == 'besideLogo')
        {
            $('[name*=searchbar]').find('[value=besideSlogan]').prop('disabled', false).show();
        }
        else
        {
            $('[name*=searchbar]').find('[value=besideSlogan]').prop('disabled', true).hide();
            $('[name*=searchbar]').val('topRight');
        }
    });
    $('[name*=nav]').change();

    $('#compatible').change(function()
    {
        $('.layout-group').toggle(!$(this).is(':checked'));
    }).change();
})
</script>
