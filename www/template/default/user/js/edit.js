$(document).ready(function()
{
    $(document).on('change', '#admin', function()
    {   
        if($(this).find('option:selected').val() != 'super')
        {
            $(this).parents('tr').prev().find('.single').show();
            $(this).parents('tr').prev().find('.multi').hide();
        }
        else
        {
            $(this).parents('tr').prev().find('.single').hide();
            $(this).parents('tr').prev().find('.multi').show();
        }
    }); 

    $('#admin').change();
})
