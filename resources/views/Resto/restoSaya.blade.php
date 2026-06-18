@extends('layouts.app')

@section('title', 'Restoran Saya - SMWKP Admin')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-72 flex-1 overflow-y-auto bg-background relative min-h-screen">
    <!-- TopNavBar -->
    <header class="fixed top-0 right-0 left-72 z-30 flex justify-between items-center px-margin-desktop py-4 backdrop-blur-xl shadow-sm bg-surface-dim/80 font-headline-md border-b border-white/5">
        <div class="flex items-center gap-4">
            <h2 class="text-[#D9C5A0] font-semibold">Profil Restoran</h2>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3 pl-6">
                <div class="text-right">
                    <p class="font-label-md text-on-surface leading-none text-primary">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mt-1">Mitra Owner</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary-container/30 border border-primary/20 flex items-center justify-center text-primary font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <div class="pt-24 px-margin-desktop pb-12">
        <!-- Hero Section -->
        <section class="relative rounded-xl overflow-hidden mb-8 h-[400px] shadow-2xl border border-white/5">
            <img alt="{{ $restaurant->nama_restoran }}" class="absolute inset-0 w-full h-full object-cover" src="{{ $restaurant->photo_url }}">
            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-10 w-full flex items-end justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        @if($restaurant->status === 'approved')
                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-1 border border-green-800 bg-green-500/20 text-green-400"><span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">verified</span>Terverifikasi</span>
                        @elseif($restaurant->status === 'pending')
                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-1 border border-yellow-800 bg-yellow-500/20 text-yellow-400"><span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">hourglass_empty</span>Menunggu Verifikasi</span>
                        @else
                            <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest rounded-full flex items-center gap-1 border border-red-800 bg-red-500/20 text-red-400"><span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">cancel</span>Ditolak</span>
                        @endif
                        <div class="flex items-center gap-1 text-[#FFD700]">
                            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="font-bold ml-2">{{ round($restaurant->reviews()->avg('rating') ?: 5.0, 1) }} / 5.0</span>
                        </div>
                    </div>
                    <h2 class="font-display-lg text-display-lg text-white mb-2 font-bold">{{ $restaurant->nama_restoran }}</h2>
                    <p class="text-on-surface-variant flex items-center gap-2 text-sm text-[#DBC0BE]">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        {{ $restaurant->alamat }}
                    </p>
                </div>
                <div class="flex gap-4">
                    <button class="px-8 py-3 maroon-gradient text-white rounded-full flex items-center gap-2 shadow-lg shadow-primary-container/40 hover:scale-105 active:scale-95 transition-all border border-primary/30 font-bold" onclick="document.getElementById('edit-profile-modal').classList.remove('hidden')">
                        <span class="material-symbols-outlined">edit_square</span>Edit Profil
                    </button>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-12 gap-gutter">
            <!-- Left Column: Main Stats & Details -->
            <div class="col-span-12 lg:col-span-8 space-y-gutter">
                <!-- Stats Grid -->
                <div class="grid grid-cols-3 gap-6">
                    <div class="glass-card p-6 rounded-lg group hover:bg-primary-container transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary group-hover:bg-white/10 group-hover:text-primary">
                                <span class="material-symbols-outlined">event_available</span>
                            </div>
                            <span class="text-[10px] text-green-400 font-bold">Reservasi</span>
                        </div>
                        <p class="text-on-surface-variant font-label-md group-hover:text-primary/80">Total Bookingan</p>
                        <h4 class="text-2xl font-bold text-on-surface mt-1 group-hover:text-white">{{ $restaurant->bookings()->count() }}</h4>
                    </div>
                    <div class="glass-card p-6 rounded-lg group hover:bg-primary-container transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary group-hover:bg-white/10 group-hover:text-primary">
                                <span class="material-symbols-outlined">star</span>
                            </div>
                            <span class="text-[10px] text-primary font-bold group-hover:text-primary/80 uppercase">Rating</span>
                        </div>
                        <p class="text-on-surface-variant font-label-md group-hover:text-primary/80">Rating Rata-rata</p>
                        <h4 class="text-2xl font-bold text-on-surface mt-1 group-hover:text-white">{{ round($restaurant->reviews()->avg('rating') ?: 5.0, 1) }}</h4>
                    </div>
                    <div class="glass-card p-6 rounded-lg group hover:bg-primary-container transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary group-hover:bg-white/10 group-hover:text-primary">
                                <span class="material-symbols-outlined">chat_bubble</span>
                            </div>
                            <span class="text-[10px] text-on-surface-variant group-hover:text-primary/60">Total</span>
                        </div>
                        <p class="text-on-surface-variant font-label-md group-hover:text-primary/80">Ulasan Pengunjung</p>
                        <h4 class="text-2xl font-bold text-on-surface mt-1 group-hover:text-white">{{ $restaurant->reviews()->count() }}</h4>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="glass-card p-8 rounded-lg mb-gutter">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">restaurant_menu</span>
                        <h3 class="font-headline-md text-headline-md text-[#D9C5A0]">Kategori Kuliner</h3>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @php
                            $categories = array_filter(array_map('trim', explode(',', $restaurant->kategori ?: '')));
                        @endphp
                        @forelse($categories as $cat)
                            <span class="px-4 py-2 rounded-full bg-primary/10 border border-primary/30 text-[#D9C5A0] font-label-md font-semibold">{{ $cat }}</span>
                        @empty
                            <span class="text-on-surface-variant text-sm italic">Kategori belum ditentukan. Silakan edit profil untuk menambahkan.</span>
                        @endforelse
                        <button class="px-4 py-2 rounded-full border border-dashed border-[#D9C5A0]/40 text-[#D9C5A0]/60 hover:text-[#D9C5A0] hover:border-[#D9C5A0] transition-all flex items-center gap-2 font-label-md" onclick="document.getElementById('edit-profile-modal').classList.remove('hidden')">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            Atur Kategori
                        </button>
                    </div>
                </div>

                <!-- Warisan & Filosofi -->
                <div class="glass-card p-8 rounded-lg">
                    <div class="flex items-center gap-4 mb-6">
                        <span class="material-symbols-outlined text-primary text-3xl">history_edu</span>
                        <h3 class="font-headline-md text-headline-md text-[#D9C5A0]">Deskripsi Usaha &amp; Filosofi</h3>
                    </div>
                    <div class="space-y-4">
                        <p class="text-on-surface-variant leading-relaxed text-sm whitespace-pre-line text-[#DBC0BE]">
                            {{ $restaurant->description ?: 'Belum ada deskripsi profil usaha yang ditambahkan. Tuliskan sejarah singkat, ciri khas menu Anda, atau filosofi dibalik warisan kuliner Anda untuk memikat para wisatawan.' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Operational & Location -->
            <div class="col-span-12 lg:col-span-4 space-y-gutter">
                <!-- Operational Hours -->
                <div class="glass-card p-8 rounded-lg">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-headline-md text-headline-md flex items-center gap-3 text-[#D9C5A0]">
                            <span class="material-symbols-outlined text-primary">schedule</span>
                            Jam Operasional
                        </h3>
                        <span class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></span>
                    </div>
                    <ul class="space-y-4">
                        @php
                            $operationalHours = json_decode($restaurant->operational_hours, true) ?: [
                                'Senin-Jumat' => '08:00 - 21:00',
                                'Sabtu-Minggu' => '07:00 - 22:00'
                            ];
                        @endphp
                        @foreach($operationalHours as $dayRange => $timeStr)
                            <li class="flex justify-between items-center border-b border-white/5 pb-3">
                                <span class="text-on-surface-variant text-sm font-semibold text-[#DBC0BE]">{{ $dayRange }}</span>
                                <span class="font-bold text-on-surface text-sm">{{ $timeStr }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Map Location -->
                <div class="glass-card overflow-hidden rounded-lg">
                    <div class="p-6 border-b border-white/5 bg-surface-container-highest/20">
                        <h3 class="font-headline-md text-headline-md flex items-center gap-3 text-[#D9C5A0]">
                            <span class="material-symbols-outlined text-primary">distance</span>
                            Lokasi Restoran
                        </h3>
                    </div>
                    <div class="h-64 relative bg-surface-container-highest flex items-center justify-center overflow-hidden">
                        @if($restaurant->latitude && $restaurant->longitude)
                            <!-- Dynamic Leaflet Map or static visual representing the pin -->
                            <div class="absolute inset-0 bg-primary/10 mix-blend-multiply"></div>
                            <iframe class="w-full h-full grayscale opacity-80 border-0" 
                                    src="https://maps.google.com/maps?q={{ $restaurant->latitude }},{{ $restaurant->longitude }}&z=15&output=embed">
                            </iframe>
                        @else
                            <img alt="Map Placeholder" class="w-full h-full object-cover grayscale opacity-30" src="https://images.unsplash.com/photo-1524661135-423995f22d0b?w=400">
                            <div class="absolute inset-0 bg-primary/10 mix-blend-multiply"></div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                                <span class="material-symbols-outlined text-4xl text-primary mb-2">location_off</span>
                                <p class="text-xs text-on-surface-variant">Koordinat koordinat peta belum diatur.</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 bg-surface-container">
                        <p class="text-sm font-label-md text-on-surface mb-2 font-bold text-[#D9C5A0]">Detail Koordinat</p>
                        <p class="text-xs text-on-surface-variant leading-relaxed text-[#DBC0BE] mb-4">
                            Latitude: {{ $restaurant->latitude ?? '-' }} <br>
                            Longitude: {{ $restaurant->longitude ?? '-' }}
                        </p>
                        @php
                            if ($restaurant->latitude && $restaurant->longitude) {
                                $restoNavUrl = "https://www.google.com/maps/search/?api=1&query=" . $restaurant->latitude . "," . $restaurant->longitude;
                            } else {
                                $restoNavUrl = $restaurant->maps_url ?: "https://www.google.com/maps/search/?api=1&query=" . urlencode($restaurant->nama_restoran . ", " . $restaurant->alamat);
                            }
                        @endphp
                        <a href="{{ $restoNavUrl }}" target="_blank" class="block w-full text-center py-2.5 border border-primary/30 text-primary hover:bg-primary hover:text-on-primary transition-all rounded-full text-xs font-bold uppercase tracking-widest">
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Overlay -->
<div class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-black/60 backdrop-blur-md hidden" id="edit-profile-modal">
    <!-- Modal Card -->
    <form action="{{ route('resto.profile.update') }}" method="POST" class="bg-surface-container-high/90 w-full max-w-2xl max-h-[95vh] rounded-lg shadow-2xl flex flex-col overflow-hidden border border-white/5">
        @csrf
        <!-- Modal Header -->
        <div class="p-8 border-b border-white/5 flex justify-between items-center bg-surface-container-highest/40">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-[#D9C5A0] font-bold">Edit Profil Restoran</h2>
                <p class="text-on-surface-variant text-label-md text-[#DBC0BE]">Perbarui profil operasional dan kontak WhatsApp restoran Anda.</p>
            </div>
            <button type="button" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-highest transition-colors" onclick="document.getElementById('edit-profile-modal').classList.add('hidden')">
                <span class="material-symbols-outlined text-on-surface">close</span>
            </button>
        </div>
        <!-- Modal Body (Scrollable) -->
        <div class="p-8 overflow-y-auto space-y-6">
            <!-- Input: Nama Restoran -->
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Nama Restoran</label>
                <input name="nama_restoran" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $restaurant->nama_restoran }}" required>
            </div>
            <!-- Input: Nama Pemilik -->
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Nama Pemilik</label>
                <input name="nama_pemilik" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $restaurant->nama_pemilik }}" required>
            </div>
            <!-- Input: WhatsApp -->
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">No. WhatsApp Hubungi Wisatawan (Format: 628xxxx)</label>
                <input name="whatsapp" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $restaurant->whatsapp }}" required>
            </div>
            <!-- Input: Alamat Lengkap -->
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Alamat Lengkap</label>
                <textarea name="alamat" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" rows="2" required>{{ $restaurant->alamat }}</textarea>
            </div>
            <!-- Input: Jam Operasional -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Senin - Jumat</label>
                    <input name="operational_hours_weekday" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $operationalHours['Senin-Jumat'] ?? '08:00 - 21:00' }}" placeholder="Contoh: 08:00 - 21:00">
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Sabtu - Minggu</label>
                    <input name="operational_hours_weekend" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $operationalHours['Sabtu-Minggu'] ?? '07:00 - 22:00' }}" placeholder="Contoh: 07:00 - 22:00">
                </div>
            </div>
            <!-- Input: Maps URL & Koordinat -->
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Tautan Lokasi Google Maps</label>
                <input name="maps_url" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="url" value="{{ $restaurant->maps_url }}" placeholder="https://maps.google.com/...">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Latitude</label>
                    <input name="latitude" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $restaurant->latitude }}" placeholder="-2.9761">
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Longitude</label>
                    <input name="longitude" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $restaurant->longitude }}" placeholder="104.7754">
                </div>
            </div>
            <!-- Input: Deskripsi Restoran -->
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Deskripsi Restoran</label>
                <textarea name="description" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" rows="3">{{ $restaurant->description }}</textarea>
            </div>
            <!-- Section: Kategori Menu / Tags -->
            <div class="space-y-4">
                <label class="font-label-md text-label-md text-[#D9C5A0] block ml-1">Kategori Restoran (Pisahkan dengan koma)</label>
                <input name="kategori" id="kategori-input" class="w-full bg-surface-container-lowest border border-white/10 focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] rounded-lg px-4 py-3 text-on-surface transition-all" type="text" value="{{ $restaurant->kategori }}" placeholder="Pempek, Tekwan, Mie Celor">
                
                <div class="flex flex-wrap gap-2 pt-2">
                    @php
                        $availableTags = ['Pempek', 'Tekwan', 'Model', 'Laksan', 'Mie Celor', 'Nasi Minyak', 'Es Kacang Merah'];
                    @endphp
                    @foreach($availableTags as $tag)
                        <button type="button" class="tag-toggle-btn px-3 py-1.5 rounded-full text-xs font-semibold border border-white/10 bg-surface-container-low text-[#DBC0BE] hover:border-primary transition-all select-none" data-tag="{{ $tag }}">
                            + {{ $tag }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="p-8 border-t border-white/5 flex justify-end gap-4 bg-surface-container-highest/20">
            <button type="button" class="px-6 py-3 rounded-lg border border-white/10 text-on-surface hover:bg-surface-container-highest transition-colors font-label-md" onclick="document.getElementById('edit-profile-modal').classList.add('hidden')">
                Batal
            </button>
            <button type="submit" class="px-8 py-3 rounded-lg maroon-gradient text-white font-bold shadow-lg shadow-primary-container/40 hover:scale-[1.02] active:scale-95 transition-all border border-primary/30">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Category tagging helpers
    const categoryInput = document.getElementById('kategori-input');
    const tagButtons = document.querySelectorAll('.tag-toggle-btn');

    tagButtons.forEach(btn => {
        const tag = btn.getAttribute('data-tag');
        
        // Initial highlight if current values contain the tag
        const currentVals = categoryInput.value.split(',').map(s => s.trim().toLowerCase());
        if (currentVals.includes(tag.toLowerCase())) {
            btn.classList.add('border-[#D9C5A0]', 'bg-[#D9C5A0]/20', 'text-[#D9C5A0]');
        }

        btn.addEventListener('click', () => {
            let tags = categoryInput.value.split(',').map(s => s.trim()).filter(s => s !== '');
            const tagIdx = tags.findIndex(t => t.toLowerCase() === tag.toLowerCase());
            
            if (tagIdx > -1) {
                // remove tag
                tags.splice(tagIdx, 1);
                btn.classList.remove('border-[#D9C5A0]', 'bg-[#D9C5A0]/20', 'text-[#D9C5A0]');
            } else {
                // add tag
                tags.push(tag);
                btn.classList.add('border-[#D9C5A0]', 'bg-[#D9C5A0]/20', 'text-[#D9C5A0]');
            }
            categoryInput.value = tags.join(', ');
        });
    });

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
