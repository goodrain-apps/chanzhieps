<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit view file of article module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php js::set('confirmReject', $lang->article->confirmReject);?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->submittion->check;?></strong></div>
  <div class='panel-body'>
  <form method='post' id='ajaxForm' class='ve-form'>
    <table class='table table-form'>
      <tbody class='articleInfo'>
      <tr>
        <th><?php echo $lang->article->author;?></th>
        <td><?php echo $article->author;?></td>
      </tr>
      <tr>
        <th><?php echo $lang->article->source;?></th>
        <td>
          <?php echo zget($lang->article->sourceList, $article->source);?>
          <?php echo $article->copySite . $article->copyURL;?>
        </td>
      </tr>
      </tbody>
      <tr>
        <th><?php echo $lang->article->title;?></th>
        <td colspan='2'><?php echo $article->title;?> </td>
      </tr>
      <tbody class='articleInfo'>
      <tr>
        <th><?php echo $lang->article->keywords;?></th>
        <td colspan='2'><?php echo $article->keywords;?></td>
      </tr>
      <tr>
        <th><?php echo $lang->article->summary;?></th>
        <td colspan='2'><?php echo $article->summary?></td>
      </tr>
      </tbody>
      <tbody class='articleInfo'>
      <tr>
        <th><?php echo $lang->article->content;?></th>
        <td colspan='2'><?php echo $article->content;?></td>
      </tr>
      </tbody>
      <tr>
        <th class='w-100px'><?php echo $lang->article->type;?></th>
        <td><?php echo html::radio("type", $lang->submittion->typeList, 'article');?></td><td></td>
      </tr>
      <tr>
        <th class='w-100px'><?php echo $lang->article->category;?></th>
        <td class='articleTD'><?php echo html::select("articleCategories[]", $articleCategories, array_keys($article->categories), "multiple='multiple' class='form-control chosen'");?></td>
        <td class='blogTD'><?php echo html::select("blogCategories[]", $blogCategories, array_keys($article->categories), "multiple='multiple' class='form-control chosen'");?></td>
      </tr>
      <tr>
        <th></th><td colspan='2'><?php echo html::submitButton($lang->submittion->publish) . html::a(inlink('reject', "id={$article->id}"), $lang->submittion->reject, "class='btn btn-warning rejecter'");?></td>
      </tr>
    </table>
  </form>
  </div>
</div>

<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/footer.admin.html.php';?>
