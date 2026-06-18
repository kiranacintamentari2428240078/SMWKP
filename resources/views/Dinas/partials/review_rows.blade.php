@forelse($reviews as $rev)
<tr class="hover:bg-white/[0.02] transition-colors group animate-in fade-in duration-300" id="review-row-{{ $rev->id }}">
    <td class="px-8 py-5">
        <div class="flex flex-col gap-1">
            <p class="font-label-md text-brand-beige text-sm">{{ $rev->restaurant->nama_restoran ?? 'Restoran Terhapus' }}</p>
            <p class="text-xs text-on-surface-variant">Oleh: {{ $rev->user->name ?? 'Wisatawan' }}</p>
        </div>
    </td>
    <td class="px-8 py-5">
        <div class="max-w-xs">
            <div class="flex text-[#FFD700] mb-1">
                @for($i = 1; $i <= 5; $i++)
                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }};">star</span>
                @endfor
            </div>
            <p class="text-xs text-on-surface italic line-clamp-2">"{{ $rev->comment }}"</p>
        </div>
    </td>
    <td class="px-8 py-5">
        <div class="flex flex-col gap-1">
            @if($rev->status === 'reported')
                <span class="text-[10px] font-bold text-error bg-error-container/10 px-2 py-0.5 rounded w-fit uppercase tracking-tighter border border-error/25">Dilaporkan</span>
            @elseif($rev->status === 'hidden')
                <span class="text-[10px] font-bold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded w-fit uppercase tracking-tighter border border-amber-500/25">Disembunyikan</span>
            @else
                <span class="text-[10px] font-bold text-secondary bg-secondary-container/20 px-2 py-0.5 rounded w-fit uppercase tracking-tighter border border-secondary/25">Aktif</span>
            @endif
            <span class="text-[9px] text-on-surface-variant uppercase">{{ $rev->created_at->format('d M Y H:i') }}</span>
        </div>
    </td>
    <td class="px-8 py-5 text-right">
        <div class="flex justify-end gap-3">
            <button class="p-2 rounded-lg bg-surface-container-high text-brand-beige hover:bg-surface-container-highest transition-all detail-btn" 
                    data-id="{{ $rev->id }}"
                    data-user="{{ $rev->user->name ?? 'Wisatawan' }}"
                    data-resto="{{ $rev->restaurant->nama_restoran ?? 'Restoran Terhapus' }}"
                    data-comment="{{ $rev->comment }}"
                    data-rating="{{ $rev->rating }}"
                    data-status="{{ $rev->status }}"
                    data-date="{{ $rev->created_at->format('d M Y • H:i') }} WIB"
                    title="Detail">
                <span class="material-symbols-outlined text-[20px]">visibility</span>
            </button>
            <button class="p-2 rounded-lg bg-error-container/20 text-error hover:bg-error hover:text-on-error transition-all delete-btn" 
                    data-id="{{ $rev->id }}"
                    title="Hapus">
                <span class="material-symbols-outlined text-[20px]">delete</span>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="px-8 py-10 text-center text-on-surface-variant">Tidak ada ulasan ditemukan.</td>
</tr>
@endforelse
