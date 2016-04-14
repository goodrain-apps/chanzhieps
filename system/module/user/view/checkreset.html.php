<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.html.php';?>
<section id="check">
  <div class="box-radius">
    <div class="panel panel-default">
      <div class="panel-heading"><h4><strong><?php echo $lang->user->changePassword;?></strong></h4></div>
      <div class="panel-body">
        <form method='post' id='ajaxForm'>
          <table> 
            <tr>
              <th class='w-100px'><?php echo $lang->user->password;?></th>
              <td><?php echo html::password('password1', '', "class='text-box'");?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->user->password2;?></th>
              <td><?php echo html::password('password2', '', "class='text-box'");?></td>
            </tr>
            <tr>
              <th></th>
              <td><?php echo html::submitButton($lang->user->submit,'btn btn-primary btn-block') . html::hidden('reset', $reset);?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>  
  </div>
</section>
<?php include '../../common/view/footer.html.php';?>
