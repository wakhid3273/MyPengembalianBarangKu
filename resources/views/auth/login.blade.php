<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyPengembalianBarangKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-stone-800 antialiased bg-stone-50 h-screen flex items-center justify-center overflow-hidden relative">

    <!-- Background -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('hero-bg.png') }}" class="w-full h-full object-cover blur-sm opacity-50" alt="Background">
        <div class="absolute inset-0 bg-primary-900/60 mix-blend-multiply"></div>
    </div>

    <div class="w-full max-w-md p-6 relative z-10">
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl p-8 border border-white/20">

            {{-- Header --}}
            <div class="text-center mb-8">
                <a href="/"
                    class="inline-block p-3 bg-primary-50 rounded-xl mb-4 shadow-sm group hover:scale-105 transition duration-300">
                    <svg class="w-10 h-10 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </a>
                <h1 class="text-2xl font-sans font-bold text-stone-800 tracking-tight mb-2">
                    Selamat Datang Kembali
                </h1>
                <p class="text-stone-500 text-sm">Masuk untuk mengelola barang hilang & temuan</p>
            </div>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-lg mb-6 text-sm flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">Email Unsoed</label>
                    <div class="relative">
                        <input type="email" name="email" id="email"
                            class="w-full pl-10 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-stone-800"
                            placeholder="nama@unsoed.ac.id" value="{{ old('email') }}" required autofocus>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full pl-10 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-stone-800"
                            placeholder="••••••••" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-stone-300 text-primary-600 focus:ring-primary-500">
                        <span class="ml-2 text-stone-600">Ingat Saya</span>
                    </label>
                    <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Lupa Password?</a>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-primary-700 hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-stone-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-bold text-gold-600 hover:text-gold-500 transition">
                        Daftar disini
                    </a>
                </p>
            </div>

            {{-- Demo Hint --}}
            <div class="mt-8 pt-6 border-t border-stone-100">
                <div class="text-xs text-stone-400 text-center">
                    <p class="font-semibold mb-2 uppercase tracking-wide">Demo Accounts</p>
                    <div class="flex flex-wrap justify-center gap-2">
                        <span class="bg-stone-50 px-2 py-1 rounded">admin@unsoed.ac.id</span>
                        <span class="bg-stone-50 px-2 py-1 rounded">mahasiswa@unsoed.ac.id</span>
                    </div>
                    <p class="mt-1 opacity-70">Pass: 123456</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
