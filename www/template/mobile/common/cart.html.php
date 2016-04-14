<?php if(!defined("RUN_MODE")) die();?>
<style>
.cart-count {display: inline-block; margin-left: 4px; transition: all .2s; position: relative; top: 0;}
.cart-count.hide {display: none}
.cart-count.twinkle {transform: scale(1.5); top: -2px}
.msger-cart .btn.success {border-color: #fff; margin-top: 10px;}
.msger-cart .msger-content {position: relative;}
.msger-cart .msger-cart-count {position: absolute; text-align: center; right: 15px; top: 18px; background-color: rgba(0,0,0,.1); border-radius: 4px; padding: 6px 18px 6px 8px;}
.msger-cart .msger-cart-count .cart-count {font-size: 20px;}
</style>
<script>
$(function()
{
    $.refreshCart = function(twinkle)
    {
        $.getJSON('<?php echo $this->createLink('cart', 'count');?>', function(data)
        {
            if($.isPlainObject(data) && data.result === 'success')
            {
                var $count = $('.cart-count').text(data.count).toggleClass('hide', data.count < 1);
                if(data.count > 0 && twinkle)
                {
                    $count.addClass('twinkle');
                    setTimeout(function(){$count.removeClass('twinkle')}, 200);
                    if(window.v && window.v.addToCartSuccess) $.messager.success(window.v.addToCartSuccess + "<div><a class='btn success dismiss' href='<?php echo $this->createLink('cart', 'browse');?>'>" + window.v.gotoCart + " <i class='icon-arrow-right'></i></a><div class='msger-cart-count'><i class='icon icon-shopping-cart icon-s3'></i><strong class='cart-count badge'>" + data.count + "</strong></div></div>", {time: 10000, cssClass: 'msger-cart'});
                }
            }
        });
    };

    $.refreshCart();
});
</script>
