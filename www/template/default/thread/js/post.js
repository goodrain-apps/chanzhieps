$(document).ready(function()
{
    $.setAjaxForm('#threadForm', function(response)
    {
        if(response.result == 'success')
        {
            setTimeout(function(){ location.href = response.locate;}, 1200);
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(Base64.decode(response.captcha)).show();
            }
        }
    });

    $('#isLink').change();

    $('.nav-system-forum').addClass('active');
});
