<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setCounts view file of score of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     Score
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php $common->printPositionBar();?>
<div class='article'>
  <section class='article-content'>
    <ul class='nav'>
      <?php foreach($config->score->methodOptions as $item => $type):?>
      <li><?php echo $lang->score->methods[$item] . zget($lang->score->methods, $type, '') . ' <strong>' . zget($this->config->score->counts, $item, '0') . '</strong>';?></li>
      <?php endforeach;?>
    </ul>
  </section>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>

