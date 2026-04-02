@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Data Akun Orang Tua</h4>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                            Import Excel
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Email</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orangtuas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_hp }}</td>

                                        {{-- ALAMAT DIBATASI BIAR TABEL RAPI --}}
                                        <td title="{{ $item->alamat }}">
                                            {{ Str::limit($item->alamat, 35) }}
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">

                                                <a href="{{ route('admin.orangtua.edit', $item->id) }}"
                                                   class="btn btn-warning btn-sm text-white">
                                                    Ubah
                                                </a>

                                                <form action="{{ route('admin.orangtua.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus akun?')">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            Data masih kosong
                                        </td>
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

<!-- MODAL IMPORT EXCEL -->
<div class="modal fade" id="importExcelModal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <form action="{{ route('admin.orangtua.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Import Akun Orang Tua</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- INPUT FILE -->
                    <div class="mb-2">
                        <label class="form-label fw-semibold">File Excel</label>
                        <input type="file" name="file" class="form-control" accept=".xls,.xlsx" required>
                    </div>

                    <!-- DOWNLOAD TEMPLATE -->
                    <div class="mb-3">
                        <small class="text-muted">
                            Belum punya template?
                            <a href="{{ route('admin.orangtua.template') }}" class="text-primary fw-semibold">
                                Download template Excel
                            </a>
                        </small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        Import
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
