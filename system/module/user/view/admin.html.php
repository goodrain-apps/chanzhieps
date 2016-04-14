<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin view file of user module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Yangyang Shi <shiyangyangwork@yahoo.cn>
 * @package     User
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include '../../common/view/header.admin.html.php';
js::set('provider', $this->get->provider);
js::set('admin', $this->get->admin);
?>
<div class="panel">
  <div class="panel-heading clearfix">
    <ul id='typeNav' class='nav nav-tabs pull-left'>
      <li data-type='internal' <?php echo !$this->get->provider ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin'), $lang->user->all);?>
      </li>
      <?php if(!empty($this->config->oauth->sina)):?>
      <li data-type='internal' <?php echo$this->get->provider == 'sina' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "provider=sina"), $lang->user->oauth->typeList['sina']);?>
      </li>
      <?php endif;?>
      <?php if(!empty($this->config->oauth->qq)):?>
      <li data-type='internal' <?php echo$this->get->provider == 'qq' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "provider=qq"), $lang->user->oauth->typeList['qq']);?>
      </li>
      <?php endif;?>
      <?php if($this->loadModel('wechat')->getList()):?>
      <li data-type='internal' <?php echo$this->get->provider == 'wechat' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "provider=wechat"), $lang->user->oauth->typeList['wechat']);?>
      </li>
      <?php endif;?>
    </ul> 
    <div class="panel-actions">
      <form method='get' class='form-inline form-search'>
        <?php echo html::hidden('m','user') . html::hidden('f','admin');?>
        <div class="input-group">
          <?php
          echo html::input('user', $this->get->user, "class='form-control search-query' placeholder='{$lang->user->inputUserName}'"); 
          ?>
          <span class="input-group-btn">
            <?php echo html::submitButton($lang->user->searchUser, "btn"); ?>
          </span>
        </div>
      </form>
      <?php echo html::a(inlink('create'), "<i class='icon icon-plus'></i> " .  $lang->user->create, "data-toggle='modal' class='btn btn-primary'");?>
    </div>
  </div>
  <form method='post' action='<?php echo inlink('batchdelete');?>'>
    <table class='table table-hover table-striped able-condensed' id='userList'>
      <thead>
        <tr class='text-center'>
          <th class='w-60px'><?php echo $lang->user->id;?></th>
          <th class='w-100px'><?php echo $lang->user->realname;?></th>
          <th class='w-100px'><?php echo $lang->user->account;?></th>
          <?php if(commonModel::isAvailable('score')):?>
          <th class='w-70px'><?php echo $lang->user->score;?></th>
          <th class='w-70px'><?php echo $lang->user->rank;?></th>
          <?php endif;?>
          <?php if(!$this->get->admin):?>
          <th class='w-60px'><?php echo $lang->user->gender;?></th>
          <th class='text-left visible-lg'><?php echo $lang->user->company;?></th>
          <th class='w-80px'><?php echo $lang->user->join;?></th>
          <?php endif;?>
          <th class='w-70px'><?php echo $lang->user->visits;?></th>
          <th class='w-140px'><?php echo $lang->user->last;?></th>
          <th class='w-100px'><?php echo $lang->user->ip;?></th>
          <th class='w-60px'><?php echo $lang->user->status;?></th>
          <th class='w-160px'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <tbody>
      <?php $forbidPriv = commonModel::hasPriv('user', 'forbid');?>
      <?php foreach($users as $user):?>
      <tr class='text-center'>
        <td>
          <input type='checkbox' name='account[]'  value='<?php echo $user->account;?>'/> 
          <?php echo $user->id;?>
        </td>
        <td><?php echo $user->realname;?></td>
        <td><?php echo $user->account;?></td>
        <?php if(commonModel::isAvailable('score')):?>
        <td><?php echo $user->score;?></td>
        <td><?php echo $user->rank;?></td>
        <?php endif;?>
        <?php if(!$this->get->admin):?>
        <td><?php $gender = $user->gender; echo zget($lang->user->genderList, $gender);?></td>
        <td class='text-left visible-lg'><?php echo $user->company;?></td>
        <td><?php echo substr($user->join, 0, 10);?></td>
        <?php endif;?>
        <td><?php echo $user->visits;?></td>
        <td><?php echo $user->last;?></td>
        <td><?php echo $user->ip;?></td>
        <td>
        <?php if($user->fails > 4 and $user->locked > helper::now()) echo $lang->user->statusList->locked;?>
        <?php if($user->fails <= 4 and $user->locked > helper::now()) echo $lang->user->statusList->forbidden;?>
        <?php if($user->locked <= helper::now()) echo $lang->user->statusList->normal;?>
        </td>
        <td class='operate text-left'>
          <?php //if($user->provider == 'wechat') echo html::a($this->createLink('wechat', 'message', "from={$user->openID}"), $lang->user->messages);?>
          <?php commonModel::printLink('user', 'edit', "account=$user->account", $lang->edit); ?>
          <?php if(commonModel::isAvailable('score')):?>
          <span class="dropdown">
            <a href='###' class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang->score->common?><span class="caret"></span></a>
            <ul class="dropdown-menu pull-right text-center" role="menu">
              <li><?php commonModel::printLink('user', 'addScore', "account=$user->account", $lang->user->addScore, "data-toggle=modal"); ?></li>
              <li><?php commonModel::printLink('user', 'reduceScore', "account=$user->account", $lang->user->reduceScore, "data-toggle=modal"); ?></li>
            </ul>
          </span>
          <?php endif;?>
          <?php commonModel::printLink('user', 'delete', "account=$user->account", $lang->delete); ?>
          <?php if($user->locked <= helper::now() and $forbidPriv):?>
          <span class="dropdown">
            <a href='###' class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang->user->forbid?> <span class="caret"></span></a>
            <ul class="dropdown-menu pull-right text-left" role="menu">
            <?php foreach($lang->user->forbidDate as $date => $title):?>
              <li><?php echo html::a($this->createLink('user', 'forbid', "userID={$user->id}&date=$date"), $title, "class='forbider'");?></li>
            <?php endforeach;?>
            </ul>
          </span>
          <?php endif;?>
          <?php if($user->locked > helper::now()) commonModel::printLink('user', 'activate', "id=$user->id", $lang->user->activate, "class='forbider'");?>
        </td>
      </tr>
      <?php endforeach;?>
      </tbody>
      <tfoot>
        <tr>
          <?php if(commonModel::isAvailable('score')):?>
          <td colspan='14'>
          <?php else:?>
          <td colspan='12'>
          <?php endif;?>
          <div class='btn-group'>
            <?php echo html::selectButton();?>
          </div>
          <?php echo html::submitButton($lang->delete);?>
          <?php if($this->get->provider == 'wechat') commonModel::printLink('user', 'pullWechatFans', '', "<i class='icon-refresh '> {$lang->user->pullWechatFans} </i>", "class='btn btn-primary' id='pullBtn'")?>
          <?php $pager->show();?>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<?php include '../../common/view/footer.admin.html.php';?>
