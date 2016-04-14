$(function()
{
    setTimeout(function()
    {
        $(window).resize(function()
        {
            var $modal = window.parent.$('#veModal .modal-body');
            $modal.css('min-height', Math.max($modal.height(), $('body').height()));
        });
    }, 200);
});
