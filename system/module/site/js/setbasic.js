$(document).ready(function()
{
    $('input[name=status]').click(function()
    {
        if($('#status2').prop('checked'))
        {
            $('.pauseTip').show();
        }
        else
        {
            $('.pauseTip').hide();
        }
    });

    $('input[type=checkbox][value=score]').change(function()
    {
        if(!$('input[type=checkbox][value=score]').prop('checked'))
        {
            bootbox.alert(v.closeScoreTip);
        }
    });

    /* Change set lang imput. */
    $('input[type=checkbox]').change(function()
    {
        if($('input[type=checkbox][value=zh-cn]').prop('checked') && $('input[type=checkbox][value=zh-tw]').prop('checked'))
        {
            $('#twTR').show();
        }
        else
        {
            $('#twTR').hide();
        }

        $('input[type=checkbox]').each(function()
        {
            checked = $(this).prop('checked');
            lang = $(this).val();
            if(!checked)
            {
                $('#defaultLang').find('[value=' + lang  + ']').prop('disabled', true);
            }
            else
            {
                $('#defaultLang').find('[value=' + lang  + ']').prop('disabled', false);
            }
        })
    });

    $('input[type=checkbox][id*=lang]').change();
})
