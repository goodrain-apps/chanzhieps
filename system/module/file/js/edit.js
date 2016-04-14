$(document).ready(function()
{
    $(function()
    {
        $.setAjaxForm('#fileForm', function(data){$.reloadAjaxModal();}); 
        $('.goback').click(function(){$.reloadAjaxModal();})
    })
})

