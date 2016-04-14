$(function()
{
    $('#ajaxModal').on('shown.bs.modal', function(e)
    {
        var e = document.getElementById('recordsBox');
        e.scrollTop = e.scrollHeight;
    });
});
