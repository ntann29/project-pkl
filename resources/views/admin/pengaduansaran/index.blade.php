@extends('layouts.backend')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Pengaduan & Saran</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Status User</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduansaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->status_user }}</td>
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
                                    {{-- <td>
                                        <a href="{{ route('admin.pengaduansaran.show', $item->id) }}" class="btn btn-sm btn-info mr-1" data-toggle="tooltip" title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>                                        
                                    </td> --}}
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data.</td>
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