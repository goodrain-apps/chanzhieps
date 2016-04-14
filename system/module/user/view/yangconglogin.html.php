<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.lite.html.php';?>
<div class="page-container">
  <div class='row'>
    <div class='col-md-4'></div>
    <div class='col-md-4'>
      <div class='panel panel-default'>
        <div class='panel-heading'><h3><?php echo $lang->user->bindAccount;?></h3></div>
        <div class='panel-body'>
          <form method='post' id='bindForm' action='<?php echo $this->createLink('user', 'oauthbind');?>' role='form' target='_blank'>
            <div class='form-group'>
              <label for='useraccount'><?php echo $lang->user->account;?></label>
              <?php echo html::input('account', '', "class='form-control'")?>
            </div>
            <div class='form-group'>
              <label for='password'><?php echo $lang->user->password;?></label>
              <?php echo html::password('password', '', "class='form-control'");?>
            </div>
            <?php 
            echo html::submitButton($lang->login, 'btn btn-success btn-wider');
            echo html::hidden('referer', $referer);
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.iframe.html.php';?>
