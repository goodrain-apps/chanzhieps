<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setresponse view file of wechat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
$webRoot = $config->webRoot;
$jsRoot  = $webRoot . "js/";
if(isset($pageCSS)) css::internal($pageCSS);
include '../../common/view/chosen.html.php';
?>
<?php if($group == 'menu'):?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-plus"></i> <?php echo $lang->wechat->response->set;?></strong>
  </div>
  <div class='panel-body'>
<?php else:?>
<div class='modal-dialog w-800px'>
  <div class='modal-content'>
    <div class='modal-header'>
      <?php echo html::closeButton();?>
      <h4 class='modal-title'><i class="icon-plus"></i> <?php echo $group ? $lang->wechat->response->set : $lang->wechat->response->keywords;?></h4>
    </div>
    <div class='modal-body'>
<?php endif;?>
      <form method='post' action='<?php echo inlink('setresponse', "public={$public}&group={$group}&key={$key}");?>' id='responseForm'>
        <table class='table table-form'>
          <?php if($group == ''):?>
          <tr>
            <th class='w-100px'><?php echo $lang->wechat->response->keywords;?></th>
            <td class='w-220px'><?php echo html::input('key', isset($response->key) ? $response->key : '', "class='form-control'");?></td>
            <td></td>
          </tr>
          <?php endif;?>
          <tr>
            <th class='w-100px'><?php echo $lang->wechat->response->type;?></th>
            <td class='w-220px'><?php echo html::select('type', $lang->wechat->response->typeList,  isset($response->type) ? $response->type : '', "class='form-control'");?></td>
            <td></td>
          </tr>

          <tr class='link'>
            <th><?php echo $lang->wechat->response->module;?></th>
            <td colspan='2'>
              <div class='form-group'>
                <div class='col-sm-3'>
                  <?php echo html::select('source', $moduleList, isset($response->source) ? $response->source : '', "class='form-control'");?>
                </div>
                <div class='col-sm-9 manual'><?php echo html::input('content', (isset($response->source) and $response->source == 'manual') ? $response->content : '', "class='form-control'");?></div>
              </div>
            </td>
          </tr>

          <tr class='text'>
            <th><?php echo $lang->wechat->response->block;?></th>
            <td colspan='2'>
              <div class='form-group'>
                <div class='col-sm-3'><?php echo html::select('source', $this->lang->wechat->response->textBlockList, (isset($response->source) and $response->source != 'manual') ? $response->source : 'manual', "class='form-control'");?></div>
                <div class='col-sm-10 manual'><?php echo html::textarea('content', (isset($response->source) and $response->source == 'manual') ? $response->content : '', "class='form-control' rows='5'");?></div>
              </div>
            </td>
          </tr>

          <tr class='news'>
            <th><?php echo $lang->wechat->response->block;?></th>
            <td>
            <?php echo html::select('block', $this->lang->wechat->response->newsBlockList, (isset($response->type) and $response->type == 'news') ? $response->params->block : '', "class='form-control newsBlock'");?>
            </td>
            <td>
              <div class='form-group'>
                <div class='col-sm-7'>
                  <span class='articleTree'>
                    <?php echo html::select('category[]', $articleTree, isset($response->params) ? $response->params->category : '', "class='form-control chosen' multiple='multiple' data-placeholder='{$lang->wechat->placeholder->category}'");?>
                  </span>
                  <span class='productTree'>
                    <?php echo html::select('category[]', $productTree, isset($response->params) ? $response->params->category : '', "class='form-control chosen' multiple='multiple' data-placeholder='{$lang->wechat->placeholder->category}'");?>
                  </span>
                </div>
                <div class='col-sm-4'><?php echo html::input('limit', isset($response->params) ? $response->params->limit : '', "class='form-control' placeholder='{$lang->wechat->placeholder->limit}'");?></div>
              </div>
            </td>
          </tr>

          <tr>
            <th></th>
            <td>
              <?php echo html::submitButton();?>
              <?php echo html::hidden('group', $group);?>
              <?php if($group and $key) echo html::hidden('key', $key);?>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
