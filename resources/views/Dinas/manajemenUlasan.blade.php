@extends('layouts.app')

@section('title', 'SMWKP | Manajemen Ulasan')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-64 p-margin-desktop bg-background min-h-screen">
    <header class="flex justify-between items-end mb-12">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-brand-beige mb-2">Manajemen Ulasan Pelanggan</h2>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-xl">Moderasi ulasan and tangani laporan konten negatif untuk menjaga kualitas data kuliner.</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-surface-container-high text-brand-beige px-5 py-2.5 rounded-lg font-label-md text-label-md flex items-center gap-2 border border-outline-variant/10 hover:bg-surface-container-highest transition-all">
                <span class="material-symbols-outlined text-[20px]">calendar_today</span>
                24 Mei 2024
            </button>
        </div>
    </header>

    <!-- Statistics Summary -->
    <section class="grid grid-cols-1 gap-6 mb-12 lg:grid-cols-3">
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Total Ulasan</p>
                <span class="material-symbols-outlined text-brand-beige/20 group-hover:text-brand-beige/50 transition-colors">reviews</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-brand-beige mb-2">{{ $totalReviews }}</h3>
            <p class="text-[12px] text-on-surface-variant flex items-center gap-1 font-medium">
                Ulasan keseluruhan dari wisatawan
            </p>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Laporan Masuk</p>
                <span class="material-symbols-outlined text-error/20 group-hover:text-error/50 transition-colors">report</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-error mb-2" id="reportedCount">{{ $reportedReviews }}</h3>
            <div class="flex items-center">
                <span class="text-[10px] font-bold text-error bg-error-container/20 px-2 py-0.5 rounded uppercase tracking-tighter">Butuh Tindakan</span>
            </div>
        </div>
        <div class="bg-surface-container-low p-6 rounded-xl card-subtle-border flex flex-col group hover:bg-surface-container transition-colors">
            <div class="flex justify-between items-start mb-4">
                <p class="font-label-md text-xs text-on-surface-variant uppercase tracking-widest">Rating Rata-rata</p>
                <span class="material-symbols-outlined text-brand-beige/20 group-hover:text-brand-beige/50 transition-colors">star</span>
            </div>
            <h3 class="font-display-lg text-display-lg text-brand-beige mb-2">{{ number_format($averageRating, 1) }}<span class="text-headline-md text-on-surface-variant font-normal">/5.0</span></h3>
            <p class="text-[12px] text-on-surface-variant font-medium">Skor kepuasan global</p>
        </div>
    </section>

    <!-- Review Table Section -->
    <section class="bg-surface-container-low rounded-xl card-subtle-border overflow-hidden">
        <div class="px-8 py-6 border-b border-outline-variant/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="font-headline-md text-headline-md text-brand-beige font-bold">Moderasi Konten</h3>
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search Input -->
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                    <input type="text" id="reviewSearch" placeholder="Cari ulasan, pengulas, resto..." class="bg-surface-container-high border-none rounded-lg pl-10 pr-4 py-2 text-xs text-on-surface w-64 focus:ring-1 focus:ring-brand-maroon outline-none transition-all">
                </div>
                <!-- Rating Filter -->
                <select id="ratingFilter" class="bg-surface-container-high border-none rounded-lg px-4 py-2 text-xs text-[#DBC0BE] focus:ring-1 focus:ring-brand-maroon outline-none">
                    <option value="all">Semua Rating</option>
                    <option value="5">5 Bintang</option>
                    <option value="4">4 Bintang</option>
                    <option value="3">3 Bintang</option>
                    <option value="2">2 Bintang</option>
                    <option value="1">1 Bintang</option>
                </select>
                <!-- Status Filter -->
                <select id="statusFilter" class="bg-surface-container-high border-none rounded-lg px-4 py-2 text-xs text-[#DBC0BE] focus:ring-1 focus:ring-brand-maroon outline-none">
                    <option value="all">Semua Status</option>
                    <option value="reported">Dilaporkan</option>
                    <option value="visible">Aktif (Visible)</option>
                    <option value="hidden">Disembunyikan</option>
                </select>
                <!-- Period Filter -->
                <select id="periodeFilter" class="bg-surface-container-high border-none rounded-lg px-4 py-2 text-xs text-[#DBC0BE] focus:ring-1 focus:ring-brand-maroon outline-none">
                    <option value="all">Semua Periode</option>
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                </select>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-outline-variant/5">
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Restoran &amp; Pengulas</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Konten Ulasan</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest">Laporan/Status</th>
                        <th class="px-8 py-4 font-label-md text-[11px] text-on-surface-variant uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5" id="reviewsTableBody">
                    @include('Dinas.partials.review_rows')
                </tbody>
            </table>
        </div>
        <!-- Load More Wrapper -->
        <div id="loadMoreWrapper" class="p-4 bg-surface-container/20 text-center border-t border-outline-variant/5 {{ $reviews->hasMorePages() ? '' : 'hidden' }}">
            <button id="loadMoreBtn" data-next-url="{{ $reviews->nextPageUrl() }}" class="text-xs font-label-md text-on-surface-variant hover:text-brand-beige transition-colors flex items-center justify-center gap-2 mx-auto cursor-pointer">
                Tampilkan ulasan lagi
                <span class="material-symbols-outlined text-[18px]">expand_more</span>
            </button>
        </div>
    </section>
</main>

<div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none" id="review-modal">
    <div class="bg-surface-container-low w-full max-w-lg rounded-xl card-subtle-border overflow-hidden transform transition-transform duration-300 scale-95">
        <!-- Modal Header -->
        <div class="px-6 py-4 border-b border-outline-variant/10 flex justify-between items-center bg-surface-container-high">
            <h3 class="font-headline-md text-brand-beige">Detail Laporan Ulasan</h3>
            <button class="text-on-surface-variant hover:text-brand-beige transition-colors cursor-pointer" onclick="closeReviewModal()">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="p-6 flex flex-col gap-6">
            <!-- Reviewer & Restaurant -->
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary-container/30 border border-primary/10 flex items-center justify-center text-brand-beige font-bold" id="modalUserInitials">
                        AP
                    </div>
                    <div>
                        <p class="font-label-md text-brand-beige" id="modalUserName">Andi Pratama</p>
                        <p class="text-xs text-on-surface-variant" id="modalReviewDate">23 Mei 2024 • 14:20 WIB</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[10px] uppercase tracking-widest text-on-surface-variant mb-1">Restoran</p>
                    <p class="font-label-md text-brand-beige" id="modalRestoName">Pempek Vico Premium</p>
                </div>
            </div>
            <!-- Rating & Content -->
            <div class="bg-surface-container/20 p-4 rounded-lg border border-outline-variant/5">
                <div class="flex gap-1 mb-3" id="modalRatingStars">
                    <!-- Dynamic Stars -->
                </div>
                <p class="text-sm text-on-surface italic leading-relaxed" id="modalComment">
                    "Cek profil saya untuk dapatkan voucher makan gratis 100rb..."
                </p>
            </div>
            <!-- Moderation Details -->
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col gap-1">
                    <p class="text-[10px] uppercase tracking-widest text-on-surface-variant">Tipe Laporan / Status</p>
                    <span class="text-[10px] font-bold px-2 py-1 rounded w-fit uppercase tracking-tighter" id="modalStatusBadge">SPAM</span>
                </div>
            </div>
        </div>
        <!-- Modal Footer -->
        <div class="px-6 py-4 bg-surface-container-high border-t border-outline-variant/10 flex justify-end gap-3">
            <button class="px-5 py-2 rounded-lg border border-outline-variant/20 text-brand-beige font-label-md text-sm hover:bg-surface-container-highest transition-all cursor-pointer" onclick="closeReviewModal()">
                Tutup
            </button>
            <button class="px-5 py-2 rounded-lg bg-brand-maroon text-brand-beige font-label-md text-sm hover:brightness-110 transition-all cursor-pointer" id="modalDeleteBtn">
                Hapus Ulasan
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let selectedRating = 'all';
        let selectedStatus = 'all';
        let selectedPeriode = 'all';
        let searchQuery = '';
        let debounceTimer;

        const tableBody = document.getElementById('reviewsTableBody');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const loadMoreWrapper = document.getElementById('loadMoreWrapper');
        const searchInput = document.getElementById('reviewSearch');
        const ratingFilter = document.getElementById('ratingFilter');
        const statusFilter = document.getElementById('statusFilter');
        const periodeFilter = document.getElementById('periodeFilter');

        const reviewModal = document.getElementById('review-modal');

        function fetchReviews(reset = false) {
            let url = reset ? '{{ route("dinas.ulasan") }}' : loadMoreBtn.getAttribute('data-next-url');
            if (!url && !reset) return;

            const queryParams = new URLSearchParams();
            if (selectedRating && selectedRating !== 'all') {
                queryParams.set('rating', selectedRating);
            }
            if (selectedStatus && selectedStatus !== 'all') {
                queryParams.set('status', selectedStatus);
            }
            if (selectedPeriode && selectedPeriode !== 'all') {
                queryParams.set('periode', selectedPeriode);
            }
            if (searchQuery) {
                queryParams.set('search', searchQuery);
            }
            if (!reset && url) {
                const pageMatch = url.match(/page=(\d+)/);
                if (pageMatch) queryParams.set('page', pageMatch[1]);
            }

            const fetchUrl = '{{ route("dinas.ulasan") }}?' + queryParams.toString();

            if (reset) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-brand-maroon mb-3"></div>
                                <p class="text-[#DBC0BE] text-xs">Memuat ulasan...</p>
                            </div>
                        </td>
                    </tr>
                `;
            }

            fetch(fetchUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (reset) {
                    tableBody.innerHTML = data.html;
                } else {
                    tableBody.insertAdjacentHTML('beforeend', data.html);
                }

                if (data.hasMore) {
                    loadMoreWrapper.classList.remove('hidden');
                    loadMoreBtn.setAttribute('data-next-url', data.nextPageUrl);
                } else {
                    loadMoreWrapper.classList.add('hidden');
                    loadMoreBtn.setAttribute('data-next-url', '');
                }
                bindRowActions();
            })
            .catch(err => {
                console.error(err);
                if (reset) {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-error text-xs">Gagal memuat ulasan.</td>
                        </tr>
                    `;
                }
            });
        }

        // Filters events
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                searchQuery = e.target.value.trim();
                debounceTimer = setTimeout(() => {
                    fetchReviews(true);
                }, 500);
            });
        }

        if (ratingFilter) {
            ratingFilter.addEventListener('change', (e) => {
                selectedRating = e.target.value;
                fetchReviews(true);
            });
        }

        if (statusFilter) {
            statusFilter.addEventListener('change', (e) => {
                selectedStatus = e.target.value;
                fetchReviews(true);
            });
        }

        if (periodeFilter) {
            periodeFilter.addEventListener('change', (e) => {
                selectedPeriode = e.target.value;
                fetchReviews(true);
            });
        }

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                fetchReviews(false);
            });
        }

        // Action binding for dynamically loaded rows
        function bindRowActions() {
            // Detail Button Click
            document.querySelectorAll('.detail-btn').forEach(btn => {
                btn.onclick = function() {
                    const id = this.getAttribute('data-id');
                    const user = this.getAttribute('data-user');
                    const resto = this.getAttribute('data-resto');
                    const comment = this.getAttribute('data-comment');
                    const rating = parseInt(this.getAttribute('data-rating'));
                    const status = this.getAttribute('data-status');
                    const date = this.getAttribute('data-date');

                    // Populate modal fields
                    document.getElementById('modalUserName').textContent = user;
                    document.getElementById('modalUserInitials').textContent = user.substring(0, 2).toUpperCase();
                    document.getElementById('modalReviewDate').textContent = date;
                    document.getElementById('modalRestoName').textContent = resto;
                    document.getElementById('modalComment').textContent = `"${comment}"`;

                    // Populate rating stars
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        starsHtml += `<span class="material-symbols-outlined text-[#FFD700] text-[18px] ${i <= rating ? 'fill' : ''}">star</span>`;
                    }
                    document.getElementById('modalRatingStars').innerHTML = starsHtml;

                    // Populate status badge
                    const badge = document.getElementById('modalStatusBadge');
                    badge.textContent = status === 'reported' ? 'Dilaporkan' : (status === 'hidden' ? 'Disembunyikan' : 'Aktif');
                    badge.className = 'text-[10px] font-bold px-2 py-1 rounded w-fit uppercase tracking-tighter ' +
                        (status === 'reported' ? 'bg-error-container/10 text-error border border-error/25' : 
                         (status === 'hidden' ? 'bg-amber-500/10 text-amber-500 border border-amber-500/25' : 'bg-secondary-container/20 text-secondary border border-secondary/25'));

                    // Bind delete button in modal
                    const modalDeleteBtn = document.getElementById('modalDeleteBtn');
                    modalDeleteBtn.onclick = function() {
                        closeReviewModal();
                        deleteReview(id);
                    };

                    openReviewModal();
                };
            });

            // Delete Button Click
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.onclick = function() {
                    const id = this.getAttribute('data-id');
                    deleteReview(id);
                };
            });
        }

        function openReviewModal() {
            reviewModal.classList.remove('opacity-0', 'pointer-events-none');
            reviewModal.firstElementChild.classList.remove('scale-95');
        }

        window.closeReviewModal = function() {
            reviewModal.classList.add('opacity-0', 'pointer-events-none');
            reviewModal.firstElementChild.classList.add('scale-95');
        }

        function deleteReview(id) {
            Swal.fire({
                title: 'Hapus Ulasan?',
                text: 'Apakah Anda yakin ingin menghapus ulasan ini secara permanen? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#5a0f16',
                cancelButtonColor: '#1a1c1c',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: '#121414',
                color: '#e2e2e2'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/dinas/ulasan/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: data.message,
                                background: '#121414',
                                color: '#e2e2e2',
                                confirmButtonColor: '#5a0f16'
                            });
                            // Remove row
                            const row = document.getElementById(`review-row-${id}`);
                            if (row) {
                                row.classList.add('transition-opacity', 'duration-300', 'opacity-0');
                                setTimeout(() => row.remove(), 300);
                            }
                            // Update statistics counts
                            const reportedCount = document.getElementById('reportedCount');
                            if (reportedCount) {
                                const current = parseInt(reportedCount.textContent);
                                if (current > 0) reportedCount.textContent = current - 1;
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Tidak dapat menghapus ulasan.',
                                background: '#121414',
                                color: '#e2e2e2'
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan sistem.',
                            background: '#121414',
                            color: '#e2e2e2'
                        });
                    });
                }
            });
        }

        // Micro-interactions
        document.querySelectorAll('button, a').forEach(el => {
            el.addEventListener('mousedown', () => {
                el.classList.add('opacity-80', 'scale-[0.98]');
                setTimeout(() => el.classList.remove('opacity-80', 'scale-[0.98]'), 100);
            });
        });

        // Bind initially loaded rows
        bindRowActions();
    });
</script>
@endsection
