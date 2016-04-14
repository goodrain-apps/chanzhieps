<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$webRoot            = $config->webRoot;
$jsRoot             = $webRoot . "js/";
$templateName       = $this->config->template->{$this->device}->name;
$themeName          = $this->config->template->{$this->device}->theme;
$templateRoot       = $webRoot . "template/{$templateName}/";
$templateThemeRoot  = $webRoot . "theme/{$templateName}/";
$templateCommonRoot = "{$templateThemeRoot}common/";
$thisModuleName     = $this->app->getModuleName();
$thisMethodName     = $this->app->getMethodName();
$sysURL             = $common->getSysURL();
?>
<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb" lang='<?php echo $app->getClientLang();?>' class='m-<?php echo $thisModuleName?> m-<?php echo $thisModuleName?>-<?php echo $thisMethodName?>'>
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta http-equiv="Cache-Control"  content="no-transform">
  <meta name="Generator" content="<?php echo 'chanzhi' . $this->config->version . ' www.chanzhi.org'; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if(isset($sourceURL)):?>
  <link rel="canonical" href="<?php echo $sysURL . $sourceURL;?>" >
  <?php elseif(isset($desktopURL)):?>
  <link rel="canonical" href="<?php echo $sysURL . $desktopURL;?>" >
  <?php endif;?>
  <?php if($thisModuleName == 'user' and $thisMethodName == 'deny'):?>
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
  js::set('lang', $lang->js);
  js::set('theme', array('template' => $templateName, 'theme' => $themeName, 'device' => $this->device));
  if($config->debug)
  {
      js::import($templateCommonRoot . 'js/mzui.all.min.js');
      js::import($templateCommonRoot . 'js/chanzhi.js');
      css::import($templateCommonRoot . 'css/mzui.min.css');
  }
  else
  {
      js::import($templateCommonRoot . 'js/mzui.all.min.js');
      js::import($templateCommonRoot . 'js/chanzhi.js');
      css::import($templateCommonRoot . 'css/mzui.min.css');
  }

  /* Import customed css file if it exists. */
  $siteCustomCssFile = $this->app->getDataRoot() . 'css' . DS . $config->site->code . '_' . $templateName . DS . $themeName . '.css';
  if($config->multi && file_exists($siteCustomCssFile))
  {
      css::import(sprintf($webRoot . 'data/css/%s/%s_%s.css?' . $this->config->template->customVersion, $config->site->code, $config->template->{$this->device}->name, $config->template->{$this->device}->theme), "id='themeStyle'");
  }
  else
  {
      $customCssFile = $this->app->getDataRoot() . 'css' . DS . $templateName . '_' . $themeName . '.css';
      if(file_exists($customCssFile)) css::import(sprintf($webRoot . 'data/css/%s_%s.css?' . $this->config->template->customVersion, $config->template->{$this->device}->name, $config->template->{$this->device}->theme), "id='themeStyle'");

  }

  if(isset($pageCSS)) css::internal($pageCSS);

  echo isset($this->config->site->favicon) ? html::icon(json_decode($this->config->site->favicon)->webPath) : file_exists($this->app->getWwwRoot() . 'favicon.ico') ? html::icon($webRoot . 'favicon.ico') : '';
  echo html::rss($this->createLink('rss', 'index', '', '', 'xml'), $config->site->name);
?>
<?php
if(!empty($config->oauth->sina)) $sina = json_decode($config->oauth->sina);
if(!empty($config->oauth->qq))   $qq   = json_decode($config->oauth->qq);
if(!empty($sina->verification)) echo $sina->verification;
if(!empty($qq->verification))   echo $qq->verification;
if(!empty($sina->widget)) js::import('http://tjs.sjs.sinajs.cn/open/api/js/wb.js');

$this->block->printRegion($layouts, 'all', 'header');
?>
</head>
<body class='with-appbar-top with-appbar-bottom with-appnav'>
