<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The index view file for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     index
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>

<div id='focus'>
  <div id='focusTop' class='block-region blocks focus-top' data-region='index_index-top'>
    <?php $this->block->printRegion($layouts, 'index_index', 'top', false);?>
  </div>
  <div id='focusMiddle' class='block-region blocks focus-middle' data-region='index_index-middle'>
    <?php $this->block->printRegion($layouts, 'index_index', 'middle', false);?>
  </div>
  <div id='focusBottom' class='block-region blocks focus-bottom' data-region='index_index-bottom'>
    <?php $this->block->printRegion($layouts, 'index_index', 'bottom', false);?>
  </div>
</div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
