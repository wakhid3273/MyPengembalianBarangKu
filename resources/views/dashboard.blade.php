<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MyPengembalianBarangKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-50 font-sans text-stone-800">
    
    {{-- Header --}}
    <header class="bg-primary-900 text-white shadow-lg">
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
                        <p class="text-xs text-primary-100 tracking-wider uppercase">Unsoed Lost & Found System</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-primary-200 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <a 
                        href="{{ route('profile.show') }}"
                        class="bg-primary-800 hover:bg-primary-700 border border-primary-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-sm hover:shadow"
                    >
                        Riwayat
                    </a>
                    <a 
                        href="{{ route('profile.show') }}"
                        class="bg-primary-800 hover:bg-primary-700 border border-primary-700 px-4 py-2 rounded-lg transition text-sm font-medium shadow-sm hover:shadow"
                    >
                        Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button 
                            type="submit"
                            class="bg-red-900/50 hover:bg-red-900 border border-red-800/50 text-red-100 px-4 py-2 rounded-lg transition text-sm font-medium"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Navigation --}}
    <nav class="bg-white shadow-sm border-b border-stone-100">
        <div class="container mx-auto px-4">
            <div class="flex gap-1 overflow-x-auto">
                <a href="{{ route('dashboard') }}" class="px-6 py-4 font-medium text-primary-800 border-b-2 border-primary-800 hover:bg-stone-50 transition">
                    Dashboard
                </a>
                <a href="{{ route('items.create') }}" class="px-6 py-4 font-medium text-stone-600 hover:text-primary-700 hover:bg-stone-50 transition">
                    Laporkan Barang
                </a>
                <a href="{{ route('items.search') }}" class="px-6 py-4 font-medium text-stone-600 hover:text-primary-700 hover:bg-stone-50 transition">
                    Cari Barang
                </a>
                <a href="{{ route('profile.show') }}" class="px-6 py-4 font-medium text-stone-600 hover:text-primary-700 hover:bg-stone-50 transition">
                    Profil
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container mx-auto px-4 py-8">
        
        {{-- Alert Success --}}
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-4 py-3 rounded-r-lg mb-6 shadow-sm flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Admin Menu Section --}}
        @if(Auth::user()->isAdmin())
        <div class="mb-8">
            <h2 class="text-2xl font-sans font-bold text-stone-800 mb-6">Menu Admin</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Manage Users -->
                <a href="{{ route('admin.users.index') }}" class="group bg-white p-6 rounded-xl shadow-sm border border-stone-100 hover:shadow-md hover:border-primary-200 transition flex items-center gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg group-hover:bg-blue-100 transition">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-stone-800 group-hover:text-primary-800 transition">Kelola Pengguna</h3>
                        <p class="text-sm text-stone-500">Atur akun dan hak akses pengguna system</p>
                    </div>
                </a>

                <!-- Manage Categories -->
                <a href="{{ route('admin.categories.index') }}" class="group bg-white p-6 rounded-xl shadow-sm border border-stone-100 hover:shadow-md hover:border-primary-200 transition flex items-center gap-4">
                    <div class="bg-emerald-50 p-4 rounded-lg group-hover:bg-emerald-100 transition">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-stone-800 group-hover:text-primary-800 transition">Kelola Kategori</h3>
                        <p class="text-sm text-stone-500">Tambah atau edit kategori barang</p>
                    </div>
                </a>

                <!-- View Stats -->
                <a href="{{ route('admin.stats.index') }}" class="group bg-white p-6 rounded-xl shadow-sm border border-stone-100 hover:shadow-md hover:border-primary-200 transition flex items-center gap-4">
                    <div class="bg-purple-50 p-4 rounded-lg group-hover:bg-purple-100 transition">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-stone-800 group-hover:text-primary-800 transition">Laporan Statistika</h3>
                        <p class="text-sm text-stone-500">Lihat ringkasan data dan aktivitas</p>
                    </div>
                </a>
            </div>
        </div>
        @endif

        {{-- Recent Uploads Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
            <div class="mb-8 border-b border-stone-100 pb-4">
                <div class="flex items-center gap-4">
                    <div class="bg-primary-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-sans font-bold text-stone-800">Upload Terbaru</h2>
                        <p class="text-stone-500">Barang-barang yang baru dilaporkan</p>
                    </div>
                </div>
            </div>

            @if($recentItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($recentItems as $item)
                        <div class="group bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-xl hover:border-primary-200 transition-all duration-300">
                            {{-- Image --}}
                            <div class="h-56 bg-stone-200 overflow-hidden relative">
                                <img 
                                    src="{{ $item->getPhotoDisplayUrl() }}" 
                                    alt="{{ $item->item_name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500"
                                    onerror="this.src='https://via.placeholder.com/400x300?text=Foto+Tidak+Tersedia'"
                                >
                                <div class="absolute top-3 right-3">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur text-primary-800 text-xs font-bold rounded-full shadow-sm">
                                        {{ $item->category->category_name }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        @if($item->status === 'available')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Tersedia
                                            </span>
                                        @elseif($item->status === 'claimed')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-50 text-amber-700 text-xs font-semibold rounded-full border border-amber-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Diklaim
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-full border border-blue-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Dikembalikan
                                            </span>
                                        @endif
                                    </div>
                                    <span class="text-xs text-stone-400 font-medium">
                                        {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <h4 class="font-bold text-lg text-stone-800 mb-2 group-hover:text-primary-700 transition">{{ $item->item_name }}</h4>
                                <p class="text-sm text-stone-500 mb-4 line-clamp-2 leading-relaxed">{{ $item->description }}</p>

                                <div class="flex items-center gap-4 text-xs text-stone-500 mb-5 border-t border-stone-100 pt-3">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="truncate max-w-[100px]">{{ $item->location_found }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="truncate max-w-[100px]">{{ $item->reporter->name }}</span>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <a 
                                        href="{{ route('items.show', $item->item_id) }}"
                                        class="flex-1 bg-stone-50 hover:bg-stone-100 text-stone-700 text-center py-2.5 rounded-lg font-medium transition text-sm border border-stone-200"
                                    >
                                        Detail
                                    </a>
                                    @if($item->status === 'available' && $item->reporter_id !== Auth::id())
                                        <form 
                                            action="{{ route('items.claim', $item->item_id) }}" 
                                            method="POST" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin mengklaim barang ini?');"
                                            class="flex-1"
                                        >
                                            @csrf
                                            <button 
                                                type="submit"
                                                class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition text-sm"
                                            >
                                                Klaim
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
                                                class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2.5 rounded-lg transition"
                                                title="Hapus Postingan"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-stone-50 rounded-xl border border-dashed border-stone-300">
                    <div class="bg-white p-4 rounded-full inline-block shadow-sm mb-4">
                        <svg class="w-12 h-12 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <p class="text-stone-600 text-lg font-medium mb-1">Belum ada barang dilaporkan</p>
                    <p class="text-stone-400 text-sm">Jadilah yang pertama melaporkan temuan barang.</p>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
