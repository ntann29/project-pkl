@extends('layouts.frontend')
@section('content')
<!-- Hero Section -->
<section id="home" class="hero section">

    <img src="{{ asset('frontend/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 data-aos="fade-up" data-aos-delay="100">Sistem Informasi</h2>
                <p data-aos="fade-up" data-aos-delay="200">Pengaduan Saran Orang Tua/Siswa secara online</p>
                <a href="#riwayat" class="btn btn-primary mt-3 px-4 py-2 fs-5">Riwayat</a>
            </div>
        </div>
    </div>

</section>
<!-- /Hero Section -->

<!-- Contact Section -->
<section id="info" class="contact section">

    <!-- Section Title -->
    <div class="container" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Riwayat Laporan</h2>
            <a href="{{ route('laporan.create') }}" class="btn btn-primary">Tambah Laporan</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive" name="riwayat" id="riwayat">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Foto Bukti</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduansarans as $index => $item)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucfirst($item->jenis) }}</td>
                        <td>{{ ucfirst($item->kategori) }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            @if($item->status === 'proses')
                            <span class="badge bg-warning text-dark">Proses</span>
                            @elseif($item->status === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>
                            @if($item->foto_bukti)
                            <img src="{{ asset('storage/' . $item->foto_bukti) }}" alt="Bukti" width="80">
                            @else
                            <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</section><!-- /Contact Section -->
@endsection
