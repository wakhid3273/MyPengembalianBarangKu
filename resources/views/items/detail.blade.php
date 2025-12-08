<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - MyPengembalianBarangKu</title>
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
                        <p class="text-xs text-primary-100 tracking-wider uppercase">Detail Barang</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a href="{{ route('items.search') }}"
                        class="bg-primary-800 hover:bg-primary-700 border border-primary-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-sm hover:shadow">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            {{-- Detail Card --}}
            <div class="bg-white rounded-2xl shadow-md border border-stone-200 overflow-hidden">

                {{-- Header Card --}}
                <div class="bg-primary-50 text-stone-800 p-6 border-b border-primary-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-white p-3 rounded-xl shadow-sm border border-primary-100">
                                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-sans font-bold text-primary-900">Detail Barang</h2>
                                <p class="text-sm text-stone-500 font-mono">ID Barang: #{{ $item->item_id }}</p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <span
                                class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white border border-stone-200 shadow-sm text-stone-600">
                                {{ $item->category->category_name }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                        {{-- Left Column: Image --}}
                        <div class="space-y-6">
                            <div
                                class="bg-stone-100 rounded-xl overflow-hidden shadow-inner border border-stone-200 relative group">
                                <img src="{{ $item->getPhotoDisplayUrl() }}" alt="{{ $item->item_name }}"
                                    class="w-full h-auto object-cover transition duration-500 group-hover:scale-105"
                                    onerror="this.src='https://via.placeholder.com/500x400?text=Foto+Tidak+Tersedia'">
                                <div
                                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300">
                                </div>
                            </div>

                            {{-- Info Pelapor --}}
                            <div class="bg-stone-50 border border-stone-200 p-4 rounded-xl">
                                <p class="text-xs font-bold text-stone-400 uppercase tracking-wide mb-3">Dilaporkan Oleh
                                </p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="bg-primary-800 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm ring-2 ring-white">
                                        {{ substr($item->reporter->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-stone-800 text-sm">{{ $item->reporter->name }}</p>
                                        <p class="text-xs text-stone-500 capitalize">{{ $item->reporter->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Details --}}
                        <div class="space-y-8">

                            {{-- Title & Status --}}
                            <div>
                                <div class="flex items-center gap-3 mb-3">
                                    @if($item->status == 'claimed')
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide border border-green-200 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Diklaim
                                        </span>
                                    @elseif($item->status == 'available')
                                        <span
                                            class="px-3 py-1 bg-gold-100 text-gold-700 rounded-full text-xs font-bold uppercase tracking-wide border border-gold-200 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Tersedia
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wide border border-blue-200">
                                            Dikembalikan
                                        </span>
                                    @endif
                                    <span class="text-xs text-stone-400 font-medium">|</span>
                                    <span class="text-xs text-stone-500 font-medium">
                                        Diposting {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <h3 class="text-3xl font-sans font-bold text-stone-800 leading-tight">
                                    {{ $item->item_name }}
                                </h3>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="prose prose-stone">
                                <p class="text-stone-600 leading-relaxed text-lg">
                                    {{ $item->description }}
                                </p>
                            </div>

                            {{-- Info Grid --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="p-4 bg-stone-50 rounded-xl border border-stone-100">
                                    <p class="text-xs font-bold text-primary-600 uppercase tracking-wider mb-1">Lokasi
                                        Penemuan</p>
                                    <p class="text-stone-800 font-medium flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $item->location_found }}
                                    </p>
                                </div>

                                <div class="p-4 bg-stone-50 rounded-xl border border-stone-100">
                                    <p class="text-xs font-bold text-primary-600 uppercase tracking-wider mb-1">Kategori
                                    </p>
                                    <p class="text-stone-800 font-medium flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        {{ $item->category->category_name }}
                                    </p>
                                </div>

                                <div class="p-4 bg-stone-50 rounded-xl border border-stone-100">
                                    <p class="text-xs font-bold text-primary-600 uppercase tracking-wider mb-1">Tanggal
                                    </p>
                                    <p class="text-stone-800 font-medium flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ date('d/m/Y', strtotime($item->date_found)) }}
                                    </p>
                                </div>

                                <div class="p-4 bg-stone-50 rounded-xl border border-stone-100">
                                    <p class="text-xs font-bold text-primary-600 uppercase tracking-wider mb-1">Waktu
                                    </p>
                                    <p class="text-stone-800 font-medium flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ date('H:i', strtotime($item->time_found)) }} WIB
                                    </p>
                                </div>
                            </div>

                            {{-- Kontak Pelapor --}}
                            <div class="bg-primary-50/50 border border-primary-100 p-5 rounded-xl">
                                <label
                                    class="text-xs font-bold text-primary-600 uppercase tracking-wide mb-3 block">Info
                                    Kontak Pelapor</label>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-stone-500 uppercase tracking-wide mb-0.5">Nomor Telepon
                                        </p>
                                        <a href="tel:{{ $item->phone }}"
                                            class="text-lg font-bold text-primary-700 hover:text-primary-800 hover:underline">
                                            {{ $item->phone }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-10 pt-8 border-t border-stone-100 flex flex-col sm:flex-row gap-4">
                        @if($item->status === 'available' && $item->reporter_id !== Auth::id())
                            <form action="{{ route('items.claim', $item->item_id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Apakah Anda yakin ingin mengklaim barang ini?');">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-primary-700 hover:bg-primary-800 text-white py-4 rounded-xl font-bold text-lg shadow-sm hover:shadow-md transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Klaim Barang Ini
                                </button>
                            </form>
                        @elseif($item->status === 'claimed')
                            <div
                                class="flex-1 bg-yellow-100 text-yellow-800 border border-yellow-200 py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 cursor-not-allowed opacity-90">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                Barang Sudah Diklaim
                            </div>
                        @elseif($item->reporter_id === Auth::id())
                            <div
                                class="flex-1 bg-stone-100 text-stone-600 border border-stone-200 py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 cursor-default">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Ini Barang Anda
                            </div>
                        @endif
                        <a href="{{ route('items.search') }}"
                            class="px-8 py-4 border border-stone-300 rounded-xl hover:bg-stone-50 transition text-center font-semibold text-stone-600">
                            Kembali ke Pencarian
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
