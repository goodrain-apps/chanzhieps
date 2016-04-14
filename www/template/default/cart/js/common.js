$(document).ready(function()
{
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
        amount = $(this).val() * $(this).parents('tr').find('input[name*=price]').val();
        $(this).parents('tr').find('.amountContainer').text(amount);
        countAmount();
    });

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
