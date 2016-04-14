<?php if(!defined("RUN_MODE")) die();?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'common/datepicker.html.php';?>
<?php include TPL_ROOT . 'common/kindeditor.html.php';?>
<?php include TPL_ROOT . 'common/chosen.html.php';?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->article->edit;?></strong></div>
        <div class='panel-body'>
        <form method='post' id='ajaxForm' class='ve-form'>
          <table class='table table-form'>
            <tbody class='articleInfo'>
            <tr>
              <th class='w-100px'><?php echo $lang->article->author;?></th>
              <td><?php echo html::input('author', $article->author, "class='form-control w-150px'");?></td>
            </tr>
            <tr>
              <th><?php echo $lang->article->source;?></th>
              <td class='w-100px'><?php echo html::select('source', $lang->article->sourceList, $article->source, "class='form-control chosen'");?></td>
              <td>
                <div id='copyBox' class='row'>
                  <div class='col-sm-4'><?php echo html::input('copySite', $article->copySite, "class='form-control' placeholder='{$lang->article->copySite}'"); ?> </div>
                  <div class='col-sm-8'><?php echo html::input('copyURL',  $article->copyURL, "class='form-control' placeholder='{$lang->article->copyURL}'"); ?></div>
                </div>
              </td>
            </tr>
            </tbody>
            <tr>
              <th><?php echo $lang->article->title;?></th>
              <td colspan='2'>
                <div class='input-group'>
                  <?php echo html::input('title', $article->title, "class='form-control'");?>
                </div>
              </td>
            <tbody class='articleInfo'>
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
            </tbody>
            <tr>
              <th></th><td colspan='2'><?php echo html::submitButton();?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
