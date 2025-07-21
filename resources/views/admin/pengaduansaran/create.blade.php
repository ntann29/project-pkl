@extends('layouts.backend')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" action="{{ route('admin.pengaduansaran.store') }}" enctype="multipart/form-data">
                        @csrf                                                 
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="" class="form-control">
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="saran">Saran</option>
                                <option value="pengaduan">Pengaduan</option>
                            </select>
                        </div>    
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="" class="form-control"></textarea>
                        </div>                           
                        <div class="form-group">
                            <label for="foto_bukti">Foto Bukti</label>
                            <input type="file" name="foto_bukti" id="foto_bukti" class="form-control">
                        </div>                            
                        <button type="submit" class="btn btn-primary">Kirim</button> 
                        <a href="{{ route('admin.pengaduansaran.index') }}" class="btn btn-secondary">Kembali</a>       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection