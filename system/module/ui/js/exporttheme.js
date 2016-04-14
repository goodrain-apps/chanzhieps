$(function()
{
    associateSelect('.export-theme-form #template', '.export-theme-form #theme', v.themes, v.template, v.theme);
    $('#template').change();
});
