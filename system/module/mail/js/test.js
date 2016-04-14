$(document).ready(function()
{
    $.setAjaxForm('#mailForm', function(response)
    {
        if(response.result == 'success')
        {
            $('#result').html();
            $('.panel-notice').addClass('hidden')
        }
        else
        {
            $('#result').html(response.data);
            $('.panel-notice').removeClass('hidden')
        }
        return false;
    });
});
