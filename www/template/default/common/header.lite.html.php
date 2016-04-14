<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$webRoot        = $config->webRoot;
$jsRoot         = $webRoot . "js/";
$themeRoot      = $webRoot . "theme/default/";
$sysURL         = $common->getSysURL();
$thisModuleName = $this->app->getModuleName();
$thisMethodName = $this->app->getMethodName();
$template       = $this->config->template->{$this->device}->name ? $this->config->template->{$this->device}->name : 'default';
$theme          = $this->config->template->{$this->device}->theme ? $this->config->template->{$this->device}->theme : 'default';
$cdnRoot        = ($this->config->cdn->open == 'open') ? $this->config->cdn->host . $this->config->version : '';
?>
<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb" lang='<?php echo $app->getClientLang();?>' class='m-<?php echo $thisModuleName?> m-<?php echo $thisModuleName?>-<?php echo $thisMethodName?>'>
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-Control"  content="no-transform">
  <meta name="Generator" content="<?php echo 'chanzhi' . $this->config->version . ' www.chanzhi.org'; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if(isset($mobileURL)):?>
  <link rel="alternate" media="only screen and (max-width: 640px)" href="<?php echo $sysURL . $mobileURL;?>">
  <?php endif;?>
  <?php if(isset($sourceURL)):?>
  <link rel="canonical" href="<?php echo $sysURL . $sourceURL;?>" >
  <?php endif;?>
  <?php if($this->app->getModuleName() == 'user' and $this->app->getMethodName() == 'deny'):?>
  <meta http-equiv='refresh' content="5;url='<?php echo helper::createLink('index');?>'">
  <?php endif;?>
  <?php
  if(!isset($title))   $title    = '';
  if(!empty($title))   $title   .= $lang->minus;
  if(empty($keywords)) $keywords = $config->site->keywords;
  if(empty($desc))     $desc     = $config->site->desc;

  echo html::title($title . $config->site->name);
  echo html::meta('keywords',    strip_tags($keywords));
  echo html::meta('description', strip_tags($desc));
  if(isset($this->config->site->meta)) echo $this->config->site->meta;

  js::exportConfigVars();
  js::set('theme', array('template' => $template, 'theme' => $theme, 'device' => $this->device));
  if($config->debug)
  {
      js::import($jsRoot . 'jquery/min.js');
      js::import($jsRoot . 'zui/min.js');
      js::import($jsRoot . 'chanzhi.js');
      js::import($jsRoot . 'jquery/treeview/min.js');
      js::import($jsRoot . 'my.js');

      css::import($webRoot . 'zui/css/min.css');
      css::import($themeRoot . 'common/style.css');
      css::import($jsRoot    . 'jquery/treeview/min.css');
  }
  else
  {
      if($cdnRoot)
      {
          css::import($cdnRoot . '/theme/default/default/all.css', '', $version = false);
          js::import($cdnRoot  . '/js/all.js', $version = false);
      }
      else
      {
          css::import($themeRoot . 'default/all.css');
          js::import($jsRoot     . 'all.js');
      }
  }

  /* Import customed css file if it exists. */
  $siteCustomCssFile = $this->app->getDataRoot() . 'css' . DS . $config->site->code . DS . $this->config->template->{$this->device}->name . '_' . $this->config->template->{$this->device}->theme . '.css';
  if($config->multi && file_exists($siteCustomCssFile))
  {
      css::import(sprintf($webRoot . 'data/css/%s/%s_%s.css?' . $this->config->template->customVersion, $config->site->code, $config->template->{$this->device}->name, $config->template->{$this->device}->theme), "id='themeStyle'", false);
  }
  else
  {
      $customCssFile = $this->app->getDataRoot() . 'css' . DS . $this->config->template->{$this->device}->name . '_' . $this->config->template->{$this->device}->theme . '.css';
      if(file_exists($customCssFile)) css::import(sprintf($webRoot . 'data/css/%s_%s.css?' . $this->config->template->customVersion, $config->template->{$this->device}->name, $config->template->{$this->device}->theme), "id='themeStyle'", false);
  }

  if(isset($pageCSS)) css::internal($pageCSS);

  echo isset($this->config->site->favicon) ? html::icon(json_decode($this->config->site->favicon)->webPath) : (file_exists($this->app->getWwwRoot() . 'favicon.ico') ? html::icon($webRoot . 'favicon.ico') : '');
  echo html::rss($this->createLink('rss', 'index', '', '', 'xml'), $config->site->name);
  ?>
  <!--[if lt IE 9]>
  <?php
  if($config->debug)
  {
      js::import($jsRoot . 'html5shiv/min.js');
      js::import($jsRoot . 'respond/min.js');
  }
  else
  {
      if($cdnRoot)
      {
          echo '<link href="' . $cdnRoot . 'js/respond/cross-domain/respond-proxy.html" id="respond-proxy" rel="respond-proxy" />'; 
          echo '<link href="/js/respond/cross-domain/respond.proxy.gif" id="respond-redirect" rel="respond-redirect" />';
          js::import($jsRoot . 'html5shiv/min.js');
          js::import($jsRoot . 'respond/min.js');
          js::import($jsRoot . 'respond/cross-domain/respond.proxy.js');
      }
      else
      {
          js::import($jsRoot . 'all.ie8.js');
      }
  }
  ?>
  <![endif]-->
  <!--[if lt IE 10]>
  <?php
  if($config->debug)
  {
      js::import($jsRoot . 'jquery/placeholder/min.js');
  }
  else
  {
      js::import($jsRoot . 'all.ie9.js');
  }
  ?>
  <![endif]-->
  <?php
  js::set('lang', $lang->js);

  $baseCustom = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true) : array();
  if(!empty($baseCustom[$template][$theme]['js'])) js::execute($baseCustom[$template][$theme]['js']);

  if(!empty($config->oauth->sina) and !is_object($config->oauth->sina)) $sina = json_decode($config->oauth->sina);
  if(!empty($config->oauth->qq)   and !is_object($config->oauth->qq))   $qq   = json_decode($config->oauth->qq);
  if(!empty($sina->verification)) echo $sina->verification;
  if(!empty($qq->verification))   echo $qq->verification;
  if(!empty($sina->widget)) js::import('http://tjs.sjs.sinajs.cn/open/api/js/wb.js');

  $this->block->printRegion($layouts, 'all', 'header');
  ?>
</head>
<body>
