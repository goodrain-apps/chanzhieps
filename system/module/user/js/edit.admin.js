$(document).ready(function()
{
    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    }); 

    $(document).on('change', '#admin', function()
    {   
        if($(this).find('option:selected').val() == 'common')
        {
            $('.groups').show();
        }
        else
        {
            $('.groups').hide();
        }

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
