$(document).ready(function()
{
    var key = 1;
    $(document).on('click', 'a.plus', function()
    {
        $(this).parents('tr').after($('#button').html().replace(/key/g,  key));
        key ++;
    });

    /* Delete options. */
    $(document).on('click', '.delete', function()
    {
        if($(this).parents('table').find('a.delete').size() == 1)
        {
            $(this).parents('tr').find('input').val('');
        }
        else
        {
            $(this).parents('tr').remove();
        }
    });

    $('#image').hide();
    $('#uploadFile').hide();
})

function fileHide()
{
    $('#image').attr('disabled', false);
    $('#image').show();
    $('#uploadFile').show();
    $('[name*=files]').hide();
}

function fileShow()
{
    $('[name*=files]').show();
    $('#image').attr('disabled', true);
    $('#image').hide();
    $('#uploadFile').hide();
}
