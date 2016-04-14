$(document).ready(function()
{
    $.setAjaxForm('#editForm', function()
    {
        /* After the form posted, refresh the treeMenuBox content. */
        source = createLink('tree', 'browse', 'type=' + v.type) + ' #treeMenuBox';
        $('#treeMenuBox').parent().load(source, function()
        {
            /* Rebuild the tree menu after treeMenuBox refreshed. */
            $(".tree").treeview({collapsed: false, unique: false});

            /* enable palceholder for ie8 */
            if($.fn.placeholder) $('[placeholder]').placeholder();
        });
    });

    $('#isLink').change(function()
    {   
        if($(this).prop('checked'))
        {   
            $('.categoryInfo').hide();
            $('.link').show();
        }   
        else
        {   
            $('.categoryInfo').show();
            $('.link').hide();
        }   
    }); 

    $('#isLink').change();
});
