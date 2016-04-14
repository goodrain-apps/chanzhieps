$(document).ready(function()
{
    $.each(v.parents, function(index,value)
    {
        $('#board').find("[value=" + value + ']').prop('hidden', true);
        $("#board")[0].selectedIndex =1;
    });
});
