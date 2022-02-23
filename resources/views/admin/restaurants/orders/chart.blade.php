@extends('layouts.admin')

@section('content')
    <canvas id="canvas" height="280" width="600"></canvas>
@endsection
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.33.1/apexcharts.min.js"
integrity="sha512-oyNqW6ArxqcGtg9kzTbOQqKC+q7+tS9Ab09S44+VbZiKY6xJtMNA6v13vJwoqiKLGJuQQwams0W5E19QnLfxWw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script type="module">
    /* var data_y = "<?php echo json_encode($monthOrders); ?>" */
    var data_y = JSON.parse('{!! json_encode($monthOrders) !!}')
    var data_x = JSON.parse('{!! json_encode($months) !!}')
    console.log(data_y, data_x);
    var barChartData = {
        labels: data_x,
        datasets: [{
            label: 'Orders',
            backgroundColor: "pink",
            data: data_y,
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
                    text: 'Ordini per anno e mese'
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
