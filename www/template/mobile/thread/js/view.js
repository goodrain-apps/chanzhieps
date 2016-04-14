$(function()
{
    $('.thread > .card-footer').each(function()
    {
        var $footer = $(this);
        var $children = $footer.children();
        var length = $children.length;
        if(length < 1 
           || (length === 1 && $children.filter('.actions').length === 1 && $children.filter('.actions').children().length < 1))
        {
            $footer.hide();
        }
    });
});
