$(document).ready(function()
{
    $("#targetBoard option:nth-child(2)").attr("selected", true);
    $('#targetBoard').find("[value=" + v.currentBoard + ']').prop('disabled', true);

    $.each(v.parents, function(index,value)
    {
        $('#targetBoard').find("[value=" + value + ']').prop('disabled', true);
    });
});
