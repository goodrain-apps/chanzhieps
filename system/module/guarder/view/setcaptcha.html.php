<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<form id='ajaxForm' class='form-horizontal' action=<?php echo inlink('setCaptcha');?> method='post'>
  <div class='panel'>
    <div class="panel-heading"> <strong><i class='icon-globe'></i> <?php echo $lang->guarder->setCaptcha;?></strong></div>
    <div class='panel-body'>
      <?php foreach($captchas as $key => $captcha):?>
      <div class="form-group">
        <div class='col-xs-6 col-md-4 col-md-offset-2'>
          <?php echo html::input("question[]", $captcha->question,"class='form-control' placeholder='{$lang->guarder->question}'");?>
        </div>
        <div class='col-xs-6 col-md-4'>
          <?php echo html::input("answer[]", $captcha->answer,"class='form-control' placeholder='{$lang->guarder->answer}'");?>
        </div>
        <div class='col-xs-6 col-md-2'>
          <?php 
            echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='btn btn-link pull-left btn-mini btn-plus'");
            echo html::a('javascript:;', "<i class='icon-remove'></i>", "class='btn btn-link pull-left btn-mini btn-remove'");
          ?>
        </div>
      </div>
      <?php endforeach;?>
      <?php for($i = 0; $i < 5; $i++):?>
      <div class="form-group">
        <div class='col-xs-6 col-md-4 col-md-offset-2'>
          <?php echo html::input("question[]", '', "class='form-control' placeholder='{$lang->guarder->question}'");?>
        </div>
        <div class='col-xs-6 col-md-4'>
          <?php echo html::input('answer[]', '', "class='form-control' placeholder='{$lang->guarder->answer}'");?>
        </div>
        <div class='col-xs-6 col-md-2'>
          <?php 
            echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='btn btn-link pull-left btn-mini btn-plus'");
            echo html::a('javascript:;', "<i class='icon-remove'></i>", "class='btn btn-link pull-left btn-mini btn-remove'");
          ?>
        </div>
      </div>
      <?php endfor;?>
      <?php echo "<div class='form-group'><div class='col-xs-8 col-md-offset-2'>" . html::submitButton() . "<span class='text-important'>{$lang->guarder->captchaTip}</span></div></div>";?>
    </div>
  </div>
</form>
<div class='child hide'>
  <div class="form-group">
    <div class='col-xs-6 col-md-4 col-md-offset-2'>
      <?php echo html::input('question[]','',"class='form-control' placeholder='{$lang->guarder->question}'");?>
    </div>
    <div class='col-xs-6 col-md-4'>
      <?php echo html::input('answer[]','',"class='form-control' placeholder='{$lang->guarder->answer}'");?>
    </div>
    <div class='col-xs-6 col-md-2'>
      <?php 
        echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='btn btn-link pull-left btn-mini btn-plus'");
        echo html::a('javascript:;', "<i class='icon-remove'></i>", "class='btn btn-link pull-left btn-mini btn-remove'");
      ?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
