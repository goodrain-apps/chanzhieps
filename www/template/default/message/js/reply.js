$(document).ready(function()
{   
    $.setAjaxForm('#replyForm', function(data)
    {
        if(data.result == 'success')
        {
            setTimeout(function(){parent.location.reload()}, 1500);
        }
        else
        {
            if(data.reason == 'needChecking')
            {
                $('#captchaBox').html(Base64.decode(data.captcha)).show();
            }
        }
    }); 
});
