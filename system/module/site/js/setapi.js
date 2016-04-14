$(document).ready(function()
{
    $('#allip').change(function()
    {
        if($(this).prop('checked'))
        {
            $('#ip').attr('disabled', 'disabled');
        }
        else
        {
            $('#ip').removeAttr('disabled');
        }
    });
})
