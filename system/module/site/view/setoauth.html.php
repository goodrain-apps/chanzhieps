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
<div class='row'>
<?php foreach($lang->user->oauth->providers as $providerCode => $providerName):?>
<?php isset($this->config->oauth->$providerCode) ? $oauth = json_decode($this->config->oauth->$providerCode) : $oauth = '';?>
  <div class='col-sm-6 panel-box'>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><i class="icon-<?php echo $providerCode; ?>"></i> <?php echo $providerName;?></strong>
        <div class='panel-actions'>
          <?php echo html::a('http://api.chanzhi.org/goto.php?item=help_' . $providerCode . 'oauth', '<i class="icon-question-sign"></i> ' . $lang->site->oauthHelp, "target='_blank' class='btn btn-link'");?>
        </div>
      </div>
      <div class='panel-body'>
        <form method='post' id='<?php echo $providerCode;?>AjaxForm' class='form-horizontal'>
          <table class="table table-form">
            <tr>
              <th class='w-100px'><?php echo $lang->user->oauth->verification;?></th>
              <td class='w-p75'>
                <?php echo html::input('verification', isset($oauth->verification) ? $oauth->verification : '', "class='form-control'");?>
              </td><td></td>
            </tr>
            <tr>
              <th><?php echo $lang->user->oauth->{$providerCode}->clientID;?></th>
              <td>
                <?php echo html::input('clientID', isset($oauth->clientID) ? $oauth->clientID : '', "class='form-control'");?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->user->oauth->{$providerCode}->clientSecret;?></th>
              <td>
                <?php echo html::input('clientSecret', isset($oauth->clientSecret) ? $oauth->clientSecret : '', "class='form-control'");?>
              </td>
            </tr>
            <?php if($providerCode == 'sina'):?>
            <tr>
              <th><?php echo $lang->user->oauth->widget;?></th>
              <td><?php echo html::input('widget', isset($oauth->widget) ? $oauth->widget : '', "class='form-control'");?></td>
            </tr>
            <?php endif;?>
            <?php if($providerCode == 'qq'):?>
            <tr>
              <th><?php echo $lang->user->oauth->callbackURL;?></th>
              <td>
                <?php $callbackURL = commonModel::createFrontLink('user', 'oauthCallback', "provider=qq");?>
                <?php if($callbackURL == '/user-oauthCallback-qq.html'):?>
                <?php echo commonModel::getSysURL() . $callbackURL;?>
                <?php else:?>
                <?php echo commonModel::getSysURL() . '/index.php/user-oauthCallback-qq.html';?>
                <?php endif;?>
              </td>
            </tr>
            <?php endif;?>
            <tr>
             <th></th> <td><?php echo html::submitButton() . html::hidden('provider', $providerCode);?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <div class='col-sm-6 panel-box'>
    <div class='panel'>
      <div class='panel-heading'>
        <strong><?php echo $lang->site->setYangcong?></strong>
        <div class='panel-actions'>
          <?php //echo html::a('http://api.chanzhi.org/goto.php?item=help_' . $providerCode . 'oauth', '<i class="icon-question-sign"></i> ' . $lang->site->oauthHelp, "target='_blank' class='btn btn-link'");?>
        </div>
      </div>
      <div class='panel-body'>
      <form method='post' id='ajaxForm' action='<?php echo inlink('setyangcong')?>' class='form-horizontal'>
          <table class="table table-form">
            <tr>
              <th class='w-100px'><?php echo $lang->site->yangcong->appID;?></th>
              <td class='w-300px'>
                <?php echo html::input('appID', zget($setting, 'appID', ' '), "class='form-control'");?>
              </td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->site->yangcong->key;?></th>
              <td>
                <?php echo html::input('key', zget($setting, 'key', ' '), "class='form-control'");?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->site->yangcong->auth;?></th>
              <td>
                <?php echo html::input('auth', zget($setting, 'auth', ' '), "class='form-control'");?>
              </td>
            </tr>
            <tr>
             <th></th> <td><?php echo html::submitButton();?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
