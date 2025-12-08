<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun - MyPengembalianBarangKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 font-sans text-stone-800 min-h-screen">
    
    {{-- Header --}}
    <header class="bg-primary-900 text-white shadow-lg sticky top-0 z-30">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white/10 rounded-lg">
                        <svg class="w-6 h-6 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-sans font-bold tracking-wide">MyPengembalian<span class="text-gold-500">BarangKu</span></h1>
                        <p class="text-xs text-primary-100 tracking-wider uppercase">Profil Akun</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-primary-800 hover:bg-primary-700 border border-primary-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-sm hover:shadow">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            
            {{-- Success Alert --}}
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-6 py-4 rounded-r-xl shadow-sm mb-6 flex items-center gap-4">
                    <div class="bg-emerald-100 p-2 rounded-full">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-r-xl shadow-sm mb-6 flex items-center gap-4">
                    <div class="bg-red-100 p-2 rounded-full">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Left Column: Profil Info --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                        {{-- Header Card --}}
                        <div class="bg-stone-50 text-stone-800 p-6 border-b border-stone-200">
                            <div class="flex items-center gap-3">
                                <div class="bg-white p-3 rounded-full shadow-sm border border-stone-200">
                                    <svg class="w-6 h-6 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-sans font-bold text-stone-800">Profil Akun</h2>
                                    <p class="text-xs text-primary-600 font-bold uppercase tracking-wider bg-primary-50 px-2 py-0.5 rounded-full inline-block mt-1">{{ $user->role }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Form Edit Profil --}}
                        <div class="p-6">
                            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                {{-- Nama --}}
                                <div>
                                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        Nama <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                    >
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- NIM --}}
                                <div>
                                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        NIM <span class="text-stone-400 text-xs font-normal">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="nim" 
                                        value="{{ old('nim', $user->nim) }}"
                                        placeholder="Masukkan NIM"
                                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                    >
                                    @error('nim')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Angkatan --}}
                                <div>
                                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        Angkatan <span class="text-stone-400 text-xs font-normal">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="angkatan" 
                                        value="{{ old('angkatan', $user->angkatan) }}"
                                        placeholder="Contoh: 2023"
                                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                    >
                                    @error('angkatan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Nomor Telepon --}}
                                <div>
                                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        Nomor Telepon <span class="text-stone-400 text-xs font-normal">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm"
                                    >
                                    <p class="text-[10px] text-stone-400 mt-1">
                                        Digunakan untuk menghubungi Anda terkait barang yang dilaporkan
                                    </p>
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email (Read Only) --}}
                                <div>
                                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">
                                        Email
                                    </label>
                                    <input 
                                        type="email" 
                                        value="{{ $user->email }}"
                                        disabled
                                        class="w-full px-4 py-2.5 border border-stone-200 rounded-lg bg-stone-100 text-stone-500 cursor-not-allowed text-sm"
                                    >
                                    <p class="text-[10px] text-stone-400 mt-1">Email tidak dapat diubah</p>
                                </div>

                                {{-- Submit Button --}}
                                <button 
                                    type="submit"
                                    class="w-full bg-primary-700 hover:bg-primary-800 text-white py-3 rounded-lg font-bold shadow-sm hover:shadow transition transform hover:-translate-y-0.5"
                                >
                                    💾 Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Riwayat Postingan --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden h-full">
                        {{-- Header Card --}}
                        <div class="bg-primary-900 text-white p-6 border-b border-primary-800">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/10 p-3 rounded-xl">
                                        <svg class="w-6 h-6 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-sans font-bold text-white">Riwayat Postingan</h2>
                                        <p class="text-sm text-primary-200">Total: {{ $items->count() }} postingan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- List Postingan --}}
                        <div class="p-6">
                            @if($items->count() > 0)
                                <div class="space-y-4">
                                    @foreach($items as $item)
                                        <div class="group bg-stone-50 border border-stone-200 rounded-xl p-4 hover:shadow-md hover:border-primary-200 hover:bg-white transition-all duration-300">
                                            <div class="flex flex-col sm:flex-row gap-5">
                                                {{-- Thumbnail --}}
                                                <div class="flex-shrink-0">
                                                    <div class="w-full sm:w-28 h-28 rounded-lg overflow-hidden border border-stone-200 relative">
                                                        <img 
                                                            src="{{ $item->getPhotoDisplayUrl() }}" 
                                                            alt="{{ $item->item_name }}"
                                                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500"
                                                            onerror="this.src='https://via.placeholder.com/100?text=No+Image'"
                                                        >
                                                    </div>
                                                </div>
                                                
                                                {{-- Content --}}
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-2 mb-2">
                                                        <div>
                                                             <div class="flex items-center gap-2 mb-1">
                                                                <span class="text-xs font-bold text-primary-600 bg-primary-50 px-2 py-0.5 rounded-full border border-primary-100">
                                                                    {{ $item->category->category_name }}
                                                                </span>
                                                                <span class="text-xs text-stone-400">• {{ $item->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <h3 class="font-sans font-bold text-lg text-stone-800 truncate group-hover:text-primary-700 transition">
                                                                {{ $item->item_name }}
                                                            </h3>
                                                        </div>
                                                        
                                                        {{-- Status Badge --}}
                                                        <div class="flex-shrink-0">
                                                            @if($item->status === 'available')
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                                    Tersedia
                                                                </span>
                                                            @elseif($item->status === 'claimed')
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gold-100 text-gold-800 border border-gold-200">
                                                                    Diklaim
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                                    Dikembalikan
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <p class="text-sm text-stone-600 mb-3 line-clamp-2">
                                                        {{ $item->description }}
                                                    </p>

                                                    <div class="flex items-center gap-4 text-xs text-stone-500 mb-3">
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                            {{ $item->location_found }}
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                            {{ date('d/m/Y', strtotime($item->date_found)) }}
                                                        </span>
                                                    </div>
                                                    
                                                    {{-- Action Buttons --}}
                                                    <div class="pt-3 border-t border-stone-200 flex items-center gap-3">
                                                        <a 
                                                            href="{{ route('items.show', $item->item_id) }}"
                                                            class="text-primary-600 hover:text-primary-800 text-sm font-semibold hover:underline"
                                                        >
                                                            Lihat Detail
                                                        </a>
                                                        <span class="text-stone-300">|</span>
                                                        <a 
                                                            href="{{ route('items.edit', $item->item_id) }}"
                                                            class="text-stone-600 hover:text-gold-600 text-sm font-semibold hover:underline"
                                                        >
                                                            Edit
                                                        </a>
                                                        <span class="text-stone-300">|</span>
                                                        <form 
                                                            action="{{ route('items.destroy', $item->item_id) }}" 
                                                            method="POST" 
                                                            class="inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.');"
                                                        >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button 
                                                                type="submit"
                                                                class="text-red-600 hover:text-red-800 text-sm font-semibold hover:underline"
                                                            >
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-16 flex flex-col items-center justify-center">
                                    <div class="bg-stone-50 w-24 h-24 rounded-full flex items-center justify-center mb-4 border border-stone-100">
                                        <svg class="w-12 h-12 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-stone-800 font-bold text-lg mb-2">Belum ada postingan</p>
                                    <p class="text-stone-500 mb-6 max-w-sm mx-auto">Anda belum melaporkan barang temuan apapun. Mulai laporkan barang yang Anda temukan untuk membantu orang lain!</p>
                                    <a 
                                        href="{{ route('items.create') }}"
                                        class="inline-block bg-primary-700 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-800 shadow-sm hover:shadow transition transform hover:-translate-y-0.5"
                                    >
                                        ➕ Laporkan Barang Temuan
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
