<?php if(!defined("RUN_MODE")) die();?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php js::import($jsRoot . 'ace/ace.js');?>
<style>
body.codeeditor-fullscreen .form-action {position: fixed; bottom: 5px; left: 50px; z-index: 1105; width: 600px}
.editor-wrapper {position: relative; z-index: 1;}
.editor-wrapper pre {z-index: 2; margin-bottom: 0;}
.editor-wrapper .actions {position: absolute; right: 0; bottom: 15px; z-index: 3;}
.editor-wrapper .actions > a {opacity: .8; color: #808080; border: 1px solid #ccc; min-width: 14px; height: 16px; line-height: 16px; text-align: center; display: block; width: 16px; text-align: center;}
.editor-wrapper .actions > a:hover {color: #fff; background-color: #3280fc; border-color: #3280fc}
.editor-wrapper.fullscreen {position: fixed; left: 0; top: 40px; bottom: 40px; right: 0; z-index: 10}
.editor-wrapper.fullscreen .pre {height: 100%; width: 100%}
.editor-wrapper.fullscreen .actions > a {background-color: #ea644a; color: #fff; border-color: #ea644a; opacity: 1}

.modal-dialog.editor-fullscreen {position: absolute; bottom: 0; right: 0; top: 0; left: 0;  width: 100%!important; margin: 0!important; height: auto!important; border-radius: 0}
.modal-dialog.editor-fullscreen .editor-wrapper.fullscreen {bottom: 80px;}
.modal-dialog.editor-fullscreen .editor-actions {position: fixed; bottom: 15px; left: 20px;}

.editor-resizer {position: absolute; bottom: 0; width: 16px; right: 0; text-align: center; cursor: s-resize; z-index: 4; opacity: .8; transition: opacity .2s; border: 1px solid #ccc; line-height: 16px; height: 16px; background: #f1f1f1; color: #808080; background: rgba(255,255,255,.8);}
.editor-resizer:hover {opacity: 1}
</style>
<script>
jQuery.fn.codeeditor = function(options)
{
    return this.each(function()
    {
        var $this = $(this);
        var setting = $.extend({mode: $this.data('mode') || 'html', theme: 'textmate'}, $this.data(), options);
        if(setting.height) $this.css('height', setting.height);
        $this.css('display', 'none');
        var id = $this.attr('id') + '-editor';
        $this.before('<div class="editor-wrapper"><div class="actions"><a href="javascript:;" class="btn-fullscreen"><i class="icon-resize-full"></i></a></div><pre id="{0}"></pre><div class="editor-resizer"><i class="icon icon-sort"></i></div></div>'.format(id));
        var $editor = $('#' + id).addClass('ace-editor').height($this.height()),
            editor = ace.edit(id);
        var $wrapper = $editor.closest('.editor-wrapper'),
            session = editor.getSession();
        editor.setOptions({fontSize: '15px'});
        editor.setValue($this.val());
        editor.setShowPrintMargin(false);
        editor.clearSelection();
        session.setMode("ace/mode/" + setting.mode);
        session.setUseWorker(false);
        session.on('change', function(e)
        {
            $this.val(editor.getValue());
        });

        $this.data('editor', editor);
        $wrapper.on('click', '.btn-fullscreen', function(){
            $wrapper.toggleClass('fullscreen');
            $wrapper.closest('.modal-dialog').toggleClass('editor-fullscreen');
            $('body').toggleClass('codeeditor-fullscreen');
            $(this).find('i').toggleClass('icon-resize-small');
            if($wrapper.hasClass('fullscreen'))
            {
                $editor.data('origin-height', $editor.height()).height($wrapper.height());
            }
            else
            {
                $editor.height($editor.data('origin-height'));
            }
            editor.resize();
        }).on('mousedown', '.editor-resizer', function(e){
            var dragStartData = {y: e.screenY, height: $editor.outerHeight()};
            $wrapper.data('dragStartData', dragStartData);
            e.preventDefault();
        });
        $(document).on('mousemove', function(e){
            var dragStartData = $wrapper.data('dragStartData');
            if(dragStartData) {
                var newHeight = dragStartData.height + e.screenY - dragStartData.y - 21;
                $editor.height(newHeight);
                e.preventDefault();
                editor.resize();
            }
        }).on('mouseup', function(){
            $wrapper.data('dragStartData', null);
        });
    });
};
$(function()
{
    $('.codeeditor').codeeditor();
});
</script>
