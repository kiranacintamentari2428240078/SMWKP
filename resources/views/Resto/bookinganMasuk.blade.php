@extends('layouts.app')

@section('title', 'Booking Masuk | SMWKP Admin')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-72 pt-24 pb-12 px-margin-desktop min-h-screen">
    <!-- Header Section -->
    <section class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-1">Booking Masuk</h2>
            <div class="flex items-center gap-6 mt-2">
                <div class="flex items-center gap-2">
                    <span class="text-on-surface font-bold">{{ $totalBookings }}</span>
                    <span class="text-on-surface-variant text-sm">Total Booking</span>
                </div>
                <div class="w-px h-3 bg-white/10"></div>
                <div class="flex items-center gap-2">
                    <span class="text-amber-500 font-bold">{{ $pendingBookings }}</span>
                    <span class="text-on-surface-variant text-sm">Menunggu</span>
                </div>
                <div class="w-px h-3 bg-white/10"></div>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-500 font-bold">{{ $confirmedBookings }}</span>
                    <span class="text-on-surface-variant text-sm">Dikonfirmasi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Table Booking List -->
    <section class="bg-surface-container-low rounded-2xl border border-white/5 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-surface-container/50">
                    <th class="px-6 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">Informasi Tamu</th>
                    <th class="px-6 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider">Waktu &amp; Tanggal</th>
                    <th class="px-6 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider text-center">Kapasitas</th>
                    <th class="px-6 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider text-center">Status</th>
                    <th class="px-6 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($bookings as $b)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-primary/20 border border-primary/30 flex items-center justify-center text-primary font-bold text-xs">
                                {{ strtoupper(substr($b->guest_name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-on-surface font-semibold text-sm">{{ $b->guest_name }}</p>
                                <p class="text-[11px] text-on-surface-variant">WA: +62{{ $b->guest_whatsapp }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <p class="text-on-surface text-sm font-medium">{{ $b->booking_time->format('d M Y') }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $b->booking_time->format('H:i') }} WIB</p>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-sm text-on-surface font-medium">{{ $b->number_of_guests }} Orang</span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="status-pill px-3 py-1 rounded text-xs font-semibold {{ $b->status === 'confirmed' ? 'bg-emerald-500/10 text-emerald-500' : ($b->status === 'rejected' ? 'bg-red-500/10 text-red-500' : 'bg-amber-500/10 text-amber-500') }}">
                            {{ ucfirst($b->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @if($b->status === 'pending')
                        <div class="flex items-center justify-center gap-2">
                            <form method="POST" action="{{ route('resto.booking.status', ['id' => $b->id]) }}">
                                @csrf
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="px-4 py-1.5 bg-emerald-500/10 text-emerald-400 rounded-lg text-xs font-bold hover:bg-emerald-500 hover:text-white transition-all">Konfirmasi</button>
                            </form>
                            <form method="POST" action="{{ route('resto.booking.status', ['id' => $b->id]) }}">
                                @csrf
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="px-4 py-1.5 bg-error/10 text-error rounded-lg text-xs font-bold hover:bg-error hover:text-white transition-all">Batalkan</button>
                            </form>
                        </div>
                        @else
                        <span class="text-xs text-on-surface-variant italic font-semibold">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-on-surface-variant">Belum ada booking masuk untuk restoran Anda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($bookings->hasPages())
        <div class="px-6 py-4 border-t border-white/5 bg-surface-container/30">
            {{ $bookings->links() }}
        </div>
        @endif
    </section>
</main>
@endsection
