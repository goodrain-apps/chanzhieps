// https://github.com/dankogai/js-base64
(function(global){"use strict";var _Base64=global.Base64;var version="2.1.9";var buffer;if(typeof module!=="undefined"&&module.exports){try{buffer=require("buffer").Buffer}catch(err){}}var b64chars="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";var b64tab=function(bin){var t={};for(var i=0,l=bin.length;i<l;i++)t[bin.charAt(i)]=i;return t}(b64chars);var fromCharCode=String.fromCharCode;var cb_utob=function(c){if(c.length<2){var cc=c.charCodeAt(0);return cc<128?c:cc<2048?fromCharCode(192|cc>>>6)+fromCharCode(128|cc&63):fromCharCode(224|cc>>>12&15)+fromCharCode(128|cc>>>6&63)+fromCharCode(128|cc&63)}else{var cc=65536+(c.charCodeAt(0)-55296)*1024+(c.charCodeAt(1)-56320);return fromCharCode(240|cc>>>18&7)+fromCharCode(128|cc>>>12&63)+fromCharCode(128|cc>>>6&63)+fromCharCode(128|cc&63)}};var re_utob=/[\uD800-\uDBFF][\uDC00-\uDFFFF]|[^\x00-\x7F]/g;var utob=function(u){return u.replace(re_utob,cb_utob)};var cb_encode=function(ccc){var padlen=[0,2,1][ccc.length%3],ord=ccc.charCodeAt(0)<<16|(ccc.length>1?ccc.charCodeAt(1):0)<<8|(ccc.length>2?ccc.charCodeAt(2):0),chars=[b64chars.charAt(ord>>>18),b64chars.charAt(ord>>>12&63),padlen>=2?"=":b64chars.charAt(ord>>>6&63),padlen>=1?"=":b64chars.charAt(ord&63)];return chars.join("")};var btoa=global.btoa?function(b){return global.btoa(b)}:function(b){return b.replace(/[\s\S]{1,3}/g,cb_encode)};var _encode=buffer?function(u){return(u.constructor===buffer.constructor?u:new buffer(u)).toString("base64")}:function(u){return btoa(utob(u))};var encode=function(u,urisafe){return!urisafe?_encode(String(u)):_encode(String(u)).replace(/[+\/]/g,function(m0){return m0=="+"?"-":"_"}).replace(/=/g,"")};var encodeURI=function(u){return encode(u,true)};var re_btou=new RegExp(["[À-ß][-¿]","[à-ï][-¿]{2}","[ð-÷][-¿]{3}"].join("|"),"g");var cb_btou=function(cccc){switch(cccc.length){case 4:var cp=(7&cccc.charCodeAt(0))<<18|(63&cccc.charCodeAt(1))<<12|(63&cccc.charCodeAt(2))<<6|63&cccc.charCodeAt(3),offset=cp-65536;return fromCharCode((offset>>>10)+55296)+fromCharCode((offset&1023)+56320);case 3:return fromCharCode((15&cccc.charCodeAt(0))<<12|(63&cccc.charCodeAt(1))<<6|63&cccc.charCodeAt(2));default:return fromCharCode((31&cccc.charCodeAt(0))<<6|63&cccc.charCodeAt(1))}};var btou=function(b){return b.replace(re_btou,cb_btou)};var cb_decode=function(cccc){var len=cccc.length,padlen=len%4,n=(len>0?b64tab[cccc.charAt(0)]<<18:0)|(len>1?b64tab[cccc.charAt(1)]<<12:0)|(len>2?b64tab[cccc.charAt(2)]<<6:0)|(len>3?b64tab[cccc.charAt(3)]:0),chars=[fromCharCode(n>>>16),fromCharCode(n>>>8&255),fromCharCode(n&255)];chars.length-=[0,0,2,1][padlen];return chars.join("")};var atob=global.atob?function(a){return global.atob(a)}:function(a){return a.replace(/[\s\S]{1,4}/g,cb_decode)};var _decode=buffer?function(a){return(a.constructor===buffer.constructor?a:new buffer(a,"base64")).toString()}:function(a){return btou(atob(a))};var decode=function(a){return _decode(String(a).replace(/[-_]/g,function(m0){return m0=="-"?"+":"/"}).replace(/[^A-Za-z0-9\+\/]/g,""))};var noConflict=function(){var Base64=global.Base64;global.Base64=_Base64;return Base64};global.Base64={VERSION:version,atob:atob,btoa:btoa,fromBase64:decode,toBase64:encode,utob:utob,encode:encode,encodeURI:encodeURI,btou:btou,decode:decode,noConflict:noConflict};if(typeof Object.defineProperty==="function"){var noEnum=function(v){return{value:v,enumerable:false,writable:true,configurable:true}};global.Base64.extendString=function(){Object.defineProperty(String.prototype,"fromBase64",noEnum(function(){return decode(this)}));Object.defineProperty(String.prototype,"toBase64",noEnum(function(urisafe){return encode(this,urisafe)}));Object.defineProperty(String.prototype,"toBase64URI",noEnum(function(){return encode(this,true)}))}}if(global["Meteor"]){Base64=global.Base64}})(this);

/* Set trigger modal default name to 'ajaxModal'. */
+(function(){$.ModalTriggerDefaults = {name: 'ajaxModal'};})();

$.extend(
{
    setAjaxForm: function(formID, callback)
    {
        if(typeof(ajaxForms) != "string")
        {
            ajaxForms = ',' + formID  + ',';
        }
        else
        {
            if(ajaxForms.indexOf(formID) != -1) return;
            ajaxForms = ',' + formID  + ',';
        }
        
        appendFingerprint(formID);
        form = $(formID);

        var options =
        {
            target  : null,
            timeout : 60000,
            dataType:'json',

            success: function(response)
            {
                appendFingerprint(formID);
                $.enableForm(formID);
                var submitButton = $(formID).find(':input[type=submit], .submit');

                /* The response is not an object, some error occers, bootbox.alert it. */
                if($.type(response) != 'object')
                {
                    if(response) return bootbox.alert(response);
                    return bootbox.alert('No response.');
                }

                var showPopover = function(type, message) {
                    type = type || 'success';
                    message = message || response.message;
                    var container = submitButton.data('popoverContainer');
                    if(container === undefined) container = 'body';
                    submitButton.popover({container: container, trigger:'manual', content:message, placement: submitButton.data('placement') || 'right', tipClass: 'popover-' + type + ' popover-ajaxform'}).popover('show');
                    setTimeout(function(){submitButton.popover('destroy');}, 2000);
                };

                /* The response.result is success. */
                if(response.result == 'success')
                {
                    if(response.message && response.message.length) showPopover();

                    if($.isFunction(callback)) return callback(response);

                    if($('#responser').length && response.message && response.message.length)
                    {
                        $('#responser').html(response.message).addClass('red f-12px').show().delay(3000).fadeOut(100);
                    }

                    if(response.locate)
                    {
                        return setTimeout(function(){location.href = response.locate;}, 1200);
                    }

                    return true;
                }

                /**
                 * The response.result is fail.
                 */

                /* The result.message is just a string. */
                if($.type(response.message) == 'string')
                {
                    if($('#responser').length == 0)
                    {
                        showPopover('danger');
                    }
                    else $('#responser').html(response.message).addClass('red f-12px').show().delay(5000).fadeOut(100);
                }

                /* The result.message is just a object. */
                if($.type(response.message) == 'object')
                {
                    $.each(response.message, function(key, value)
                    {
                        /* Define the id of the error objecjt and it's label. */
                        var errorOBJ   = '#' + key;
                        var errorLabel =  key + 'Label';

                        /* Create the error message. */
                        var errorMSG = '<span id="'  + errorLabel + '" for="' + key  + '"  class="text-error red">';
                        errorMSG += $.type(value) == 'string' ? value : value.join(';');
                        errorMSG += '</span>';

                        /* Append error message, set style and set the focus events. */
                        $('#' + errorLabel).remove();
                        var $errorOBJ = $(errorOBJ);
                        if($errorOBJ.closest('.input-group').length > 0)
                        {
                            $errorOBJ.closest('.input-group').after(errorMSG)
                        }
                        else
                        {
                            $errorOBJ.parent().append(errorMSG);
                        }
                        $errorOBJ.css('margin-bottom', 0);
                        $errorOBJ.css('border-color','#953B39')
                        $errorOBJ.change(function()
                        {
                            $errorOBJ.css('margin-bottom', 0);
                            $errorOBJ.css('border-color','')
                            $('#' + errorLabel).remove();
                        });
                    })

                    /* Focus the first error field thus to nitify the user. */
                    var firstErrorField = $('#' +$('span.red').first().attr('for'));
                    topOffset = parseInt(firstErrorField.offset().top) - 20;   // 20px offset more for margin.

                    /* If there's the navbar-fixed-top element, minus it's height. */
                    if($('.navbar-fixed-top').size())
                    {
                        topOffset = topOffset - parseInt($('.navbar-fixed-top').height());
                    }

                    /* Scroll to the error field and foucus it. */
                    $(document).scrollTop(topOffset);
                    firstErrorField.focus();
                }

                if($.isFunction(callback)) return callback(response);
            },

            /* When error occers, alert the response text, status and error. */
            error: function(jqXHR, textStatus, errorThrown)
            {
                $.enableForm(formID);
                if(textStatus == 'timeout')
                {
                    bootbox.alert(v.lang.timeout);
                    return false;
                }
                bootbox.alert(v.lang.errorThrown + '<div class="alert">' + jqXHR.responseText + '</div>');
            }
        };

        var storageName = 'ajaxFormOptions';
        if(!$[storageName]) $[storageName] = {};
        $[storageName][formID] = options;
        form.data(storageName, options);

        if(!form.data('ajaxFormSubmitEvent'))
        {
            /* Call ajaxSubmit to sumit the form. */
            $(document).on('submit.ajaxform', formID, function()
            {
                $.disableForm(formID);
                var $this = $(this);
                $this.ajaxSubmit($this.data('ajaxFormOptions') || $.ajaxFormOptions[formID]);
                return false;    // Prevent the submitting event of the browser.
            });
            form.data('ajaxFormSubmitEvent', true);
        }
    },

    /* Switch the label and disabled attribute for the submit button in a form. */
    setSubmitButton: function(formID, action)
    {
        var submitButton = $(formID).find(':submit');

        label    = submitButton.val();
        loading  = submitButton.data('loading');
        disabled = action == 'disable';

        submitButton.attr('disabled', disabled);
        submitButton.val(loading);
        submitButton.data('loading', label);
    },

    /* Disable a form. */
    disableForm: function(formID)
    {
        $.setSubmitButton(formID, 'disable');
    },

    /* Enable a form. */
    enableForm: function(formID)
    {
        $.setSubmitButton(formID, 'enable');
    }
});

$.extend(
{
    /**
     * Set ajax loader.
     *
     * Bind click event for some elements thus when click them,
     * use $.load to load page into target.
     *
     * @param string selector
     * @param string target
     * @param funtion callback
     */
    setAjaxLoader: function(selector, target, callback)
    {
        var target = $(target);
        if(!target.size()) return false;

        $(document).on('click', selector, function()
        {
            url = $(this).attr('href');
            if(!url) url = $(this).data('rel');
            if(!url) return false;

            target.attr('rel', url);

            target.load(url, function()
            {
                if(target.hasClass('modal'))
                {
                    $.ajustModalPosition('fit', target);
                }
                callback && callback();
            });

            return false;
        });
    },

    /**
     * Set ajax jsoner.
     *
     * @param string   selector
     * @param object   callback
     */
    setAjaxJSONER: function(selector, callback)
    {
        $(document).on('click', selector, function()
        {
            /* Try to get the href of current element, then try it's data-rel attribute. */
            url = $(this).attr('href');
            if(!url) url = $(this).data('rel');
            if(!url) return false;

            $.getJSON(url, function(response)
            {
                /* If set callback, call it. */
                if($.isFunction(callback)) return callback(response);

                /* If the response has message attribute, show it in #responser or alert it. */
                if(response.message)
                {
                    if($('#responser').length)
                    {
                        $('#responser').html(response.message);
                        $('#responser').addClass('text-info f-12px');
                        $('#responser').show().delay(3000).fadeOut(100);
                    }
                    else
                    {
                        bootbox.alert(response.message);
                    }
                }

                /* If the response has locate param, locate the browse. */
                if(response.locate) return setTimeout(function(){location.href = response.locate;}, 1200);

                /* If target and source returned in reponse, update target with the source. */
                if(response.target && response.source)
                {
                    $(response.target).load(response.source);
                }
            });

            return false;
        });
    },

    /**
     * Set ajax deleter.
     *
     * @param  string $selector
     * @access public
     * @return void
     */
    setAjaxDeleter: function (selector)
    {
        $(document).on('click', selector, function()
        {
            var deleter = $(this);
            message = deleter.data('message') ? deleter.data('message') : v.lang.confirmDelete;
            bootbox.confirm(message, function(result)
            {
                if(result)
                {
                    deleter.text(v.lang.deleteing);

                    $.getJSON(deleter.attr('href'), function(data)
                    {
                        if(data.result == 'success')
                        {
                            if(deleter.parents('#ajaxModal').size())
                            {
                                if(typeof(data.locate) != 'undefined' && data.locate)
                                {
                                    $('#ajaxModal').attr('rel', data.locate).load(data.locate);
                                }
                                else
                                {
                                    $.reloadAjaxModal(1200);
                                }
                            }
                            else
                            {
                                if(typeof(data.locate) != 'undefined' && data.locate)
                                {
                                    location.href = data.locate;
                                }
                                else
                                {
                                    location.reload();
                                }
                            }
                            return true;
                        }
                        else
                        {
                            alert(data.message);
                        }
                    });
                }
                return true;
           });
           return false;
        });
    },

    /**
     * Set reload deleter.
     *
     * @param  string $selector
     * @access public
     * @return void
     */
    setReloadDeleter: function (selector)
    {
        $(document).on('click', selector, function()
        {
            if(confirm(v.lang.confirmDelete))
            {
                var deleter = $(this);
                deleter.text(v.lang.deleteing);

                $.getJSON(deleter.attr('href'), function(data)
                {
                    if(data.result == 'success')
                    {
                        var table     = $(deleter).closest('table');
                        var replaceID = table.attr('id');

                        table.wrap("<div id='tmpDiv'></div>");
                        $('#tmpDiv').load(document.location.href + ' #' + replaceID, function()
                        {
                            $('#tmpDiv').replaceWith($('#tmpDiv').html());
                            if(typeof sortTable == 'function')
                            {
                                sortTable();
                            }
                            else
                            {
                                $('.colored').colorize();
                                $('tfoot td').css('background', 'white').unbind('click').unbind('hover');
                            }
                        });
                    }
                    else
                    {
                        alert(data.message);
                    }
                });
            }
            return false;
        });
    },

    /**
     * Set reload.
     *
     * @param  string $selector
     * @access public
     * @return void
     */
    setReload: function (selector)
    {
        $(document).on('click', selector, function()
        {
            var reload = $(this);
            $.getJSON(reload.attr('href'), function(data)
            {
                if(data.result == 'success')
                {
                    var table     = $(reload).closest('table');
                    var replaceID = table.attr('id');

                    table.wrap("<div id='tmpDiv'></div>");
                    $('#tmpDiv').load(document.location.href + ' #' + replaceID, function()
                    {
                        $('#tmpDiv').replaceWith($('#tmpDiv').html());
                        if(typeof sortTable == 'function')
                        {
                            sortTable();
                        }
                        else
                        {
                            $('.colored').colorize();
                            $('tfoot td').css('background', 'white').unbind('click').unbind('hover');
                        }
                    });
                }
                else
                {
                    alert(data.message);
                }
            });
            return false;
        });
    },

    /**
     * Reload ajax modal.
     *
     * @param int duration
     * @access public
     * @return void
     */
    reloadAjaxModal: function(duration)
    {
        if(typeof(duration) == 'undefined') duration = 1000;
        setTimeout(function()
        {
            var url = $('#ajaxModal').attr('ref') || $('#ajaxModal').attr('rel');
            $('#ajaxModal .modal-body').load(url + ' .modal-body', function()
            {
                $(this).find('.modal-dialog').css('width', $(this).data('width'));
                $.ajustModalPosition('fit', '#ajaxModal');
                $(this).find('.modal-body').unwrap();
            });
        }, duration);
    }
});

/* jQuery extensions */
+(function($)
{
    /**
     * Resize image's max width and max height to made it center and middle.
     *
     * @param   int   maxWidth
     * @param   int   maxHeight
     * @return void
     */
    jQuery.fn.resizeImage = function(maxWidth, maxHeight)
    {
        container = $(this).parent();
        parentWidth  = parseInt(container.width());
        parentHeight = parseInt(container.height());

        if(isNaN(maxWidth)) maxWidth   = parentWidth;
        if(isNaN(maxHeight)) maxHeight = parentHeight;

        $(this).css('max-width',  maxWidth);
        $(this).css('max-height', maxHeight);

        return true;
    };

    /**
     * Force to break all letters
     *
     * @param   string   filter
     * @param   minLen   min text length
     * @return void
     */
    jQuery.fn.breakAll = function(filter, minLen)
    {
        return $(this).each(function()
        {
            var $set = $(this), $e, text;
            if(filter) $set = $set.find(filter);
            if(!minLen) minLen = 10;
            $set.each(function()
            {
                $e = $(this);
                if($e.children().length) return;
                text = $e.text();
                if(text.length < minLen || text.indexOf(' ') > -1) return;

                $e.css({'word-break': 'break-all', 'white-space': 'normal'});
            });
        });
    };
})(jQuery);

/**
 * Create link.
 *
 * @param  string $moduleName
 * @param  string $methodName
 * @param  string $vars
 * @param  string $viewType
 * @access public
 * @return string
 */
function createLink(moduleName, methodName, vars, viewType)
{
    if(!viewType) viewType = config.defaultView;
    if(vars)
    {
        vars = vars.split('&');
        for(i = 0; i < vars.length; i ++) vars[i] = vars[i].split('=');
    }

    if(config.requestType != 'GET')
    {
        if(config.requestType == 'PATH_INFO')
        {
            link = config.webRoot + moduleName + config.requestFix + methodName;
            if(config.langCode != '') link = '/' + config.langCode + link;
        }

        if(config.requestType == 'PATH_INFO2')
        {
            link = config.webRoot + 'index.php/'  + moduleName + config.requestFix + methodName;
            if(config.langCode != '') link = config.webRoot + 'index.php/' + config.langCode + '/' + moduleName + config.requestFix + methodName;
        }
          
        if(vars)
        {
            if(config.pathType == "full")
            {
                for(i = 0; i < vars.length; i ++) link += config.requestFix + vars[i][0] + config.requestFix + vars[i][1];
            }
            else
            {
                for(i = 0; i < vars.length; i ++) link += config.requestFix + vars[i][1];
            }
        }
        link += '.' + viewType;
    }
    else
    {
        link = config.router + '?' + config.moduleVar + '=' + moduleName + '&' + config.methodVar + '=' + methodName + '&' + config.viewVar + '=' + viewType;
        if(config.langCode != '') link = link + '&l=' + config.langCode;
        if(vars) for(i = 0; i < vars.length; i ++) link += '&' + vars[i][0] + '=' + vars[i][1];
    }
    return link;
}

/**
 * Set required fields, add star class to them.
 *
 * @access public
 * @return void
 */
function setRequiredFields()
{
    if(!config.requiredFields) return false;
    requiredFields = config.requiredFields.split(',');
    for(i = 0; i < requiredFields.length; i++)
    {
        $('#' + requiredFields[i]).closest('td,th').prepend("<div class='required required-wrapper'></div>");
        var colEle = $('#' + requiredFields[i]).closest('[class*="col-"]');
        if(colEle.parent().hasClass('form-group')) colEle.addClass('required');
    }
}

/**
 * Set language.
 *
 * @access public
 * @return void
 */
function selectLang(lang)
{
    $.cookie(config.runMode + 'Lang', lang, {expires:config.cookieLife, path:config.webRoot});
    location.href = removeAnchor(location.href);
}

/**
 * Remove anchor from the url.
 *
 * @param  string $url
 * @access public
 * @return string
 */
function removeAnchor(url)
{
    pos = url.indexOf('#');
    if(pos > 0) return url.substring(0, pos);
    return url;
}

/**
 * Ping to keep login
 *
 * @access public
 * @return void
 */
function ping()
{
    $.get(createLink('misc', 'ping'));
}
needPing = true;
if(config.runMode != 'admin') needPing = false;

/**
 * Set 'go to top' button
 *
 * @access public
 * @return void
 */
function setGo2Top()
{
    if(!$('#go2top').length) return;

    $(window).scroll(function()
    {
        if($(window).scrollTop() < 100) $('#go2top').fadeOut(); else $('#go2top').fadeIn();
    }).resize(function ()
    {
        var parent = $('#go2top').closest('.page-container').find('.page-content');
        $('#go2top').css('left', parent.offset().left + parent.width() + 30);
        if(parent.width() == $(window).width()) $('#go2top').css('left', parent.width() - 90);
    }).scroll().resize();

    $('#go2top').tooltip({container: 'body', placement: 'left', html: true})
        .click(function(){$('body,html').animate({scrollTop:0},400); return false;});
 }

/**
 * Tidy blocks grid
 */
+(function($)
{
    function tidy($blocks, options)
    {
        $blocks = $blocks || $(this);
        options = $.extend({}, $blocks.data(), options);

        var winWidth = $(window).width();
        if(!options.force && winWidth == $blocks.data('tidyWinWidth')) return;
        else $blocks.data('tidyWinWidth', winWidth);
        
        $blocks.find('.panel-block .cards').each(function()
        {
            var $this = $(this);
            var parentGrid = $this.closest('[class*="col-"]').parent().closest('[class*="col-"]').data('grid') || 12;
            var grid = parentGrid * $this.closest('[class*="col-"]').data('grid') / 12,
                cards = $this.find('[class*="col-"]'),
                layout = $this.data('layout');
                recPerRow = cards.data('recperrow');

            if(layout == 'horizontal') cards.attr('class', 'col-md-3 col-sm-4 col-xs-6');
            else if(layout == 'vertical') cards.attr('class', 'col-lg-12');
            else
            {
                if(recPerRow && winWidth > 767)
                {
                    width = 1 / recPerRow * 100;
                    cards.attr('style', "width:" + width + '%');
                }

                if(grid >= 9) cards.attr('class', 'col-md-4 col-sm-6');
                else if(grid >= 5) cards.attr('class', 'col-md-6');
                else cards.attr('class', 'col-md-12');
            }
        });

        var rows = {};
        var rowIndex = 0;
        var disableGrid = winWidth < 992;
        $blocks.children('.col').each(function()
        {
            var $col = $(this);
            var $child = $col.children().not('style, script').first().css('height', 'auto');
            var isColRow = $child.hasClass('row');
            if(isColRow) tidy($child);

            if(disableGrid) return;

            var grid = $col.attr('data-grid');
            if(!grid)
            {
                grid = options.grid || 12;
            }
            if(typeof grid === 'string')
            {
                grid = parseInt(grid);
            }
            $col.attr('data-grid', grid)
                .attr('class', 'col col-' + grid + (isColRow ? ' col-row' : ''));

            var row = rows[rowIndex];
            var colHeight = $child.height();
            if(isColRow) colHeight += 14 * (($child.outerHeight() - colHeight > 7) ? 1 : -1);
            if(!row || (row.grid + grid > 12))
            {
                rowIndex++;
                row =
                {
                    grid: grid,
                    height: colHeight,
                    cols: $col
                };
            }
            else
            {
                row.grid += grid;
                row.cols = row.cols.add($col);
                row.height = Math.max(colHeight, row.height);
            }
            $col.attr('data-row', rowIndex);
            rows[rowIndex] = row;
        });

        $.each(rows, function(rIndex, row)
        {
            if(row.cols.length > 1)
            {
                row.cols.each(function()
                {
                    $(this).children().not('style, script').first().css('height', row.height);
                });
            }
        });
    };

    $.fn.tidy = function(options)
    {
        $(this).each(function()
        {
            var $this = $(this);
            tidy($this, options);
            if(!$this.data('tidyEvent'))
            {
                $this.on('tidy', function()
                {
                    tidy($this, $.extend(options, {force: true}));
                });
            }
            $this.data('tidyEvent', true);
        });
    };

    var lastTidyTask = null;
    var tidyBlocks = function()
    {
        clearTimeout(lastTidyTask);
        lastTidyTask = setTimeout(function(){$('.row.blocks').tidy();}, 300)
    };

    $.extend({tidyBlocks: tidyBlocks})
    $(function()
    {
        tidyBlocks();
        $(window).resize(tidyBlocks);
        setTimeout(tidyBlocks, 500);
        $('.row.blocks img').load(tidyBlocks).each(function()
        {
            if(this.complete) $(this).load();
        });
    })
}(jQuery));

function appendFingerprint(form)
{
    var $form = form instanceof jQuery ? form : $(form);
    if($form.data('checkfingerprint'))
    {
        fingerprint = getFingerprint();
        if($form.find('#fingerprint').size() == 0)
        {
            $form.append("<input type='hidden' id='fingerprint'  name='fingerprint' value='" + fingerprint + "'>");
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
    fingerprint = '';
    $.each(navigator, function(key, value)
    {
        if(typeof(value) == 'string') fingerprint += value.length;
    })
    return fingerprint;
}

function associateSelect(first, sencond, data, firstVal, sencondVal)
{
    $(first).change(function()
    {
        $(sencond).html('');
        var options = data[$(first).val()];
        $.each(options, function(key, value)
        {
            selected = key == sencondVal ? "selected" : '';
            option = '<option ' + selected + ' value="' + key + '">' + value  + '</option>';
            $(sencond).append(option);
        })
    }).change();
}

/*
 * Fit footer style of the 'wide' theme
 */
function fixFooterOfWideTheme()
{
    var fit = function()
    {
        var $wrapper = $('.page-wrapper');
        var fitHeight = $(window).height() - $wrapper.offset().top - $('#footer').outerHeight() - 10;
        $wrapper.css('min-height', $wrapper.height() >= fitHeight ? fitHeight : 'initial');
    };

    var theme = $('#themeStyle').data();
    if(theme && theme.theme === 'wide')
    {
       fit();
    }
}

/* http://www.lalit.org/lab/javascript-css-font-detect/ */
var fontDetector = function()
{
    var baseFonts = ['monospace', 'sans-serif', 'serif'];
    var testString = "mmmmmmmmmmlli";
    var testSize = '72px';
    var h = document.getElementsByTagName("body")[0];
    var s = document.createElement("span");

    s.style.fontSize = testSize;
    s.innerHTML      = testString;

    var defaultWidth = {};
    var defaultHeight = {};
    for (var index in baseFonts)
    {
        s.style.fontFamily = baseFonts[index];
        h.appendChild(s);
        defaultWidth[baseFonts[index]] = s.offsetWidth; //width for the default font
        defaultHeight[baseFonts[index]] = s.offsetHeight; //height for the defualt font
        h.removeChild(s);
    }

    function detect(font)
    {
        var detected = false;
        for (var index in baseFonts)
        {
            s.style.fontFamily = font + ',' + baseFonts[index]; // name of the font along with the base font for fallback.
            h.appendChild(s);
            var matched = (s.offsetWidth != defaultWidth[baseFonts[index]] || s.offsetHeight != defaultHeight[baseFonts[index]]);
            h.removeChild(s);
            detected = detected || matched;
        }
        return detected;
    }

    this.detect = detect;
};
