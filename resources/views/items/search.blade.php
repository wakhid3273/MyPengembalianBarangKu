<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Barang Hilang - MyPengembalianBarangKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .search-card {
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .item-card {
            animation: fadeIn 0.4s ease-out;
            transition: all 0.3s ease;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
            border-color: #667eea;
            outline: none;
        }
    </style>
</head>
<body>
    
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
                        <p class="text-sm text-white/80">Cari Barang Hilang</p>
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
        
        {{-- Search Form Card --}}
        <div class="search-card bg-white rounded-2xl shadow-2xl p-6 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Cari Barang Hilang</h2>
                    <p class="text-sm text-gray-600">Gunakan filter untuk mempermudah pencarian</p>
                </div>
            </div>

            <form action="{{ route('items.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    
                    {{-- Keyword --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kata Kunci</label>
                        <input 
                            type="text" 
                            name="keyword" 
                            value="{{ $keyword }}"
                            placeholder="Nama atau deskripsi barang..."
                            class="input-field w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                        >
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select 
                            name="category_id" 
                            class="input-field w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                        >
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ $categoryId == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi Penemuan</label>
                        <input 
                            type="text" 
                            name="location" 
                            value="{{ $location }}"
                            placeholder="Contoh: Gedung C"
                            class="input-field w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                        >
                    </div>

                    {{-- Tanggal Dari --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                        <input 
                            type="date" 
                            name="date_from" 
                            value="{{ $dateFrom }}"
                            class="input-field w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                        >
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                        <input 
                            type="date" 
                            name="date_to" 
                            value="{{ $dateTo }}"
                            class="input-field w-full px-4 py-2 border-2 border-gray-200 rounded-lg"
                        >
                    </div>

                    {{-- Button Search --}}
                    <div class="flex items-end">
                        <button 
                            type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-2 rounded-lg font-semibold hover:shadow-lg transition"
                        >
                            🔍 Cari Barang
                        </button>
                    </div>
                </div>

                {{-- Reset Filter --}}
                @if($keyword || $categoryId || $location || $dateFrom || $dateTo)
                    <div class="text-center">
                        <a href="{{ route('items.search') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            ✕ Reset Filter
                        </a>
                    </div>
                @endif
            </form>
        </div>

        {{-- Results --}}
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">
                    📦 Hasil Pencarian ({{ $items->count() }} barang)
                </h3>
            </div>

            @if($items->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                        <div class="item-card bg-white rounded-xl shadow-lg overflow-hidden">
                            {{-- Image --}}
                            <div class="h-48 bg-gray-200 overflow-hidden">
                                <img 
                                    src="{{ $item->getPhotoDisplayUrl() }}" 
                                    alt="{{ $item->item_name }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Foto+Tidak+Tersedia'"
                                >
                            </div>

                            {{-- Content --}}
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                        {{ $item->category->category_name }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ date('d/m/Y', strtotime($item->date_found)) }}
                                    </span>
                                </div>

                                <h4 class="font-bold text-lg text-gray-800 mb-2">{{ $item->item_name }}</h4>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item->description }}</p>

                                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $item->location_found }}</span>
                                </div>

                                <a 
                                    href="{{ route('items.detail', $item->item_id) }}"
                                    class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-2 rounded-lg font-semibold hover:shadow-lg transition"
                                >
                                    Lihat Detail & Klaim
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-white/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-white text-lg font-medium mb-2">Tidak ada barang ditemukan</p>
                    <p class="text-white/70 text-sm">Coba ubah filter pencarian atau <a href="{{ route('items.search') }}" class="text-white underline">reset filter</a></p>
                </div>
            @endif
        </div>
    </main>
</body>
</html>