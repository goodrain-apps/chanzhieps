<?php if(!defined("RUN_MODE")) die();?>
<script>
    function loadCartInfo(twinkle)
    {
        <?php if($this->app->user->account != 'guest'):?>
        if($('#cartBox').length == 0) $('.login-msg').append("<span class='text-center text-middle' id='cartBox'></span>");
        <?php else:?>
        if($('#cartBox').length == 0) $('div nav').prepend("<span class='text-center text-middle' id='cartBox'></span>");
        <?php endif;?>
        $('#cartBox').load(createLink('cart', 'printTopBar'),
            function()
            {
                if(twinkle) 
                {
                    bootbox.dialog(
                    {  
                        message: v.addToCartSuccess,  
                        buttons:
                        {  
                            back:
                            {  
                                label:     v.lang.continueShopping,
                                className: 'btn-primary',  
                                callback:  function(){location.reload();}  
                            },
                            cart:
                            {  
                                label:     v.gotoCart,  
                                className: 'btn-primary',  
                                callback:  function(){location.href = createLink('cart', 'browse');}  
                            }  
                        }  
                    });
                }
            }
        );
    }

$(document).ready(function()
{
    loadCartInfo(false);
})
</script>
