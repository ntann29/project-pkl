@extends('layouts.backend')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <p class="mb-0">Your business dashboard template</p>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-comment text-info border-info"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Pengaduan</div>
                            <div class="stat-digit">{{ $jumlahPengaduan }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-one card-body">
                        <div class="stat-icon d-inline-block">
                            <i class="ti-check text-warning border-warning"></i>
                        </div>
                        <div class="stat-content d-inline-block">
                            <div class="stat-text">Tanggapan</div>
                            <div class="stat-digit">{{ $jumlahTanggapan }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <canvas id="barChartPengaduan" style="width: 10px; height: 10px;"></canvas>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <canvas id="pieChartTanggapan" style="width: 10px; height: 10px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const ctxBar = document.getElementById('barChartPengaduan').getContext('2d');
    const barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Pengaduan', 'Saran'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $jumlahPengaduan }}, {{ $jumlahTanggapan }}],
                backgroundColor: ['#36A2EB', '#FFCE56']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Grafik Pengaduan dan Saran'
                }
            }
        }
    });
</script>

<script>
    const ctxPie = document.getElementById('pieChartTanggapan').getContext('2d');
    const pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Sudah Ditanggapi', 'Masih Proses'],
            datasets: [{
                data: [{{ $jumlahSelesai }}, {{ $jumlahBelumSelesai }}],
                backgroundColor: ['#4CAF50', '#F44336']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Status Tanggapan'
                }
            }
        }
    });
</script>
@endpush
