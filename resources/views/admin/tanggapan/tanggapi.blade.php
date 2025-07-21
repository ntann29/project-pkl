@extends('layouts.backend')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Tanggapi Pengaduan</h4>
                </div>
            <div class="card-body">
                <p><strong>Deskripsi Pengaduan:</strong> {{ $pengaduansaran->deskripsi }}</p>
                @if ($pengaduansaran->foto_bukti)
                    <p><strong>Foto dari Pengaduan:</strong></p>
                    <img src="{{ asset('storage/' . $pengaduansaran->foto_bukti) }}" alt="Foto Bukti" width="200" class="mb-3">
                @else
                    <p><em>Tidak ada foto bukti dari pengguna.</em></p>
                @endif
                <hr>
                <form action="{{ route('admin.tanggapan.kirim', $pengaduansaran->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="isi_tanggapan">Isi Tanggapan</label>
                        <textarea name="isi_tanggapan" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto_bukti">Foto Bukti (opsional)</label>
                        <input type="file" name="foto_bukti" class="form-control">
                    </div><br>
                    <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection