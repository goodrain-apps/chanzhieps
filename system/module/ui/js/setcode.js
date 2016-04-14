$(document).ready(function()
{
    $('[href=#cssTab]').click();
    $('.leftmenu li.active').removeClass('active');
    $('.leftmenu [href*=' + v.page + ']').parent().addClass('active');
})
