$(document).ready(function()
{
    $(document).on('click', '.btn-plus', function()
    {
        $(this).parents('.form-group').after($('.child').html());
    })

    $(document).on('click', '.btn-remove', function()
    {
        $(this).parents('.form-group').remove();
    })
})
