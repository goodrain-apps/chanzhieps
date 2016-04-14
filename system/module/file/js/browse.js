$(document).ready(function()
{   
    $.setAjaxForm('#fileForm', function(data)
    {
        if(data.result == 'success') 
        {
            setTimeout(function(){submitButton.popover('destroy');}, 1500);
            $.reloadAjaxModal(2000);
        }
    }); 
    $.setAjaxLoader('.edit', '#ajaxModal');
    $(document).on('click', 'a.option', function(data)
    {
        $.getJSON($(this).attr('href'), function(data) 
        {
            if(data.result == 'success')
            {
                $.reloadAjaxModal();
            }
            else
            {
                alert(data.message);
            }
        });
        return false;
    });

    $(".modal-backdrop").click(function()
    {
        $('.modal').modal('hide');
    });
});
