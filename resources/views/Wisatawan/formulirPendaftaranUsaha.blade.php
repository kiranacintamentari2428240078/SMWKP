@extends('layouts.auth')

@section('title', 'Formulir Pendaftaran Usaha | SMWKP')

@section('styles')
<style>
    .glass-morphism {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .primary-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }
    .primary-gradient:active {
        transform: scale(0.98);
    }
</style>
@endsection

@section('content')
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-margin-desktop h-20 max-w-container-max mx-auto bg-background/80 backdrop-blur-md border-b border-white/10 shadow-sm">
    <div class="font-display-lg font-bold text-primary flex items-center gap-2 text-headline-md">
        <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1; color: rgb(178, 34, 34);">restaurant</span>
        <span style="color: rgb(178, 34, 34); font-weight: 700;">SMWKP</span>
    </div>
    <div class="hidden md:flex gap-8 items-center">
        @auth
            <a class="text-on-surface-variant font-label-md text-label-md transition-colors" href="{{ route('resto.status-pendaftaran') }}">Status Pendaftaran</a>
        @endauth
    </div>
</nav>

<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <div class="lg:col-span-8 lg:col-start-3">
            <div class="glass-morphism p-8 md:p-12 rounded-lg shadow-2xl relative overflow-hidden">
                <!-- Subtle Glow Decor -->
                <div class="absolute -top-24 -right-24 w-48 h-48 blur-[100px] rounded-full" style="background-color: rgba(245, 245, 220, 0.1);"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 blur-[100px] rounded-full" style="background-color: rgba(245, 245, 220, 0.05);"></div>
                
                <div class="relative z-10">
                    <h2 class="font-headline-lg text-headline-lg mb-4 flex items-center gap-3">
                        <span class="w-8 h-1 bg-primary rounded-full" style="background-color: rgb(245, 245, 220);"></span>
                        Formulir Pendaftaran Usaha
                    </h2>

                    <!-- Role Selection Switcher -->
                    <div class="flex bg-surface-container-high/60 p-1.5 rounded-full mb-8 border border-outline-variant/10 max-w-sm mx-auto">
                        <a href="{{ route('wisatawan.register') }}" class="flex-1 text-center py-2.5 rounded-full font-label-md text-xs transition-all duration-200 text-on-surface-variant hover:text-brand-beige">
                            Wisatawan
                        </a>
                        <a href="{{ route('restoran.register') }}" class="flex-1 text-center py-2.5 rounded-full font-label-md text-xs transition-all duration-200 bg-[#5A0F16] text-brand-beige shadow-sm font-semibold">
                            Mitra Resto
                        </a>
                    </div>
                    
                    <form class="space-y-6" id="registrationForm" method="POST" action="{{ route('restoran.register.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Owner Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-on-surface-variant font-label-md text-label-md ml-1">Nama Pemilik</label>
                                <input name="name" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none" placeholder="Contoh: Andi Wijaya" type="text" value="{{ old('name') }}">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-on-surface-variant font-label-md text-label-md ml-1">Nomor WhatsApp</label>
                                <input name="whatsapp" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none" placeholder="+62 812 3456 7890" type="tel" value="{{ old('whatsapp') }}">
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-on-surface-variant font-label-md text-label-md ml-1">Nama Usaha Kuliner</label>
                            <input name="nama_restoran" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none" placeholder="Contoh: Pempek Cek Molek Heritage" type="text" value="{{ old('nama_restoran') }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-on-surface-variant font-label-md text-label-md ml-1">Alamat Email Bisnis</label>
                            <input name="email" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none" placeholder="admin@usahaanda.com" type="email" value="{{ old('email') }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-on-surface-variant font-label-md text-label-md ml-1">Kategori Kuliner</label>
                            <select name="kategori" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none appearance-none">
                                <option disabled="" {{ old('kategori') ? '' : 'selected' }} value="">Pilih Kategori Utama</option>
                                <option value="Pempek" {{ old('kategori') == 'Pempek' ? 'selected' : '' }}>Pempek</option>
                                <option value="Tekwan" {{ old('kategori') == 'Tekwan' ? 'selected' : '' }}>Tekwan</option>
                                <option value="Mie Celor" {{ old('kategori') == 'Mie Celor' ? 'selected' : '' }}>Mie Celor</option>
                                <option value="Model" {{ old('kategori') == 'Model' ? 'selected' : '' }}>Model</option>
                                <option value="Laksan" {{ old('kategori') == 'Laksan' ? 'selected' : '' }}>Laksan</option>
                            </select>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-on-surface-variant font-label-md text-label-md ml-1">Kata Sandi</label>
                                <input name="password" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none" placeholder="Minimal 8 karakter" type="password">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-on-surface-variant font-label-md text-label-md ml-1">Konfirmasi Kata Sandi</label>
                                <input name="password_confirmation" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none" placeholder="Ulangi kata sandi" type="password">
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="text-on-surface-variant font-label-md text-label-md ml-1">Alamat Lengkap Usaha</label>
                            <textarea name="alamat" required class="bg-surface-container-lowest border-outline-variant focus:border-primary focus:ring-1 focus:ring-primary rounded-lg p-4 text-on-surface transition-all outline-none resize-none" placeholder="Jl. Jendral Sudirman No. 123, Palembang..." rows="3">{{ old('alamat') }}</textarea>
                        </div>
                        <!-- Photo Dropzone -->
                        <div class="flex flex-col gap-2">
                            <label class="text-on-surface-variant font-label-md text-label-md ml-1">Foto Usaha / Produk Unggulan</label>
                            <div class="border-2 border-dashed border-outline-variant rounded-lg p-10 flex flex-col items-center justify-center gap-3 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-all cursor-pointer group" id="dropzone">
                                <div class="w-16 h-16 rounded-full bg-primary-container/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-3xl" style="color: #F5F5DC;">add_a_photo</span>
                                </div>
                                <div class="text-center">
                                    <p class="font-headline-md text-headline-md text-on-surface">Klik atau seret foto ke sini</p>
                                    <p class="text-on-surface-variant text-label-md">Maks. 5 file (JPG, PNG). Minimal 1080px untuk hasil terbaik.</p>
                                </div>
                                <input name="photos[]" accept="image/*" class="hidden" id="fileInput" multiple="" type="file">
                            </div>
                            <div class="flex flex-wrap gap-2 mt-2" id="previewContainer"></div>
                        </div>
                        <div class="pt-4">
                            <button class="w-full primary-gradient font-headline-md text-headline-md py-5 rounded-lg flex items-center justify-center gap-3 group" style="color: rgb(245, 245, 220);" type="submit">
                                Dapatkan Akun Mitra
                                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                            <p class="text-center mt-4 text-on-surface-variant text-label-md">Dengan mendaftar, Anda menyetujui <a class="underline" href="{{ route('wisatawan.terms') }}" style="color: #F5F5DC;">Syarat &amp; Ketentuan</a> mitra KulinerPalembang.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="w-full py-margin-desktop px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container-low border-t border-outline-variant mt-20">
    <div class="flex flex-col gap-4">
        <div class="font-headline-md text-headline-md font-bold" style="color: rgb(178, 34, 34);">SMWKP</div>
        <p class="text-on-surface-variant font-body-md text-body-md">Platform digital pelestari warisan kuliner khas Palembang untuk dunia.</p>
    </div>
    <div class="flex flex-col gap-3">
        <h4 class="font-label-md text-label-md text-on-surface uppercase tracking-wider">Perusahaan</h4>
        <a class="text-on-surface-variant underline transition-all" href="{{ route('tentang.kami') }}">Tentang Kami</a>
        <a class="text-on-surface-variant underline transition-all" href="{{ route('wisatawan.partnerships') }}">Partnerships</a>
        <a class="text-on-surface-variant underline transition-all" href="{{ route('pusat.bantuan') }}">Hubungi Kami</a>
    </div>
    <div class="flex flex-col gap-3">
        <h4 class="font-label-md text-label-md text-on-surface uppercase tracking-wider">Legal</h4>
        <a class="text-on-surface-variant underline transition-all" href="{{ route('kebijakan.privasi') }}">Privacy Policy</a>
        <a class="text-on-surface-variant underline transition-all" href="{{ route('wisatawan.terms') }}">Terms of Service</a>
    </div>
    <div class="flex flex-col gap-4">
        <h4 class="font-label-md text-label-md text-on-surface uppercase tracking-wider">Ikuti Kami</h4>
        <div class="flex gap-4">
            <a class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center transition-colors" href="{{ route('wisatawan.partnerships') }}">
                <span class="material-symbols-outlined text-on-surface text-xl">share</span>
            </a>
            <a class="w-10 h-10 rounded-full bg-surface-container-highest flex items-center justify-center transition-colors" href="{{ route('pusat.bantuan') }}">
                <span class="material-symbols-outlined text-on-surface text-xl">camera</span>
            </a>
        </div>
        <p class="text-on-surface-variant text-label-md mt-4">© 2026 SMWKP - Sistem Manajemen Wisata Kuliner Palembang. Seluruh Hak Cipta Dilindungi.</p>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    // Dropzone Interaction
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');

    if (dropzone) {
        dropzone.addEventListener('click', () => fileInput.click());

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-primary', 'bg-surface-container-lowest');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-primary', 'bg-surface-container-lowest');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-primary', 'bg-surface-container-lowest');
            handleFiles(e.dataTransfer.files);
        });
    }

    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });
    }

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const div = document.createElement('div');
                    div.className = 'relative w-20 h-20 rounded-lg overflow-hidden border border-outline-variant';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <button class="absolute top-1 right-1 bg-primary text-on-primary-fixed-variant rounded-full w-5 h-5 flex items-center justify-center text-[10px]" onclick="this.parentElement.remove()">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection