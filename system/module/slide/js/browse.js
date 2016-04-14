$(document).ready(function()
{
    $.setAjaxForm('#sortForm', function(data)
    {
       if(data.result == 'success')
       {
            messager.success(data.message);
       }
       else
       {
            messager.danger(data.message);
       }
    });

    $('.btn-move-up, .btn-move-down').click(function()
    {
        var $this = $(this);
        if($this.hasClass('btn-move-down')) $(this).parents('tr').next().after($(this).parents('tr'));
        else $this.parents('tr').prev().before($this.parents('tr'));
        $('.btn-move-up, .btn-move-down').removeClass('disabled').removeAttr('disabled');

        ajustSortBtn();
        sort();
    });

    $('.carousel-inner .item .btn-resize').click(function()
    {
        var $this = $(this);
        $this.find('i').toggleClass('icon-resize-full').toggleClass('icon-resize-small');
        $this.closest('.item').toggleClass('show');
    });

    ajustSortBtn();

    if(v.groupID !== 0) $('.tree #group' + v.groupID).addClass('active');
});

function ajustSortBtn()
{
    var table = $('#sortForm > table > tbody');
    table.find('tr:first-child .btn-move-up').addClass('disabled').attr('disabled', 'disabled');
    table.find('tr:last-child .btn-move-down').addClass('disabled').attr('disabled', 'disabled');
}

function sort()
{
    $('input[name*=order]').each(function(index, obj) { $(this).val(index + 1); });
    $('#sortForm').submit();
}
