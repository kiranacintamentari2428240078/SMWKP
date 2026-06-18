@extends('layouts.app')

@section('title', 'Katalog SMWKP | Warisan Kuliner Palembang')

@section('styles')
<style>
    .glass-panel {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
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
    <!-- Header Section -->
    <header class="mb-12">
        <h1 class="font-display-lg text-[40px] md:text-display-lg mb-4 text-white leading-tight">Katalog SMWKP</h1>
        <p class="font-body-lg text-on-surface-variant max-w-2xl">Jelajahi kekayaan cita rasa warisan Nusantara di Bumi Sriwijaya. Dari Pempek yang ikonik hingga Pindang yang menggugah selera, temukan pengalaman gastronomi terbaik Anda.</p>
    </header>
    
    <!-- Search & Filter Controls -->
    <section class="mb-12 grid grid-cols-1 lg:grid-cols-4 gap-gutter items-start">
        <!-- Sidebar Filters -->
        <aside class="lg:col-span-1 glass-panel p-8 rounded-lg sticky top-28">
            <form method="GET" action="{{ route('wisatawan.katalog') }}" class="space-y-8" id="filterForm">
                <!-- Preserve existing sort filter -->
                @if(request()->has('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full bg-surface-container-low border-none rounded-full pl-12 pr-6 py-3 text-body-md focus:ring-2 focus:ring-primary text-white focus:outline-none" placeholder="Cari restoran..." type="text">
                </div>
                
                <div>
                    <h3 class="font-headline-md text-headline-md mb-6 text-white">Kategori</h3>
                    <div class="space-y-3">
                        @php
                            $categoriesList = ['Pempek', 'Laksan', 'Tekwan', 'Model', 'Mie Celor'];
                            $selectedCategories = request('categories', []);
                        @endphp
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" id="selectAllCategories" class="rounded border-outline-variant bg-surface text-primary focus:ring-primary" {{ empty($selectedCategories) ? 'checked' : '' }} onchange="toggleAllCategories(this)">
                            <span class="text-body-md {{ empty($selectedCategories) ? 'text-primary' : 'text-on-surface-variant' }} transition-colors" id="labelAll">Semua Kategori</span>
                        </label>
                        @foreach($categoriesList as $cat)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input name="categories[]" value="{{ $cat }}" type="checkbox" class="category-checkbox rounded border-outline-variant bg-surface text-primary focus:ring-primary" {{ in_array($cat, $selectedCategories) ? 'checked' : '' }} onchange="updateAllCheckboxes()">
                            <span class="text-body-md {{ in_array($cat, $selectedCategories) ? 'text-primary' : 'text-on-surface-variant' }} group-hover:text-primary transition-colors">{{ $cat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-headline-md text-headline-md mb-6 text-white">Rating</h3>
                    <div class="space-y-3">
                        @php $selectedRating = request('rating'); @endphp
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="rating" value="" class="text-primary bg-surface focus:ring-primary" {{ !$selectedRating ? 'checked' : '' }}>
                            <span class="text-label-md text-on-surface-variant">Semua Rating</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="rating" value="4" class="text-primary bg-surface focus:ring-primary" {{ $selectedRating == '4' ? 'checked' : '' }}>
                            <div class="flex items-center gap-2 text-[#FFD700]">
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-label-md text-on-surface-variant">4.0+ Keatas</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="rating" value="4.5" class="text-primary bg-surface focus:ring-primary" {{ $selectedRating == '4.5' ? 'checked' : '' }}>
                            <div class="flex items-center gap-2 text-[#FFD700]">
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-label-md text-on-surface-variant">4.5+ Keatas</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="font-headline-md text-headline-md mb-6 text-white text-[16px]">Rentang Harga (Maks)</h3>
                    <input name="price_max" value="{{ request('price_max', 500000) }}" min="10000" max="500000" step="10000" class="w-full accent-primary bg-surface-container-high h-1 rounded-full appearance-none mb-4" type="range" id="priceRange" oninput="document.getElementById('priceVal').textContent = 'Maks: Rp ' + formatNumber(this.value)">
                    <div class="flex justify-between text-label-md text-on-surface-variant">
                        <span>Rp 10k</span>
                        <span id="priceVal">Maks: Rp {{ number_format(request('price_max', 500000), 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 py-3 rounded-lg border border-primary text-primary font-label-md hover:bg-primary/10 transition-all font-bold">Filter</button>
                    <a href="{{ route('wisatawan.katalog') }}" class="py-3 px-4 rounded-lg border border-outline-variant text-on-surface-variant font-label-md text-center hover:bg-white/5 transition-all">Reset</a>
                </div>
            </form>
        </aside>
        
        <!-- Main Grid Area -->
        <div class="lg:col-span-3">
            <!-- Sorting & Chips -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div class="flex gap-2">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" class="px-4 py-1.5 rounded-full {{ request('sort', 'popular') === 'popular' ? 'bg-primary text-background font-bold' : 'bg-surface-container-high text-on-surface-variant border border-outline-variant' }} text-label-md transition-all">Populer</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'rating']) }}" class="px-4 py-1.5 rounded-full {{ request('sort') === 'rating' ? 'bg-primary text-background font-bold' : 'bg-surface-container-high text-on-surface-variant border border-outline-variant' }} text-label-md transition-all">Rating Tertinggi</a>
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" class="px-4 py-1.5 rounded-full {{ request('sort') === 'price_low' ? 'bg-primary text-background font-bold' : 'bg-surface-container-high text-on-surface-variant border border-outline-variant' }} text-label-md transition-all">Harga Terendah</a>
                </div>
                <p class="text-label-md text-on-surface-variant">Menampilkan <span class="text-white font-bold">{{ $restaurants->total() }}</span> Restoran</p>
            </div>
            
            <!-- Restaurant Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @forelse($restaurants as $r)
                <article class="group bg-surface-container-low rounded-lg overflow-hidden shadow-sm hover:translate-y-[-8px] transition-all duration-300 flex flex-col justify-between h-full">
                    <div>
                        <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="block relative h-56 overflow-hidden">
                            <img alt="{{ $r->nama_restoran }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $r->photo_url }}">
                        </a>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-headline-md text-headline-md text-white font-bold">
                                    <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="hover:text-primary transition-colors">{{ $r->nama_restoran }}</a>
                                </h3>
                                <div class="flex items-center gap-1 text-[#FFD700]">
                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="text-label-md font-bold text-primary">{{ number_format($r->reviews_avg_rating ?? 5.0, 1) }}</span>
                                </div>
                            </div>
                            <p class="text-body-md text-on-surface-variant mb-4 line-clamp-2">{{ $r->description ?? 'Tidak ada deskripsi.' }}</p>
                        </div>
                    </div>
                    <div class="p-6 pt-0 mt-auto">
                        <div class="flex flex-col gap-2 border-t border-outline-variant pt-4">
                            <div class="flex items-center gap-2 text-on-surface-variant text-label-md">
                                <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                                <span class="line-clamp-1">{{ Str::limit($r->alamat, 25) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-primary font-bold text-body-md">
                                    @if($r->menus->count() > 0)
                                        Rp {{ number_format($r->menus->min('price'), 0, ',', '.') }} - {{ number_format($r->menus->max('price'), 0, ',', '.') }}
                                    @else
                                        Rp 10k - 100k
                                    @endif
                                </span>
                                <a href="{{ route('wisatawan.detail-restoran', ['id' => $r->id]) }}" class="text-white hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-span-full text-center py-20 text-on-surface-variant font-medium">Tidak ada restoran yang memenuhi kriteria filter Anda.</div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $restaurants->links() }}
            </div>
        </div>
    </section>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
    function toggleAllCategories(source) {
        const checkboxes = document.querySelectorAll('.category-checkbox');
        const labelAll = document.getElementById('labelAll');
        if (source.checked) {
            checkboxes.forEach(cb => {
                cb.checked = false;
                cb.closest('label').querySelector('span').classList.remove('text-primary');
            });
            labelAll.classList.add('text-primary');
        } else {
            labelAll.classList.remove('text-primary');
        }
    }

    function updateAllCheckboxes() {
        const selectAll = document.getElementById('selectAllCategories');
        const checkboxes = document.querySelectorAll('.category-checkbox');
        const labelAll = document.getElementById('labelAll');
        
        let anyChecked = false;
        checkboxes.forEach(cb => {
            const span = cb.closest('label').querySelector('span');
            if (cb.checked) {
                span.classList.add('text-primary');
                anyChecked = true;
            } else {
                span.classList.remove('text-primary');
            }
        });

        if (anyChecked) {
            selectAll.checked = false;
            labelAll.classList.remove('text-primary');
        } else {
            selectAll.checked = true;
            labelAll.classList.add('text-primary');
        }
    }

    function formatNumber(num) {
        return parseInt(num).toLocaleString('id-ID');
    }

    // Search bar focus effect
    const searchInput = document.querySelector('input[name="search"]');
    if(searchInput) {
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('scale-[1.02]');
            searchInput.parentElement.classList.add('duration-300');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('scale-[1.02]');
        });
    }
</script>
@endsection