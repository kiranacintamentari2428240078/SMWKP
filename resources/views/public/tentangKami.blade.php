@extends('layouts.app')

@section('title', 'Tentang Kami | SMWKP')

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="min-h-screen pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface">
    <header class="mb-16 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Tentang SMWKP</h1>
        <p class="font-body-lg text-on-surface-variant">Sistem Manajemen Wisata Kuliner Palembang (SMWKP) adalah platform digital resmi yang didedikasikan untuk mendata, melestarikan, dan mempromosikan kekayaan gastronomi Kota Palembang.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Misi Melestarikan Warisan Sriwijaya</h2>
            <p class="font-body-md text-on-surface-variant leading-relaxed mb-6">Palembang memiliki kekayaan kuliner legendaris yang mendalam, mulai dari Pempek yang diakui dunia, Tekwan dengan kaldu udang gurihnya, hingga kuah kental khas Mie Celor. SMWKP hadir sebagai jembatan informasi yang andal bagi wisatawan untuk menemukan cita rasa otentik.</p>
            <p class="font-body-md text-on-surface-variant leading-relaxed">Melalui platform ini, Dinas Kebudayaan dan Pariwisata Kota Palembang bekerja sama dengan pelaku usaha (Mitra UMKM) untuk melakukan verifikasi legalitas, menjamin kualitas kebersihan, kehalalan, dan standar pelayanan demi kepuasan para penikmat kuliner nusantara.</p>
        </div>
        <div class="h-[400px] rounded-lg overflow-hidden border border-outline-variant/20 shadow-2xl">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD844bhjrzv-Ga9Pa8sQej3ZOIGK2vFcB3DPC6lgZwRLc83ZGISMLnDgCiFXqgYmkl4tQ5DN5tNWUceK2URBqEe8palgfy4SynhDBSNv7q1pfEr2feqWJFbvT3AOODiKvBtjAeN4o4nw7hT5k3VYq-bGfYdnMjX1gcEPPvY7rN_mVNKfkQidF-v2pGPWs224eY05ioCPVk5HAZ2OcveLiqiqnA_YFaW7lfxcmVmLbfG-7Dyk4kj7p3p-o2-OeRoM3trmMoL7B6rVBus">
        </div>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20 text-center">
        <div class="p-8 bg-surface-container-low border border-outline-variant/10 rounded-lg">
            <span class="material-symbols-outlined text-[48px] text-primary mb-4">verified</span>
            <h3 class="font-headline-md text-headline-md text-white mb-2">Kurasi Terverifikasi</h3>
            <p class="text-on-surface-variant text-sm">Setiap merchant melewati kurasi berkas hukum dan NIB langsung oleh admin Dinas Pariwisata.</p>
        </div>
        <div class="p-8 bg-surface-container-low border border-outline-variant/10 rounded-lg">
            <span class="material-symbols-outlined text-[48px] text-primary mb-4">map</span>
            <h3 class="font-headline-md text-headline-md text-white mb-2">Peta Kuliner Presisi</h3>
            <p class="text-on-surface-variant text-sm">Navigasi peta digital yang akurat untuk menuntun wisatawan ke lokasi kuliner legendaris.</p>
        </div>
        <div class="p-8 bg-surface-container-low border border-outline-variant/10 rounded-lg">
            <span class="material-symbols-outlined text-[48px] text-primary mb-4">groups</span>
            <h3 class="font-headline-md text-headline-md text-white mb-2">Dukungan UMKM</h3>
            <p class="text-on-surface-variant text-sm">Menyediakan platform promosi mandiri dan reservasi meja untuk meningkatkan omzet penjualan mitra lokal.</p>
        </div>
    </section>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
