$(document).ready(function()
{
    var $editGroupForm = $('#editGroupForm');
    var hideEditForm = function()
    {
        $('.group-title').show();
        $editGroupForm.hide();
    };

    $.setAjaxForm('#editGroupForm', function(response)
    {
        $editGroupForm.find('#submit').popover('destroy');
        if(response.result === 'success')
        {
            $editGroupForm.prev('.group-title').find('.group-name').text($editGroupForm.find('#groupName').val());
            hideEditForm();
            if(response.message)
            {
                (window.messager || $.zui.messager).success(response.message);
            }
        }
        else
        {
            (window.messager || $.zui.messager).warning(response.message);
        }
    });

    $(document).on('click', '.edit-group-btn', function()
    {
        var $group = $(this).closest('.group-title');
        $editGroupForm.attr('action', $group.data('action')).find('#groupID').val($group.data('id'));
        $editGroupForm.find('#groupName').val($group.find('.group-name').text());
        $('.group-title').show();
        $group.after($editGroupForm);
        $group.hide();
        $editGroupForm.show().find('#groupName').focus();
    }).on('click', '.btn-close-form', hideEditForm);
})
