@extends('layouts.admin')

@section('content')
    <div>
        <canvas id="canvas" width="240px" height="135px"></canvas>
    </div>

    <div>
        <canvas id="canvas2" width="240px" height="135px"></canvas>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script type="module">
    /* var data_y = "<?php echo json_encode($monthOrders); ?>" */
    var data_y = JSON.parse('{!! json_encode($monthOrders) !!}')
    var data_x1 = JSON.parse('{!! json_encode($months) !!}')
    var data_y2 = JSON.parse('{!! json_encode($amounts) !!}')

    console.log(data_y, data_x1, data_y2);
    var barChartData = {
        labels: data_x1,
        datasets: [{
            label: 'Total Orders',
            backgroundColor: "pink",
            data: data_y,
        }]
    };
    var barChartData2 = {
        labels: data_x1,
        datasets: [{
            label: 'Amount orders',
            backgroundColor: "pink",
            data: data_y2,
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom',
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Numero Ordini per anno/mese'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        var ctx = document.getElementById("canvas2").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData2,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom',
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Fatturato per mese/anno'
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    };
</script>
