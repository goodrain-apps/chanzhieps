<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The create view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<?php
js::set('type', $type);

$colorPlates = '';
foreach (explode('|', $lang->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>
<form method='post' id='createForm' class='blockForm ve-form'>
<div class='panel'>
  <div class='panel-heading'>
    <ul class='nav nav-tabs'>
      <li><a href='#contentTab' data-toggle='tab'><?php echo $lang->block->content;?></a></li>
      <?php if(strpos(',htmlcode, phpcode, slide, header', $type) == false or $type == 'html'):?>
      <li><a href='#customTab' data-toggle='tab'><?php echo $lang->block->style;?></a></li>
      <?php endif;?>
      <li><a href='#cssTab' data-toggle='tab'><?php echo $lang->ui->theme->extraStyle; ?></a></li>
      <li><a href='#jsTab' data-toggle='tab'><?php echo $lang->ui->theme->extraScript; ?></a></li>
    </ul>
  </div>
  <div class='panel-body'>
    <div class='table-row'>
      <div class='tab-content table-cell col-xs-6'>
        <div class='tab-pane theme-control-tab-pane' id='contentTab'>
          <table align='center' class='table table-form'>
            <tr>
              <th class='w-100px'><?php echo $lang->block->type;?></th>
              <td><?php echo $this->block->createTypeSelector($template, $type);?></td>
            </tr>
            <tr>
              <th><?php echo $lang->block->title;?></th>
              <td id='titleTDCell'>
                <div class='row'>
                  <div class='col-sm-6'><?php echo html::input('title', strpos(',html,htmlcode,featuredProduct,', $type) == false ? $lang->block->$template->typeList[$type] : '', "class='form-control'");?></div>
                </div>
              </td>
            </tr>
            <?php if(isset($config->block->defaultIcons[$type])):?>
            <tr>
              <th><?php echo $lang->block->icon;?></th>
              <td>
                <div class='row'>
                  <div class='col-sm-6'><?php echo html::select('params[icon]', '', '', "class='chosen-icons' data-value='{$config->block->defaultIcons[$type]}'");?></div>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <?php echo $this->fetch('block', 'blockForm', 'type=' . $type);?>
            <?php if(isset($config->block->defaultMoreUrl[$type])):?>
            <tr>
              <th><?php echo $lang->block->moreLink;?></th>
              <td>
                <div class='input-group'>
                  <?php echo html::input('params[moreText]', $lang->more, "class='form-control'  placeholder='{$lang->block->placeholder->moreText}'");?>
                  <span class="input-group-addon fix-border"><i class="icon icon-link"></i></span>
                  <?php echo html::input('params[moreUrl]', $config->block->defaultMoreUrl[$type], "class='form-control' placeholder='{$lang->block->placeholder->moreUrl}'");?>
              </td>
            </tr>
            <?php endif;?>
            <tbody id='blockForm'></tbody>
          </table>
        </div>
        <?php if(strpos(',htmlcode, phpcode, slide, header', $type) == false or $type == 'html'):?>
        <div class='tab-pane theme-control-tab-pane' id='customTab'>
          <table class='table table-form mg-0'>
            <?php if(isset($config->block->defaultIcons[$type])):?>
            <tr>
              <th class='w-80px'><?php echo $lang->block->icon;?></th>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->iconColor) ? $block->content->iconColor : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->iconColor;?> <span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][iconColor]", '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <tr>
              <th class='w-80px'><?php echo $lang->block->border;?></th>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->borderColor) ? $block->content->borderColor : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->borderColor;?><span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][borderColor]", isset($block->content->borderColor) ? $block->content->borderColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
            </tr>
            <?php if($type == 'html'):?>
            <tr>
              <th class='w-80px'><?php echo $lang->block->padding;?></th>
              <td colspan='2'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->block->paddingTop;?></span>
                  <?php echo html::input("params[custom][$theme][paddingTop]", '', "class='form-control' placeholder='{$lang->block->placeholder->padding}'");?>
                  <span class='input-group-addon fix-border'><?php echo $lang->block->paddingRight;?></span>
                  <?php echo html::input("params[custom][$theme][paddingRight]", '', "class='form-control' placeholder='{$lang->block->placeholder->padding}'");?>
                  <span class='input-group-addon fix-border'><?php echo $lang->block->paddingBottom;?></span>
                  <?php echo html::input("params[custom][$theme][paddingBottom]", '', "class='form-control' placeholder='{$lang->block->placeholder->padding}'");?>
                  <span class='input-group-addon fix-border'><?php echo $lang->block->paddingLeft;?></span>
                  <?php echo html::input("params[custom][$theme][paddingLeft]", '', "class='form-control' placeholder='{$lang->block->placeholder->padding}'");?>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <?php if($type != 'featuredProduct'):?>
            <tr>
              <th class='w-80px'><?php echo $lang->block->heading;?></th>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->titleColor) ? $block->content->titleColor : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->textColor;?> <span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][titleColor]", '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->titleBackground) ? $block->content->titleBackground : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->backgroundColor;?> <span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][titleBackground]", '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <?php if($type != 'followUs'):?>
            <tr>
              <th rowspan='2' class='w-80px'><?php echo $lang->block->content;?></th>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->textColor) ? $block->content->textColor : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->textColor;?> <span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][textColor]", '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->linkColor) ? $block->content->linkColor : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->linkColor;?> <span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][linkColor]", '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class='colorplate'>
                  <div class='input-group color active' data="<?php echo isset($block->content->backgroundColor) ? $block->content->backgroundColor : ''?>">
                    <span class='input-group-btn'>
                      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>
                        <?php echo $lang->block->backgroundColor;?> <span class='caret'></span>
                      </button>
                      <div class='dropdown-menu colors'><?php echo $colorPlates; ?></div>
                    </span>
                    <?php echo html::input("params[custom][$theme][backgroundColor]", '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                  </div>
                </div>
              </td>
            </tr>
            <?php endif;?>
            <tr>
              <th><?php echo $lang->block->class;?></th>
              <td><?php echo html::input('params[class]', '', "class='form-control' placeholder='{$lang->block->placeholder->class}'");?></td>
            </tr>
          </table>
        </div>
        <?php endif;?>
        <div class='tab-pane theme-control-tab-pane' id='cssTab'>
          <?php echo html::textarea('css', isset($block->content->custom->$theme->css) ? $block->content->custom->$theme->css : '', "rows=20 class='form-control codeeditor' data-mode='css' data-height='350'");?>
          <p class='text-info text-tip'><?php echo $lang->block->placeholder->customStyleTip;?></p>
        </div>
        <div class='tab-pane theme-control-tab-pane' id='jsTab'>
          <?php echo html::textarea('js', isset($block->content->custom->$theme->js) ? $block->content->custom->$theme->js : '', "rows=20 class='form-control codeeditor' data-mode='javascript' data-height='350'");?>
          <?php $device = helper::getDevice();?>
          <?php if($device == 'mobile'):?><p class='text-info text-tip'><?php echo $lang->block->placeholder->mobileCustomScriptTip;?></p><?php endif;?>
          <?php if($device == 'desktop'):?><p class='text-info text-tip'><?php echo $lang->block->placeholder->desktopCustomScriptTip;?></p><?php endif;?>
        </div>
      </div>
      <?php if(strpos(',htmlcode, phpcode, slide, header', $type) == false or $type == 'html'):?>
      <div id='panelPreview' class='panel-preview table-cell'>
        <div class='heading'><strong><?php echo $lang->block->preview?></strong></div>
        <div class='panel panel-block'>
          <div class='panel-heading'><i class='icon-heart-empty icon'></i> <strong class='title'><?php echo $lang->block->title;?></strong></div>
          <div class='panel-body text-center'><?php echo $lang->block->textExample;?></div>
        </div>
      </div>
      <?php endif;?>
    </div>
    <div class='form-footer'>
      <?php echo html::submitButton();?>
      <?php echo html::a($this->createLink('guarder', 'validate', "url=&target=modal&account=&type=okFile"), $lang->save, "data-toggle='modal' class='hidden captchaModal'")?></th>
      <?php echo html::a($this->session->blockList, $this->lang->goback, "class='btn btn-default'");?>
    </div>
  </div>
</div>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
