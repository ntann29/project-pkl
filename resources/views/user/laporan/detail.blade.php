@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container">
        <h2 class="mb-4">Detail Laporan</h2>

        <div class="card mb-4">
            <div class="card-header">Informasi Laporan</div>
            <div class="card-body">
                <p><strong>Jenis:</strong> {{ ucfirst($pengaduansaran->jenis) }}</p>
                <p><strong>Kategori:</strong> {{ ucfirst($pengaduansaran->kategori) }}</p>
                <p><strong>Deskripsi:</strong> {{ $pengaduansaran->deskripsi }}</p>
                <p><strong>Status:</strong>
                    @if($pengaduansaran->status === 'proses')
                    <span class="badge bg-warning text-dark">Proses</span>
                    @elseif($pengaduansaran->status === 'selesai' || $pengaduansaran->status === 'ditanggapi')
                    <span class="badge bg-success">Selesai</span>
                    @else
                    <span class="badge bg-secondary">{{ ucfirst($pengaduansaran->status) }}</span>
                    @endif
                </p>
                <p><strong>Tanggal Dibuat:</strong> {{ $pengaduansaran->created_at->format('d M Y, H:i') }}</p>
                @if ($pengaduansaran->foto_bukti)
                <p><strong>Foto Bukti:</strong></p>
                <img src="{{ asset('storage/' . $pengaduansaran->foto_bukti) }}" alt="Foto Bukti" width="200">
                @endif
            </div>
        </div>

        @if($pengaduansaran->tanggapan)
        {{-- Tanggapan dari Admin --}}
        <div class="card mt-4">
            <div class="card-header">Tanggapan dari Admin</div>
            <div class="card-body">
                <p><strong>Isi Tanggapan:</strong></p>
                <p>{{ $pengaduansaran->tanggapan->isi_tanggapan }}</p>

                @if($pengaduansaran->tanggapan->foto_bukti)
                <p><strong>Foto Balasan:</strong></p>
                <img src="{{ asset('storage/' . $pengaduansaran->tanggapan->foto_bukti) }}" width="200" class="img-thumbnail">
                @endif

                <p class="text-muted mt-2"><small>Ditanggapi pada: {{ $pengaduansaran->tanggapan->created_at->format('d M Y, H:i') }}</small></p>
            </div>
        </div>

        {{-- List Balasan User --}}
        <div class="card mt-3">
            <div class="card-header">Balasan Anda</div>
            <div class="card-body">
                @forelse ($pengaduansaran->komentars as $komentar)
                <div class="border rounded p-2 mb-2 bg-light">
                    <strong>{{ $komentar->user->name }}:</strong>
                    <p class="mb-1">{{ $komentar->isi_komentar }}</p>
                    <small class="text-muted">{{ $komentar->created_at->format('d M Y, H:i') }}</small>
                </div>
                @empty
                <p class="text-muted">Belum ada balasan dari Anda.</p>
                @endforelse
            </div>
        </div>

        {{-- Jika belum memberi rating, tampilkan form komentar dan rating --}}
        @if (is_null($pengaduansaran->rating))

        {{-- Form Balasan --}}
        <div class="mt-3 text-start">
            <button class="btn btn-outline-primary" onclick="toggleBalasan()">Kirim Pesan ke Admin</button>
        </div>

        <div class="card mt-3 d-none" id="formBalasan">
            <div class="card-header">Balas Admin</div>
            <div class="card-body">
                <form action="{{ route('komentar.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pengaduansaran" value="{{ $pengaduansaran->id }}">
                    <div class="mb-3">
                        <label for="isi_komentar" class="form-label">Pesan Anda:</label>
                        <textarea name="isi_komentar" id="isi_komentar" class="form-control" rows="3" required placeholder="Ketik balasan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Balasan</button>
                </form>
            </div>
        </div>

        {{-- Form Rating --}}
        {{-- Form Rating dengan Bintang --}}
        <div class="card mt-4">
            <div class="card-header">Beri Rating</div>
            <div class="card-body">
                <form action="{{ route('pengaduansaran.rating', $pengaduansaran->id) }}" method="POST">
                    @csrf

                    <style>
                        .rating-group {
                            display: flex;
                            flex-direction: row;
                            justify-content: flex-start;
                        }

                        .rating__input {
                            display: none;
                        }

                        .rating__label {
                            font-size: 2rem;
                            color: #ddd;
                            cursor: pointer;
                            transition: color 0.2s;
                        }

                        .rating__input:checked~.rating__label,
                        .rating__label:hover,
                        .rating__label:hover~.rating__label {
                            color: #ffc107;
                        }

                    </style>

                    <div class="rating-group mb-2">
                        @for ($i = 5; $i >= 1; $i--)
                        <input class="rating__input" type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" required>
                        <label class="rating__label" for="rating-{{ $i }}">&#9733;</label>
                        @endfor
                    </div>

                    <button type="submit" class="btn btn-success">Kirim Rating</button>
                </form>
            </div>
        </div>

        @else
        {{-- Jika sudah memberi rating, tampilkan rating dan nonaktifkan balasan --}}
        <div class="card mt-4">
            <div class="card-header">Rating Anda</div>
            <div class="card-body">
                <p>
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$pengaduansaran->rating)
                        ⭐
                        @else
                        ☆
                        @endif
                        @endfor
                        <span class="ms-2">({{ $pengaduansaran->rating }} dari 5)</span>
                </p>
                <p class="text-muted">Anda telah memberi rating. Komentar lanjutan tidak diperbolehkan.</p>
            </div>
        </div>
        @endif

        {{-- Script Toggle Form --}}
        <script>
           function toggleBalasan() {
           const form = document.getElementById('formBalasan');
           const isHidden = form.classList.contains('d-none');

           form.classList.toggle('d-none');           
           }

        </script>
        @endif
        
        <br>
        <div class="card">
            <div class="card-header">Informasi Pengguna</div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $pengaduansaran->user->name }}</p>
                <p><strong>Email:</strong> {{ $pengaduansaran->user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($pengaduansaran->user->role) }}</p>
            </div>
        </div>

        <a href="{{ route('laporan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</section>

@endsection