<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The logo view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-certificate'></i><?php echo $lang->ui->setLogo;?></strong>
  </div>
  <div class='panel-body row row-logo'>
    <form method='post' id='ajaxForm' enctype='multipart/form-data'>
      <div class='col-md-6'>
        <div class='box'>
        <div class='card'>
        <?php if(isset($logo->webPath)) echo html::a('javascript:;', html::image($logo->webPath, "class='logo'"), "class='btn-upload'");?>
        <?php if(!isset($logo->webPath)) echo html::a('javascript:;', $lang->ui->uploadLogo, "class='text-lg btn-upload'");?>
        </div>
        <span class='actions'>
        <?php if(isset($logo->webPath)) echo html::a('javascript:;', "<i class='icon icon-lg icon-edit-sign'> </i>", "class='text-info btn-editor'");?>
        <?php if(isset($logo->webPath)) commonModel::printLink('ui', 'deleteLogo', '', "<i class='icon icon-lg icon-remove-sign'> </i>", "class='text-danger btn-deleter'");?>
        </span>
        <div class='text-important'>
          <?php if($this->device == 'desktop') printf($lang->ui->suitableLogoSize, '50px-80px', '80px-240px');?>
          <?php if($this->device == 'mobile') printf($lang->ui->suitableLogoSize, '<50px', '50px-200px');?>
          <div class='hide'><?php echo html::file('logo', "class='form-control'");?></div>
        </div>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='box'>
        <div class='card'>
          <?php if(isset($favicon->webPath)) echo html::a('javascript:;', html::image($favicon->webPath, "class='favicon'"), "class='btn-upload'");?>
          <?php if(!isset($favicon->webPath)) echo html::a('javascript:;', $lang->ui->uploadFavicon, "class='text-lg btn-upload'");?>
        </div>
        <span class='actions'>
          <?php if(isset($favicon->webPath)) echo html::a('javascript:;', "<i class='icon icon-lg icon-edit-sign'> </i>", "class='text-info btn-editor'");?>
          <?php if($favicon or $defaultFavicon) commonModel::printLink('ui', 'deleteFavicon', '', "<i class='icon icon-lg icon-remove-sign'> </i>", "class='text-danger btn-deleter'");?>
        </span>

        <div class='text-important'>
        <?php printf($lang->ui->faviconHelp, "http://api.chanzhi.org/goto.php?item=help_favicon");?>
        </div>
        <div class='hide'><?php echo html::file('favicon', "class='form-control'");?></div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
