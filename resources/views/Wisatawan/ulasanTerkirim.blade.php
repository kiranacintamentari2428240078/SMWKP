@extends('layouts.auth')

@section('title', 'Ulasan Terkirim | SMWKP')

@section('styles')
<style>
    .success-glow {
        filter: drop-shadow(0 0 20px rgba(255, 179, 178, 0.3));
    }
</style>
@endsection

@section('content')
<!-- Background Layer -->
<div class="absolute inset-0 z-0">
    <img class="w-full h-full object-cover opacity-30 blur-xl scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBZXzi-AMxB85RXLdRijmEP2ojbUz4xBd_tkzpOmo7AI8qPMfoyMyHku2QziHLGgTZNxxaJxHVmjPvtHNKetoKPnUtgIVOqGr-JCggBZNK3QRw_RRLswA_oPv_GBa-LkUUet0SX5QK7wP_-68kMafg7NS95E5rEEnC7diBe5v3xarXTc18knNKWKUXpkblWvxv2FuhoXS4vkgWaTsGi8Pbe8pa5gFbk7pqz3Skz37C-FOMhkuWq5Cn47dybNmGoZXDqROR-pZl62wc"/>
    <div class="absolute inset-0 bg-gradient-to-t from-background via-background/80 to-transparent"></div>
</div>

<!-- Main Content Canvas -->
<main class="relative z-10 w-full max-w-lg mx-auto min-h-screen flex items-center justify-center">
    <div class="glass-card p-10 md:p-14 rounded-lg flex flex-col items-center text-center shadow-2xl animate-in fade-in zoom-in duration-700">
        <!-- Success Icon -->
        <div class="mb-8 relative">
            <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full scale-150"></div>
            <div class="relative w-24 h-24 bg-surface-container-high rounded-full flex items-center justify-center border border-outline-variant/30 success-glow">
                <span class="material-symbols-outlined text-6xl font-light animate-bounce text-primary" style="font-variation-settings: 'wght' 300;">check_circle</span>
            </div>
        </div>
        
        <!-- Typography Content -->
        <h1 class="font-headline-lg text-headline-lg mb-4 text-on-surface tracking-tight font-bold">
            Ulasan Terkirim
        </h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 leading-relaxed max-w-sm">
            Terima kasih atas kontribusi Anda! Ulasan Anda sangat berarti bagi pengembangan kuliner Palembang.
        </p>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
            <a class="group relative overflow-hidden bg-primary-container text-on-surface px-8 py-4 rounded-full font-label-md text-label-md transition-all duration-300 hover:shadow-lg hover:shadow-outline/20 active:scale-95 flex items-center justify-center gap-2" href="{{ route('wisatawan.homepage') }}">
                <span class="relative z-10">Kembali ke Beranda</span>
                <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
            </a>
            <a class="bg-transparent border border-outline text-on-surface-variant hover:bg-surface-variant/30 px-8 py-4 rounded-full font-label-md text-label-md transition-all duration-300 w-full sm:w-auto min-w-[200px] flex items-center justify-center gap-2" href="{{ route('wisatawan.ulasan') }}">
                <span class="material-symbols-outlined text-[20px]">visibility</span>Lihat Ulasan Saya
            </a>
        </div>
    </div>
</main>
@endsection