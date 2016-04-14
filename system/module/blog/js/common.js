$(document).ready(function()
{
    /* Set current active topNav. */
    if(v.path && v.path.length)
    {
        $.each(v.path, function(index, category) 
        { 
            $('.nav-blog-' + category).addClass('active');
        })
    }

   if(typeof(v.categoryID) != 'undefined') $('.tree #category' + v.categoryID).addClass('active');

   $('body').tooltip(
    {
        html: true,
        selector: "[data-toggle=tooltip]",
        container: "body"
    });
});
