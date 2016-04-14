<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The manage privilege by group view of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: managepriv.html.php 1517 2011-03-07 10:02:57Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<form class='form-condensed' method='post' id='ajaxForm'>
  <div class='panel main-panel'>
    <div class='panel-heading with-nav-tabs'> 
      <ul class='nav nav-tabs'>
        <li class='active' data-group='all'><?php echo html::a('javascript:;', $lang->group->allGroups);?></li>
        <?php foreach($lang->moduelGroups as $group => $modules):?>
        <?php if($group != 'admin'):?>
        <li data-group='<?php echo $group;?>'><?php echo html::a('javascript:;', $lang->groups->{$group}['title']);?></li>
        <?php endif;?>
        <?php endforeach;?>
      </ul>
    </div>
    <?php foreach($lang->moduelGroups as $group => $modules):?>
    <div class='panel' <?php echo "id='group$group'"?>>
      <div class='group-heading'>
      </div>
      <table class='table table-bordered table-form'> 
        <?php $heading = false;?>
        <?php foreach($modules as $module):?>
        <?php $this->app->loadLang($module);?>
        <?php $moduleActions = zget($lang->resource, $module);?>
        <tr>
          <?php if(!$heading) :?>
          <th class='w-90px' style='text-align:center;' rowspan="<?php echo count($modules);?>"> <?php if(isset($lang->groups->{$group})) echo $lang->groups->{$group}['title'];?></th>
          <?php $heading = true;?>
          <?php endif;?>
          <th class='text-right w-120px'>
            <?php echo $this->lang->{$module}->common;?>
            <input type="checkbox" class='checkModule' />
          </th>
          <td id='<?php echo $module;?>' class='pv-10px'>
            <?php $i = 1;?>
            <?php foreach($moduleActions as $action => $actionLabel):?>
            <?php
            $currentModule = $module;
            if(is_array($actionLabel))
            {
                $module = $actionLabel['module'];
                $actionLabel = $actionLabel['method'];
            }
            ?>
            <div class='group-item'>
              <input type='checkbox' name='actions[<?php echo $module;?>][]' value='<?php echo $action;?>' <?php if(isset($groupPrivs[$module][$action])) echo "checked";?> />
              <span class='priv' id="<?php echo $module . '-' . $actionLabel;?>">
              <?php echo isset($lang->$module->$actionLabel) ? $lang->$module->$actionLabel : $lang->$actionLabel;?>
              </span>
            </div>
            <?php $currentModule = $module;?>
            <?php endforeach;?>
          </td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
    <?php endforeach;?>
    <div class='panel-footer'><?php echo html::submitButton();?></div>
  </div>
</form>
<script type='text/javascript'>
var groupID = <?php echo $groupID?>;
</script>
