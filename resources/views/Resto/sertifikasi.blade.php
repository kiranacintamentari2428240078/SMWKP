@extends('layouts.app')

@section('title', 'Sertifikasi | SMWKP Admin Portal')

@section('body_content')
<!-- Include Dynamic Sidebar -->
@include('partials.sidebar')

<!-- Top Navigation Shell -->
<header class="fixed top-0 right-0 left-72 z-30 flex justify-between items-center px-margin-desktop py-4 bg-surface/80 backdrop-blur-xl shadow-sm border-b border-outline-variant/5 text-[#D9C5A0]">
    <div class="flex-1 flex justify-center"></div>
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="font-label-md text-on-surface font-bold text-[#D9C5A0]">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-on-surface-variant tracking-wider uppercase text-[#DBC0BE]">{{ $restaurant->nama_restoran }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-primary-container/30 border border-primary/20 flex items-center justify-center text-primary font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
        </div>
    </div>
</header>

<!-- Main Content Canvas -->
<main class="ml-72 mt-20 p-margin-desktop h-[calc(100vh-80px)] overflow-y-auto">
    <!-- Header Section -->
    <section class="mb-12 flex justify-between items-end">
        <div class="max-w-2xl">
            <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2 text-[#D9C5A0] font-bold">Manajemen Sertifikasi &amp; Legalitas</h2>
            <p class="text-on-surface-variant font-body-md leading-relaxed text-[#DBC0BE]">
                Kelola dokumen resmi NIB dan Sertifikasi Halal Anda. Pastikan berkas yang diunggah valid dan terbaca agar disetujui oleh admin Dinas Pariwisata.
            </p>
        </div>
        <button class="bg-[#5a0f16] text-[#f5f0e6] border border-primary/20 px-6 py-3 rounded-lg flex items-center gap-2 hover:scale-[1.02] transition-all text-xs font-bold whitespace-nowrap" onclick="document.getElementById('upload-modal').classList.remove('hidden')">
            <span class="material-symbols-outlined">add_circle</span>
            PERBARUI LEGALITAS / DOKUMEN
        </button>
    </section>

    <!-- Bento Grid for Certification Status -->
    <div class="grid grid-cols-12 gap-gutter mb-12">
        <!-- Card: Halal Certification -->
        <div class="col-span-12 lg:col-span-6 glass-panel p-8 rounded-lg relative overflow-hidden group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-surface-container-high rounded-2xl flex items-center justify-center border border-outline-variant/30">
                    <span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">verified</span>
                </div>
                @if($restaurant->halal_certificate_file)
                    <span class="px-3 py-1 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold rounded-full tracking-wide">TERSEDIA</span>
                @else
                    <span class="px-3 py-1 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold rounded-full tracking-wide">BELUM UNGGAH</span>
                @endif
            </div>
            <h3 class="font-headline-md text-headline-md text-[#D9C5A0] mb-1 font-bold">Sertifikat Halal</h3>
            <p class="text-on-surface-variant text-sm mb-6 text-[#DBC0BE]">BPJPH Kemenag RI / LPPOM MUI</p>
            <div class="space-y-4">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-on-surface-variant text-[#DBC0BE]">Nomor Registrasi:</span>
                    <span class="text-on-surface font-mono text-white">{{ $restaurant->halal_certificate_number ?? 'Belum diatur' }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-on-surface-variant text-[#DBC0BE]">Masa Berlaku:</span>
                    <span class="text-on-surface text-white">Seumur Hidup / Sesuai Dokumen</span>
                </div>
            </div>
            <div class="mt-8 flex gap-3">
                @if($restaurant->halal_certificate_file)
                    <a href="{{ asset('storage/' . $restaurant->halal_certificate_file) }}" target="_blank" class="flex-grow py-3 bg-surface-container-highest hover:bg-surface-bright transition-colors rounded-lg text-xs font-bold tracking-widest flex items-center justify-center gap-2 text-white text-center px-4">
                        <span class="material-symbols-outlined text-sm">visibility</span> LIHAT DOKUMEN
                    </a>
                @else
                    <button disabled class="flex-grow py-3 bg-surface-container-highest opacity-50 rounded-lg text-xs font-bold tracking-widest flex items-center justify-center gap-2 text-white px-4 cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">warning</span> DOKUMEN KOSONG
                    </button>
                @endif
                <button class="p-3 bg-surface-container-highest hover:bg-surface-bright transition-colors rounded-lg text-white" onclick="document.getElementById('upload-modal').classList.remove('hidden')">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </button>
            </div>
        </div>

        <!-- Card: NIB -->
        <div class="col-span-12 lg:col-span-6 glass-panel p-8 rounded-lg relative overflow-hidden group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-surface-container-high rounded-2xl flex items-center justify-center border border-outline-variant/30">
                    <span class="material-symbols-outlined text-primary text-3xl">business_center</span>
                </div>
                @if($restaurant->nib_file)
                    @if($restaurant->status === 'approved')
                        <span class="px-3 py-1 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold rounded-full tracking-wide">TERVERIFIKASI</span>
                    @else
                        <span class="px-3 py-1 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs font-bold rounded-full tracking-wide">PROSES TINJAUAN</span>
                    @endif
                @else
                    <span class="px-3 py-1 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold rounded-full tracking-wide">BELUM UNGGAH</span>
                @endif
            </div>
            <h3 class="font-headline-md text-headline-md text-[#D9C5A0] mb-1 font-bold">Izin Usaha (NIB)</h3>
            <p class="text-on-surface-variant text-sm mb-6 text-[#DBC0BE]">OSS - BKPM Republik Indonesia</p>
            <div class="space-y-4">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-on-surface-variant text-[#DBC0BE]">Nomor Induk Berusaha:</span>
                    <span class="text-on-surface font-mono text-white">{{ $restaurant->nib_number ?? 'Belum diatur' }}</span>
                </div>
                <div class="flex justify-between items-center text-sm">
                    <span class="text-on-surface-variant text-[#DBC0BE]">Status Usaha:</span>
                    <span class="text-on-surface text-white">Mikro / Menengah</span>
                </div>
            </div>
            <div class="mt-8 flex gap-3">
                @if($restaurant->nib_file)
                    <a href="{{ asset('storage/' . $restaurant->nib_file) }}" target="_blank" class="flex-grow py-3 bg-surface-container-highest hover:bg-surface-bright transition-colors rounded-lg text-xs font-bold tracking-widest flex items-center justify-center gap-2 text-white text-center px-4">
                        <span class="material-symbols-outlined text-sm">visibility</span> LIHAT DOKUMEN
                    </a>
                @else
                    <button disabled class="flex-grow py-3 bg-surface-container-highest opacity-50 rounded-lg text-xs font-bold tracking-widest flex items-center justify-center gap-2 text-white px-4 cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">warning</span> DOKUMEN KOSONG
                    </button>
                @endif
                <button class="p-3 bg-surface-container-highest hover:bg-surface-bright transition-colors rounded-lg text-white" onclick="document.getElementById('upload-modal').classList.remove('hidden')">
                    <span class="material-symbols-outlined text-sm">edit</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Riwayat Section -->
    <section class="mt-8">
        <h3 class="font-headline-md text-headline-md text-[#D9C5A0] mb-6 font-bold">Status Berkas legalitas</h3>
        <div class="glass-panel overflow-hidden rounded-lg">
            <table class="w-full text-left">
                <thead class="bg-surface-container-high">
                    <tr>
                        <th class="px-6 py-4 font-label-md text-on-surface-variant uppercase text-[10px] tracking-widest text-[#D DBC0BE]">Jenis Dokumen</th>
                        <th class="px-6 py-4 font-label-md text-on-surface-variant uppercase text-[10px] tracking-widest text-[#DBC0BE]">Nomor Registrasi</th>
                        <th class="px-6 py-4 font-label-md text-on-surface-variant uppercase text-[10px] tracking-widest text-[#DBC0BE]">Status Berkas</th>
                        <th class="px-6 py-4 font-label-md text-on-surface-variant uppercase text-[10px] tracking-widest text-right text-[#DBC0BE]">Berkas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary/10 rounded flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">description</span>
                                </div>
                                <p class="font-body-md text-on-surface font-semibold text-white">Nomor Induk Berusaha (NIB)</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm text-[#DBC0BE] font-mono">{{ $restaurant->nib_number ?? 'Belum diisi' }}</td>
                        <td class="px-6 py-5">
                            @if($restaurant->nib_file)
                                <span class="px-2 py-0.5 bg-green-500/10 text-green-400 text-[10px] font-bold rounded border border-green-500/20">TER-UNGGAH</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-500/10 text-red-400 text-[10px] font-bold rounded border border-red-500/20">KOSONG</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            @if($restaurant->nib_file)
                                <a href="{{ asset('storage/' . $restaurant->nib_file) }}" download target="_blank" class="p-2 text-primary hover:text-white transition-colors" title="Download">
                                    <span class="material-symbols-outlined">download</span>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary/10 rounded flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">verified_user</span>
                                </div>
                                <p class="font-body-md text-on-surface font-semibold text-white">Sertifikat Halal</p>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm text-[#DBC0BE] font-mono">{{ $restaurant->halal_certificate_number ?? 'Belum diisi' }}</td>
                        <td class="px-6 py-5">
                            @if($restaurant->halal_certificate_file)
                                <span class="px-2 py-0.5 bg-green-500/10 text-green-400 text-[10px] font-bold rounded border border-green-500/20">TER-UNGGAH</span>
                            @else
                                <span class="px-2 py-0.5 bg-red-500/10 text-red-400 text-[10px] font-bold rounded border border-red-500/20">KOSONG</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            @if($restaurant->halal_certificate_file)
                                <a href="{{ asset('storage/' . $restaurant->halal_certificate_file) }}" download target="_blank" class="p-2 text-primary hover:text-white transition-colors" title="Download">
                                    <span class="material-symbols-outlined">download</span>
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Upload Modal -->
<div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="upload-modal">
    <div class="absolute inset-0 bg-background/80 backdrop-blur-md" onclick="document.getElementById('upload-modal').classList.add('hidden')"></div>
    <form action="{{ route('resto.certification.upload') }}" method="POST" enctype="multipart/form-data" class="relative glass-panel w-full max-w-xl rounded-xl overflow-hidden shadow-2xl border border-primary/20 bg-surface-container-high/90">
        @csrf
        <div class="p-8 border-b border-outline-variant/10 flex justify-between items-center bg-surface-container-highest/40">
            <h4 class="font-headline-md text-headline-md text-on-surface text-[#D9C5A0] font-bold">Perbarui Berkas Legalitas</h4>
            <button type="button" class="text-on-surface-variant hover:text-on-surface transition-colors" onclick="document.getElementById('upload-modal').classList.add('hidden')">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="p-8 space-y-6">
            <!-- NIB Number & File -->
            <div class="p-4 rounded-lg bg-surface-container-low border border-white/5 space-y-4">
                <h5 class="text-[#D9C5A0] font-semibold text-sm">Dokumen NIB (Nomor Induk Berusaha)</h5>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest text-[#DBC0BE]">Nomor NIB</label>
                    <input name="nib_number" class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-3 text-on-surface focus:ring-1 focus:ring-primary focus:border-primary text-sm" placeholder="Masukkan nomor NIB 13 digit" type="text" value="{{ old('nib_number', $restaurant->nib_number) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest text-[#DBC0BE]">Unggah Berkas NIB (PDF/JPG/PNG)</label>
                    <input name="nib_file" class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-2 text-on-surface focus:ring-1 focus:ring-primary focus:border-primary text-sm" type="file">
                </div>
            </div>

            <!-- Halal Number & File -->
            <div class="p-4 rounded-lg bg-surface-container-low border border-white/5 space-y-4">
                <h5 class="text-[#D9C5A0] font-semibold text-sm">Dokumen Sertifikasi Halal</h5>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest text-[#DBC0BE]">Nomor Sertifikat Halal</label>
                    <input name="halal_certificate_number" class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-3 text-on-surface focus:ring-1 focus:ring-primary focus:border-primary text-sm" placeholder="Masukkan nomor sertifikat" type="text" value="{{ old('halal_certificate_number', $restaurant->halal_certificate_number) }}">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-on-surface-variant uppercase tracking-widest text-[#DBC0BE]">Unggah Berkas Halal (PDF/JPG/PNG)</label>
                    <input name="halal_certificate_file" class="w-full bg-surface-container-lowest border border-outline-variant/20 rounded-lg p-2 text-on-surface focus:ring-1 focus:ring-primary focus:border-primary text-sm" type="file">
                </div>
            </div>

            <div class="mt-8 flex items-center justify-end gap-6">
                <button type="button" class="text-sm font-bold tracking-widest text-on-surface-variant hover:text-on-surface transition-colors" onclick="document.getElementById('upload-modal').classList.add('hidden')">BATAL</button>
                <button type="submit" class="bg-[#5a0f16] text-[#f5f0e6] px-8 py-3 rounded-full font-bold text-sm hover:brightness-110 transition-all border border-primary/30">UNGGAH SEKARANG</button>
            </div>
        </div>
    </form>
</div>

<!-- Background Decoration -->
<div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 opacity-30 overflow-hidden">
    <div class="absolute -top-[20%] -right-[10%] w-[60%] h-[80%] bg-primary/10 blur-[150px] rounded-full"></div>
    <div class="absolute -bottom-[10%] -left-[5%] w-[40%] h-[60%] bg-primary/5 blur-[120px] rounded-full"></div>
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#E5D9C3 0.5px, transparent 0.5px); background-size: 24px 24px;"></div>
</div>
@endsection

@section('scripts')
<script>
    // Hover animations for cards
    const cards = document.querySelectorAll('.glass-panel');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
            card.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection
