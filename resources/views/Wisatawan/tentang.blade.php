@extends('layouts.app')

@section('title', 'Tentang Wisata Kuliner Palembang | SMWKP')

@section('styles')
<style>
    .glass-card {
        background: rgba(30, 32, 32, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .maroon-gradient {
        background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
    }
</style>
@endsection

@section('body_content')
<!-- Include Dynamic Navbar -->
@include('partials.navbar')

<main class="pt-32 pb-20 px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto text-on-surface animate-in fade-in duration-500">
    <header class="mb-16 text-center max-w-3xl mx-auto">
        <h1 class="font-display-lg text-[40px] md:text-display-lg text-primary mb-4">Eksplorasi Kuliner Bumi Sriwijaya</h1>
        <p class="font-body-lg text-on-surface-variant">Panduan resmi wisatawan untuk memahami asal-usul sejarah, filosofi bahan, dan cara menikmati kelezatan hidangan khas Palembang.</p>
    </header>

    <!-- History Block -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
        <div class="h-[350px] rounded-lg overflow-hidden border border-outline-variant/10 shadow-2xl">
            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQ5bYrI6ZQ1ZpEzI11o0R3MCg3H_EaIuqXOB9ibqBGUZgaGLndojktj5UV2EUBbRxbhj7y1osqBGg4TbN9SOMYov5-wTzeBJybjyEXqP_3x4dp4kWZ19rsuv9Kz6DMUS_V8ZyBGrE0l8qG9bHNoMVKhUP5IyDUSHJjSNUoR0YhRjfrAvsU-il0g0FwqzYCLDdAunHWhxqY4g_VTqt4qrjWtGK0cOkoJeMqdazTQ4DlRXpUs1wLGSgYnGaU79npzTFCi-0yIQlsd9LG">
        </div>
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary mb-6">Akulturasi Budaya dalam Rasa</h2>
            <p class="font-body-md text-on-surface-variant leading-relaxed mb-4">Kuliner Palembang merupakan hasil akulturasi budaya yang sangat kaya antara kebudayaan Melayu lokal, pengaruh Tiongkok, dan budaya Arab-India. Perpaduan ini melahirkan cita rasa gurih ikan yang dominan, kesegaran kaldu ebi, dan kuah cuko asam pedas manis yang khas.</p>
            <p class="font-body-md text-on-surface-variant leading-relaxed">Misalnya, adonan dasar pempek dipengaruhi oleh teknik pengolahan ikan tepung khas Tiongkok, sementara kuah cuko menggunakan gula aren lokal sumatera dan asam jawa asli. Sementara Mie Celor menggunakan kuah kental kelapa kelabu beraroma kuat rempah Melayu.</p>
        </div>
    </div>

    <!-- Landmarks Grid -->
    <section class="mb-20">
        <h2 class="font-headline-lg text-headline-lg text-primary text-center mb-12">Sentra Kuliner Utama</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-card rounded-lg overflow-hidden group hover:translate-y-[-4px] transition-transform shadow-lg">
                <div class="h-48 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZGau6qhH50UGkEkuokwvhTAquriGYWar2oKbfsKDV7y4OjszSCwXZqu9bgxIxZpWPdFoJVVNT2OkSUXl7mjKVrcjY04_PVQbDBOXvJK53m7pkS9zWTzCePXPdSdb8CuDwk17xZIStoGBcLDFiKT9ty0EmpsYAegRRf5s55n_cHE5ZogH8NI2UmH8rOCk22OviK7xxYIb_32nQAnuRdVscWGOht4GMrFWpzG2O2nwFm4SP2gQ2xRS6GdPT-0heUWkplWuKK-sVg9LK">
                </div>
                <div class="p-6">
                    <h4 class="font-headline-md text-white mb-2">Sentra Pempek 26 Ilir</h4>
                    <p class="text-on-surface-variant text-xs leading-relaxed">Dikenal sebagai "Kampung Pempek", kawasan ini dipenuhi oleh puluhan kedai pempek dengan harga rakyat yang memanjakan lidah.</p>
                </div>
            </div>
            <div class="glass-card rounded-lg overflow-hidden group hover:translate-y-[-4px] transition-transform shadow-lg">
                <div class="h-48 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYBjDNLDlRAvtRPIXjoYM_fizHr_Vh59C_I2mPftX1H2oUsX5SxOf3k5dGlf6YxTIWewwI_ZJmQ0klV_M1CDCFtWDPCByH-CjAp5bA1aTJmJtV370NLLCn9NfbGFCA6c7Tvxd3iGTaYCR0sw2qzySmsFPyT1RS4SxvyQ2Dgvy43jD2XAZaIAMIq8MAocp8n9MuAuVHhZBfKY39lENU2NPqub3UbitmVVmw4splniJSSmu_Cy--CHYOu3QsEa_zSleIvVM4pB3fOzcm">
                </div>
                <div class="p-6">
                    <h4 class="font-headline-md text-white mb-2">Kawasan Radial &amp; Sudirman</h4>
                    <p class="text-on-surface-variant text-xs leading-relaxed">Menyediakan deretan restoran pempek premium legendaris, tekwan, dan kuliner modern berfasilitas modern lengkap.</p>
                </div>
            </div>
            <div class="glass-card rounded-lg overflow-hidden group hover:translate-y-[-4px] transition-transform shadow-lg">
                <div class="h-48 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXl2InW3q6chvXcHnLJhNKUsPjQIWq69TyS6h8LPku5VBSJ3EV91rXokUEqzg-3oXQOcK1NnqbQxxTlaAxTjDQW5FD9sv8Ii7S09wHIxSiFFmwRmTA4oSYM07mZprl-pxhfCEBWBkhIaiJViMwzpG8dXyA7Jzs08CLcNLDgliCqLPmGd9tehOd5jlu3PvmlebgnhkP1TkIB0Zf-5L8KJY0UU_eOJZfd0tkam9OmcAHOhnHxpCBz_y0nNLaHOr8gg6an91ePBA7ooXJ">
                </div>
                <div class="p-6">
                    <h4 class="font-headline-md text-white mb-2">Kuliner Sungai Musi</h4>
                    <p class="text-on-surface-variant text-xs leading-relaxed">Bersantap di tepi sungai Musi dekat jembatan Ampera dengan menu Pindang ikan patin segar yang dimasak harum daun kemangi.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Unified Footer -->
@include('partials.footer')
@endsection
