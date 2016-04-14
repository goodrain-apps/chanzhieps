<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The message view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php include TPL_ROOT . 'user/side.html.php';?>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-comments-alt'></i> <?php echo $lang->user->messages?> <span>(<?php echo count($messages)?>)</span> </div>
  </div>
  <div class='panel-body' id='cardListWarpper'>
    <div class='cards cards-list' id='cardList'>
    <?php foreach($messages as $message):?>
      <div class='card'>
        <div class='card-heading'><strong class='<?php echo $this->app->user->account === $message->from ? 'text-danger' : 
        'text-special' ?>'><?php echo $message->from;?></strong> &nbsp; <small class='text-muted'><?php echo substr($message->date, 5);?></small></div>
        <div class='card-content'>
          <?php echo $message->content;?>
        </div>
        <div class='card-footer'>
          <span class='<?php echo $message->readed ? 'text-muted' : 'text-success'?>'><?php echo $lang->message->readedStatus[$message->readed];?></span>
          
          <div class="pull-right">
            <?php if(!$message->readed):?>
            <?php echo html::a($this->createLink('message', 'view', "message=$message->id"), $message->link ? $lang->message->view : $lang->message->readed, "class='text-primary markread'");?>
            <?php else:?>
            <?php echo $message->link ? html::a($this->createLink('message', 'view', "message=$message->id"), $lang->message->view) : ''?>
            <?php endif;?>
            &nbsp; <?php echo html::a($this->createLink('message', 'batchDelete'), $lang->delete, "class='delete text-danger' data-id='{$message->id}'") ?>
          </div>
        </div>
      </div>
    <?php endforeach;?>
    </div>
  </div>
</div>
<script>
$(function()
{
    $(document).on('click', '.markread', function(e) {

        var $this   = $(this);
        var options = $.extend({url: $this.attr('href'), onSuccess: function(response)
        {
            var $response = $(response);
            $('#cardList').html($response.find('#cardList').html());
            $.messager.success('<?php echo $lang->message->readed; ?>');
        }}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    }).on('click', '.delete', function(e) {

        var $this   = $(this);
        var options = $.extend(
        {
            method: 'post',
            url: $this.attr('href'), 
            confirm: window.v.lang.confirmDelete,
            data: "messages[]=" + $this.data('id'),
            onResultSuccess: function(response)
            {
                response.locate = null;
                var $card = $this.closest('.card').addClass('fade');
                setTimeout(function(){$card.remove();}, 300);
                $.messager.success('<?php echo $lang->deleteSuccess;?>');
            }}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });
});
</script>
<?php include TPL_ROOT . 'common/footer.html.php';?>
