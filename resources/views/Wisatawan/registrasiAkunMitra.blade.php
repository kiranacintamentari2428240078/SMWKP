@extends('layouts.auth')

@section('title', 'Registrasi Mitra SMWKP - Sistem Manajemen Wisata Kuliner Palembang')

@section('content')
<!-- Header (TopAppBar) -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-xl border-b border-white/5">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop h-20 flex items-center justify-between w-full">
        <div class="font-headline-md tracking-tighter text-on-surface" style="color: rgb(178, 34, 34); font-weight: 700;">SMWKP</div>
        <nav class="hidden md:flex items-center gap-gutter">
            <a href="{{ route('pusat.bantuan') }}" class="flex items-center gap-2 px-6 py-2 rounded-full border border-outline-variant text-on-surface hover:bg-surface-container-high transition-all">
                <span class="material-symbols-outlined text-[20px]">help</span>
                <span class="font-label-md text-label-md">Bantuan</span>
            </a>
        </nav>
    </div>
</header>

<main class="flex-grow flex items-center justify-center px-margin-mobile md:px-margin-desktop pb-20 pt-32 min-h-screen">
    <!-- Registration Card -->
    <div class="glass-card w-full max-w-[480px] rounded-lg shadow-2xl p-8 md:p-10" id="registration-card">
        <div class="mb-10 text-center">
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Daftar Akun Mitra</h2>
            <p class="text-on-surface-variant font-body-md">Lengkapi data di bawah untuk memulai perjalanan bisnis Anda.</p>
        </div>
        <form action="{{ route('restoran.register.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant block ml-1">Nama Pemilik</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">person</span>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-6 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline/50" name="nama_pemilik" placeholder="Contoh: Ahmad Subarjo" type="text">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant block ml-1">Nama Restoran</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">restaurant</span>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-6 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline/50" name="nama_restoran" placeholder="Contoh: Pempek Cek Ana" type="text">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant block ml-1">Email Bisnis</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">mail</span>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-6 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline/50" name="email" placeholder="admin@restorananda.com" type="email">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant block ml-1">Nomor WhatsApp</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">phone_iphone</span>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-6 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline/50" name="whatsapp" placeholder="0812 3456 7890" type="tel">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-on-surface-variant block ml-1">Kata Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-primary transition-colors">lock</span>
                        <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-6 focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline/50" name="password" placeholder="••••••••••••" type="password">
                    </div>
                    <p class="text-[12px] text-outline ml-1">Gunakan minimal 8 karakter dengan kombinasi angka dan huruf.</p>
                </div>
            </div>
            <button class="w-full bg-primary text-on-primary py-4 rounded-full font-label-md text-label-md font-bold shadow-lg hover:brightness-110 active:scale-[0.98] transition-all duration-150 flex items-center justify-center gap-2 group mt-8" type="submit" style="background-color: rgb(90, 15, 22); color: white;">
                Daftar sebagai Mitra
                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>
            <p class="text-center text-on-surface-variant text-body-md mt-10 pt-8 border-t border-outline-variant">
                Sudah memiliki akun mitra? <a class="text-primary font-semibold hover:underline" href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </form>
    </div>
</main>

<!-- Footer -->
<footer class="bg-surface-container-lowest text-on-surface-variant font-body-md text-body-md w-full py-12 border-t border-outline-variant">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-gutter">
        <div class="flex flex-col gap-2 items-center md:items-start">
            <div class="font-headline-md text-primary" style="color: rgb(178, 34, 34); font-weight: 700;">SMWKP</div>
            <p class="text-on-surface-variant/60 text-center md:text-left">© 2026 SMWKP - Sistem Manajemen Wisata Kuliner Palembang. Seluruh Hak Cipta Dilindungi.</p>
        </div>
        <div class="flex gap-gutter">
            <a class="hover:text-primary transition-all" href="{{ route('tentang.kami') }}" style="color: #D2B48C;">Tentang Kami</a>
            <a class="hover:text-primary transition-all" href="{{ route('kebijakan.privasi') }}" style="color: #D2B48C;">Kebijakan Privasi</a>
            <a class="hover:text-primary transition-all" href="{{ route('pusat.bantuan') }}" style="color: #D2B48C;">Pusat Bantuan</a>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    // Smooth reveal animations
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('.glass-card, header, footer');
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(10px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    });
</script>
@endsection