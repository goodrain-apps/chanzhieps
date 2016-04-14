$(function()
{
    /* Set current active topNav. */
    var hasActive = false;
    if(v.categoryID > 0 && $('.nav-product-' + v.categoryID).length >= 1)
    {
        hasActive = true;
        $('.nav-product-' + v.categoryID).addClass('active');
    }

    if(v.categoryPath && v.categoryPath.length)
    {
        $.each(v.categoryPath, function(index, category)
        {
            if(!hasActive)
            {
                if($('.nav-product-' + category).length >= 1) hasActive = true;
                $('.nav-product-' + category).addClass('active');
            }
        });
    }
    else if(v.path && v.path.length)
    {
        $.each(v.path, function(index, category)
        {
            if(!hasActive)
            {
                if($('.nav-product-' + category).length >= 1) hasActive = true;
                $('.nav-product-' + category).addClass('active');
            }
        });
        if(!hasActive) $('.nav-product-0').addClass('active');
    }
    
    if(v.categoryID !== 0) $('#category' + v.categoryID).parent().addClass('active');
})
