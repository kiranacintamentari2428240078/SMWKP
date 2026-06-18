@extends('layouts.app')

@section('title', 'Galeri Menu - SMWKP Admin')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Main Content Canvas -->
<main class="ml-72 min-h-screen relative bg-background">
    <!-- Top Navigation Bar -->
    <header class="fixed top-0 right-0 left-72 z-30 flex justify-between items-center px-margin-desktop py-4 bg-surface/80 backdrop-blur-xl shadow-sm border-b border-white/5 text-[#D9C5A0]">
        <div>
            <h2 class="text-[#D9C5A0] font-semibold text-lg">Manajemen Menu Kuliner</h2>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="font-label-md text-label-md font-bold text-on-surface text-[#D9C5A0]">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-primary uppercase font-bold tracking-tighter text-[#DBC0BE]">{{ $restaurant->nama_restoran }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-primary-container/30 border border-primary/20 flex items-center justify-center text-primary font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <div class="pt-28 pb-12 px-margin-desktop max-w-container-max mx-auto">
        <!-- Header Actions -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h3 class="font-headline-lg text-headline-lg mb-2 text-[#D9C5A0] font-bold">Daftar Menu &amp; Foto Kuliner</h3>
                <p class="text-on-surface-variant max-w-lg text-[#DBC0BE]">Kelola menu makanan dan minuman Anda secara realtime. Pelanggan dapat melihat menu ini secara langsung pada halaman detail restoran Anda.</p>
            </div>
            <button onclick="toggleModal()" class="bg-[#5a0f16] text-[#f5f0e6] px-8 py-4 rounded-full flex items-center gap-3 transition-all hover:scale-105 shadow-lg border border-primary/30 font-bold">
                <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">add_a_photo</span>
                <span class="font-label-md text-label-md text-white">Unggah Menu Baru</span>
            </button>
        </div>

        <!-- Filter Chips & Search Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <!-- Category Chips -->
            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-none" id="categoryChips">
                <button data-category="all" class="category-chip px-5 py-2 rounded-full font-label-md text-xs font-bold transition-all bg-primary text-on-primary border border-primary/30">Semua</button>
                @foreach($categories as $cat)
                    <button data-category="{{ $cat }}" class="category-chip px-5 py-2 rounded-full font-label-md text-xs font-bold transition-all bg-surface-container-high/40 text-on-surface-variant hover:bg-surface-container-high border border-white/5">{{ $cat }}</button>
                @endforeach
            </div>
            <!-- Search Input -->
            <div class="relative w-full md:w-80">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[18px]">search</span>
                <input type="text" id="menuSearchInput" placeholder="Cari hidangan..." class="w-full bg-surface-container-high border border-white/10 rounded-full pl-10 pr-4 py-2.5 text-xs text-on-surface focus:outline-none focus:border-[#D9C5A0] transition-colors">
            </div>
        </div>

        <!-- Dynamic Menu Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="menuGrid">
            @include('Resto.partials.menu_cards')
        </div>

        <!-- Load More Wrapper -->
        <div id="loadMoreWrapper" class="mt-12 flex justify-center {{ $menus->hasMorePages() ? '' : 'hidden' }}">
            <button id="loadMoreBtn" data-next-url="{{ $menus->nextPageUrl() }}" class="px-8 py-3 bg-surface-container-highest hover:bg-surface-bright border border-white/10 rounded-full text-xs font-bold text-white tracking-widest transition-all hover:scale-105">
                MUAT LEBIH BANYAK
            </button>
        </div>
    </div>
</main>

<!-- Upload Modal (Hidden by default) -->
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-md hidden" id="uploadModal">
    <form action="{{ route('resto.menu.store') }}" method="POST" enctype="multipart/form-data" class="glass-card w-full max-w-2xl p-10 rounded-lg bg-surface-container-high/95 border border-white/10 shadow-2xl">
        @csrf
        <div class="flex justify-between items-center mb-8">
            <h3 class="font-headline-md text-headline-md text-[#D9C5A0] font-bold">Unggah Item Menu Baru</h3>
            <button type="button" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-white/10 transition-colors" onclick="toggleModal()">
                <span class="material-symbols-outlined text-on-surface">close</span>
            </button>
        </div>
        <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-label-md font-bold text-[#DBC0BE] mb-2">Nama Hidangan / Menu</label>
                    <input name="name" required class="w-full bg-surface-container-low border border-white/10 rounded-lg p-3 text-white focus:ring-1 focus:ring-[#D9C5A0]" placeholder="Contoh: Pempek Lenjer Jumbo" type="text">
                </div>
                <div>
                    <label class="block text-label-md font-bold text-[#DBC0BE] mb-2">Harga (Rupiah)</label>
                    <input name="price" required class="w-full bg-surface-container-low border border-white/10 rounded-lg p-3 text-white focus:ring-1 focus:ring-[#D9C5A0]" placeholder="Contoh: 15000" type="number" min="0">
                </div>
                <div>
                    <label class="block text-label-md font-bold text-[#DBC0BE] mb-2">Kategori Menu</label>
                    <select name="category" id="categorySelect" required class="w-full bg-surface-container-low border border-white/10 rounded-lg p-3 text-white focus:ring-1 focus:ring-[#D9C5A0]">
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="custom">Lainnya (Tulis Sendiri...)</option>
                    </select>
                </div>
            </div>
            <div id="customCategoryContainer" class="hidden">
                <label class="block text-label-md font-bold text-[#DBC0BE] mb-2">Kategori Baru / Kustom</label>
                <input name="custom_category" id="customCategoryInput" class="w-full bg-surface-container-low border border-white/10 rounded-lg p-3 text-white focus:ring-1 focus:ring-[#D9C5A0]" placeholder="Contoh: Pempek, Laksan, Es Campur" type="text">
            </div>
            <div>
                <label class="block text-label-md font-bold text-[#DBC0BE] mb-2">Deskripsi Hidangan</label>
                <textarea name="description" class="w-full bg-surface-container-low border border-white/10 rounded-lg p-3 text-white focus:ring-1 focus:ring-[#D9C5A0] h-24" placeholder="Jelaskan bahan-bahan, cita rasa, porsi, atau keunikan menu..."></textarea>
            </div>
            <div>
                <label class="block text-label-md font-bold text-[#DBC0BE] mb-2">Foto Hidangan (Maks 2MB)</label>
                <input name="photo" class="w-full bg-surface-container-low border border-white/10 rounded-lg p-3 text-white focus:ring-1 focus:ring-[#D9C5A0]" type="file">
            </div>
        </div>
        <div class="mt-10 flex gap-4">
            <button type="button" class="flex-grow py-4 rounded-full border border-white/10 text-on-surface hover:bg-surface-container-highest transition-all font-bold" onclick="toggleModal()">Batal</button>
            <button type="submit" class="flex-grow bg-[#5a0f16] text-[#f5f0e6] py-4 rounded-full font-bold shadow-lg border border-primary/30">Simpan Menu</button>
        </div>
    </form>
</div>

<!-- Preview Menu Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 backdrop-blur-md hidden" id="previewMenuModal">
    <div class="relative bg-[#1a1a1a] border border-white/10 rounded-xl w-full max-w-lg overflow-hidden shadow-2xl flex flex-col p-6 m-4 text-[#D9C5A0]">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-headline-md text-brand-beige text-xl font-bold" id="preview-menu-title">Detail Menu</h3>
            <button class="p-2 rounded-full hover:bg-white/10 text-on-surface-variant hover:text-[#D9C5A0] transition-colors" onclick="closePreviewModal()">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="w-full h-64 rounded-lg overflow-hidden bg-surface-container-highest mb-6 border border-white/5">
            <img alt="Menu" class="w-full h-full object-cover" id="preview-menu-img" src=""/>
        </div>
        <div class="space-y-4">
            <div class="flex justify-between items-baseline">
                <span class="px-3 py-1 bg-[#5a0f16]/30 text-[#D9C5A0] text-[10px] font-bold rounded-full border border-[#5a0f16]/40 uppercase tracking-widest" id="preview-menu-cat">Kategori</span>
                <span class="font-bold text-lg text-white" id="preview-menu-price">Rp 0</span>
            </div>
            <div>
                <h4 class="text-xs text-[#DBC0BE] uppercase tracking-wider font-semibold mb-1">Deskripsi Hidangan</h4>
                <p class="text-sm text-on-surface-variant leading-relaxed" id="preview-menu-desc">Deskripsi</p>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/85 backdrop-blur-md hidden" id="deleteMenuModal">
    <div class="relative bg-[#1a1a1a] border border-white/10 rounded-xl w-full max-w-md overflow-hidden shadow-2xl flex flex-col p-8 text-[#D9C5A0]">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-headline-md text-xl font-bold text-[#ffb4ab]">Hapus Menu</h3>
            <button class="p-2 rounded-full hover:bg-white/10 text-on-surface-variant hover:text-[#D9C5A0] transition-colors" onclick="closeDeleteModal()">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <p class="text-sm text-[#DBC0BE] mb-6 leading-relaxed">
            Apakah Anda yakin ingin menghapus menu <strong class="text-white" id="delete-menu-name"></strong>? Tindakan ini permanen dan tidak dapat dibatalkan.
        </p>
        <div class="flex gap-4">
            <button class="flex-1 py-3 px-6 rounded-full border border-white/10 text-white hover:bg-white/5 transition-all font-bold animate-active" onclick="closeDeleteModal()">Batal</button>
            <form id="delete-menu-form" method="POST" action="" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full py-3 px-6 rounded-full bg-[#5a0f16] text-[#f5f0e6] font-bold hover:brightness-110 shadow-lg border border-primary/30 transition-all">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const modal = document.getElementById('uploadModal');
    
    function toggleModal() {
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
        } else {
            modal.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const categorySelect = document.getElementById('categorySelect');
        const customCategoryContainer = document.getElementById('customCategoryContainer');
        const customCategoryInput = document.getElementById('customCategoryInput');

        if (categorySelect && customCategoryContainer && customCategoryInput) {
            categorySelect.addEventListener('change', function() {
                if (this.value === 'custom') {
                    customCategoryContainer.classList.remove('hidden');
                    customCategoryInput.required = true;
                } else {
                    customCategoryContainer.classList.add('hidden');
                    customCategoryInput.required = false;
                    customCategoryInput.value = '';
                }
            });
        }

        // Dynamic search & filter logic
        let selectedCategory = 'all';
        let searchQuery = '';
        let debounceTimer;

        const menuGrid = document.getElementById('menuGrid');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const loadMoreWrapper = document.getElementById('loadMoreWrapper');
        const searchInput = document.getElementById('menuSearchInput');
        const chips = document.querySelectorAll('.category-chip');

        function fetchMenus(reset = false) {
            let url = reset ? '{{ route("resto.galeri") }}' : loadMoreBtn.getAttribute('data-next-url');
            if (!url && !reset) return;

            // Build query params
            const queryParams = new URLSearchParams();
            if (selectedCategory && selectedCategory !== 'all') {
                queryParams.set('category', selectedCategory);
            }
            if (searchQuery) {
                queryParams.set('search', searchQuery);
            }
            if (!reset && url) {
                // If appending, preserve the page number from page url
                const pageMatch = url.match(/page=(\d+)/);
                if (pageMatch) queryParams.set('page', pageMatch[1]);
            }

            const fetchUrl = '{{ route("resto.galeri") }}?' + queryParams.toString();

            if (reset) {
                menuGrid.innerHTML = `
                    <div class="col-span-full py-16 text-center flex flex-col items-center justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#D9C5A0] mb-3"></div>
                        <p class="text-[#DBC0BE] text-sm">Memuat menu...</p>
                    </div>
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
                    menuGrid.innerHTML = data.html;
                } else {
                    // Append
                    menuGrid.insertAdjacentHTML('beforeend', data.html);
                }

                if (data.hasMore) {
                    loadMoreWrapper.classList.remove('hidden');
                    loadMoreBtn.setAttribute('data-next-url', data.nextPageUrl);
                } else {
                    loadMoreWrapper.classList.add('hidden');
                    loadMoreBtn.setAttribute('data-next-url', '');
                }
            })
            .catch(err => {
                console.error(err);
                if (reset) {
                    menuGrid.innerHTML = `
                        <div class="col-span-full py-16 text-center">
                            <p class="text-error text-sm">Gagal memuat menu. Silakan coba lagi.</p>
                        </div>
                    `;
                }
            });
        }

        // Search debounce
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(debounceTimer);
                searchQuery = e.target.value.trim();
                debounceTimer = setTimeout(() => {
                    fetchMenus(true);
                }, 500);
            });
        }

        // Chip selection
        chips.forEach(chip => {
            chip.addEventListener('click', function() {
                chips.forEach(c => {
                    c.classList.remove('bg-primary', 'text-on-primary', 'border-primary/30');
                    c.classList.add('bg-surface-container-high/40', 'text-on-surface-variant', 'border-white/5');
                });
                this.classList.add('bg-primary', 'text-on-primary', 'border-primary/30');
                this.classList.remove('bg-surface-container-high/40', 'text-on-surface-variant', 'border-white/5');

                selectedCategory = this.getAttribute('data-category');
                fetchMenus(true);
            });
        });

        // Load More button
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => {
                fetchMenus(false);
            });
        }
    });

    function previewMenu(name, imgSrc, category, price, desc) {
        document.getElementById('preview-menu-title').textContent = name;
        document.getElementById('preview-menu-img').src = imgSrc;
        document.getElementById('preview-menu-cat').textContent = category;
        document.getElementById('preview-menu-price').textContent = 'Rp ' + price;
        document.getElementById('preview-menu-desc').textContent = desc || 'Tidak ada deskripsi.';
        document.getElementById('previewMenuModal').classList.remove('hidden');
    }
    
    function closePreviewModal() {
        document.getElementById('previewMenuModal').classList.add('hidden');
    }
    
    function confirmDeleteMenu(id, name) {
        document.getElementById('delete-menu-name').textContent = name;
        document.getElementById('delete-menu-form').action = '/resto/menu/' + id;
        document.getElementById('deleteMenuModal').classList.remove('hidden');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteMenuModal').classList.add('hidden');
    }
</script>
@endsection
