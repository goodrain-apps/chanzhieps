$(document).ready(function()
{
    $('.leftmenu').find('a[href*="keywords"]').parent().addClass('active');
    var data    = {labels: v.lineLabels, datasets: v.lineChart};
    var options = {multiTooltipTemplate: "<%= datasetLabel %> <%= value %>", datasetFill : false}
    lineChart   = $('#lineChart').lineChart(data, options);

    var options = { scaleShowLabels: true, scaleLabel: "<%=label%> \: <%=value%>",};
    if(v.pieCharts) chart = $('#pieChart').pieChart(v.pieCharts.pv, options);
    $('#switchBar label').click(function()
    {
        type = $(this).data('type');
        $('#switchBar .active').removeClass('active');
        $(this).addClass('active');
        chart.segments[0].value = v.pieCharts[type][0].value;
        chart.segments[1].value = v.pieCharts[type][1].value;
        chart.segments[2].value = v.pieCharts[type][2].value;
        chart.update();
    })

})
