$(document).ready(function()
{
   /* Sort up. */
    $(document).on('click', '.icon-arrow-up', function()
    {
        $(this).parents('tr').prev().before($(this).parents('tr')); 
        $('tr .order').each(function(index,obj){$(this).val(index + 1);});
    });

    /* Sort down. */
    $(document).on('click', '.icon-arrow-down', function()
    { 
        var hasNext = $(this).parents('tr').next().find('.icon-arrow-down').size() > 0;
        if(hasNext)
        {
            $(this).parents('tr').next().after($(this).parents('tr')); 
            $('tr .order').each(function(index,obj){$(this).val(index + 1);});
        }
    });

    $('tr .order').each(function(index,obj){$(this).val(index + 1);});

    var setCatalogKey = function()
    {
        maxID = v.maxID
        $('[value=new]').each(function()
        {
            maxID ++;
            $(this).parents('.node').find('[id*=type]').attr('name', 'type[' + maxID + ']');
            $(this).parents('.node').find('[id*=author]').attr('name', 'author[' + maxID + ']');
            $(this).parents('.node').find('[id*=title]').attr('name', 'title[' + maxID + ']');
            $(this).parents('.node').find('[id*=alias]').attr('name', 'alias[' + maxID + ']');
            $(this).parents('.node').find('[id*=keywords]').attr('name', 'keywords[' + maxID + ']');
            $(this).parents('.node').find('[id*=addedDate]').attr('name', 'addedDate[' + maxID + ']');
            $(this).parents('.node').find('[id*=order]').attr('name', 'order[' + maxID + ']');
            $(this).attr('name', 'mode[' + maxID + ']');
        })
    }

    setCatalogKey();
});
