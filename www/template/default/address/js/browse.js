$(document).ready(function()
{
    $.setAjaxForm('#createForm');
    $.setAjaxForm('.editForm');
    $('.form-edit').hide();
    $('#createForm').load(createLink('address', 'create')).hide();
    $('#createBtn').click(function(){$('#createForm').toggle();});
  
    $(document).on('click', '.submit', function(){$(this).parents('form').submit()});

    $('.editor').click(function()
    {
        $(this).parents('.item').find('div').toggle();
        $(this).parents('.item').find('.form-edit').load($(this).attr('href'));
        return false;
    });

    $(document).on('click', '.cancelEdit', function(){ $(this).parents('.item').find('div').toggle()});
});
