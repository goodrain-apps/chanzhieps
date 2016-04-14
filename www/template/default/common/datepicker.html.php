<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$clientLang = $this->app->getClientLang();
css::import($jsRoot . 'datetimepicker/css/min.css');
js::import($jsRoot  . 'datetimepicker/js/min.js'); 
if($clientLang != 'en') js::import($jsRoot . 'datetimepicker/js/locales/' . $clientLang . '.js'); 
?>
<script language='javascript'>
$(function()
{
    startDate = new Date(2000, 1, 1);
    $(".date").datetimepicker
    ({
        format: 'yyyy-mm-dd hh:ii',
        startDate:startDate,
        pickerPosition: 'top-left',
        todayBtn: true,
        autoclose: true,
        keyboardNavigation:false,
        language:'<?php echo $clientLang?>'
    })
});
</script>
