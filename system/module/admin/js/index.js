$(document).ready(function()
{
    $('#upgradeNotice').hide();
    if($('#upgradeNotice').size())
    {
        if(typeof(latest) != 'undefined' && latest.isNew)
        {
            $('#version').html(latest.version);
            $('#releaseDate').html(latest.releaseDate);
            $('#upgradeLink').attr('href', latest.url);
            $('#upgradeNotice').show();
            return true;
        }
        $('#upgradeNotice').remove();
    }
});
