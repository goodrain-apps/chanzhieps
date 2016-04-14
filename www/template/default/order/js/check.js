$(document).ready(function()
{
    $('[name=payment]').eq(0).prop('checked', true);
    $('#submit').click(function(){
        var payment = $('input:radio[name=payment]:checked').val();
        if(payment == 'COD')
        {
            $('#checkForm').attr('target', '');
        }
        else
        {
            $('#checkForm').attr('target', '_blank');

            bootbox.dialog(
            {  
                message: v.goToPay,  
                buttons:
                {  
                    paySuccess:
                    {
                        label:     v.paid,  
                        className: 'btn-primary',  
                        callback:  function() { setTimeout(function(){location.href = createLink('order', 'browse');}, 600); }  
                    }
                }
            });
        }
    });
});
