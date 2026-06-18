@extends('layouts.app')

@section('title', $resto->nama_restoran . ' | SMWKP')

@section('styles')
<style>
    .glass-panel {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .hero-gradient {
        background: linear-gradient(to bottom, transparent, #121414);
    }
    .maroon-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
    }
    .map-dark-mode {
        filter: grayscale(100%) invert(90%) contrast(120%) brightness(80%);
    }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

@php
    $resolvedPhotos = $resto->resolved_photos;
    $allPhotos = $resolvedPhotos;
    
    $foodFallbacks = [
        'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800',
        'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=800',
        'https://images.unsplash.com/photo-1612927601601-6638404737ce?w=800',
        'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=800',
        'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800',
        'https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?w=800',
        'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=800'
    ];
    
    $fallbackIndex = 0;
    foreach($menus as $menu) {
        if ($menu->photo) {
            $allPhotos[] = asset('storage/' . $menu->photo);
        } else {
            $allPhotos[] = $foodFallbacks[$fallbackIndex % count($foodFallbacks)];
            $fallbackIndex++;
        }
    }
    $allPhotos = array_values(array_unique($allPhotos));
    
    while (count($allPhotos) < 4) {
        $allPhotos[] = $foodFallbacks[$fallbackIndex % count($foodFallbacks)];
        $fallbackIndex++;
    }

    if ($resto->latitude && $resto->longitude) {
        $navUrl = "https://www.google.com/maps/search/?api=1&query=" . $resto->latitude . "," . $resto->longitude;
    } elseif ($resto->maps_url) {
        $navUrl = $resto->maps_url;
    } else {
        $navUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode($resto->nama_restoran . ", " . $resto->alamat);
    }
@endphp

<main class="pt-28 pb-20 max-w-container-max mx-auto px-margin-desktop animate-in fade-in duration-500">
    <!-- Back Button -->
    <button class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-all mb-8 group" onclick="window.history.back()">
        <span class="material-symbols-outlined group-hover:-translate-x-1 transition-transform">arrow_back</span>
        <span class="font-label-md text-label-md">Kembali</span>
    </button>
    
    <!-- Image Gallery Bento Grid -->
    <section class="grid grid-cols-12 gap-4 h-[500px] mb-12">
        <div class="col-span-8 relative overflow-hidden rounded-lg group cursor-pointer" onclick="openLightbox(0)">
            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $allPhotos[0] }}"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
        <div class="col-span-4 flex flex-col gap-4">
            <div class="h-1/2 overflow-hidden rounded-lg relative group cursor-pointer" onclick="openLightbox(1)">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $allPhotos[1] }}"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <div class="h-1/2 flex gap-4">
                <div class="w-1/2 overflow-hidden rounded-lg relative group cursor-pointer" onclick="openLightbox(2)">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $allPhotos[2] }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <div class="w-1/2 overflow-hidden rounded-lg relative group cursor-pointer bg-surface-container-highest" onclick="openLightbox(3)">
                    <img class="w-full h-full object-cover brightness-50" src="{{ $allPhotos[3] }}"/>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white bg-black/45 group-hover:bg-black/30 transition-colors">
                        <span class="material-symbols-outlined text-4xl mb-1">gallery_thumbnail</span>
                        <span class="font-label-md text-label-md text-center">
                            @if(count($allPhotos) > 4)
                                Lihat +{{ count($allPhotos) - 3 }} Foto
                            @else
                                Foto Galeri
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
        <!-- Left Column: Main Info -->
        <div class="col-span-1 lg:col-span-8 space-y-10">
            <!-- Header Info -->
            <div class="space-y-4">
                <div class="flex flex-wrap gap-3">
                    @if($resto->halal_certificate_number)
                    <span class="px-3 py-1 bg-green-900/30 text-green-400 border border-green-800 rounded-full font-label-md text-label-md flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">check_circle</span> Halal
                    </span>
                    @endif
                    <span class="px-3 py-1 bg-blue-900/30 text-blue-400 border border-blue-800 rounded-full font-label-md text-label-md flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">verified</span> Terverifikasi
                    </span>
                </div>
                <h1 class="font-display-lg text-display-lg text-primary leading-tight">{{ $resto->nama_restoran }}</h1>
                <div class="flex items-center gap-6 text-on-surface-variant">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-[#FFD700]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="font-label-md text-label-md font-bold text-[#FFD700]">{{ number_format($avgRating, 1) }}</span>
                        <span class="text-on-surface-variant/70 text-label-md">({{ $reviewsCount }} Ulasan)</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined">distance</span>
                        <span class="font-label-md text-label-md">1.2 km dari pusat kota</span>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="space-y-4">
                <h2 class="font-headline-md text-headline-md border-l-4 border-brand-maroon pl-4 text-primary">Tentang Restoran</h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    {{ $resto->description ?? 'Belum ada penjelasan deskripsi untuk usaha kuliner ini. Silakan kunjungi gerai kami secara langsung.' }}
                </p>
            </div>

            <!-- Menu Section -->
            <div class="space-y-6 pt-6">
                <h2 class="font-headline-md text-headline-md border-l-4 border-brand-maroon pl-4 text-primary">Daftar Menu</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($menus as $menu)
                    <div class="flex gap-4 bg-surface-container-low border border-outline-variant/10 rounded-lg p-4 hover:border-brand-maroon/20 transition-all">
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-surface-container-highest flex-shrink-0">
                            <img alt="{{ $menu->name }}" class="w-full h-full object-cover" src="{{ $menu->photo ? asset('storage/' . $menu->photo) : 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500' }}">
                        </div>
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="font-label-md text-sm text-brand-beige font-bold">{{ $menu->name }}</h4>
                                <p class="text-[11px] text-on-surface-variant line-clamp-1 mt-0.5">{{ $menu->description ?? 'Makanan lezat Palembang.' }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-primary font-bold text-sm">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-secondary font-medium uppercase bg-surface-container-high px-2 py-0.5 rounded">{{ $menu->category }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-on-surface-variant col-span-2 italic">Belum ada menu yang diunggah oleh Mitra.</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Reviews Section -->
            <div class="space-y-6 pt-6">
                <div class="flex justify-between items-center">
                    <h2 class="font-headline-md text-headline-md border-l-4 border-brand-maroon pl-4 text-primary">Ulasan Terbaru</h2>
                    <a href="{{ route('wisatawan.tulis-ulasan', ['restaurant_id' => $resto->id]) }}" class="px-4 py-2 bg-brand-maroon text-brand-beige font-bold rounded-lg text-xs hover:brightness-110 active:scale-95 transition-all">
                        Tulis Ulasan
                    </a>
                </div>
                <!-- Individual Reviews -->
                <div class="space-y-6">
                    @forelse($reviews as $rev)
                    <div class="pb-6 border-b border-outline-variant space-y-4">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                    {{ strtoupper(substr($rev->user->name ?? 'W', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-label-md text-label-md font-bold text-primary">{{ $rev->user->name ?? 'Wisatawan' }}</div>
                                    <div class="text-xs text-on-surface-variant">{{ $rev->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="flex text-[#FFD700]">
                                @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }};">star</span>
                                @endfor
                            </div>
                        </div>
                        <p class="text-on-surface-variant text-sm">{{ $rev->comment }}</p>
                        @if($rev->photo)
                        <div class="w-32 h-24 rounded-lg overflow-hidden border border-outline-variant/10 bg-surface-container-highest cursor-pointer hover:opacity-85 transition-opacity mt-2" onclick="openReviewPhoto('{{ $rev->photo_url }}')">
                            <img class="w-full h-full object-cover" src="{{ $rev->photo_url }}" alt="Foto Ulasan">
                        </div>
                        @endif
                        @if($rev->reply_comment)
                        <div class="bg-surface-container-high/40 border-l-2 border-brand-maroon p-4 rounded-r-lg mt-3 ml-4">
                            <p class="text-[11px] font-bold text-brand-beige mb-1">Balasan Mitra:</p>
                            <p class="text-xs text-on-surface-variant">{{ $rev->reply_comment }}</p>
                        </div>
                        @endif
                    </div>
                    @empty
                    <p class="text-xs text-on-surface-variant italic">Belum ada ulasan untuk restoran ini. Jadilah yang pertama memberikan ulasan!</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Right Column: Sidebar Info & CTA -->
        <aside class="col-span-1 lg:col-span-4 sticky top-24 space-y-6">
            <div class="glass-panel p-6 rounded-lg space-y-6 shadow-2xl">
                <!-- Essential Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-maroon/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <div>
                            <div class="text-xs text-on-surface-variant uppercase tracking-wider">Harga Rata-rata</div>
                            <div class="font-label-md text-label-md font-bold text-primary">
                                @if($menus->count() > 0)
                                    Rp {{ number_format($menus->min('price'), 0, ',', '.') }} - {{ number_format($menus->max('price'), 0, ',', '.') }}
                                @else
                                    Rp 25.000 - Rp 150.000
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-maroon/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">schedule</span>
                        </div>
                        <div>
                            <div class="text-xs text-on-surface-variant uppercase tracking-wider">Jam Operasional</div>
                            <div class="font-label-md text-label-md font-bold text-primary">
                                @php
                                    $hours = json_decode($resto->operational_hours, true);
                                @endphp
                                @if(is_array($hours))
                                    @foreach($hours as $day => $time)
                                        <div class="text-xs">{{ $day }}: {{ $time }}</div>
                                    @endforeach
                                @else
                                    10:00 - 22:00
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-brand-maroon/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div>
                            <div class="text-xs text-on-surface-variant uppercase tracking-wider">Nomor Telepon</div>
                            <div class="font-label-md text-label-md font-bold text-primary">{{ $resto->whatsapp }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-3 pt-4">
                    <a href="{{ route('wisatawan.formulir-reservasi', ['restaurant_id' => $resto->id]) }}" class="w-full maroon-gradient text-primary py-4 rounded-lg font-headline-md text-headline-md flex items-center justify-center gap-2 hover:brightness-110 active:scale-[0.98] transition-all shadow-lg text-center inline-block">
                        <span class="material-symbols-outlined">event_seat</span> Pesan Meja
                    </a>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $resto->whatsapp) }}?text=Halo%20{{ urlencode($resto->nama_restoran) }}%2C%20saya%20ingin%20tanya%20mengenai%20reservasi." target="_blank" class="flex items-center justify-center gap-2 py-3 bg-[#25D366]/10 text-[#25D366] border border-[#25D366]/30 rounded-lg font-label-md text-label-md hover:bg-[#25D366]/20 transition-all text-center">
                            WhatsApp
                        </a>
                        <a href="{{ $navUrl }}" target="_blank" class="flex items-center justify-center gap-2 py-3 bg-surface-container-highest border border-outline-variant rounded-lg font-label-md text-label-md text-primary hover:bg-surface-bright transition-all text-center">
                            <span class="material-symbols-outlined text-[18px]">near_me</span> Navigasi
                        </a>
                    </div>
                </div>
                
                <!-- Map/Location -->
                <div class="pt-4 space-y-4">
                    <div class="h-32 bg-surface-container-highest rounded-lg overflow-hidden relative">
                        <div class="absolute inset-0 bg-black/40 z-10"></div>
                        @if($resto->latitude && $resto->longitude)
                            <iframe class="w-full h-full border-none map-dark-mode absolute inset-0 z-0" src="https://maps.google.com/maps?q={{ $resto->latitude }},{{ $resto->longitude }}&z=15&output=embed"></iframe>
                        @else
                            <iframe class="w-full h-full border-none map-dark-mode absolute inset-0 z-0" src="https://maps.google.com/maps?q={{ urlencode($resto->nama_restoran . ', ' . $resto->alamat) }}&z=15&output=embed"></iframe>
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center z-20 pointer-events-none">
                            <div class="p-2 bg-brand-maroon text-primary rounded-full shadow-2xl ring-4 ring-brand-maroon/30 scale-110">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-on-surface-variant text-center px-2">{{ $resto->alamat }}</p>
                </div>
            </div>
        </aside>
    </div>
</main>

<!-- Lightbox Modal Gallery Overlay -->
<div id="lightbox-modal" class="fixed inset-0 z-[110] flex items-center justify-center p-4 transition-all duration-300 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/90 backdrop-blur-md" onclick="closeLightbox()"></div>
    
    <!-- Modal Content -->
    <div class="relative w-full max-w-4xl max-h-[85vh] flex flex-col items-center justify-center z-10">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-brand-beige hover:text-white transition-colors p-2 cursor-pointer bg-white/10 rounded-full flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">close</span>
        </button>
        
        <!-- Main Image Container -->
        <div class="relative w-full h-full flex items-center justify-center overflow-hidden rounded-lg">
            <img id="lightbox-image" class="max-w-full max-h-[70vh] object-contain select-none" src="" alt="Gallery Image">
            
            <!-- Navigation Buttons -->
            <button id="lightbox-prev" onclick="prevLightboxImage()" class="absolute left-4 p-3 rounded-full bg-black/40 hover:bg-black/60 text-brand-beige hover:text-white transition-colors cursor-pointer flex items-center justify-center">
                <span class="material-symbols-outlined text-[28px]">chevron_left</span>
            </button>
            <button id="lightbox-next" onclick="nextLightboxImage()" class="absolute right-4 p-3 rounded-full bg-black/40 hover:bg-black/60 text-brand-beige hover:text-white transition-colors cursor-pointer flex items-center justify-center">
                <span class="material-symbols-outlined text-[28px]">chevron_right</span>
            </button>
        </div>
        
        <!-- Counter & Info -->
        <div class="mt-4 text-center">
            <span id="lightbox-counter" class="text-sm font-label-md text-brand-beige/80"></span>
        </div>
    </div>
</div>

<!-- Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
    let currentPhotoIndex = 0;
    const galleryPhotos = @json($allPhotos);
    
    function openReviewPhoto(url) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-image');
        const counter = document.getElementById('lightbox-counter');
        const prevBtn = document.getElementById('lightbox-prev');
        const nextBtn = document.getElementById('lightbox-next');
        
        img.src = url;
        counter.textContent = 'Foto Ulasan';
        prevBtn.classList.add('hidden');
        nextBtn.classList.add('hidden');
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function openLightbox(index) {
        if (index >= galleryPhotos.length) index = 0;
        currentPhotoIndex = index;
        updateLightbox();
        const modal = document.getElementById('lightbox-modal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Disable page scrolling
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Re-enable page scrolling
    }

    function updateLightbox() {
        const img = document.getElementById('lightbox-image');
        const counter = document.getElementById('lightbox-counter');
        const prevBtn = document.getElementById('lightbox-prev');
        const nextBtn = document.getElementById('lightbox-next');
        
        img.src = galleryPhotos[currentPhotoIndex];
        counter.textContent = `Foto ${currentPhotoIndex + 1} dari ${galleryPhotos.length}`;
        
        if (galleryPhotos.length <= 1) {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
        }
    }

    function nextLightboxImage() {
        currentPhotoIndex = (currentPhotoIndex + 1) % galleryPhotos.length;
        updateLightbox();
    }

    function prevLightboxImage() {
        currentPhotoIndex = (currentPhotoIndex - 1 + galleryPhotos.length) % galleryPhotos.length;
        updateLightbox();
    }

    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('lightbox-modal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'ArrowRight') nextLightboxImage();
            if (e.key === 'ArrowLeft') prevLightboxImage();
            if (e.key === 'Escape') closeLightbox();
        }
    });

    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.style.filter = 'brightness(1.1) saturate(1.1)';
        });
        img.addEventListener('mouseleave', () => {
            img.style.filter = '';
        });
    });
</script>
@endsection