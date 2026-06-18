<footer class="w-full py-margin-desktop px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container-lowest border-t border-outline-variant">
    <div class="col-span-1 md:col-span-1">
        <h2 class="font-headline-md text-headline-md mb-6 font-bold" style="color: rgb(90, 15, 22);">SMWKP</h2>
        <p class="text-on-surface-variant font-body-md text-body-md mb-6">Portal kurasi kuliner terbaik di Palembang, menghubungkan warisan budaya dengan penikmat rasa modern.</p>
    </div>
    <div>
        <h3 class="font-label-md text-label-md text-white mb-6 uppercase tracking-widest">Tautan</h3>
        <ul class="space-y-4">
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('kebijakan.privasi') }}">Privacy Policy</a></li>
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.terms') }}">Terms of Service</a></li>
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.contact') }}">Contact Us</a></li>
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.partnerships') }}">Partnerships</a></li>
        </ul>
    </div>
    <div>
        <h3 class="font-label-md text-label-md text-white mb-6 uppercase tracking-widest">Kategori Populer</h3>
        <ul class="space-y-4">
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.kategori', 'pempek') }}">Pempek Kapal Selam</a></li>
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.kategori', 'mie-celor') }}">Mie Celor</a></li>
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.kategori', 'pindang') }}">Pindang Patin</a></li>
            <li class=""><a class="text-on-surface-variant hover:text-primary transition-all font-body-md text-body-md underline" href="{{ route('wisatawan.kategori', 'martabak-har') }}">Martabak HAR</a></li>
        </ul>
    </div>
    <div>
        <h3 class="font-label-md text-label-md text-white mb-6 uppercase tracking-widest">Ikuti Kami</h3>
        <div class="flex gap-4">
            <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-primary hover:text-on-primary transition-all" href="{{ route('pusat.bantuan') }}" style="color: rgb(245, 245, 220);">
                <span class="material-symbols-outlined">public</span>
            </a>
            <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-primary hover:text-on-primary transition-all" href="{{ route('wisatawan.contact') }}" style="color: rgb(245, 245, 220);">
                <span class="material-symbols-outlined">alternate_email</span>
            </a>
            <a class="w-10 h-10 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-primary hover:text-on-primary transition-all" href="{{ route('wisatawan.partnerships') }}" style="color: rgb(245, 245, 220);">
                <span class="material-symbols-outlined">share</span>
            </a>
        </div>
        <p class="mt-8 text-on-surface-variant font-body-md text-body-md">© 2026 Palembang Culinary Heritage. All rights reserved.</p>
    </div>
</footer>
