$(function()
{
    tempColor = new Color();
    $('.color').each(function()
    {
        var $this = $(this);
        var c = $this.attr('data');
        if(!c) return;
        var cc = new Color(c).contrast().hexStr();

        ($this.hasClass('input-group') ? $this.find('.input-group-btn .dropdown-toggle') : $this).css({'background': c, 'color': cc}).find('.caret').css('border-top-color', cc);
    }).click(function()
    {
        var $this = $(this);
        if($this.hasClass('input-group')) return;
        var $plate = $this.closest('.colorplate');
        $plate.find('.color.active').removeClass('active');
        if($this.hasClass('color-tile')) $plate.find('.input-color').val($this.attr('data')).change();
        $this.addClass('active');
    });

    $('.input-color').on('keyup change', function()
    {
        var $this = $(this);
        var val = $this.val();

        $this.closest('.colorplate').find('.color.active').removeClass('active');

        if(tempColor.isColor(val))
        {
            var ic = (new Color(val)).contrast().hexStr();
            $this.attr('placeholder', val).closest('.color').removeClass('error').find('.input-group-btn .dropdown-toggle').css({'background': val, 'color': ic}).find('.caret').css('border-top-color', ic);;
        }
        else
        {
            $this.closest('.color').addClass('error');
        }
    });

    $('input:radio[name="backgroundType"]').change(function()
    {
        $('.bg-section').hide();
        var type = $('input:radio[name="backgroundType"]:checked').val();
        $('[data-id="' + type + '"]').show();
    });
    $('.bg-section:not([data-id="' + $('input:radio[name="bg"]:checked').val() + '"])').addClass('hide');

    $(document).on('click', '.dropdown-menu.buttons .btn', function()
    {
        var $this = $(this);
        var group = $this.closest('.input-group-btn');
        group.find('.dropdown-toggle').removeClass().addClass('btn dropdown-toggle btn-' + $this.data('id'));
        group.find('input[name^="buttonClass"]').val($this.data('id'));
    });

    $('input[name^="buttonClass"]').each(function()
    {
        var $this = $(this);
        var group = $this.closest('.input-group-btn');
        var btn = group.find('.dropdown-menu.buttons .btn[data-id="' + ($this.val() || 'default') + '"]');
        group.find('.dropdown-toggle').removeClass().addClass('btn dropdown-toggle btn-' + btn.data('id'));
    });

    $('input:radio[name="backgroundType"]').change();

    $(document).on('change', '.button-target', function()
    { 
        $('.button-target').parent().next('input[type=hidden]').val('');
        $('input:checked').parent().next('input[type=hidden]').val('_blank');
    });

    $('#height').parents('tr').find('.required-wrapper').eq(0).remove();
});
