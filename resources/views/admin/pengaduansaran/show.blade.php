@extends('layouts.backend')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Pengaduan</h4>
            </div>
            <div class="card-body">
                <p><strong>Status User:</strong> {{ $pengaduansaran->status_user }}</p>
                <p><strong>Kategori:</strong> {{ $pengaduansaran->kategori }}</p>
                <p><strong>Deskripsi:</strong> {{ $pengaduansaran->deskripsi }}</p>
                <p><strong>Status:</strong> {{ $pengaduansaran->status }}</p>
                <p><strong>Foto Bukti:</strong>
                    <br>
                    @if($pengaduansaran->foto_bukti)
                    <img src="{{ asset('storage/' . $pengaduansaran->foto_bukti) }}" width="250">
                    @else
                    Tidak ada
                    @endif
                </p>

                <hr>

                <h5>Tanggapan</h5>
                @if($pengaduansaran->tanggapan)
                <p><strong>Isi Tanggapan:</strong> {{ $pengaduansaran->tanggapan->isi_tanggapan }}</p>
                <p><strong>Foto:</strong>
                    <br>
                    @if($pengaduansaran->tanggapan->foto_bukti)
                    <img src="{{ asset('storage/' . $pengaduansaran->tanggapan->foto_bukti) }}" width="250">
                    @else
                    Tidak ada
                    @endif
                </p>
                @else
                <p class="text-muted">Belum ada tanggapan untuk pengaduan ini.</p>
                @endif

                <a href="{{ route('pengaduansaran.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection