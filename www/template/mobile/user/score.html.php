<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <?php include TPL_ROOT . 'user/side.html.php';?>
  <div class='col-md-10'>
    <div class='panel-section'>
      <div class='panel-heading'><?php echo html::a($this->createLink('score', 'buyScore'), $lang->user->buyScore, "class='btn primary block' data-toggle='modal'")?></div>
      <div class='panel-heading'>
        <strong class='red'><?php printf($lang->score->lblTotal, $user->score, $user->rank);?></strong>
      </div>
      <div class='panel-body'>
      <table class='table table-hover table-striped'>
        <thead>
          <tr>
            <th class='w-100px'><?php echo $lang->score->time;?></th>
            <th class='w-150px'><?php echo $lang->score->method;?></th>
            <th class='w-150px'><?php echo $lang->score->count;?></th>
            <th class='w-150px'><?php echo $lang->score->before;?></th>
            <th class='w-150px'><?php echo $lang->score->after;?></th>
            <th><?php echo $lang->score->note;?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($scores as $score):?>
          <tr>
            <?php $score->time = substr($score->time,0,10);?>
            <td><?php echo $score->time;?></td>
            <td><?php echo $lang->score->methods[$score->method];?></td>
            <td><?php echo ($score->type == 'in' ? '+' : '-') . $score->count;?></td>
            <td><?php echo $score->before;?></td>
            <td><?php echo $score->after;?></td>
            <td><?php echo $score->note;?></td>
          </tr>  
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr><td colspan='8' class='a-right'><?php $pager->show('justify');?></td></tr>
        </tfoot>
      </table>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
