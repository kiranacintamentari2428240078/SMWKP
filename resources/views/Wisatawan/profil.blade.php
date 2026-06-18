@extends('layouts.app')

@section('title', 'Profil Saya | SMWKP')

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
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-4xl mx-auto text-[#D9C5A0]">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('wisatawan.homepage') }}" class="text-on-surface-variant hover:text-brand-beige transition">
            <span class="material-symbols-outlined text-3xl">arrow_back</span>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white">Profil Pengguna</h1>
            <p class="text-on-surface-variant text-sm">Ubah informasi akun dan keamanan Anda</p>
        </div>
    </div>

    <!-- Alerts -->
    @if ($errors->any())
    <div class="bg-red-900/40 border border-red-800 text-red-200 px-6 py-4 rounded-lg text-sm mb-8">
        <div class="flex items-center gap-2 mb-2 font-bold">
            <span class="material-symbols-outlined text-red-400">error</span>
            Terjadi Kesalahan Pengisian
        </div>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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

    <form action="{{ route('wisatawan.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Profile Card -->
        <div class="bg-surface-container-low border border-outline-variant/10 rounded-2xl p-8 space-y-8">
            
            <!-- Avatar & Quick Info -->
            <div class="flex items-center gap-6">
                <div class="relative group">
                    <div class="w-24 h-24 rounded-full bg-primary-container/30 border-2 border-[#D9C5A0] shadow-xl flex items-center justify-center overflow-hidden">
                        <img id="avatar-preview" src="{{ Auth::user()->photo_url }}" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <p class="font-bold text-lg text-white">{{ Auth::user()->name ?? 'Wisatawan' }}</p>
                    <p class="text-on-surface-variant text-sm">{{ Auth::user()->email ?? '-' }}</p>
                    <span class="inline-block mt-2 px-3 py-0.5 text-xs font-semibold rounded-full bg-[#5a0f16] text-[#f5f0e6] border border-primary/20">Wisatawan Premium</span>
                </div>
            </div>

            <hr class="border-outline-variant/10">

            <!-- Input Fields Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nama Lengkap -->
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#DBC0BE]">Nama Lengkap</label>
                    <input name="name" class="w-full bg-surface-container-lowest border border-outline-variant/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="text" value="{{ old('name', Auth::user()->name) }}" required>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#DBC0BE]">Alamat Email</label>
                    <input name="email" class="w-full bg-surface-container-lowest border border-outline-variant/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="email" value="{{ old('email', Auth::user()->email) }}" required>
                </div>

                <!-- Foto Profil -->
                <div class="space-y-2 md:col-span-2">
                    <label class="font-label-md text-label-md text-[#DBC0BE]">Foto Profil</label>
                    <input name="photo" type="file" accept="image/*" onchange="previewAvatar(this)" class="w-full bg-surface-container-lowest border border-outline-variant/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm file:bg-[#5a0f16] file:border-none file:text-white file:rounded-md file:px-3 file:py-1 file:mr-3 file:cursor-pointer">
                    <p class="text-[10px] text-[#DBC0BE]/60">Format JPG, PNG, JPEG. Maks 2MB.</p>
                </div>
            </div>
        </div>

        <!-- Password Security Card -->
        <div class="bg-surface-container-low border border-outline-variant/10 rounded-2xl p-8 space-y-6">
            <div class="flex items-center gap-4 mb-4">
                <span class="material-symbols-outlined text-on-surface-variant">lock</span>
                <h3 class="font-headline-md text-headline-md text-white font-bold">Keamanan &amp; Kata Sandi</h3>
            </div>
            <p class="text-xs text-[#DBC0BE]/80 leading-relaxed">
                Kosongkan bidang kata sandi di bawah jika Anda tidak ingin memperbarui kata sandi akun Anda.
            </p>
            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#DBC0BE]">Kata Sandi Saat Ini</label>
                    <input name="current_password" class="w-full bg-surface-container-lowest border border-outline-variant/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="password" placeholder="••••••••">
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#DBC0BE]">Kata Sandi Baru</label>
                    <input name="new_password" class="w-full bg-surface-container-lowest border border-outline-variant/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="password" placeholder="••••••••">
                </div>
                <div class="space-y-2">
                    <label class="font-label-md text-label-md text-[#DBC0BE]">Konfirmasi Kata Sandi Baru</label>
                    <input name="new_password_confirmation" class="w-full bg-surface-container-lowest border border-outline-variant/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="password" placeholder="••••••••">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="bg-[#5a0f16] text-[#F5F5DC] px-8 py-4 rounded-lg font-headline-md text-headline-md flex items-center gap-2 hover:brightness-110 shadow-lg transition-all active:scale-[0.98] font-bold">
                <span class="material-symbols-outlined text-[20px]">save</span>
                Simpan Perubahan
            </button>
        </div>
    </form>
</main>
@endsection

@section('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
