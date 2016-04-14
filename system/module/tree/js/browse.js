$(document).ready(function()
{
    /* Load the children of current category when page loaded. */
    var link = createLink('tree', 'children', 'type=' + v.type + '&root=' + v.root);
    $('#categoryBox').load(link, function(){if($.fn.placeholder) $('[placeholder]').placeholder();});
    $('#treeMenuBox li:has(ul)').each(function()
    {
        $(this).children('.deleter').remove();
    });

    $.setAjaxLoader('#treeMenuBox .ajax', '#categoryBox', function(){if($.fn.placeholder) $('[placeholder]').placeholder();});

    $('a.jsoner').click(function()
    {
        url = $(this).attr('href');
        var button = $(this);
        $.getJSON(url, function(response)
        {
            if(response.result == 'success')
            {
                 button.popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
                 button.next('.popover').addClass('popover-success');
                 function distroy(){button.popover('destroy')}
                 setTimeout(distroy,2000);
            }
            else
            {
                bootbox.alert(response.message);
            }
        });
        return false;
    });

    $(document).on('click', '.btn-plus', function()
    {
        $(this).parents('.form-group').after($('.child').html());
    })

    $(document).on('click', '.btn-remove', function()
    {
        if($(this).parents('#childForm').find('.form-group').not('.hide .form-group').find(':input[value=new]').size() == 1)
        {
            $(this).parents('.form-group').find('input').not('input[type=hidden]').val('');
            return false;
        }
        $(this).parents('.form-group').remove();
    })

    if(v.isWechatMenu) $(".leftmenu a[href*='wechat']").parent().addClass('active');

    if(v.type == 'slide') $("a[href*='slide']").parent().addClass('active');
    $.setAjaxForm('#childForm');
})
