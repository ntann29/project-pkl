@extends('layouts.frontend')
@section('content')

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">
    <img src="{{ asset('frontend/assets/img/hero-bg.jpg')}}" alt="" data-aos="fade-in">
    <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">SUARA ANDA, PRIORITAS KAMI.</h2>
        <p data-aos="fade-up" data-aos-delay="200">Layanan Aspirasi & Keluhan Online</p>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact section">
    <div class="container section-title text-center" data-aos="fade-up">
        <h2>Saran & Pengaduan</h2>
        <p class="text-muted mt-2">Silakan pilih jenis laporan yang ingin Anda sampaikan</p>
        <div class="mt-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis" id="radioSaran" value="saran">
                <label class="form-check-label" for="radioSaran">Saran</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis" id="radioPengaduan" value="pengaduan">
                <label class="form-check-label" for="radioPengaduan">Pengaduan</label>
            </div>
        </div>
    </div>

    <div class="container mt-4" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            {{-- Form Saran --}}
            <div class="col-lg-6 mx-auto" id="formSaran" style="display: none;">
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="jenis" value="saran">
                    <input type="hidden" name="status_user" value="user">
                    <input type="hidden" name="status" value="dikirim">

                    <div class="row gy-4">
                        {{-- Pilihan Kategori Detail --}}
                        <div class="col-md-12">
                            <select class="form-select" name="kategori" id="kategori" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="fasilitas">Fasilitas</option>
                                <option value="akademik">Akademik</option>
                                <option value="sarana_sekolah">Sarana Sekolah</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="deskripsi" rows="4" placeholder="Masukkan Saran" required></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Kirim Saran</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Form Pengaduan --}}
            <div class="col-lg-6 mx-auto" id="formPengaduan" style="display: none;">
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="jenis" value="pengaduan">
                    <input type="hidden" name="status_user" value="user">
                    <input type="hidden" name="status" value="dikirim">

                    <div class="row gy-4">
                        {{-- Pilihan Kategori Detail --}}
                        <div class="col-md-12">
                            <select class="form-select" name="kategori" id="kategori" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="fasilitas">Fasilitas</option>
                                <option value="akademik">Akademik</option>
                                <option value="sarana_sekolah">Sarana Sekolah</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="deskripsi" rows="4" placeholder="Masukkan Pengaduan" required></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const radioSaran = document.getElementById("radioSaran");
        const radioPengaduan = document.getElementById("radioPengaduan");
        const formSaran = document.getElementById("formSaran");
        const formPengaduan = document.getElementById("formPengaduan");

        radioSaran.addEventListener("change", function() {
            if (this.checked) {
                formSaran.style.display = "block";
                formPengaduan.style.display = "none";
            }
        });

        radioPengaduan.addEventListener("change", function() {
            if (this.checked) {
                formSaran.style.display = "none";
                formPengaduan.style.display = "block";
            }
        });
    });

</script>
@endsection
