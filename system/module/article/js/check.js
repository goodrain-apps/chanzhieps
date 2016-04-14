$(document).ready(function()
{
    $('.blogTD').hide();
    $('[name=type]').change(function()
    {
        type = $(this).val();
        $('.articleTD, .blogTD').hide();
        $('.' + type + 'TD').show();
    });
    $('#source').change();
    $(document).on('click', '.rejecter', function()
    {
        var deleter = $(this);
        bootbox.confirm(v.confirmReject, function(result)
        {
            if(result)
            {
                deleter.text(v.lang.doing);

                $.getJSON(deleter.attr('href'), function(data)
                {
                    if(data.result == 'success')
                    {
                        location.href = data.locate;
                        return true;
                    }
                    else
                    {
                        alert(data.message);
                    }
                });
            }
            return true;
       });
       return false;
    })
});
