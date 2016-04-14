<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$clientLang = $this->app->getClientLang();
css::import($jsRoot . 'datetimepicker/css/min.css');
js::import($jsRoot  . 'datetimepicker/js/min.js'); 
?>
<script language='javascript'>
$(function()
{
    $.fn.fixedDate = function()
    {
        return $(this).each(function()
        {
            var $this = $(this);
            if($this.offset().top + 200 > $(document.body).height())
            {
                $this.attr('data-picker-position', 'top-right');
            }

            if($this.val() == '0000-00-00')
            {
                $this.focus(function(){if($this.val() == '0000-00-00') $this.val('').datetimepicker('update');}).blur(function(){if($this.val() == '') $this.val('0000-00-00')});
            }
        });
    };
    
    var startDate = new Date(2000, 1, 1);
    var options = 
    {
        language: '<?php echo $clientLang; ?>',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        format: 'yyyy-mm-dd hh:ii',
        startDate: startDate
    };

    var dateOptions = $.extend({}, options, {minView: 2, format: 'yyyy-mm-dd'});
    var timeOptions = $.extend({}, options, {startView: 1, minView: 0, maxView: 1, format: 'hh:ii'});

    $('.form-datetime').fixedDate().datetimepicker(options);
    $('.form-date').fixedDate().datetimepicker(dateOptions);
    $('.form-time').fixedDate().datetimepicker(timeOptions);

    $('.datepicker-wrapper').click(function()
    {
        $(this).find('.form-date, .form-datetime, .form-time').datetimepicker('show').focus();
    });

    $('.input-append.date').on('click', function(){
        $(this).find('input').datetimepicker('show').focus();
    }).find('input').datetimepicker($.extend({}, options, {pickerPosition: 'top-right'}));
});
</script>
