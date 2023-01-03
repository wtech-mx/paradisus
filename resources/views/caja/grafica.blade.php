<script type="text/javascript">
    var noTer = '{{$total_egresos}}';
    var Ter = '{{$total_ingreso}}';
    Highcharts.chart('container', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Ingresos y Egresos'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Tareas',
            data: [
                ['Ingresos', + Ter],
                {
                    name: 'Egresos',
                    y: + noTer,
                    sliced: true,
                    selected: true
                },
            ]
        }]
    });
</script>
