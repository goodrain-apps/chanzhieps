$(document).ready(function()
{
    var initSortable = function()
    {
        $('#childList').sortable({trigger: '.sort-handle', selector: '.category', dragCssClass: ''});
    }

    var setChildrenKey = function()
    {
        maxID = v.maxID
        $('[value=new]').each(function()
        {
            maxID ++;
            $(this).parents('.category').find('[id*=children]').attr('name', 'children[' + maxID + ']');
            $(this).parents('.category').find('[id*=alias]').attr('name', 'alias[' + maxID + ']');
            $(this).attr('name', 'mode[' + maxID + ']');
        })
    }

    initSortable();
    setChildrenKey();

    $(document).on('click', '.btn-plus, .btn-remove', function()
    {
        setTimeout(initSortable, 200);
        setTimeout(setChildrenKey, 200);
    })

});
