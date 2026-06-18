@extends('layouts.app')

@section('title', 'SMWKP | Warisan Kuliner Nusantara')

@section('styles')
<style>
    .glass-effect {
        backdrop-filter: blur(20px);
        background: rgba(18, 20, 20, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .hero-gradient {
        background: linear-gradient(0deg, rgba(18,20,20,1) 0%, rgba(18,20,20,0.4) 50%, rgba(18,20,20,0.8) 100%);
    }
    .maroon-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
    }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main>
    <!-- Hero Section -->
    <section class="relative h-screen min-h-[700px] flex items-center justify-center">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover animate-in fade-in duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAG-C0eGVfn21uPb5F9DWJ0cUD576jTAPoYhQAgUGKZdPjBtm7aoPH6thoC_e7soKOSOV7cgOMsalkaUujmtRw3nKGy_KKVepeT7rVMpP2E7yzbNYVNsUvHflE_tjHwKbpL9d1kSDD-vt6h9wv5qNIKZgxEFH6DYloMfq1he9vXIT_9XJhj68-EGF2r2lDghZfWJDfJGgg7ujWEHitO_hZJlZRCZ7oj77-V5FxhN2c0jan2tUL3I9ndw44P7GT4BuMVcl3_xgtoIrER" style="transform: translateY(0px);">
            <div class="absolute inset-0 hero-gradient"></div>
        </div>
        <div class="relative z-10 w-full max-w-4xl px-margin-mobile text-center">
            <h1 class="font-display-lg text-display-lg text-on-surface mb-8">Temukan Rasa, <span class="text-primary">Ciptakan Cerita</span></h1>
            <p class="text-on-surface-variant font-body-lg mb-12 max-w-2xl mx-auto">Setiap hidangan memiliki cerita. Temukan tempat kuliner terbaik dan nikmati momen yang tak terlupakan.</p>
            <form action="{{ route('wisatawan.katalog') }}" method="GET" class="glass-effect p-2 flex flex-col md:flex-row gap-2 max-w-3xl mx-auto shadow-2xl rounded-full">
                <div class="flex-1 flex items-center px-4 bg-surface-container-lowest border border-outline-variant/30 rounded-full">
                    <span class="material-symbols-outlined mr-2 text-primary">search</span>
                    <input name="search" class="bg-transparent border-none focus:ring-0 text-on-surface w-full py-4 font-body-md text-brand-beige" placeholder="Cari Nama Tempat, Menu, atau Kategori..." type="text">
                </div>
                <button type="submit" class="maroon-gradient px-10 py-4 font-headline-md text-headline-md text-white transition-all hover:brightness-110 active:scale-95 rounded-full">
                    Cari Sekarang
                </button>
            </form>
        </div>
    </section>

    <!-- Kategori Terpopuler -->
    <section class="py-20 px-margin-desktop max-w-container-max mx-auto">
        <h2 class="font-headline-lg text-headline-lg mb-12 text-center">Kategori <span class="text-primary">Terpopuler</span></h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-gutter">
            <a class="group flex flex-col items-center gap-4 p-8 glass-effect rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-container/20" href="{{ route('wisatawan.kategori', ['slug' => 'pempek']) }}">
                <div class="w-16 h-16 rounded-full maroon-gradient flex items-center justify-center text-white shadow-lg">
                    <span class="material-symbols-outlined text-[32px] text-primary">bakery_dining</span>
                </div>
                <span class="font-headline-md text-headline-md group-hover:text-primary transition-colors">Pempek</span>
            </a>
            <a class="group flex flex-col items-center gap-4 p-8 glass-effect rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-container/20" href="{{ route('wisatawan.kategori', ['slug' => 'tekwan']) }}">
                <div class="w-16 h-16 rounded-full maroon-gradient flex items-center justify-center text-white shadow-lg">
                    <span class="material-symbols-outlined text-[32px] text-primary">ramen_dining</span>
                </div>
                <span class="font-headline-md text-headline-md group-hover:text-primary transition-colors">Tekwan</span>
            </a>
            <a class="group flex flex-col items-center gap-4 p-8 glass-effect rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-container/20" href="{{ route('wisatawan.kategori', ['slug' => 'model']) }}">
                <div class="w-16 h-16 rounded-full maroon-gradient flex items-center justify-center text-white shadow-lg">
                    <span class="material-symbols-outlined text-[32px] text-primary">soup_kitchen</span>
                </div>
                <span class="font-headline-md text-headline-md group-hover:text-primary transition-colors">Model</span>
            </a>
            <a class="group flex flex-col items-center gap-4 p-8 glass-effect rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-container/20" href="{{ route('wisatawan.kategori', ['slug' => 'laksan']) }}">
                <div class="w-16 h-16 rounded-full maroon-gradient flex items-center justify-center text-white shadow-lg">
                    <span class="material-symbols-outlined text-[32px] text-primary">dinner_dining</span>
                </div>
                <span class="font-headline-md text-headline-md group-hover:text-primary transition-colors">Laksan</span>
            </a>
            <a class="group flex flex-col items-center gap-4 p-8 glass-effect rounded-lg transition-all hover:-translate-y-2 hover:bg-primary-container/20" href="{{ route('wisatawan.kategori', ['slug' => 'mie-celor']) }}">
                <div class="w-16 h-16 rounded-full maroon-gradient flex items-center justify-center text-white shadow-lg">
                    <span class="material-symbols-outlined text-[32px] text-primary">restaurant</span>
                </div>
                <span class="font-headline-md text-headline-md group-hover:text-primary transition-colors">Mie Celor</span>
            </a>
        </div>
    </section>

    <!-- Rekomendasi Section -->
    <section class="py-20 bg-surface-container-low overflow-hidden">
        <div class="max-w-container-max mx-auto px-margin-desktop mb-12 flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Rekomendasi <span class="text-primary">Untuk Anda</span></h2>
                <p class="text-on-surface-variant mt-2 font-body-md">Pilihan terbaik dikurasi khusus untuk lidah Anda.</p>
            </div>
            <a href="{{ route('wisatawan.katalog') }}" class="flex items-center gap-2 font-label-md text-label-md hover:underline text-primary transition-colors">
                Lihat Semua <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="flex gap-gutter overflow-x-auto pb-8 px-margin-desktop custom-scrollbar snap-x">
            @forelse($restaurants as $r)
            <div class="min-w-[380px] bg-surface-container-highest rounded-lg overflow-hidden group snap-start shadow-xl">
                <div class="relative h-64">
                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $r->photo_url }}">
                    <div class="absolute top-4 left-4 bg-primary px-4 py-1 rounded-full text-on-primary font-label-md text-label-md">Terpopuler</div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-headline-md text-headline-md">
                            <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="hover:text-primary transition-colors text-brand-beige">{{ $r->nama_restoran }}</a>
                        </h3>
                        <div class="flex items-center text-primary">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="ml-1 text-on-surface font-label-md text-brand-beige">{{ number_format($r->reviews_avg_rating ?? 5.0, 1) }}</span>
                        </div>
                    </div>
                    <p class="text-primary text-label-md mb-4 uppercase tracking-wider">{{ $r->kategori }}</p>
                    <div class="flex justify-between items-center pt-4 border-t border-white/5">
                        <div class="flex items-center gap-1 text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                            <span class="text-label-md text-brand-beige/80">{{ Str::limit($r->alamat, 25) }}</span>
                        </div>
                        <p class="font-headline-md text-primary">Rp 25rb - 150rb</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="w-full text-center py-10 text-on-surface-variant">Tidak ada rekomendasi kuliner saat ini.</div>
            @endforelse
        </div>
    </section>

    <!-- Section Pendaftaran Usaha -->
    <section class="py-24 px-margin-desktop max-w-container-max mx-auto">
        <div class="relative maroon-gradient rounded-lg p-12 md:p-20 overflow-hidden flex flex-col md:flex-row items-center justify-between gap-12 shadow-2xl">
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                <span class="material-symbols-outlined text-[300px] -mr-32 -mt-16 rotate-12 text-primary">restaurant_menu</span>
            </div>
            <div class="relative z-10 max-w-2xl">
                <h2 class="font-display-lg text-display-lg text-white mb-6">Ingin usaha kuliner Anda dikenal lebih luas?</h2>
                <p class="text-white/80 font-body-lg text-body-lg">Bergabunglah dengan ribuan mitra SMWKP kami dan tingkatkan visibilitas bisnis kuliner Anda ke jutaan wisatawan di Palembang.</p>
            </div>
            <div class="relative z-10">
                <a href="{{ route('restoran.register') }}" class="bg-primary text-primary-container px-12 py-5 rounded-full font-headline-md text-headline-md shadow-xl transition-all hover:scale-105 active:scale-95 inline-block">
                    Daftarkan Sekarang
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
    // Parallax effect for hero
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroImg = document.querySelector('section img');
        if(heroImg) {
            heroImg.style.transform = `translateY(${scrolled * 0.4}px)`;
        }
    });

    // Horizontal scroll with wheel support
    const scrollContainer = document.querySelector('.custom-scrollbar');
    if (scrollContainer) {
        scrollContainer.addEventListener('wheel', (evt) => {
            evt.preventDefault();
            scrollContainer.scrollLeft += evt.deltaY;
        }, { passive: false });
    }
</script>
@endsection