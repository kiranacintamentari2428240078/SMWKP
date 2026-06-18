@extends('layouts.auth')

@section('title', 'Registrasi Wisatawan | SMWKP')

@section('styles')
<style>
    .palembang-pattern {
        background-image: radial-gradient(circle at 2px 2px, rgba(90, 15, 22, 0.15) 1px, transparent 0);
        background-size: 32px 32px;
    }
    .input-glow:focus {
        box-shadow: 0 0 15px rgba(90, 15, 22, 0.3);
    }
</style>
@endsection

@section('content')
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/80 dark:bg-surface/80 backdrop-blur-xl border-b border-white/10 shadow-sm flex justify-between items-center px-margin-mobile md:px-margin-desktop h-20">
    <div class="font-display-lg text-headline-md font-bold text-primary" style="color: rgb(178, 34, 34); font-weight: 700;">SMWKP</div>
    <div class="flex items-center gap-gutter">
        <a class="text-on-surface-variant font-label-md text-label-md transition-colors duration-200" href="{{ route('pusat.bantuan') }}">Bantuan</a>
    </div>
</header>

<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop min-h-screen flex items-center justify-center">
    <div class="max-w-container-max w-full flex justify-center">
        <!-- Registration Form Section -->
        <div class="glass-panel p-10 md:p-12 rounded-lg w-full max-w-md shadow-2xl transition-all duration-300 hover:border-primary/30" id="registration-card" style="transform: rotateY(3deg) rotateX(-11deg);">
            <div class="mb-6">
                <h2 class="font-headline-lg text-headline-lg mb-2" style="color: rgb(245, 245, 220);">Registrasi Akun</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Lengkapi data diri Anda untuk memulai perjalanan kuliner.</p>
            </div>

            <!-- Role Selection Switcher -->
            <div class="flex bg-surface-container-high/60 p-1.5 rounded-full mb-8 border border-outline-variant/10">
                <a href="{{ route('wisatawan.register') }}" class="flex-1 text-center py-2.5 rounded-full font-label-md text-xs transition-all duration-200 bg-[#5A0F16] text-brand-beige shadow-sm font-semibold">
                    Wisatawan
                </a>
                <a href="{{ route('restoran.register') }}" class="flex-1 text-center py-2.5 rounded-full font-label-md text-xs transition-all duration-200 text-on-surface-variant hover:text-brand-beige">
                    Mitra Resto
                </a>
            </div>
            
            <form action="{{ route('wisatawan.register.store') }}" method="POST" class="space-y-6">
                @csrf
                @if ($errors->any())
                <div style="background: rgba(147, 0, 10, 0.15); border: 1px solid rgba(255, 180, 171, 0.3); border-radius: 12px; padding: 12px 16px; margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <span class="material-symbols-outlined" style="color: #ffb4ab; font-size: 20px;">error</span>
                        <span style="color: #ffb4ab; font-weight: 600; font-size: 14px;">Registrasi Gagal</span>
                    </div>
                    @foreach ($errors->all() as $error)
                        <p style="color: #ffdad6; font-size: 13px; margin: 2px 0 0 28px;">{{ $error }}</p>
                    @endforeach
                </div>
                @endif
                <!-- Nama Lengkap -->
                <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface ml-4" for="name">Nama Lengkap</label>
                    <input class="w-full bg-surface-container-low border border-outline-variant rounded-full px-6 py-4 text-on-surface placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary input-glow transition-all duration-200" id="name" name="name" placeholder="Andi Wijaya" type="text" value="{{ old('name') }}" required>
                </div>
                <!-- Email -->
                <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface ml-4" for="email">Alamat Email</label>
                    <input class="w-full bg-surface-container-low border border-outline-variant rounded-full px-6 py-4 text-on-surface placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary input-glow transition-all duration-200" 
                    id="email" name="email" placeholder="andi@email.com" type="email" value="{{ old('email') }}" required>
                </div>
                <!-- Kata Sandi -->
                <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface ml-4" for="password">Kata Sandi</label>
                    <div class="relative">
                        <input class="w-full bg-surface-container-low border border-outline-variant rounded-full px-6 py-4 text-on-surface placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary input-glow transition-all duration-200" 
                        id="password" name="password" placeholder="••••••••" type="password" required minlength="8">
                        <button class="absolute right-6 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" type="button">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>
                <!-- Konfirmasi Kata Sandi -->
                <div class="space-y-2">
                    <label class="block font-label-md text-label-md text-on-surface ml-4" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input class="w-full bg-surface-container-low border border-outline-variant rounded-full px-6 py-4 text-on-surface placeholder:text-on-surface-variant/40 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary input-glow transition-all duration-200" id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password" required>
                </div>
                <!-- Syarat & Ketentuan Checkbox -->
                <div class="flex items-start gap-3 ml-4">
                    <input type="checkbox" id="terms" name="terms" class="mt-1 accent-primary rounded text-primary focus:ring-primary focus:ring-offset-background" {{ old('terms') ? 'checked' : '' }} required>
                    <label for="terms" class="text-xs text-on-surface-variant leading-relaxed">
                        Saya menyetujui <a href="{{ route('wisatawan.terms') }}" target="_blank" class="text-primary font-bold hover:underline" style="color: rgb(245, 245, 220);">Syarat & Ketentuan</a> yang berlaku di platform SMWKP.
                    </label>
                </div>
                <!-- Submit Button -->
                <button class="w-full bg-primary-container text-primary font-headline-md text-headline-md py-4 rounded-full mt-4 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-primary-container/20 hover:bg-[#6e141b]" type="submit" style="color: rgb(245, 245, 220);">
                    Daftar Sekarang
                </button>
                <div class="mt-8 text-center">
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Sudah punya akun? 
                        <a class="text-primary font-bold hover:underline transition-all ml-1" href="{{ route('login') }}" style="color: rgb(245, 245, 220);">Halaman Login</a>
                    </p>
                </div>
            </form>
        </div>
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
            <a class="hover:text-tertiary transition-all" href="{{ route('tentang.kami') }}">Tentang Kami</a>
            <a class="hover:text-tertiary transition-all" href="{{ route('kebijakan.privasi') }}">Kebijakan Privasi</a>
            <a class="hover:text-tertiary transition-all" href="{{ route('pusat.bantuan') }}">Pusat Bantuan</a>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    // Simple micro-interaction for password toggle
    document.querySelectorAll('button').forEach(btn => {
        if (btn.querySelector('.material-symbols-outlined')) {
            btn.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('.material-symbols-outlined');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                }
            });
        }
    });

    // Atmospheric mouse move effect for the glass panel
    const card = document.getElementById('registration-card');
    if (card) {
        document.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 50;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 50;
            card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
    }
</script>
@endsection