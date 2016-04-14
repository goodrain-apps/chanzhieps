$().ready(function()
{
    $('.checkModule').click(function()
    {
        $(this).parents('tr').find('[type=checkbox]').prop('checked', $(this).prop('checked'));
    });

    $('.selectAll').click(function()
    {
        $(this).parents('table').find('[type=checkbox]').prop('checked', $(this).prop('checked'));
    });
    $('.nav-tabs li').click(function()
    {
        $(this).parent().find('.active').removeClass('active');
        $(this).addClass('active');
        group = $(this).data('group');
        $(this).parents('.panel').find('.panel').hide();
        if(group == 'all') $(this).parents('.panel').find('.panel').show();
        $('#group' + group).show();

    })
});

function showPriv(value)
{
  location.href = createLink('group', 'managePriv', "type=byGroup&param="+ groupID + "&menu=&version=" + value);
}
