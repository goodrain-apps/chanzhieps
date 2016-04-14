$(document).ready(function()
{
   	$('.little-image').mouseover(function()
    {
        $('.product-image.media-wrapper img').attr('src', $(this).find('img').attr('src').replace('s_', 'f_'));
        return false;
    });

    $('.btn-buy').click(function()  { location.href = createLink('order', 'confirm', 'product=' + v.productID + '&count=' + $('#count').val()); });

    $('.btn-cart').click(function() 
    { 
        var button = $('#cartBox');
        cartLink = createLink('cart', 'add', 'product=' + v.productID + '&count=' + $('#count').val());
        $.getJSON(cartLink, function(response)
        {
            if(response.result == 'success')
            {
                loadCartInfo(true);
            }
            else
            {
                location.href = response.locate;           
            }
        });
    });
    $('.icon-plus').parent().click(function(){ $('#count').val(parseInt($('#count').val()) + 1).change(); });
    if(v.stockOpened) 
    {
       $('#count').change(function()
       {
          if($('#count').val() > v.stock) $(this).val(v.stock);
       })
    }
    $('.icon-minus').parent().click(function() 
    { 
        if($('#count').val() <= 1) return false;
        $('#count').val(parseInt($('#count').val()) - 1);  
    });

    // set product image menu
    var $imageMenu = $('#imageMenu');
    var $imageMenuWrapper = $('#imageMenuWrapper');
    var setImageMenu = function()
    {
        
        var imgMenuWidth = 0;
        $imageMenu.children('.product-image-wrapper').each(function()
        {
            imgMenuWidth += $(this).outerWidth();
        });
        $imageMenu.width(imgMenuWidth);

        var imgWrapperWidth = $imageMenuWrapper.width();
        $imageMenuWrapper.toggleClass('scrollable', imgWrapperWidth < imgMenuWidth);
    };
    $(document).on('click', '.product-image-menu-wrapper.scrollable .btn-img-scroller', function()
    {
        var $btn = $(this);
        var imgMenuWidth = $imageMenu.outerWidth();
        var imgWrapperWidth = $imageMenuWrapper.width();
        var left = parseInt($imageMenu.css('left').replace('px', ''));
        if($btn.hasClass('btn-next-img'))
        {
            if(imgMenuWidth + left > imgWrapperWidth)
            {
                $imageMenu.css('left', Math.min(0, Math.max(imgWrapperWidth - imgMenuWidth, left - 56)));
            }
        }
        else
        {
            if(left < 0)
            {
                $imageMenu.css('left', Math.min(0, Math.max(imgWrapperWidth - imgMenuWidth, left + 56)));
            }
        }
    });

    $(window).resize(setImageMenu);
    setImageMenu();

    // zoom product image on hover
    var $productImage = $('#productImage');
    var $productImage2x = $('<div id="productImage2x" class="product-image-2x-wrapper" />').append($productImage.clone().attr('id', 'productImage2xWrapper').addClass('product-image-2x'));
    $productImage2x.find('.image-zoom-region').remove();
    $productImage.after($productImage2x);
    var resizeImage2x = function()
    {
        $productImage2x.width($productImage.width());
    };
    $(window).resize(resizeImage2x);
    resizeImage2x();

    var $imageZoom = $productImage.find('.image-zoom-region');
    var $productImage2xWrapper = $('#productImage2xWrapper');
    var $pageWrapper = $('.page-wrapper');
    var $img = $productImage.find('img');
    $productImage.on('mousemove', function(e)
    {
        var width = $productImage.width(), height = 300;
        var offset = $productImage.offset();
        var x = e.pageX - offset.left, y = e.pageY - offset.top;
        var position = $img.position();
        var imgWidth = $img.width(), imgHeight = $img.height();
        x = Math.max(position.left, Math.min(Math.min(width/2, position.left + imgWidth - width/2), x - width/4));
        y = Math.max(position.top, Math.min(Math.min(height/2, position.top + imgHeight - height/2), y - height/4));
        $imageZoom.css({left: x, top: y});
        $productImage2xWrapper.css({left: -2*x, top: -2*y});
    }).on('mouseleave', function(){$productImage2x.removeClass('show');})
    .on('mouseenter', function(){$productImage2x.addClass('show');});
})
