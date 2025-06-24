@extends('layouts/layoutMaster')

@section('title', 'Apex - Charts')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/charts-apex.js'])
@endsection

@section('content')
    <div class="row">

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Suhu (°C)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="suhuChart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">pH (pH)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="phChart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">UV (mW/cm²)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="uvChart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Tekanan Udara (kPa)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="tekananUdaraChart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">Kelembapan (RH)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="kelembapanChart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">O2 (mg/m³)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="o2Chart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        <!-- Line Chart -->
        <div class="col-md-6 col-12 mb-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="card-title mb-0">CO2 (mg/m³)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="co2Chart"></canvas>
                </div>
            </div>
        </div>
        <!-- /Line Chart -->

        @push('scripts')
            <!-- Include Chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                function generateRandomData(numPoints) {
                    return Array.from({
                        length: numPoints
                    }, () => Math.floor(Math.random() * 100));
                }

                function lineChart(id, labels, data, color) {
                    const ctx = document.getElementById(id).getContext('2d');

                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: '',
                                data: data,
                                borderColor: color,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            animation: {
                                duration: 500,
                                easing: 'linear'
                            }
                        }
                    });
                    setInterval(() => {
                        chart.data.datasets[0].data = generateRandomData(labels.length);
                        chart.update({
                            duration: 500,
                            easing: 'linear'
                        });
                    }, 1000);
                }

                const labels = ['01.01', '02.01', '03.01', '04.01', '05.01', '06.01', '07.01', '08.01', '09.01', '10.01'];

                lineChart('suhuChart', labels, generateRandomData(7), 'rgba(255, 99, 132, 1)');
                lineChart('phChart', labels, generateRandomData(5), 'rgba(54, 162, 235, 1)');
                lineChart('uvChart', labels, generateRandomData(7), 'rgba(255, 206, 86, 1)');
                lineChart('tekananUdaraChart', labels, generateRandomData(5), 'rgba(75, 192, 192, 1)');
                lineChart('kelembapanChart', labels, generateRandomData(7), 'rgba(153, 102, 255, 1)');
                lineChart('o2Chart', labels, generateRandomData(5), 'rgba(255, 159, 64, 1)');
                lineChart('co2Chart', labels, generateRandomData(7), 'rgba(201, 203, 207, 1)');
            </script>
        @endpush

    </div>
@endsection
