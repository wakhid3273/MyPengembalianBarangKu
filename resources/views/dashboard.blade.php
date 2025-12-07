<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MyPengembalianBarangKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    
    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold">MyPengembalianBarangKu</h1>
                        <p class="text-sm text-blue-100">Unsoed Lost & Found System</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a 
                        href="{{ route('profile.show') }}"
                        class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition"
                    >
                        Riwayat
                    </a>
                    <a 
                        href="{{ route('profile.show') }}"
                        class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition"
                    >
                        Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button 
                            type="submit"
                            class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-lg transition"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Navigation --}}
    <nav class="bg-white shadow-sm border-b">
        <div class="container mx-auto px-4">
            <div class="flex gap-1">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 font-medium text-blue-600 border-b-2 border-blue-600">
                    Dashboard
                </a>
                <a href="{{ route('items.create') }}" class="px-6 py-3 font-medium text-gray-600 hover:text-blue-600">
                    Laporkan Barang
                </a>
                <a href="{{ route('items.search') }}" class="px-6 py-3 font-medium text-gray-600 hover:text-blue-600">
                    Cari Barang
                </a>
                <a href="{{ route('profile.show') }}" class="px-6 py-3 font-medium text-gray-600 hover:text-blue-600">
                    Profil
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        
        {{-- Alert Success --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Recent Uploads Section --}}
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 w-12 h-12 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Upload Terbaru</h2>
                        <p class="text-sm text-gray-600">Barang-barang yang baru dilaporkan oleh semua user</p>
                    </div>
                </div>
            </div>

            @if($recentItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentItems as $item)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
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
                                    <div class="flex items-center gap-2">
                                        @if($item->status === 'available')
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                                Tersedia
                                            </span>
                                        @elseif($item->status === 'claimed')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">
                                                Diklaim
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                                Dikembalikan
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-500">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>

                                <h4 class="font-bold text-lg text-gray-800 mb-2">{{ $item->item_name }}</h4>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $item->description }}</p>

                                <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $item->location_found }}</span>
                                </div>

                                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ $item->reporter->name }}</span>
                                </div>

                                <div class="flex gap-2">
                                    <a 
                                        href="{{ route('items.show', $item->item_id) }}"
                                        class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-2 rounded-lg font-semibold hover:shadow-lg transition"
                                    >
                                        Lihat Detail
                                    </a>
                                    @if($item->status === 'available' && $item->reporter_id !== Auth::id())
                                        <form 
                                            action="{{ route('items.claim', $item->item_id) }}" 
                                            method="POST" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin mengklaim barang ini?');"
                                        >
                                            @csrf
                                            <button 
                                                type="submit"
                                                class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg transition"
                                                title="Klaim Barang"
                                            >
                                                ✓ Klaim
                                            </button>
                                        </form>
                                    @endif
                                    @if(Auth::user()->isAdmin())
                                        <form 
                                            action="{{ route('items.destroy', $item->item_id) }}" 
                                            method="POST" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan ini? Tindakan ini tidak dapat dibatalkan.');"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit"
                                                class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg transition"
                                                title="Hapus Postingan (Admin)"
                                            >
                                                🗑️
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-600 text-lg font-medium mb-2">Belum ada upload</p>
                    <p class="text-gray-500 text-sm">Barang yang dilaporkan akan muncul di sini</p>
                </div>
            @endif
        </div>
    </main>
</body>
</html>