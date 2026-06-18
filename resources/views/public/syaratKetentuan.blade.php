@extends('layouts.app')

@section('title', 'Syarat & Ketentuan | SMWKP')

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="min-h-screen pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface">
    <header class="mb-12 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Syarat &amp; Ketentuan</h1>
        <p class="font-body-lg text-on-surface-variant">Dengan mengakses dan menggunakan sistem SMWKP, Anda setuju untuk mematuhi syarat dan ketentuan berikut.</p>
    </header>

    <div class="max-w-4xl mx-auto bg-surface-container-low border border-outline-variant/10 rounded-lg p-8 md:p-12 space-y-8">
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">1. Ketentuan Akun Wisatawan</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Akun wisatawan digunakan untuk menjelajahi katalog, menulis ulasan berdasarkan pengalaman nyata, dan melakukan reservasi meja. Segala ulasan palsu, berbau sara, atau ujaran kebencian akan langsung dimoderasi dan dihapus oleh sistem.</p>
        </div>
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">2. Ketentuan Akun Mitra Restoran</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Sebagai mitra kuliner, Anda wajib mencantumkan informasi bisnis yang akurat, menu yang valid beserta harganya, dan mengunggah dokumen hukum legal (NIB/Sertifikat Halal) milik usaha Anda sendiri. Penyalahgunaan dokumen hukum milik pihak lain dapat berujung pada pemblokiran usaha permanen.</p>
        </div>
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">3. Konfirmasi Reservasi</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Reservasi meja yang diajukan oleh wisatawan merupakan kesepakatan itikad baik. Mitra berhak menyetujui atau membatalkan reservasi tergantung kapasitas ruang makan fisik yang tersedia.</p>
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
