<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setWhitelist view file of guard module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Qiaqia LI <liqiaqia@cnezsoft.cn>
 * @package     guard
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->guarder->setWhitelist;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->guarder->whitelist->ip;?></th>
          <td colspan='2'>
            <?php echo html::textarea('ip', !empty($this->config->guarder->whitelist->ip) ? $this->config->guarder->whitelist->ip : '', "class='form-control'");?>
            <span class='text-important'><?php echo $lang->guarder->whitelist->ipHolder;?></span>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->guarder->whitelist->account;?></th>
          <td colspan='2'>
            <?php echo html::textarea('account', !empty($this->config->guarder->whitelist->account) ? $this->config->guarder->whitelist->account : '', "class='form-control'");?>
            <span class='text-important'><?php echo $lang->guarder->whitelist->accountHolder;?></span>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->guarder->password;?></th>
          <td class='w-200px'>
            <?php echo html::password('password', '', "placeholder='{$lang->guarder->passwordHolder}' class='form-control'");?>
          </td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
