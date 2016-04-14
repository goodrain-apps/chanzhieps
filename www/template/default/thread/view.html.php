<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The view file of thread module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
include TPL_ROOT . 'common/header.html.php';
include TPL_ROOT . 'common/kindeditor.html.php';

echo "<div class='row blocks' data-grid='4' data-region='thread_view-top'>";
$this->block->printRegion($layouts, 'thread_view', 'top', true);
echo "</div>";

$common->printPositionBar($board, $thread);

if($pager->pageID == 1) include TPL_ROOT . 'thread/thread.html.php';
include TPL_ROOT . 'thread/reply.html.php';

echo "<div class='blocks' data-region='thread_view-bottom'>";
$this->block->printRegion($layouts, 'thread_view', 'bottom');
echo "</div>";

include TPL_ROOT . 'common/jplayer.html.php';
include TPL_ROOT . 'common/footer.html.php';
