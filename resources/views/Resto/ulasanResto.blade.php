@extends('layouts.app')

@section('title', 'Ulasan Restoran | SMWKP Admin Portal')

@section('styles')
<style>
    .star-rating {
        color: #FFD700;
        font-variation-settings: 'FILL' 1;
    }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-72 pt-32 px-margin-desktop pb-20">
    <!-- Dashboard Stats Bento -->
    <section class="grid grid-cols-12 gap-gutter mb-12">
        <div class="col-span-12 md:col-span-4 glass-card p-8 rounded-lg relative overflow-hidden group">
            <p class="font-label-md text-label-md text-primary uppercase tracking-widest mb-2">Rating Rata-rata</p>
            <div class="flex items-end gap-3">
                <span class="font-display-lg text-display-lg text-on-surface">
                    {{ number_format($reviews->avg('rating') ?: 5.0, 1) }}
                </span>
                <div class="flex mb-3">
                    @php $avgRating = $reviews->avg('rating') ?: 5.0; @endphp
                    @for($i = 1; $i <= 5; $i++)
                    <span class="material-symbols-outlined star-rating" style="font-variation-settings: 'FILL' {{ $i <= $avgRating ? 1 : 0 }};">star</span>
                    @endfor
                </div>
            </div>
            <p class="text-on-surface-variant font-body-md mt-2">Berdasarkan {{ $reviews->count() }} ulasan tamu</p>
        </div>
        <div class="col-span-12 md:col-span-8 grid gap-gutter">
            <div class="glass-card p-6 rounded-lg flex flex-col justify-center items-center text-center border-primary/20 bg-primary/5">
                <span class="material-symbols-outlined text-primary text-4xl mb-2">mark_chat_unread</span>
                <p class="font-headline-md text-headline-md">{{ $reviews->whereNull('reply_comment')->count() }}</p>
                <p class="font-label-md text-label-md text-on-surface-variant">Butuh Balasan</p>
            </div>
        </div>
    </section>

    <!-- Review List -->
    <div class="space-y-6">
        @forelse($reviews as $rev)
        <div class="glass-card rounded-lg overflow-hidden group hover:shadow-[0_8px_30px_rgba(229,217,195,0.08)] transition-all duration-300">
            <div class="flex">
                <div class="w-1/4 relative overflow-hidden bg-surface-container-highest flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-surface-variant/20 text-8xl">restaurant</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-surface-container"></div>
                </div>
                <div class="flex-1 p-8">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                {{ strtoupper(substr($rev->user->name ?? 'W', 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-headline-md text-on-surface leading-none font-bold">{{ $rev->user->name ?? 'Wisatawan' }}</h4>
                                <p class="text-on-surface-variant text-label-md mt-1 italic">{{ $rev->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex text-[#FFD700]">
                            @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined star-rating" style="font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }};">star</span>
                            @endfor
                        </div>
                    </div>
                    <p class="font-body-lg text-on-surface mb-6 leading-relaxed">
                        "{{ $rev->comment }}"
                    </p>
                    @if($rev->photo)
                    <div class="w-32 h-24 rounded-lg overflow-hidden border border-outline-variant/10 bg-surface-container-highest cursor-pointer hover:opacity-85 transition-opacity mb-6" onclick="openReviewPhoto('{{ $rev->photo_url }}')">
                        <img class="w-full h-full object-cover" src="{{ $rev->photo_url }}" alt="Foto Ulasan">
                    </div>
                    @endif
                    
                    @if($rev->reply_comment)
                    <!-- Display Previous Reply -->
                    <div class="bg-surface-container-high/50 rounded-lg p-6 border-l-4 border-primary">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-primary text-sm">reply</span>
                            <span class="font-label-md text-label-md text-primary">Balasan Anda:</span>
                        </div>
                        <p class="font-body-md text-on-surface-variant">
                            "{{ $rev->reply_comment }}"
                        </p>
                    </div>
                    @else
                    <!-- Reply Form Input -->
                    <div class="bg-surface-container-lowest/50 rounded-lg p-6 border-l-4 border-primary">
                        <form method="POST" action="{{ route('resto.reviews.reply', ['id' => $rev->id]) }}">
                            @csrf
                            <label class="block font-label-md text-label-md text-primary mb-3">Balas sebagai Admin:</label>
                            <textarea name="reply_comment" required class="w-full bg-surface-container border-none rounded-md text-on-surface focus:ring-1 focus:ring-primary/50 font-body-md p-4 mb-4" placeholder="Tulis ucapan terima kasih atau tanggapan..." rows="2"></textarea>
                            <div class="flex justify-end">
                                <button type="submit" class="px-8 py-2 rounded-full font-label-md text-label-md bg-primary text-on-primary shadow-lg hover:brightness-110 transition-all" style="background-color: rgb(90, 15, 22); color: rgb(229, 217, 195);">Kirim Balasan</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="glass-card p-10 text-center text-on-surface-variant">Belum ada ulasan yang ditinggalkan wisatawan.</div>
        @endforelse
    </div>

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
</main>
@endsection

@section('scripts')
<script>
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
