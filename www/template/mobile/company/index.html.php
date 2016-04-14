<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The aboutus view file of company for mobile template of chanzhiEPS.
 * The view should be used as ajax content
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
<div class='block-region region-top no-padding blocks' data-region='company_index-top'><?php $this->block->printRegion($layouts, 'company_index', 'top');?></div>
<div class='article-content' id='company'>
  <?php echo $company->content;?>
</div>
<div class='block-region region-bottom no-padding blocks' data-region='company_index-bottom'><?php $this->block->printRegion($layouts, 'company_index', 'bottom');?></div>
