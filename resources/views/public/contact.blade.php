@extends('layouts.app')

@section('title', 'Hubungi Kami | SMWKP')

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="min-h-screen pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface">
    <header class="mb-16 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Hubungi Kami</h1>
        <p class="font-body-lg text-on-surface-variant">Apakah Anda memiliki pertanyaan atau masukan untuk platform SMWKP? Hubungi kami langsung.</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-4xl mx-auto">
        <!-- Contact Information -->
        <div class="space-y-6">
            <h2 class="font-headline-lg text-headline-lg text-primary">Dinas Kebudayaan &amp; Pariwisata Kota Palembang</h2>
            <p class="text-on-surface-variant text-sm leading-relaxed">Kami selalu siap membantu Anda memberikan informasi pariwisata kuliner Kota Palembang yang tepercaya.</p>
            
            <div class="space-y-4 pt-4">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-[28px]">location_on</span>
                    <div>
                        <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Alamat Kantor</p>
                        <p class="text-sm">Jl. Sultan Mansyur No. 22, Bukit Lama, Palembang</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-[28px]">mail</span>
                    <div>
                        <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Email</p>
                        <p class="text-sm">info@dispar.palembang.go.id</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-primary text-[28px]">call</span>
                    <div>
                        <p class="text-xs text-on-surface-variant font-bold uppercase tracking-wider">Telepon</p>
                        <p class="text-sm">+62 (711) 352-222</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="bg-surface-container-low border border-outline-variant/10 rounded-lg p-8 space-y-6">
            <h3 class="font-headline-md text-headline-md text-white">Kirim Pesan</h3>
            <form onsubmit="event.preventDefault(); Swal.fire({ icon: 'success', title: 'Pesan Terkirim', text: 'Terima kasih, pesan Anda telah kami terima.', background: '#1a1c1c', color: '#e2e2e2', confirmButtonColor: '#5a0f16' })" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-brand-beige mb-2" for="contact_name">Nama Lengkap</label>
                    <input id="contact_name" required class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-3 text-sm text-white focus:ring-1 focus:ring-primary outline-none" type="text" placeholder="Masukkan nama Anda">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-brand-beige mb-2" for="contact_email">Alamat Email</label>
                    <input id="contact_email" required class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-3 text-sm text-white focus:ring-1 focus:ring-primary outline-none" type="email" placeholder="nama@email.com">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-brand-beige mb-2" for="contact_msg">Pesan Anda</label>
                    <textarea id="contact_msg" required class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-3 text-sm text-white focus:ring-1 focus:ring-primary outline-none h-28 resize-none" placeholder="Tuliskan pesan Anda di sini..."></textarea>
                </div>
                <button type="submit" class="w-full bg-brand-maroon text-white font-label-md py-3 rounded-lg hover:bg-brand-maroon-light active:scale-[0.98] transition-all">Kirim Pesan</button>
            </form>
        </div>
    </div>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
