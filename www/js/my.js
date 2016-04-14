$(document).ready(function()
{
    $('#navbar, #blogNav').find('ul.navbar-nav li a').each(function()
    {
        var $a        = $(this);
        var href      = $a.attr('href'), 
            $li       = $a.parents('li'),
            url       = document.location.href;
        var hrefIndex = url.indexOf(href);
        if(href !== '/' && hrefIndex > -1 && !$li.hasClass('active') && url.substring(hrefIndex) == href && !$('ul.navbar-nav li.active').length)
        {
            $li.addClass('active');
        }
    });

    $('#navbar .dropdown-submenu, #blogNav .dropdown-submenu').mouseover(function()
    {
        var $menu = $('#navbar ul.navbar-nav > li.dropdown'); 
        if($menu.offset().left + $menu.find('.dropdown-menu').width() + $menu.find('.dropdown-submenu').find('.dropdown-menu').width() > $(window).width()) 
        {
            $(this).addClass('pull-left');
        }
    })

    setRequiredFields();

    $.setAjaxForm('#ajaxForm');
    $.setAjaxDeleter('.deleter');
    $.setReloadDeleter('.reloadDeleter');
    $.setReload('.reload');
    $.setAjaxJSONER('.jsoner');
    $.setAjaxLoader('.loadInModal', '#ajaxModal');

    /* Ping for keep login every six minute. */
    if(needPing) setInterval('ping()', 1000 * 360);

    /* Load message notify. */
    $('#headNav #msgBox').load(createLink('message', 'notify'), function()
    {
        if($('#headNav #msgBox').find('.label').length > 0) $('#msgBox').removeClass('hiding');
    });

    /* Set 'go to top' button. */
    setGo2Top();

    /* Slide pictures start.   */
    $(document).on('click', '.carousel .item[data-url]', function()
    {
        var url    = $(this).data('url');
        var target = $(this).data('target');
        if(url && url.length) window.open(url, target);
    });

    /* Fixed submenu position for browser which doesn't suppport relative postion in a table cell, like firefox 29. */
    var ua = navigator.userAgent.toLowerCase();
    var ver = (ua.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1];
    if(ua.indexOf('firefox') > -1)
    {
        if(parseFloat(ver) < 30) $('#navbar .dropdown > .dropdown-menu').each(function(){$(this).css('left', $(this).closest('.dropdown').position().left - 2);});
        else $('#navbar .dropdown').css('position', 'relative');
    }

    /* Remove empty headNav */
    var headNav = $('#headNav');
    if(!headNav.find('nav a').length) headNav.addClass('hide');

    /* set right docker */
    var $dockerBtn = $('#rightDockerBtn');
    $dockerBtn.popover({container: 'body', html:true, trigger:'manual', tipId: 'dockerPopover'}).click(function(e)
    {
        if($dockerBtn.hasClass('showed')) return;
        $('#rightDocker img[data-src]').each(function()
        {
            var $this = $(this);
            $this.attr('src', $this.data('src')).removeAttr('data-src');
        });
        $dockerBtn.addClass('showed').popover('show');
        $("#rightDockerBtn:not('.showed')").popover('hide');
        e.stopPropagation();
    });
    $(window).scroll(function()
    {
        $dockerBtn.popover('hide').removeClass('showed');
    });
    $(document).click(function(){$dockerBtn.popover('hide').removeClass('showed');}).on('click', '.popover', function(event){event.stopPropagation();});

    $('.article-content').breakAll('a');

    $('.file-md5 a').popover();

    fixFooterOfWideTheme(); // Fit footer style of the 'wide' theme

    window.onload = function()
    {
        var detective = new fontDetector();
        if(!detective.detect('Helvetica Neue') && !detective.detect('Helvetica') && detective.detect('Microsoft Yahei'))
        {
            $('#navbar a').css('font-weight', 'normal');
        }
    };

    $('#commentBox').load( createLink('message', 'comment', 'objectType=' + v.objectType + '&objectID=' + v.objectID) );
});
