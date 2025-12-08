<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MyPengembalianBarangKu</title>
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
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                        </path>
                    </svg>
                </a>
                <h1 class="text-2xl font-sans font-bold text-stone-800 tracking-tight mb-2">
                    Daftar Akun Baru
                </h1>
                <p class="text-stone-500 text-sm">Bergabung dengan MyPengembalianBarangKu</p>
            </div>

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <input type="text" name="name" id="name"
                            class="w-full pl-10 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-stone-800"
                            placeholder="Contoh: Dera Amelia" value="{{ old('name') }}" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">Email Unsoed</label>
                    <div class="relative">
                        <input type="email" name="email" id="email"
                            class="w-full pl-10 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-stone-800"
                            placeholder="nama@unsoed.ac.id" value="{{ old('email') }}" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-1.5">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            class="w-full pl-10 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-stone-800"
                            placeholder="Minimal 6 karakter" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-sm font-medium text-stone-700 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full pl-10 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-stone-800"
                            placeholder="Ulangi password" required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-primary-700 hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform hover:-translate-y-0.5">
                    Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-stone-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-gold-600 hover:text-gold-500 transition">
                        Login disini
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
