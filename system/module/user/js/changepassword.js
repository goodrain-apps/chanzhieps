$(document).ready(function()
{
    appendFingerprint('#passwordForm');
    $.setAjaxForm('#passwordForm', function(response)
    {
        if('success' == response.result) window.location.reload();
    });
});
