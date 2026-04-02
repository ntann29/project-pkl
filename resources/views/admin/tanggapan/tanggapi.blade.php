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
                <form action="{{ route('admin.tanggapan.kirim', $pengaduansaran->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="isi_tanggapan">Isi Tanggapan</label>
                        <textarea name="isi_tanggapan" class="form-control" rows="4" required></textarea>
                    </div><br>
                    <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection