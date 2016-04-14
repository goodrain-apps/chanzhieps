$(function()
{
    appendFingerprint($('#loginForm'));
    $('#loginForm').ajaxform(
    {
        onSubmit: function(data)
        {
            var account = data['account'];
            var password = data['password'];
            var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            if(!reg.test(account)) password = md5(md5(md5(password) + account) + v.random);
            data['password'] = password;
        }
    });
});
