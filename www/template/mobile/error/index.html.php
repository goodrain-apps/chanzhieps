<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The error view file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     error
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<style>
.container {padding: 20px;}
.alert > .icon, .alert > .icon + .content {padding: 10px 15px;}
.alert > .icon {display: block; text-align: center; font-size: 48px; float: none; line-height: 1; padding-bottom: 0; opacity: .7}
.alert-error {max-width: 500px; margin: 8% auto; padding: 0; background-color: #FFF; border: 1px solid #ccc; box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.2); border-radius: 0; padding: 10px 0;}
.btn-link {border-color: none!important}
.alert-error .actions {margin-top: 10px;}
.alert-error h2 {margin: 0 0 20px}
body {background-color: #f1f1f1}
</style>
<div class='container'>
  <div class='alert alert-error'>
    <i class='icon-frown icon'></i>
    <div class='content'>
      <h1 class='text-center'>404 <small> - <?php echo $lang->error->pageNotFound;?></small></h1>
      <p class='text-center'><small><?php echo $lang->error->searchTip;?></small></p>
      <div class='actions'>
        <form action='<?php echo helper::createLink('search')?>' method='get' role='search'>
          <div class='input-group'>
            <?php $keywords = ($this->app->getModuleName() == 'search') ? $this->session->serachIngWord : '';?>
            <?php echo html::input('words', $keywords, "class='form-control' placeholder=''");?>
            <?php if($this->config->requestType == 'GET') echo html::hidden($this->config->moduleVar, 'search') . html::hidden($this->config->methodVar, 'index');?>
            <div class='input-group-btn'>
              <button class='btn default' type='submit'><i class='icon icon-search'></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
