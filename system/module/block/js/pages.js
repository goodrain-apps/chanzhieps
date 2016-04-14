$(document).ready(function()
{
    $(document).on('click', 'a.plus', function()
    {
        v.key ++;
        $(this).parent().parent().after($('#entry').html().replace(/key/g, v.key));
        computeParent();
    });

    $(document).on('click', 'a.plus-child', function()
    {
        v.key ++;
        $('#child').find('[name*=parent]').val($(this).parents('.block-item').data('block'));
        var child = $('#child').html().replace(/key/g, v.key);
        $(this).parent().parent().after(child);
        computeParent();
    });

    $(document).on('click', 'a.btn-add-child', function()
    {
        v.key ++;
        $('#child').find('[name*=parent]').val($(this).parents('.block-item').data('block'));
        var entry = $('#child').html().replace(/key/g, v.key);
        $(this).parent().parent().find('.children').append(entry);
        if($(this).parent().parent().find('[name=isRegion]').val() != 1)
        {
            $(this).parent().siblings(0).children('.block').val(0).attr('readonly', true);
        }
        computeParent();
    });

    /* Set border and title show. */
    $(document).on('change', 'input[type=checkbox]', function()
    { 
        $('input[type=checkbox]').next('input[type=hidden]').val('0');
        $('input:checked').next('input[type=hidden]').val('1');
    });
    
    $('input[type=checkbox]').change();

    /* Fix edit link. */
    $(document).on('change', 'select', function()
    {
        $(this).parents('td').next().find('.edit').attr('href', createLink('block', 'edit', 'id=' + $(this).val()));
    });

    /* Delete options. */
    $(document).on('click', '.delete', function()
    {
        if($(this).parents('.children').size() == 0)
        {
            $(this).parents('.block-item').remove();
        }
        else
        {
            $(this).parent().parent('.block-item').remove();
        }
    });

   /* Sort up. */
    $(document).on('click', '.icon-arrow-up', function()
    {
        $(this).parents('tr').prev().before($(this).parents('tr')); 
    });

    /* Sort down. */
    $(document).on('click', '.icon-arrow-down', function()
    { 
        var hasNext = $(this).parents('tr').next().find('.plus').size() > 0;
        if(hasNext) $(this).parents('tr').next().after($(this).parents('tr')); 
    });

})

function computeParent()
{
    $('[name*=parent]').each(function(){$(this).val($(this).parents('.children').parents('.block-item').data('block'));});
}
