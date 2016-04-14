$(document).ready(function()
{   
    $.setAjaxForm('#qrcodeForm', function(data)
    {
        if(data.result == 'success') $.reloadAjaxModal(1500);
    }); 
})
