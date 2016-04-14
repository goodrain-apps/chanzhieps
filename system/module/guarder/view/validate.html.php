<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include_once '../../common/view/header.modal.html.php';?>
<?php js::set('emailSending', sprintf($lang->mail->sending, $user->email));?>
<?php if(isset($pass) and $pass):?>
<script>
$(document).ready(function()
{
    $('#formError').hide();
    setTimeout(function()
    {
        $('#ajaxModal button.close').click();
        $('#submit').click();
    }, 500);
});
</script>
<div class='alert'><?php echo $lang->guarder->verifySuccess;?></div>
<?php else:?>
  <?php
  if(!isset($target))   $target   = 'modal';
  if(!isset($method))   $method   = '';
  if(!isset($account))  $account  = $this->app->user->account;
  if(!isset($email))    $email    = $this->app->user->email;
  if(!isset($question)) $question = $this->guarder->getSecurityQuestion($this->app->user->account);
  if(isset($type) and $type != '') $this->config->site->importantValidate = $type;
  ?>
  <?php if(!helper::isAjaxRequest()):?>
  <div class="modal" id="ajaxModal" ref="<?php echo $this->app->getURI();?>">
    <div class="modal-dialog" style='width: 750px'>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">X</span></button>
          <h4 class="modal-title"><?php echo $lang->guarder->verify?></h4>
        </div>
        <div class="modal-body">
  <?php endif;?>
  <form class='form-inline' id='validateForm' action="<?php echo $this->createLink('guarder', 'validate', "url={$url}&target={$target}&account={$account}&method={$method}");?>" method='post' style='min-height:165px'>
    <?php $refUrl  = helper::safe64Decode($url) == 'close' ? $this->app->getURI() : helper::safe64Decode($url);?>
    <?php $fileBtn = html::a($refUrl, $lang->guarder->created, "class='btn btn-sm btn-primary okFile'")?>
    <table class='table table-form'>
      <tr>
        <th class='w-80px'><?php echo $lang->guarder->options;?></th>
        <td colspan='3'>
          <?php
          $types   = array();
          $options = explode(',', $this->config->site->importantValidate);
          if(in_array('setSecurity', $options)) $types['setSecurity'] = $lang->site->validateTypes->setSecurity;
          if(in_array('okFile', $options)) $types['okFile'] = $lang->site->validateTypes->okFile;
          if(in_array('email', $options)) $types['email'] = $lang->site->validateTypes->email;
          ?>
          <?php echo html::radio('type[]', $types, isset($types[$this->cookie->validate]) ? $this->cookie->validate : key($types));?>
        </td>
      </tr>
      <?php if(in_array('setSecurity', $options)):?>
      <tr class='option-question'>
        <th></th>
        <?php if(!empty($question)):?>
        <td class='w-300px' colspan='2'>
          <p><?php echo $question->question;?></p>
          <p><?php echo html::input('answer', '', "class='form-control' placeholder={$lang->guarder->answer}");?></p>
        </td>
        <?php endif;?>
        <td><?php if(empty($question)) echo $lang->guarder->noQuestion;?></td>
      </tr>
      <?php endif;?>
      <?php if(in_array('okFile', $options)):?>
      <tr class='option-okfile'>
        <th></th>
        <td colspan='3'>
          <p><?php printf($lang->guarder->okFileVerify, $okFile['name'], $okFile['content']);?></p>
          <p><?php echo $fileBtn?></p>
        </td>
      </tr>
      <?php endif;?>
      <?php if(in_array('email', $options)):?>
      <?php if(!empty($email) and $this->config->mail->turnon):?>
      <tr class='option-email'>
        <th></th>
        <td><?php echo html::input('captcha', '', "class='form-control' placeholder={$lang->guarder->captcha}");?></td>
        <td><?php echo html::a($this->createLink('mail', 'sendmailcode', "account=$account"), $lang->guarder->getEmailCode, "id='mailSender' class='btn btn-success'");?></td>
      </tr>
      <?php else:?>
      <tr class='option-email'>
        <th></th>
        <td colspan='3'>
          <?php if(empty($email)) echo $lang->guarder->noEmail;?>
          <?php if(!$this->config->mail->turnon) echo '&nbsp;' . $lang->guarder->noConfigure;?>
          <?php if(!$this->config->mail->turnon or empty($email)) echo $lang->guarder->noCaptcha;?>
        </td>
      </tr>
      <?php endif;?>
      <?php endif;?>
      <tr class='submit-button'>
        <th></th>
        <td colspan='3'><?php echo html::submitButton();?></td>
      </tr>
    </table>
  </form>
  <script>
  $(document).ready(function()
  {
      $('#mailSender').click(function()
      {
          $('#mailSender').popover({trigger:'manual', content: v.emailSending, placement:'right'}).popover('show');
          $('#mailSender').next('.popover').addClass('popover-success').css('width', '320px');
          function distroy(){$('#mailSender').popover('destroy')}
          setTimeout(distroy, 2000);
  
          var url = $(this).attr('href');

          $.getJSON(url, function(response)
          {
              $('#mailSender').popover('destroy');
              if(response.result == 'success')
              {
                   $('#mailSender').attr('disabled', 'disabled');
                   $('#mailSender').popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
                   $('#mailSender').next('.popover').addClass('popover-success');
                   function distroy(){$('#mailSender').popover('destroy')}
                   setTimeout(distroy,2000);
              }
              else
              {
                  bootbox.alert(response.message);
              }
          })
          return false;
      })

      $.setAjaxForm('#validateForm', function(response)
      {
          if(response.result == 'success')
          {
              if(response.locate == 'close')
              {
                  $('#formError').hide();
                  return setTimeout(function()
                  {
                      $('#ajaxModal button.close').click();
                      $('#submit').click();
                  }, 1200);
              }
              if(response.target == 'modal')
              {
                  target = $('#ajaxModal');
                  url = response.locate;

                  return setTimeout(function()
                  {
                    target.attr('rel', url);
                    target.load(url, function()
                    {
                        if(target.hasClass('modal'))
                        {
                            $.ajustModalPosition('fit', target);
                        }
                    });
                  }, 2000);
              }
              else
              {
                  setTimeout(function(){$('#ajaxModal button.close').click()}, 1200);
                  return setTimeout(function(){location.href = response.locate;}, 2000);
              }
          }
      });

      function checkOptions()
      {
          if($('[name*=type][value=okFile]').prop('checked'))
          {
              $('.option-okfile').show();
              $('.option-email').hide();
              $('.option-question').hide();
              $('.submit-button').hide();
              $.cookie('validate', 'okFile');
          }

          if($('[name*=type][value=setSecurity]').prop('checked'))
          {
              $('.option-question').show();
              $('.option-okfile').hide();
              $('.option-email').hide();
              $('.submit-button').show();
              $.cookie('validate', 'setSecurity');
          }

          if($('[name*=type][value=email]').prop('checked'))
          {
              $('.option-email').show();
              $('.option-question').hide();
              $('.option-okfile').hide();
              $('.submit-button').show();
              $.cookie('validate', 'email');
          }
      }
      checkOptions();
      $('[name*=type]').click(checkOptions);

      <?php if($target == 'modal'):?>
      $('.okFile').click(function()
      {
          $('#ajaxModal').load($(this).attr('href'));
          return false;
      })
      <?php endif;?>
  })
  </script>
  <?php if(!helper::isAjaxRequest()):?>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function()
  {
      $('.clearfix').find('.panel').remove();
      $('#ajaxModal').modal('show', 'fit');
  })
  </script>
  <?php endif;?>
<?php endif;?>
<?php include_once '../../common/view/footer.modal.html.php';?>
