@forelse($menus as $menu)
    <div class="glass-card flex flex-col rounded-lg overflow-hidden border border-white/5 bg-surface-container-high/40 shadow-lg group hover:border-[#D9C5A0]/50 transition-all duration-300 animate-in fade-in duration-300">
        <div class="h-48 relative overflow-hidden bg-surface-container-lowest">
            <img alt="{{ $menu->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ $menu->photo ? asset('storage/' . $menu->photo) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400' }}">
            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3">
                <button onclick="previewMenu('{{ $menu->name }}', '{{ $menu->photo ? asset('storage/' . $menu->photo) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400' }}', '{{ $menu->category }}', '{{ number_format($menu->price, 0, ',', '.') }}', '{{ addslashes($menu->description) }}')" class="p-2.5 rounded-full bg-white/10 text-white hover:bg-[#5a0f16] hover:text-[#f5f0e6] transition-all duration-200" title="Preview">
                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                </button>
                <button onclick="confirmDeleteMenu({{ $menu->id }}, '{{ addslashes($menu->name) }}')" class="p-2.5 rounded-full bg-white/10 text-[#ffb4ab] hover:bg-[#5a0f16] hover:text-white transition-all duration-200" title="Hapus">
                    <span class="material-symbols-outlined text-[20px]">delete</span>
                </button>
            </div>
            <div class="absolute top-3 right-3">
                <span class="px-3 py-1 bg-black/70 text-[#D9C5A0] text-[10px] font-bold rounded-full border border-white/10 uppercase tracking-widest">{{ $menu->category }}</span>
            </div>
        </div>
        <div class="p-4 flex-1 flex flex-col justify-between">
            <div>
                <h4 class="font-bold text-white text-base mb-1 truncate">{{ $menu->name }}</h4>
                <p class="text-xs text-[#DBC0BE] line-clamp-2 mb-3 leading-relaxed">{{ $menu->description ?: 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="flex justify-between items-center pt-3 border-t border-white/5">
                <span class="text-sm font-bold text-[#D9C5A0]">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full py-16 text-center glass-card rounded-lg flex flex-col items-center justify-center">
        <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-3">restaurant</span>
        <p class="text-[#DBC0BE] text-base">Belum ada menu kuliner yang diunggah.</p>
    </div>
@endforelse
