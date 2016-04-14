<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit book view file of book of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai<daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php 
$path = explode(',', $node->path);
js::set('path', $path);
?>
<div class="panel">
  <div class="panel-heading">
    <strong><i class="icon-edit"></i> <?php echo $lang->edit . $lang->book->typeList[$node->type];?></strong>
  </div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' class='form-inline' action='<?php echo inlink('edit', "nodeID=$node->id")?>'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-1'><?php echo $lang->book->author;?></th>
          <td class='w-p40'><?php echo html::input('author', $node->author, "class='form-control'");?></td>
          <td></td>
        </tr>
        <?php if($node->type != 'book'):?>
        <tr>
          <th><?php echo $lang->book->parent;?></th>
          <td><?php echo html::select('parent', $optionMenu, $node->parent, "class='chosen form-control'");?></td>
        </tr>
        <?php endif; ?>
        <tr>
          <th><?php echo $lang->book->title;?></th>
          <td colspan='2'>
            <div class='row order'>
              <div class="col-sm-<?php echo $node->type == 'book' ? '9' : '12';?>"><?php echo html::input('title', $node->title, 'class="form-control"');?></div>
              <?php if($node->type == 'book'):?>
              <div class='col-sm-3 order'>
                <div class='input-group'>
                  <span class="input-group-addon"><?php echo $lang->book->order;?></span>
                  <?php echo html::input('order', $node->order, "class='form-control'");?>
                </div>
              </div>
              <?php endif;?>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->book->alias;?></th>
          <td colspan='2'>
            <?php if($node->type == 'book'):?>
            <div class='required required-wrapper'></div>
            <?php endif;?>
            <div class='input-group text-1'>
              <span class='input-group-addon'>http://<?php echo $this->server->http_host . $config->webRoot?>book/id@</span>
              <?php echo html::input('alias', $node->alias, "class='form-control' placeholder='{$lang->alias}'");?>
              <span class='input-group-addon'>.html</span>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->book->keywords;?></th>
          <td colspan='2'><?php echo html::input('keywords', $node->keywords, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->book->summary;?></th>
          <td colspan='2'><?php echo html::textarea('summary', $node->summary, "class='form-control' rows='2'");?></td>
        </tr>
        <?php if($node->type == 'article'):?>
        <tr>
          <th><?php echo $lang->book->content;?></th>
          <td colspan='2' valign='middle'><?php echo html::textarea('content', htmlspecialchars($node->content), "rows='15' class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->book->addedDate;?></th>
          <td>
            <div class="input-append date">
              <?php echo html::input('addedDate', formatTime($node->addedDate), "class='form-control'");?>
              <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
            </div>
          </td>
          <td><span class="help-inline"><?php echo $lang->book->note->addedDate;?></span></td>
        </tr>
        <?php endif;?>
        <tr>
          <th></th>
          <td><?php echo html::submitButton() . html::hidden('referer', $this->server->http_referer);?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
