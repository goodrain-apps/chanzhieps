<?php if(!defined("RUN_MODE")) die();?>
<?php if($isSearchAvaliable):?>
<div id='searchbar' data-ve='search'>
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
<?php endif;?>
