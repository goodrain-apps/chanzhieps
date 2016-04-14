$(document).ready(function()
{
    $('.ajax-theme').click(function()
    {
        var current = $(this);
        if(current.hasClass('current')) return false;
        $('.msg').fadeOut()
        $.getJSON($(this).attr('href'), function(data)
        {
            $('.current').removeClass('current');
            current.find('.msg').text(data.message).fadeIn(function()
            {
               current.addClass('current');
               setTimeout('$(".current .msg").fadeOut();', 4000);
            });
        });
        return false;
    });

    $('.btn-preview').click(function()
    {
        var a = $('<a href="' + $(this).data('url') + '" target="_blank"></a>').get(0);
        var e = document.createEvent('MouseEvents');
        e.initEvent( 'click', true, true );
        a.dispatchEvent(e);
    });
})
