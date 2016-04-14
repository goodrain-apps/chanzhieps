<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The create view file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<?php js::set('key', 1);?>
<?php js::set('categoryID', $categoryID);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-plus"></i> <?php echo $lang->product->create;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->product->category;?></th>
          <td class='w-p40'><?php echo html::select("categories[]", $categories, $categoryID, "multiple='multiple' class='form-control chosen'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->name;?></th>
          <td colspan='2'>
            <div class='row order'>
              <div class='col-sm-9'><?php echo html::input('name', '', "class='form-control'");?></div>
              <div class='col-sm-3'>
                <div class="input-group">
                  <span class="input-group-addon"><?php echo $lang->product->order;?></span>
                  <?php echo html::input('order', $order, "class='form-control'");?>
                  <span class="input-group-addon">
                    <label class='checkbox'>
                      <?php $checked = (isset($currentCategory->unsaleable) and $currentCategory->unsaleable) ? 'checked' : '';?>
                      <input type='checkbox' name='unsaleable' id='unsaleable' value='1' <?php echo $checked;?> />
                      <span><?php echo $lang->product->unsaleable;?></span>
                    </label>
                  </span>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->product->alias;?></th>
          <td colspan='2'>
            <div class="input-group">
              <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>product/id_</span>
              <?php echo html::input('alias', '', "class='form-control' placeholder='{$lang->alias}'");?>
              <span class="input-group-addon">.html</span>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->product->mall;?></th>
          <td colspan='2'><?php echo html::input('mall', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->keywords;?></th>
          <td colspan='2'><?php echo html::input('keywords', '', "class='form-control' placeholder='{$lang->keywordsHolder}'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->desc;?></th>
          <td colspan='2'><?php echo html::textarea('desc', '', "rows='2' class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->content;?></th>
          <td colspan='2'><?php echo html::textarea('content', '', "rows='10' class='form-control'");?></td>
        </tr>
        <tr>
          <th rowspan='4'><?php echo $lang->product->attribute?></th>
          <td colspan='2'>
            <div class="row form-group">
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->brand;?></span>
                  <?php echo html::input('brand', '', "class='form-control'");?>
                </div>
              </div>
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->model;?></span>
                  <?php echo html::input('model', '', "class='form-control'");?>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class="row form-group">
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->color;?></span>
                  <?php echo html::input('color', '', "class='form-control'");?>
                </div>
              </div>
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->amount;?></span>
                  <?php echo html::input('amount', '', "class='form-control'");?>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class="row form-group">
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->origin;?></span>
                  <?php echo html::input('origin', '', "class='form-control'");?>
                </div>
              </div>
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->unit;?></span>
                  <?php echo html::input('unit', '', "class='form-control'");?>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class="row form-group">
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->price;?></span>
                  <?php echo html::input('price', '', "class='form-control'");?>
                </div>
              </div>
              <div class='col-sm-6 col-md-6'>
                <div class='input-group'>
                  <span class='input-group-addon'><?php echo $lang->product->promotion;?></span>
                  <?php echo html::input('promotion', '', "class='form-control'");?>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->product->custom;?></th>
          <td colspan='2'>
            <div class='row form-group'>
              <div class="col-xs-3"> <?php echo html::input('label[0]', '', "class='form-control' placeholder='{$lang->product->placeholder->label}'" )?></div>
              <div class="col-xs-9">
                <div class='input-group'>
                <?php echo html::input('value[0]', '', "class='form-control' placeholder='{$lang->product->placeholder->value}'" )?>
                <span class='input-group-addon'><i class='icon-plus'></i></span>
                <span class='input-group-addon'><i class='icon-remove'></i></span>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
    <div class='hide row-custom'>
      <div class='row form-group'>
        <div class="col-xs-3"> <?php echo html::input('label[key]', '', "class='form-control' placeholder='{$lang->product->placeholder->label}'" )?></div>
        <div class="col-xs-9">
          <div class='input-group'>
          <?php echo html::input('value[key]', '', "class='form-control' placeholder='{$lang->product->placeholder->value}'" )?>
          <span class='input-group-addon'><i class='icon-plus'></i></span>
          <span class='input-group-addon'><i class='icon-remove'></i></span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
