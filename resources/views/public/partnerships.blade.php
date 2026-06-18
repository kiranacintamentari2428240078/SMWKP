@extends('layouts.app')

@section('title', 'Kemitraan UMKM | SMWKP')

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="min-h-screen pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface">
    <header class="mb-16 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Program Kemitraan UMKM</h1>
        <p class="font-body-lg text-on-surface-variant">Bergabunglah sebagai Mitra Restoran SMWKP dan hubungkan usaha kuliner Anda dengan ribuan wisatawan domestik maupun internasional di Palembang.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto mb-20">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Mengapa Bergabung dengan Kami?</h2>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-primary text-[24px]">visibility</span>
                    <div>
                        <h4 class="font-bold text-white text-[15px]">Tingkatkan Visibilitas</h4>
                        <p class="text-on-surface-variant text-sm mt-1">Usaha kuliner Anda akan langsung terindeks di Peta Kuliner digital yang diakses oleh wisatawan.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-primary text-[24px]">event_seat</span>
                    <div>
                        <h4 class="font-bold text-white text-[15px]">Reservasi Meja Mandiri</h4>
                        <p class="text-on-surface-variant text-sm mt-1">Wisatawan dapat memesan meja makan secara real-time dari aplikasi, mengurangi antrean fisik.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-primary text-[24px]">campaign</span>
                    <div>
                        <h4 class="font-bold text-white text-[15px]">Promosi Resmi Dinas</h4>
                        <p class="text-on-surface-variant text-sm mt-1">Mitra terdaftar mendapatkan prioritas dalam promosi festival pariwisata kuliner kota.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-surface-container-low border border-outline-variant/10 rounded-lg p-8 space-y-6">
            <h3 class="font-headline-md text-headline-md text-white">Daftarkan Usaha Anda</h3>
            <p class="text-on-surface-variant text-sm">Sudah memiliki akun? Daftarkan usaha Anda dengan mengunggah dokumen legalitas dari dashboard Mitra.</p>
            <div class="space-y-3">
                <a href="{{ route('restoran.register') }}" class="w-full bg-brand-maroon text-white font-label-md py-3 rounded-lg hover:bg-brand-maroon-light active:scale-[0.98] transition-all text-center block">
                    Daftar Akun Mitra Baru
                </a>
                <a href="{{ route('login') }}" class="w-full border border-brand-beige/30 text-brand-beige font-label-md py-3 rounded-lg hover:bg-white/5 active:scale-[0.98] transition-all text-center block">
                    Masuk ke Dashboard Mitra
                </a>
            </div>
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
