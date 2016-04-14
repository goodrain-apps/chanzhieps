$(document).ready(function()
{
    $('#type').change(function()
    {
        location.href = createLink('block', 'create', 'type=' + $(this).val());
    })

    $.setAjaxForm('#createForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
        if(response.result == 'success' && response.locate != '')
        {
            $('.captchaModal').click();
            location.href = response.locate;
        }   
    }); 

    $('[name*=group]').change(function()
    {
       $('#title').val($(this).find("option:selected").text()); 
    });
    $('[name*=group]').change();
})
