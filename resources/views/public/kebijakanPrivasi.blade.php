@extends('layouts.app')

@section('title', 'Kebijakan Privasi | SMWKP')

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="min-h-screen pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface">
    <header class="mb-12 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Kebijakan Privasi</h1>
        <p class="font-body-lg text-on-surface-variant">Kebijakan Privasi ini menjelaskan bagaimana SMWKP mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.</p>
    </header>

    <div class="max-w-4xl mx-auto bg-surface-container-low border border-outline-variant/10 rounded-lg p-8 md:p-12 space-y-8">
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">1. Informasi yang Kami Kumpulkan</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Kami mengumpulkan informasi yang Anda berikan langsung kepada kami saat mendaftar akun, melengkapi profil restoran, mengajukan permohonan sertifikasi, atau menulis ulasan kuliner. Informasi ini meliputi nama, alamat email, nomor telepon/WhatsApp, dan koordinat lokasi usaha.</p>
        </div>
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">2. Penggunaan Informasi</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Informasi pribadi Anda digunakan untuk memverifikasi pendaftaran merchant kuliner oleh Dinas Pariwisata, memproses pemesanan/reservasi meja, menyajikan peta kuliner digital kepada wisatawan, serta mengirimkan notifikasi penting mengenai akun Anda.</p>
        </div>
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">3. Keamanan Data</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Kami menerapkan langkah-langkah keamanan teknis yang ketat untuk melindungi informasi pribadi Anda dari akses tidak sah, pengubahan, pengungkapan, atau penghancuran. Dokumen legalitas seperti NIB dan sertifikat halal disimpan secara aman di direktori penyimpanan berizin.</p>
        </div>
        <div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4">4. Hak Anda</h2>
            <p class="text-on-surface-variant leading-relaxed text-sm">Anda memiliki hak penuh untuk mengakses, memperbarui, atau menghapus informasi pribadi Anda kapan saja melalui dashboard akun masing-masing (Wisatawan atau Mitra).</p>
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
