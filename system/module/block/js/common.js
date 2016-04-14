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

    var $panelPreview = $('.panel-preview > .panel');
    $('#title').change(function()
    {
        $panelPreview.find('.title').text($(this).val());
    });

    $('[name="params\\[icon\\]"]').change(function()
    {
        $panelPreview.find('.icon').attr('class', 'icon ' + $(this).val());
    }).change();

    $('[name*="\\[iconColor\\]"]').change(function()
    {
        $panelPreview.find('.icon').css('color', $(this).val());
    }).change();

    $('[name*="\\[titleColor\\]"]').change(function()
    {
        $panelPreview.find('.title').css('color', $(this).val());
    }).change();

    $('[name*="\\[titleBackground\\]"]').change(function()
    {
        $panelPreview.find('.panel-heading').css('background', $(this).val());
    }).change();

    $('[name*="\\[backgroundColor\\]"]').change(function()
    {
        $panelPreview.css('background', $(this).val());
    }).change();

    $('[name*="\\[textColor\\]"]').change(function()
    {
        $panelPreview.find('.panel-body').css('color', $(this).val());
    }).change();

    $('[name*="\\[borderColor\\]"]').change(function()
    {
        $panelPreview.css('border-color', $(this).val());
        $panelPreview.find('.panel-heading').css('border-bottom-color', $(this).val());
    }).change();

    $('[name*="\\[linkColor\\]"]').change(function()
    {
        $panelPreview.find('a').css('color', $(this).val());
    }).change();

    var $form = $('.blockForm');
    $('.nav-tabs li > a').on('show.bs.tab show.zui.tab', function()
    {
        $form.attr('data-tab', $(this).attr('href').replace('#', ''));

        var height = $($(this).attr('href')).outerHeight() - 60;
        $('#panelPreview .panel').css('height', height).data('height', height);
    }).first().tab('show');
});
