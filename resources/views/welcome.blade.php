<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyPengembalianBarangKu') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-stone-800 antialiased bg-stone-50 selection:bg-gold-500 selection:text-white">

    <!-- Hero Section -->
    <div class="relative min-h-screen flex flex-col justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('hero-bg.png') }}" class="w-full h-full object-cover" alt="Background">
            <div class="absolute inset-0 bg-primary-900/40 mix-blend-multiply"></div>
        </div>

        <!-- Navigation -->
        @if (Route::has('login'))
            <nav class="absolute top-0 right-0 z-20 p-6 flex justify-end w-full">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-medium text-white hover:text-gold-500 transition duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-medium text-white hover:text-gold-500 transition duration-300 mr-6">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 rounded-full bg-gold-600 text-white font-medium hover:bg-gold-500 transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Register</a>
                    @endif
                @endauth
            </nav>
        @endif

        <!-- Content -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">

            <div
                class="backdrop-blur-md bg-white/10 p-10 md:p-16 rounded-3xl border border-white/20 shadow-2xl max-w-3xl animate-fade-in-up">
                <h1 class="font-sans text-5xl md:text-7xl text-white font-bold tracking-tight mb-6 drop-shadow-md">
                    MyPengembalian<span class="text-gold-500">BarangKu</span>
                </h1>

                <p class="text-xl md:text-2xl text-primary-50 font-light mb-10 max-w-2xl mx-auto leading-relaxed">
                    Pengalaman pengembalian barang yang elegan, mudah, dan terpercaya. Solusi modern untuk kebutuhan
                    Anda.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="px-8 py-4 bg-white text-primary-800 font-semibold rounded-full shadow-lg hover:bg-gray-100 transition duration-300 min-w-[160px]">
                        Mulai Sekarang
                    </a>
                    <a href="#about"
                        class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-full hover:bg-white/10 transition duration-300 min-w-[160px]">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <!-- Features Preview (Optional elegant cards) -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 w-full text-left">
                <!-- Card 1 -->
                <div
                    class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-xl border-t-4 border-gold-500 hover:transform hover:scale-105 transition duration-300">
                    <div class="text-primary-700 mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-sans text-2xl text-primary-900 mb-3">Proses Cepat</h3>
                    <p class="text-stone-600">Ajukan pengembalian hanya dalam beberapa langkah mudah tanpa ribet.</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-xl border-t-4 border-primary-600 hover:transform hover:scale-105 transition duration-300">
                    <div class="text-primary-700 mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-sans text-2xl text-primary-900 mb-3">Aman & Terpercaya</h3>
                    <p class="text-stone-600">Data Anda aman bersama kami. Sistem keamanan tingkat tinggi.</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white/90 backdrop-blur-sm p-8 rounded-2xl shadow-xl border-t-4 border-gold-500 hover:transform hover:scale-105 transition duration-300">
                    <div class="text-primary-700 mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-sans text-2xl text-primary-900 mb-3">Layanan 24/7</h3>
                    <p class="text-stone-600">Tim support kami siap membantu kapanpun Anda membutuhkan bantuan.</p>
                </div>
            </div>

            <footer class="mt-20 text-white/60 text-sm">
                &copy; {{ date('Y') }} MyPengembalianBarangKu. All rights reserved.
            </footer>
        </div>
    </div>

    <!-- Animation Keyframes -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 40px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
    </style>
</body>

</html>
