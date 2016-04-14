<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The edit view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-edit'></i> <?php echo $lang->user->editProfile;?></h5>
    </div>
    <div class='modal-body'>
      <form id='editProfileForm' method='post' action="<?php echo inlink('edit');?>" data-checkfingerprint='1'>
        <div class='form-group'>
          <label for='realname' class='control-label'><?php echo $lang->user->realname;?></label>
          <?php if($user->admin == 'super'):?>
            <?php if(count(explode(',', $this->config->site->lang)) > 1):?>
            <?php if(strpos($this->config->site->lang, 'zh-cn') !== false):?>
            <div class='input-group'>
              <label class='input-group-addon'><?php echo $config->langs['zh-cn']?></label>
              <?php echo html::input("realnames[cn]", isset($user->realnames->cn) ? $user->realnames->cn : '', "class='form-control'");?>
            </div>
            <?php endif;?>
            <?php if(strpos($this->config->site->lang, 'zh-tw') !== false):?>
            <div class='input-group'>
              <label class='input-group-addon'><?php echo $config->langs['zh-tw'];?></label>
              <?php echo html::input("realnames[tw]", isset($user->realnames->tw) ? $user->realnames->tw : '', "class='form-control'");?>
            </div>
            <?php endif;?>
            <?php if(strpos($this->config->site->lang, 'en') !== false):?>
            <div class='input-group'>
              <label class='input-group-addon'><?php echo $config->langs['en']?></label>
              <?php echo html::input("realnames[en]", isset($user->realnames->en) ? $user->realnames->en : '', "class='form-control'");?>
            </div>
            <?php endif;?>
            <?php else:?>
            <?php $clientLang = $this->config->site->defaultLang;?>
            <?php $clientLang = strpos($clientLang, 'zh-') !== false ? str_replace('zh-', '', $clientLang) : $clientLang;?>
            <?php echo html::input("realnames[{$clientLang}]", $user->realname, "class='form-control'")?>
            <?php endif;?>
          <?php else:?>
          <?php echo html::input('realname', $user->realname, "class='form-control'")?>
          <?php endif;?>
        </div>
        <hr>
        <div class='form-group'>
          <div class='input-group'>
            <label for='oldPwd' class='input-group-addon'><?php echo $lang->user->oldPwd;?></label>
            <?php echo html::password('oldPwd', '', "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='password' class='input-group-addon'><?php echo $lang->user->password;?></label>
            <?php echo html::password('password1', '', "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='password2' class='input-group-addon'><?php echo $lang->user->password2;?></label>
            <?php echo html::password('password2', '', "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='company' class='input-group-addon'><?php echo $lang->user->company;?></label>
            <?php echo html::input('company', $user->company, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='address' class='input-group-addon'><?php echo $lang->user->address;?></label>
            <?php echo html::input('address', $user->address, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='zipcode' class='input-group-addon'><?php echo $lang->user->zipcode;?></label>
            <?php echo html::input('zipcode', $user->zipcode, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='mobile' class='input-group-addon'><?php echo $lang->user->mobile;?></label>
            <?php echo html::input('mobile', $user->mobile, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='phone' class='input-group-addon'><?php echo $lang->user->phone;?></label>
            <?php echo html::input('phone', $user->phone, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='qq' class='input-group-addon'><?php echo $lang->user->qq;?></label>
            <?php echo html::input('qq', $user->qq, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <div class='input-group'>
            <label for='gtalk' class='input-group-addon'><?php echo $lang->user->gtalk;?></label>
            <?php echo html::input('gtalk', $user->gtalk, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <?php echo html::submitButton('', 'btn primary block') . html::hidden('token', $token);?>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$(function()
{
    var $editProfileForm = $('#editProfileForm');
    appendFingerprint($editProfileForm);
    $editProfileForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
        }
    }});
});
</script>
