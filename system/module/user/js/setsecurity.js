$(document).ready(function()
{
    appendFingerprint('#questionForm');
    $.setAjaxForm('#questionForm', function(response)
    {
        if('success' == response.result) window.location.reload();
    });
});
