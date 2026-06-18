@extends('layouts.app')

@section('title', 'Tulis Ulasan - SMWKP')

@section('styles')
<style>
    .star-rating .star.active {
        color: #EAB308; /* Elegant gold/yellow */
        font-variation-settings: 'FILL' 1;
    }
    .glass-panel {
        background: rgba(18, 20, 20, 0.85);
        backdrop-filter: blur(24px);
        border: 1px solid rgba(209, 199, 183, 0.1);
    }
    .bg-noir-overlay {
        background: linear-gradient(rgba(18, 20, 20, 0.7), rgba(18, 20, 20, 0.9));
    }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<!-- Main Content -->
<main class="min-h-screen relative flex items-center justify-center pt-28 pb-16">
    <!-- Background Atmospheric Image -->
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover opacity-60 blur-[32px]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAe6S3-GagDADGqidNcSnc5l0dDdKriQ4oZxaOZ_-b3kL9oDkOgv1cJSFR6j24THYLhMOpTB6UHth81mGsbJ7L-JD-S6hKt4KE-VFZLfxEucqHSJ6c3tqmsJ3dy-Wz9Z0EwqNcMZT-Hbq0li823x6WNe_Rbb2LoHuDBkIKBrBD8v6jTeCMz6BfuhCz1qoyTKG25R9wHONuERTsw95iJbtux6amCPc5U6O2xue2RWXqmQsLBW8Wd_bhMDWHjy6c3PuQZn_E4eZW5nsf5">
        <div class="absolute inset-0 bg-noir-overlay"></div>
    </div>
    
    <!-- Form Card Container -->
    <div class="relative z-10 w-full max-w-2xl px-margin-mobile md:px-0">
        <div class="glass-panel rounded-xl p-8 md:p-12 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.5)] animate-in fade-in slide-in-from-bottom-8 duration-700">
            <header class="mb-10 text-center">
                <h1 class="font-headline-lg text-headline-lg text-brand-beige mb-3">Bagikan Pengalaman Kuliner Anda</h1>
                <p class="font-body-md text-brand-beige/80">Ceritakan cita rasa autentik Palembang yang baru saja Anda nikmati di SMWKP.</p>
            </header>
            
            <form action="{{ route('ulasan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="reviewForm">
                @csrf
                <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}">
                <input type="hidden" name="restaurant_id" value="{{ request('restaurant_id') }}">
                
                <!-- Rating Section -->
                <div class="space-y-4">
                    <label class="block text-center font-label-md text-label-md tracking-widest uppercase text-brand-beige">Berikan Rating</label>
                    <div class="flex justify-center gap-4 star-rating" id="starContainer">
                        <button class="star group transition-transform active:scale-90" data-rating="1" type="button">
                            <span class="material-symbols-outlined text-4xl text-brand-beige/30 hover:text-yellow-500 transition-colors" style="font-variation-settings: 'FILL' 0;">star</span>
                        </button>
                        <button class="star group transition-transform active:scale-90" data-rating="2" type="button">
                            <span class="material-symbols-outlined text-4xl text-brand-beige/30 hover:text-yellow-500 transition-colors" style="font-variation-settings: 'FILL' 0;">star</span>
                        </button>
                        <button class="star group transition-transform active:scale-90" data-rating="3" type="button">
                            <span class="material-symbols-outlined text-4xl text-brand-beige/30 hover:text-yellow-500 transition-colors" style="font-variation-settings: 'FILL' 0;">star</span>
                        </button>
                        <button class="star group transition-transform active:scale-90" data-rating="4" type="button">
                            <span class="material-symbols-outlined text-4xl text-brand-beige/30 hover:text-yellow-500 transition-colors" style="font-variation-settings: 'FILL' 0;">star</span>
                        </button>
                        <button class="star group transition-transform active:scale-90" data-rating="5" type="button">
                            <span class="material-symbols-outlined text-4xl text-brand-beige/30 hover:text-yellow-500 transition-colors" style="font-variation-settings: 'FILL' 0;">star</span>
                        </button>
                    </div>
                    <!-- Real-time Rating Indicator Text -->
                    <div class="text-center text-sm font-label-md font-bold" id="ratingIndicator" style="color: #ffd700;">
                        (Belum Memilih Rating)
                    </div>
                </div>
                
                <!-- Experience Detail -->
                <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-brand-beige font-semibold" for="detail">Detail Pengalaman</label>
                    <textarea name="detail_ulasan" required class="w-full bg-surface-container-lowest border border-brand-beige/20 rounded-lg p-4 text-brand-beige focus:ring-1 focus:ring-brand-maroon focus:border-brand-maroon transition-all outline-none resize-none placeholder:text-brand-beige/60" id="detail" placeholder="Ceritakan kelezatan bumbu, suasana tempat, dan keramahan pelayanannya..." rows="5">{{ old('detail_ulasan') }}</textarea>
                </div>
                
                <!-- Photo Upload -->
                <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-brand-beige font-semibold">Unggah Foto Kuliner</label>
                    <div class="relative group">
                        <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" type="file" name="foto_ulasan" id="foto_ulasan">
                        <div class="w-full h-44 border border-dashed border-brand-beige/30 rounded-lg flex flex-col items-center justify-center gap-3 bg-surface-container-low group-hover:bg-surface-container-high transition-all group-hover:border-brand-maroon/50">
                            <span class="material-symbols-outlined text-4xl group-hover:text-brand-maroon transition-colors text-brand-beige/80">add_a_photo</span>
                            <p class="text-label-md px-6 text-center text-brand-beige" id="upload-status-text">Tarik &amp; Lepas atau Klik untuk Memilih Foto</p>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col md:flex-row gap-4 pt-4">
                    <button class="flex-1 bg-brand-maroon text-white font-label-md text-label-md py-4 rounded-lg shadow-xl hover:bg-brand-maroon-light active:scale-[0.98] transition-all flex items-center justify-center gap-2 font-bold" type="submit">
                        <span>Kirim Ulasan</span>
                        <span class="material-symbols-outlined text-sm">send</span>
                    </button>
                    <a href="{{ route('wisatawan.dashboard') }}" class="flex-1 border border-brand-beige/30 text-brand-beige font-label-md text-label-md py-4 rounded-lg hover:bg-white/5 transition-all active:scale-[0.98] text-center inline-block">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            background: '#1a1c1c',
            color: '#e2e2e2',
            confirmButtonColor: '#5a0f16'
        });
    });
</script>
@endif

<!-- Unified Footer -->
@include('partials.footer')
@endsection

@section('scripts')
<script>
    // Interactive Star Rating Logic
    const starContainer = document.getElementById('starContainer');
    const stars = starContainer.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    let currentRating = {{ old('rating', 0) }};
    highlightStars(currentRating);

    stars.forEach(star => {
        star.addEventListener('mouseenter', () => {
            const rating = parseInt(star.dataset.rating);
            highlightStars(rating);
        });

        star.addEventListener('mouseleave', () => {
            highlightStars(currentRating);
        });

        star.addEventListener('click', () => {
            currentRating = parseInt(star.dataset.rating);
            ratingInput.value = currentRating;
            highlightStars(currentRating);
            star.classList.add('scale-110');
            setTimeout(() => star.classList.remove('scale-110'), 200);
        });
    });

    function highlightStars(rating) {
        stars.forEach(s => {
            const sRating = parseInt(s.dataset.rating);
            const icon = s.querySelector('.material-symbols-outlined');
            if (sRating <= rating) {
                s.classList.add('active');
                icon.style.color = '#FFD700'; // Set gold color
                icon.style.fontVariationSettings = "'FILL' 1";
            } else {
                s.classList.remove('active');
                icon.style.color = ''; // Reset to base color
                icon.style.fontVariationSettings = "'FILL' 0";
            }
        });

        const indicator = document.getElementById('ratingIndicator');
        if (indicator) {
            if (rating > 0) {
                let starsStr = '';
                for(let i=1; i<=5; i++) {
                    starsStr += i <= rating ? '⭐' : '☆';
                }
                indicator.textContent = `${starsStr} (${rating}/5)`;
            } else {
                indicator.textContent = '(Belum Memilih Rating)';
            }
        }
    }

    // Photo input name feedback
    const fileInput = document.getElementById('foto_ulasan');
    const statusText = document.getElementById('upload-status-text');
    if (fileInput && statusText) {
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                statusText.textContent = `Foto terpilih: ${fileInput.files[0].name}`;
            } else {
                statusText.textContent = `Tarik & Lepas atau Klik untuk Memilih Foto`;
            }
        });
    }

    // Form Submit Interaction
    document.getElementById('reviewForm').addEventListener('submit', (e) => {
        const ratingVal = ratingInput.value;
        if (!ratingVal || ratingVal === "0") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Peringatan',
                text: 'Silakan berikan rating terlebih dahulu.',
                background: '#1a1c1c',
                color: '#e2e2e2',
                confirmButtonColor: '#5a0f16'
            });
            return;
        }

        const btn = e.target.querySelector('button[type="submit"]');
        btn.innerHTML = `<span class="material-symbols-outlined animate-spin text-sm">progress_activity</span> Mengirim...`;
        btn.disabled = true;
    });
</script>
@endsection