<?php if(!defined("RUN_MODE")) die();?>
<form method='post' class='form-horizontal' id='childForm' action="<?php echo $this->inlink('children', "type=$type&category=$parent");?>">
  <div class='panel'>
    <div class='panel-heading'>
    <strong><?php echo $parent ? $lang->category->children . ' <i class="icon-double-angle-right"></i> ' : $lang->category->common; ?></strong>
    <?php
    foreach($origins as $origin)
    {
        echo html::a($this->inlink('browse', "type=$type&category=$origin->id"), $origin->name . " <i class='icon-angle-right text-muted'></i> ");
    }
    ?>
    </div>

    <div class='panel-body' id='childList'>
      <?php
      $maxID = 0;
      foreach($children as $child)
      {
          $maxID = $maxID < $child->id ? $child->id : $maxID;

          echo "<div class='form-group category'>";
          echo "<div class='col-xs-6 col-md-4 col-md-offset-2'>" . html::input("children[$child->id]", $child->name, "class='form-control'") . "</div>";
          if(!$isWechatMenu and $type != 'express' and $type != 'slide') echo "<div class='col-xs-6 col-md-4'>" . html::input("alias[$child->id]", $child->alias, "class='form-control' placeholder='{$this->lang->category->alias}'") . '</div>';
          if($type != 'slide') echo "<div class='col-xs-6 col-md-2'><i class='icon-move sort-handle'> </i></div>";
          echo html::hidden("mode[$child->id]", 'update');
          echo "</div>";
      }

      $newChildrenCount = tree::NEW_CHILD_COUNT;
      if($isWechatMenu)
      {
            $allowedChildren = $parent ?  tree::WEICHAT_SUBMENU_COUNT : tree::WEICHAT_MAINMENU_COUNT;
            $newChildrenCount = $allowedChildren - count($children);
      }
        
      for($i = 0; $i < $newChildrenCount; $i ++)
      {
          echo "<div class='form-group category'>";
          echo "<div class='col-xs-6 col-md-4 col-md-offset-2'>" . html::input("children[]", '', "class='form-control' placeholder='{$this->lang->category->name}'") . "</div>";
          if(!$isWechatMenu and $type != 'express' and $type != 'slide')
          {
              echo "<div class='col-xs-6 col-md-4'>" . html::input("alias[]", '', "class='form-control' placeholder='{$this->lang->category->alias}'") . '</div>';
              echo "<div class='col-xs-6 col-md-2'>";
              echo "<i class='icon-move sort-handle'> </i>";
              echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='btn btn-link pull-left btn-mini btn-plus'");
              echo html::a('javascript:;', "<i class='icon-remove'></i>", "class='btn btn-link pull-left btn-mini btn-remove'");
              echo '</div>';
          }
          echo html::hidden('mode[]', 'new');
          echo "</div>";
      }

      if(($type == 'forum') and ($boardChildrenCount == 0))
      {
          echo "<div class='form-group'><div class='col-xs-8 col-md-offset-2'><div class='alert alert-warning'>{$this->lang->board->placeholder->setChildren}</div></div></div>";
      }
      echo "<div class='form-group'><div class='col-xs-8 col-md-offset-2'>" . html::submitButton() . "</div></div>";

      echo html::hidden('parent', $parent);
      ?>      
    </div>
  </div>
</form>
<div class='child hide'>
  <div class='form-group category'>
    <div class='col-xs-6 col-md-4 col-md-offset-2'><?php echo  html::input("children[]", '', "class='form-control' placeholder='{$this->lang->category->name}'");?></div>
    <div class='col-xs-6 col-md-4'><?php echo html::input("alias[]", '', "class='form-control' placeholder='{$this->lang->category->alias}'");?></div>
    <div class='col-xs-6 col-md-2'>
      <?php echo "<i class='icon-move sort-handle'> </i>";?>
      <?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='btn btn-link pull-left btn-mini btn-plus'");?>
      <?php echo html::a('javascript:;', "<i class='icon-remove'></i>", "class='btn btn-link pull-left btn-mini btn-remove'");?>
    </div>
    <?php echo html::hidden('mode[]', 'new');?>
  </div>
</div>
<?php js::set('maxID', $maxID);?>
<?php if(isset($pageJS)) js::execute($pageJS);?>
