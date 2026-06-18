@extends('layouts.auth')

@section('title', 'Status Verifikasi Usaha | SMWKP')

@section('styles')
<style>
    .glass-morphism {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .status-card {
        border-left: 4px solid;
    }
    .primary-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
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
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-on-surface-variant hover:text-brand-beige font-label-md text-label-md transition-colors flex items-center gap-2">
                Keluar <span class="material-symbols-outlined text-sm">logout</span>
            </button>
        </form>
    </div>
</nav>

<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto min-h-[80vh] flex items-center justify-center">
    <div class="w-full max-w-2xl">
        <div class="glass-morphism p-8 md:p-12 rounded-lg shadow-2xl relative overflow-hidden">
            <!-- Subtle Glow Decor -->
            <div class="absolute -top-24 -right-24 w-48 h-48 blur-[100px] rounded-full" style="background-color: rgba(245, 245, 220, 0.1);"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 blur-[100px] rounded-full" style="background-color: rgba(245, 245, 220, 0.05);"></div>
            
            <div class="relative z-10 text-center">
                @if(!$restaurant)
                    <div class="w-20 h-20 mx-auto rounded-full bg-error-container/20 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-error">warning</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-brand-beige mb-2">Usaha Belum Terdaftar</h2>
                    <p class="text-on-surface-variant font-body-md mb-8">Anda belum mendaftarkan restoran Anda. Silakan lengkapi formulir pendaftaran untuk memulai proses kurasi.</p>
                    <a href="{{ route('restoran.register') }}" class="inline-block primary-gradient text-brand-beige font-label-md px-8 py-3.5 rounded-lg hover:brightness-110 transition-all shadow-lg">Daftarkan Usaha Sekarang</a>

                @elseif($restaurant->status === 'submitted')
                    <div class="w-20 h-20 mx-auto rounded-full bg-warning/20 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-warning" style="color: #ffd700;">hourglass_empty</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-brand-beige mb-2">Menunggu Verifikasi Dinas</h2>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-warning/10 border border-warning/30 text-warning text-xs font-semibold uppercase tracking-wider mb-6" style="color: #ffd700;">
                        status: reviewing
                    </div>
                    
                    <div class="text-left bg-surface-container-high/30 border border-outline-variant/10 rounded-lg p-6 mb-8 status-card" style="border-left-color: #ffd700;">
                        <h4 class="font-headline-sm text-brand-beige text-base mb-2">Proses Peninjauan Sedang Berlangsung</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed mb-4">
                            Saat ini akun usaha <strong>{{ $restaurant->nama_restoran }}</strong> sedang ditinjau oleh Dinas Pariwisata Kota Palembang. Kami memverifikasi berkas legalitas NIB (Nomor Induk Berusaha) serta Sertifikat Halal yang telah Anda unggah.
                        </p>
                        <ul class="text-xs text-on-surface-variant space-y-2 border-t border-outline-variant/10 pt-4">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px] text-warning" style="color: #ffd700;">schedule</span>
                                <strong>Estimasi Waktu:</strong> 2x24 Jam Hari Kerja.
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-[16px] text-warning" style="color: #ffd700;">info</span>
                                <strong>Langkah Selanjutnya:</strong> Tim Dinas akan melakukan audit administrasi &amp; kesesuaian lokasi. Anda akan menerima pemberitahuan via email atau WhatsApp setelah verifikasi disetujui.
                            </li>
                        </ul>
                    </div>

                @elseif($restaurant->status === 'rejected')
                    <div class="w-20 h-20 mx-auto rounded-full bg-error-container/20 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-error">cancel</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-brand-beige mb-2">Pengajuan Listing Ditolak</h2>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-error-container/20 border border-error/30 text-error text-xs font-semibold uppercase tracking-wider mb-6">
                        status: rejected
                    </div>
                    
                    <div class="text-left bg-error-container/5 border border-error/20 rounded-lg p-6 mb-8 status-card border-l-error">
                        <h4 class="font-headline-sm text-error text-base mb-2">Alasan Penolakan:</h4>
                        <p class="text-xs text-on-surface-variant leading-relaxed mb-4 font-medium italic bg-background/50 p-3 rounded">
                            "{{ $restaurant->rejection_reason ?? 'Berkas atau data kurang lengkap.' }}"
                        </p>
                        <p class="text-xs text-on-surface-variant leading-relaxed">
                            Jangan khawatir, Anda dapat memperbaiki informasi usaha Anda dan mengirimkan ulang pengajuan.
                        </p>
                    </div>

                    <a href="{{ route('resto.editResto') }}" class="inline-block primary-gradient text-brand-beige font-label-md px-8 py-3.5 rounded-lg hover:brightness-110 transition-all shadow-lg">
                        Edit &amp; Ajukan Kembali
                    </a>

                @elseif($restaurant->status === 'draft')
                    <div class="w-20 h-20 mx-auto rounded-full bg-outline/20 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant">draft</span>
                    </div>
                    <h2 class="font-headline-lg text-headline-lg text-brand-beige mb-2">Pendaftaran Usaha Belum Dikirim</h2>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-high border border-outline-variant text-on-surface-variant text-xs font-semibold uppercase tracking-wider mb-6">
                        status: draft
                    </div>
                    
                    <p class="text-on-surface-variant font-body-md mb-8">Data usaha Anda tersimpan sebagai draft. Silakan kirimkan pengajuan agar ditinjau oleh Dinas.</p>
                    
                    <a href="{{ route('resto.editResto') }}" class="inline-block primary-gradient text-brand-beige font-label-md px-8 py-3.5 rounded-lg hover:brightness-110 transition-all shadow-lg">Lengkapi &amp; Ajukan</a>
                @endif

                <!-- Stepper Progress -->
                @if($restaurant)
                <div class="mt-12 pt-8 border-t border-outline-variant/10 text-left">
                    <h4 class="font-label-md text-xs text-brand-beige uppercase tracking-wider mb-6 text-center">Tahapan Pendaftaran</h4>
                    <div class="grid grid-cols-3 gap-2 text-center text-[11px] font-label-md">
                        <div class="flex flex-col items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-bold">✓</span>
                            <span class="text-secondary font-medium">Registrasi Akun</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            @if($restaurant->status === 'submitted')
                                <span class="w-8 h-8 rounded-full bg-warning text-on-warning flex items-center justify-center font-bold animate-pulse" style="background-color: #ffd700; color: #121212;">2</span>
                                <span class="text-warning font-medium" style="color: #ffd700;">Audit Dokumen</span>
                            @elseif($restaurant->status === 'rejected')
                                <span class="w-8 h-8 rounded-full bg-error text-on-error flex items-center justify-center font-bold">✕</span>
                                <span class="text-error font-medium">Pengajuan Ditolak</span>
                            @else
                                <span class="w-8 h-8 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold">2</span>
                                <span class="text-on-surface-variant">Audit Dokumen</span>
                            @endif
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center font-bold">3</span>
                            <span class="text-on-surface-variant">Aktivasi Listing</span>
                        </div>
                    </div>
                </div>
                @endif
                
                <p class="text-center mt-12 text-on-surface-variant text-xs">Butuh bantuan darurat? Hubungi Hubungi Kami atau kunjungi Kantor Dinas Pariwisata Kota Palembang.</p>
            </div>
        </div>
    </div>
</main>
@endsection
