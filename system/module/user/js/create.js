$().ready(function()
{
    $('[name^=admin]').change(function()
    {
        $(this).parents('tr').next().toggle();
    })
});
