@extends('layouts.app')

@section('title', 'Ulasan Saya - SMWKP')

@section('styles')
<style>
    .glass-card {
        background: rgba(30, 32, 32, 0.6);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(163, 139, 138, 0.1);
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
    <!-- Back Navigation & Title -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div>
            <a href="{{ route('wisatawan.homepage') }}" class="flex items-center gap-2 font-label-md text-label-md mb-4 hover:opacity-80 transition-opacity group text-on-surface-variant">
                <span class="material-symbols-outlined text-[20px] transition-transform group-hover:-translate-x-1">arrow_back</span>
                Kembali ke Beranda
            </a>
            <h1 class="font-display-lg text-display-lg text-on-background">Ulasan Saya</h1>
            <p class="text-on-surface-variant font-body-lg text-body-lg max-w-2xl mt-2">Kumpulan memori kuliner Anda di Bumi Sriwijaya. Bagikan rasa, bangun komunitas.</p>
        </div>
        <div class="flex gap-4">
            <div class="glass-card px-6 py-4 rounded-xl flex items-center gap-4">
                <div class="text-right">
                    <span class="block font-headline-md text-headline-md text-on-surface-variant font-bold">{{ $reviews->count() }}</span>
                    <span class="block font-label-md text-label-md text-on-surface-variant">Ulasan Total</span>
                </div>
                <div class="w-[1px] h-10 bg-outline-variant/30"></div>
                <div class="text-right">
                    <span class="block font-headline-md text-headline-md text-on-surface-variant font-bold" style="color: rgb(212, 175, 55);">{{ number_format($reviews->avg('rating') ?: 5.0, 1) }}</span>
                    <span class="block font-label-md text-label-md text-on-surface-variant">Rata-rata Skor</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
        @forelse($reviews as $rev)
        <div class="glass-card p-6 rounded-lg flex flex-col md:flex-row gap-6 hover:translate-y-[-4px] transition-all duration-300 group shadow-lg">
            <div class="w-full md:w-40 h-40 shrink-0 rounded-DEFAULT overflow-hidden border border-outline-variant/10">
                <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ $rev->restaurant->photo_url }}">
            </div>
            <div class="flex-1 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-headline-md text-on-background mb-1 text-body-lg font-bold">{{ $rev->restaurant->nama_restoran }}</h3>
                            <p class="font-label-md text-label-md mb-2 text-on-surface-variant">Kategori: {{ $rev->restaurant->kategori }}</p>
                        </div>
                        <span class="text-on-surface-variant font-label-md text-label-md shrink-0">{{ $rev->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                        <span class="material-symbols-outlined text-[18px]" style="color: rgb(212, 175, 55); font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }};">star</span>
                        @endfor
                    </div>
                    <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">
                        {{ $rev->comment }}
                    </p>
                    @if($rev->photo)
                    <div class="w-32 h-24 rounded-lg overflow-hidden border border-outline-variant/10 bg-surface-container-highest cursor-pointer hover:opacity-85 transition-opacity mt-3" onclick="openReviewPhoto('{{ $rev->photo_url }}')">
                        <img class="w-full h-full object-cover" src="{{ $rev->photo_url }}" alt="Foto Ulasan">
                    </div>
                    @endif
                    @if($rev->reply_comment)
                    <div class="bg-surface-container-high/40 border-l-2 border-brand-maroon p-3 rounded-r-lg mt-3">
                        <p class="text-[10px] font-bold text-brand-beige mb-0.5">Balasan Mitra:</p>
                        <p class="text-xs text-on-surface-variant italic">"{{ $rev->reply_comment }}"</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-20 text-on-surface-variant">Anda belum menulis ulasan apa pun.</div>
        @endforelse
    </div>
</main>

<button class="fixed bottom-8 right-8 w-14 h-14 maroon-gradient text-white rounded-full flex items-center justify-center shadow-xl translate-y-24 opacity-0 transition-all duration-300 hover:scale-110" id="back-to-top">
    <span class="material-symbols-outlined">arrow_upward</span>
</button>

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
        </div>
    </div>
</div>

<!-- Include Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
    const backToTop = document.getElementById('back-to-top');
    
    window.onscroll = function() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            backToTop.classList.remove('translate-y-24', 'opacity-0');
            backToTop.classList.add('translate-y-0', 'opacity-100');
        } else {
            backToTop.classList.add('translate-y-24', 'opacity-0');
            backToTop.classList.remove('translate-y-0', 'opacity-100');
        }
    };

    backToTop.onclick = function() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    };

    function openReviewPhoto(url) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-image');
        img.src = url;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Escape key to close lightbox
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endsection