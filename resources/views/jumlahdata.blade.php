@extends('layouts.frontend')
@section('content')
<div class="container mt-5">
    <h2>Jumlah Pengaduan dan Saran</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Jumlah Pengaduan</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $jumlahPengaduan }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Jumlah Saran</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $jumlahSaran }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection