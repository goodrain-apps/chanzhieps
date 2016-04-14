$(document).ready(function()
{
    /* Set active menu. */
    $('.leftmenu li.active').removeClass('active');
    $(".leftmenu a[href*='type=" + v.type  + "']").parent().addClass('active');

    $('.pre').click(function()
    {
        var selector = $(this);
        bootbox.confirm($(this).data('confirm'), function(result)
        {
            if(result)
            {
                selector.text(v.lang.deleteing);
                $.getJSON(selector.attr('href'), function(data) 
                {
                    if(data.result=='success')
                    {
                        location.reload();
                    }
                    else
                    {
                        alert(data.message);
                    }
                });
            }
        });

        return false;
    });
    
    $('.pass').click(function()
    {
        var selector = $(this);
        selector.text(v.lang.doing);

        $.getJSON(selector.attr('href'), function(data) 
        {
            if(data.result=='success')
            {
                location.reload();
            }
            else
            {
                alert(data.message);
            }
        });

        return false;
    });
});
