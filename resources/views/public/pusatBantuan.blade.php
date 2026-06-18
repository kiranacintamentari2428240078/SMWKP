@extends('layouts.app')

@section('title', 'Pusat Bantuan | SMWKP')

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="min-h-screen pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface">
    <header class="mb-16 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Pusat Bantuan &amp; FAQ</h1>
        <p class="font-body-lg text-on-surface-variant">Temukan jawaban atas pertanyaan umum seputar penggunaan sistem SMWKP.</p>
    </header>

    <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-surface-container-low border border-outline-variant/10 rounded-lg p-6 hover:bg-surface-container-high transition-colors">
            <h3 class="font-headline-md text-headline-md text-primary mb-2">Bagaimana cara mendaftarkan restoran saya ke SMWKP?</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">Anda dapat mendaftarkan usaha Anda dengan mengeklik tombol "Daftarkan Sekarang" di beranda atau masuk ke menu registrasi mitra. Isi formulir dengan mengunggah NIB (Nomor Induk Berusaha) dan dokumen pendukung lainnya. Berkas Anda akan segera ditinjau oleh admin Dinas Pariwisata.</p>
        </div>
        <div class="bg-surface-container-low border border-outline-variant/10 rounded-lg p-6 hover:bg-surface-container-high transition-colors">
            <h3 class="font-headline-md text-headline-md text-primary mb-2">Apakah pendaftaran merchant di platform ini dipungut biaya?</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">Tidak. Pendaftaran dan verifikasi kuliner di platform SMWKP sepenuhnya gratis tanpa dipungut biaya apa pun. Ini merupakan program resmi Dinas Pariwisata Kota Palembang untuk mendukung pertumbuhan UMKM kuliner daerah.</p>
        </div>
        <div class="bg-surface-container-low border border-outline-variant/10 rounded-lg p-6 hover:bg-surface-container-high transition-colors">
            <h3 class="font-headline-md text-headline-md text-primary mb-2">Bagaimana cara wisatawan melakukan reservasi meja?</h3>
            <p class="text-on-surface-variant text-sm leading-relaxed">Masuk ke halaman detail restoran tujuan, klik tombol "Pesan Meja". Masukkan nama, nomor WhatsApp aktif, tanggal, waktu kedatangan, serta jumlah tamu. Setelah disubmit, Mitra restoran akan menyetujui atau menolak pesanan Anda dari dashboard mereka.</p>
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
