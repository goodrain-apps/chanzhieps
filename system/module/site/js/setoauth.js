$(document).ready(function()
{
    $.setAjaxForm('#sinaAjaxForm');
    $.setAjaxForm('#qqAjaxForm');

    $('.panel-box .table-form').height($('.panel-box:first .table-form').height());
});
