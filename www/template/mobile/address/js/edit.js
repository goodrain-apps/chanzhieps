$(function()
{
    var $editForm = $('#editForm');
    $editForm.ajaxform({onResultSuccess: function(response)
    {
        $.closeModal();
        if($.isFunction($.refreshAddressList))
        {
            setTimeout($.refreshAddressList, 200);
            response.locate = false;
        }
    }});
});
