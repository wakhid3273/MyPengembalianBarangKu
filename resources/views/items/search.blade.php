<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Barang Hilang - MyPengembalianBarangKu</title>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-sans font-bold tracking-wide">MyPengembalian<span
                                class="text-gold-500">BarangKu</span></h1>
                        <p class="text-xs text-primary-100 tracking-wider uppercase">Cari Barang</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('dashboard') }}"
                        class="bg-primary-800 hover:bg-primary-700 border border-primary-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-sm hover:shadow">
                        Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">

        {{-- Search Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6 mb-8">
            <div class="flex items-center gap-4 mb-6 border-b border-stone-100 pb-4">
                <div class="bg-primary-50 w-12 h-12 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-sans font-bold text-stone-800">Cari Barang</h2>
                    <p class="text-sm text-stone-500">Gunakan filter untuk menemukan barang yang hilang</p>
                </div>
            </div>

            <form action="{{ route('items.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">

                    {{-- Keyword --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Kata Kunci</label>
                        <input type="text" name="keyword" value="{{ $keyword }}"
                            placeholder="Nama atau deskripsi barang..."
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm">
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Kategori</label>
                        <select name="category_id"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm">
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
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Lokasi Penemuan</label>
                        <input type="text" name="location" value="{{ $location }}" placeholder="Contoh: Gedung C"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm">
                    </div>

                    {{-- Tanggal Dari --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Tanggal Dari</label>
                        <input type="date" name="date_from" value="{{ $dateFrom }}"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm">
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-2">Tanggal Sampai</label>
                        <input type="date" name="date_to" value="{{ $dateTo }}"
                            class="w-full px-4 py-2.5 bg-stone-50 border border-stone-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-sm">
                    </div>

                    {{-- Button Search --}}
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-primary-700 hover:bg-primary-800 text-white py-2.5 rounded-lg font-bold shadow-sm hover:shadow transition text-sm">
                            🔍 Cari Barang
                        </button>
                    </div>
                </div>

                {{-- Reset Filter --}}
                @if($keyword || $categoryId || $location || $dateFrom || $dateTo)
                    <div class="text-center pt-2 border-t border-stone-100">
                        <a href="{{ route('items.search') }}"
                            class="text-sm text-primary-600 hover:text-primary-800 font-medium inline-flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset Filter Pencarian
                        </a>
                    </div>
                @endif
            </form>
        </div>

        {{-- Results --}}
        <div>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-sans font-bold text-stone-800">
                    Hasil Pencarian <span
                        class="text-stone-400 font-sans text-base font-normal ml-2">({{ $items->count() }}
                        barang)</span>
                </h3>
            </div>

            @if($items->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($items as $item)
                        <div
                            class="group bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-xl hover:border-primary-200 transition-all duration-300 flex flex-col h-full">
                            {{-- Image --}}
                            <div class="h-56 bg-stone-200 overflow-hidden relative">
                                <img src="{{ $item->getPhotoDisplayUrl() }}" alt="{{ $item->item_name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Foto+Tidak+Tersedia'">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="px-3 py-1 bg-white/90 backdrop-blur text-primary-800 text-xs font-bold rounded-full shadow-sm">
                                        {{ $item->category->category_name }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 mb-3 text-xs text-stone-500 font-medium">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ date('d/m/Y', strtotime($item->date_found)) }}
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ Str::limit($item->location_found, 15) }}
                                    </span>
                                </div>

                                <h4 class="font-bold text-lg text-stone-800 mb-2 group-hover:text-primary-700 transition">
                                    {{ $item->item_name }}
                                </h4>
                                <p class="text-sm text-stone-600 mb-4 line-clamp-2 flex-1">{{ $item->description }}</p>

                                <a href="{{ route('items.detail', $item->item_id) }}"
                                    class="block w-full bg-stone-50 hover:bg-primary-50 text-stone-700 hover:text-primary-700 border border-stone-200 hover:border-primary-200 text-center py-2.5 rounded-lg font-semibold transition mt-auto">
                                    Lihat Detail & Klaim
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-2xl border border-stone-200 border-dashed">
                    <div class="bg-stone-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <p class="text-stone-800 text-lg font-bold mb-2">Tidak ada barang ditemukan</p>
                    <p class="text-stone-500 text-sm">Coba ubah kata kunci atau reset filter pencarian Anda.</p>
                </div>
            @endif
        </div>
    </main>
</body>

</html>
