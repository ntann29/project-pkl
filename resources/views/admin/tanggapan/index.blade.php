@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Pengaduan untuk Ditanggapi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deskripsi Pengaduan</th>
                                <th>Foto Bukti</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengaduansaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @if ($item->foto_bukti)
                                    <img src="{{ asset('storage/' . $item->foto_bukti) }}" width="80">
                                    @else
                                    <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                 <td>
                            @if($item->status === 'proses')
                            <span class="badge bg-warning text-dark">Proses</span>
                            @elseif($item->status === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                            @else
                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                                <td>
                                    @if($item->status == 'proses')
                                    <a href="{{ route('admin.tanggapan.tanggapi', $item->id) }}" class="btn btn-sm btn-primary">Tanggapi</a>
                                    @else
                                    <span class="text-muted">Sudah Ditanggapi</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada pengaduan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection