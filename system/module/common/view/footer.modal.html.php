<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The common modal footer view file of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     RanZhi
 * @version     $Id$
 * @link        http://www.ranzhi.org
 */
?>
<?php if(helper::isAjaxRequest()):?>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<?php else:?>
<?php if(RUN_MODE == 'front') include 'footer.html.php'; ?>
<?php if(RUN_MODE == 'admin') include 'footer.admin.html.php'; ?>
<?php endif;?>
