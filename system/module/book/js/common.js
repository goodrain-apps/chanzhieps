$(document).ready(function()
{
    $('.nav-system-book').addClass('active');

    /* Set current active moduleMenu. */
    if(typeof(v.path) != 'undefined')
    {
        $('.leftmenu li.active').removeClass('active');
        $.each(v.path, function(index, bookID) 
        { 
            $(".leftmenu a[href$='book=" + bookID + "']").parent().addClass('active');
        })
    }
});
