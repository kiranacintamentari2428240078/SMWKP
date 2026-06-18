@extends('layouts.auth')

@section('title', 'Reservasi Berhasil | SMWKP')

@section('styles')
<style>
    .gold-gradient-text {
        background: linear-gradient(135deg, #dbc0bf 0%, #a38b8a 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .success-glow {
        box-shadow: 0 0 40px rgba(90, 15, 22, 0.3);
    }
</style>
@endsection

@section('content')
<!-- Background Layer -->
<div class="fixed inset-0 z-0">
    <img alt="Restaurant Interior" class="w-full h-full object-cover opacity-40 scale-105 blur-sm" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1000">
    <div class="absolute inset-0 bg-gradient-to-b from-background/60 via-background/80 to-background"></div>
</div>

<!-- Main Canvas -->
<main class="relative z-10 min-h-screen flex items-center justify-center px-margin-mobile md:px-margin-desktop">
    <div class="glass-panel w-full max-w-[540px] p-8 md:p-12 rounded-lg flex flex-col items-center text-center success-glow animate-in fade-in zoom-in duration-700">
        <!-- Success Icon -->
        <div class="mb-8 relative">
            <div class="absolute inset-0 bg-primary/20 rounded-full blur-2xl animate-pulse"></div>
            <div class="relative w-24 h-24 rounded-full border-2 border-outline/30 flex items-center justify-center bg-surface-container-low">
                <span class="material-symbols-outlined text-6xl font-light animate-bounce text-primary" style="font-variation-settings: 'wght' 300;">
                    check_circle
                </span>
            </div>
        </div>
        
        <!-- Content -->
        <h1 class="font-headline-lg text-headline-lg mb-4 text-on-surface font-bold tracking-tight">
            Reservasi Berhasil
        </h1>
        <p class="font-body-md text-body-md text-on-surface-variant mb-10 max-w-sm leading-relaxed">
            Terima kasih! Reservasi Anda di <strong>{{ $booking->restaurant->nama_restoran }}</strong> telah kami terima dan sedang diproses. Mohon tunggu konfirmasi melalui WhatsApp.
        </p>
        
        <!-- Reservation Summary Card -->
        <div class="w-full bg-surface-container/50 rounded-lg p-6 mb-10 border border-outline-variant/10 text-left">
            <div class="flex items-center gap-4 mb-4">
                <span class="material-symbols-outlined text-outline" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                <span class="font-label-md text-label-md uppercase tracking-widest text-on-surface/60">Detail Reservasi</span>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[10px] uppercase font-bold mb-1 text-on-surface-variant">Status</p>
                    <p class="text-on-surface font-medium flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full {{ $booking->status === 'confirmed' ? 'bg-green-500' : ($booking->status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500 animate-pulse') }}"></span>
                        {{ ucfirst($booking->status) }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold mb-1 text-on-surface-variant">ID Reservasi</p>
                    <p class="text-on-surface font-medium">#SMWKP-{{ $booking->id }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold mb-1 text-on-surface-variant">Nama Lengkap</p>
                    <p class="text-on-surface font-medium">{{ $booking->guest_name }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold mb-1 text-on-surface-variant">Jumlah Orang</p>
                    <p class="text-on-surface font-medium">{{ $booking->number_of_guests }} Orang</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold mb-1 text-on-surface-variant">Tanggal</p>
                    <p class="text-on-surface font-medium">{{ $booking->booking_time->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold mb-1 text-on-surface-variant">Jam</p>
                    <p class="text-on-surface font-medium">{{ $booking->booking_time->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col w-full gap-4">
            <a class="group relative overflow-hidden bg-primary-container text-on-surface px-8 py-4 rounded-full font-label-md text-label-md transition-all duration-300 hover:shadow-lg hover:shadow-outline/20 active:scale-95 flex items-center justify-center gap-2" href="{{ route('wisatawan.homepage') }}">
                <span class="relative z-10">Kembali ke Beranda</span>
                <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
            </a>
        </div>
        
        <!-- Support Footer -->
        <p class="mt-8 text-[12px] text-on-surface/40">
            Ada pertanyaan? <a class="text-on-surface-variant hover:text-primary underline decoration-primary/30 transition-colors" href="{{ route('pusat.bantuan') }}">Hubungi Bantuan</a>
        </p>
    </div>
</main>

<div class="fixed top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary/50 to-transparent"></div>
@endsection