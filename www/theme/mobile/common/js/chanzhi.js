// https://github.com/dankogai/js-base64
(function(global){"use strict";var _Base64=global.Base64;var version="2.1.9";var buffer;if(typeof module!=="undefined"&&module.exports){try{buffer=require("buffer").Buffer}catch(err){}}var b64chars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";var b64tab=function(bin){var t={};for(var i=0,l=bin.length;i<l;i++)t[bin.charAt(i)]=i;return t}(b64chars);var fromCharCode=String.fromCharCode;var cb_utob=function(c){if(c.length<2){var cc=c.charCodeAt(0);return cc<128?c:cc<2048?fromCharCode(192|cc>>>6)+fromCharCode(128|cc&63):fromCharCode(224|cc>>>12&15)+fromCharCode(128|cc>>>6&63)+fromCharCode(128|cc&63)}else{var cc=65536+(c.charCodeAt(0)-55296)*1024+(c.charCodeAt(1)-56320);return fromCharCode(240|cc>>>18&7)+fromCharCode(128|cc>>>12&63)+fromCharCode(128|cc>>>6&63)+fromCharCode(128|cc&63)}};var re_utob=/[\uD800-\uDBFF][\uDC00-\uDFFFF]|[^\x00-\x7F]/g;var utob=function(u){return u.replace(re_utob,cb_utob)};var cb_encode=function(ccc){var padlen=[0,2,1][ccc.length%3],ord=ccc.charCodeAt(0)<<16|(ccc.length>1?ccc.charCodeAt(1):0)<<8|(ccc.length>2?ccc.charCodeAt(2):0),chars=[b64chars.charAt(ord>>>18),b64chars.charAt(ord>>>12&63),padlen>=2?"=":b64chars.charAt(ord>>>6&63),padlen>=1?"=":b64chars.charAt(ord&63)];return chars.join("")};var btoa=global.btoa?function(b){return global.btoa(b)}:function(b){return b.replace(/[\s\S]{1,3}/g,cb_encode)};var _encode=buffer?function(u){return(u.constructor===buffer.constructor?u:new buffer(u)).toString("base64")}:function(u){return btoa(utob(u))};var encode=function(u,urisafe){return!urisafe?_encode(String(u)):_encode(String(u)).replace(/[+\/]/g,function(m0){return m0=="+"?"-":"_"}).replace(/=/g,"")};var encodeURI=function(u){return encode(u,true)};var re_btou=new RegExp(["[À-ß][-¿]","[à-ï][-¿]{2}","[ð-÷][-¿]{3}"].join("|"),"g");var cb_btou=function(cccc){switch(cccc.length){case 4:var cp=(7&cccc.charCodeAt(0))<<18|(63&cccc.charCodeAt(1))<<12|(63&cccc.charCodeAt(2))<<6|63&cccc.charCodeAt(3),offset=cp-65536;return fromCharCode((offset>>>10)+55296)+fromCharCode((offset&1023)+56320);case 3:return fromCharCode((15&cccc.charCodeAt(0))<<12|(63&cccc.charCodeAt(1))<<6|63&cccc.charCodeAt(2));default:return fromCharCode((31&cccc.charCodeAt(0))<<6|63&cccc.charCodeAt(1))}};var btou=function(b){return b.replace(re_btou,cb_btou)};var cb_decode=function(cccc){var len=cccc.length,padlen=len%4,n=(len>0?b64tab[cccc.charAt(0)]<<18:0)|(len>1?b64tab[cccc.charAt(1)]<<12:0)|(len>2?b64tab[cccc.charAt(2)]<<6:0)|(len>3?b64tab[cccc.charAt(3)]:0),chars=[fromCharCode(n>>>16),fromCharCode(n>>>8&255),fromCharCode(n&255)];chars.length-=[0,0,2,1][padlen];return chars.join("")};var atob=global.atob?function(a){return global.atob(a)}:function(a){return a.replace(/[\s\S]{1,4}/g,cb_decode)};var _decode=buffer?function(a){return(a.constructor===buffer.constructor?a:new buffer(a,"base64")).toString()}:function(a){return btou(atob(a))};var decode=function(a){return _decode(String(a).replace(/[-_]/g,function(m0){return m0=="-"?"+":"/"}).replace(/[^A-Za-z0-9\+\/]/g,""))};var noConflict=function(){var Base64=global.Base64;global.Base64=_Base64;return Base64};global.Base64={VERSION:version,atob:atob,btoa:btoa,fromBase64:decode,toBase64:encode,utob:utob,encode:encode,encodeURI:encodeURI,btou:btou,decode:decode,noConflict:noConflict};if(typeof Object.defineProperty==="function"){var noEnum=function(v){return{value:v,enumerable:false,writable:true,configurable:true}};global.Base64.extendString=function(){Object.defineProperty(String.prototype,"fromBase64",noEnum(function(){return decode(this)}));Object.defineProperty(String.prototype,"toBase64",noEnum(function(urisafe){return encode(this,urisafe)}));Object.defineProperty(String.prototype,"toBase64URI",noEnum(function(){return encode(this,true)}))}}if(global["Meteor"]){Base64=global.Base64}})(this);

$(function()
{
   /**
   * Set required fields, add star class to them.
   *
   * @access public
   * @return void
   */
    var setRequiredFields = function()
    {
        if(!config || !config.requiredFields) return;
        var requiredFields = config.requiredFields.split(',');
        for(i = 0; i < requiredFields.length; i++)
        {
            var $field = $('#' + requiredFields[i]);
            $field.closest('td,th').prepend("<div class='required required-wrapper'></div>");
            $field.closest('.form-group').addClass('required');
            if(window.v && window.v.lang.required)
            {
                $field.attr('placeholder', '(' + window.v.lang.required + ') ' + ($field.attr('placeholder') || ''));
            }
        }
    };

    // Set required feilds in form
    setRequiredFields();

    // make company links on app navbar as modalTrigger to open content with modal
    $('#appnav .nav-system-company a, #appnav a[data-toggle="modal"]').modalTrigger();

    // set active item on #appnav
    var $appNav = $('#appnav');
    var activedNav = v.activedNav;
    if(!activedNav)
    {
        if(config && config.currentModule)
        {
            var moduleName = config.currentModule;
            if(moduleName === 'article' || moduleName === 'product' || moduleName === 'blog')
            {
                var liFinded = false;
                $appNav.find('li > a').each(function()
                {
                    var $a        = $(this);
                    var href      = $a.attr('href'), 
                        $li       = $a.parents('li'),
                        pathName  = document.location.pathname;
                    var hrefIndex = href.indexOf(pathName);
                    if(href !== '/' && hrefIndex === 0 && !$li.hasClass('active'))
                    {
                        $li.addClass('active');
                        liFinded = true;
                    }
                });
                if(!liFinded) activedNav = '.nav-' + moduleName + '-0';
            }
            else activedNav = '.nav-system-' + (moduleName === 'index' ? 'home' : moduleName);
        }
    }
    $appNav.find(activedNav).addClass('active');

    // init deleter
    $(document).on('click', '.deleter', function(e)
    {

        var $this   = $(this);
        var options = $.extend({url: $this.attr('href'), confirm: window.v.lang.confirmDelete}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });

    function tidyCardsRow($row)
    {
        var $cards = $row.children('.col');
        if($cards.length < 2)
        {
            $cards.css('width', '100%');
            return;
        }
        var contentHeight = 0, minImgHeight = 9999, maxImgHeight = 0;
        var width = 100.0 / $cards.length;
        $cards.each(function()
        {
            var $col = $(this).css('width', width + '%');
            contentHeight = Math.max(contentHeight, $col.find('.card-content').height());
            var $img = $col.find('.card-img').css('height', 'auto');
            var imgHeight = $img.height();
            if(!$img.find('.media-placeholder').length) minImgHeight = Math.min(minImgHeight, imgHeight);
            maxImgHeight = Math.max(maxImgHeight, imgHeight);
        });
        if(minImgHeight === 9999) return;
        $cards.find('.card-content').css('height', contentHeight);
        if(minImgHeight > 20)
        {
            $cards.find('.card-img').css({'height': minImgHeight})
                .find('.media-placeholder').css({'height': minImgHeight, 'line-height': minImgHeight + 'px'});
        }
        if(maxImgHeight !== minImgHeight || minImgHeight <= 20) {setTimeout(function(){tidyCardsRow($row);}, 500);}
    };

    $.fn.tidyCards = function()
    {
        return $(this).each(function()
        {
            $(this).children('.row').each(function(){tidyCardsRow($(this));});
        });
    };
    $('.cards-products').tidyCards();

    $(window).on('lazyloaded', function(e, $img)
    {
        var $row = $img.closest('.row');
        if($row.parent().hasClass('cards-products')) tidyCardsRow($row);
    })
});

function appendFingerprint(form)
{
    if(form.data('checkfingerprint'))
    {
        var fingerprint = getFingerprint();
        if(form.find('#fingerprint').size() == 0)
        {
            form.append("<input type='hidden' id='fingerprint'  name='fingerprint' value='" + fingerprint + "'>");
        }
        else
        {
            $('#fingerprint').val(fingerprint);
        }
    }
}

function getFingerprint()
{
    if(typeof(Fingerprint) == 'function') return new Fingerprint().get();

    var fingerprint = '';
    $.each(navigator, function(key, value)
    {
        if(typeof(value) == 'string') fingerprint += value.length;
    })
    return fingerprint;
}


