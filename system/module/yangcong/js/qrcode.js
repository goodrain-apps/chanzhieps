$(document).ready(function()
{
     url = createLink('yangcong', 'getResult', "eventID=" + v.eventID);
     $('#checkButton').click(function()
     {
        $.getJSON(url, function(response)
        {
            if(response.result == 'success')  
            {
                location.href = createLink('user', 'yangconglogin', "referer=" + v.referer);
            }
            else
            {
                $('#checkButton').click();
            }
        });
     });

     setTimeout(function(){$('#checkButton').click();}, 3000);
})
