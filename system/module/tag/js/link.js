$(document).ready(function()
{
    $.setAjaxForm('#linkForm', function(data) 
    { 
        setTimeout(function(){ location.reload();}, 1200); 
    }); 
});

