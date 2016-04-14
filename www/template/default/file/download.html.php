<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The html template file of download method of file module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoCMS
 * @version     $Id$
 */
include TPL_ROOT . 'common/header.lite.html.php';
?>
<div class='row' style='margin-top:100px'>
  <div class='col-md-8 col-md-offset-2'>
  <?php echo $this->fetch('score', 'noscore', array('method' => 'download', 'score' => $score));?>
  </div>
</div>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>
</body>
</html>
