@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Riwayat Pengaduan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm text-center">
                            <thead class="">
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>Deskripsi Pengaduan</th>
                                    <th>Status</th>
                                    <th>Foto Bukti</th>
                                    <th>Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    <td>{{ $item->pengaduansaran->deskripsi ?? 'N/A' }}</td>
                                    <td>
                                        @if($item->status == 'proses')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                        @elseif($item->status == 'selesai' || $item->status == 'ditanggapi')
                                        <span class="badge bg-success">Selesai</span>
                                        @else
                                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->foto_bukti)
                                        <img src="{{ asset('storage/' . $item->foto_bukti) }}" width="100" alt="Bukti" class="img-thumbnail">
                                        @else
                                        <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada riwayat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection