$(document).ready(function()
{
    var data    = {labels: v.lineLabels, datasets: v.lineChart};
    var options = {multiTooltipTemplate: "<%= datasetLabel %> <%= value %>", datasetFill : false}
    lineChart   = $('#lineChart').lineChart(data, options);
})
