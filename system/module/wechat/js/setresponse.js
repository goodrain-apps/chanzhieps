$(document).ready(function()
{
    $.setAjaxForm('#responseForm');
    $('#type').change(function()
    {
        $('#responseForm').find('.link, .text, .news').hide().find(':input, select').attr('disabled', true);
        $('#responseForm').find('.' + $(this).val()).show().find(':input, select').attr('disabled', false);;
    });

    $('#type').change();

    $('select[name=source]').change(function()
    {
        $(this).parent().next('.manual').toggle($(this).val() == 'manual').find(':input').focus();   
    });

    $('select[name=source]').change();

    $('#block').change(function()
    {
         $('.articleTree, .productTree').hide().find('select').attr('disabled', true);

         var block = $(this).val();
         if((/.*article.*/i).test(block))
         {
             $('.articleTree').show().find('select').attr('disabled', false);
         }
         else
         {
             $('.productTree').show().find('select').attr('disabled', false);
         }

         $('#limit').toggle(!(/.*Tree.*/i).test(block));
    });
    $('#block').change();
});
