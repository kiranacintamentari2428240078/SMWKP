@extends('layouts.app')

@section('title', 'Admin Dashboard | KulinerPalembang')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Area -->
<main class="ml-72 min-h-screen bg-background p-margin-desktop custom-scrollbar relative">
    <!-- Top Bar / Quick Action -->
    <header class="flex justify-between items-center mb-10 font-headline-md">
        <div>
            <h2 class="font-headline-lg text-headline-lg" style="color: rgb(245, 230, 211);">Halo, {{ $restaurant->nama_restoran }}</h2>
            <p style="color: rgb(219, 192, 191);" class="">Pantau performa kuliner tradisional Anda hari ini.</p>
        </div>
        <a href="{{ route('resto.galeri') }}" class="flex items-center gap-2 bg-primary-container text-primary px-6 py-3 rounded-full font-medium shadow-lg hover:brightness-110 transition-all active:scale-95 border border-white/10">
            <span class="material-symbols-outlined" data-icon="add_a_photo">add_a_photo</span>
            Manajemen Menu
        </a>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter mb-gutter">
        <!-- Total Booking -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-primary" data-icon="calendar_month">calendar_month</span>
                <span class="text-[12px] text-primary font-bold bg-primary-container/20 px-2 py-1 rounded">Total</span>
            </div>
            <h3 class="text-on-surface-variant font-label-md mb-1">Total Booking</h3>
            <p class="text-headline-md font-headline-md text-on-surface">{{ $totalBookings }}</p>
        </div>
        <!-- Menunggu Konfirmasi -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-primary" data-icon="pending_actions">pending_actions</span>
                <span class="text-[12px] text-yellow-400 font-bold bg-yellow-500/20 px-2 py-1 rounded">Pending</span>
            </div>
            <h3 class="text-on-surface-variant font-label-md mb-1">Booking Pending</h3>
            <p class="text-headline-md font-headline-md text-on-surface">{{ $pendingBookings }}</p>
        </div>
        <!-- Rating Rata-rata -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-primary" data-icon="star" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="text-[12px] text-on-surface-variant">Skala 5.0</span>
            </div>
            <h3 class="text-on-surface-variant font-label-md mb-1">Rating Rata-rata</h3>
            <p class="text-headline-md font-headline-md text-on-surface">{{ $avgRating }}<span class="text-body-md text-on-surface-variant ml-1">/5.0</span></p>
        </div>
        <!-- Total Ulasan -->
        <div class="glass-card p-6 rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <span class="material-symbols-outlined text-primary" data-icon="chat">chat</span>
                <span class="text-[12px] text-on-surface-variant">Ulasan</span>
            </div>
            <h3 class="text-on-surface-variant font-label-md mb-1">Total Ulasan</h3>
            <p class="text-headline-md font-headline-md text-on-surface">{{ $totalReviews }}</p>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-gutter">
        <!-- Restaurant Status & Profile Info (Bento Style) -->
        <div class="col-span-12 md:col-span-8 flex flex-col gap-gutter">
            <!-- Chart Section -->
            <div class="glass-card p-8 rounded-lg flex-1">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="font-headline-md text-headline-md text-on-surface">Grafik Aktivitas Booking</h3>
                        <p class="text-on-surface-variant text-label-md">Statistik reservasi meja restoran Anda</p>
                    </div>
                </div>
                <!-- Fake Chart Placeholder with modern aesthetics -->
                <div class="h-64 w-full flex items-end gap-2 px-2">
                    <div class="flex-1 bg-primary/20 rounded-t h-[40%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">10%</div>
                    </div>
                    <div class="flex-1 bg-primary/20 rounded-t h-[65%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">25%</div>
                    </div>
                    <div class="flex-1 bg-primary/20 rounded-t h-[55%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">15%</div>
                    </div>
                    <div class="flex-1 bg-primary/20 rounded-t h-[85%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">45%</div>
                    </div>
                    <div class="flex-1 bg-primary/20 rounded-t h-[75%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">35%</div>
                    </div>
                    <div class="flex-1 bg-primary/20 rounded-t h-[95%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">50%</div>
                    </div>
                    <div class="flex-1 bg-primary-container rounded-t h-[80%] hover:bg-primary/40 transition-all cursor-pointer relative group">
                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-surface px-2 py-1 rounded text-[10px] border border-outline-variant opacity-0 group-hover:opacity-100 transition-opacity">60%</div>
                    </div>
                </div>
                <div class="flex justify-between mt-4 px-2 text-[11px] text-on-surface-variant font-label-md">
                    <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
                </div>
            </div>
            <!-- Status Restoran Info -->
            <div class="glass-card p-6 rounded-lg flex items-center justify-between border-l-4 border-primary-container">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0 border border-outline-variant">
                        <img alt="{{ $restaurant->nama_restoran }}" class="w-full h-full object-cover" src="{{ $restaurant->photo_url }}">
                    </div>
                    <div>
                        @if($restaurant->status === 'approved')
                            <span class="px-2 py-0.5 rounded-full bg-green-900/40 text-green-400 text-[10px] font-bold border border-green-800 uppercase tracking-widest mb-2 inline-block">Aktif • Terverifikasi</span>
                        @elseif($restaurant->status === 'pending')
                            <span class="px-2 py-0.5 rounded-full bg-yellow-900/40 text-yellow-400 text-[10px] font-bold border border-yellow-800 uppercase tracking-widest mb-2 inline-block">Menunggu Verifikasi</span>
                        @else
                            <span class="px-2 py-0.5 rounded-full bg-red-900/40 text-red-400 text-[10px] font-bold border border-red-800 uppercase tracking-widest mb-2 inline-block">Ditolak / Nonaktif</span>
                        @endif
                        <h4 class="font-headline-md text-headline-md text-on-surface">{{ $restaurant->nama_restoran }}</h4>
                        <p class="text-on-surface-variant text-body-md">{{ $restaurant->alamat }}</p>
                    </div>
                </div>
                <a href="{{ route('resto.profilUsaha') }}" class="border border-outline-variant text-on-surface px-6 py-2 rounded-lg font-label-md hover:bg-surface-container-high transition-all whitespace-nowrap">
                    Edit Profil
                </a>
            </div>
        </div>
        <!-- Side Widgets -->
        <div class="col-span-12 md:col-span-4 flex flex-col gap-gutter">
            <!-- Widget Booking Masuk -->
            <div class="glass-card rounded-lg flex flex-col overflow-hidden">
                <div class="p-6 border-b border-outline-variant/10 flex justify-between items-center">
                    <h3 class="font-label-md text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[20px]" data-icon="pending_actions">pending_actions</span>
                        Booking Masuk
                    </h3>
                    <a class="text-[12px] text-primary hover:underline" href="{{ route('resto.booking') }}">Lihat Semua</a>
                </div>
                <div class="flex-1 overflow-y-auto custom-scrollbar max-h-[320px]">
                    @forelse($bookings as $booking)
                        <div class="p-4 border-b border-outline-variant/5 hover:bg-surface-container-high/30 transition-all group">
                            <div class="flex justify-between items-start mb-2">
                                <p class="font-label-md text-on-surface font-semibold">{{ $booking->guest_name }}</p>
                                <span class="text-[11px] text-on-surface-variant bg-surface-container px-2 py-0.5 rounded">{{ $booking->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-[12px] text-on-surface-variant mb-4">
                                <span class="material-symbols-outlined text-[14px]" data-icon="schedule">schedule</span>
                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i') }} WIB • {{ $booking->number_of_guests }} Kursi
                            </div>
                            <div class="flex gap-2">
                                @if($booking->status === 'pending')
                                    <form action="{{ route('resto.booking.status', $booking->id) }}" method="POST" class="flex-1 flex gap-2">
                                        @csrf
                                        <button name="status" value="confirmed" type="submit" class="flex-1 bg-green-700 hover:bg-green-600 text-white py-2 rounded-md text-[12px] font-bold transition-all active:scale-95">Setujui</button>
                                        <button name="status" value="rejected" type="submit" class="flex-1 bg-red-900 hover:bg-red-800 text-white py-2 rounded-md text-[12px] font-bold transition-all active:scale-95">Tolak</button>
                                    </form>
                                @else
                                    <span class="text-[12px] font-semibold text-on-surface-variant italic px-2 py-1 rounded bg-surface-container">
                                        Status: {{ $booking->status === 'confirmed' ? 'Disetujui' : 'Dibatalkan' }}
                                    </span>
                                @endif
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->guest_whatsapp) }}" target="_blank" class="w-10 h-9 flex items-center justify-center border border-outline-variant rounded-md hover:border-primary transition-all group-hover:text-primary" title="Hubungi Wisatawan">
                                    <span class="material-symbols-outlined text-[18px]" data-icon="chat">chat</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-on-surface-variant text-body-md">Tidak ada booking terbaru.</div>
                    @endforelse
                </div>
            </div>
            <!-- Widget Ulasan Terbaru -->
            <div class="glass-card rounded-lg flex flex-col p-6">
                <h3 class="font-label-md text-on-surface flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary text-[20px]" data-icon="grade">grade</span>
                    Ulasan Terbaru
                </h3>
                <div class="space-y-6">
                    @forelse($reviews as $rev)
                        <div class="relative pl-4 border-l-2 {{ $loop->first ? 'border-primary-container' : 'border-outline-variant/30' }}">
                            <div class="flex items-center gap-1 mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-[14px]" data-icon="star" style="font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }}; color: rgb(250, 204, 21);">star</span>
                                @endfor
                            </div>
                            <p class="text-[13px] text-on-surface mb-2 italic">"{{ $rev->comment }}"</p>
                            <div class="flex justify-between items-center">
                                <span class="text-[11px] text-on-surface-variant font-medium">{{ $rev->user->name ?? 'Anonim' }}</span>
                                @if(!$rev->reply_comment)
                                    <a href="{{ route('resto.reviews') }}" class="text-[11px] font-bold text-primary hover:text-white transition-colors uppercase tracking-wider">Balas</a>
                                @else
                                    <span class="text-[11px] text-green-400 font-medium">Sudah Dibalas</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-on-surface-variant text-body-md">Belum ada ulasan masuk.</div>
                    @endforelse
                </div>
                <a href="{{ route('resto.reviews') }}" class="mt-8 w-full border border-outline-variant py-2.5 rounded-lg text-center text-[12px] font-label-md text-on-surface-variant hover:text-primary hover:border-primary transition-all">
                    Lihat Semua Review
                </a>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    // Micro-interactions and effects
    document.querySelectorAll('.glass-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
</script>
@endsection