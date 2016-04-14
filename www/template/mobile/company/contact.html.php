<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The contact view file of company for mobile template of chanzhiEPS.
 * The file should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     company
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='cards borderless with-icon' id='companyContact'>
  <?php if(!empty($contact->contacts)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-user bg-important circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->contacts?></small>
      <div class='lead'><?php echo $contact->contacts?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->phone)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-phone bg-special circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->phone?></small>
      <div class='lead'><?php echo $contact->phone;?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->email)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-envelope bg-special circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->email?></small>
      <div class='lead'><?php echo $contact->email?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->qq)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-qq bg-info circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->qq?></small>
      <div class='lead'><?php echo $contact->qq?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->weixin)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-wechat bg-success circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->weixin?></small>
      <div class='lead'><?php echo $contact->weixin?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->weibo)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-weibo bg-danger circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->weibo?></small>
      <div class='lead'><?php echo $contact->weibo?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->wangwang)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-comment-alt bg-warning circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->wangwang?></small>
      <div class='lead'><?php echo $contact->wangwang?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->site)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-globe bg-primary circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->site?></small>
      <div class='lead'><?php echo $contact->site?></div>
    </div>
  </div>
  <?php endif; ?>
  <?php if(!empty($contact->address)): ?>
  <div class='card'>
    <i class='icon icon-s3 icon-building bg-gray circle'></i>
    <div class='card-content'>
      <small class='text-muted'><?php echo $this->lang->company->address?></small>
      <div class='lead'><?php echo $contact->address?></div>
    </div>
  </div>
  <?php endif; ?>
</div>
