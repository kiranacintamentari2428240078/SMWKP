<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMWKP | Warisan Kuliner Nusantara')</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        // Dinas & Brand Maroon Theme
                        "brand-maroon": "#5a0f16",
                        "brand-maroon-light": "#7D2A2E",
                        "brand-beige": "#d1c7b7",
                        "brand-beige-light": "#F5E6D3",
                        // Resto / Mitra theme
                        "resto-primary": "#E5D9C3",
                        "resto-bg": "#121414",
                        // Wisatawan Theme
                        "primary": "#F5F5DC",
                        "primary-container": "#5a0f16",
                        "secondary-fixed": "#ffdada",
                        "surface-container-highest": "#333535",
                        "on-tertiary-fixed": "#410008",
                        "surface-dim": "#121414",
                        "primary-fixed": "#ffdad8",
                        "on-secondary": "#541f23",
                        "inverse-on-surface": "#2f3131",
                        "tertiary-fixed-dim": "#ffb3b2",
                        "surface-container": "#1e2020",
                        "on-surface-variant": "#dbc0bf",
                        "surface-variant": "#333535",
                        "surface-container-lowest": "#0c0f0f",
                        "surface-container-low": "#1a1c1c",
                        "error-container": "#93000a",
                        "outline": "#a38b8a",
                        "on-primary-fixed-variant": "#7d2a2e",
                        "on-primary-container": "#df7575",
                        "inverse-surface": "#e2e2e2",
                        "surface": "#121414",
                        "surface-tint": "#ffb3b2",
                        "on-secondary-container": "#f3a3a6",
                        "on-tertiary": "#630d18",
                        "on-surface": "#e2e2e2",
                        "on-tertiary-fixed-variant": "#82252c",
                        "on-error-container": "#ffdad6",
                        "error": "#ffb4ab",
                        "secondary-container": "#72373b",
                        "tertiary-fixed": "#ffdad9",
                        "primary-fixed-dim": "#ffb3b2",
                        "on-background": "#e2e2e2",
                        "tertiary-container": "#5d0814",
                        "on-secondary-fixed-variant": "#6f3539",
                        "on-primary": "#5f1319",
                        "inverse-primary": "#9c4143",
                        "secondary": "#ffb3b2",
                        "background": "#121414",
                        "tertiary": "#ffb3b2",
                        "outline-variant": "#554242",
                        "on-error": "#690005",
                        "surface-container-high": "#282a2b",
                        "on-secondary-fixed": "#390a10",
                        "secondary-fixed-dim": "#ffb3b5",
                        "on-tertiary-container": "#e57073",
                        "surface-bright": "#38393a",
                        "on-primary-fixed": "#410008",
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    spacing: {
                        "margin-mobile": "16px",
                        "margin-desktop": "48px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "unit": "8px"
                    },
                    fontFamily: {
                        "display-lg": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "label-md": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"]
                    },
                    fontSize: {
                        "display-lg": ["56px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "500"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #121414;
            color: #e2e2e2;
        }
        .glass-card {
            background: rgba(30, 32, 32, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .primary-gradient {
            background: linear-gradient(135deg, #5A0F16 0%, #401015 100%);
        }
        .btn-maroon-gradient {
            background: linear-gradient(to bottom, #5A0F16, #401015);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1), 0 4px 6px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        .btn-maroon-gradient:hover {
            transform: translateY(-2px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1), 0 8px 12px rgba(90, 15, 22, 0.4);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #5A0F16;
            border-radius: 10px;
        }
        .sidebar-active {
            background-color: #5a0f16;
            color: #F5E6D3;
        }
        .card-subtle-border {
            border: 1px solid rgba(245, 230, 211, 0.05);
        }
    </style>
    @yield('styles')
</head>
<body class="font-body-md text-body-md selection:bg-primary-container selection:text-white">
    
    @yield('body_content')

    @include('partials.alert')

    @yield('scripts')
</body>
</html>
