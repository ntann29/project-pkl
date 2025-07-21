@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Tanggapan</h4>
                <a href="{{ route('admin.data-orangtua.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>No Tlp</th>
                                <th>Id User</th>
                                <th>Id Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ortu as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->no_tlp }}</td>
                                <td>{{ $item->user->role }}</td>
                                <td>{{ $item->user->role }}</td>
                                <td>
                                    <a href="{{ route('admin.data-orangtua.show', $item->id) }}" class="btn btn-sm btn-info mr-1" data-toggle="tooltip" title="Lihat">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.data-orangtua.edit', $item->id) }}" class="btn btn-sm btn-warning mr-1" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.data-orangtua.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data</td>
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