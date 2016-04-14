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
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('type',$type);?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $type == 'blog' ? $lang->blog->edit : ($type == 'page' ? $lang->page->edit : $lang->article->edit);?></strong></div>
  <div class='panel-body'>
  <form method='post' id='ajaxForm' class='ve-form'>
    <table class='table table-form'>
      <?php if($type != 'page'):?>
      <tr>
        <th class='w-100px'><?php echo $lang->article->category;?></th>
        <td class='w-p40'><?php echo html::select("categories[]", $categories, array_keys($article->categories), "multiple='multiple' class='form-control chosen'");?></td><td></td>
      </tr>
      <tbody class='articleInfo'>
      <tr>
        <th><?php echo $lang->article->author;?></th>
        <td><?php echo html::input('author', $article->author, "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->article->source;?></th>
        <?php if($article->source != 'article') array_pop($lang->article->sourceList);?>
        <td><?php echo html::select('source', $lang->article->sourceList, $article->source, "class='form-control chosen'");?></td>
        <td>
          <div id='copyBox' class='row'>
            <div class='col-sm-4'><?php echo html::input('copySite', $article->copySite, "class='form-control' placeholder='{$lang->article->copySite}'"); ?> </div>
            <div class='col-sm-8'><?php echo html::input('copyURL',  $article->copyURL, "class='form-control' placeholder='{$lang->article->copyURL}'"); ?></div>
          </div>
        </td>
      </tr>
      </tbody>
      <?php endif; ?>
        <tr>
          <th class='w-100px'><?php echo $lang->article->title;?></th>
          <td colspan='2'>
            <div class='row order input-group'>
              <div class="col-sm-<?php echo $type == 'page' ? '9' : '12';?>"><?php echo html::input('title', $article->title, "class='form-control'");?></div>
              <?php if($type == 'page'):?>
              <div class='col-sm-3 order'>
                <div class='input-group'>
                  <span class="input-group-addon"><?php echo $lang->article->order;?></span>
                  <?php echo html::input('order', $article->order == '0' ? $article->id : $article->order, "class='form-control'");?>
                </div>
              </div>
              <?php endif;?>
              <span class="input-group-addon w-70px">
                <label class='checkbox'>
                <?php $checked = $article->link ? 'checked' : '';?>
                <?php echo "<input type='checkbox' name='isLink' id='isLink' value='1' {$checked}/><span>{$lang->article->isLink}</span>" ?>
                </label>
              </span>
            </div>
          </td>
        </tr>
      <tr class='link'>
        <th><?php echo $lang->article->link;?></th>
        <td colspan='2'>
          <div class='required required-wrapper'></div>
          <?php echo html::input('link', $article->link, "class='form-control' placeholder='{$lang->article->placeholder->link}'");?>
        </td>
      </tr>
      <tbody class='articleInfo'>
      <tr>
        <th><?php echo $lang->article->alias;?></th>
        <td colspan='2'>
          <div class='input-group'>
            <?php if($type == 'page'):?>
            <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>page/</span>
            <?php else:?>
            <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot . $type?>/id_</span>
            <?php endif;?>
            <?php echo html::input('alias', $article->alias, "class='form-control' placeholder='{$lang->alias}'");?>
            <span class='input-group-addon w-70px'>.html</span>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->article->keywords;?></th>
        <td colspan='2'> <?php echo html::input('keywords', $article->keywords, "class='form-control' placeholder='{$lang->keywordsHolder}'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->article->summary;?></th>
        <td colspan='2'><?php echo html::textarea('summary', $article->summary, "rows='2' class='form-control'");?></td>
      </tr>
      </tbody>
      <tbody class='articleInfo'>
      <tr>
        <th><?php echo $lang->article->content;?></th>
        <td colspan='2'><?php echo html::textarea('content', htmlspecialchars($article->content), "rows='10' class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->article->addedDate;?></th>
        <td>
          <div class='input-append date'>
            <?php echo html::input('addedDate', formatTime($article->addedDate), "class='form-control'");?>
            <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
          </div>
        </td>
        <td><span class='help-inline'><?php echo $lang->article->placeholder->addedDate;?></span></td>
      </tr>
      <tr>
        <th><?php echo $lang->article->status;?></th>
        <td><?php echo html::radio('status', $lang->article->statusList, $article->status);?></td>
      </tr>
      </tbody>
      <tr>
        <th></th><td colspan='2'><?php echo html::submitButton();?></td>
      </tr>
    </table>
  </form>
  </div>
</div>

<?php include '../../common/view/treeview.html.php';?>
<?php include '../../common/view/footer.admin.html.php';?>
