<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Nombre d\'utilisateur par date'
            },
            xAxis: {
                categories: ['Date'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nombre d\'utilisateur',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' utilisateurs'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [
            <?php foreach($userByDate as $v) {?>
            {
                name: '<?php echo $v['year'].'-'.$v['month']; ?>',
                data: [<?php echo $v['total']; ?>]
            },
            <?php } ?>
            ]
        });

        $('#container2').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Nombre d\'utilisateur par plan'
            },
            xAxis: {
                categories: ['Date'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nombre d\'utilisateur',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' utilisateurs'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [
            <?php foreach($usersByPlan as $v) {?>
            {
                name: '<?php echo $v['name']; ?>',
                data: [<?php echo $v['NBUSER']; ?>]
            },
            <?php } ?>
            ]
        });
    });
</script>

<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<div id="container2" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>