<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The post view file of thread module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'common/kindeditor.html.php';?>

<?php $common->printPositionBar($board);?>
<?php
$colorPlates = '';
foreach (explode('|', $lang->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>

<div class='panel panel-form'>
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->thread->postTo . ' [ ' . $board->name . ' ]'; ?></strong></div>
  <div class='panel-body'>
    <form method='post' class='form-horizontal' id='threadForm' enctype='multipart/form-data'>
      <div class='form-group'>
        <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->title;?></label>
        <div class='col-md-11 col-sm-10'>
          <?php if($canManage):?>
          <div class='input-group'>
            <?php echo html::input($titleInput, '', "class='form-control'");?>
            <div class='input-group-addon colorplate clearfix'>
              <div class='input-group color active' data=''>
                <label class='input-group-addon'><?php echo $lang->color;?></label>
                <?php echo html::input('color', '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                <span class='input-group-btn'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'> <i class='icon icon-question'></i> <span class='caret'></span></button>
                  <div class='dropdown-menu colors'>
                    <?php echo $colorPlates; ?>
                  </div>
                </span>
              </div>
            </div>
            <?php if($this->app->user->admin == 'super'):?>
            <span class='input-group-addon'>
              <label class='checkbox'>
                <?php echo "<input type='checkbox' name='isLink' id='isLink' value='1'/><span>{$lang->thread->isLink}</span>" ?>
              </label>
            </span>
            <?php endif;?>
            <span class='input-group-addon threadInfo'>
              <label class='checkbox'>
                <?php echo "<input type='checkbox' name='readonly' value='1'/><span>{$lang->thread->readonly}</span>" ?>
              </label>
            </span>
          </div>
          <?php else:?>
          <?php echo html::input($titleInput, '', "class='form-control'");?>
          <?php endif;?>
        </div>
      </div>
      <div class='threadInfo'>
        <div class='form-group'>
          <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->content;?></label>
          <div class='col-md-11 col-sm-10'><?php echo html::textarea($contentInput, '', "rows='15' class='form-control'");?></div>
        </div>
        <?php if($this->loadModel('file')->canUpload()):?>
        <div class='form-group'>
          <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->file;?></label>
          <div class='col-md-7 col-sm-8 col-xs-11'><?php echo $this->fetch('file', 'buildForm');?></div>
        </div>
        <?php endif;?>
        <?php if(zget($this->config->site, 'captcha', 'auto') == 'open'):?>
        <div class='form-group' id='captchaBox'>
        <?php echo $this->loadModel('guarder')->create4thread();?>
        </div>
        <?php else:?>
        <div class='form-group hiding' id='captchaBox'></div>
        <?php endif;?>
      </div>
      <?php if($this->app->user->admin == 'super'):?>
      <div class='form-group link'>
        <label class='col-md-1 col-sm-2 control-label'><?php echo $lang->thread->link;?></label>
        <div class='col-md-11 col-sm-10 required'><?php echo html::input('link', '', "class='form-control' placeholder='{$lang->thread->placeholder->link}'");?></div>
      </div>
      <?php endif;?>
      <div class='form-group'>
        <label class='col-md-1 col-sm-2'></label>
        <div class='col-md-11 col-sm-10'><?php echo html::submitButton();?></div>
      </div>
    </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
