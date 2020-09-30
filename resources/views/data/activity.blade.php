<script>
    var presets = window.chartColors;
    var utils = Samples.utils;
    var inputs = {
        min: -100,
        max: 100,
        count: 8,
        decimals: 2,
        continuity: 1
    };

    var options = {
        maintainAspectRatio: false,
        spanGaps: false,
        elements: {
            line: {
                tension: 0.000001
            }
        },
        plugins: {
            filler: {
                propagate: false
            }
        },
        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 0
                }
            }]
        }
    };



    $.get("{{ url('/admin/chart') }}", function(data, status) {
        new Chart('areaChart', {
            type: 'line',
            data: {
                labels: data.day,
                datasets: [{
                    backgroundColor: utils.transparentize(presets.red),
                    borderColor: presets.red,
                    data: data.count,
                    label: 'Bid Submission',
                    fill: false
                }]
            }
        });
        setTimeout(function () {
            $("#loader-wrapper").css('visibility','hidden');
        },1500);
    });

</script>
