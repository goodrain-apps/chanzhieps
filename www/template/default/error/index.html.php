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
#panel-404 {padding: 40px 80px 60px;}
#panel-404 h1 {margin-bottom: 40px;}
#panel-404 form {max-width: 300px}
.screen-phone #panel-404 {padding: 20px 20px 30px;}
</style>
<div class='panel' id='panel-404'>
  <h1>404 <small> - <?php echo $lang->error->pageNotFound;?></small></h1>
  <p><small><?php echo $lang->error->searchTip;?></small></p>
  <form action='<?php echo helper::createLink('search')?>' method='get' role='search'>
    <div class='input-group'>
      <?php $keywords = ($this->app->getModuleName() == 'search') ? $this->session->serachIngWord : '';?>
      <?php echo html::input('words', $keywords, "class='form-control' placeholder=''");?>
      <?php if($this->config->requestType == 'GET') echo html::hidden($this->config->moduleVar, 'search') . html::hidden($this->config->methodVar, 'index');?>
      <div class='input-group-btn'>
        <button class='btn btn-default' type='submit'><i class='icon icon-search'></i></button>
      </div>
    </div>
  </form>
</div>
<?php $this->fetch('sitemap', 'index', 'onlyBody=yes')?>
<?php include TPL_ROOT . 'common/footer.html.php';?>
