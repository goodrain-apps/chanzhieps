$(document).ready(function()
{
    $('[name=checkIP]').change(function()
    {
        var checkIP = $('[name=checkIP]:checked').val(); 
        if(checkIP == 'close') $('#allowedIP').parents('tr').addClass('hide');
        else $('#allowedIP').parents('tr').removeClass('hide');
    });
    $('[name=checkIP]').change();

    $('[name=checkLocation]').change(function()
    {
        var checkIP = $('[name=checkLocation]:checked').val(); 
        if(checkIP == 'close') $('#allowedLocation').parents('tr').addClass('hide');
        else $('#allowedLocation').parents('tr').removeClass('hide');
    });
    $('[name=checkLocation]').change();

    $('#useLocation').click(function()
    {
        $('#allowedLocationShow').val(v.location);
        $('#allowedLocation').val(v.location);
        return false;
    });

    $.setAjaxForm('#securityForm', function(response)
    {
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }
    });
});
