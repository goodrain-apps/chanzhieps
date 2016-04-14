$(document).ready(function()
{
    var fixForm = function()
    {
        $('#navList').sortable({trigger: '.sort-handle-1', selector: 'li', dragCssClass: ''});
        $('#navList .ulGrade2').sortable({trigger: '.sort-handle-2', selector: 'li', dragCssClass: ''});
        $('#navList .ulGrade3').sortable({trigger: '.sort-handle-3', selector: 'li', dragCssClass: ''});
        $('.shut').each(function()
        {
            if(!$(this).parent().find('ul li').size())
            {
                $(this).hide();
                $(this).next('.icon-circle').show();
            }
            else
            {
                $(this).show();
                $(this).next('.icon-circle').hide();
            }
        });
    }

    fixForm();

    /* add grade1 memu options */
    $(document).on('click', '.plus1', function()
    {
        $(this).parent().after($('#grade1NavSource').html());
        fixForm();
    });

    /* add grade2 memu options */
    $(document).on('click', '.plus2', function() 
    {
        var container = $(this).parents('.liGrade2');
        if(0 == container.size())
        { 
            $(this).parents('.liGrade1').find('.ulGrade2').show().prepend($('#grade2NavSource ul').html());
        }
        else
        {
            $(this).parent().after($('#grade2NavSource ul').html()); 
        }
        fixForm();
    });

    /* add grade3 memu options */
    $(document).on('click', '.plus3', function() 
    {
        var container = $(this).parents('.liGrade3');
        if(0 == container.size())
        { 
            $(this).parents('.liGrade2').find('.ulGrade3').show().prepend($('#grade3NavSource ul').html());
        }
        else
        {
            $(this).parent().after($('#grade3NavSource ul').html()); 
        }
        fixForm();
    });

    /* toggle children nav. */
    $(document).on('click', '.shut', function()
    {
        $(this).parent().find("ul").toggle();
        if($(this).parent().find('ul li').size() != 0)
        $(this).toggleClass('icon-folder-close').toggleClass('icon-folder-open-alt'); 
    });

    /* sort up. */
    $(document).on('click', '.icon-arrow-up', function()
    {
        $(this).parent().prev().before($(this).parent()); 
    });

    /* sort down. */
    $(document).on('click', '.icon-arrow-down', function()
    { 
        var hasNext = $(this).parent().next().find('input').size() > 0;
        if(hasNext) $(this).parent().next().after($(this).parent()); 
    });

    /* delete nav. */
    $(document).on('click', '.remove', function()
    {
        var navCount = $(this).parent().is('.liGrade1') && $('.navList .liGrade1').size();

        if(navCount == 1)
        {
            bootbox.alert(v.cannotRemoveAll);
        }
        else 
        {
            $(this).parent().remove();
        }
    });

    /* toggle articl common selector.*/
    $(document).on('change', '.navType', function() 
    {
        type  = $(this).val();
        grade = $(this).attr('grade');

        if(type != 'custom')
        {
            $(this).parent().children('.urlInput').hide();
            $(this).parent().children('.navSelector').hide();
            $(this).parent().children('.navSelector[name*='+type+']').removeClass('hide').show().change();
        }
        else
        {
            $(this).parent().children(':input[type=text]').val('');
            $(this).parent().children('.navSelector').hide();
            $(this).parent().children('.urlInput').removeClass('hide').show(); 
        }
    });

    /* set default nav title when selector changed. */
    $(document).on('change', '.navSelector', function()
    { 
        categories = $(this).find(':selected').text().split('/');
        if(!categories.length) return false;
        $(this).parent().children('.titleInput').val( categories[categories.length-1] );
    });
    
    $.setAjaxForm('#navForm');

    if(v.type == 'mobile_bottom') $('.plus2, .plus3').hide();
});

/**
 * Group navs and submit form
 *
 * @return void 
 */
function submitForm()
{
    $('.navList .grade1key').each(function(index,obj) { $(this).val(index); });
    $('.navList .grade2key').each(function(index){ $(this).val(1000+(parseInt(index))); })
    $('.navList .grade2parent').each(function(index){ $(this).val( $(this).parents('.liGrade1').children('.grade1key').val()); });
    $('.navList .grade3parent').each(function(i){ p = $(this).parents('.liGrade2').children('.grade2key').val(); $(this).val(p); });
    $('#navForm').submit();
}
