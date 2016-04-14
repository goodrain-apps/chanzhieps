<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<?php js::set('closeScoreTip', $lang->site->closeScoreTip);?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setBasic;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-2'><?php echo $lang->site->status;?></th> 
          <td class='col-xs-6'><?php echo html::radio('status', $lang->site->statusList, isset($this->config->site->status) ? $this->config->site->status : 'normal', "class='checkbox'");?></td><td></td>
        </tr>
        <?php $class = $this->config->site->status == 'pause' ? '' : 'hide';?>
        <tr class="pauseTip <?php echo $class?>">
          <th><?php echo $lang->site->pauseTip;?></th> 
          <td><?php echo html::textarea('pauseTip', !empty($this->config->site->pauseTip) ? $this->config->site->pauseTip : $lang->site->defaultTip);?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->type;?></th> 
          <td><?php echo html::radio('type', $lang->site->typeList, isset($this->config->site->type) ? $this->config->site->type : 'portal', "class='checkbox'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->lang;?></th>
          <td><?php echo html::checkbox('lang', $config->langs, isset($this->config->site->lang) ? $this->config->site->lang : 'zh-cn');?></td><td></td>
        </tr>
        <tr id='twTR'>
          <th><?php echo $lang->site->twContent;?></th>
          <td><?php echo html::checkbox('cn2tw', array(1 => $lang->site->cn2tw), isset($this->config->site->cn2tw) ? $this->config->site->cn2tw : '');?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->defaultLang;?></th>
          <td>
            <?php echo html::select('defaultLang', $config->langs, isset($this->config->site->defaultLang) ? $this->config->site->defaultLang : $this->app->getClientLang(), "class='form-control'");?>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->mobileTemplate;?></th> 
          <td><?php echo html::radio('mobileTemplate', $lang->site->mobileTemplateList, isset($this->config->site->mobileTemplate) ? $this->config->site->mobileTemplate : 'close', "class='checkbox'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->name;?></th> 
          <td><?php echo html::input('name', $this->config->site->name, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->domain;?></th> 
          <td><?php echo html::input('domain',  isset($this->config->site->domain) ? $this->config->site->domain : '', "class='form-control'");?></td>
          <td><?php echo html::a('javascript:void(0)', "<i class='icon-question-sign'></i>", "data-custom='{$lang->site->domainTip}' data-toggle='modal' data-icon='question-sign' data-title='{$lang->site->domain}'")?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->allowedDomain;?></th> 
          <td><?php echo html::input('allowedDomain',  isset($this->config->site->allowedDomain) ? $this->config->site->allowedDomain : '', "class='form-control'");?></td>
          <td><?php echo html::a('javascript:void(0)', "<i class='icon-question-sign'></i>", "data-custom='{$lang->site->allowedDomainTip}' data-toggle='modal' data-icon='question-sign' data-title='{$lang->site->allowedDomain}'")?></td>
        </tr>
        <tr title="<?php echo $lang->site->schemeTip;?>">
          <th><?php echo $lang->site->scheme;?></th> 
          <td><?php echo html::radio('scheme', $lang->site->schemeList, isset($this->config->site->scheme) ? $this->config->site->scheme : 'http', "class='checkbox'");?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->copyright;?></th> 
          <td><?php echo html::input('copyright', $this->config->site->copyright, "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->module;?></th>
          <td colspan='2'><?php echo html::checkbox('modules', $lang->site->moduleAvailable, isset($this->config->site->modules) ? $this->config->site->modules : '');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->keywords;?></th> 
          <td colspan='2'><?php echo html::input('keywords', $this->config->site->keywords, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->indexKeywords;?></th> 
          <td colspan='2'><?php echo html::input('indexKeywords', $this->config->site->indexKeywords, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->slogan;?></th> 
          <td colspan='2'><?php echo html::input('slogan', $this->config->site->slogan, "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->meta;?></th> 
          <td colspan='2'><?php echo html::textarea('meta', htmlspecialchars($this->config->site->meta), "placeholder='{$lang->site->metaHolder}' class='form-control' rows=3");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->desc;?></th> 
          <td colspan='2'><?php echo html::textarea('desc', htmlspecialchars($this->config->site->desc), "class='form-control' rows='3'");?></td> 
        </tr>
       <tr class='icpSN'>
          <th><?php echo $lang->site->icpSN;?></th> 
          <td colspan='2'>
            <div class='row'>
              <?php $placeholder = ($this->app->getClientLang() == 'en') ? "placeholder='{$lang->site->icpTip}'" : '';?>
              <div class='col-sm-4'><?php echo html::input('icpSN', isset($this->config->site->icpSN) ? $this->config->site->icpSN : '', "class='form-control col-xs-2' $placeholder");?></div>
              <div class='col-sm-8'>
                <div class='input-group'>
                  <span class="input-group-addon"><?php echo $lang->site->icpLink;?></span>
                  <?php echo html::input('icpLink', isset($this->config->site->icpLink) ? $this->config->site->icpLink : 'http://www.miitbeian.gov.cn', "class='form-control'")?>
                </div>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
