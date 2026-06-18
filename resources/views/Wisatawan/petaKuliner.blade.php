@extends('layouts.app')

@section('title', 'Peta Kuliner Palembang | SMWKP')

@section('styles')
<style>
    .glass-panel {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .map-dark-mode {
        filter: grayscale(100%) invert(90%) contrast(120%) brightness(80%);
    }
    .maroon-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
    }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto animate-in fade-in duration-500">
    <header class="mb-10">
        <h1 class="font-display-lg text-[40px] md:text-display-lg mb-4 text-white leading-tight">Peta Kuliner Digital</h1>
        <p class="font-body-lg text-on-surface-variant max-w-2xl">Temukan lokasi wisata kuliner unggulan di Kota Palembang secara spasial dan presisi.</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 h-[600px] overflow-hidden rounded-xl border border-outline-variant/10 shadow-2xl">
        <!-- Sidebar Listings -->
        <aside class="lg:col-span-4 bg-surface-container-low flex flex-col h-full overflow-hidden">
            <div class="p-6 border-b border-outline-variant/10">
                <h3 class="font-headline-md text-brand-beige text-lg mb-2">Restoran Terdekat</h3>
                <p class="text-xs text-on-surface-variant">Klik restoran untuk melihat koordinat pada peta.</p>
            </div>
            
            <div class="flex-1 overflow-y-auto divide-y divide-outline-variant/5 custom-scrollbar">
                @forelse($restaurants as $r)
                <div class="p-6 hover:bg-white/[0.02] transition-colors cursor-pointer group" onclick="focusRestaurant('{{ $r->nama_restoran }}', {{ $r->latitude }}, {{ $r->longitude }}, '{{ $r->kategori }}', '{{ $r->photo_url }}', '{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}')">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-surface-container-highest flex-shrink-0">
                            <img alt="Resto" class="w-full h-full object-cover" src="{{ $r->photo_url }}">
                        </div>
                        <div>
                            <h4 class="font-label-md text-brand-beige text-sm group-hover:text-primary transition-colors">{{ $r->nama_restoran }}</h4>
                            <p class="text-[11px] text-secondary font-medium uppercase mt-0.5">{{ $r->kategori }}</p>
                            <p class="text-xs text-on-surface-variant mt-2 line-clamp-1"><span class="material-symbols-outlined text-xs mr-1">location_on</span>{{ $r->alamat }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center text-on-surface-variant text-sm">Tidak ada kuliner terdaftar di peta.</div>
                @endforelse
            </div>
        </aside>

        <!-- Map Workspace Canvas -->
        <div class="lg:col-span-8 relative bg-surface-container-high h-full flex flex-col justify-end">
            <!-- Simulated Map Overlay background -->
            <div class="absolute inset-0 z-0">
                <iframe class="w-full h-full border-none map-dark-mode" src="https://maps.google.com/maps?q=-2.983944,104.757022&z=13&output=embed" id="google-maps-frame"></iframe>
            </div>

            <!-- Focus Floating Card Panel -->
            <div class="relative z-10 m-6 max-w-sm glass-panel rounded-lg p-6 translate-y-0 opacity-100 transition-all duration-300" id="map-resto-card">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-surface-container-highest">
                        <img alt="resto" class="w-full h-full object-cover" id="map-card-img" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJokQ9LAhQnfMfsXyJzPmsj0N8Xrb8h19D40Plx2K3cdN9q_j8bngy0laSXKlnehrO7K0x1NSnlc74nKFNk3HtdtVP6jVoihQUsud_suwnTDDPHMxQ54ulTIL5HKz7vwX4C4X5nNnYwIlQf3u5Z_EwIjNuug4UiBtCfBibwndSZ_KCT_4cnJLH4rSv1Q6M9qy9TYOCmhFuMidzNZmRoK_D1DApEiZMwa_LZgmKLOMvKJR6MC8-TxsRgEAt9QOKcrNMJshxHYRQo-Kn">
                    </div>
                    <div>
                        <h4 class="font-headline-md text-brand-beige text-base" id="map-card-name">Pempek Candy</h4>
                        <p class="text-[10px] text-secondary uppercase tracking-wider font-semibold" id="map-card-category">Pempek</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="#" class="flex-1 py-2 rounded-lg maroon-gradient text-white text-xs font-bold text-center" id="map-card-link">Lihat Detail</a>
                    <button class="px-4 py-2 rounded-lg bg-surface-container-high border border-outline-variant text-brand-beige text-xs" onclick="resetMap()">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
    function focusRestaurant(name, lat, lng, category, imgSrc, detailUrl) {
        // Change google maps iframe coordinates
        const frame = document.getElementById('google-maps-frame');
        frame.src = `https://maps.google.com/maps?q=${lat},${lng}&z=16&output=embed`;
        
        // Populate floating card
        document.getElementById('map-card-name').textContent = name;
        document.getElementById('map-card-category').textContent = category;
        document.getElementById('map-card-img').src = imgSrc;
        document.getElementById('map-card-link').href = detailUrl;

        // Show floating card
        const card = document.getElementById('map-resto-card');
        card.classList.remove('opacity-0', 'translate-y-4');
    }

    function resetMap() {
        const card = document.getElementById('map-resto-card');
        card.classList.add('opacity-0', 'translate-y-4');
    }

    // Initialize with first restaurant if available
    @if(count($restaurants) > 0)
        document.addEventListener('DOMContentLoaded', () => {
            const first = {
                name: '{{ $restaurants[0]->nama_restoran }}',
                lat: {{ $restaurants[0]->latitude }},
                lng: {{ $restaurants[0]->longitude }},
                category: '{{ $restaurants[0]->kategori }}',
                imgSrc: '{{ $restaurants[0]->photo_url }}',
                url: '{{ route("wisatawan.detail-restoran", ["id" => $restaurants[0]->id]) }}'
            };
            focusRestaurant(first.name, first.lat, first.lng, first.category, first.imgSrc, first.url);
        });
    @endif
</script>
@endsection
