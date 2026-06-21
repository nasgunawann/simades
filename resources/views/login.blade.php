<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMADES PANTAI GEMI — Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital@0;1&display=swap" rel="stylesheet">
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
                            800: '#6e3d18',
                            900: '#5c3418',
                        }
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.6s ease forwards',
                        'fade-in': 'fadeIn 0.8s ease forwards',
                        'leaf-sway': 'leafSway 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        leafSway: {
                            '0%, 100%': {
                                transform: 'rotate(-3deg) scale(1)'
                            },
                            '50%': {
                                transform: 'rotate(3deg) scale(1.05)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-batik {
            background-color: #0d2011;
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(61, 132, 69, 0.18) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(201, 127, 31, 0.12) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233d8445' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .card-glass {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
        }

        .input-field {
            transition: all 0.2s ease;
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(61, 132, 69, 0.2);
        }

        .btn-login {
            background: linear-gradient(135deg, #2d6a34 0%, #3d8445 50%, #5ea365 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(45, 106, 52, 0.4);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #24552a 0%, #2d6a34 50%, #3d8445 100%);
            box-shadow: 0 6px 20px rgba(45, 106, 52, 0.5);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .leaf-decoration {
            opacity: 0.12;
        }

        .stagger-1 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .stagger-2 {
            animation-delay: 0.2s;
            opacity: 0;
        }

        .stagger-3 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        .stagger-4 {
            animation-delay: 0.4s;
            opacity: 0;
        }

        .stagger-5 {
            animation-delay: 0.5s;
            opacity: 0;
        }
    </style>
</head>

<body class="min-h-screen bg-batik flex items-center justify-center p-4">

    {{-- Decorative SVG leaves --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none select-none">
        <svg class="absolute top-[-40px] left-[-40px] w-80 h-80 leaf-decoration animate-leaf-sway text-forest-400" viewBox="0 0 200 200" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 10 C140 10, 190 50, 190 100 C190 150, 140 190, 100 190 C60 190, 10 150, 10 100 C10 50, 60 10, 100 10 Z M100 30 C80 50, 30 70, 40 110 C50 140, 80 160, 100 170 C120 160, 150 140, 160 110 C170 70, 120 50, 100 30 Z" />
        </svg>
        <svg class="absolute bottom-[-60px] right-[-60px] w-96 h-96 leaf-decoration text-earth-400 animate-leaf-sway" style="animation-delay:2s" viewBox="0 0 200 200" fill="currentColor">
            <path d="M20 180 C20 180, 80 160, 100 100 C120 40, 180 20, 180 20 C180 20, 160 80, 100 100 C40 120, 20 180, 20 180 Z" />
            <path d="M40 160 C40 160, 90 150, 110 110 C130 70, 170 40, 170 40 C170 40, 150 80, 110 110 C70 140, 40 160, 40 160 Z" opacity="0.5" />
        </svg>
        <svg class="absolute top-1/3 right-8 w-24 h-24 leaf-decoration text-forest-300 animate-leaf-sway" style="animation-delay:3s" viewBox="0 0 100 100" fill="currentColor">
            <path d="M10 90 C10 90, 50 70, 50 50 C50 30, 90 10, 90 10 C90 10, 70 50, 50 50 C30 50, 10 90, 10 90 Z" />
        </svg>
        <svg class="absolute bottom-1/4 left-12 w-20 h-20 leaf-decoration text-forest-200 animate-leaf-sway" style="animation-delay:1.5s" viewBox="0 0 100 100" fill="currentColor">
            <path d="M50 5 C70 20, 95 50, 80 75 C65 95, 35 95, 20 75 C5 50, 30 20, 50 5 Z" />
        </svg>
    </div>

    {{-- Login Card --}}
    <div class="w-full max-w-md relative z-10">

        {{-- Logo / Header area --}}
        <div class="text-center mb-6 animate-fade-up stagger-1">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-forest-600 shadow-2xl mb-4 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-forest-500 to-forest-800"></div>
                <!-- <svg class="w-10 h-10 text-white relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg> -->
                <div class="">
                    <img src="{{ asset('imgs/logo_langkat.png') }}" alt="Logo" class="w-full h-full object-contain mx-auto drop-shadow-2xl">
                </div>
            </div>
            <h1 class="font-serif text-3xl font-bold text-white tracking-tight italic">SIMADES</h1>
            <p class="text-forest-300 text-sm mt-1 font-medium tracking-widest uppercase">Sistem Manajemen Desa Pantai Gemi</p>
        </div>

        {{-- Card --}}
        <div class="card-glass rounded-3xl shadow-2xl overflow-hidden animate-fade-up stagger-2">

            {{-- Top accent bar --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-forest-600 via-earth-400 to-forest-500"></div>

            <div class="p-8">
                <div class="mb-7 animate-fade-up stagger-3">
                    <h2 class="text-2xl font-bold text-forest-900">Selamat Datang</h2>
                    <p class="text-gray-500 text-sm mt-1">Masuk untuk mengakses panel admin desa</p>
                </div>

                {{-- Session Error --}}
                @if (session('error'))
                <div class="mb-5 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl animate-fade-up stagger-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div class="animate-fade-up stagger-3">
                        <label for="username" class="block text-sm font-semibold text-forest-800 mb-2">
                            Username
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-forest-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <input
                                id="username"
                                name="username"
                                type="text"
                                value="{{ old('username') }}"
                                required
                                autofocus
                                placeholder="Masukkan username"
                                class="input-field w-full pl-11 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-forest-900 placeholder-gray-400 text-sm font-medium focus:outline-none focus:border-forest-400 focus:bg-white @error('username') border-red-400 bg-red-50 @enderror">
                        </div>
                        @error('username')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="animate-fade-up stagger-4">
                        <label for="password" class="block text-sm font-semibold text-forest-800 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-forest-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                placeholder="Masukkan password"
                                class="input-field w-full pl-11 pr-12 py-3 rounded-xl border border-gray-200 bg-gray-50 text-forest-900 placeholder-gray-400 text-sm font-medium focus:outline-none focus:border-forest-400 focus:bg-white @error('password') border-red-400 bg-red-50 @enderror">
                            {{-- Toggle password visibility --}}
                            <button
                                type="button"
                                id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-forest-600 transition-colors">
                                <svg id="eyeOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eyeClosed" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center animate-fade-up stagger-4">
                        <input
                            id="remember"
                            name="remember"
                            type="checkbox"
                            class="w-4 h-4 rounded border-gray-300 text-forest-600 focus:ring-forest-500 cursor-pointer">
                        <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer select-none">
                            Ingat saya
                        </label>
                    </div>

                    {{-- Submit --}}
                    <div class="pt-1 animate-fade-up stagger-5">
                        <button
                            type="submit"
                            class="btn-login w-full py-3.5 px-6 rounded-xl text-white font-bold text-sm tracking-wide focus:outline-none focus:ring-2 focus:ring-forest-500 focus:ring-offset-2">
                            Masuk ke Dashboard
                        </button>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="px-8 pb-6 animate-fade-up stagger-5">
                <div class="border-t border-gray-100 pt-5 flex items-center justify-center gap-2 text-xs text-gray-400">
                    <svg class="w-4 h-4 text-forest-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    <span>Akses terbatas untuk Admin & Operator</span>
                </div>
            </div>
        </div>

        {{-- Version tag --}}
        <p class="text-center text-forest-600 text-xs mt-4 animate-fade-in stagger-5 opacity-0" style="animation-delay:0.7s">
            SIMADES v1.0 &mdash; Desa Cerdas Digital
        </p>
    </div>

    <script>
        // Toggle password visibility
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', isPassword);
            eyeClosed.classList.toggle('hidden', !isPassword);
        });
    </script>
</body>

</html>