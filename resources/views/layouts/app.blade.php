<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Sistem Manajemen Surat Jalan - Kurang Kirim (iOS Glassmorphism Edition)">
    <title>@yield('title', 'Kurang Kirim') — Surat Jalan</title>

    <!-- Apple Font Stack -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tom Select for Searchable Dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
</head>
<body class="min-h-screen flex flex-col relative antialiased selection:bg-blue-500/30 selection:text-white">

    <!-- === iPhone Dynamic Aurora Glow Wallpaper Background === -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <!-- Deep Ambient Cosmic Orbs -->
        <div class="absolute -top-[25%] -left-[10%] w-[650px] h-[650px] rounded-full bg-gradient-to-br from-indigo-600/35 via-purple-600/25 to-transparent blur-[120px] animate-float-slow"></div>
        <div class="absolute top-[15%] -right-[15%] w-[700px] h-[700px] rounded-full bg-gradient-to-bl from-blue-600/30 via-cyan-500/20 to-transparent blur-[130px] animate-float-reverse"></div>
        <div class="absolute -bottom-[20%] left-[25%] w-[800px] h-[800px] rounded-full bg-gradient-to-tr from-fuchsia-600/20 via-pink-600/15 to-transparent blur-[140px] animate-pulse-glow"></div>
        <div class="absolute top-[45%] left-[10%] w-[500px] h-[500px] rounded-full bg-sky-500/15 blur-[120px]"></div>

        <!-- Subtle iPhone Vignette & Noise Sheen -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(120,119,198,0.25),rgba(255,255,255,0))]"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/60"></div>
    </div>

    <!-- === iOS Top Bar / Dynamic Floating Dock === -->
    <header class="sticky top-3 z-50 px-4 sm:px-6 max-w-6xl mx-auto w-full">
        <nav class="ios-nav-glass rounded-full px-3 py-2 sm:px-5 sm:py-2.5 flex items-center justify-between transition-all duration-300">
            <!-- Brand Lockup with iOS App Icon -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <div class="relative flex h-10 w-10 items-center justify-center rounded-[12px] bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600 shadow-md shadow-blue-500/30 border border-white/30 group-hover:scale-105 transition-transform duration-300">
                    <svg class="h-5 w-5 text-white drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <!-- Specular shine on icon -->
                    <div class="absolute inset-x-0 top-0 h-1/2 rounded-t-[11px] bg-gradient-to-b from-white/35 to-transparent pointer-events-none"></div>
                </div>
                <div>
                    <span class="text-base font-bold tracking-tight text-white group-hover:text-blue-300 transition-colors">
                        Kurang Kirim
                    </span>
                    <span class="hidden sm:block text-[11px] text-white/50 tracking-wider uppercase font-medium">
                        Surat Jalan OS
                    </span>
                </div>
            </a>

            <!-- iOS Segmented Navigation Pills -->
            <div class="flex items-center bg-black/30 p-1 rounded-full border border-white/10 backdrop-blur-md">
                <a href="{{ route('dashboard') }}"
                   class="relative px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-tight transition-all duration-300 flex items-center gap-1.5 {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white shadow-[0_2px_10px_rgba(0,0,0,0.3)] border border-white/25' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Input SJ</span>
                </a>

                <a href="{{ route('history') }}"
                   class="relative px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-tight transition-all duration-300 flex items-center gap-1.5 {{ request()->routeIs('history') || request()->routeIs('kurang-kirim.*') ? 'bg-white/20 text-white shadow-[0_2px_10px_rgba(0,0,0,0.3)] border border-white/25' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Riwayat</span>
                </a>

                <a href="{{ route('toko.index') }}"
                   class="relative px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-tight transition-all duration-300 flex items-center gap-1.5 {{ request()->routeIs('toko.*') ? 'bg-white/20 text-white shadow-[0_2px_10px_rgba(0,0,0,0.3)] border border-white/25' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Toko</span>
                </a>
            </div>

            <!-- iOS Live Status Indicator Pill -->
            <div class="hidden md:flex items-center gap-2 pl-3 border-l border-white/10 text-[11px] text-white/70">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="font-mono text-white/80 tabular-nums">ONLINE</span>
            </div>
        </nav>
    </header>

    <!-- === iOS Push Notification Flash Messages === -->
    @if(session('success'))
        <div id="flash-success" class="mx-auto max-w-xl px-4 mt-4 w-full animate-spring-down z-40">
            <div class="ios-glass rounded-[20px] p-3.5 px-4 text-emerald-300 flex items-center gap-3.5 border border-emerald-400/30 shadow-2xl">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 text-slate-950 font-bold shadow-md">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between text-[11px] text-emerald-400/80 mb-0.5">
                        <span class="font-semibold uppercase tracking-wider">Kurang Kirim</span>
                        <span>Baru saja</span>
                    </div>
                    <p class="text-sm font-medium text-white truncate">{{ session('success') }}</p>
                </div>
                <button onclick="document.getElementById('flash-success').remove()" class="text-white/50 hover:text-white p-1 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div id="flash-error" class="mx-auto max-w-xl px-4 mt-4 w-full animate-spring-down z-40">
            <div class="ios-glass rounded-[20px] p-3.5 px-4 text-rose-300 flex items-center gap-3.5 border border-rose-500/30 shadow-2xl">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 text-white font-bold shadow-md">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="flex items-center justify-between text-[11px] text-rose-400/80 mb-0.5">
                        <span class="font-semibold uppercase tracking-wider">Pemberitahuan</span>
                        <span>Baru saja</span>
                    </div>
                    <p class="text-sm font-medium text-white truncate">
                        {{ session('error') ?? $errors->first() }}
                    </p>
                </div>
                <button onclick="document.getElementById('flash-error').remove()" class="text-white/50 hover:text-white p-1 transition-colors">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content Canvas -->
    <main class="mx-auto max-w-6xl px-4 sm:px-6 py-8 flex-1 w-full">
        @yield('content')
    </main>

    <!-- iOS Minimalist Glass Footer -->
    <footer class="mt-auto py-8 px-4 text-center">
        <div class="mx-auto max-w-6xl flex flex-col items-center gap-3">
            <!-- iOS Home Indicator Pill -->
            <div class="w-32 h-1 rounded-full bg-white/20 backdrop-blur-md mb-2"></div>
            <p class="text-xs text-white/40 font-medium">
                &copy; {{ date('Y') }} Kurang Kirim — Sistem Manajemen Surat Jalan
            </p>
            <p class="text-[11px] text-white/25">
                Designed with iOS Glassmorphism
            </p>
        </div>
    </footer>

    <!-- Auto-dismiss flash message -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const flashes = ['flash-success', 'flash-error'];
            flashes.forEach(id => {
                const flash = document.getElementById(id);
                if (flash) {
                    setTimeout(() => {
                        flash.style.transition = 'opacity 500ms, transform 500ms';
                        flash.style.opacity = '0';
                        flash.style.transform = 'translateY(-15px) scale(0.95)';
                        setTimeout(() => flash.remove(), 500);
                    }, 5000);
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
