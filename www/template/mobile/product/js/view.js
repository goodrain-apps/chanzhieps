+(function($){
    'use strict';

    var minDelta = 20;

    $.fn.numberInput = function(){
        return $(this).each(function(){
            var $input = $(this);
            $input.on('click', '.btn-minus, .btn-plus', function(){
                var $val = $input.find('.form-control-number, [type="number"]');
                var val = parseInt($val.val());
                val = Math.max(1, $(this).hasClass('btn-minus') ? (val - 1) : (val + 1));
                $val.val(val).trigger('change');
            });
        });
    };

    $(function(){$('.input-number').numberInput();});
}(Zepto));

$(function()
{
    $(document).on('click', '.btn-buy', function()
    {
        window.location.href = $(this).data('url').replace('count', $('#count').val());
    }).on('click', '.btn-cart', function()
    {
        var $btn = $(this);
        if($btn.hasClass('disabled')) return;

        $btn.addClass('disabled')
        $.getJSON($btn.data('url').replace('count', $('#count').val()), function(data, status)
        {
            if(status === 'success')
            {
                if($.isPlainObject(data) && data.result === 'success')
                {
                    if($.isFunction($.refreshCart))
                    {
                        $.refreshCart(true);
                    }
                    else if(window.v && window.v.addToCartSuccess)
                    {
                        $.messager.success(window.v.addToCartSuccess);
                    }
                }
                else if(data && data.locate)
                {
                    window.location.href = data.locate;
                }
                else
                {
                    $.messager.danger($.param(data));
                }
            }
            else
            {
                if(window.v && window.v.lang.timeout)
                {
                    $.messager.danger(window.v.lang.timeout);
                }
            }
            $btn.removeClass('disabled');
        });
    });
});
