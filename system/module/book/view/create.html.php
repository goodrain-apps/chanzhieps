<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The create book view file of book of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai<daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php'; ?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-plust'></i> <?php echo $lang->book->createBook;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->book->author;?></th>
          <td><?php echo html::input('author', $app->user->realname, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><span><?php echo $lang->book->title;?></span></th>
          <td>
            <div class='required required-wrapper'></div>
            <?php echo html::input('title', '', 'class=form-control');?>
          </td>
        </tr>
        <tr>
          <th><span><?php echo $lang->book->alias;?></span></th>
          <td>
            <div class='required required-wrapper'></div>
            <div class='input-group'>
              <span class='input-group-addon'>http://<?php echo $this->server->http_host . $config->webRoot?>book/</span>
              <?php echo html::input('alias', '', "class='form-control' placeholder='{$lang->alias}'");?>
              <span class='input-group-addon'>.html</span>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->book->keywords;?></th>
          <td><?php echo html::input('keywords', '', 'class=form-control');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->book->summary;?></th>
          <td><?php echo html::textarea('summary', '', "class='form-control' rows='3'");?></td>
        </tr>
        <tr>
          <th></th><td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>


<?php include '../../common/view/footer.admin.html.php';?>
