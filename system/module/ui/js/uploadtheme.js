$(document).ready(function()
{
    $.setAjaxForm('#uploadForm', function(response) 
    {
        if(response.result == 'success')
        {
            setTimeout(function()
            {
                $('#ajaxModal').attr('rel', response.locate).load(response.locate, function()
                {
                    $.ajustModalPosition();
                });
            }, 2000);
        }
    });

    $.setAjaxLoader('.okFile', '#ajaxModal');
});
