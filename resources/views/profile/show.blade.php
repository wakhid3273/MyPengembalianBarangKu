<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun - MyPengembalianBarangKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .success-animation {
            animation: successPop 0.6s ease-out;
        }

        @keyframes successPop {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .detail-card {
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen">
    
    {{-- Header --}}
    <header class="bg-white/10 backdrop-blur-md text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold">MyPengembalianBarangKu</h1>
                        <p class="text-sm text-white/80">Profil Akun</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-white/80 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition">
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
                <div class="success-animation bg-green-500 text-white px-6 py-4 rounded-xl shadow-2xl mb-6 flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Error Alert --}}
            @if(session('error'))
                <div class="bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl mb-6 flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-lg">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Left Column: Profil Info --}}
                <div class="lg:col-span-1">
                    <div class="detail-card bg-white rounded-2xl shadow-2xl overflow-hidden">
                        {{-- Header Card --}}
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
                            <div class="flex items-center gap-3">
                                <div class="bg-white/20 p-3 rounded-full">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold">Profil Akun</h2>
                                    <p class="text-sm text-blue-100 capitalize">{{ $user->role }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Form Edit Profil --}}
                        <div class="p-6">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Nama --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name', $user->name) }}"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- NIM --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        NIM <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="nim" 
                                        value="{{ old('nim', $user->nim) }}"
                                        placeholder="Masukkan NIM"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                    @error('nim')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Angkatan --}}
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Angkatan <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="angkatan" 
                                        value="{{ old('angkatan', $user->angkatan) }}"
                                        placeholder="Contoh: 2023"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                    @error('angkatan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Nomor Telepon --}}
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nomor Telepon <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        name="phone" 
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="Contoh: 081234567890"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    >
                                    <p class="text-xs text-gray-500 mt-1">
                                        Nomor telepon akan digunakan untuk menghubungi Anda terkait barang yang dilaporkan
                                    </p>
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email (Read Only) --}}
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input 
                                        type="email" 
                                        value="{{ $user->email }}"
                                        disabled
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed"
                                    >
                                    <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
                                </div>

                                {{-- Submit Button --}}
                                <button 
                                    type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition"
                                >
                                    💾 Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Riwayat Postingan --}}
                <div class="lg:col-span-2">
                    <div class="detail-card bg-white rounded-2xl shadow-2xl overflow-hidden">
                        {{-- Header Card --}}
                        <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="bg-white/20 p-3 rounded-full">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold">Riwayat Postingan</h2>
                                        <p class="text-sm text-green-100">Total: {{ $items->count() }} postingan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- List Postingan --}}
                        <div class="p-6">
                            @if($items->count() > 0)
                                <div class="space-y-4">
                                    @foreach($items as $item)
                                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                            <div class="flex gap-4">
                                                {{-- Thumbnail --}}
                                                <div class="flex-shrink-0">
                                                    <img 
                                                        src="{{ $item->getPhotoDisplayUrl() }}" 
                                                        alt="{{ $item->item_name }}"
                                                        class="w-24 h-24 object-cover rounded-lg"
                                                        onerror="this.src='https://via.placeholder.com/100?text=No+Image'"
                                                    >
                                                </div>
                                                
                                                {{-- Content --}}
                                                <div class="flex-1">
                                                    <div class="flex items-start justify-between">
                                                        <div>
                                                            <h3 class="font-bold text-lg text-gray-800 mb-1">
                                                                {{ $item->item_name }}
                                                            </h3>
                                                            <p class="text-sm text-gray-600 mb-2 line-clamp-2">
                                                                {{ $item->description }}
                                                            </p>
                                                            <div class="flex items-center gap-4 text-xs text-gray-500">
                                                                <span class="flex items-center gap-1">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                                    </svg>
                                                                    {{ $item->category->category_name }}
                                                                </span>
                                                                <span class="flex items-center gap-1">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                    </svg>
                                                                    {{ $item->location_found }}
                                                                </span>
                                                                <span class="flex items-center gap-1">
                                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                                    </svg>
                                                                    {{ date('d/m/Y', strtotime($item->date_found)) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- Status Badge --}}
                                                        <div class="flex-shrink-0">
                                                            @if($item->status === 'available')
                                                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                                                    Tersedia
                                                                </span>
                                                            @elseif($item->status === 'claimed')
                                                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                                                    Diklaim
                                                                </span>
                                                            @else
                                                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                                    Dikembalikan
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Action Buttons --}}
                                                    <div class="mt-3 flex items-center gap-3">
                                                        <a 
                                                            href="{{ route('items.show', $item->item_id) }}"
                                                            class="inline-block text-blue-600 hover:text-blue-800 text-sm font-semibold"
                                                        >
                                                            Lihat Detail →
                                                        </a>
                                                        <a 
                                                            href="{{ route('items.edit', $item->item_id) }}"
                                                            class="inline-block text-yellow-600 hover:text-yellow-800 text-sm font-semibold"
                                                        >
                                                            ✏️ Edit
                                                        </a>
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
                                                                class="text-red-600 hover:text-red-800 text-sm font-semibold"
                                                            >
                                                                🗑️ Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 font-semibold mb-2">Belum ada postingan</p>
                                    <p class="text-sm text-gray-500 mb-4">Mulai laporkan barang yang kamu temukan!</p>
                                    <a 
                                        href="{{ route('items.create') }}"
                                        class="inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-lg font-semibold hover:shadow-lg transition"
                                    >
                                        ➕ Laporkan Barang
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


