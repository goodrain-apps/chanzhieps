function selectFile(obj, callback)
{
    var url = $(obj).attr('data-url');
    $('#' + v.id).val(url);
    $('#ajaxModal').modal('hide');
    if($.isFunction(callback)) return callback();
}
