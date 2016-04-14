<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php css::import($jsRoot . 'jquery/chosen/min.css');?>
<?php js::import($jsRoot . 'jquery/chosen/min.js');?>
<?php $clientLang = $this->app->getClientLang(); ?>

<script language='javascript'> 
$(document).ready(function()
{
    $(".chosen").chosen({no_results_text: '<?php echo $lang->noResultsMatch;?>', placeholder_text:' ', disable_search_threshold: 10, width: '100%', search_contains: true});
    $('select.chosen-icons').chosenIcons({lang: '<?php echo $clientLang; ?>'});
});
</script>
