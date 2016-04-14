<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The admin browse view file of book module of chanzhiEPS.
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
<?php
$path = explode(',', $node->path);
js::set('path', $path);
js::set('confirmDelete', $lang->book->confirmDelete);
?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-book'></i> <?php echo $book->title;?></strong>
    <div class='panel-actions'>
      <form method='get' class='form-inline form-search ve-form'>
        <?php echo html::hidden('m', 'book');?>
        <?php echo html::hidden('f', 'search');?>
        <?php echo html::hidden('recTotal', isset($this->get->recTotal) ? $this->get->recTotal : 0);?>
        <?php echo html::hidden('recPerPage', isset($this->get->recPerPage) ? $this->get->recPerPage : 20);?>
        <?php echo html::hidden('pageID', isset($this->get->pageID) ? $this->get->pageID :  1);?>
        <div class='input-group'>
          <?php echo html::input('searchWord', $this->get->searchWord, "class='form-control search-query' placeholder='{$lang->book->inputArticleTitle}'");?>
          <span class='input-group-btn'>
            <?php echo html::submitButton($lang->search->common, 'btn btn-primary');?>
          </span>
        </div>
      </form>
      <?php commonModel::printLink('book', 'create', '', '<i class="icon-plus"></i> ' . $lang->book->createBook, "class='btn btn-primary'");?>
    </div>
  </div>
  <div class='panel-body'><div class='books'><?php echo $catalog;?></div></div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
