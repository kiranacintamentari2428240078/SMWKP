@auth
    @if(Auth::user()->isAdminDinas())
        <!-- Dinas SideNavBar -->
        <aside class="fixed left-0 top-0 h-full flex flex-col py-8 bg-surface-container-lowest w-64 z-50 border-r border-outline-variant/10">
            <div class="px-6 mb-12">
                <div class="font-headline-md font-bold text-brand-beige">SMWKP&nbsp;<br><span style="font-weight: normal; font-size: 14px;">Dinas Pariwisata</span></div>
            </div>
            <nav class="flex-1 flex flex-col gap-1 px-3">
                <a class="{{ Request::routeIs('dinas.dashboard') ? 'sidebar-active' : 'text-on-surface-variant' }} rounded-lg px-4 py-3 flex items-center gap-3 transition-all hover:bg-surface-container-high" href="{{ route('dinas.dashboard') }}">
                    <span class="material-symbols-outlined fill">dashboard</span>
                    <span class="font-label-md text-label-md">Dashboard</span>
                </a>
                <a class="{{ Request::routeIs('dinas.verifikasi') ? 'sidebar-active' : 'text-on-surface-variant' }} rounded-lg px-4 py-3 flex items-center gap-3 transition-all hover:bg-surface-container-high" href="{{ route('dinas.verifikasi') }}">
                    <span class="material-symbols-outlined">restaurant_menu</span>
                    <span class="font-label-md text-label-md">Verifikasi Listing</span>
                </a>
                <a class="{{ Request::routeIs('dinas.ulasan') ? 'sidebar-active' : 'text-on-surface-variant' }} rounded-lg px-4 py-3 flex items-center gap-3 transition-all hover:bg-surface-container-high" href="{{ route('dinas.ulasan') }}">
                    <span class="material-symbols-outlined">analytics</span>
                    <span class="font-label-md text-label-md">Manajemen Ulasan</span>
                </a>
                <a class="{{ Request::routeIs('dinas.sertifikasi') ? 'sidebar-active' : 'text-on-surface-variant' }} rounded-lg px-4 py-3 flex items-center gap-3 transition-all hover:bg-surface-container-high" href="{{ route('dinas.sertifikasi') }}">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="font-label-md text-label-md">Sertifikasi Halal</span>
                </a>
            </nav>
            <div class="mt-auto px-4 flex flex-col gap-2 border-t border-outline-variant/10 pt-6">
                <div class="flex items-center gap-3 px-2 py-2 mb-4">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-primary-container/30 border border-primary/10">
                        <img alt="Admin Profile" class="w-full h-full object-cover" src="{{ Auth::user()->photo_url }}">
                    </div>
                    <div>
                        <p class="font-label-md text-label-md text-brand-beige">Dinas Pariwisata</p>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-wider">Administrator</p>
                    </div>
                </div>
                <a class="{{ Request::routeIs('dinas.profil') ? 'sidebar-active' : 'text-on-surface-variant' }} px-4 py-3 flex items-center gap-3 hover:bg-surface-container-high transition-all rounded-lg" href="{{ route('dinas.profil') }}">
                    <span class="material-symbols-outlined">person</span>
                    <span class="font-label-md text-label-md">Profil</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a class="text-error px-4 py-3 flex items-center gap-3 hover:bg-error-container/10 transition-all rounded-lg cursor-pointer" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-label-md text-label-md">Keluar</span>
                </a>
            </div>
        </aside>
    @elseif(Auth::user()->isMitra())
        <!-- Resto SideNavBar -->
        <aside class="fixed left-0 top-0 bottom-0 z-40 h-screen w-72 flex flex-col overflow-y-auto shadow-md font-headline-md bg-background border-r border-outline-variant/10">
            <div class="px-8 py-10">
                <div class="flex items-center gap-3">
                    <h1 class="text-[24px] font-bold tracking-tight whitespace-nowrap" style="font-family: 'Plus Jakarta Sans', sans-serif; color: rgb(245, 230, 211);">SMWKP Kuliner</h1>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.dashboard') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.dashboard') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">dashboard</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.restoSaya') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.restoSaya') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">restaurant</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Restoran Saya</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.booking') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.booking') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">event_available</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Booking Masuk</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.galeri') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.galeri') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">photo_library</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Galeri Foto</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.reviews') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.reviews') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">rate_review</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Ulasan Restoran</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.profilUsaha') || Request::routeIs('resto.editResto') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.profilUsaha') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">storefront</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Profil Usaha</span>
                </a>
                <a class="flex items-center gap-3 px-6 py-3 rounded-full transition-all {{ Request::routeIs('resto.sertifikasi') ? 'sidebar-active' : 'hover:bg-surface-container-highest text-primary' }}" href="{{ route('resto.sertifikasi') }}">
                    <span class="material-symbols-outlined text-[24px]" style="color: #F5E6D3;">verified_user</span>
                    <span class="font-medium text-[14px]" style="color: #F5E6D3;">Sertifikasi</span>
                </a>
            </nav>
            <div class="p-4 mt-auto">
                <form id="resto-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a class="flex items-center gap-3 px-6 py-3 hover:bg-surface-container-highest transition-colors duration-200 rounded-full text-primary cursor-pointer" onclick="event.preventDefault(); document.getElementById('resto-logout-form').submit();">
                    <span class="material-symbols-outlined" style="color: rgb(245, 230, 211);">logout</span>
                    <span class="font-label-md text-[14px]" style="color: rgb(245, 230, 211);">Logout</span>
                </a>
            </div>
        </aside>
    @endif
@endauth
