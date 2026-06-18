@extends('layouts.app')

@section('title', 'Restoran Laksan Terbaik | SMWKP')

@section('styles')
<style>
    .glass-card {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .primary-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
    }
    .text-beige { color: #F5F5DC; }
    .text-maroon { color: #5a0f16; }
    .text-gold { color: #EAB308; }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<!-- Hero Section -->
<header class="relative pt-20 h-[614px] min-h-[500px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7xxhpR7X2y5yVFMjykFTPMdtj94Vqx5x3pFKjjjkC0Nh-S_QLegnRoyEuCso2kFNp9ULrjFAjlUTosd0BmGdSNa9oJKj48hYC_YIcd7xibx3ZVNJAfBqEUESlJkiqoUTtiJGW5AOaSBc_FGBQ_Pcbd84WfcLqo0blnysR2ZNS_BZJwd3DCQ8YBRlw9dTxa_xRhAY6Zm_1kpQabgAlZv---qjGLvrkl3eDEEnhhxBUv9ktkpI-y-m6OnAbLk-w2i0czD_F_NfSHccD">
        <div class="absolute inset-0 bg-gradient-to-r from-background via-background/60 to-transparent"></div>
    </div>
    <div class="relative z-10 px-margin-desktop container mx-auto">
        <div class="max-w-2xl">
            <span class="text-beige font-label-md tracking-widest uppercase mb-4 block">Warisan Budaya Palembang</span>
            <h1 class="font-display-lg text-display-lg text-white mb-6 leading-tight">Restoran Laksan Terbaik di Palembang</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-lg">
                Nikmati perpaduan kuah santan gurih berwarna jingga yang pedas dengan potongan laksan ikan yang lembut dan lezat.
            </p>
        </div>
    </div>
</header>

<main class="max-w-container-max mx-auto px-margin-desktop py-20 flex flex-col md:flex-row gap-gutter">
    <!-- Sidebar Filter -->
    <aside class="w-full md:w-72 shrink-0">
        <div class="glass-card rounded-lg p-6 sticky top-24 space-y-8">
            <!-- URUTKAN -->
            <div>
                <h3 class="font-label-md text-beige uppercase tracking-widest mb-4">Urutkan</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input checked="" class="w-4 h-4 text-maroon bg-surface border-outline-variant focus:ring-maroon focus:ring-offset-background" name="sort" type="radio">
                        <span class="text-on-surface group-hover:text-beige transition-colors">Terpopuler</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 text-maroon bg-surface border-outline-variant focus:ring-maroon focus:ring-offset-background" name="sort" type="radio">
                        <span class="text-on-surface group-hover:text-beige transition-colors">Rating Tertinggi</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 text-maroon bg-surface border-outline-variant focus:ring-maroon focus:ring-offset-background" name="sort" type="radio">
                        <span class="text-on-surface group-hover:text-beige transition-colors">Jarak Terdekat</span>
                    </label>
                </div>
            </div>
            <!-- RANGE HARGA -->
            <div class="border-t border-outline-variant pt-6">
                <h3 class="font-label-md text-beige uppercase tracking-widest mb-4">Range Harga</h3>
                <div class="flex items-center gap-2">
                    <span class="text-on-surface-variant text-label-md">Rp</span>
                    <input class="w-full bg-surface-container-low border border-outline-variant rounded-md px-3 py-2 text-sm focus:border-beige outline-none transition-all text-on-surface" placeholder="Min" type="text">
                    <span class="text-on-surface-variant">-</span>
                    <input class="w-full bg-surface-container-low border border-outline-variant rounded-md px-3 py-2 text-sm focus:border-beige outline-none transition-all text-on-surface" placeholder="Max" type="text">
                </div>
            </div>
            <!-- RATING -->
            <div class="border-t border-outline-variant pt-6">
                <h3 class="font-label-md text-beige uppercase tracking-widest mb-4">Rating</h3>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 rounded text-maroon bg-surface border-outline-variant focus:ring-maroon focus:ring-offset-background" type="checkbox">
                        <div class="flex text-gold">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 rounded text-maroon bg-surface border-outline-variant focus:ring-maroon focus:ring-offset-background" type="checkbox">
                        <div class="flex text-gold">
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-sm text-on-surface-variant" style="font-variation-settings: 'FILL' 0;">star</span>
                            <span class="ml-2 text-on-surface-variant text-sm">Keatas</span>
                        </div>
                    </label>
                </div>
            </div>
            <!-- LOKASI -->
            <div class="border-t border-outline-variant pt-6">
                <h3 class="font-label-md text-beige uppercase tracking-widest mb-4">Lokasi</h3>
                <select class="w-full bg-surface-container-low border border-outline-variant rounded-md px-3 py-2 text-sm text-on-surface focus:border-beige outline-none transition-all">
                    <option>Semua Lokasi</option>
                    <option>Ilir Barat I</option>
                    <option>Seberang Ulu I</option>
                    <option>Sako</option>
                    <option>Kemuning</option>
                </select>
            </div>
            <button class="w-full primary-gradient py-3 rounded-lg font-label-md text-label-md text-white transition-all hover:scale-[1.02] active:scale-95 mt-4">
                Terapkan Filter
            </button>
        </div>
    </aside>

    <!-- Main Grid Content -->
    <div class="flex-1">
        <div class="flex justify-between items-center mb-10 pb-6 border-b border-white/5">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-white">Menampilkan {{ $restaurants->count() }} Restoran Laksan</h2>
                <p class="text-on-surface-variant">Rekomendasi terbaik untuk hidangan Laksan</p>
            </div>
        </div>
        
        <!-- Restaurant Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
            @forelse($restaurants as $r)
            <div class="glass-card rounded-lg overflow-hidden flex flex-col group hover:translate-y-[-8px] transition-all duration-300 shadow-lg">
                <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="block relative aspect-video overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $r->photo_url }}">
                    <div class="absolute top-4 left-4 flex gap-2">
                        <span class="px-3 py-1 bg-beige text-background text-[12px] font-bold rounded-full">TERPOPULER</span>
                    </div>
                </a>
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-headline-md text-headline-md text-white">
                            <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="hover:text-primary transition-colors text-brand-beige">{{ $r->nama_restoran }}</a>
                        </h3>
                        <div class="flex items-center gap-1 text-gold">
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-bold text-beige">{{ number_format($r->reviews_avg_rating ?? 5.0, 1) }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-on-surface-variant font-label-md mb-6 text-brand-beige/70">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        {{ Str::limit($r->alamat, 40) }}
                    </div>
                    <div class="mt-auto flex justify-between items-center pt-6 border-t border-white/5">
                        <div>
                            <p class="text-[12px] text-on-surface-variant uppercase tracking-widest mb-1">Kisaran Harga</p>
                            <p class="font-bold text-beige">Rp 25k - 150k</p>
                        </div>
                        <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="px-6 py-3 primary-gradient text-white rounded-lg font-label-md hover:brightness-110 transition-all text-center">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-20 text-on-surface-variant">Tidak ada restoran dalam kategori ini.</div>
            @endforelse
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
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