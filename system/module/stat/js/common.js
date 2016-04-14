$(document).ready(function()
{
    if(typeof(v.lineCharts) != 'undefined')
    {
        var data    = {labels: v.lineLabels, datasets: v.lineCharts.pvChart};
        var options = {multiTooltipTemplate: "<%= datasetLabel %> <%= value %>", datasetFill : false}
        lineChart   = $('#lineChart').lineChart(data, options);
        $('[name=lineType]').change(function()
        {
            type = $('[name=lineType]:checked').val() + 'Chart';
            data = v.lineCharts[type];
            $.each(data, function(lineID, line)
            {
              $.each(line.data, function(id, value)
              {
                  lineChart.datasets[lineID].points[id].value = value;
                  lineChart.datasets[lineID].label = line.label;
              });
            })
            lineChart.update();
        })
    }
})
