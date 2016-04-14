$(document).ready(function()
{
    $('[name*=payment]').click(function()
    {
        if($('[name*=payment][value=alipay]').prop('checked'))
        {
            $('.alipay-item').show();
        }

        if($('[name*=payment][value=alipaySecured]').prop('checked'))
        {
            $('.alipay-item').show();
        }

        if(!$('[name*=payment][value=alipay]').prop('checked') && !$('[name*=payment][value=alipaySecured]').prop('checked')) $('.alipay-item').hide();
    })
    $('[name*=payment]').change();
})
