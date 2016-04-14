<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setupload  view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setRobots;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
       <tr>
          <td><?php echo html::textarea('robots', $robots, "rows='4' class='form-control'");?></td>
        </tr>
        <tr>
          <td>
            <?php if($writeable):?>
            <?php echo html::submitButton();?>
            <?php else:?>
            <div class='text-danger'><?php printf($lang->site->robotsUnwriteable, $robotsFile);?>
            <?php echo html::a('javascript:location.reload();', $lang->site->reloadForRobots, "class='btn btn-primary btn-sm'");?>
            </div>
            <?php endif;?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
