$(document).ready(function()
{
    $('#agree').change(function()
    {
        $('.btn-primary').attr('disabled', !$(this).prop('checked'));
    });
});
