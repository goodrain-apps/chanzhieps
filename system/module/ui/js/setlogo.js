$(document).ready(function()
{
    $('.btn-upload, .btn-editor').click(function()
    {
        $(this).parents('.col-md-6').find('input[type=file]').click();
    })
    $('input[type=file]').change(function()
    {
        $(this).parents('.col-md-6').find('.btn-upload').replaceWith('<i class="icon icon-lg icon-spin icon-refresh"></i>');
        $(this).parents('form').submit();
    })
})
