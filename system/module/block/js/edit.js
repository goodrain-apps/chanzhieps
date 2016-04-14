$(document).ready(function()
{
    $('#type').change(function()
    {
        location.href = createLink('block', 'edit', 'id=' + v.id + '&type=' + $(this).val() );
    });
    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    }); 

    $('[name*=group]').change(function()
    {
       $('#title').val($(this).find("option:selected").text()); 
    });
})
