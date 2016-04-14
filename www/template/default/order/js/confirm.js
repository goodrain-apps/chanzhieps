$(document).ready(function()
{
    $('#addressList').load(
         createLink('address', 'browse') + ' .col-md-10 .panel-body',
         function()
         {
             if($('#addressList').find('.address-list').size() == 0) $('a.createAddress').click();
             $('#addressList a').remove();
         }
    );
    $(document).on('click', '.cartDeleter', function()
    {
        var deleter = $(this);
        bootbox.confirm(v.lang.confirmDelete, function(result)
        {
            if(result)
            {
                deleter.text(v.lang.deleteing);

                $.getJSON(deleter.attr('href'), function(data) 
                {
                    if(data.result == 'success')
                    {
                        deleter.parents('tr').remove();
                        $('input[name*=count]').change();
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
    });

    $(document).on('click', '.icon-remove', function()
    {
        $('#createAddress').val(0);
        $('.div-create-address').hide();
        $('[name=address]').eq(0).prop('checked', true);
        return false;
    });

    $(document).on('click', '.cancelEdit', function(){ $(this).parents('.item').find('div').toggle()});

    $('a.createAddress').click(function()
    {
        $('#createAddress').val(1);
        $('[name=address]').prop('checked', false);
        $('.div-create-address').show();
        return false;
    });

    $.setAjaxForm('#confirmForm', function(response)
    {
        if(response.result == 'success')
        {
            location.href = response.locate;
        }
        else
        {
            if(typeof(response.message) == 'string')
            {
                bootbox.alert("<span class='text-danger'>" + response.message + "</span>");
            }
        }
    })
});
