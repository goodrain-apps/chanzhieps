$(document).ready(function()
{
    $.setAjaxForm('#passwordForm', function(response)
    {
        if('success' == response.result) window.location.reload();
    });
});
