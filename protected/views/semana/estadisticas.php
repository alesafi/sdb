<script type="text/javascript">
var barras = <?php echo $estadisticas['barras']; ?>;
</script>

<script type="text/javascript">

                                                var num_eventos=0;
                                                for (var i = 0; i < eval(barras).length ; i++) {
                                                    num_eventos = num_eventos+eval(barras)[i][1];
                                                }

                                                $(function () {
                                                $('#container').highcharts({
                                                    chart: {
                                                        type: 'column',
                                                        //plotBorderWidth: '#000000',
                                                        plotBackgroundColor: '#e9e8ca',
                                                        selectionMarkerFill: '#000000',
                                                        backgroundColor: '#e9e8ca',
                                                        //plotBorderColor: '#e9e8ca',
                                                        //plotShadow: '#e9e8ca',
                                                    },
                                                    title: {
                                                        text: num_eventos + ' eventos en ' + eval(barras).length + ' estados'
                                                    },
                                                    //subtitle: {
                                                    //    text: num_eventos + ' eventos en ' + eval(barras).length + ' estados'
                                                    //},
                                                    xAxis: {
                                                        type: 'category',
                                                        labels: {
                                                            rotation: -90,
                                                            align: 'right',
                                                            style: {
                                                                fontSize: '11px',
                                                                fontFamily: 'Verdana, sans-serif'
                                                            }
                                                        }
                                                    },
                                                    yAxis: {
                                                        min: 0,
                                                        title: {
                                                            text: 'Eventos'
                                                        }
                                                    },
                                                    legend: {
                                                        enabled: false
                                                    },
                                                    tooltip: {
                                                        pointFormat: '<b>{point.y}</b> evento(s)',
                                                    },
                                                    series: [{
                                                        name: 'Estados',
                                                        data: eval(barras),
                                                        dataLabels: {
                                                            enabled: true,
                                                            rotation: -90,
                                                            color: '#FFFFFF',
                                                            align: 'right',
                                                            x: 3,
                                                            y: 0,
                                                            style: {
                                                                fontSize: '12px',
                                                                fontFamily: 'Verdana, sans-serif',
                                                                textShadow: '0 0 3px black'
                                                            }
                                                        }
                                                    }],
                                                    colors: ['#6C693C']
                                                });
                                            });
                                                </script>
<div id="container" style="min-width: 310px; height: 400px; margin: 10"></div>