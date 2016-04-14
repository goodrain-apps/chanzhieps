$(document).ready(function()
{   
    $.setAjaxForm('#fileForm', function(response)
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
                                           $('#fileForm #submit').append("<input value='1' name='continue' class='hide'>");
                                           $('#fileForm #submit').click();
                                       }  
                        }  
                    }  
                });
            }
        }
        else
        {
            setTimeout(function(){location.href = createLink('file', 'browsesource');}, 1200);
        }
    })

    $('.image-view').click(function()
    {
        $('.image-view').addClass('selected');
        $('.list-view').removeClass('selected');
        $('#imageView').show();
        $('#listView').hide();
        $.cookie('sourceViewType', 'image', {path: "/"});
    });

    $('.list-view').click(function()
    {
        $('.list-view').addClass('selected');
        $('.image-view').removeClass('selected');
        $('#listView').show();
        $('#imageView').hide();
        $.cookie('sourceViewType', 'list', {path: "/"});
    });

    var type = $.cookie('sourceViewType');
    if(type == '') type = 'image';
    $('.' + type + '-view').click();
    
    $('.file-source input').mouseover(function(){$(this).select()});
});
