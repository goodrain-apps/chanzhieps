$(document).ready(function()
{
    $('[name=filterSensitive]').change(function()
    {
        var filterSensitive = $('[name=filterSensitive]:checked').val(); 
        if(filterSensitive == 'close')$('#sensitive').parents('tr').addClass('hide');
        else $('#sensitive').parents('tr').removeClass('hide');
    });
    $('[name=filterSensitive]').change();
});
