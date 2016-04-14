$(document).ready(function()
{
    $.setAjaxLoader('.loadInModal', '#ajaxModal');

    $(document).on('click', '.btn-reload', function()
    {
        $.reloadAjaxModal(); 
    })
});
