@extends('layouts.auth')

@section('title', 'Pesan Meja | SMWKP')

@section('styles')
<style>
    .glass-panel {
        background: rgba(18, 20, 20, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(163, 139, 138, 0.2);
    }
    .btn-maroon-gradient {
        background: linear-gradient(to bottom, #5A0F16, #401015);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1), 0 4px 6px rgba(0,0,0,0.3);
        transition: all 0.3s ease;
    }
    .btn-maroon-gradient:hover {
        transform: translateY(-2px);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1), 0 8px 12px rgba(90, 15, 22, 0.4);
    }
</style>
@endsection

@section('content')
<!-- Full Page Atmospheric Background -->
<div class="fixed inset-0 z-0 overflow-hidden">
    <div class="absolute inset-0 bg-black/60 z-10"></div>
    <img class="w-full h-full object-cover scale-110 blur-xl" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=1000">
</div>

<!-- Booking Modal Wrapper - Centered Floating Card -->
<main class="relative z-10 w-full max-w-2xl mx-auto px-margin-mobile min-h-screen flex items-center justify-center pt-10 pb-10">
    <div class="glass-panel rounded-xl shadow-2xl overflow-hidden p-gutter md:p-12 w-full">
        <!-- Brand Header & Close -->
        <div class="flex justify-between items-start mb-10">
            <div>
                <h1 class="font-headline-lg text-headline-lg text-white">Reservasi Meja</h1>
                <p class="text-on-surface-variant font-body-md mt-2">Silakan lengkapi detail kunjungan Anda ke {{ $resto->nama_restoran }}.</p>
            </div>
            <a href="{{ route('wisatawan.detail-restoran', ['id' => $resto->id]) }}" class="p-2 hover:bg-surface-container-high rounded-full transition-colors group">
                <span class="material-symbols-outlined text-on-surface" style="color: rgb(255, 255, 255);">close</span>
            </a>
        </div>
        
        <form class="space-y-6" id="reservationForm" action="{{ route('wisatawan.reservasi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $resto->id }}">

            <!-- Date & Time Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col gap-2">
                    <label class="text-label-md font-label-md text-on-surface-variant" style="color: rgb(209, 199, 183);">Tanggal</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]" style="color: rgb(209, 199, 183);">calendar_today</span>
                        <input name="booking_date" value="{{ old('booking_date') }}" class="w-full rounded-lg py-3 pl-10 pr-4 bg-surface-bright text-on-secondary-fixed border border-outline-variant/30 text-on-surface focus:outline-none" required="" type="date" style="color: rgb(209, 199, 183);">
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-label-md font-label-md text-on-surface-variant" style="color: rgb(209, 199, 183);">Jam</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]" style="color: rgb(209, 199, 183);">schedule</span>
                        <input name="booking_time" value="{{ old('booking_time') }}" class="w-full rounded-lg py-3 pl-10 pr-4 bg-surface-bright text-on-secondary-fixed border border-outline-variant/30 text-on-surface focus:outline-none" required="" type="time" style="color: rgb(209, 199, 183);">
                    </div>
                </div>
            </div>
            
            <!-- Guests -->
            <div class="flex flex-col gap-2">
                <label class="text-label-md font-label-md text-on-surface-variant" style="color: rgb(209, 199, 183);">Jumlah Orang</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]" style="color: rgb(209, 199, 183);">groups</span>
                    <select name="number_of_guests" class="w-full rounded-lg py-3 pl-10 pr-4 appearance-none bg-surface-bright text-on-secondary-fixed border border-outline-variant/30 text-on-surface focus:outline-none" required="" style="color: rgb(209, 199, 183);">
                        <option disabled="" {{ old('number_of_guests') ? '' : 'selected' }} value="">Pilih jumlah tamu</option>
                        <option value="1" {{ old('number_of_guests') == '1' ? 'selected' : '' }}>1 Orang</option>
                        <option value="2" {{ old('number_of_guests') == '2' ? 'selected' : '' }}>2 Orang</option>
                        <option value="4" {{ old('number_of_guests') == '4' ? 'selected' : '' }}>4 Orang</option>
                        <option value="6" {{ old('number_of_guests') == '6' ? 'selected' : '' }}>6 Orang</option>
                        <option value="8" {{ old('number_of_guests') == '8' ? 'selected' : '' }}>8+ Orang (Meja Panjang)</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none" style="color: rgb(209, 199, 183);">expand_more</span>
                </div>
            </div>
            
            <!-- Personal Info -->
            <div class="space-y-4">
                <div class="flex flex-col gap-2">
                    <label class="text-label-md font-label-md text-on-surface-variant" style="color: rgb(209, 199, 183);">Nama Lengkap</label>
                    <input name="guest_name" value="{{ old('guest_name', auth()->user()->name) }}" class="w-full rounded-lg py-3 px-4 bg-surface-bright text-on-secondary-fixed border border-outline-variant/30 text-on-surface focus:outline-none" placeholder="Masukkan nama Anda" required="" type="text" style="color: rgb(209, 199, 183);">
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-label-md font-label-md text-on-surface-variant" style="color: rgb(209, 199, 183);">Nomor WhatsApp</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-label-md" style="color: rgb(209, 199, 183);">+62</span>
                        <input name="guest_whatsapp" value="{{ old('guest_whatsapp') }}" class="w-full rounded-lg py-3 pl-14 pr-4 bg-surface-bright text-on-secondary-fixed border border-outline-variant/30 text-on-surface focus:outline-none" placeholder="81234567890" required="" type="tel" style="color: rgb(209, 199, 183);">
                    </div>
                </div>
            </div>
            
            <!-- Action Button -->
            <div class="pt-6">
                <button class="btn-maroon-gradient w-full py-4 rounded-lg font-label-md text-label-md text-white tracking-widest flex items-center justify-center gap-2 uppercase font-bold" type="submit" style="background: rgb(90, 15, 22); color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 4px 6px;">
                    KONFIRMASI PESANAN
                    <span class="material-symbols-outlined text-[20px]" style="color: rgb(255, 255, 255);">arrow_forward</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        const btn = e.target.querySelector('button[type="submit"]');
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> MEMPROSES...';
        btn.disabled = true;
    });
</script>
@endsection