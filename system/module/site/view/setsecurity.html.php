<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('location', $location)?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setSecurity;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='securityForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-200px'><?php echo $lang->site->captcha;?></th>
          <td colspan='3'><?php echo html::radio('captcha', $lang->site->captchaList, isset($this->config->site->captcha) ? $this->config->site->captcha : 'auto');?></td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->checkEmail;?></th>
          <td colspan='2'><?php echo html::radio('checkEmail', $lang->site->checkEmailList, isset($this->config->site->checkEmail) ? $this->config->site->checkEmail : 'close');?></td>
          <td></td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->resetPassword;?></th>
          <td colspan='2'><?php echo html::radio('resetPassword', $lang->site->resetPasswordList, isset($this->config->site->resetPassword) ? $this->config->site->resetPassword : 'open');?></td>
          <td></td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->filterFunction;?></th>
          <td colspan='2'><?php echo html::radio('filterFunction', $lang->site->filterFunctionList, isset($this->config->site->filterFunction) ? $this->config->site->filterFunction : 'close');?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->importantOption;?></th>
          <td colspan='3'>
            <?php echo html::checkbox('importantValidate', $lang->site->validateTypes, $this->config->site->importantValidate);?><br>
          </td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->front;?></th>
          <td colspan='2'><?php echo html::radio('front', $lang->site->frontList, isset($this->config->site->front) ? $this->config->site->front : 'guest');?></td>
          <td></td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->checkLocation;?></th>
          <td colspan='2'><?php echo html::radio('checkLocation', $lang->site->checkLocationList, isset($this->config->site->checkLocation) ? $this->config->site->checkLocation : 'close');?></td>
          <td></td>
        </tr>
        <?php if(isset($this->config->site->yangcong)):?>
        <tr>
          <th class='w-200px'><?php echo $lang->site->forceYangcong;?></th>
          <td colspan='2'>
            <?php echo html::radio('forceYangcong', $lang->site->forceYangcongList, isset($this->config->site->forceYangcong) ? $this->config->site->forceYangcong : 'close');?>
            <br/><span class='text-important'><?php echo $lang->site->yangcongTip;?></span>
          </td>
          <td></td>
        </tr>
        <?php endif;?>
        <tr>
          <?php $allowedLocation = isset($this->config->site->allowedLocation) ? $this->config->site->allowedLocation : '';?>
          <th class='w-200px'><?php echo $lang->site->allowedLocation;?></th>
          <td colspan='2'><?php echo html::input('allowedLocationShow', $allowedLocation, "class='form-control' disabled='disabled'");?></td>
          <td>
            <?php echo html::input('allowedLocation', $allowedLocation, "class='hide'");?>
            <?php echo $allowedLocation == $location ? '' : html::a('', sprintf($lang->site->useLocation, $location), "id='useLocation' class=''")?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->site->checkSessionIP;?></th>
          <td colspan='3'>
            <?php echo html::radio('checkSessionIP', $lang->site->sessionIpoptions, isset($this->config->site->checkSessionIP) ? $this->config->site->checkSessionIP : 0);?>
            <br/><span class='text-important'><?php echo $lang->site->sessionIpTip;?></span>
          </td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->checkIP;?></th>
          <td colspan='3'>
            <?php echo html::textarea('allowedIP', isset($this->config->site->allowedIP) ? $this->config->site->allowedIP : '', "class='form-control'");?>
            <span class='text-important'><?php echo $lang->site->allowedIPTip;?></span>
          </td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::a($this->createLink('guarder', 'validate', "url=&target=modal&account=&type=okFile"), $lang->save, "data-toggle='modal' class='hidden captchaModal'")?>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
