@extends('layouts.app')

@section('title', 'Profil Usaha - SMWKP Admin')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Canvas -->
<main class="ml-72 min-h-screen">
    <!-- Top Bar -->
    <header class="fixed top-0 right-0 left-72 z-30 flex justify-between items-center px-margin-desktop py-6 bg-surface/80 backdrop-blur-xl border-b border-white/5 text-[#D9C5A0]">
        <div>
            <h2 class="text-[#D9C5A0] font-semibold text-lg">Profil Usaha &amp; Legalitas</h2>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="font-label-md text-label-md text-on-surface font-bold text-[#D9C5A0]">{{ Auth::user()->name }}</p>
                    <p class="text-[12px] text-on-surface-variant text-[#DBC0BE]">Mitra Owner</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary-container/30 border border-primary/20 flex items-center justify-center text-primary font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <div class="pt-32 pb-margin-desktop px-margin-desktop">
        <!-- Breadcrumbs & Header -->
        <div class="mb-10">
            <div class="flex justify-between items-end">
                <div>
                    <h2 class="font-headline-lg text-headline-lg text-white mb-2 text-[#D9C5A0] font-bold">Profil Usaha &amp; Legalitas</h2>
                    <p class="text-on-surface-variant max-w-2xl font-body-md text-[#DBC0BE]">Informasi resmi identitas bisnis Anda. Pastikan data legalitas tetap akurat untuk menjaga kepercayaan pelanggan dan otoritas kuliner Palembang.</p>
                </div>
                <button class="bg-[#5a0f16] text-[#f5f0e6] px-8 py-4 rounded-full font-label-md text-label-md flex items-center gap-3 transition-all hover:-translate-y-1 shadow-lg border border-primary/30 font-bold" onclick="document.getElementById('update-profile-modal').classList.remove('hidden')">
                    <span class="material-symbols-outlined">edit</span>
                    Perbarui Data Profil
                </button>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-12 gap-gutter">
            <!-- Hero Visual Card -->
            <div class="col-span-8 h-[400px] rounded-lg overflow-hidden relative group shadow-2xl border border-white/5">
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $restaurant->photo_url }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-10">
                    <h3 class="font-display-lg text-[48px] leading-tight text-white font-bold">{{ $restaurant->nama_restoran }}</h3>
                </div>
            </div>

            <!-- Status Card -->
            <div class="col-span-4 glass-panel rounded-lg p-10 flex flex-col justify-between">
                <div>
                    <h4 class="text-on-surface-variant font-label-md text-label-md uppercase tracking-widest mb-6 text-[#DBC0BE]">Status Akun</h4>
                    <div class="space-y-6">
                        @if($restaurant->status === 'approved')
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-green-500/20 border border-green-800 flex items-center justify-center text-green-400">
                                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified</span>
                                </div>
                                <div>
                                    <p class="text-white font-bold font-headline-md text-green-400">Terverifikasi Dinas</p>
                                    <p class="text-on-surface-variant text-sm text-[#DBC0BE]">Legal &amp; Aktif Publik</p>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-yellow-500/20 border border-yellow-800 flex items-center justify-center text-yellow-400">
                                    <span class="material-symbols-outlined">hourglass_empty</span>
                                </div>
                                <div>
                                    <p class="text-white font-bold font-headline-md text-yellow-400">Menunggu Verifikasi</p>
                                    <p class="text-on-surface-variant text-sm text-[#DBC0BE]">Tinjauan Dokumen</p>
                                </div>
                            </div>
                        @endif
                        <div class="p-4 bg-white/5 rounded-lg border border-white/10">
                            <p class="text-[13px] leading-relaxed text-on-surface-variant italic text-[#DBC0BE]">"Melestarikan cita rasa asli Palembang melalui standar layanan modern dan legalitas yang transparan."</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Legal Info -->
            <div class="col-span-12 grid grid-cols-3 gap-gutter">
                <!-- Owner Info -->
                <div class="glass-panel rounded-lg p-8 group hover:bg-surface-container-high transition-all">
                    <div class="flex items-center justify-between mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">person</span>
                        <span class="text-on-surface-variant font-label-md opacity-40">#PEMILIK</span>
                    </div>
                    <p class="text-on-surface-variant font-label-md text-label-md mb-1 text-[#DBC0BE]">Nama Pemilik Utama</p>
                    <h5 class="text-white font-headline-md text-headline-md font-bold mb-4">{{ $restaurant->nama_pemilik ?: '-' }}</h5>
                    <div class="h-[1px] w-full bg-white/5 mb-4"></div>
                    <div class="space-y-2 text-[#DBC0BE]">
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">Hubungi WA</span>
                            <span class="text-white font-mono">{{ $restaurant->whatsapp }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">Kategori</span>
                            <span class="text-white text-xs font-semibold">{{ $restaurant->kategori }}</span>
                        </div>
                    </div>
                </div>

                <!-- Business Registration -->
                <div class="glass-panel rounded-lg p-8 group hover:bg-surface-container-high transition-all">
                    <div class="flex items-center justify-between mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">description</span>
                        <span class="text-on-surface-variant font-label-md opacity-40">#NIB-OSS</span>
                    </div>
                    <p class="text-on-surface-variant font-label-md text-label-md mb-1 text-[#DBC0BE]">Legalitas Usaha (NIB)</p>
                    <h5 class="text-white font-headline-md text-headline-md font-bold mb-4">{{ $restaurant->nib_number ?: 'Belum diisi' }}</h5>
                    <div class="h-[1px] w-full bg-white/5 mb-4"></div>
                    <div class="space-y-2 mb-6 text-[#DBC0BE]">
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">Sertifikat Halal</span>
                            <span class="text-white">{{ $restaurant->halal_certificate_number ?: 'Belum diisi' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-on-surface-variant">Klasifikasi</span>
                            <span class="text-white text-xs">Kuliner Palembang Tradisional</span>
                        </div>
                    </div>
                    <a href="{{ route('resto.sertifikasi') }}" class="w-full py-3 rounded-lg border border-primary/30 text-primary font-label-md hover:bg-primary/10 transition-colors flex items-center justify-center gap-2 text-center text-xs font-bold">
                        <span class="material-symbols-outlined text-sm">visibility</span> Atur Berkas &amp; Dokumen
                    </a>
                </div>

                <!-- Headquarters -->
                <div class="glass-panel rounded-lg p-8 group hover:bg-surface-container-high transition-all">
                    <div class="flex items-center justify-between mb-8">
                        <span class="material-symbols-outlined text-primary text-3xl">location_on</span>
                        <span class="text-on-surface-variant font-label-md opacity-40">#LOKASI</span>
                    </div>
                    <p class="text-on-surface-variant font-label-md text-label-md mb-1 text-[#DBC0BE]">Alamat Operasional</p>
                    <h5 class="text-white font-body-lg text-body-lg font-bold leading-relaxed mb-4">{{ $restaurant->alamat }}</h5>
                    <div class="h-[1px] w-full bg-white/5 mb-4"></div>
                    @php
                        if ($restaurant->latitude && $restaurant->longitude) {
                            $restoNavUrl = "https://www.google.com/maps/search/?api=1&query=" . $restaurant->latitude . "," . $restaurant->longitude;
                        } else {
                            $restoNavUrl = $restaurant->maps_url ?: "https://www.google.com/maps/search/?api=1&query=" . urlencode($restaurant->nama_restoran . ", " . $restaurant->alamat);
                        }
                    @endphp
                    <a href="{{ $restoNavUrl }}" target="_blank" class="flex items-center gap-2 text-primary text-sm font-bold">
                        <span class="material-symbols-outlined text-sm">map</span>
                        Buka di Google Maps
                    </a>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="col-span-12 mt-6">
                <h4 class="text-white font-headline-md text-headline-md mb-6 font-bold text-[#D9C5A0]">Arsip Dokumen Legal</h4>
                <div class="grid grid-cols-4 gap-gutter">
                    <!-- Doc 1: Halal -->
                    @if($restaurant->halal_certificate_file)
                        <a href="{{ asset('storage/' . $restaurant->halal_certificate_file) }}" target="_blank" class="bg-surface-container-low p-6 rounded-lg border border-green-800/40 flex items-center gap-4 hover:border-primary/40 transition-all cursor-pointer">
                            <div class="w-12 h-12 bg-green-900/30 text-green-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">picture_as_pdf</span>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm">Sertifikat Halal</p>
                                <p class="text-[#DBC0BE] text-[12px]">Tersedia (Lihat)</p>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('resto.sertifikasi') }}" class="bg-surface-container-low p-6 rounded-lg border border-red-800/40 flex items-center gap-4 hover:border-primary/40 transition-all cursor-pointer">
                            <div class="w-12 h-12 bg-red-900/30 text-red-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">warning</span>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm">Sertifikat Halal</p>
                                <p class="text-[#DBC0BE] text-[12px]">Belum Diunggah</p>
                            </div>
                        </a>
                    @endif

                    <!-- Doc 2: NIB -->
                    @if($restaurant->nib_file)
                        <a href="{{ asset('storage/' . $restaurant->nib_file) }}" target="_blank" class="bg-surface-container-low p-6 rounded-lg border border-green-800/40 flex items-center gap-4 hover:border-primary/40 transition-all cursor-pointer">
                            <div class="w-12 h-12 bg-green-900/30 text-green-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">picture_as_pdf</span>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm">Dokumen NIB</p>
                                <p class="text-[#DBC0BE] text-[12px]">Tersedia (Lihat)</p>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('resto.sertifikasi') }}" class="bg-surface-container-low p-6 rounded-lg border border-red-800/40 flex items-center gap-4 hover:border-primary/40 transition-all cursor-pointer">
                            <div class="w-12 h-12 bg-red-900/30 text-red-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">warning</span>
                            </div>
                            <div>
                                <p class="text-white font-bold text-sm">Dokumen NIB</p>
                                <p class="text-[#DBC0BE] text-[12px]">Belum Diunggah</p>
                            </div>
                        </a>
                    @endif

                    <a href="{{ route('resto.sertifikasi') }}" class="bg-surface-container-low p-6 rounded-lg border border-white/5 flex items-center gap-4 border-dashed justify-center hover:bg-surface-container-high transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-on-surface-variant mr-2">add_circle</span>
                        <span class="text-on-surface-variant text-sm font-bold">Kelola Dokumen</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Update Profile Modal -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-4 hidden" id="update-profile-modal">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-md" onclick="document.getElementById('update-profile-modal').classList.add('hidden')"></div>
    <form action="{{ route('resto.profile.update') }}" method="POST" enctype="multipart/form-data" class="relative w-full max-w-2xl bg-surface-container rounded-lg shadow-2xl border border-white/10 overflow-hidden bg-surface-container-high/95">
        @csrf
        <div class="flex items-center justify-between p-6 border-b border-white/5">
            <h3 class="font-headline-md text-headline-md text-white font-bold text-[#D9C5A0]">Perbarui Profil &amp; Legalitas</h3>
            <button type="button" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container-highest transition-colors" onclick="document.getElementById('update-profile-modal').classList.add('hidden')">
                <span class="material-symbols-outlined text-on-surface-variant">close</span>
            </button>
        </div>
        <div class="p-8 max-h-[70vh] overflow-y-auto space-y-8">
            <section>
                <h4 class="text-primary font-label-md uppercase tracking-widest mb-4 font-semibold text-[#D9C5A0]">1. Informasi Pemilik &amp; Restoran</h4>
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Nama Lengkap Pemilik</label>
                        <input name="nama_pemilik" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" value="{{ $restaurant->nama_pemilik }}" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Nama Restoran</label>
                            <input name="nama_restoran" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" value="{{ $restaurant->nama_restoran }}" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-on-surface-variant text-sm text-[#DBC0BE]">WhatsApp Kontak (Format: 628xxxx)</label>
                            <input name="whatsapp" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" value="{{ $restaurant->whatsapp }}" required>
                        </div>
                    </div>
                    <!-- Input: Foto/Thumbnail Restoran -->
                    <div class="space-y-2">
                        <label class="text-on-surface-variant text-sm text-[#DBC0BE] block">Foto / Thumbnail Restoran</label>
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 rounded-lg overflow-hidden border border-white/10 bg-surface-container-low flex items-center justify-center shrink-0">
                                <img id="thumbnail-preview-modal" src="{{ $restaurant->photo_url }}" alt="Preview" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <input type="file" name="thumbnail" id="thumbnail-input-modal" accept="image/*" class="hidden" onchange="previewThumbnailModal(this)">
                                <label for="thumbnail-input-modal" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-dashed border-[#D9C5A0]/40 text-[#D9C5A0] hover:border-[#D9C5A0] cursor-pointer transition-all text-sm font-semibold bg-surface-container-low">
                                    <span class="material-symbols-outlined text-sm">upload</span> Pilih Foto Baru
                                </label>
                                <p class="text-xs text-on-surface-variant mt-2 text-[#DBC0BE]">Format: JPG, JPEG, PNG. Maks: 2MB.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <h4 class="text-primary font-label-md uppercase tracking-widest mb-4 font-semibold text-[#D9C5A0]">2. Dokumen Legalitas</h4>
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Nomor Induk Berusaha (NIB)</label>
                            <input name="nib_number" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" value="{{ $restaurant->nib_number }}">
                        </div>
                        <div class="space-y-2">
                            <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Nomor Sertifikat Halal</label>
                            <input name="halal_certificate_number" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" value="{{ $restaurant->halal_certificate_number }}">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Kategori Kuliner (Pisahkan dengan koma)</label>
                        <input name="kategori" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" value="{{ $restaurant->kategori }}" placeholder="Pempek, Tekwan, Mie Celor">
                    </div>
                </div>
            </section>
            <section>
                <h4 class="text-primary font-label-md uppercase tracking-widest mb-4 font-semibold text-[#D9C5A0]">3. Lokasi Bisnis</h4>
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Alamat Restoran</label>
                        <textarea name="alamat" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" rows="2" required>{{ $restaurant->alamat }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Link Google Maps</label>
                        <input name="maps_url" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" placeholder="https://maps.google.com/..." type="url" value="{{ $restaurant->maps_url }}">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Lintang (Latitude)</label>
                            <input name="latitude" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" placeholder="Contoh: -2.9761" value="{{ $restaurant->latitude }}">
                        </div>
                        <div class="space-y-2">
                            <label class="text-on-surface-variant text-sm text-[#DBC0BE]">Bujur (Longitude)</label>
                            <input name="longitude" class="w-full bg-surface-container-low border border-white/10 rounded-lg px-4 py-3 text-white focus:border-primary outline-none transition-colors" type="text" placeholder="Contoh: 104.7754" value="{{ $restaurant->longitude }}">
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="p-6 border-t border-white/5 flex justify-end gap-4 bg-surface-container-low">
            <button type="button" class="px-8 py-3 rounded-full font-label-md text-label-md text-on-surface-variant border border-white/10 hover:bg-white/5 transition-colors" onclick="document.getElementById('update-profile-modal').classList.add('hidden')">Batal</button>
            <button type="submit" class="bg-[#5a0f16] text-[#f5f0e6] px-8 py-3 rounded-full font-label-md text-label-md flex items-center gap-2 transition-all border border-primary/30 font-bold">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewThumbnailModal(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('thumbnail-preview-modal').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.querySelectorAll('.glass-panel, .bg-surface-container-low').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection