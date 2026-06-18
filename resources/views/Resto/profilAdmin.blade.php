@extends('layouts.app')

@section('title', 'Profil Admin | SMWKP Admin')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-72 min-h-screen p-margin-desktop bg-background text-[#D9C5A0]">
    <div class="max-w-container-max mx-auto">
        <!-- Profile Header Section -->
        <header class="flex items-end gap-8 mb-16 backdrop-blur-sm">
            <div class="relative group">
                <div class="w-40 h-40 rounded-full bg-primary-container/30 border-4 border-[#D9C5A0] shadow-xl flex items-center justify-center overflow-hidden">
                    <img id="avatar-preview" src="{{ Auth::user()->photo_url }}" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="pb-2">
                <div class="flex items-center gap-3 mb-1">
                    <h2 class="font-headline-lg text-headline-lg text-white font-bold">{{ Auth::user()->name }}</h2>
                    <span class="flex items-center gap-1 bg-[#5a0f16] text-[#f5f0e6] px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-primary/20">
                        <span class="material-symbols-outlined text-[14px]">verified</span>
                        Mitra Pembimbing
                    </span>
                </div>
                <p class="text-on-surface-variant font-body-lg text-body-lg text-[#DBC0BE]">Pengelola Restoran • SMWKP Portal</p>
            </div>
        </header>

        <!-- Form Wrapper -->
        <form action="{{ route('resto.profile.account.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Alerts -->
            @if ($errors->any())
            <div class="bg-red-900/40 border border-red-800 text-red-200 px-6 py-4 rounded-lg text-sm max-w-4xl">
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

            <!-- Grid Content -->
            <div class="grid grid-cols-12 gap-gutter max-w-6xl">
                <!-- Personal Information -->
                <section class="col-span-12 lg:col-span-7 space-y-8">
                    <div class="glass-panel p-10 rounded-lg">
                        <div class="flex items-center gap-4 mb-8">
                            <span class="material-symbols-outlined text-on-surface-variant">badge</span>
                            <h3 class="font-headline-md text-headline-md text-white font-bold">Informasi Akun Pengguna</h3>
                        </div>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="font-label-md text-label-md text-[#DBC0BE]">Nama Lengkap</label>
                                    <input name="name" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="text" value="{{ old('name', Auth::user()->name) }}" required>
                                </div>
                                <div class="space-y-2">
                                    <label class="font-label-md text-label-md text-[#DBC0BE]">ID Pengguna</label>
                                    <input readonly class="w-full bg-surface-container/50 border border-white/5 text-[#DBC0BE]/60 p-4 rounded-lg cursor-not-allowed text-sm" disabled type="text" value="USR-{{ sprintf('%04d', Auth::user()->id) }}">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label-md text-label-md text-[#DBC0BE]">Alamat Email</label>
                                <input name="email" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="email" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label-md text-label-md text-[#DBC0BE]">Nomor Telepon / WhatsApp</label>
                                <input name="phone" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="text" value="{{ old('phone', Auth::user()->restaurant ? Auth::user()->restaurant->whatsapp : '') }}" required>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label-md text-label-md text-[#DBC0BE]">Foto Profil</label>
                                <input name="photo" type="file" accept="image/*" onchange="previewAvatar(this)" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm file:bg-[#5a0f16] file:border-none file:text-white file:rounded-md file:px-3 file:py-1 file:mr-3 file:cursor-pointer">
                                <p class="text-[10px] text-[#DBC0BE]/60">Format JPG, PNG, JPEG. Maks 2MB.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Account Security (Ganti Password) -->
                <section class="col-span-12 lg:col-span-5 space-y-8">
                    <div class="glass-panel p-10 rounded-lg">
                        <div class="flex items-center gap-4 mb-8">
                            <span class="material-symbols-outlined text-on-surface-variant">lock</span>
                            <h3 class="font-headline-md text-headline-md text-white font-bold">Keamanan &amp; Kata Sandi</h3>
                        </div>
                        <div class="space-y-6">
                            <p class="text-xs text-[#DBC0BE]/80 leading-relaxed mb-4">
                                Kosongkan bidang kata sandi di bawah jika Anda tidak ingin memperbarui kata sandi akun Anda.
                            </p>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <label class="font-label-md text-label-md text-[#DBC0BE]">Kata Sandi Saat Ini</label>
                                    <input name="current_password" value="{{ old('current_password') }}" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="password" placeholder="••••••••">
                                </div>
                                <div class="space-y-2">
                                    <label class="font-label-md text-label-md text-[#DBC0BE]">Kata Sandi Baru</label>
                                    <input name="new_password" value="{{ old('new_password') }}" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="password" placeholder="••••••••">
                                </div>
                                <div class="space-y-2">
                                    <label class="font-label-md text-label-md text-[#DBC0BE]">Konfirmasi Kata Sandi Baru</label>
                                    <input name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" class="w-full bg-surface-container-lowest border border-white/10 text-white p-4 rounded-lg focus:border-[#D9C5A0] focus:ring-1 focus:ring-[#D9C5A0] outline-none transition-all text-sm" type="password" placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Submit Button Section -->
            <div class="max-w-6xl flex justify-end">
                <button type="submit" class="bg-[#5a0f16] text-[#F5F5DC] px-8 py-4 rounded-lg font-headline-md text-headline-md flex items-center gap-2 hover:brightness-110 shadow-lg transition-all active:scale-[0.98] font-bold">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
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
