@extends('layouts.backend')
@section('content')

<style>
    .card {
        border-radius: 12px;
        transition: 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .stat-text {
        font-size: 14px;
        color: #888;
    }

    .stat-digit {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }
</style>

<div class="content-body">
    <div class="container-fluid px-4">

        <!-- HEADER -->
        <div class="row page-titles mb-3">
            <div class="col-sm-6">
                <h4 class="mb-1">Dashboard</h4>
                <p class="text-muted">Ringkasan data pengaduan & tanggapan</p>
            </div>
        </div>

        <!-- CARD STAT -->
        <div class="row g-3">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 p-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="ti-comment text-primary" style="font-size: 28px;"></i>
                        </div>
                        <div>
                            <div class="stat-text">Pengaduan</div>
                            <div class="stat-digit">{{ $jumlahPengaduan }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 p-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="ti-check text-success" style="font-size: 28px;"></i>
                        </div>
                        <div>
                            <div class="stat-text">Tanggapan</div>
                            <div class="stat-digit">{{ $jumlahTanggapan }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHART -->
        <div class="row g-3 mt-2">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-3">
                    <h6 class="mb-3">Grafik Pengaduan</h6>
                    <canvas id="barChartPengaduan" height="200"></canvas>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-3">
                    <h6 class="mb-3">Status Tanggapan</h6>
                    <canvas id="pieChartTanggapan" height="200"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@push('scripts')
<script>
    const ctxBar = document.getElementById('barChartPengaduan').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Pengaduan', 'Saran'],
            datasets: [{
                data: [{{ $jumlahPengaduan }}, {{ $jumlahTanggapan }}],
                backgroundColor: ['#3b82f6', '#facc15']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

<script>
    const ctxPie = document.getElementById('pieChartTanggapan').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Selesai', 'Proses'],
            datasets: [{
                data: [{{ $jumlahSelesai }}, {{ $jumlahBelumSelesai }}],
                backgroundColor: ['#22c55e', '#ef4444']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@endpush
