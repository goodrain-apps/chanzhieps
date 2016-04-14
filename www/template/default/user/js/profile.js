$(document).ready(function()
{
    $('.unbind').click(function()
    {
        if(confirm(v.confirmUnbind))
        {
            $.getJSON($(this).attr('href'), function(response) 
            {
                if(response.result == 'success')
                {
                    location.reload();
                }
                else
                {
                    alert(response.message);
                }
            })
        }
        return false;
    });
})
