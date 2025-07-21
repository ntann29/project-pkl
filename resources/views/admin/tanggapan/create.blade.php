@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Beri Tanggapan</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tanggapan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_pengaduansaran">Pilih Pengaduan</label>
                        <select name="id_pengaduansaran" class="form-control" required>
                            <option disabled selected>-- Pilih --</option>
                            @foreach($pengaduan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->kategori }} - {{ Str::limit($item->deskripsi, 30) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="isi_tanggapan">Isi Tanggapan</label>
                        <textarea name="isi_tanggapan" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="foto_bukti">Foto (opsional)</label>
                        <input type="file" name="foto_bukti" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
                    <a href="{{ route('tanggapan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection