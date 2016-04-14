$(document).ready(function()
{
    $('#execButton').click(function()
    {
        $(this).text(v.lang.updating);
        
        $.getJSON($(this).attr('href'), function(response)
        {
           if(response.result == 'finished')
           {
              $('#execButton').hide();
              $('#resultBox').append("<li>" + response.message + "</li>");
              return false;
           }
           else
          {
              $('#execButton').attr('href', response.next);
              $('#resultBox').append("<li>" + response.message + "</li>");
              return $('#execButton').click();
          }
        }); 
        return false;
    });
})
