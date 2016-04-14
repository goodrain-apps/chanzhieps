$(function()
{
    setInterval(function()
    {
        var countDown = $('#countDown');
        var count = parseInt(countDown.text());
        if(count > 1)
        {
            countDown.text(count-1);
        }
        else
        {
            window.location.href = $('#countDownBtn').attr('href');
        }
    }, 1000);
})
