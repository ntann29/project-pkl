@extends('layouts.frontend')
@section('content')
<section id="hero" class="hero section dark-background">
    <img src="{{ asset('frontend/assets/img/hero-bg.jpg')}}" alt="" data-aos="fade-in">
    <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">SUARA ANDA, PRIORITAS KAMI.</h2>
        <p data-aos="fade-up" data-aos-delay="200">Sistem Pengaduan dan Saran Orang Tua & Siswa Secara Online</p>
    </div>
</section>

<section id="riwayat" class="py-5">
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

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Foto Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduansarans as $index => $item)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
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
                        <td>
                            <a href="{{ route('laporan.detail', $item->id) }}" class="btn btn-sm btn-info">Detail</a>
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
</section>
@endsection