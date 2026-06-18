@extends('layouts.auth')

@section('title', 'Masuk ke SMWKP | Warisan Kuliner Nusantara')

@section('styles')
<style>
    .bg-mesh {
        background-color: #121414;
        background-image: 
            radial-gradient(at 0% 0%, rgba(90, 15, 22, 0.15) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(90, 15, 22, 0.1) 0px, transparent 50%);
    }
    .active-role {
        background-color: #5a0f16;
        color: #ffb3b2;
        border-color: #5a0f16;
    }
</style>
@endsection

@section('content')
<!-- Header / Logo -->
<header class="w-full pt-12 pb-8 flex flex-col items-center animate-in fade-in slide-in-from-top-4 duration-1000">
    <h1 class="font-headline-lg text-headline-lg text-on-surface mt-2">Masuk ke SMWKP</h1>
    <p class="font-body-md text-on-surface-variant mt-2">Pintu gerbang menuju warisan rasa Bumi Sriwijaya</p>
</header>

<main class="flex-grow flex items-center justify-center px-margin-mobile md:px-margin-desktop pb-20">
    <!-- Floating Login Card -->
    <div class="glass-card w-full max-w-[500px] rounded-lg shadow-2xl p-8 md:p-10 transform transition-all duration-500 hover:shadow-primary-container/20">
        <!-- Role Selection -->
        <div class="mb-10">
            <p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-widest mb-4 text-center">Pilih Peran Anda</p>
            <div class="grid grid-cols-1 gap-3">
                <button class="role-btn active-role flex items-center gap-4 px-6 py-4 rounded-full border border-outline-variant transition-all hover:border-primary group" id="role-tourist" onclick="selectRole('tourist')">
                    <span class="material-symbols-outlined text-primary">person</span>
                    <span class="font-label-md text-label-md">Masuk sebagai Wisatawan</span>
                </button>
                <button class="role-btn flex items-center gap-4 px-6 py-4 rounded-full border border-outline-variant transition-all hover:border-primary group" id="role-admin-resto" onclick="selectRole('admin-resto')">
                    <span class="material-symbols-outlined">restaurant_menu</span>
                    <span class="font-label-md text-label-md">Masuk sebagai Admin Restoran</span>
                </button>
                <button class="role-btn flex items-center gap-4 px-6 py-4 rounded-full border border-outline-variant transition-all hover:border-primary group" id="role-admin-dinas" onclick="selectRole('admin-dinas')">
                    <span class="material-symbols-outlined">account_balance</span>
                    <span class="font-label-md text-label-md">Masuk sebagai Admin Dinas Pariwisata</span>
                </button>
            </div>
        </div>
        
        <!-- Form -->
        <form action="{{ route('login.proses') }}" method="POST" class="space-y-6">
            @csrf
            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        showConfirmButton: false,
                        background: '#1a1c1c',
                        color: '#e2e2e2',
                    });
                });
            </script>
            @endif
            @if ($errors->any())
            <div style="background: rgba(147, 0, 10, 0.15); border: 1px solid rgba(255, 180, 171, 0.3); border-radius: 12px; padding: 12px 16px; margin-bottom: 16px;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <span class="material-symbols-outlined" style="color: #ffb4ab; font-size: 20px;">error</span>
                    <span style="color: #ffb4ab; font-weight: 600; font-size: 14px;">Login Gagal</span>
                </div>
                @foreach ($errors->all() as $error)
                    <p style="color: #ffdad6; font-size: 13px; margin: 2px 0 0 28px;">{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <input type="hidden" name="role" id="role" value="{{ old('role', 'wisatawan') }}">
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-on-surface-variant block ml-1" for="email">Alamat Email</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
                    <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-6 focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline" 
                    id="email" name="email" type="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="space-y-2">
                <label class="font-label-md text-label-md text-on-surface-variant block ml-1" for="password">Kata Sandi</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">lock</span>
                    <input class="w-full bg-surface-container-lowest border border-outline-variant rounded-full py-4 pl-12 pr-12 focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all text-on-surface placeholder:text-outline" 
                    id="password" name="password" type="password" placeholder="••••••••" required>
                    <button class="absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors" type="button">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
                <div class="flex justify-end">
                    <a class="font-label-md text-label-md hover:underline transition-all text-on-surface-variant" href="{{ route('password.request') }}">Lupa kata sandi?</a>
                </div>
            </div>
            <!-- Primary Action -->
            <button class="w-full bg-gradient-to-r from-primary-container to-[#401015] text-primary py-4 rounded-full font-label-md text-label-md font-bold shadow-lg hover:shadow-primary-container/40 active:scale-95 transition-all duration-150 flex items-center justify-center gap-2 group" type="submit">
                Masuk
                <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>
        </form>
        
        <!-- Links -->
        <div class="mt-10 pt-8 border-t border-outline-variant flex flex-col items-center gap-4">
            <p class="font-body-md text-body-md text-on-surface-variant">Belum punya akun?</p>
            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2">
                <a class="font-label-md text-label-md text-primary hover:text-primary-fixed-dim underline transition-all" href="{{ route('wisatawan.register') }}">Daftar Wisatawan</a>
                <span class="text-outline-variant">|</span>
                <a class="font-label-md text-label-md text-primary hover:text-primary-fixed-dim underline transition-all" href="{{ route('restoran.register') }}">Daftar Restoran</a>
            </div>
        </div>
    </div>
</main>

<!-- Footer Decoration -->
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
    function selectRole(role) {
        // Map UI button IDs to actual database role values
        const roleMap = {
            'tourist': 'wisatawan',
            'admin-resto': 'mitra',
            'admin-dinas': 'admin_dinas'
        };

        // Update hidden role input
        const hiddenInput = document.getElementById('role');
        if (hiddenInput) {
            hiddenInput.value = roleMap[role] || 'wisatawan';
        }

        const buttons = document.querySelectorAll('.role-btn');
        buttons.forEach(btn => {
            btn.classList.remove('active-role');
            const icon = btn.querySelector('.material-symbols-outlined');
            icon.classList.remove('text-primary');
        });

        const activeBtn = document.getElementById(`role-${role}`);
        activeBtn.classList.add('active-role');
        activeBtn.querySelector('.material-symbols-outlined').classList.add('text-primary');
        
        // Interaction feedback
        activeBtn.style.transform = 'scale(0.98)';
        setTimeout(() => {
            activeBtn.style.transform = 'scale(1)';
        }, 150);
    }

    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.querySelector('button[type="button"]');
        const passwordInput = document.getElementById('password');
        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                this.querySelector('.material-symbols-outlined').textContent = type === 'password' ? 'visibility' : 'visibility_off';
            });
        }

        // Restore active role on page load/validation failure
        const initialRole = document.getElementById('role').value;
        const roleBtnMap = {
            'wisatawan': 'tourist',
            'mitra': 'admin-resto',
            'admin_dinas': 'admin-dinas'
        };
        const activeRoleKey = roleBtnMap[initialRole] || 'tourist';
        selectRole(activeRoleKey);
    });

    // Lightweight hover effect for the background mesh
    document.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth * 100;
        const y = e.clientY / window.innerHeight * 100;
        document.body.style.backgroundImage = `
            radial-gradient(at ${x}% ${y}%, rgba(90, 15, 22, 0.15) 0px, transparent 50%),
            radial-gradient(at 0% 0%, rgba(90, 15, 22, 0.1) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(90, 15, 22, 0.1) 0px, transparent 50%)
        `;
    });
</script>
@endsection