$(document).ready(function()
{
    var height = 0;
    $('.col-sm-3 > .panel > .panel-body').each(function()
    {
        if($(this).data('height')) return;
        height = Math.max($(this).outerHeight(), height);
    }).css('height', height).data('height', height);
})
