$(document).ready(function()
{
    $.setAjaxForm('#payForm', function(response){ if(response.result == 'success') location.reload(); });
})
