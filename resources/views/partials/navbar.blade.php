<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 flex justify-between items-center px-margin-desktop h-20 max-w-container-max mx-auto left-1/2 -translate-x-1/2 bg-background/80 dark:bg-background/80 backdrop-blur-md border-b border-white/10 shadow-sm">
    <div class="h-10 flex items-center">
        <a href="{{ route('homepage') }}" class="font-headline-md text-headline-md font-bold" style="color: rgb(90, 15, 22); font-weight: 700;">SMWKP</a>
    </div>
    
    <div class="hidden md:flex items-center gap-8">
        <a class="font-label-md text-label-md {{ Request::routeIs('homepage') ? 'text-primary font-bold underline pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('homepage') }}">Beranda</a>
        @auth
            <a class="font-label-md text-label-md {{ Request::routeIs('wisatawan.katalog') ? 'text-primary font-bold underline pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('wisatawan.katalog') }}">Katalog</a>
            <a class="font-label-md text-label-md {{ Request::routeIs('wisatawan.peta') ? 'text-primary font-bold underline pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('wisatawan.peta') }}">Peta Kuliner</a>
            <a class="font-label-md text-label-md {{ Request::routeIs('wisatawan.tentang') ? 'text-primary font-bold underline pb-1' : 'text-on-surface-variant hover:text-primary' }} transition-colors" href="{{ route('wisatawan.tentang') }}">Tentang</a>
        @else
            <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ route('wisatawan.register') }}">Daftar</a>
        @endauth
    </div>
    
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-6">
            @auth
                @if(!Auth::user()->isWisatawan())
                    <button class="relative text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-secondary rounded-full"></span>
                    </button>
                @endif
            @endauth
            
            <div class="flex items-center gap-3 border-l border-white/10 pl-6">
                @auth
                    <div class="text-right hidden md:block">
                        <p class="font-label-md text-label-md text-on-surface font-bold">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] tracking-widest text-primary font-bold uppercase">{{ Auth::user()->role === 'wisatawan' ? 'Wisatawan Premium' : 'Mitra Restoran' }}</p>
                    </div>
                    <!-- Dropdown Container -->
                    <div class="relative inline-block text-left" id="userDropdownContainer">
                        <button type="button" class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary cursor-pointer focus:outline-none flex items-center justify-center" onclick="toggleDropdown()">
                            <img alt="{{ Auth::user()->name }}" class="w-full h-full object-cover" src="{{ Auth::user()->photo_url }}">
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-surface-container-low border border-outline-variant/20 z-50 overflow-hidden">
                            <div class="py-1">
                                @if(Auth::user()->isWisatawan())
                                    <a href="{{ route('wisatawan.dashboard') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Dashboard</a>
                                    <a href="{{ route('wisatawan.profil') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Profil Saya</a>
                                    <a href="{{ route('wisatawan.ulasan') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Ulasan Saya</a>
                                @elseif(Auth::user()->isMitra())
                                    <a href="{{ route('resto.dashboard') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Dashboard Resto</a>
                                    <a href="{{ route('resto.profilAdmin') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Profil Saya</a>
                                @elseif(Auth::user()->isAdminDinas())
                                    <a href="{{ route('dinas.dashboard') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Dashboard Dinas</a>
                                    <a href="{{ route('dinas.profil') }}" class="block px-4 py-2 text-sm text-on-surface hover:bg-surface-container-high transition-colors">Profil Saya</a>
                                @endif
                                
                                <hr class="border-outline-variant/10 my-1">
                                
                                <!-- Secure POST logout button inside dropdown -->
                                <form action="{{ route('logout') }}" method="POST" id="navbar-logout-form" class="m-0">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-error hover:bg-error-container/10 transition-colors flex items-center gap-2 cursor-pointer">
                                        <span class="material-symbols-outlined text-sm">logout</span> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="font-label-md text-label-md text-primary font-bold border border-primary/30 px-6 py-2 rounded-full hover:bg-primary/10 transition-colors">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const menu = document.getElementById('userDropdownMenu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }

    // Close the dropdown if clicking outside
    window.addEventListener('click', function(e) {
        const container = document.getElementById('userDropdownContainer');
        const menu = document.getElementById('userDropdownMenu');
        if (container && menu && !container.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
