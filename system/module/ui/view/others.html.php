<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The logo view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-cogs'> </i><?php echo $lang->ui->others;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' enctype='multipart/form-data'>
      <table class='table table-form w-p60'>
        <?php if(strpos($this->config->site->modules, 'product') !== false):?>
        <tr>
          <th class='w-200px'><?php echo $lang->ui->productView;?></th>
          <td class='w-p30'><?php echo html::radio('productView', $lang->ui->productViewList, isset($this->config->ui->productView) ? $this->config->ui->productView : '1');?></td><td></td>
        </tr>
        <?php endif;?>
        <tr>
          <th class='w-200px'><?php echo $lang->ui->QRCode;?></th>
          <td class='w-p30'><?php echo html::radio('QRCode', $lang->ui->QRCodeList, isset($this->config->ui->QRCode) ? $this->config->ui->QRCode : '1');?></td><td></td>
        </tr>
        <?php if(strpos($this->config->site->modules, 'article') !== false):?>
        <tr>
          <th><?php echo $lang->site->customizableList->article;?></th> 
          <td><?php echo html::input('articleRec', !empty($this->config->site->articleRec) ? $this->config->site->articleRec : $this->config->article->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <?php if(strpos($this->config->site->modules, 'product') !== false):?>
        <tr>
          <th><?php echo $lang->site->customizableList->product;?></th> 
          <td><?php echo html::input('productRec', !empty($this->config->site->productRec) ? $this->config->site->productRec : $this->config->product->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <?php if(strpos($this->config->site->modules, 'blog') !== false):?>
        <tr>
          <th><?php echo $lang->site->customizableList->blog;?></th> 
          <td><?php echo html::input('blogRec', !empty($this->config->site->blogRec) ? $this->config->site->blogRec : $this->config->blog->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <?php if(strpos($this->config->site->modules, 'message') !== false):?>
        <tr>
          <th><?php echo $lang->site->customizableList->message;?></th> 
          <td><?php echo html::input('messageRec', !empty($this->config->site->messageRec) ? $this->config->site->messageRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->customizableList->comment;?></th> 
          <td><?php echo html::input('commentRec', !empty($this->config->site->commentRec) ? $this->config->site->commentRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <?php if(strpos($this->config->site->modules, 'forum') !== false):?>
        <tr>
          <th><?php echo $lang->site->customizableList->forum;?></th> 
          <td><?php echo html::input('forumRec', !empty($this->config->site->forumRec) ? $this->config->site->forumRec : $this->config->forum->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->customizableList->reply;?></th> 
          <td><?php echo html::input('replyRec', !empty($this->config->site->replyRec) ? $this->config->site->replyRec : $this->config->reply->recPerPage, "class='form-control'");?></td><td></td>
        </tr>
        <?php endif;?>
        <tr>
          <th><?php echo $lang->site->setImageSize;?></th>
          <td colspan='2'>
            <?php foreach($this->config->file->thumbs as $key => $thumb):?> 
            <div class='input-group' style='margin-bottom: 10px'>
              <span class='input-group-addon'><?php echo $lang->site->imageSize[$key];?></span>
              <span class='input-group-addon'><?php echo $lang->site->image['width'];?></span>
              <?php echo html::input("thumbs[$key][width]", $thumb['width'], "class='form-control' placeholder='{$thumb['width']}'");?>
              <span class="input-group-addon">px</span>
              <span class='input-group-addon fix-border'><?php echo $lang->site->image['height'];?></span>
              <?php echo html::input("thumbs[$key][height]", $thumb['height'], "class='form-control' placeholder='{$thumb['height']}'");?>
              <span class="input-group-addon">px</span>
            </div>
            <?php endforeach;?>
          </td>
        </tr>
        <tr><th></th><td colspan='2'><?php echo html::submitButton();?></td></tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
