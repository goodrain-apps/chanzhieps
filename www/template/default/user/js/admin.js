$(document).ready(function()
{
    /* Set forbid link options. */
    $('td.operate a.forbider').click(function()
    {
        $.getJSON($(this).attr('href'),function(data)
        {
            alert(data.message);
            return location.reload();
        });
        return false;
    });

    $('.form-search').submit(function()
    {
        var inputValue = $(".search-query").val();
        if(inputValue == '')
        {
            alert('请输入用户名');
            return false;
        }
    });

    /* Set active menu. */
    $('.leftmenu li.active').removeClass('active');
    $(".leftmenu a[href*='provider=" + v.provider  + "']").parent().addClass('active');
    if($('.leftmenu li.active').size() == 0) $('.leftmenu li:first').addClass('active');

    $('#pullBtn').click(function()
    {
        url = $(this).attr('href');
        $(this).text(v.lang.loading);
        $.getJSON(url, function(response)
        {
            if(response.result == 'success')
            {
                window.location.reload();
            }
            else
            {
                bootbox.alert(response.message);
            }
        });
        return false;
    });
});
