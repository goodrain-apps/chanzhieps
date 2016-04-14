$(document).ready(function()
{
    $.setAjaxForm('#sourceEditForm', function(response)
    {
        if(response.result == 'fail')
        {
            if(response.error && response.error.length)
            {
                bootbox.dialog(
                {  
                    message: response.error,  
                    buttons:
                    {  
                        back:
                        {  
                            label:     v.lang.back,
                            className: 'btn-primary',  
                            callback:  function(){location.reload();}  
                        },
                        continue:
                        {  
                            label:     v.lang.continue,  
                            className: 'btn-primary',  
                            callback:  function()
                                       {
                                           $('#sourceEditForm #submit').append("<input value='1' name='continue' class='hide'>");
                                           $('#sourceEditForm #submit').click();
                                       }  
                        }  
                    }  
                });
            }
        }
        else
        {
            setTimeout(function(){location.href = response.locate;}, 1200);
        }
    })
})
