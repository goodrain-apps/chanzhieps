$(document).ready(function()
{
    $('.confirmDelivery').click(function()
    {
        confirmLink = $(this).data('rel');
        bootbox.confirm(v.confirmWarning, function(result)
        {
            if(!result) return true;
            $.getJSON(confirmLink, function (response)
            {
                if(response.result == 'success')
                {
                    bootbox.alert(response.message, function(){ location.reload(); });
                }
            })
            return true;
        });
        return false;
    });

    $('.cancelLink').click(function()
    {
        confirmLink = $(this).data('rel');
        bootbox.confirm(v.cancelWarning, function(result)
        {
            if(!result) return true;
            $.getJSON(confirmLink, function (response)
            {
                if(response.result == 'success')
                {
                    bootbox.alert(response.message, function(){ location.reload(); });
                }
            })
        });
        return true;
    });


    $('.icon-plus').parent().click(function()
    {
        var countInput = $(this).prev('input');
        countInput.val(parseInt(countInput.val()) + 1);
        countInput.change();
    });

    $('.icon-minus').parent().click(function() 
    { 
        var countInput = $(this).next('input');
        if(countInput.val() <= 1) return false;
        countInput.val(parseInt(countInput.val()) - 1);
        countInput.change();
    });
    
    $('input[name*=count]').change(function()
    {
        if(v.checkStock && $(this).val() > $(this).data('stock')) $(this).val($(this).data('stock'));
        amount = $(this).val() * $(this).parents('tr').find('input[name*=price]').val();
        amount = amount.toFixed(2);
        $(this).parents('tr').find('.amountContainer').text(amount);
        countAmount();
    });

    $('input[name*=count]').change();
    function countAmount()
    {
        amount = 0;
        $('.amountContainer').each(function()
        {
          amount += parseFloat($(this).html());    
        })
        $('#amount').text(v.currencySymbol + amount);
    }
})
