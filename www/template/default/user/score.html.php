<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='row'>
  <?php include TPL_ROOT . 'user/side.html.php';?>
  <div class='col-md-10'>
    <div class='panel'>
      <table class='table table-hover table-striped'>
        <thead>
          <tr>
            <th class='w-80px'><?php echo $lang->score->id;?></th>
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
            <th><?php echo $score->id;?></th>
            <?php $score->time = substr($score->time, 0, 10);?>
            <td><?php echo $score->time;?></td>
            <td><?php echo $score->type == 'punish' ? $lang->score->methods[$score->type] : $lang->score->methods[$score->method];?></td>
            <td><?php echo ($score->type == 'in' ? '+' : '-') . $score->count;?></td>
            <td><?php echo $score->before;?></td>
            <td><?php echo $score->after;?></td>
            <td><?php echo $score->note;?></td>
          </tr>  
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan='4'>
              <strong class='red'><?php printf($lang->score->lblTotal, $user->score, $user->rank);?></strong>
              <?php if(strpos($this->config->shop->payment, 'alipay') !== false) echo html::a($this->createLink('score', 'buyScore'), $this->lang->user->buyScore, "class='btn btn-primary btn-xs'");?>
            </td>
            <td colspan='4' class='a-right'><?php $pager->show();?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
