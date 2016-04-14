$(document).ready(function()
{
    $('#mailSender').click(function()
    {
        var data = {email: $('#email').val()};
        var url = $(this).attr('href');

        $.post(url, data, function(response)
        {
            if(response.result == 'success')
            {
                 $('#mailSender').popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
                 $('#mailSender').next('.popover').addClass('popover-success');
                 function distroy(){$('#mailSender').popover('destroy')}
                 setTimeout(distroy,2000);
            }
            else
            {
                bootbox.alert(response.message);
            }
        }, 'json')
        return false;
    })
})
