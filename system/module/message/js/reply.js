$(document).ready(function()
{   
    $.setAjaxForm('#replyForm', function(data)
    {
        if(data.result == 'success') setTimeout(function(){parent.location.reload()}, 1500);
    }); 
});
