<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('groupID', $group);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-picture'></i> <?php echo $groupName;?></strong>
    <div class='panel-actions'>
      <?php commonModel::printLink('slide', 'create', "groupID=$group", '<i class="icon-plus"></i> ' . $lang->slide->create, "class='btn btn-primary'");?>
      <?php commonModel::printLink('slide', 'admin', '', $lang->slide->return, "class='btn btn-primary return'");?>
    </div>
  </div>
  <form id='sortForm' action='<?php echo inLink('sort')?>' method='post'>
    <table class='table'>
      <tbody>
        <?php foreach($slides as  $key => $slide):?>
        <?php if($slide->backgroundType == 'color') $slide->height = $slide->height ? $slide->height : 180; ?>
        <tr class='text-middle'>
          <td>
            <?php echo html::hidden("order[{$slide->id}]", $key);?> 
            <div class='carousel slide mg-0'>
              <div class='carousel-inner'>
                <?php if ($slide->backgroundType == 'image'): ?>
                <div class='item active'>
                  <?php print(html::image($slide->image));?>
                <?php else: ?>
                <div class='item active' style='<?php echo 'background-color: ' . $slide->backgroundColor . '; height: ' . $slide->height . 'px';?>'>
                <?php endif ?>
                  <div class='carousel-caption'>
                    <h2 style='color:<?php echo $slide->titleColor;?>'><?php echo $slide->title;?></h2>
                    <div><?php echo $slide->summary;?></div>
                    <?php
                    foreach($slide->label as $key => $label):
                    if(trim($label) != '') echo html::a($slide->buttonUrl[$key], $label, "class='btn btn-lg btn-" . $slide->buttonClass[$key] . "'");
                    endforeach;
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td class='w-50px text-center'>
            <a href='javascript:;' class='btn btn-move-up btn-sm'><i class='icon-arrow-up'></i></a>
            <a href='javascript:;' class='btn btn-move-down btn-sm'><i class='icon-arrow-down'></i></a>
            <?php commonModel::printLink('slide', 'edit', "id=$slide->id", "<i class='icon-pencil'></i>", "class='btn btn-sm' title='{$lang->edit}'");?>
            <?php commonModel::printLink('slide', 'delete', "id=$slide->id", "<i class='icon-remove'></i>", "class='deleter btn btn-sm' title='{$lang->delete}'");?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
