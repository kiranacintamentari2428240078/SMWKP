@extends('layouts.app')

@section('title', 'SMWKP | Sertifikasi Halal')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-64 p-margin-desktop bg-background min-h-screen">
    <header class="flex justify-between items-end mb-12">
        <div class="space-y-2">
            <h2 class="font-headline-lg text-headline-lg text-brand-beige">Manajemen Sertifikasi Halal</h2>
            <p class="font-body-md text-on-surface-variant max-w-xl">Kelola, verifikasi, dan pantau status sertifikasi halal pelaku usaha kuliner Kota Palembang.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-brand-maroon text-brand-beige px-6 py-2.5 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:brightness-110 transition-all">
                <span class="material-symbols-outlined text-[20px]">download</span>Ekspor Laporan
            </button>
        </div>
    </header>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Total Pengajuan</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-brand-beige">482</h3>
                <span class="material-symbols-outlined text-brand-beige/20">assignment</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Menunggu Verifikasi</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-secondary">56</h3>
                <span class="material-symbols-outlined text-secondary/20">pending</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Sertifikat Aktif</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-brand-beige">398</h3>
                <span class="material-symbols-outlined text-brand-beige/20">verified</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Hampir Kadaluarsa</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-error">28</h3>
                <span class="material-symbols-outlined text-error/20">warning</span>
            </div>
        </div>
    </section>

    <section class="bg-surface-container-low rounded-xl card-subtle-border overflow-hidden mb-8">
        <div class="px-8 py-6 border-b border-outline-variant/10 flex justify-between items-center">
            <h3 class="font-headline-md text-brand-beige"><b>Daftar Pengajuan Sertifikat</b></h3>
            <div class="flex gap-4">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input class="bg-surface-container-high border-none rounded-lg pl-10 pr-4 py-2 text-xs text-on-surface w-64 focus:ring-1 focus:ring-brand-maroon" placeholder="Cari restoran..." type="text">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-surface-container-high/30">
                    <tr class="border-b border-outline-variant/5">
                        <th class="px-8 py-4 text-[11px] text-on-surface-variant uppercase tracking-widest">Nama Restoran</th>
                        <th class="px-8 py-4 text-[11px] text-on-surface-variant uppercase tracking-widest">ID Halal</th>
                        <th class="px-8 py-4 text-[11px] text-on-surface-variant uppercase tracking-widest">Tanggal Pengajuan</th>
                        <th class="px-8 py-4 text-[11px] text-on-surface-variant uppercase tracking-widest">Status</th>
                        <th class="px-8 py-4 text-[11px] text-on-surface-variant uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5">
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-8 py-5 font-medium text-brand-beige">Martabak HAR Simpang Sekip</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">#HAL-2024-089</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">20 Mei 2024</td>
                        <td class="px-8 py-5">
                            <span class="px-2 py-1 rounded bg-secondary/10 text-secondary text-[10px] font-bold uppercase">Reviewing</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="text-brand-beige hover:text-secondary transition-colors" onclick="openHalalModal()">
                                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-8 py-5 font-medium text-brand-beige">Pindang Meranjat Ibu Hajah</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">#HAL-2024-072</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">18 Mei 2024</td>
                        <td class="px-8 py-5">
                            <span class="px-2 py-1 rounded bg-brand-maroon/20 text-brand-beige text-[10px] font-bold uppercase">Verified</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="text-brand-beige hover:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-8 py-5 font-medium text-brand-beige">Sate Padang Saiyo</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">#HAL-2024-065</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">15 Mei 2024</td>
                        <td class="px-8 py-5">
                            <span class="px-2 py-1 rounded bg-error/10 text-error text-[10px] font-bold uppercase">Expired</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="text-brand-beige hover:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Detail Sertifikat Halal Modal -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-4 transition-all duration-300 hidden" id="halal-detail-modal">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-md" onclick="closeHalalModal()"></div>
    <div class="relative w-full max-w-lg bg-surface-container-low rounded-xl border border-outline-variant/10 shadow-2xl overflow-hidden">
        <div class="p-8 flex flex-col items-center text-center space-y-6">
            <div class="w-20 h-20 rounded-full bg-brand-maroon flex items-center justify-center mb-2">
                <span class="material-symbols-outlined text-brand-beige text-[48px] fill">check_circle</span>
            </div>
            <div class="space-y-3">
                <h3 class="font-headline-md text-brand-beige font-bold">Sertifikat Berhasil Disetujui</h3>
                <p class="font-body-md text-on-surface-variant max-w-sm">Sertifikat halal untuk Martabak HAR Simpang Sekip telah berhasil divalidasi dan statusnya kini aktif di sistem.</p>
            </div>
            <button class="w-full bg-brand-maroon text-brand-beige py-3 rounded-lg font-label-md text-label-md hover:brightness-110 transition-all" onclick="closeHalalModal()">Tutup</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openHalalModal() {
        const modal = document.getElementById('halal-detail-modal');
        modal.classList.remove('hidden');
    }

    function closeHalalModal() {
        const modal = document.getElementById('halal-detail-modal');
        modal.classList.add('hidden');
    }

    // Micro-interactions for professional feel
    document.querySelectorAll('button, a').forEach(el => {
        el.addEventListener('mousedown', () => {
            el.classList.add('opacity-80', 'scale-[0.98]');
            setTimeout(() => el.classList.remove('opacity-80', 'scale-[0.98]'), 100);
        });
    });
</script>
@endsection
