@extends('layouts.app')

@section('title', 'SMWKP | Antrean Verifikasi')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-64 p-margin-desktop bg-background min-h-screen">
    <header class="flex justify-between items-end mb-12">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-brand-beige mb-2">Antrean Verifikasi</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl">Kelola dan tinjau pengajuan listing kuliner baru untuk menjaga kualitas data platform.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-surface-container-high text-brand-beige px-5 py-2.5 rounded-lg font-label-md text-label-md flex items-center gap-2 border border-outline-variant/10 hover:bg-surface-container-highest transition-all">
                <span class="material-symbols-outlined text-[20px]">calendar_today</span>{{ now()->translatedFormat('d M Y') }}
            </button>
        </div>
    </header>

    <section class="grid grid-cols-1 gap-6 mb-12 lg:grid-cols-4">
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Total Pengajuan</p>
                <span class="material-symbols-outlined text-brand-beige/20 group-hover:text-brand-beige/50 transition-colors">list_alt</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-brand-beige mb-2">{{ $totalPengajuan }}</h3>
            <p class="text-[12px] text-secondary flex items-center gap-1 font-medium">
                <span class="material-symbols-outlined text-[14px]">trending_up</span>Sistem Aktif
            </p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Review Mendesak</p>
                <span class="material-symbols-outlined text-error/20 group-hover:text-error/50 transition-colors">priority_high</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-error mb-2">{{ $menunggu }}</h3>
            <div class="flex items-center">
                <span class="text-[10px] font-bold text-error bg-error-container/20 px-2 py-0.5 rounded uppercase tracking-tighter">Butuh Perhatian</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Menunggu</p>
                <span class="material-symbols-outlined text-brand-beige/20 group-hover:text-brand-beige/50 transition-colors">hourglass_empty</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-brand-beige mb-2">{{ $menunggu }}</h3>
            <p class="text-[12px] text-on-surface-variant font-medium">Dalam antrean</p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Tingkat Penyelesaian</p>
                <span class="material-symbols-outlined text-brand-beige/20 group-hover:text-brand-beige/50 transition-colors">check_circle</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-brand-beige mb-2">{{ $tingkatPenyelesaian }}%</h3>
            <p class="text-[12px] text-on-surface-variant font-medium">Persentase Verifikasi</p>
        </div>
    </section>

    <section class="bg-surface-container-low rounded-xl card-subtle-border overflow-hidden">
        <div class="px-8 py-6 border-b border-outline-variant/10 flex justify-between items-center">
            <h3 class="font-headline-md text-headline-md text-brand-beige">Daftar Tunggu Verifikasi</h3>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-surface-container-high text-brand-beige text-xs rounded-lg border border-outline-variant/10" onclick="document.getElementById('filter-modal').classList.remove('opacity-0', 'pointer-events-none')">Filter</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-outline-variant/5">
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Nama Restoran</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Kategori</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Tanggal Masuk</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Status</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5">
                    @forelse($restaurants as $r)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-surface-container-highest">
                                    <img alt="Food" class="w-full h-full object-cover" src="{{ $r->photo_url }}"/>
                                </div>
                                <div>
                                    <p class="font-label-md text-brand-beige text-sm">{{ $r->nama_restoran }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ Str::limit($r->alamat, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-[11px] text-secondary font-medium uppercase">{{ $r->kategori }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs text-on-surface">{{ $r->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-[10px] font-bold text-error bg-error-container/10 px-2 py-0.5 rounded uppercase">Submitted</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="p-2 rounded-lg bg-surface-container-high text-brand-beige hover:bg-brand-maroon transition-all btn-show-detail"
                                    data-nama="{{ $r->nama_restoran }}"
                                    data-pemilik="{{ $r->nama_pemilik }}"
                                    data-kategori="{{ $r->kategori }}"
                                    data-tanggal="{{ $r->created_at->format('d M Y') }}"
                                    data-id="{{ $r->id }}"
                                    data-img="{{ $r->photo_url }}"
                                    data-description="{{ $r->description ?? 'Tidak ada deskripsi.' }}"
                                    data-maps="{{ $r->maps_url ?? '' }}"
                                    data-nib-number="{{ $r->nib_number ?? 'Belum Diunggah' }}"
                                    data-halal-number="{{ $r->halal_certificate_number ?? 'Belum Diunggah' }}"
                                    data-nib-file="{{ $r->nib_file ? asset('storage/' . $r->nib_file) : '#' }}"
                                    data-halal-file="{{ $r->halal_certificate_file ? asset('storage/' . $r->halal_certificate_file) : '#' }}"
                                    data-email="{{ $r->email }}"
                                    data-whatsapp="{{ $r->whatsapp }}"
                                    data-alamat="{{ $r->alamat }}"
                                    data-hours="{{ is_string($r->operational_hours) ? $r->operational_hours : json_encode($r->operational_hours) }}"
                                >
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </button>
                                <button class="p-2 rounded-lg bg-surface-container-high text-secondary hover:bg-secondary hover:text-on-secondary transition-all btn-show-confirm"
                                    data-id="{{ $r->id }}"
                                    data-nama="{{ $r->nama_restoran }}"
                                    data-kategori="{{ $r->kategori }}"
                                    data-img="{{ $r->photo_url }}"
                                >
                                    <span class="material-symbols-outlined text-[18px]">check</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-on-surface-variant font-medium">Tidak ada pengajuan verifikasi dalam antrean.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Detail Pengajuan Listing Modal -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300" id="detail-listing-modal">
    <div class="absolute inset-0 bg-background/80 backdrop-blur-sm" onclick="closeDetailModal()"></div>
    <div class="relative bg-surface-container-low border card-subtle-border rounded-xl w-full max-w-2xl overflow-hidden shadow-2xl flex flex-col">
        <!-- Modal Header -->
        <div class="px-8 py-6 border-b border-outline-variant/10 flex justify-between items-center bg-surface-container-low">
            <div>
                <h3 class="font-headline-md text-brand-beige text-xl mb-1">Detail Pengajuan Listing</h3>
                <p class="text-xs text-on-surface-variant font-label-md uppercase tracking-widest" id="modal-id-badge">ID: #LST-0000</p>
            </div>
            <button class="p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-brand-beige transition-colors" onclick="closeDetailModal()">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Modal Content -->
        <div class="p-8 space-y-8 overflow-y-auto max-h-[60vh]">
            <!-- Restaurant Quick Info -->
            <div class="flex gap-6 items-start">
                <div class="w-32 h-32 rounded-xl overflow-hidden bg-surface-container-highest flex-shrink-0 border border-outline-variant/10">
                    <img alt="Food" class="w-full h-full object-cover" id="modal-restaurant-img" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500"/>
                </div>
                <div class="grid grid-cols-2 gap-x-8 gap-y-4 flex-1">
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Nama Restoran</p>
                        <p class="font-headline-md text-brand-beige text-lg" id="modal-restaurant-name">Nama Restoran</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Pemilik</p>
                        <p class="font-body-md text-on-surface" id="modal-owner-name">Nama Pemilik</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Kategori</p>
                        <p class="font-label-md text-secondary uppercase text-xs font-semibold" id="modal-category">Kategori</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Tanggal Pengajuan</p>
                        <p class="font-body-md text-on-surface" id="modal-submit-date">Tanggal</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">Email</p>
                        <p class="font-body-md text-on-surface" id="modal-email">Email</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-widest mb-1">WhatsApp</p>
                        <p class="font-body-md text-on-surface" id="modal-whatsapp">WhatsApp</p>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div>
                <h4 class="font-label-md text-xs text-brand-beige font-bold uppercase tracking-widest mb-3">Deskripsi Bisnis</h4>
                <p class="text-sm text-on-surface-variant leading-relaxed" id="modal-description">Deskripsi</p>
            </div>

            <!-- Address & Maps -->
            <div>
                <h4 class="font-label-md text-xs text-brand-beige font-bold uppercase tracking-widest mb-2">Alamat & Lokasi</h4>
                <p class="text-sm text-on-surface-variant mb-2" id="modal-alamat">Alamat Lengkap</p>
                <div id="modal-maps-container">
                    <a class="inline-flex items-center gap-1.5 text-xs text-secondary hover:text-brand-beige transition-colors font-medium" href="#" id="modal-maps-link" target="_blank">
                        <span class="material-symbols-outlined text-[16px]">map</span>
                        Buka di Google Maps
                    </a>
                </div>
            </div>

            <!-- Jam Operasional -->
            <div>
                <h4 class="font-label-md text-xs text-brand-beige font-bold uppercase tracking-widest mb-2">Jam Operasional</h4>
                <div class="text-sm text-on-surface-variant space-y-1" id="modal-hours">
                    <!-- Jam operasional will be loaded here -->
                </div>
            </div>

            <!-- Documents Section -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-brand-beige text-[20px]">description</span>
                    <h4 class="font-label-md text-xs text-brand-beige font-bold uppercase tracking-widest">Dokumen Legalitas</h4>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-4 rounded-lg bg-surface-container-high/40 border border-outline-variant/10 group hover:border-brand-beige/20 transition-all">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-brand-beige/60">verified</span>
                            <div>
                                <span class="text-sm text-on-surface block font-medium">Sertifikat Halal</span>
                                <span class="text-xs text-on-surface-variant font-mono" id="modal-halal-number-text"></span>
                            </div>
                        </div>
                        <a class="text-xs font-label-md text-secondary hover:text-brand-beige flex items-center gap-1 transition-colors" href="#" id="modal-halal-link" target="_blank">
                            Lihat Berkas
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                    <div class="flex items-center justify-between p-4 rounded-lg bg-surface-container-high/40 border border-outline-variant/10 group hover:border-brand-beige/20 transition-all">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-brand-beige/60">badge</span>
                            <div>
                                <span class="text-sm text-on-surface block font-medium">NIB (Nomor Induk Berusaha)</span>
                                <span class="text-xs text-on-surface-variant font-mono" id="modal-nib-number-text"></span>
                            </div>
                        </div>
                        <a class="text-xs font-label-md text-secondary hover:text-brand-beige flex items-center gap-1 transition-colors" href="#" id="modal-nib-link" target="_blank">
                            Lihat Berkas
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="px-8 py-6 bg-surface-container-high/20 border-t border-outline-variant/10 flex gap-4">
            <form id="detail-reject-form" method="POST" action="" class="flex-1">
                @csrf
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="w-full py-3 px-6 rounded-lg border border-outline-variant/20 text-brand-beige font-label-md text-sm hover:bg-surface-container-high transition-all">
                    Tolak Pengajuan
                </button>
            </form>
            <form id="detail-approve-form" method="POST" action="" class="flex-1">
                @csrf
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="w-full py-3 px-6 rounded-lg bg-brand-maroon text-brand-beige font-label-md text-sm hover:brightness-110 shadow-lg transition-all">
                    Setujui Pendaftaran
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Confirm Verification Modal -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300" id="confirm-verification-modal">
    <div class="absolute inset-0 bg-background/80 backdrop-blur-sm" onclick="document.getElementById('confirm-verification-modal').classList.add('opacity-0', 'pointer-events-none')"></div>
    <div class="relative bg-surface-container-low border card-subtle-border rounded-xl w-full max-w-md overflow-hidden shadow-2xl flex flex-col">
        <div class="px-8 py-6 border-b border-outline-variant/10 flex justify-between items-center bg-surface-container-low">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-brand-beige">verified_user</span>
                <h3 class="font-headline-md text-brand-beige text-xl">Konfirmasi Verifikasi</h3>
            </div>
            <button class="p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-brand-beige transition-colors" onclick="document.getElementById('confirm-verification-modal').classList.add('opacity-0', 'pointer-events-none')">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-8 space-y-6">
            <div class="flex items-center gap-4 p-4 rounded-lg bg-surface-container-high/40 border border-outline-variant/10">
                <div class="w-16 h-16 rounded-lg overflow-hidden bg-surface-container-highest flex-shrink-0">
                    <img alt="Food" class="w-full h-full object-cover" id="confirm-modal-img" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=500"/>
                </div>
                <div>
                    <p class="font-label-md text-brand-beige text-sm" id="confirm-modal-title">Nama Restoran</p>
                    <p class="text-[11px] text-secondary font-medium uppercase tracking-wider" id="confirm-modal-cat">Kategori</p>
                </div>
            </div>
            <p class="text-xs text-on-surface-variant leading-relaxed">Tindakan ini akan mengaktifkan restoran di peta kuliner digital dan mengirimkan notifikasi resmi kepada pemilik.</p>
        </div>
        <div class="px-8 py-6 bg-surface-container-high/20 border-t border-outline-variant/10 flex gap-4">
            <button class="flex-1 py-3 px-6 rounded-lg border border-outline-variant/20 text-brand-beige font-label-md text-sm hover:bg-surface-container-high transition-all" onclick="document.getElementById('confirm-verification-modal').classList.add('opacity-0', 'pointer-events-none')">Batal</button>
            <form id="confirm-approve-form" method="POST" action="" class="flex-1">
                @csrf
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="w-full py-3 px-6 rounded-lg bg-brand-maroon text-brand-beige font-label-md text-sm hover:brightness-110 shadow-lg transition-all">Setujui &amp; Aktifkan</button>
            </form>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div class="fixed inset-0 z-[100] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-300" id="filter-modal">
    <div class="absolute inset-0 bg-background/80 backdrop-blur-sm" onclick="document.getElementById('filter-modal').classList.add('opacity-0', 'pointer-events-none')"></div>
    <div class="relative bg-surface-container-low border card-subtle-border rounded-xl w-full max-w-md overflow-hidden shadow-2xl flex flex-col">
        <div class="px-8 py-6 border-b border-outline-variant/10 flex justify-between items-center">
            <h3 class="font-headline-md text-brand-beige text-xl">Filter Antrean</h3>
            <button class="p-2 rounded-full hover:bg-surface-container-high text-on-surface-variant hover:text-brand-beige transition-colors" onclick="document.getElementById('filter-modal').classList.add('opacity-0', 'pointer-events-none')">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-8 space-y-8">
            <div>
                <h4 class="font-label-md text-xs text-on-surface-variant font-bold uppercase tracking-widest mb-4">Kategori Kuliner</h4>
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 rounded-full border border-outline-variant/20 text-xs font-medium text-on-surface hover:bg-brand-maroon hover:text-brand-beige transition-all">Pempek</button>
                    <button class="px-4 py-2 rounded-full border border-outline-variant/20 text-xs font-medium text-on-surface hover:bg-brand-maroon hover:text-brand-beige transition-all">Tekwan</button>
                    <button class="px-4 py-2 rounded-full border border-outline-variant/20 text-xs font-medium text-on-surface hover:bg-brand-maroon hover:text-brand-beige transition-all">Model</button>
                    <button class="px-4 py-2 rounded-full border border-outline-variant/20 text-xs font-medium text-on-surface hover:bg-brand-maroon hover:text-brand-beige transition-all">Laksan</button>
                    <button class="px-4 py-2 rounded-full border border-outline-variant/20 text-xs font-medium text-on-surface hover:bg-brand-maroon hover:text-brand-beige transition-all">Mie Celor</button>
                </div>
            </div>
        </div>
        <div class="px-8 py-6 bg-surface-container-high/20 border-t border-outline-variant/10 flex gap-4">
            <button class="flex-1 py-3 px-6 rounded-full border border-outline-variant/20 text-brand-beige font-label-md text-sm hover:bg-surface-container-high transition-all" onclick="document.getElementById('filter-modal').classList.add('opacity-0', 'pointer-events-none')">Atur Ulang</button>
            <button class="flex-1 py-3 px-6 rounded-full bg-brand-maroon text-brand-beige font-label-md text-sm hover:brightness-110 shadow-lg transition-all" onclick="document.getElementById('filter-modal').classList.add('opacity-0', 'pointer-events-none')">Terapkan Filter</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.btn-show-detail').forEach(btn => {
            btn.addEventListener('click', function() {
                const name = this.getAttribute('data-nama');
                const owner = this.getAttribute('data-pemilik');
                const category = this.getAttribute('data-kategori');
                const date = this.getAttribute('data-tanggal');
                const id = this.getAttribute('data-id');
                const imgSrc = this.getAttribute('data-img');
                const description = this.getAttribute('data-description');
                const mapsUrl = this.getAttribute('data-maps');
                const nibNum = this.getAttribute('data-nib-number');
                const halalNum = this.getAttribute('data-halal-number');
                const nibFile = this.getAttribute('data-nib-file');
                const halalFile = this.getAttribute('data-halal-file');
                const email = this.getAttribute('data-email');
                const whatsapp = this.getAttribute('data-whatsapp');
                const alamat = this.getAttribute('data-alamat');
                const hours = this.getAttribute('data-hours');
                showDetailModal(name, owner, category, date, id, imgSrc, description, mapsUrl, nibNum, halalNum, nibFile, halalFile, email, whatsapp, alamat, hours);
            });
        });

        document.querySelectorAll('.btn-show-confirm').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-nama');
                const category = this.getAttribute('data-kategori');
                const imgSrc = this.getAttribute('data-img');
                showConfirmModal(id, name, category, imgSrc);
            });
        });
    });

    function showDetailModal(name, owner, category, date, id, imgSrc, description, mapsUrl, nibNum, halalNum, nibFile, halalFile, email, whatsapp, alamat, hours) {
        const modal = document.getElementById('detail-listing-modal');
        
        // Populate modal data
        document.getElementById('modal-restaurant-name').textContent = name;
        document.getElementById('modal-owner-name').textContent = owner;
        document.getElementById('modal-category').textContent = category;
        document.getElementById('modal-submit-date').textContent = date;
        document.getElementById('modal-id-badge').textContent = 'ID: #' + id;
        document.getElementById('modal-restaurant-img').src = imgSrc;
        document.getElementById('modal-description').textContent = description || 'Tidak ada deskripsi.';
        document.getElementById('modal-halal-number-text').textContent = halalNum || 'Belum Diunggah';
        document.getElementById('modal-nib-number-text').textContent = nibNum || 'Belum Diunggah';
        document.getElementById('modal-email').textContent = email || '-';
        document.getElementById('modal-whatsapp').textContent = whatsapp || '-';
        document.getElementById('modal-alamat').textContent = alamat || '-';
        
        const mapsLink = document.getElementById('modal-maps-link');
        if (mapsUrl) {
            mapsLink.href = mapsUrl;
            document.getElementById('modal-maps-container').style.display = 'block';
        } else {
            document.getElementById('modal-maps-container').style.display = 'none';
        }

        // Parse operational hours
        const hoursContainer = document.getElementById('modal-hours');
        hoursContainer.innerHTML = '';
        if (hours) {
            try {
                const hoursObj = typeof hours === 'string' ? JSON.parse(hours) : hours;
                if (typeof hoursObj === 'object' && hoursObj !== null) {
                    for (const [day, time] of Object.entries(hoursObj)) {
                        const p = document.createElement('p');
                        p.className = 'text-xs text-on-surface-variant';
                        p.innerHTML = `<span class="font-medium text-on-surface">${day}:</span> ${time}`;
                        hoursContainer.appendChild(p);
                    }
                } else {
                    hoursContainer.textContent = hours;
                }
            } catch (e) {
                // If not JSON, display as raw string
                hoursContainer.textContent = hours;
            }
        } else {
            hoursContainer.textContent = 'Tidak ada data jam operasional.';
        }

        // Documents Links
        const halalLink = document.getElementById('modal-halal-link');
        const nibLink = document.getElementById('modal-nib-link');
        
        if (halalFile && halalFile !== '#') {
            halalLink.href = halalFile;
            halalLink.style.display = 'inline-flex';
        } else {
            halalLink.style.display = 'none';
        }

        if (nibFile && nibFile !== '#') {
            nibLink.href = nibFile;
            nibLink.style.display = 'inline-flex';
        } else {
            nibLink.style.display = 'none';
        }

        // Set form actions
        document.getElementById('detail-approve-form').action = '/dinas/verifikasi/' + id + '/status';
        document.getElementById('detail-reject-form').action = '/dinas/verifikasi/' + id + '/status';

        // Show modal
        modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    function closeDetailModal() {
        const modal = document.getElementById('detail-listing-modal');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

    function showConfirmModal(id, name, category, imgSrc) {
        const modal = document.getElementById('confirm-verification-modal');
        
        document.getElementById('confirm-modal-title').textContent = name;
        document.getElementById('confirm-modal-cat').textContent = category;
        document.getElementById('confirm-modal-img').src = imgSrc;
        
        document.getElementById('confirm-approve-form').action = '/dinas/verifikasi/' + id + '/status';

        modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    // Micro-interactions
    document.querySelectorAll('button, a').forEach(el => {
        el.addEventListener('mousedown', () => {
            el.classList.add('opacity-80', 'scale-[0.98]');
            setTimeout(() => el.classList.remove('opacity-80', 'scale-[0.98]'), 100);
        });
    });
</script>
@endsection