<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMADES PANTAI GEMI — Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Lora:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    },
                    colors: {
                        forest: {
                            50: '#f0f7f0',
                            100: '#dceedd',
                            200: '#bbdebe',
                            300: '#8ec492',
                            400: '#5ea365',
                            500: '#3d8445',
                            600: '#2d6a34',
                            700: '#24552a',
                            800: '#1e4423',
                            900: '#18381d',
                            950: '#0d2011',
                        },
                        earth: {
                            50: '#fdf8f0',
                            100: '#faefd9',
                            200: '#f3d9a8',
                            300: '#e9bc6e',
                            400: '#de9c3a',
                            500: '#c97f1f',
                            600: '#a96317',
                            700: '#874b16',
                        }
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(16px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        slideIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-16px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            }
                        },
                        pulse2: {
                            '0%,100%': {
                                opacity: '1'
                            },
                            '50%': {
                                opacity: '.6'
                            }
                        },
                        countUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(8px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.5s ease forwards',
                        'slide-in': 'slideIn 0.4s ease forwards',
                        'pulse2': 'pulse2 2s ease-in-out infinite',
                        'count-up': 'countUp 0.6s ease forwards',
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html,
        body {
            overflow: hidden;
            height: 100%;
        }

        .main-content {
            overflow-y: auto;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(170deg, #0d2011 0%, #18381d 40%, #1e4423 100%);
        }

        .sidebar-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.07);
            border-left-color: rgba(94, 163, 101, 0.5);
        }

        .sidebar-item.active {
            background: rgba(61, 132, 69, 0.2);
            border-left-color: #5ea365;
        }

        .sidebar-item.active .item-icon {
            color: #8ec492;
        }

        .sidebar-item.active .item-label {
            color: #fff;
            font-weight: 600;
        }

        /* Submenu */
        .submenu {
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            max-height: 0;
            opacity: 0;
        }

        .submenu.open {
            max-height: 500px;
            opacity: 1;
        }

        .chevron {
            transition: transform 0.3s ease;
        }

        .chevron.rotated {
            transform: rotate(90deg);
        }

        /* Stat cards */
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        /* Main content */
        .main-bg {
            background-color: #f5f7f5;
            background-image: radial-gradient(ellipse at 100% 0%, rgba(61, 132, 69, 0.06) 0%, transparent 50%);
        }

        /* Topbar */
        .topbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #bbdebe;
            border-radius: 10px;
        }

        /* Stagger animations */
        .s1 {
            animation-delay: .05s;
            opacity: 0
        }

        .s2 {
            animation-delay: .1s;
            opacity: 0
        }

        .s3 {
            animation-delay: .15s;
            opacity: 0
        }

        .s4 {
            animation-delay: .2s;
            opacity: 0
        }

        .s5 {
            animation-delay: .25s;
            opacity: 0
        }

        .s6 {
            animation-delay: .3s;
            opacity: 0
        }

        /* Mobile sidebar overlay */
        #sidebarOverlay {
            transition: opacity 0.3s ease;
        }

        /* Progress bar */
        .progress-bar {
            transition: width 1s ease;
        }

        /* Avatar */
        .avatar-ring {
            background: conic-gradient(#3d8445 0%, #5ea365 30%, #e9bc6e 60%, #3d8445 100%);
        }
    </style>
</head>

<body class="main-bg min-h-screen flex overflow-hidden">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside id="sidebar" class="sidebar w-64 min-h-screen flex-shrink-0 flex flex-col fixed lg:relative z-40 transition-transform duration-300 -translate-x-full lg:translate-x-0">

        {{-- Logo --}}
        <div class="px-5 pt-6 pb-5 border-b border-white/10 flex items-center gap-3">
            <!-- <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-forest-400 to-forest-700 flex items-center justify-center flex-shrink-0 shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div> -->
            <img src="{{ asset('imgs/logo_langkat.png') }}" alt="Logo" class="w-10 h-10 object-contain flex-shrink-0">
            <div>
                <h1 class="font-serif text-white font-bold text-lg leading-none italic">SIMADES</h1>
                <p class="text-forest-400 text-[10px] tracking-widest uppercase mt-0.5">Desa Pantai Gemi</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 py-4 overflow-y-auto px-2 space-y-0.5">

            {{-- Section label --}}
            <p class="px-3 pt-2 pb-1.5 text-[10px] font-bold tracking-widest text-forest-600 uppercase">Menu Utama</p>

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg cursor-pointer">
                <svg class="item-icon w-5 h-5 text-forest-300 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span class="item-label text-forest-200 text-sm">Dashboard</span>
            </a>

            {{-- Kelola Data Warga --}}
            <div>
                <button onclick="toggleMenu('menuWarga','chevronWarga')" class="{{ request()->routeIs('warga.*') ? 'active' : '' }} sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg">
                    <svg class="item-icon w-5 h-5 text-forest-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="item-label text-forest-200 text-sm flex-1 text-left">Data Warga</span>
                    <svg id="chevronWarga" class="chevron w-4 h-4 text-forest-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
                <div id="menuWarga" class="submenu pl-10 pr-2 space-y-0.5 mt-0.5">
                    <a href="{{ route('warga.index') }}" class=" flex items-center gap-2 py-2 px-3 text-sm text-forest-300 hover:text-white rounded-lg hover:bg-white/5 transition-colors">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest-500"></span> Daftar Warga
                    </a>
                    <a href="{{ route('warga.create') }}" class="flex items-center gap-2 py-2 px-3 text-sm text-forest-300 hover:text-white rounded-lg hover:bg-white/5 transition-colors">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest-500"></span> Tambah Warga
                    </a>
                </div>
            </div>

            {{-- Kelola Template Surat --}}
            <div>
                <button onclick="toggleMenu('menuTemplate','chevronTemplate')" class="{{ request()->routeIs('template.*') ? 'active' : '' }} sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg">
                    <svg class="item-icon w-5 h-5 text-forest-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="item-label text-forest-200 text-sm flex-1 text-left">Template Surat</span>
                    <svg id="chevronTemplate" class="chevron w-4 h-4 text-forest-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
                <div id="menuTemplate" class="submenu pl-10 pr-2 space-y-0.5 mt-0.5">
                    <a href="{{ route('template.index') }}" class="flex items-center gap-2 py-2 px-3 text-sm text-forest-300 hover:text-white rounded-lg hover:bg-white/5 transition-colors">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest-500"></span> Daftar Template
                    </a>
                    <a href="{{ route('template.create') }}" class="flex items-center gap-2 py-2 px-3 text-sm text-forest-300 hover:text-white rounded-lg hover:bg-white/5 transition-colors">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest-500"></span> Tambah Template
                    </a>
                </div>
            </div>

            {{-- Generate Surat --}}
            <a href="{{ route('generate.index') }}" class="{{ request()->routeIs('generate.index') ? 'active' : '' }} sidebar-item flex items-center gap-3 px-3 py-2.5 rounded-lg">
                <svg class="item-icon w-5 h-5 text-forest-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                </svg>
                <span class="item-label text-forest-200 text-sm">Generate Surat</span>
                <span class="ml-auto bg-earth-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">Baru</span>
            </a>

            {{-- Arsip Surat --}}
            <div>
                <button onclick="toggleMenu('menuArsip','chevronArsip')" class="{{ request()->routeIs('arsip.index') ? 'active' : '' }} sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg">
                    <svg class="item-icon w-5 h-5 text-forest-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span class="item-label text-forest-200 text-sm flex-1 text-left">Arsip Surat</span>
                    <svg id="chevronArsip" class="chevron w-4 h-4 text-forest-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
                <div id="menuArsip" class="submenu pl-10 pr-2 space-y-0.5 mt-0.5">
                    <a href="{{ route('arsip.index') }}" class="flex items-center gap-2 py-2 px-3 text-sm text-forest-300 hover:text-white rounded-lg hover:bg-white/5 transition-colors">
                        <span class="w-1.5 h-1.5 rounded-full bg-forest-500"></span> Daftar Arsip
                    </a>
                </div>
            </div>

            {{-- Divider --}}
            <div class="pt-3 pb-1">
                <div class="border-t border-white/10"></div>`
            </div>
            <p class="px-3 pt-1 pb-1.5 text-[10px] font-bold tracking-widest text-forest-600 uppercase">Akun</p>

            {{-- Pengaturan Akun --}}
            <a href="{{ route('akun.index') }}" class="sidebar-item {{ request()->routeIs('akun.*') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-lg">
                <svg class="item-icon w-5 h-5 text-forest-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.43l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="item-label text-forest-200 text-sm">Pengaturan Akun</span>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-left group">
                    <svg class="w-5 h-5 text-red-500/60 group-hover:text-red-400 flex-shrink-0 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    <span class="text-red-400/70 group-hover:text-red-400 text-sm transition-colors">Keluar</span>
                </button>
            </form>

        </nav>

        {{-- Admin info --}}
        <div class="px-4 py-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="avatar-ring p-[2px] rounded-full">
                    <div class="w-9 h-9 rounded-full bg-forest-800 flex items-center justify-center">
                        <span class="text-forest-200 font-bold text-sm">{{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 2)) }}</span>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <p class="text-white text-sm font-semibold truncate">{{ auth()->user()->username ?? 'Admin' }}</p>
                    <p class="text-forest-500 text-xs">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- Mobile overlay --}}
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 opacity-0 pointer-events-none lg:hidden" onclick="closeSidebar()"></div>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <div class="flex-1 flex flex-col min-h-screen overflow-y-auto">

        {{-- Topbar --}}
        <header class="topbar h-16 flex items-center justify-between px-5 lg:px-8 shadow-sm flex-shrink-0 sticky top-0 z-20 border-b border-gray-100">
            <div class="flex items-center gap-4">
                {{-- Mobile hamburger --}}
                <button id="hamburger" onclick="openSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div>
                    <h2 class="text-forest-900 font-bold text-lg leading-none">Dashboard</h2>
                    <p class="text-gray-400 text-xs mt-0.5">
                        {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                {{-- Notification bell --}}
                {{-- <button class="relative p-2 rounded-xl hover:bg-forest-50 text-gray-500 hover:text-forest-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full animate-pulse2"></span>
                </button> --}}

                {{-- Profile badge --}}
                <div class="flex items-center gap-2 bg-forest-50 border border-forest-100 px-3 py-1.5 rounded-xl">
                    <div class="w-6 h-6 rounded-full bg-forest-600 flex items-center justify-center">
                        <span class="text-white font-bold text-[10px]">{{ strtoupper(substr(auth()->user()->username ?? 'A', 0, 2)) }}</span>
                    </div>
                    <span class="text-forest-800 font-semibold text-sm hidden sm:block">{{ auth()->user()->username ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        @if (session('success'))
        <div class="mx-5 lg:mx-8 mt-4 flex items-center gap-3 bg-forest-50 border border-forest-200 text-forest-700 text-sm px-4 py-3 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0 text-forest-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="mx-5 lg:mx-8 mt-4 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <svg class="w-5 h-5 flex-shrink-0 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            {{ session('error') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="mx-5 lg:mx-8 mt-4 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <div class="flex items-center gap-2 font-semibold mb-1">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                Terdapat kesalahan pada input:
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-xs">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Submenu toggle
        function toggleMenu(menuId, chevronId) {
            const menu = document.getElementById(menuId);
            const chevron = document.getElementById(chevronId);
            menu.classList.toggle('open');
            chevron.classList.toggle('rotated');
        }

        // Mobile sidebar
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.remove('opacity-0', 'pointer-events-none');
            document.getElementById('sidebarOverlay').classList.add('opacity-100');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('opacity-0', 'pointer-events-none');
            document.getElementById('sidebarOverlay').classList.remove('opacity-100');
        }

        // Auto-open active submenu
        document.addEventListener('DOMContentLoaded', () => {
            const path = window.location.pathname;
            if (path.includes('warga')) toggleMenu('menuWarga', 'chevronWarga');
            if (path.includes('template')) toggleMenu('menuTemplate', 'chevronTemplate');
            if (path.includes('arsip')) toggleMenu('menuArsip', 'chevronArsip');
            // if (path.includes('akun')) toggleMenu('menuAkun', 'chevronAkun');
        });
    </script>
</body>

</html>