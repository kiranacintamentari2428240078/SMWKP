@extends('layouts.app')

@section('title', 'SMWKP | Manajemen Sertifikasi Halal')

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
                <h3 class="text-display-lg font-bold text-brand-beige">{{ $totalPengajuan }}</h3>
                <span class="material-symbols-outlined text-brand-beige/20">assignment</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Menunggu Verifikasi</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-secondary">{{ $menunggu }}</h3>
                <span class="material-symbols-outlined text-secondary/20">pending</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Sertifikat Aktif</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-brand-beige">{{ $aktif }}</h3>
                <span class="material-symbols-outlined text-brand-beige/20">verified</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border group hover:bg-surface-container transition-colors">
            <p class="text-[11px] text-on-surface-variant uppercase tracking-widest mb-4">Hampir Kadaluarsa / Expired</p>
            <div class="flex justify-between items-end">
                <h3 class="text-display-lg font-bold text-error">{{ $kadaluarsa }}</h3>
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
                    @forelse($restaurants as $r)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-8 py-5 font-medium text-brand-beige">{{ $r->nama_restoran }}</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">{{ $r->halal_certificate_number ?? '-' }}</td>
                        <td class="px-8 py-5 text-xs text-on-surface-variant">{{ $r->updated_at->format('d M Y') }}</td>
                        <td class="px-8 py-5">
                            @if($r->halal_status === 'verified')
                                <span class="px-2 py-1 rounded bg-green-900/40 text-green-400 text-[10px] font-bold uppercase">Verified</span>
                            @elseif($r->halal_status === 'expired')
                                <span class="px-2 py-1 rounded bg-error/10 text-error text-[10px] font-bold uppercase">Expired</span>
                            @elseif($r->halal_status === 'reviewing')
                                <span class="px-2 py-1 rounded bg-secondary/10 text-secondary text-[10px] font-bold uppercase">Reviewing</span>
                            @else
                                <span class="px-2 py-1 rounded bg-surface-container-highest text-on-surface-variant text-[10px] font-bold uppercase">None</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right">
                            <button class="text-brand-beige hover:text-secondary transition-colors btn-show-halal"
                                data-id="{{ $r->id }}"
                                data-nama="{{ $r->nama_restoran }}"
                                data-halal-number="{{ $r->halal_certificate_number ?? '-' }}"
                                data-status="{{ $r->halal_status }}"
                                data-file="{{ $r->halal_certificate_file ? asset('storage/' . $r->halal_certificate_file) : '#' }}"
                                data-tanggal="{{ $r->updated_at->format('d M Y') }}"
                            >
                                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-on-surface-variant">Tidak ada pengajuan sertifikasi halal.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Detail Sertifikat Halal Modal -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-4 transition-all duration-300 hidden" id="halal-detail-modal">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-md" onclick="closeHalalModal()"></div>
    <div class="relative w-full max-w-lg bg-surface-container-low rounded-xl border border-outline-variant/10 shadow-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-outline-variant/10 flex justify-between items-center">
            <h3 class="font-headline-md text-brand-beige text-lg font-bold">Detail Sertifikat Halal</h3>
            <button class="text-on-surface-variant hover:text-brand-beige transition-colors cursor-pointer" onclick="closeHalalModal()">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-6 space-y-6">
            <div>
                <h4 class="text-xl font-bold text-brand-beige" id="modal-resto-name">Martabak HAR Simpang Sekip</h4>
                <div class="flex items-center gap-2 mt-1">
                    <p class="text-sm text-on-surface-variant" id="modal-halal-number">#HAL-2024-089</p>
                    <span class="px-2 py-0.5 rounded bg-secondary/10 text-secondary text-[10px] font-bold uppercase" id="modal-halal-status">Reviewing</span>
                </div>
            </div>
            <div class="space-y-4">
                <p class="text-xs font-bold text-brand-beige uppercase tracking-widest border-b border-outline-variant/10 pb-2">Informasi Sertifikat</p>
                <div class="grid grid-cols-2 gap-y-4 gap-x-4">
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">Tanggal Update</p>
                        <p class="text-brand-beige font-medium" id="modal-update-date">20 Mei 2024</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">Diterbitkan Oleh</p>
                        <p class="text-brand-beige font-medium">BPJPH Kementerian Agama RI</p>
                    </div>
                </div>
            </div>
            <div class="bg-surface-container-high/30 p-4 rounded-lg flex justify-between items-center" id="modal-pdf-container">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-brand-maroon">picture_as_pdf</span>
                    <span class="text-sm text-brand-beige">Dokumen Sertifikat Halal</span>
                </div>
                <a class="text-sm text-secondary font-medium hover:underline flex items-center gap-1" href="#" target="_blank" id="modal-pdf-link">
                    Lihat Sertifikat<span class="material-symbols-outlined text-[16px]">open_in_new</span>
                </a>
            </div>
        </div>
        <div class="px-6 py-6 bg-surface-container-high/20 flex justify-end gap-3">
            <button class="px-6 py-2.5 rounded-lg border border-outline-variant/20 text-on-surface-variant font-label-md hover:bg-surface-container-high transition-all cursor-pointer" onclick="closeHalalModal()">Batal</button>
            <form id="halal-approve-form" method="POST" action="">
                @csrf
                <input type="hidden" name="halal_status" value="verified">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-brand-maroon text-brand-beige font-label-md hover:brightness-110 transition-all cursor-pointer">Setujui Sertifikat</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-show-halal').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-nama');
                const halalNum = this.getAttribute('data-halal-number');
                const status = this.getAttribute('data-status');
                const file = this.getAttribute('data-file');
                const date = this.getAttribute('data-tanggal');
                openHalalModal(id, name, halalNum, status, file, date);
            });
        });
    });

    function openHalalModal(id, name, halalNum, status, file, date) {
        document.getElementById('modal-resto-name').textContent = name;
        document.getElementById('modal-halal-number').textContent = halalNum;
        document.getElementById('modal-update-date').textContent = date;
        
        const statusEl = document.getElementById('modal-halal-status');
        statusEl.textContent = status ? status.toUpperCase() : 'NONE';
        
        // Remove old classes
        statusEl.className = 'px-2 py-0.5 rounded text-[10px] font-bold uppercase ';
        if (status === 'verified') {
            statusEl.className += 'bg-green-950/40 text-green-400 border border-green-800';
        } else if (status === 'expired') {
            statusEl.className += 'bg-red-950/40 text-red-400 border border-red-800';
        } else {
            statusEl.className += 'bg-yellow-950/40 text-yellow-400 border border-yellow-800';
        }

        const pdfContainer = document.getElementById('modal-pdf-container');
        const pdfLink = document.getElementById('modal-pdf-link');
        if (file && file !== '#') {
            pdfLink.href = file;
            pdfContainer.style.display = 'flex';
        } else {
            pdfContainer.style.display = 'none';
        }

        document.getElementById('halal-approve-form').action = '/dinas/sertifikasi/' + id + '/status';
        
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
