function getScore()
{
    $('#score').html(Math.round($('#amount').val() * scoreConfig));
}
